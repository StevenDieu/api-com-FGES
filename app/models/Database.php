<?php

class Database
{
    public $dbh;

    function __construct()
    {
        include('config/database.php');
        $this->dbh = $dbh;
    }
}

