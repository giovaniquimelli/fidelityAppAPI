<?php


namespace App\Model\TransactionRecord;

use App\Doctrine\Types\Date;
use App\Doctrine\Types\DateType;
use App\Entity\Fidelity\Account;
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
use App\Repository\TransactionRecordExchangeRefRewardRepository;
use App\Repository\TransactionRecordRepository;
use App\Util\ApiResponseBag;
use App\Util\Container\Serializer;
use App\Util\InventoryEntryType;
use App\Util\InventoryItemType;
use App\Util\RewardTypes;
use App\Util\TransactionRecordEntryType;
use App\Util\TransactionRecordExchangeStatusType;
use App\Util\TransactionRecordStatusType;
use App\Util\TransactionRecordType;
use Doctrine\DBAL\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Class TransactionRecordModel
 * @package App\Model
 * @property TransactionRecord $entity
 */
class TransactionRecordModel extends BaseModel implements IBaseModel
{
    /** @var TransactionRecordExchangeRefReward[] */
    private $exchangeReceiptList = [];

    /** @var TransactionRecord[] */
    private $transactionRecordList = [];

    /** @var Account */
    private $account;

    public function __construct(array $payload = null)
    {
        $this->payload = $payload;
        $this->entity = new TransactionRecord();
        $this->entityName = TransactionRecord::class;
    }

    public function selectAllExchangeReceipts() {
        return $this->execute(function () {
            $itemsToLoad = $this->getValue('itemsToLoad');
            $firstItem = $this->getValue('firstItem');

            $this->verifyAccountExists();

            /** @var TransactionRecordExchangeRefRewardRepository $repo */
            $repo = db()->getRepository(TransactionRecordExchangeRefReward::class);
            $this->exchangeReceiptList = $repo->findAllPaginatedByAccount(
                $this->account,
                $itemsToLoad,
                $firstItem
            );


            $value = TransactionRecordExchangeRefReward::normalizeCollection(
                $this->exchangeReceiptList, ['entity', 'reward', 'timestampable']
            );
            return ApiResponseBag::success($value);
        }, false);
    }

    public function selectAllTransactions() {
        return $this->execute(function () {
            $itemsToLoad = $this->getValue('itemsToLoad');
            $firstItem = $this->getValue('firstItem');
            $type = $this->getValue('type');

            $this->verifyAccountExists();

            /** @var TransactionRecordRepository $repo */
            $repo = db()->getRepository($this->entityName);

            $this->transactionRecordList = $repo->findAllByAccount(
                $this->account,
                $itemsToLoad,
                $firstItem,
                $type
            );

            $value = TransactionRecord::normalizeCollection(
                $this->transactionRecordList, ['entity', 'company_branch']
            );
            return ApiResponseBag::success($value);
        }, false);
    }

    public function selectPointsSum() {
        return $this->execute(function () {

            $this->verifyAccountExists();

            /** @var TransactionRecordRepository $repo */
            $repo = db()->getRepository($this->entityName);

            $accountPointsSum = $repo->findPointsSumByAccount($this->account);
            $floatPointsSum = (float)$accountPointsSum['sum'];

            return ApiResponseBag::success($floatPointsSum);
        }, false);
    }

    private function verifyAccountExists() {
        $accountId = $this->getValue('accountId');

        $this->account = Account::ref($accountId);

        if (empty($this->account)) {
            throw new NotFoundHttpException('Conta não encontrada');
        }
    }

    public function create()
    {
        // TODO: Implement create() method.
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }
}
