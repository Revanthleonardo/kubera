<?php 
require '../config.php';

//book_category_data
$book_category_data = $dbConn->query("SELECT
    *
 FROM category
    ");

while($row = $book_category_data->fetch(PDO::FETCH_ASSOC)) {
    $book_category_data_api[] = $row;
}

if (isset($book_category_data_api)) {
$returnArr = array("api"=>"book_category_data","result"=>"success","book_category_data_api"=>$book_category_data_api);
}
else {
    $returnArr = array("api"=>"book_category_data","result"=>"error");
}	

echo json_encode($returnArr);


?>