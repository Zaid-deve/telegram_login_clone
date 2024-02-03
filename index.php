
<?php 

session_start();
if(isset($_SESSION['user_id'])){
    header("Location: profile.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telegram Login</title>

    <!-- bs5 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.1.0/remixicon.min.css" integrity="sha512-i5VzKip7owqOGjb0YTF8MR2J9yBVO3FLHeazKzLp354XYTmKcqEU3UeFYUw82R8tV6JqxeATOfstCfpfPhbyEA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700;300;500&display=swap">
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <div class="tg-box">
        <div class="tg-header">
            <button class="btn tg-close"><i class="ri-arrow-left-line"></i></button>
            <h3 class="tg-header-label">Choose A Country</h3>
            <button class="btn btn-search"><i class="ri-search-line"></i></button>
        </div>

        <div class="tg-main-text">
            <h3 class="tg-header-text">Your phone number</h3>
            <p class="tg-header-text2">Please confirm your country code <br> and enter your phone number</p>
        </div>

        <div class="tg-fields">
            <div class="tg-field tg-field-1 hide" tabindex="-1">
                <div class="tg-field-left">
                    <img src="" alt="#" id="country-icon">
                </div>
                <div class="tg-field-country">
                    <span></span>
                </div>
                <button class="btn btn-toggle-country-list"><i class="ri-arrow-right-s-line"></i></button>
                <label>Country</label>
            </div>

            <div class="tg-field tg-field-2" tabindex="-1">
                <div class="tg-field-left">
                    <span>+</span>
                    <input type="number" id="tg-country-code" autofocus>
                </div>
                <div class="tg-field-inp">
                    <input type="text" id="tg-phone-number" placeholder="00000 00000">
                </div>
                <label>Phone Number</label>
            </div>
        </div>
        <div class="tg-contacts-label">
            <input type="checkbox" id="tg-sync-contacts">
            <label for="tg-sync-contacts">Sync Contacts</label>
        </div>

        <div class="tg-otp-outer">
            
        </div>
        <button class="btn tg-btn-submit "><i class="ri-arrow-right-line"></i></button>
        <?php include "btns.php" ?>

        <div class="country-list-box hide">
            <ul class="country-list"></ul>
        </div>
        
    </div>
    <div class="confirm-outer">
            <div class="confirm-box">
                <div class="confirm-header">
                    <p>Is This Number Correct</p>
                </div>

                <div class="confirm-number">+91 79902 25947</div>
                <div class="confirm-btns">
                    <button class="btn btn-edit">Edit</button>
                    <button class="btn btn-send">Yes</button>
                </div>
            </div>
            <div class="check-btn-outer">
            <button class="btn tg-check-data btn-send">
                <i class="ri-check-line"></i>
            </button>

            </div>
        </div>

    <script src="main.js"></script>

</body>

</html>