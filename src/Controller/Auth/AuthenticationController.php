<?php


namespace App\Controller\Auth;

use App\Controller\BaseController;
use App\Model\Account\AccountQuickRegistrationModel;
use App\Model\UsersAuthenticationModel;
use App\Model\Account\AccountAuthenticationModel;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

/**
 * Class AuthenticationController
 * @package App\Controller\Auth
 *
 */
class AuthenticationController extends BaseController
{
    /**
     * @Route(path="/api/web/auth/login", methods={"POST"})
     *
     * @param Request $request
     * @return Response
     */
    public function login(Request $request): Response
    {
        $usersAuthentication = new UsersAuthenticationModel();

        return $usersAuthentication->login($request->getContent());
    }

    /**
     * @Route(path="/api/mobile/account/auth/create", methods={"POST", "OPTIONS"})
     * @param Request $request
     * @return Response
     * @return JsonResponse
     */
    public function createMobileAccount(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
//        $data = getRequestData(__CLASS__, __FUNCTION__, $request, func_get_args());
//        $data = $this->getData($request, func_get_args(), __FUNCTION__);
//        $accountRegistration = new AccountQuickRegistrationModel($data['accountId']);
        $accountRegistration = new AccountQuickRegistrationModel($data);

        return $accountRegistration->create();
    }

    /**
     * @Route(path="/api/mobile/account/auth/get", methods={"GET", "OPTIONS"})
     * @param Request $request
     * @return Response
     * @return JsonResponse
     */
    public function getMobileAccount(Request $request): Response
    {
          $data = json_decode($request->getContent(), true);
//        $data = getRequestData(__CLASS__, __FUNCTION__, $request, func_get_args());
//        $data = $this->getData($request, func_get_args(), __FUNCTION__);
//        $accountRegistration = new AccountQuickRegistrationModel($data['accountId']);
        $accountRegistration = new AccountQuickRegistrationModel($data);

        return $accountRegistration->selectOne();
    }

    /**
     * @Route(path="/api/mobile/account/auth/edit", methods={"POST", "OPTIONS"})
     * @param Request $request
     * @return Response
     * @return JsonResponse
     */
    public function editMobileAccount(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
//        $data = getRequestData(__CLASS__, __FUNCTION__, $request, func_get_args());
//        $data = $this->getData($request, func_get_args(), __FUNCTION__);
//        $accountRegistration = new AccountQuickRegistrationModel($data['accountId']);
        $accountRegistration = new AccountQuickRegistrationModel($data);

        return $accountRegistration->update();
    }

    /**
     * @Route(path="/api/mobile/account/auth/login", methods={"POST"})
     * @param Request $request
     * @return Response
     * @throws ExceptionInterface
     * @throws NonUniqueResultException
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function loginMobileAccount(Request $request): Response
    {
        $accountAuthentication = new AccountAuthenticationModel($request);

        return $accountAuthentication->login($request->getContent());
    }

    /**
     * @Route(path="/api/web/auth/check", methods={"POST","OPTIONS"})
     * @param Request $request
     * @return Response
     */
    public function checkToken(Request $request): Response
    {
        if($request->getMethod() === 'OPTIONS') {
            return Response::create('ok', 200);
        }

        $usersAuthentication = new UsersAuthenticationModel();
        return $usersAuthentication->checkLogin($request->getContent());
    }
}
