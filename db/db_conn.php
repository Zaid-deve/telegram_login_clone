<?php

$err = "Something Went Wrong !";
$conn = new mysqli("localhost", "root", "", "tg_login_clone");
if (!$conn) die($err);
$output = "";
