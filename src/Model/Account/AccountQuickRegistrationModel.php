<?php


namespace App\Model\Account;

use App\DTO\AccountQuickRegistrationDTO;
use App\Entity\Fidelity\Account;
use App\Entity\Fidelity\AccountCode;
use App\Entity\Fidelity\CompanyBranch;
use App\Entity\Fidelity\Person;
use App\Entity\Fidelity\PersonIndividual;
use App\Entity\Fidelity\RewardCompanyBranchInventory;
use App\Entity\Fidelity\TransactionRecord;
use App\Entity\Fidelity\TransactionRecordExchange;
use App\Entity\Fidelity\TransactionRecordExchangeLog;
use App\Entity\Fidelity\TransactionRecordExchangeRefReward;
use App\Exception\ItemNotFoundException;
use App\Exception\UniqueViolationException;
use App\Model\Base\BaseModel;
use App\Util\Str;
use App\Util\TransactionRecordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Model\Base\IBaseModel;
use App\Util\ApiResponseBag;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Webimpress\SafeWriter\Exception\RuntimeException;

/**
 * Class AccountQuickRegistrationModel
 * @package App\Model\Account
 * @property Account $entity
 */
class AccountQuickRegistrationModel extends BaseModel implements IBaseModel
{
    public function __construct(array $payload = null)
    {
        $this->payload = $payload;
        $this->entity = new Account();
        $this->entityName = Account::class;
    }

    public function selectOne()
    {
        return $this->execute(function () {
            $account = $this->getAccount();

            $dtoFromAccount = AccountQuickRegistrationDTO::fromAccount($account);
            $return = ApiResponseBag::success($dtoFromAccount);
            db()->commit();
            return $return;
        }, true);
    }

    public function selectMany()
    {
        // TODO: Implement selectMany() method.
    }


    public function create()
    {
        return $this->save();
    }

    public function update()
    {
        return $this->save();
    }


    public function delete()
    {
        // TODO: Implement delete() method.
    }

    /**
     * @param Account $account
     * @return bool
     * @throws \JsonException
     * @throws \Doctrine\ORM\ORMException
     */
    private function insertOrUpdate(Account $account): bool
    {
        $dto = AccountQuickRegistrationDTO::fromPayload($this->payload);
        $isNew = db()->getUnitOfWork()->getEntityState($account) === \Doctrine\ORM\UnitOfWork::STATE_NEW;
//        $isNew = $account === new Account();

        if ($isNew) {
            if(empty($dto->personId)) {
                $account->setPerson(new Person());
//                $account->getPerson()->setPersonIndividual(new PersonIndividual());
            } else {
                $account->setPerson($this->getPerson($dto->personId));
            }
            // ?
             $account->setActive(true);

//            dd(Str::randomStringCode());

            $codeIsUnique = false;
            $repo = db()->getRepository(AccountCode::class);

            do {
                $code = Str::randomStringCode();

                $accountCode = $repo->findBy([
                    'deletedAt' => null,
                    'statusCode' => 1,
                    'code' => $code
                ]);

                if ($accountCode == null) {
                    $codeIsUnique = true;
                }

            } while($codeIsUnique == false);

            $accountCode = new AccountCode();
            $accountCode->setAccount($account);
            $accountCode->setCode($code);

            db()->persist($accountCode);
        }

//        $dto->code = '20' . time();

        $person = $account->getPerson();
        $person->setCpfCnpj($dto->username);
        $person->setPersonType($dto->personType);
//        $person->setRgIeCode($dto->rgIeCode);
        $person->setFullName($dto->fullName);
        $person->setLegalName($dto->legalName ?? '');
//        $person->setPersonCode($dto->code);
        db()->persist($person);

        $account->setFullName($person->getFullName());
        $account->setLegalName($person->getLegalName() ?? '');
        $account->setMobilePhone($dto->mobilePhone);
        $account->setEmail($dto->email);
        db()->persist($account);


        if ($dto->password !== '') {
            /** @var UserPasswordEncoderInterface $encoder */
            $encoder = container('security.password_encoder');
            $password = $encoder->encodePassword($account, $dto->password);
            $account->setPassword($password);
        }
        $account->setUsername($dto->username);




        // TODO Delete (gives 20k points to new user for testing purposes)
        $companyBranch = CompanyBranch::ref('c61a0066-f850-4bf7-980e-202a70233072');
        $tRRepo = db()->getRepository(TransactionRecord::class);
        $transactionRecord = new TransactionRecord();
        $transactionRecord->setAccount($account);
        $transactionRecord->setCompanyBranch($companyBranch);
        $transactionRecord->setPoints('20000');
        $transactionRecord->setTransactionType(TransactionRecordType::PURCHASE);
        $transactionRecord->setNotaFiscal('');
        $transactionRecord->setPurchaseUUID('');
        $transactionRecord->setLocalDateTime(new \DateTime('now'));
        $transactionRecord->setPosVersion('');
        $transactionRecord->setAppVersion('');
        $codeIsUnique = false;
        do {
            $code = Str::randomStringCode();

            $transaction = $tRRepo->findBy([
                'deletedAt' => null,
                'statusCode' => 1,
                'code' => $code
            ]);

            if ($transaction == null) {
                $codeIsUnique = true;
            }

        } while($codeIsUnique == false);
        $transactionRecord->setCode($code);
        db()->persist($transactionRecord);





        return $isNew;
    }

    private function save()
    {
        return $this->execute(function () {
            $account = $this->getAccount();
            $isNew = $this->insertOrUpdate($account);
            try {
                if ($isNew) {
                    db()->persist($account);
                }
                db()->flush();
            } catch (UniqueConstraintViolationException $ex) {
                throw UniqueViolationException::handleUniqueConstraintViolationException($ex);
            }
            $dtoFromAccount = AccountQuickRegistrationDTO::fromAccount($account);
            db()->commit();
            if ($isNew) {
                return ApiResponseBag::created($dtoFromAccount, [], 'Aluno cadastrado com sucesso.');
            }
            return ApiResponseBag::success($dtoFromAccount, [], 'Dados salvos com sucesso.');
        }, true);
    }

    /**
     * @return Account
     * @throws ItemNotFoundException
     */
    private function getAccount(): Account
    {
        $accountId = $this->getValue('accountId');

        $account = new Account();

        if (!empty($accountId)) {
            $account = db()->getRepository(Account::class)
                ->findAccountQuickRegistrationDTO($accountId);
            if ($account === null) {
                throw new ItemNotFoundException('Conta não encontrada');
            }
        }
        return $account ?? new Account();
    }

    /**
     * @param string $id
     * @return Person|null|object
     */
    private function getPerson(string $id): ?Person {
        return db()->getRepository(Person::class)->find($id);
    }
}
