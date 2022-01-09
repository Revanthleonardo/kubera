<?php

include '../config.php';

//input_data
$data = json_decode(file_get_contents('php://input'), true);

$user_id = $_GET['user_id'];

//level_only_update
$level_only_update = $dbConn->query("SELECT
    *
 FROM user
 WHERE user_id IN ('$user_id')
 AND payment_status IN ('$inactive')
 AND status IN ('$inactive')
    ");

while($row = $level_only_update->fetch(PDO::FETCH_ASSOC)) {
    $level_update_count = $row['level_update_count'];
    $level = $row['level'];
    $name = $row['name'];
    $mobile_number = $row['mobile_number'];
    $email = $row['email'];
    $password = $row['password'];
    $registered_date = $row['registered_date'];
    $referral_number = $row['referral_number'];

      if ($level_update_count >= 84 && $level < 4) {

        $actual_level = $level + 1;
        
        //reset level_update_count so it won't update again
        $dbConn->query("UPDATE `user` 
       SET `level_update_count` = '$active',
       `level_update_count_status` = '$inactive'
       WHERE user_id IN ('$user_id')");

        //update new level to new user
    $dbConn->query("INSERT INTO `user` (
    `name`,
    `mobile_number`,
    `email`,
    `password`,
    `registered_date`,
    `referral_number`,
    `payment_status`,
    `level`,
    `status`
    ) 
    VALUES (
    '{$name}',
    '{$mobile_number}',
    '{$email}',
    '{$password}',
    '{$registered_date}',
    '{$referral_number}',
    '{$inactive}',
    '{$actual_level}',
    '{$inactive}'
    )
    ;");
        

        $returnArr = array("api"=>"level_only_update","result"=>"success");
    }
else{
        $returnArr = array("api"=>"level_only_update","result"=>"error");
    }
}

echo json_encode($returnArr);

?>
