<?php 
 
require '../config.php';

//input_data
$data = json_decode(file_get_contents('php://input'), true);

$category_id = $data['category_id'];

//selected_book_category
$selected_book_category = $dbConn->query("SELECT
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
 AND book.author_id IN ('$author_id')
    ");

while($row = $selected_book_category->fetch(PDO::FETCH_ASSOC)) {
    $selected_book_category_api[] = $row;
}

if (isset($selected_book_category_api)) {
$returnArr = array("api"=>"selected_book_category","result"=>"success","selected_book_category_api"=>$selected_book_category_api);
}
else {
    $returnArr = array("api"=>"selected_book_category","result"=>"error");
}	

echo json_encode($returnArr);


?>