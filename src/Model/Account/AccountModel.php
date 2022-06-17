<?php


namespace App\Model\Account;

use App\DTO\AccountQuickRegistrationDTO;
use App\Entity\Fidelity\Account;
use App\Entity\Fidelity\AccountCode;
use App\Entity\Fidelity\AccountVehicle;
use App\Entity\Fidelity\Person;
use App\Exception\ApiException;
use App\Exception\ItemNotFoundException;
use App\Exception\UniqueViolationException;
use App\Model\Base\BaseModel;
use App\Util\ApiResponseBag;
use App\Util\Str;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Class AccountModel
 * @package App\Model
 * @property Account $entity
 */
class AccountModel extends BaseModel
{
    /** @var String */
    private $variable = 'null';

    /** @var Account[] */
    private $accountList = [];

    /** @var AccountVehicle */
    private $accountVehicle;

    /** @var AccountVehicle[] */
    private $accountVehicleList = [];

    /** @var AccountCode[] */
    private $accountCodeList = [];

    /** @var Account */
    private $mainAccount;

    /** @var Account */
    private $chosenAccount;

    public function __construct(array $payload = null)
    {
        $this->entity = new Account();
        $this->entityName = Account::class;
        $this->payload = $payload;
    }

    public function editAccountData(): JsonResponse
    {
        return $this->execute(function () {
            $accountId = $this->getValue('accountId');
            $this->entity = Account::ref($accountId);

            if ($this->entity === null) {
               throw new ItemNotFoundException('Conta não encontrada');
            }

            $this->update();

            db()->persist($this->entity);
            db()->flush();

//            $dtoFromAccount = AccountQuickRegistrationDTO::fromAccount($this->entity);

            $value = container_serializer_normalize($this->entity, Account::gr('entity'));
//            $value = 'a';

            db()->commit();
            return ApiResponseBag::success($value);
//            return ApiResponseBag::success($dtoFromAccount, [], 'Dados atualizados com sucesso.');
        }, true);
    }

    /**
     * @param Account $account
     * @throws \JsonException
     * @throws \Doctrine\ORM\ORMException
     */
    private function update(): void
    {
        $dto = AccountQuickRegistrationDTO::fromPayload($this->payload);

        $person = $this->entity->getPerson();
//        $person->setCpfCnpj($dto->username); // Username never changes
//        $person->setPersonType($dto->personType);
//        $person->setRgIeCode($dto->rgIeCode);
        if (!empty($dto->fullName)) {
            $person->setFullName($dto->fullName);
        }
        if (!empty($dto->legalName)) {
            $person->setLegalName($dto->legalName);
        }
//        $person->setPersonCode($dto->code);
        db()->persist($person);

        if (!empty($dto->fullName)) {
            $this->entity->setFullName($person->getFullName());
        }
        if (!empty($dto->legalName)) {
            $this->entity->setLegalName($person->getLegalName());
        }
        if (!empty($dto->mobilePhone)) {
            $this->entity->setMobilePhone($dto->mobilePhone);
        }
        if (!empty($dto->email)) {
            $this->entity->setEmail($dto->email);
        }

        if (!empty($dto->password)) {
            /** @var UserPasswordEncoderInterface $encoder */
            $encoder = container('security.password_encoder');
            $password = $encoder->encodePassword($this->entity, $dto->password);
            $this->entity->setPassword($password);
        }
    }

    public function getAllAccounts(): JsonResponse
    {
        return $this->execute(function () {
            $accountId = $this->getValue('accountId');
            $this->entity = Account::ref($accountId);


            $repo = db()->getRepository($this->entityName);

            $this->accountList = $repo->findAllByPerson(
                $this->entity->getPerson()
            );

            $value = Account::normalizeCollection($this->accountList, ['entity', 'account']);
            return ApiResponseBag::success($value);
        }, false);
    }

    private function search(): array
    {
        $qb = $this->createQueryBuilderEx('a')->notTrashed();

        $qb->leftJoin('a.person', 'p')->addSelect('p');
        // $qb->leftJoin('p.personIndividual', 'pi')->addSelect('pi');

        $qb->isearch([
            'like' => ['a.fullName', 'a.legalName', 'a.email', 'a.mobilePhone'],
            'eq' => ['p.cpfCnpj', 'p.rgIeCode', 'p.personCode', 'CAST(p.statusCode as text)']
        ], $this->payload);

        $qb->excludedId($this->getValue('noId'), 'p');

        $qb->orderBy('a.fullName');
        return $qb->paginate($this->payload, Account::gr(['entity', 'relations']));
    }

