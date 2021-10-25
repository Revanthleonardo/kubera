<?php 
 
require '../config.php';

//input_data
$data = json_decode(file_get_contents('php://input'), true);

$mobile_number = $data['mobile_number'];
$password = $data['password'];


//user_login
$user_login = $dbConn->query("SELECT
    *
 FROM user
 WHERE mobile_number IN ('$mobile_number')
 AND password IN ('$password')
    ");
while($row = $user_login->fetch(PDO::FETCH_ASSOC)) {
    $user_login_api = $row;
}

//if mobile_number and password match
if (isset($user_login_api)) {
    $returnArr = array("api"=>"user_login","result"=>"success","user_login_api"=>$user_login_api);
}
else{
    $returnArr = array("api"=>"user_login","result"=>"error");
}
  

echo json_encode($returnArr);

?> 