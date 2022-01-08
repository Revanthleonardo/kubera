<?php 
 
require '../config.php';



for ($i=0; $i < 9900; $i++) { 

    $mobile_number = $i;
    $referral_number = $referral_number = "AAA".str_pad($i, 4, '0', STR_PAD_LEFT);
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