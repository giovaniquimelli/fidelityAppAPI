<?php


namespace App\Controller\Mobile\Reward;


use App\Controller\BaseController;
use App\Model\Account\AccountModel;
use App\Model\Person\PersonModel;
use App\Model\Reward\RewardModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RewardController
 * @package App\Controller\Mobile\Reward
 * @Route(path="/api/mobile/reward")
 */
class RewardController extends BaseController
{
    /**
     * @Route(path="/allmobilerewards/get", methods={"POST", "OPTIONS"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getAllMobileRewards(Request $request): JsonResponse
    {
        $data = getRequestData(__CLASS__, __FUNCTION__, $request, func_get_args());

        $account = new RewardModel($data);
        return $account->selectAllMobile();
    }

    /**
     * @Route(path="/allbranchesbyreward/get", methods={"POST", "OPTIONS"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getAllBranchesByReward(Request $request): JsonResponse
    {
        $data = getRequestData(__CLASS__, __FUNCTION__, $request, func_get_args());

        $account = new RewardModel($data);
        return $account->selectAllBranchesByReward();
    }

    /**
     * @Route(path="/exchange/make", methods={"POST", "OPTIONS"})
     * @param Request $request
     * @return JsonResponse
     */
    public function makeExchange(Request $request): JsonResponse
    {
        $data = getRequestData(__CLASS__, __FUNCTION__, $request, func_get_args());

        $account = new RewardModel($data);
        return $account->MakeExchange();
    }
}

