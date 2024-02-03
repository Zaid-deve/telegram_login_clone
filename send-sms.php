<?php
// Update the path below to your autoload.php,
// see https://getcomposer.org/doc/01-basic-usage.md
require_once 'vendor/autoload.php';

use Twilio\Rest\Client;

$sid    = "AC5d4b14b2a97765c699c82cceca207b7e";
$token  = "f04b9845e391077ce09229ade5b95838";
$twilio = new Client($sid, $token);

try{
    $message = $twilio->messages
    ->create(
        "+$code"."$number", // to
        array(
            "from" => "+12765005023",
            "body" => "One Time Otp To Login To Your Telegram Clone Account - $otp"
        )
    );
}catch(Twilio\Exceptions\RestException $e){
    $output = "Something Went Wrong !";
}


?>