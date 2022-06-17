<?php


namespace App\Controller\Mobile\TransactionRecord;


use App\Controller\BaseController;
use App\Model\Account\AccountModel;
use App\Model\Person\PersonModel;
use App\Model\Reward\RewardModel;
use App\Model\TransactionRecord\TransactionRecordModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TransactionRecordController
 * @package App\Controller\Mobile\TransactionRecord
 * @Route(path="/api/mobile/transactionrecord")
 */
class TransactionRecordController extends BaseController
{
    /**
     * @Route(path="/exchangereceipts/get", methods={"POST", "OPTIONS"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getExchangeRecepits(Request $request): JsonResponse
    {
        $data = getRequestData(__CLASS__, __FUNCTION__, $request, func_get_args());

        $transactionRecord = new TransactionRecordModel($data);
        return $transactionRecord->selectAllExchangeReceipts();
    }

    /**
     * @Route(path="/alltransactionrecords/get", methods={"POST", "OPTIONS"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getAllTransactionRecords(Request $request): JsonResponse
    {
        $data = getRequestData(__CLASS__, __FUNCTION__, $request, func_get_args());

        $transactionRecord = new TransactionRecordModel($data);
        return $transactionRecord->selectAllTransactions();
    }

    /**
     * @Route(path="/pointssum/get", methods={"POST", "OPTIONS"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getPointsSum(Request $request): JsonResponse
    {
        $data = getRequestData(__CLASS__, __FUNCTION__, $request, func_get_args());

        $transactionRecord = new TransactionRecordModel($data);
        return $transactionRecord->selectPointsSum();
    }
}

