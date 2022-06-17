<?php

namespace App\Util;

use App\Exception\ApiExceptionInterface;
use App\Exception\ApiFlattenException;
use App\Util\Container\ContainerService;
use App\Util\Container\Serializer;
use Doctrine\Common\Annotations\AnnotationException;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Throwable;


class ApiResponseBag
{
    /**
     * @var bool
     * @Groups({"debug","all"})
     */
    private $success = true;
    /**
     * @var int
     * @Groups({"debug","all"})
     */
    private $statusCode = 200;
    /**
     * @var string
     * @Groups({"debug","all"})
     */
    private $message = '';
    /**
     * @var string
     * @Groups({"debug","all"})
     */
    private $title = '';
    /**
     * @var string
     * @Groups({"debug","all"})
     */
    private $details = '';
    /**
     * @var mixed|string|float|int|array|callable
     * @Groups({"debug","all"})
     */
    private $data = null;
    /**
     * @var array
     * @Groups({"debug"})
     */
    private $error = [];
    /**
     * @var bool
     */
    private $isDebug;

    /**
     * @var Cookie[]|array
     */
    private $cookies = [];

    private $clearCookies = false;

    /**
     * called when a new resource was created/insert into the database
     * @param array $data
     * @param array $groups
     * @param string $message
     * @param string $title
     * @param string $details
     * @return ApiResponseBag
     * @throws AnnotationException
     * @throws ExceptionInterface
     * @throws \ReflectionException
     */
    public static function created($data = null, array $groups = [], string $message = '', string $title = '', string $details = ''): ApiResponseBag
    {
        $bag = new self;
        $bag->setStatusCode(201);
        $bag->setNormalizedData($data, $groups);
        $bag->setMessage($message);
        $bag->setTitle($title);
        $bag->setDetails($details);

        return $bag;
    }

    public static function success($data = null, array $groups = [], string $message = '', string $title = '', string $details = ''): ApiResponseBag
    {
        $bag = new self;
        $bag->setStatusCode(200);
        $bag->setNormalizedData($data, $groups);
        $bag->setMessage($message);
        $bag->setTitle($title);
        $bag->setDetails($details);

        return $bag;
    }

    /**
     * called when a known error has occurred
     * @param HttpExceptionInterface $ex
     * @return ApiResponseBag
     */
    public static function error(HttpExceptionInterface $ex): ApiResponseBag
    {
        $bag = new self;
        $bag->setSuccess(false);
        $bag->setStatusCode($ex->getStatusCode());
        $bag->setMessage($ex->getMessage());

        if ($bag->isDebug()) {
            $bag->setError($ex);
        }

        return $bag;
    }

    /**
     * @param Throwable $ex
     * @return ApiResponseBag
     */
    public static function unknownError(Throwable $ex, string $customMessage = ''): ApiResponseBag
    {
        $bag = new self;
        $bag->setSuccess(false);
        $bag->setStatusCode(500);
        $bag->setMessage($customMessage !== '' ? $customMessage : $ex->getMessage());

        if ($bag->isDebug()) {
            $bag->setError($ex);
        }

        return $bag;
    }

    /**
     * @param ApiExceptionInterface $ex
     * @return ApiResponseBag
     */
    public static function fail(ApiExceptionInterface $ex): ApiResponseBag
    {
        $bag = new self;
        $bag->setSuccess(false);
        $bag->setStatusCode($ex->getStatusCode());
        $bag->setMessage($ex->getMessage());
        $bag->setDetails($ex->getDetails());
        $bag->setTitle($ex->getTitle());
        $bag->setData($ex->getExtraData());

        if ($bag->isDebug()) {
            $bag->setError($ex);
        }

        return $bag;
    }

    /**
     * @param object|array $data
     * @param array $groups
     * @return ApiResponseBag
     * @throws AnnotationException
     * @throws ExceptionInterface
     * @throws \ReflectionException
     */
    public function setNormalizedData($data, $groups = []): ApiResponseBag
    {
        if ($data === null) {
            $this->data = [];
        } else if (is_object($data)) {
            $this->data = Serializer::normalize($data, $groups);
        } else {
            $this->data = $data;
        }
        return $this;
    }

    /**
     * @return bool $isDebug
     */
    public function isDebug(): bool
    {
        //return $this->isDebug;
        return (bool)$_ENV['APP_DEBUG'];
    }

    public function getResponse($format = 'json'): JsonResponse
    {
        // TODO: refactor function
        $cookieName = ContainerService::param('web.cookie_name');
        $tokenAttr = ContainerService::param('web.token_guard.token');


        if ($format === 'json') {
            $response = new JsonResponse();
            $response->setContent($this->serialize());
            $response->setStatusCode($this->statusCode);
            $hasAuthCookie = false;
            // TODO: Remove unused functions
            /*
            foreach ($this->cookies as $cookie) {
                if ($cookie->getName() === $cookieName) {
                    $hasAuthCookie = true;
                }
                $response->headers->setCookie($cookie);
            }

            if ($tokenAttr !== null && !$hasAuthCookie) {
                $s = new Cookie($cookieName, $tokenAttr, 0, '/');
                $s->setSecureDefault(true);
            }
           */
            return $response;
        }
        // TODO: implement other formats
        return JsonResponse::create();
    }

    public function serialize($format = 'json', $beauty = false): string
    {
        $groups = ['all'];

        if ($this->isDebug()) {
            $groups[] = 'debug';
        }

        $this->normalizeData();

        return Serializer::serialize($this, $groups, $format);
    }

    public function getSuccess(): bool
    {
        return $this->success;
    }

    public function setSuccess(bool $value = true): ApiResponseBag
    {
        $this->success = $value;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     * @return ApiResponseBag
     */
    public function setStatusCode(int $statusCode): ApiResponseBag
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @return array
     * @Groups({"debug"})
     */
    public function getError(): array
    {
        return $this->error;
    }

    /**
     * @param Throwable $error
     * @Groups({"debug"})
     * @return ApiResponseBag
     */
    public function setError(Throwable $error): ApiResponseBag
    {
        // dd($error instanceof Throwable);
        $this->error = ApiFlattenException::create($error)->toArray();
        return $this;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $value
     * @return ApiResponseBag
     */
    public function setData($value): ApiResponseBag
    {
        $this->data = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return ApiResponseBag
     */
    public function setTitle(string $title): ApiResponseBag
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getDetails(): string
    {
        return $this->details;
    }

    /**
     * @param string $details
     * @return ApiResponseBag
     */
    public function setDetails(string $details): ApiResponseBag
    {
        $this->details = $details;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return ApiResponseBag
     */
    public function setMessage(string $message): ApiResponseBag
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return ApiResponseBag
     * @throws ExceptionInterface
     */
    private function normalizeData(): ApiResponseBag
    {
        if (!is_array($this->data) && is_object($this->data)) {
            $this->data = Serializer::normalize($this->data);
        }
        return $this;
    }

}
