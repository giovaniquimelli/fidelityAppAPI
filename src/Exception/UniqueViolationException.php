<?php


namespace App\Exception;

use App\Util\Str;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

class UniqueViolationException extends ApiException
{
    public function __construct(string $message = 'Item já existe na base de dados.', string $title = '', $details='', $data = [], \Throwable $previous = null)
    {
        parent::__construct(409, $message, $title, $details='', $data = [], $previous);
    }

    public static function handleUniqueConstraintViolationException(
        UniqueConstraintViolationException $previous,
        string $message = 'Item já existe na base de dados.',
        string $title = '',
        $details='',
        $data = []
    ): UniqueViolationException
    {
        $errorMessage = static::handleUniqueConstraintMessage($previous->getMessage());

        return new UniqueViolationException($errorMessage ?? $message, $title, $details='', $data = [], $previous);
    }

    private static function handleUniqueConstraintMessage($details): ?string {
        $violation = Str::getDataFromUniqueConstraintViolation($details);
        $violationMessage = null;
        $field = $violation['field'];
        $value = $violation['value'];

        switch ($field) {
            case 'cpf_cnpj':
                $violationMessage = "CPF '{$value}' já registrado na base de dados.";
                break;
            case 'username':
                $violationMessage = "Nº de Matricula '{$value}' já registrado na base de dados.";
                break;
        }
        return $violationMessage;
    }
}
