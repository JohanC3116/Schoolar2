<?php

    include('../../config/database.php');

    $fname = $_POST['f_name'];
    $lname = $_POST['l_name'];
    $email = $_POST['e_mail'];
    $password = $_POST['passw'];

    //$enc_past = md5($password);
    $enc_past = sha1($password);

    $sql_validate_email = "SELECT COUNT(email) as total FROM  users WHERE  email = '$email' LIMIT 1";
    $res = pg_query($conn, $sql_validate_email);

    if($res){
        $row = pg_fetch_assoc($res);
        if($row['total'] > 0){
            echo "Email already exist";
        }
     else {
        //se crea el query
            $sql = "INSERT INTO users (firstname, lastname, email, password)
            VALUES('$fname', '$lname','$email','$enc_past')
            ";
            
            $res = pg_query($conn, $sql); //como darle f5

            if ($res){ // es como tener res == true
                //echo "User has been created succesfully";
                echo "<script>alert('User has been created go to login')</script>";
                header('Refresh:0; url=http://localhost/schoolar2/src/login.html');
                    } else {
                         echo "Error";
                    }
        }
    }
?>
