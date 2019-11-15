<?php

class CreateDb
{
    public function __construct($msg)
    {
        print($msg);
    }

    public function getData()
    {
        $host = "localhost";
        $databasename = "wideworldimporters";
        $port = 3306;
        $user = "root";
        $pass = "";
        $connection = mysqli_connect($host, $user, $pass, $databasename, $port);
        $sql = "SELECT * FROM stockitems";
        $result = mysqli_query($connection,$sql);
        if(mysqli_num_rows($result)>0)
        {
            return $result;
        }
    }
}



