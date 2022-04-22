<?php

namespace app\lib\DataMapper;

use app\lib\Connection\Connection;

class UserDataMapper
{
    private DataMapper $dataMapper;

    public function __construct()
    {
        $this->setDataMapper();

        return $this;
    }

    public function getRankFieldByUserId(int $userId): array
    {
        $statement = 'SELECT u.rank FROM users as u WHERE u.id = :userId';

        $this->dataMapper->prepare($statement);
        $this->dataMapper->bindValues(['userId' => $userId]);
        $this->dataMapper->executeStmt();

        return $this->dataMapper->fetchResult();
    }

    public function getRankFromUserById(int $userId): array
    {
        $ranksByUser = explode(',', $this->getRankFieldByUserId($userId)['rank']);
        $statement = 'SELECT r.rank_name FROM rank as r WHERE ';

        foreach ($ranksByUser as $key => $rank) {
            $statement .= 'r.rank_id = ' . $rank;

            if($key != count($ranksByUser) - 1){
                $statement .= ' OR ';
            }
        }

        $this->dataMapper->prepare($statement);
        $this->dataMapper->executeStmt();
        return $this->dataMapper->fetchResults();
    }

    /**
     * @return void
     */
    private function setDataMapper(): void
    {
        $this->dataMapper = new DataMapper(new Connection());
    }
}