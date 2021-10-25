<?php 
require '../config.php';

//book_data
$book_data = $dbConn->query("SELECT
    *
 FROM book
 WHERE status IN ('$active')
    ");
while($row = $book_data->fetch(PDO::FETCH_ASSOC)) {
    $book_data_api[] = $row;
}

$returnArr = array("api"=>"book_data","result"=>"success","book_data_api"=>$book_data_api);	

echo json_encode($returnArr);


?>