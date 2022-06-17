<?php


namespace App\Controller\Web\Account;


use App\Controller\BaseController;
use App\Model\Account\AccountModel;
use App\Model\Product\ProductModel;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AccountController
 * @Route(path="/api/web/account")
 */
class AccountController extends BaseController
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
