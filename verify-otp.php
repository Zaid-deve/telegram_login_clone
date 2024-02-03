<?php

if (!empty($_POST)) {
    include "db/db_conn.php";
    $number = $conn->real_escape_string($_POST['num']);
    $otp = $conn->real_escape_string($_POST['otp']);


    if (
        !filter_var($number, FILTER_VALIDATE_INT) ||
        !filter_var($otp, FILTER_VALIDATE_INT)
    ) {
        $output = "unformatted number, something went wrong !";
    }else {
        $qry = $conn->query("SELECT user_token,user_id FROM users WHERE user_phone = '+{$number}'");
        if($qry && $qry->num_rows > 0){
            $data = $qry->fetch_assoc();
            if($data['user_token']==$otp){
                session_start();
                $_SESSION['user_id']=$data['user_id'];
                $output = "success";
            }else $output="Wrong Otp, Please Try Again !";
        }else $output = "No user found, $err";
    }
}

// response 

echo $output;
$conn->close();