    public function selectMany(): JsonResponse
    {
        return $this->execute(function () {
            $result = $this->search();
            return ApiResponseBag::success($result);
        }, false);
    }

    public function addVehicle(): JsonResponse
    {
        return $this->execute(function () {
            $accountId = $this->getValue('accountId');
            $this->entity = Account::ref($accountId);

            if ($this->entity === null) {
                throw new ItemNotFoundException('Conta não encontrado');
            }

            $plate = $this->getValue('plate');
            $type = $this->getValue('type');
            $brand = $this->getValue('brand');
            $model = $this->getValue('model');
            $year = $this->getValue('year');
            $color = $this->getValue('color');
            $fuelConsumption = $this->getValue('fuelComsumption');
            $imported = $this->getValue('imported');

            if (empty($imported)) {
                $imported = false;
            }

            $this->accountVehicle = new AccountVehicle();

            $this->accountVehicle->setAccount($this->entity);
            $this->accountVehicle->setActive(true);
            $this->accountVehicle->setPlate($plate);
            $this->accountVehicle->setType($type);
            $this->accountVehicle->setBrand($brand);
            $this->accountVehicle->setModel($model);
            $this->accountVehicle->setYear($year);
            $this->accountVehicle->setColor($color);
            $this->accountVehicle->setFuelConsumption($fuelConsumption);
            $this->accountVehicle->setImported($imported);


            db()->persist($this->accountVehicle);
            db()->flush();

            $value = container_serializer_normalize($this->accountVehicle,
                AccountVehicle::gr('entity')
            );

            db()->commit();
            return ApiResponseBag::success($value);
        }, true);
    }

    public function editVehicle(): JsonResponse
    {
        return $this->execute(function () {
            $vehicleId = $this->getValue('id');
            $this->accountVehicle = AccountVehicle::ref($vehicleId);

            if ($this->accountVehicle === null) {
                throw new ItemNotFoundException('Veículo não encontrado');
            }

            $this->updateVehicle();

            db()->persist($this->accountVehicle);
            db()->flush();

            $value = container_serializer_normalize($this->accountVehicle,
                AccountVehicle::gr('entity')
            );

            db()->commit();
            return ApiResponseBag::success($value);
        }, true);
    }

    /**
     * @throws \JsonException
     * @throws \Doctrine\ORM\ORMException
     */
    private function updateVehicle(): void
    {
        $plate = $this->getValue('plate');
        $type = $this->getValue('type');
        $brand = $this->getValue('brand');
        $model = $this->getValue('model');
        $year = $this->getValue('year');
        $color = $this->getValue('color');
        $fuelConsumption = $this->getValue('fuelConsumption');
        $imported = $this->getValue('imported');


        if (!empty($plate)) {
            $this->accountVehicle->setPlate($plate);
        }
        if (!empty($type)) {
            $this->accountVehicle->setType($type);
        }
        if (!empty($brand)) {
            $this->accountVehicle->setBrand($brand);
        }
        if (!empty($model)) {
            $this->accountVehicle->setModel($model);
        }
        if (!empty($year)) {
            $this->accountVehicle->setYear($year);
        }
        if (!empty($color)) {
            $this->accountVehicle->setColor($color);
        }
        if (!empty($fuelConsumption)) {
            $this->accountVehicle->setFuelConsumption($fuelConsumption);
        }
        if (!empty($imported)) {
            $this->accountVehicle->setImported($imported);
        }
    }

    public function getAllVehicles(): JsonResponse
    {
        return $this->execute(function () {
            $accountId = $this->getValue('accountId');
            $this->entity = Account::ref($accountId);


            $repo = db()->getRepository(AccountVehicle::class);
            $this->accountVehicleList = $repo->findBy([
                'deletedAt' => null,
                'statusCode' => 1,
                'account' => $this->entity
            ]);

            $value = AccountVehicle::normalizeCollection($this->accountVehicleList, 'entity');
            return ApiResponseBag::success($value);
        }, false);
    }

    public function getAllCodes(): JsonResponse
    {
        return $this->execute(function () {
            $accountId = $this->getValue('accountId');
            $this->entity = Account::ref($accountId);


            $repo = db()->getRepository(AccountCode::class);
            $this->accountCodeList = $repo->findBy([
                'deletedAt' => null,
                'statusCode' => 1,
                'account' => $this->entity
            ]);

            $value = AccountCode::normalizeCollection($this->accountCodeList, 'min');
            return ApiResponseBag::success($value);
        }, false);
    }

