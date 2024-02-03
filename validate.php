
<?php 

include "db/db_conn.php";
if(!empty($_POST)){
    $code= $conn->real_escape_string(htmlentities($_POST['code']));
    $number= $conn->real_escape_string(htmlentities($_POST['number']));

    // validate data
    if(!filter_var($number,FILTER_VALIDATE_INT)){
        die("Unformated Phone Number !");
    }

    $otp = mt_rand(111111,999999);
    include "send-sms.php";
    if(true){
        try{
            $qry = $conn->query("INSERT INTO `users` (`user_phone`,`user_token`) VALUES ('+{$code}{$number}', '$otp')");
        }catch(Exception $e){
            if($e->getCode()==1062){
                $qry = $conn->query("UPDATE users SET user_token = '$otp' WHERE user_phone='+{$code}{$number}'");
            }else $output = $e->getMessage();
        }
        finally{
            if($conn->insert_id || $conn->affected_rows)$output="success";
        }
    }

    // response
    echo $output;
    $conn->close();
}

?>