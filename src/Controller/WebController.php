<?php

namespace App\Controller;

use App\Model\Account\AccountQuickRegistrationModel;
use App\Util\Container\ContainerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class WebController extends AbstractController
{
    /**
     * @param Request $request
     * @Route(path="/teste", name="teste")
     */
    public function teste(Request $request)
    {
//        $t = new AccountQuickRegistrationModel([]);

        $data = getRequestData(__CLASS__, __FUNCTION__, $request, func_get_args());

//        $registration = new AccountQuickRegistrationModel([]);
        $registration = new AccountQuickRegistrationModel($data);
        return $registration->selectOne();
    }

    /**
     * @Route(path="/app/auth/login", name="app_auth_login")
     * @param Request $request
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser() !== null) {
            return new RedirectResponse('/app');
        }
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

    /**
     * @Route(path="/app/auth/check", methods={"POST"})
     * @param Request $request
     */
    public function checkToken(Request $request) {
        return $this->json(['ok'=>'ok']);
    }
    public function vueApp(Request $request): Response
    {
        return $this->render('app.html.twig', [
            'variavel' => 'usuario logado'
        ]);
    }

    public function jsFiles(Request $request)
    {
        return new RedirectResponse('https://localhost:8080'.$request->getRequestUri(), 301);
    }

    public function cssFiles(Request $request)
    {
        return new RedirectResponse('https://localhost:8080'.$request->getRequestUri(), 301);
    }

    public function imgFiles(Request $request)
    {
        return new RedirectResponse('https://localhost:8080'.$request->getRequestUri(), 301);
    }

    /**
     * @Route(path="{hash}.hot-update.json")
     * @param Request $request
     * @return RedirectResponse
     */
    public function hotUpdateJson(Request $request) {
        return new RedirectResponse('https://localhost:8080'.$request->getRequestUri(), 301);

    }

    /**
     * @Route(path="{file}.{hash}.hot-update.js")
     * @param Request $request
     * @return RedirectResponse
     */
    public function hotUpdateJs(Request $request) {
        return new RedirectResponse('https://localhost:8080'.$request->getRequestUri(), 301);

    }
}
