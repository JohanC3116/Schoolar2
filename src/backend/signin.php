<?php
include('../../config/database.php');


session_start();
session_unset();
session_destroy();
session_start();

// Si ya está autenticado, redirige 
if(isset($_SESSION['user_id'])) {
    header('Location: http://localhost/schoolar2/src/index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['e_mail'];
    $passw = $_POST['p_sswd'];
    $enc_pass = sha1($passw);

    $sql = "
        SELECT 
            id,
            firstname,
            lastname,
            COUNT(id) as total
        FROM 
            users
        WHERE
            email = '$email' and
            password = '$enc_pass' and
            status = true
        GROUP BY
            id, firstname, lastname
    ";

    $res = pg_query($conn, $sql);

    if($res){
        $row = pg_fetch_assoc($res);
        if($row['total'] > 0){
 
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['firstname'] = $row['firstname'];
            $_SESSION['lastname'] = $row['lastname'];
            $_SESSION['photo'] = 'img/undraw_profile_1.svg'; 

            header('Location: http://localhost/schoolar2/src/index.php');
            exit();
        }else{
            echo "Login failed";
        }
    }
}


include('login.view.php');
?>