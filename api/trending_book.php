<?php 
require '../config.php';

//trending_book_data
$trending_book_data = $dbConn->query("SELECT
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
 AND book.trending IN ('$inactive')
    ");

while($row = $trending_book_data->fetch(PDO::FETCH_ASSOC)) {
    $trending_book_data_api[] = $row;
}

if (isset($trending_book_data_api)) {
$returnArr = array("api"=>"trending_book_data","result"=>"success","trending_book_data_api"=>$trending_book_data_api);
}
else {
    $returnArr = array("api"=>"trending_book_data","result"=>"error");
}	

echo json_encode($returnArr);


?>