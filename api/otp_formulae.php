<?php

date_default_timezone_set("Asia/Kolkata");
$time = date("hi");


//input_start
$testing = "1514";
$mobile_number = "8883388393";
//input_end


$result = substr($mobile_number, 7, 9); //last 3 digit
$actual = $result + $time; //adding time
$otp_decode = abs($result - $testing) ; //otp_decode
$otp_check = abs($otp_decode - $time);

echo $time;
echo "<br>";
echo $mobile_number;
echo "<br>";
echo $result;
echo "<br>";
echo "<br>";
echo $actual;
echo "<br>";
echo "<br>";
echo $otp_decode;
echo "<br>";
echo $otp_check;


//for 3 min
//valid
if ($otp_check < 4){
    echo "limit";
}
//not_valid
else{
    echo "not_okay";
}



?>