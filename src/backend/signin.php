<?php

    include('../../config/database.php');

    session_start();
    if(!isset($_SESSION['user_id'])) {
        header('Refresh:0; url=http://localhost/schoolar2/src/index.php');
    }

    $email = $_POST ['e_mail'];
    $passw = $_POST ['p_sswd'];
    $enc_past = sha1($passw);

    $sql = "select id,
	COUNT(id) as total
from 
	users 
where 
	email = '$email' and 
	password = '$enc_past' and 
	status = true
    GROUP BY id";

    $res = pg_query($conn, $sql);

    if($res){
        $row = pg_fetch_assoc($res);
        if($row['total'] > 0){
            //echo "Login ok";
            $_SESSION['user_id'] = $row['id'];
            header('Refresh:0; url=http://localhost/schoolar2/src/index.php');
        } else {
            echo "Login failed";
        }
    }

?>