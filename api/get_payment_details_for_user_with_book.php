<?php 
 
require '../config.php';

//input_data
$data = json_decode(file_get_contents('php://input'), true);

$user_id = $data['user_id'];
$book_id = $data['book_id'];

//get_payment_details_for_user_with_book
$get_payment_details_for_user_with_book = $dbConn->query("SELECT
    *
 FROM payment
 WHERE user_id IN ('$user_id')
 AND book_id IN ('$book_id')
    ");

while($row = $get_payment_details_for_user_with_book->fetch(PDO::FETCH_ASSOC)) {
    $get_payment_details_for_user_with_book_api[] = $row;
}

if (isset($get_payment_details_for_user_with_book_api)) {
$returnArr = array("api"=>"get_payment_details_for_user_with_book","result"=>"success","get_payment_details_for_user_with_book_api"=>$get_payment_details_for_user_with_book_api);
}
else {
    $returnArr = array("api"=>"get_payment_details_for_user_with_book","result"=>"error");
}	

echo json_encode($returnArr);


?>