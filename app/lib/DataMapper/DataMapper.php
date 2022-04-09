<?php

namespace app\lib\DataMapper;

use app\lib\Connection\Connection;
use PDOStatement;

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
}