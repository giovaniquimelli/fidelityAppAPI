<?php


namespace App\Model\Reward;

use App\Doctrine\Types\Date;
use App\Doctrine\Types\DateType;
use App\Entity\Fidelity\Account;
use App\Entity\Fidelity\AccountCode;
use App\Entity\Fidelity\CompanyBranch;
use App\Entity\Fidelity\Product;
use App\Entity\Fidelity\ProductCompanyBranch;
use App\Entity\Fidelity\Reward;
use App\Entity\Fidelity\RewardCompanyBranch;
use App\Entity\Fidelity\RewardCompanyBranchInventory;
use App\Entity\Fidelity\TransactionRecord;
use App\Entity\Fidelity\TransactionRecordExchange;
use App\Entity\Fidelity\TransactionRecordExchangeLog;
use App\Entity\Fidelity\TransactionRecordExchangeRefReward;
use App\Model\Base\BaseModel;
use App\Model\Base\IBaseModel;
use App\Util\ApiResponseBag;
use App\Util\Container\Serializer;
use App\Util\InventoryEntryType;
use App\Util\InventoryItemType;
use App\Util\RewardTypes;
use App\Util\Str;
use App\Util\TransactionRecordEntryType;
use App\Util\TransactionRecordExchangeStatusType;
use App\Util\TransactionRecordStatusType;
use App\Util\TransactionRecordType;
use Doctrine\DBAL\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Class RewardModel
 * @package App\Model
 * @property Reward $entity
 */
class RewardModel extends BaseModel implements IBaseModel
{
    /** @var Reward[] */
    private $rewardList = [];

    /** @var CompanyBranch[] */
    private $companyBranchList = [];

    /** @var Account */
    private $account;

    /** @var Reward */
    private $reward;

    /** @var CompanyBranch */
    private $companyBranch;

    public function __construct(array $payload = null)
    {
        $this->payload = $payload;
        $this->entity = new Product();
        $this->entityName = Reward::class;
    }

    public function create()
    {
        return $this->execute(function () {
            $this->deserialize();
            db()->persist($this->entity);
            db()->flush();
            $id=$this->entity->getId();

            $filiais = [];
            $companyBranches = db()->getRepository(CompanyBranch::class)->findAll();
            foreach ($companyBranches as $cb) {
                $filiais[] = (new RewardCompanyBranch())
                    ->setCompanyBranch($cb)
                    ->setReward($this->entity)
                    ->setActive(true)
                    ->setActive($this->entity->isActive());
            }

            /** @var RewardCompanyBranch $filial */
            foreach ($filiais as $filial) {
                db()->persist($filial);
                db()->flush();
            }

            db()->commit();
            return ApiResponseBag::success(
                $this->entity->normalize(['entity', 'relations']), [],
                'Premio adicionado com sucesso.'
            );
        });
    }

    public function update()
    {
        return $this->execute(function () {
            $this->entity = $this->findById($this->getValue('id'));
            $this->deserialize();
            db()->persist($this->entity);
            db()->flush();

//            /** @var RewardCompanyBranch[] $filiais */
//            $filiais = Serializer::denormalizeCollection($this->getValue("productCompanyBranch"), RewardCompanyBranch::class);
//
//            $q = db()->createQueryBuilder()->update(Reward::class, 'p')
//                ->set('p.quantity', ':quantity')
//                ->set('p.point', ':point')
//                ->set('p.price', ':price')
//                ->set('p.paymentTypeFee', ':tax')
//                ->set('p.active', ':active')
//                ->where('p.id = :id');
//
//            foreach ($filiais as $filial) {
//                $q->setParameter('quantity', $filial->getQuantity())
//                    ->setParameter('point', $filial->getPoint())
//                    ->setParameter('price', $filial->getPrice())
//                    ->setParameter('tax', $filial->isPaymentTypeFee())
//                    ->setParameter('active', $filial->isActive())
//                    ->setParameter('id', $filial->getId());
//                //$qb->resetDQLParts()
//                $p = $q->getQuery()->execute();
//            }
            db()->commit();
            return ApiResponseBag::success(
                $this->entity->normalize('entity'), [],
                'Produto alterado com sucesso!');
        });
    }

    public function delete()
    {
        return $this->execute(function () {
            $this->entity = $this->findById($this->getValue('id'));
            $this->entity->delete();
            db()->persist($this->entity);
            db()->flush();
            db()->commit();
            return ApiResponseBag::success(null, [], 'Prédio removido com sucesso!');
        });
    }

    public function selectOne()
    {
        return $this->execute(function () {
            $this->entity = $this->findById($this->getValue('id'));
            return ApiResponseBag::success(
                $this->entity->normalize(['entity', 'relations'], RewardCompanyBranch::gr(['entity', 'company_branch']))
            );

        }, false);
    }

    public function selectMany(int $type = RewardTypes::REWARD): JsonResponse
    {
        return $this->execute(function () use ($type) {
            $result = $this->search($type);
            return ApiResponseBag::success($result);
        }, false);
    }

