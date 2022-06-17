<?php


namespace App\Exception;

class PayloadDeserializationException extends ApiException
{
    public function __construct($message = '', $title = '', $details='', $data = [], \Throwable $previous = null)
    {
        $_message = $message ?? 'Formulário mal formado ou com dados inválidos';
        $_title = $title ?? 'Dados Inválidos';
        $_details = $details ?? '';
        $_data = $data ?? [];

        parent::__construct(400, $_message, $_title, $_details='', $_data = [], $previous);
    }
}
