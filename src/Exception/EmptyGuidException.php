<?php


namespace App\Exception;

class EmptyGuidException extends ApiException
{
    public function __construct(string $message = 'Guid não encontrado ou está vazio', string $title = 'Guid Error', $details='', $data = [], \Throwable $previous = null)
    {
        parent::__construct(400, $message, $title, $details='', $data = [], $previous);
    }
}
