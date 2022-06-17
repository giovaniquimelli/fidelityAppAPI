<?php

namespace App\Controller\Web\Users;

use App\Controller\BaseController;
use App\Model\Users\UsersModel;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UsersController
 * @package App\Controller\Web\Users
 * @Route(path="/api/web/users")
 */
class UsersController extends BaseController
{
    /**
     * @Route(path="/list", methods={"GET", "OPTIONS"})
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request): JsonResponse
    {
        $data = $this->getData($request, func_get_args(), __FUNCTION__);

        return (new UsersModel($data))->selectMany();
    }

    /**
     * @Route(path="/get", methods={"POST", "OPTIONS"})
     * @param Request $request
     * @return JsonResponse
     */
    public function selectOne(Request $request): JsonResponse
    {
        $data = $this->getData($request, func_get_args(), __FUNCTION__);

        return (new UsersModel($data))->selectOne();
    }

    /**
     * @Route(path="/create", methods={"POST", "OPTIONS"})
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $data = $this->getData($request, func_get_args(), __FUNCTION__);

        return (new UsersModel($data))->create();
    }

    /**
     * @Route(path="/update", methods={"POST", "OPTIONS"})
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $data = $this->getData($request, func_get_args(), __FUNCTION__);

        return (new UsersModel($data))->update();
    }

    /**
     * @Route(path="/delete", methods={"POST", "OPTIONS"})
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(Request $request): JsonResponse
    {
        $data = $this->getData($request, func_get_args(), __FUNCTION__);

        return (new UsersModel($data))->delete();
    }
}
