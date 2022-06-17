<?php


namespace App\Model\Account;

use App\DTO\AccountAuthenticationDTO;
use App\Entity\Fidelity\MobileDevice;
use App\Entity\Fidelity\MobileDeviceRefAccount;
use App\Entity\Fidelity\Account;
use App\Entity\Fidelity\AccountAuthToken;
use App\Exception\ApiException;
use App\Exception\UnauthorizedException;
use App\Repository\AccountRepository;
use App\Util\ApiResponseBag;
use DateTime;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

/**
 * Class AccountAuthenticationModel
 * @package App\Model
 */
class AccountAuthenticationModel
{
    /** @var AccountAuthenticationDTO */
    private AccountAuthenticationDTO $auth;
    /**
     * @var AccountRepository
     */
    private AccountRepository $accountRepository;
    /**
     * @var Account
     */
    private Account $account;

    /**
     * @var
     */
    private $payload;

    /**
     * @var AccountAuthToken
     */
    private AccountAuthToken $token;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;
    /**
     * @var Request
     */
    private $request;
    /**
     * @var MobileDevice
     */
    private MobileDevice $mobileDevice;

    /**
     * AccountAuthenticationModel constructor.
//     * @param AccountAuthenticationDTO $auth
//     * @param AccountRepository $accountRepository
//     * @param Account $account
//     * @param AccountAuthToken $token
//     * @param UserPasswordEncoderInterface $encoder
     * @param Request $request
     */
    public function __construct(Request $request)
    {
//        $this->auth = $auth;
//        $this->accountRepository = $accountRepository;
//        $this->account = $account;
//        $this->token = $token;

        $this->auth = new AccountAuthenticationDTO();
//        $this->users = new Account();
        $this->token = new AccountAuthToken();
        $this->encoder = container('security.password_encoder');
        $this->request = $request;
    }

    /**
     * @param string $payload
     * @return Response
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws ExceptionInterface
     */
    public function login(string $payload): Response
    {
        $response = null;
        try {
            $this->payload = $payload;
            $this->deserialize();
            $this->isValidPayload();
            $this->registerMobileDevice();
            $this->findUser();
            $this->validatePassword();
            $this->registerMobileDeviceRefAccount();
            // if invalidate outher logins
            $this->invalidateLogins();
            $this->generateToken();
            $this->getAccountGuid();
            $response = $this->generateResponse();
        } catch (ApiException $ex) {
            $response = ApiResponseBag::fail($ex)->getResponse();
        }

        return $response;
    }

    /**
     *
     */
    public function deserialize(): void
    {
        $this->auth = container_serializer_deserialize(
            $this->payload,
            AccountAuthenticationDTO::class,
            ['write']
        );
    }

    /**
     * @throws UnauthorizedException
     */
    public function isValidPayload(): void
    {
        $errors = container_validator_validate($this->auth, ['write']);

        if ($errors->count()) {
            $this->invalidCredentials();
        }
    }

    /**
     * @throws UnauthorizedException
     */
    public function invalidCredentials(): void
    {
        throw new UnauthorizedException(401, 'Invalid Credentials');
    }

    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws UnauthorizedException
     */
    public function findUser(): void
    {
        $this->accountRepository = db()->getRepository(Account::class);
        $this->account = $this->accountRepository->findOneByUsername($this->auth->getUsername());

        if ($this->account === null) {
            $this->invalidCredentials();
        }
    }

    /**
     * @throws UnauthorizedException
     */
    public function validatePassword(): void
    {
        $repo = db()->getRepository(AccountAuthToken::class);
        $qb = $repo->createQueryBuilder('aat')
            ->andWhere('aat.account = :account')
            ->setParameter('account', $this->account)
            ->orderBy('aat.createdAt', 'DESC')
            ->setMaxResults(1);
        $result = $qb->getQuery()->getOneOrNullResult();

        // Authenticate if it's the first login
        if ($result === null) {
            return;
        }
        $lastUserToken = $result->getToken();

        // authenticate if user's token is equal to the one sent with request
        if ($this->auth->getToken() !== null) {
            if ($this->auth->getToken() === $lastUserToken) {
                return;
            } else {
                $this->invalidCredentials();
            }
        }

        if (!$this->encoder->isPasswordValid($this->account, $this->auth->getPassword())) {
            $this->invalidCredentials();
        }
    }

