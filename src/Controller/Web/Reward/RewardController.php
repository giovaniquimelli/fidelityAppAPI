<?php

namespace App\Controller\Web\Reward;

use App\Controller\BaseController;
use App\Model\Reward\RewardModel;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RewardController
 * @Route(path="/api/web/reward")
 */
class RewardController extends BaseController
{
    /**
     * @Route(path="/list", methods={"GET", "OPTIONS"})
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request): JsonResponse
    {
        $data = $this->getData($request, func_get_args(), __FUNCTION__);

        return (new RewardModel($data))->selectMany();
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
