<?php

class CreateDb
{
    public function __construct($msg)
    {
        print($msg);
    }

    public function getData()
    {
        $host = "wideworld.mysql.database.azure.com";
        $databasename = "wideworldimporters";
        $port = 3306;
        $user = "ICTM1n3@wideworld";
        $pass = "Windesheim2019";
        $connection = mysqli_connect($host, $user, $pass, $databasename, $port);
        $sql = "SELECT * FROM stockitems";
        $result = mysqli_query($connection,$sql);
        if(mysqli_num_rows($result)>0)
        {
            return $result;
        }
    }
}



