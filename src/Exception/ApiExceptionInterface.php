<?php


namespace App\Exception;



interface ApiExceptionInterface extends \Throwable
{
//    /**
//     * @return int
//     */
//    public function getStatusCode(): int;

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @return string
     */
    public function getTitle(): string;

    /**
     * @return array|mixed|string|int|bool|callable
     */
    public function getExtraData(): array;

    /**
     * @return array|mixed|string|int|bool|callable
     */
    public function getData(): array;

    public function getDetails() : string;
}