    public function getAllSubAccounts(): JsonResponse
    {
        return $this->execute(function () {
            $accountId = $this->getValue('accountId');
            $this->entity = Account::ref($accountId);


            $repo = db()->getRepository($this->entityName);

            $this->accountList = $repo->findAllSubAccountsByMainAccountOrEmpty(
                $this->entity,
                true,
            );

            $value = Account::normalizeCollection($this->accountList, ['entity', 'person']);
            return ApiResponseBag::success($value);
        }, false);
    }

    public function getAccount(): JsonResponse
    {
        return $this->execute(function () {
            $username = $this->getValue('username');

            if (empty($username)) {
                throw new ItemNotFoundException('O campo usuário não deve ser vazio');
            }

            $repo = db()->getRepository($this->entityName);

            $this->entity = $repo->findOneByUsername(
                $username
            );

            $value = container_serializer_normalize($this->entity, Account::gr('entity'));
            return ApiResponseBag::success($value);
        }, false);
    }

    public function createSubAccount(): JsonResponse{
        return $this->execute(function () {
            $mainAccountId = $this->getValue('mainAccountId');
            $chosenAccount = $this->getValue('chosenAccountId');

            $this->mainAccount = Account::ref($mainAccountId);
            $this->chosenAccount = Account::ref($chosenAccount);

            if (empty($this->entity)) {
                throw new ItemNotFoundException('Conta principal não encontrada');
            }
            if (empty($this->chosenAccount)) {
                throw new ItemNotFoundException('Conta escolhida não encontrada');
            }

            /** creating a sub account / sharing the main account with this person */
            $this->entity->setPerson($this->chosenAccount->getPerson());
            $this->entity->setAccount($this->mainAccount);
            $this->entity->setActive(true);
            $this->entity->setUsername('');
            $this->entity->setPassword('');
            $this->entity->setEmail('subAccount');
            $this->entity->setMobilePhone('0');
            $this->entity->setFullName($this->mainAccount->getFullName());
            $this->entity->setLegalName($this->mainAccount->getLegalName());

            $repo = db()->getRepository($this->entityName);
            $subAccountExists = $repo->findOneBy([
                'deletedAt' => null,
                'statusCode' => 1,
                'account' => $this->entity->getAccount(),
                'person' => $this->entity->getPerson()
            ]);

            if (!empty($subAccountExists)) {
                throw new \Exception('Este compartilhamento já foi realizado');
            }

            $codeIsUnique = false;
            $codeRepo = db()->getRepository(AccountCode::class);

            do {
                $code = Str::randomStringCode();

                $accountCode = $codeRepo->findBy([
                    'deletedAt' => null,
                    'statusCode' => 1,
                    'code' => $code
                ]);

                if ($accountCode == null) {
                    $codeIsUnique = true;
                }

            } while($codeIsUnique == false);

            $accountCode = new AccountCode();
            $accountCode->setAccount($this->entity);
            $accountCode->setCode($code);

            db()->persist($accountCode);

            db()->persist($this->entity);
            db()->flush();

            $this->accountList = $repo->findAllSubAccountsByMainAccountOrEmpty(
                $this->mainAccount,
                true
            );

            /** get all subaccounts when creating a new subaccount so the user can have updated data on the subaccounts list */
            $value = Account::normalizeCollection($this->accountList, ['entity', 'person']);


            /** get only the created subaccount when creating a new subaccount */
            /** need to get all subaccounts later so subaccounts list is updated on mobile */
//            $value = container_serializer_normalize($this->entity, Account::gr('min'));

            db()->commit();
            return ApiResponseBag::success($value);
        });
    }

    public function cancelSubAccount(): JsonResponse{
        return $this->execute(function () {
            $mainAccountId = $this->getValue('mainAccountId');
            $chosenAccount = $this->getValue('chosenAccountId');

            $this->mainAccount = Account::ref($mainAccountId);
            $this->chosenAccount = Account::ref($chosenAccount);

            if (empty($this->entity)) {
                throw new ItemNotFoundException('Conta principal não encontrada');
            }
            if (empty($this->chosenAccount)) {
                throw new ItemNotFoundException('Conta escolhida não encontrada');
            }

            $this->chosenAccount->delete();
            $this->chosenAccount->setActive(false);

            db()->persist($this->chosenAccount);
            db()->flush();

            $repo = db()->getRepository($this->entityName);
            $this->accountList = $repo->findAllSubAccountsByMainAccountOrEmpty(
                $this->mainAccount,
                true
            );

            /** get all subaccounts when deleting a new subaccount so the user can have updated data on its subaccounts list */
            $value = Account::normalizeCollection($this->accountList, ['entity', 'person']);

            db()->commit();
            return ApiResponseBag::success($value);
        });
    }
}