    /**
     *
     */
    public function invalidateLogins(): void
    {

    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function generateToken(): void
    {
        $this->token = new AccountAuthToken();
        $this->token->setAccount($this->account);
        $this->token->setMainRole('ROLE_ACCOUNT');
        $this->token->setRolesJson(json_encode(['roles' => ['ROLE_ACCOUNT']]));
        $this->token->setToken(bin2hex(random_bytes(32)));
        $this->token->setPayload('##');
        $this->token->setExpiresAt(date_add(new \DateTime(), new \DateInterval('P' . container_param_get('mobile.account.auth_token.timeout') . 'D')));
        $this->token->setIpAddress($_SERVER['REMOTE_ADDR']);
        $this->token->setUserAgent($_SERVER['HTTP_USER_AGENT']);
        $this->token->setSysAdmin();

        container_entity_manager()->persist($this->token);
        container_entity_manager()->flush();

        $this->auth->setToken($this->token->getToken());
//        $this->auth->setGuid($this->token->getGuid());
        $this->auth->setFullName($this->account->getFullName());
        $this->auth->setLegalName($this->account->getLegalName());

    }

    /**
     * @return ApiResponseBag|\Symfony\Component\HttpFoundation\JsonResponse
     * @throws ExceptionInterface
     */
    public function generateResponse()
    {
        return ApiResponseBag::created($this->auth, ['default'])
            ->setMessage('Successfully authenticated.')
            ->getResponse();
    }

    private function registerMobileDevice(): void
    {
        $headerMobileDevice = $this->request->headers->get('Mobile-Info');

        // dd(json_decode($headerMobileDevice));

        /** @var MobileDevice $obj */
        $obj = container_serializer_deserialize(
            $headerMobileDevice,
            MobileDevice::class,
            ['write']
        );

        $repo = container_entity_manager()->getRepository(MobileDevice::class);
        /** @var MobileDevice $db */
        $db = $repo->findOneByDeviceId($obj->getDeviceId());
        if ($db === null) {
//            $obj->setGuid(Uuid::uuid4());
            $obj->setSysMobile();
            container_entity_manager()->persist($obj);
            container_entity_manager()->flush();
            $this->mobileDevice = $obj;
        } else {

//            container_serializer_deserialize(
//                $headerMobileDevice,
//                MobileDevice::class,
//                ['write'],
//                'json',
//                [AbstractNormalizer::OBJECT_TO_POPULATE => $db]
//            );
//
//            container_entity_manager()->flush($db);
            $db->setSysMobile();
            $this->mobileDevice = $db;
        }
    }

    private function registerMobileDeviceRefAccount()
    {
        $repo = container_entity_manager()->getRepository(MobileDeviceRefAccount::class);
        /** @var MobileDeviceRefAccount $ob */
        $ob = $repo->findOneByDeviceIdAndAccountId($this->mobileDevice->getId(), $this->account->getId());

        if ($ob === null) {
            $mdrs = new MobileDeviceRefAccount();
            $mdrs->setMobileDevice($this->mobileDevice);
            $mdrs->setAccount($this->account);
            $mdrs->setSysMobile();
            $mdrs->setUpdatedAt(new DateTime('now'));
            container_entity_manager()->persist($mdrs);
            container_entity_manager()->flush();
        }
        else {
            $ob->setUpdatedAt(new DateTime('now'));
            container_entity_manager()->persist($ob);
            container_entity_manager()->flush();
        }
    }

    private function getAccountGuid(): void
    {
        $accountGuid = $this->account->getId();
        $this->auth->setAccountId($accountGuid);
    }
}
