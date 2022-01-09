<?php 
 
require '../config.php';

//input_data
$data = json_decode(file_get_contents('php://input'), true);

$user_id = $data['user_id'];
$book_id = $data['book_id'];

//user_id_input
//mobile_number_data
$mobile_number_data = $dbConn->query("SELECT
    mobile_number
 FROM user
 WHERE user_id IN ('$user_id')
 LIMIT 1
    ");
while($row = $mobile_number_data->fetch(PDO::FETCH_ASSOC)) {
    $mobile_number = $row['mobile_number'];
}

//get_payment_details_for_user_with_book
$get_payment_details_for_user_with_book = $dbConn->query("SELECT
    *
 FROM payment
 WHERE mobile_number IN ('$mobile_number')
 AND book_id IN ('$book_id')
    ");

while($row = $get_payment_details_for_user_with_book->fetch(PDO::FETCH_ASSOC)) {
    $get_payment_details_for_user_with_book_api[] = $row;
}

//for_book
//book_data
$book_data = $dbConn->query("SELECT
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
 FROM book
  LEFT JOIN 
  author ON
  author.author_id = book.author_id
  LEFT JOIN 
  category ON
  category.category_id = book.category_id
 WHERE book.status IN ('$active')
 AND book.book_id IN ('$book_id')
    ");

while($row = $book_data->fetch(PDO::FETCH_ASSOC)) {
    $book_data_api[] = $row;
}

if (isset($get_payment_details_for_user_with_book_api)) {
$returnArr = array("api"=>"get_payment_details_for_user_with_book","result"=>"success","get_payment_details_for_user_with_book_api"=>$get_payment_details_for_user_with_book_api,"book_data_api"=>$book_data_api);
}
else {
    $returnArr = array("api"=>"get_payment_details_for_user_with_book","result"=>"error");
}	

echo json_encode($returnArr);


?>