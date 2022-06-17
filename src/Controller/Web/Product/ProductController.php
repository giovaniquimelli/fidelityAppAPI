<?php

namespace App\Controller\Web\Product;

use App\Controller\BaseController;
use App\Model\Building\BuildingModel;
use App\Model\Product\ProductModel;
use Doctrine\ORM\Query\Expr\Base;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ProductController
 * @Route(path="/api/web/product")
 */
class ProductController extends BaseController
{
    /**
     * @Route(path="/list", methods={"GET", "OPTIONS"})
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request): JsonResponse
    {
        $data = $this->getData($request, func_get_args(), __FUNCTION__);

        return (new ProductModel($data))->selectMany();
    }

    /**
     * @Route(path="/get", methods={"POST", "OPTIONS"})
     * @param Request $request
     * @return JsonResponse
     */
    public function selectOne(Request $request): JsonResponse
    {
        $data = $this->getData($request, func_get_args(), __FUNCTION__);

        return (new ProductModel($data))->selectOne();
    }

    /**
     * @Route(path="/create", methods={"POST", "OPTIONS"})
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $data = $this->getData($request, func_get_args(), __FUNCTION__);

        return (new ProductModel($data))->create();
    }

    /**
     * @Route(path="/update", methods={"POST", "OPTIONS"})
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $data = $this->getData($request, func_get_args(), __FUNCTION__);

        return (new ProductModel($data))->update();
    }

    /**
     * @Route(path="/delete", methods={"POST", "OPTIONS"})
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(Request $request): JsonResponse
    {
        $data = $this->getData($request, func_get_args(), __FUNCTION__);

        return (new ProductModel($data))->delete();
    }
}
