<?php

namespace app\lib\DataMapper;

use app\lib\Connection\Connection;
use PDOStatement;
use PDO;

class DataMapper implements DataMapperInterface
{

    private Connection $connection;
    private PDOStatement $statement;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function prepare(string $sqlQuery): DataMapperInterface
    {
        $this->statement = $this->connection->open()->prepare($sqlQuery);
        return $this;
    }

    public function executeStmt(): bool
    {
        return $this->statement->execute();
    }

    public function fetchResult(): bool|array
    {
        return $this->statement->fetchAll();
    }
}