<?php


namespace App\Exception;


class UnauthorizedException extends ApiException
{
        public function __construct(int $statusCode = 401, string $message = 'Authentication required', string $title = 'Unauthorized', $details = 'Access denied', $data = [], \Throwable $previous = null)
        {
            parent::__construct($statusCode, $message, $title, $details, $data, $previous);
        }
}
