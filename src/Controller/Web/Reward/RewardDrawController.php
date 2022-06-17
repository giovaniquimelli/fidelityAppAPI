<?php

namespace App\Controller\Web\Reward;

use App\Controller\BaseController;
use App\Model\Reward\RewardModel;
use App\Util\RewardTypes;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RewardDrawController
 * @Route(path="/api/web/reward/draw")
 */
class RewardDrawController extends BaseController
{
    /**
     * @Route(path="/list", methods={"GET", "OPTIONS"})
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request): JsonResponse
    {
        $data = $this->getData($request, func_get_args(), __FUNCTION__);

        return (new RewardModel($data))->selectMany(RewardTypes::DRAW);
    }

    /**
     * @Route(path="/get", methods={"POST", "OPTIONS"})
     * @param Request $request
     * @return JsonResponse
     */
    public function selectOne(Request $request): JsonResponse
    {
        $data = $this->getData($request, func_get_args(), __FUNCTION__);

        return (new RewardModel($data))->selectOne();
    }

    /**
     * @Route(path="/create", methods={"POST", "OPTIONS"})
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $data = $this->getData($request, func_get_args(), __FUNCTION__);

        return (new RewardModel($data))->create();
    }

    /**
     * @Route(path="/update", methods={"POST", "OPTIONS"})
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $data = $this->getData($request, func_get_args(), __FUNCTION__);

        return (new RewardModel($data))->update();
    }

    /**
     * @Route(path="/delete", methods={"POST", "OPTIONS"})
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(Request $request): JsonResponse
    {
        $data = $this->getData($request, func_get_args(), __FUNCTION__);

        return (new RewardModel($data))->delete();
    }
}
