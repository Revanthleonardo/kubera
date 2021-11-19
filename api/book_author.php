<?php 
require '../config.php';

//book_author_data
$book_author_data = $dbConn->query("SELECT
    *
 FROM author
    ");

while($row = $book_author_data->fetch(PDO::FETCH_ASSOC)) {
    $book_author_data_api[] = $row;
}

if (isset($book_author_data_api)) {
$returnArr = array("api"=>"book_author_data","result"=>"success","book_author_data_api"=>$book_author_data_api);
}
else {
    $returnArr = array("api"=>"book_author_data","result"=>"error");
}	

echo json_encode($returnArr);


?>