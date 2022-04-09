<?php

namespace app\lib\DataMapper;

use app\lib\Connection\Connection;
use Exception;
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

    /**
     * @param string $sqlQuery
     * @return DataMapperInterface
     */
    public function prepare(string $sqlQuery): DataMapperInterface
    {
        $this->statement = $this->connection->open()->prepare($sqlQuery);
        return $this;
    }

    /**
     * @return bool
     */
    public function executeStmt(): bool
    {
        return $this->statement->execute();
    }

    /**
     * @return bool|array
     */
    public function fetchResult(): bool|array
    {
        return $this->statement->fetchAll();
    }

    public function bindValues(array $fields) : PDOStatement
    {
        foreach ($fields as $key => $value) {
            $this->statement->bindValue(':' . $key, $value, $this->bind($value));
        }
        return $this->statement;
    }

    /**
     * @param $value
     */
    public function bind($value)
    {
        switch($value) {
            case is_bool($value) :
            case intval($value) :
                $dataType = PDO::PARAM_INT;
                break;
            case is_null($value) :
                $dataType = PDO::PARAM_NULL;
                break;
            default :
                $dataType = PDO::PARAM_STR;
                break;
        }
        return $dataType;
    }
}