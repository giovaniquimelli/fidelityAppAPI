<?php

use Doctrine\DBAL\DriverManager;

return DriverManager::getConnection([
    'dbname' => 'fidelity_club_admin',
    'user' => 'postgres',
    'password' => '123456',
    'host' => 'localhost',
    'driver' => 'pdo_pgsql',
]);
