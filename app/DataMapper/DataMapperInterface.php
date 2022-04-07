<?php

namespace app\DataMapper;

interface DataMapperInterface
{

    /**
     * Prepare the query string
     *
     * @param string $sqlQuery
     * @return self
     */
    public function prepare(string $sqlQuery) : self;


}