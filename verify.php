
<?php 

if(!empty($_GET['n'])){
    echo "<script>let num={$_GET['n']}</script>";
}else die('Something Went Wrong !');


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Account</title>

    <!-- bs5 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.1.0/remixicon.min.css" integrity="sha512-i5VzKip7owqOGjb0YTF8MR2J9yBVO3FLHeazKzLp354XYTmKcqEU3UeFYUw82R8tV6JqxeATOfstCfpfPhbyEA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700;300;500&display=swap">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="verify.css">
</head>

<body>

    <div class="tg-box otp-wrapper">
        <div class="otp-header">
            <a class="btn" href="index.php"><i class="ri-arrow-left-line"></i></a>
        </div>
        <div class="otp-wrapper-body">
            <!-- <img src="./photo_2024-02-01_21-32-59-removebg-preview-removebg-preview.png" alt="#"> -->
            <h3>Enter Code</h3>
            <p>We've sent an SMS with an activation code to <br> your phone</p>
            <div class="otp-box-grid">
                <span class="active" data-field="0"></span>
                <span data-field="1"></span>
                <span data-field="2"></span>
                <span data-field="3"></span>
                <span data-field="4"></span>
                <span data-field="5"></span>
            </div>
        </div>

        <div class="msg-body">
            <button class="btn btn-send-call">Call me to dicate the code</button>
            <div class="err hide">Wrong Otp, Please Try Again</div>
        </div>
        <?php include "btns.php" ?>
    </div>
    
    <script src="verify.js"></script>

</body>

</html>