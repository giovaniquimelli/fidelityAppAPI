<?php


namespace App\Controller\Desktop;


use App\Controller\BaseController;
use App\Model\Account\AccountModel;
use App\Model\Product\ProductModel;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ConfigController
 * @Route(path="/api/desktop/licence")
 */
class ConfigController extends BaseController
{
    /**
     * @Route(path="/list", methods={"GET", "OPTIONS"})
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request): JsonResponse
    {
        $data = $this->getData($request, func_get_args(), __FUNCTION__);

        return (new AccountModel($data))->selectMany();
    }
}