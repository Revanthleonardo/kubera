<?php 
 
require '../config.php';



for ($i=1004; $i < 5000; $i++) { 

    $mobile_number = $i;
    $referral_number = $i;
    $name = "1";
    $email = "1";
    $password = "1";

    //inserting_user
  $dbConn->query("INSERT INTO `user` (
    `name`,
    `mobile_number`,
    `email`,
    `password`,
    `referral_number`
    ) 
    VALUES (
    '{$name}',
    '{$mobile_number}',
    '{$email}',
    '{$password}',
    '{$referral_number}'
    )
    ;");
    

    echo $i;
}




?> 