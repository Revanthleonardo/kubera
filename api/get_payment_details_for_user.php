<?php 
 
require '../config.php';

//input_data
$data = json_decode(file_get_contents('php://input'), true);

$user_id = $data['user_id'];

//get_payment_details_for_user
$get_payment_details_for_user = $dbConn->query("SELECT
    payment.payment_id,
    payment.payment_date,
    payment.payment_id_instamojo,
    payment.payment_request_id_instamojo,
    book.book_id,
    book.book_name,
    book.book_image,
    book.amount,
    book.book_path,
    book.trending,
    author.author_id,
    author.author_name,
    author.author_image,
    category.category_id,
    category.category_name,
    category.category_image
 FROM payment
 LEFT JOIN 
  book ON
  book.book_id = payment.book_id
 LEFT JOIN 
  author ON
  author.author_id = book.author_id
  LEFT JOIN 
  category ON
  category.category_id = book.category_id
 WHERE payment.user_id IN ('$user_id')
 GROUP BY payment.payment_id_instamojo
    ");

while($row = $get_payment_details_for_user->fetch(PDO::FETCH_ASSOC)) {
    $get_payment_details_for_user_api[] = $row;
}

if (isset($get_payment_details_for_user_api)) {
$returnArr = array("api"=>"get_payment_details_for_user","result"=>"success","get_payment_details_for_user_api"=>$get_payment_details_for_user_api);
}
else {
    $returnArr = array("api"=>"get_payment_details_for_user","result"=>"error");
}	

echo json_encode($returnArr);


?>