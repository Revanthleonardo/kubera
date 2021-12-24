<?php

//total_user
$total_user_count_data = $dbConn->query("SELECT 
COUNT(user_id) as total_user_count
  FROM user   
");
while($row = $total_user_count_data->fetch(PDO::FETCH_ASSOC)) {
$total_user_count = $row['total_user_count'];
}

//total_payment
$total_payment_count_data = $dbConn->query("SELECT 
COUNT(payment_id) as total_payment_count
  FROM payment   
");
while($row = $total_payment_count_data->fetch(PDO::FETCH_ASSOC)) {
$total_payment_count = $row['total_payment_count'];
}

//total_book
$total_book_count_data = $dbConn->query("SELECT 
COUNT(book_id) as total_book_count
  FROM book   
");
while($row = $total_book_count_data->fetch(PDO::FETCH_ASSOC)) {
$total_book_count = $row['total_book_count'];
}

//total_user_level_1
$total_user_level_1_count_data = $dbConn->query("SELECT 
COUNT(user_id) as total_user_level_1_count
  FROM user 
  WHERE level IN ('1')  
");
while($row = $total_user_level_1_count_data->fetch(PDO::FETCH_ASSOC)) {
$total_user_level_1_count = $row['total_user_level_1_count'];
}

//total_user_level_2
$total_user_level_2_count_data = $dbConn->query("SELECT 
COUNT(user_id) as total_user_level_2_count
  FROM user 
  WHERE level IN ('2')  
");
while($row = $total_user_level_2_count_data->fetch(PDO::FETCH_ASSOC)) {
$total_user_level_2_count = $row['total_user_level_2_count'];
}

//total_user_level_3
$total_user_level_3_count_data = $dbConn->query("SELECT 
COUNT(user_id) as total_user_level_3_count
  FROM user 
  WHERE level IN ('3')  
");
while($row = $total_user_level_3_count_data->fetch(PDO::FETCH_ASSOC)) {
$total_user_level_3_count = $row['total_user_level_3_count'];
}

//total_user_level_4
$total_user_level_4_count_data = $dbConn->query("SELECT 
COUNT(user_id) as total_user_level_4_count
  FROM user 
  WHERE level IN ('4')  
");
while($row = $total_user_level_4_count_data->fetch(PDO::FETCH_ASSOC)) {
$total_user_level_4_count = $row['total_user_level_4_count'];
}




//level_1_stage_1
$total_user_level_1_stage_1_count_data = $dbConn->query("SELECT 
COUNT(user_id) as total_user_level_1_stage_1_count
  FROM user 
  WHERE referral_count BETWEEN ('1') AND ('4')  
  AND level IN ('1')
");
while($row = $total_user_level_1_stage_1_count_data->fetch(PDO::FETCH_ASSOC)) {
$total_user_level_1_stage_1_count = $row['total_user_level_1_stage_1_count'];
}

?>