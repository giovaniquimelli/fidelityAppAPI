<?php


namespace App\Exception;

use Symfony\Component\HttpKernel\Exception\HttpException;

class ApiException extends HttpException implements ApiExceptionInterface
{
    private $statusCode;

    private $type = 'about:blank';

    private $title;

    private $details;

    private $extraData = [];

    public function __construct(int $statusCode = 500, string $message = 'Ocorreu um erro', string $title = '', $details='', $data = [], \Throwable $previous = null)
    {
        $this->details = $details;
        $this->extraData = $data;
        $this->title = $title;
        parent::__construct($statusCode, $message, $previous);
    }

    /**
     * @param int $statusCode
     */
    public function setStatusCode(int $statusCode): void
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return array
     */
    public function getExtraData(): array
    {
        return $this->extraData;
    }

    /**
     * @param array $extraData
     */
    public function setExtraData(array $extraData): void
    {
        $this->extraData = $extraData;
    }


    /**
     * @return array
     */
    public function getData(): array
    {
        // TODO: Implement getData() method.
        return $this->extraData;
    }

    public function getDetails(): string
    {
        return $this->details;
    }
}
