<?php

    //config conection
    /*$host = "localhost";
    $port = "5432"; //puerto de la base de datos en postgres
    $dbname = "schoolar";
    $user = "postgres";
    $password = "unicesmag";*/

    //config conection
    $host = "aws-0-us-east-1.pooler.supabase.com";
    $port = "6543"; //puerto de la base de datos de supabase
    $dbname = "postgres";
    $user = "postgres.dbtctzapchxyadpyhcji";
    $password = "unicesmag@@";


    //Create conction 
    $conn = pg_connect("
        host = $host
        port = $port
        dbname = $dbname
        user = $user
        password = $password
    ");

    /* if(!$conn){
        die("Connection error: " . pg_last_error());
    } else {
        echo "Success conection";
    }*/

    pg_close();
?>