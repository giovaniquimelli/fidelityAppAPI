<?php


namespace App\Security;


use App\Entity\Fidelity\Users;
use App\Entity\Fidelity\UsersAuthToken;
use App\Util\Container\ContainerService;
use App\Util\Container\TokenGuard;
use DateInterval;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class LoginFormWebAuthenticator extends AbstractFormLoginAuthenticator
{
    use TargetPathTrait;

    private const LOGIN_ROUTE = 'app_auth_login';

    /** @var EntityManager */
    private $entityManager;
    private UrlGeneratorInterface $urlGenerator;
    private CsrfTokenManagerInterface $csrfTokenManager;
    private UserPasswordEncoderInterface $passwordEncoder;

    private ?UsersAuthToken $session = null;

    public function __construct(EntityManagerInterface $entityManager, UrlGeneratorInterface $urlGenerator, CsrfTokenManagerInterface $csrfTokenManager, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->entityManager = $entityManager;
        $this->urlGenerator = $urlGenerator;
        $this->csrfTokenManager = $csrfTokenManager;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * Does the authenticator support the given Request?
     *
     * If this returns false, the authenticator will be skipped.
     *
     * @param Request $request
     *
     * @return bool
     */
    public function supports(Request $request): bool
    {
        //if ($request->attributes->get('_route') === 'app_auth_login' && $request->isMethod('GET')) {
        //    return false;
        //}
        //if($request->attributes->get('_route') === 'app_auth_login' && $request->isMethod('POST')) {
        //    dd('faz a porra do login', $request->getMethod());
        //}
        //dd($request->attributes->get('_route'));
        // dd($request->attributes->get('_route') === 'app_auth_login' && $request->isMethod('POST'));
        return $request->attributes->get('_route') === 'app_auth_login' && $request->isMethod('POST');
        //return true;
    }

    /**
     * Get the authentication credentials from the request and return them
     * as any type (e.g. an associate array).
     *
     * Whatever value you return here will be passed to getUser() and checkCredentials()
     *
     * For example, for a form login, you might:
     *
     *      return [
     *          'username' => $request->request->get('_username'),
     *          'password' => $request->request->get('_password'),
     *      ];
     *
     * Or for an API token that's on a header, you might use:
     *
     *      return ['api_key' => $request->headers->get('X-API-TOKEN')];
     *
     * @param Request $request
     *
     * @return mixed Any non-null value
     *
     * @throws \UnexpectedValueException If null is returned
     */
    public function getCredentials(Request $request)
    {

        $token = TokenGuard::token();

        if($token !== null && $token->isAuthenticated()) {
            $user = $token->getUser();
            return [
                'authenticated' => true,
                'email' => $user->getEmail(),
                'password' => $user->getPassword(),
                // 'csrf_token' => $request->request->get('_csrf_token'),
            ];
        }

        $credentials = [
            'authenticated' => false,
            'email' => $request->request->get('_email'),
            'password' => $request->request->get('_password'),
            'csrf_token' => $request->request->get('_csrf_token'),
        ];

        $request->getSession()->set(
            Security::LAST_USERNAME,
            $credentials['email']
        );
        return $credentials;
//        //dd(TokenGuard::token());
//        return ['api_key'=>'123'];
//        // Get token on the Authorization header
//        $authorization = $request->headers->get('Authorization');
//        if ($authorization !== null) {
//            if (preg_match('/Bearer\s(\S+)/', $authorization, $matches)) {
//                return ['api_key' => $matches[1]];
//            } else {
//                return ['api_key' => $authorization];
//            }
//        }

        // TODO: Check the use requirement for Cookies
        // Get token on the Cookie
        // $cookie = $request->cookies->get('__SESSID');
        // if ($cookie !== null) {
        //     return ['api_key' => $cookie];
        // }

        // Fail
        //return false;
    }

    /**
     * Return a UserInterface object based on the credentials.
     *
     * The *credentials* are the return value from getCredentials()
     *
     * You may throw an AuthenticationException if you wish. If you return
     * null, then a UsernameNotFoundException is thrown for you.
     *
     * @param mixed $credentials
     * @param UserProviderInterface $userProvider
     *
     * @return UserInterface|null
     * @throws AuthenticationException
     *
     */
    public function getUser($credentials, UserProviderInterface $userProvider): ?UserInterface
    {
        // dd($credentials);
        $token = TokenGuard::token();
        if($token !== null && $token->isAuthenticated()) {
            return $token->getUser();
        }


        $token = new CsrfToken('authenticate', $credentials['csrf_token']);
        //dd($this->csrfTokenManager->getToken('authenticate'), $token);
        //dd($token, $credentials, $this->csrfTokenManager->isTokenValid($token));
        if (!$this->csrfTokenManager->isTokenValid($token)) {
            throw new InvalidCsrfTokenException();
        }

//        // TODO: get user from REDIS cache
//        // Fail if api_key is empty
//        if(empty($credentials['api_key'])){
//            return null;
//        }

        /** @var UsersAuthToken|null $session */

        //$rep = $this->entityManager->getRepository(UsersAuthToken::class);
        $rep = $this->entityManager->getRepository(Users::class);
        $session = $rep->findOneBy(['email'=>$credentials]);
        //$session = $rep->find('00000000-0000-0000-0000-000000000001'); //$rep->findOneByToken($credentials['api_key']);

        // dd($session);
        if($session === null){
            return null;
        }

        //$this->session = $session;
        return $session;
        //return new Users();
    }

    /**
     * Returns true if the credentials are valid.
     *
     * If any value other than true is returned, authentication will
     * fail. You may also throw an AuthenticationException if you wish
     * to cause authentication to fail.
     *
     * The *credentials* are the return value from getCredentials()
     *
     * @param mixed $credentials
     * @param UserInterface $user
     *
     * @return bool
     *
     * @throws AuthenticationException
     */
    public function checkCredentials($credentials, UserInterface $user): bool
    {
        //$password = $this->passwordEncoder->encodePassword(new Users(), '123456');
        //$user->setPassword($password);
        //dd('something weird', $user, $this->passwordEncoder->isPasswordValid($user, '123456'), $credentials);
//        $is_valid = false;
//        try {
//            $is_valid = $this->passwordEncoder->isPasswordValid($user, $credentials['password']);
//        } catch (\Exception $ex) {
//
//        }
        // dd('checkCredentials', $credentials, $user, $this->passwordEncoder->isPasswordValid($user, $credentials['password']));

        if($credentials['authenticated'] === false) {
            return $this->passwordEncoder->isPasswordValid($user, $credentials['password']);
        }
        return true;
    }

    /**
     * Called when authentication executed, but failed (e.g. wrong username password).
     *
     * This should return the Response sent back to the user, like a
     * RedirectResponse to the login page or a 403 response.
     *
     * If you return null, the request will continue, but the user will
     * not be authenticated. This is probably not what you want to do.
     *
     * @param Request $request
     * @param AuthenticationException $exception
     *
     * @return Response|null
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        //dd("erro ao autenticar");
        // $token->setAuthenticated(true);
        // TODO: Implement onAuthenticationFailure() method.
        // dd("deu erro?", $exception);
        if($this->isJsonRequest($request)) {
            return new JsonResponse(['error'=>$exception->getMessage()], 401);
        }
        return null;
    }

    private function isJsonRequest(Request $request): bool
    {
        return $request->isXmlHttpRequest() || in_array('application/json', $request->getAcceptableContentTypes(), true);
    }

    /**
     * Called when authentication executed and was successful!
     *
     * This should return the Response sent back to the user, like a
     * RedirectResponse to the last page they visited.
     *
     * If you return null, the current request will continue, and the user
     * will be authenticated. This makes sense, for example, with an API.
     *
     * @param Request $request
     * @param TokenInterface $token
     * @param string $providerKey The provider (i.e. firewall) key
     *
     * @return RedirectResponse
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws \Exception
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        if ($targetPath = $this->getTargetPath($request->getSession(), $providerKey)) {
            return new RedirectResponse($targetPath);
        }
        //$token->setAuthenticated(true);
        // dd($token);
        //$token->setAuthenticated(true);
        // TODO: update token on REDIS cache
//        $api_key = $this->getCredentials($request)['api_key'];
//        $token->setAttribute(container_param_get('web.token_guard.token'), $api_key);
//
//        // Update session timeout
//        $this->session->setExpiresAt((new DateTime())->add(new \DateInterval('PT'. ContainerService::param('web.auth_token.timeout') .'M')));
//        $this->session->setSysWebAdmin();
//        $this->entityManager->flush($this->session);
    }


    /**
     * Does this method support remember me cookies?
     *
     * Remember me cookie will be set if *all* of the following are met:
     *  A) This method returns true
     *  B) The remember_me key under your firewall is configured
     *  C) The "remember me" functionality is activated. This is usually
     *      done by having a _remember_me checkbox in your form, but
     *      can be configured by the "always_remember_me" and "remember_me_parameter"
     *      parameters under the "remember_me" firewall key
     *  D) The onAuthenticationSuccess method returns a Response object
     *
     * @return bool
     */
    public function supportsRememberMe(): bool
    {
        return true;
    }

    /**
     * Returns a response that directs the user to authenticate.
     *
     * This is called when an anonymous request accesses a resource that
     * requires authentication. The job of this method is to return some
     * response that "helps" the user start into the authentication process.
     *
     * Examples:
     *
     * - For a form login, you might redirect to the login page
     *
     *     return new RedirectResponse('/login');
     *
     * - For an API token authentication system, you return a 401 response
     *
     *     return new Response('Auth header required', 401);
     *
     * @param Request $request The request that resulted in an AuthenticationException
     * @param AuthenticationException $authException The exception that started the authentication process
     *
     * @return Response
     */
    public function start(Request $request, AuthenticationException $authException = null)
    {
        if($this->isJsonRequest($request)) {
            return JsonResponse::create(['error'=>'auth required'], 401);
        }
        // only in debug mode
        if($request->getMethod() === "OPTIONS") {
            return new Response('ok', 200);
        }
        // verify de Content-Type and send JSON or View with the link to Login
        return new RedirectResponse('/app/auth/login');
    }

    /**
     * @inheritDoc
     */
    protected function getLoginUrl(): string
    {
        // TODO: Implement getLoginUrl() method.
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }
}
