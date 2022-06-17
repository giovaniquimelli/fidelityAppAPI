<?php


namespace App\Exception;

class ItemNotFoundException extends ApiException
{
    public function __construct(string $message = 'Item não encontrado', string $title = '', $details='', $data = [], \Throwable $previous = null)
    {
        parent::__construct(404, $message, $title, $details='', $data = [], $previous);
    }
}
