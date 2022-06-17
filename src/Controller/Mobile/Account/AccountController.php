<?php


namespace App\Controller\Mobile\Account;


use App\Controller\BaseController;
use App\Model\Account\AccountModel;
use App\Model\Person\PersonModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AccountController
 * @package App\Controller\Mobile\Account
 * @Route(path="/api/mobile/account")
 */
class AccountController extends BaseController
{
    /**
     * @Route(path="/accountData/edit", methods={"POST", "OPTIONS"})
     * @param Request $request
     * @return JsonResponse
     */
    public function editAccountData(Request $request): JsonResponse
    {
        $data = getRequestData(__CLASS__, __FUNCTION__, $request, func_get_args());

        $account = new AccountModel($data);
        return $account->editAccountData();
    }

    /**
     * @Route(path="/allaccounts/get", methods={"POST", "OPTIONS"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getAllAccounts(Request $request): JsonResponse
    {
        $data = getRequestData(__CLASS__, __FUNCTION__, $request, func_get_args());

        $account = new AccountModel($data);
        return $account->getAllAccounts();
    }

    /**
     * @Route(path="/accountvehicle/add", methods={"POST", "OPTIONS"})
     * @param Request $request
     * @return JsonResponse
     */
    public function addAccountVehicle(Request $request): JsonResponse
    {
        $data = getRequestData(__CLASS__, __FUNCTION__, $request, func_get_args());

        $account = new AccountModel($data);
        return $account->addVehicle();
    }

    /**
     * @Route(path="/accountvehicle/edit", methods={"POST", "OPTIONS"})
     * @param Request $request
     * @return JsonResponse
     */
    public function editAccountVehicle(Request $request): JsonResponse
    {
        $data = getRequestData(__CLASS__, __FUNCTION__, $request, func_get_args());

        $account = new AccountModel($data);
        return $account->editVehicle();
    }

    /**
     * @Route(path="/allaccountvehicles/get", methods={"POST", "OPTIONS"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getAllAccountVehicles(Request $request): JsonResponse
    {
        $data = getRequestData(__CLASS__, __FUNCTION__, $request, func_get_args());

        $account = new AccountModel($data);
        return $account->getAllVehicles();
    }

    /**
     * @Route(path="/allaccountcodes/get", methods={"POST", "OPTIONS"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getAllAccountCodes(Request $request): JsonResponse
    {
        $data = getRequestData(__CLASS__, __FUNCTION__, $request, func_get_args());

        $account = new AccountModel($data);
        return $account->getAllCodes();
    }

    /**
     * @Route(path="/allsubaccounts/get", methods={"POST", "OPTIONS"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getAllSubAccounts(Request $request): JsonResponse
    {
        $data = getRequestData(__CLASS__, __FUNCTION__, $request, func_get_args());

        $account = new AccountModel($data);
        return $account->getAllSubAccounts();
    }

    /**
     * @Route(path="/account/get", methods={"POST", "OPTIONS"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getAccount(Request $request): JsonResponse
    {
        $data = getRequestData(__CLASS__, __FUNCTION__, $request, func_get_args());

        $account = new AccountModel($data);
        return $account->getAccount();
    }

    /**
     * @Route(path="/subaccount/create", methods={"POST", "OPTIONS"})
     * @param Request $request
     * @return JsonResponse
     */
    public function createSubAccount(Request $request): JsonResponse
    {
        $data = getRequestData(__CLASS__, __FUNCTION__, $request, func_get_args());

        $account = new AccountModel($data);
        return $account->createSubAccount();
    }

    /**
     * @Route(path="/subaccount/cancel", methods={"POST", "OPTIONS"})
     * @param Request $request
     * @return JsonResponse
     */
    public function cancelSubAccount(Request $request): JsonResponse
    {
        $data = getRequestData(__CLASS__, __FUNCTION__, $request, func_get_args());

        $account = new AccountModel($data);
        return $account->cancelSubAccount();
    }
}

