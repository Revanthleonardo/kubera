<?php 
require '../config.php';

//book_data
$book_data = $dbConn->query("SELECT
    book.book_name,
    book.amount,
    book.book_path,
    book.trending,
    author.author_name,
    category.category_name
 FROM book
  LEFT JOIN 
  author ON
  author.author_id = book.author_id
  LEFT JOIN 
  category ON
  category.category_id = book.category_id
 WHERE book.status IN ('$active')
    ");

while($row = $book_data->fetch(PDO::FETCH_ASSOC)) {
    $book_data_api[] = $row;
}

if (isset($book_data_api)) {
$returnArr = array("api"=>"book_data","result"=>"success","book_data_api"=>$book_data_api);
}
else {
    $returnArr = array("api"=>"book_data","result"=>"error");
}	

echo json_encode($returnArr);


?>