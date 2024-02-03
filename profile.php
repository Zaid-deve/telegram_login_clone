<?php

session_start();
include "db/db_conn.php";

if (isset($_SESSION['user_id'])) {
    $uid = $_SESSION['user_id'];
    $qry = $conn->query("SELECT * FROM users WHERE user_id = {$uid}");
    if ($qry && $qry->num_rows > 0) {
        $data = $qry->fetch_assoc();
        $name = $data['user_name'];
        $addNewName = "";

        if (empty($name)) {
            echo "<script>
                   var name = prompt('add new username');
                 </script>";


            $new_username = "<script>document.writeln(name);</script>";
            if(!empty($new_username)){
                $qry1 = $conn->query("UPDATE users SET user_name = '{$new_username}' WHERE user_id={$uid}");
                if($qry1)die("User Name Updated, Welcome $new_username to telegram clone profile <a href='logout.php'>logout</a>");
            }
        }
        echo "Welcome $name to telgram clone  <a href='logout.php'>logout</a>";
    } else $output = "Something Went Wrong !";
    echo $output;
}


// response
echo $output;
$conn->close();

?>