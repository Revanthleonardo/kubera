<?php


$user_id = 1000;
$random_number = rand(0,99999999);
$referral_number = str_pad($user_id, 8, '0', STR_PAD_LEFT)."".str_pad($random_number, 8, '0', STR_PAD_LEFT);
/*
$user_id_filtered = ltrim((substr($referral_number, 0, -8)),'0') ;
*/
echo $referral_number;
echo "<br>";
echo $user_id_filtered;
?>