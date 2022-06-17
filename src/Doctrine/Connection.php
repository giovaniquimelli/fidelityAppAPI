<?php


namespace App\Doctrine;


use Doctrine\Common\EventManager;
use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\Driver;

class Connection extends \Doctrine\DBAL\Connection
{
    public function __construct(
        array $params,
        Driver $driver,
        ?Configuration $config = null,
        ?EventManager $eventManager = null)
    {
        $params = array_merge($params, $this->getConnectionConfig());

        parent::__construct($params, $driver, $config, $eventManager);
    }

    public function getConnectionConfig(): array
    {
        $serverName = $_SERVER['SERVER_NAME'] ?? 'localhost:8000';

        if($serverName === 'localhost:8000') {
            return [
//                "host" => "192.168.1.68",
                "host" => "localhost",
                "port" => 5432,
                "dbname" => "fidelity_posto_contorno",
                "user" => "postgres",
                "password" => "123456",
            ];
        }
        if($serverName === 'apicontorno.fidelitycard.com.br') {
            return [
                "host" => "localhost",
                "port" => 55432,
                "dbname" => "fidelity_posto_contorno",
                "user" => "postgres",
                "password" => "!@babelfish42",
            ];
        }
        if($serverName === 'localhost:8001') {
            return [
                "host" => "99.192.1.11",
                "port" => 55632,
                "dbname" => "posto_santa_rita",
                "user" => "outro_user",
                "password" => "73&*(",
            ];
        }
        return [];
    }
}
