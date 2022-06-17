<?php


namespace App\Model;


use App\DTO\UsersAuthenticationDTO;
use App\Entity\Users;
use App\Entity\UsersAuthToken;
use App\Exception\ApiException;
use App\Exception\UnauthorizedException;
use App\Repository\UsersRepository;
use App\Util\ApiResponseBag;
use Doctrine\Common\Annotations\AnnotationException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

class UsersAuthenticationModel
{
    /** @var UsersAuthenticationDTO */
    private $auth;
    /**
     * @var UsersRepository
     */
    private $usersRepository;
    /**
     * @var Users
     */
    private $users;

    /**
     * @var
     */
    private $payload;

    /**
     * @var UsersAuthToken
     */
    private $token;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct()
    {
        $this->auth = new UsersAuthenticationDTO();
        $this->users = new Users();
        $this->token = new UsersAuthToken();
    }

    public function login(string $payload): Response
    {
        $response = null;

        try {
            $this->payload = $payload;
            $this->deserialize();
            $this->isValidPayload();
            $this->findUser();
            $this->validatePassword();
            $this->invalidateLogins();
            $this->generateToken();
            $response = $this->generateResponse();
        } catch (ApiException $ex) {
            $response = ApiResponseBag::fail($ex)->getResponse();
        } catch (\Throwable $exc) {
            $response = ApiResponseBag::unknownError($exc)->getResponse();
        }

        return $response;
    }

    private function deserialize(array $group = ['write']): void
    {
        $this->auth = container_serializer_deserialize(
            $this->payload,
            UsersAuthenticationDTO::class,
            $group
        );
    }

    private function isValidPayload(array $group = ['write']): void
    {
        $errors = container_validator_validate($this->auth, $group);
        if ($errors->count()) {
            $this->invalidCredentials();
        }
    }

    private function invalidCredentials(): void
    {
        throw new UnauthorizedException(401, 'Invalid Credentials');

    }

    private function findUser(): void
    {
        $rep = container_entity_manager()->getRepository(Users::class);
        $this->users = $rep->findOneByEmail($this->auth->getUsername());

        if ($this->users === null) {
            $this->invalidCredentials();
        }
    }

    private function validatePassword(): void
    {
        /** @var UserPasswordEncoder $encoder */
        $encoder = container('security.password_encoder');
        if (!$encoder->isPasswordValid($this->users, $this->auth->getPassword())) {
            $this->invalidCredentials();
        }
    }

    private function invalidateLogins(): void
    {

    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    private function generateToken(): void
    {
        $this->token = new UsersAuthToken();
        $this->token->setUsers($this->users);
        $this->token->setMainRole('ROLE_ADMIN');
        $this->token->setRolesJson(json_encode(['roles' => ['ROLE_ADMIN']]));
        $this->token->setToken(bin2hex(random_bytes(32)));
        $this->token->setPayload('##');
        $this->token->setExpiresAt(date_add(new \DateTime(), new \DateInterval('PT60M')));
        $this->token->setIpAddress($_SERVER['REMOTE_ADDR']);
        $this->token->setUserAgent($_SERVER['HTTP_USER_AGENT']);
        $this->token->setSysWebAdmin();

        container_entity_manager()->persist($this->token);
        container_entity_manager()->flush();


        $this->getCurrentToken();
    }

    private function getCurrentToken(): void
    {
        $this->auth->setToken($this->token->getToken());
        $this->auth->setGuid($this->token->getId());
        $this->auth->setFullName($this->token->getUsers()->getReducedName());
        $this->auth->setUsername($this->token->getUsers()->getUsername());
    }

    /**
     * @param array $group
     * @param int $code
     * @return JsonResponse|Response
     * @throws AnnotationException
     * @throws ExceptionInterface
     * @throws \ReflectionException
     */
    private function generateResponse(array $group = ['read'], $code = 201)
    {
        return ApiResponseBag::created($this->auth, $group)
            ->setMessage('Successfully authenticated.')
            ->setStatusCode($code)
            ->getResponse();
    }

    public function checkLogin(string $payload): Response
    {
        $response = null;
        try {
            $this->payload = $payload;
            $this->deserialize(['check']);
            $this->isValidPayload(['check']);
            $this->findToken();
            $this->getCurrentToken();
            $response = $this->generateResponse(['check'], 200);
        } catch (ApiException $ex) {
            $response = ApiResponseBag::fail($ex)->getResponse();
        }
        return $response;
    }

    private function findToken(): void
    {
        $rep = container_entity_manager()->getRepository(UsersAuthToken::class);
        $uat = $rep->findOneByToken($this->auth->getToken());

        if ($uat === null) {
            $this->invalidCredentials();
        }
        $this->token = $uat;
    }

    /**
     * @return Cookie
     */
    private function generateCookie(): Cookie
    {
        $s = Cookie::create(container_param_get('web.cookie_name'), $this->token->getToken(), 0, '/');
        // $s->setSecureDefault(true);

        return $s;
    }
}
