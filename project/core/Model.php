<?php

namespace Project\Core;

use PDO;

abstract class Model
{
    protected PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }
}