    private function search(int $type = RewardTypes::REWARD): array
    {
        $qb = $this->createQueryBuilderEx('r')->notTrashed();

        $qb->isearch(['r.name'], $this->payload);

        $qb->andWhere('r.rewardType=:type');
        $qb->setParameter('type', $type);


        $qb->excludedId($this->getValue('noId'), 'r');

        $qb->orderBy('r.name');
        return $qb->paginate($this->payload, Reward::gr(['entity', 'relations']));
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     */
    private function deserialize(): void
    {
        // dd($this->payload);
        $this->deserializer($this->payload, Reward::class, Reward::gw(), $this->entity);

        //$this->entity->setBuilding(Building::ref($this->getValue('building.id')));
        // dd($this->entity->normalize(['entity']));
    }

    public function selectAllMobile() {
        return $this->execute(function () {


            $repo = db()->getRepository($this->entityName);

            $this->rewardList = $repo->findAllMobileRewardsOrEmpty(true);
//dd($this->rewardList);
            $value = Reward::normalizeCollection($this->rewardList, 'entity');
            return ApiResponseBag::success($value);
        }, false);
    }

    public function selectAllBranchesByReward() {
        return $this->execute(function () {

            $rewardId = $this->getValue('id');
            $this->entity = Reward::ref($rewardId);

            $repo = db()->getRepository($this->entityName);

            $this->companyBranchList = $repo->findAllBranchesByRewardOrEmpty($this->entity, true);

            $value = CompanyBranch::normalizeCollection($this->companyBranchList, 'entity');
            return ApiResponseBag::success($value);
        }, false);
    }

    public function MakeExchange() {
        return $this->execute(function () {

            $accountId = $this->getValue('accountId');
            $rewardId = $this->getValue('rewardId');
            $companyBranchId = $this->getValue('companyBranchId');
            // TODO Get dinamically
            $quantity = 1;

            $this->account = Account::ref($accountId);
            $this->reward = Reward::ref($rewardId);
            $this->companyBranch = CompanyBranch::ref($companyBranchId);
            if (empty($this->account) || empty($this->reward) || empty($this->companyBranch)) {
                throw new \Exception('Dados insuficientes');
            }
            $rewardIndividualCost = -1 * $this->reward->getPoints();

            $tRRepo = db()->getRepository(TransactionRecord::class);
            $accountPointsSum = $tRRepo->findPointsSumByAccount($this->account);
            if ((float)($accountPointsSum['sum']) < -1 * $rewardIndividualCost) {
                throw new \Exception('Pontos insuficientes');
            }

            $repo = db()->getRepository(RewardCompanyBranchInventory::class);
            $availableRewardsSum = $repo->findRewardSumByCompanyBranch($this->reward, $this->companyBranch);
//            dd((float)($availableRewardsSum['sum']));
            if ((float)($availableRewardsSum['sum']) < $quantity) {
                throw new \Exception('Quantidade indisponível');
            }

            $transactionRecord = new TransactionRecord();
            $transactionRecordExchange = new TransactionRecordExchange();
            $transactionRecordExchangeLog = new TransactionRecordExchangeLog();
            $transactionRecordExchangeRefReward = new TransactionRecordExchangeRefReward();
            $rewardCompanyBranchInventory = new RewardCompanyBranchInventory();

            $transactionRecord->setAccount($this->account);
            $transactionRecord->setCompanyBranch($this->companyBranch);
            $transactionRecord->setPoints($rewardIndividualCost);
            $transactionRecord->setTransactionType(TransactionRecordType::EXCHANGE);
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
            db()->flush();

            $transactionRecordExchange->setTransaction($transactionRecord);
            $transactionRecordExchange->setPoints($this->reward->getPoints());
            $transactionRecordExchange->setStatus(TransactionRecordExchangeStatusType::PENDING);
            db()->persist($transactionRecordExchange);
            db()->flush();

            $transactionRecordExchangeLog->setTransaction($transactionRecord);
            $transactionRecordExchangeLog->setStatus(TransactionRecordExchangeStatusType::PENDING);
            $transactionRecordExchangeLog->setChangedAt(new \DateTime('now'));
            $transactionRecordExchangeLog->setRemarks('Troca realizada');
            db()->persist($transactionRecordExchangeLog);
            db()->flush();

            $transactionRecordExchangeRefReward->setTransaction($transactionRecord);
            $transactionRecordExchangeRefReward->setReward($this->reward);
            $transactionRecordExchangeRefReward->setUnitPoints($rewardIndividualCost);
            $transactionRecordExchangeRefReward->setQuantity($quantity);
            $transactionRecordExchangeRefReward->setPoints($quantity * $rewardIndividualCost);
            $transactionRecordExchangeRefReward->setUnitPrice($this->reward->getPrice());
            $transactionRecordExchangeRefReward->setAmount($quantity);
            $transactionRecordExchangeRefReward->setRefund(false);
            $transactionRecordExchangeRefReward->setTax(0);
            $transactionRecordExchangeRefReward->setCreatedAt(new \DateTime('now'));
            db()->persist($transactionRecordExchangeRefReward);
            db()->flush();

            $rewardCompanyBranchInventory->setReward($this->reward);
            $rewardCompanyBranchInventory->setCompanyBranch($this->companyBranch);
            $rewardCompanyBranchInventory->setTransactionRecord($transactionRecord);
            $rewardCompanyBranchInventory->setItemType(InventoryItemType::EXCHANGE);
            $rewardCompanyBranchInventory->setEntryType(InventoryEntryType::EXCHANGE);
            $rewardCompanyBranchInventory->setQuantityBefore((float)($availableRewardsSum['sum']));
            $rewardCompanyBranchInventory->setQuantityAfter((float)($availableRewardsSum['sum']) - $quantity);
            $rewardCompanyBranchInventory->setQuantity(-1 * $quantity);
            $rewardCompanyBranchInventory->setUnitPrice($this->reward->getPrice());
            db()->persist($rewardCompanyBranchInventory);
            db()->flush();

            db()->commit();

            $value = container_serializer_normalize(
                $transactionRecordExchangeRefReward, TransactionRecordExchangeRefReward::gr(['entity', 'reward'])
            );
            return ApiResponseBag::success($value);
        }, true);
    }
}
