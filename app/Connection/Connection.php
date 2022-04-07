<?php

namespace app\Connection;

use app\Config\Config;
use PDO;

class Connection
{
    protected PDO|null $connection;

    public function open(): PDO
    {
        try {
            $this->connection = new PDO(
                'mysql:host=' . Config::MYSQL_HOST . ';
                dbname=' . Config::MYSQL_DATABASE . ';
                charset=' . Config::CHARSET . ';
                port=' . Config::MYSQL_PORT,
                Config::MYSQL_USER, Config::MYSQL_PASSWORD);
        } catch (\PDOException $exception) {
            throw new $exception;
        }

        return $this->connection;
    }

    public function close(): void
    {
        $this->connection = null;
    }


}