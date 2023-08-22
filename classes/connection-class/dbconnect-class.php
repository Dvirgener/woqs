<?php

class connectiontodb
{
    public function connect()
    {
        $host = "localhost";
        $username = "root";
        $password = "J4yfr!ll062815";
        $database = "logistics_db";
        $dbconnect = new mysqli($host, $username, $password, $database);
        if ($dbconnect->connect_error) {
            echo $dbconnect->connect_error;
        } else {
            return $dbconnect;
        }
    }
}
