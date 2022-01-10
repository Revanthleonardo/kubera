<?php

//total_user
$total_user_count_data = $dbConn->query("SELECT 
COUNT(user_id) as total_user_count
  FROM user 
  WHERE level_update_count_status IN ('$active') 
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
  AND level_update_count_status IN ('$active')
");
while($row = $total_user_level_1_count_data->fetch(PDO::FETCH_ASSOC)) {
$total_user_level_1_count = $row['total_user_level_1_count'];
}

//total_user_level_2
$total_user_level_2_count_data = $dbConn->query("SELECT 
COUNT(user_id) as total_user_level_2_count
  FROM user 
  WHERE level IN ('2')  
  AND level_update_count_status IN ('$active')
");
while($row = $total_user_level_2_count_data->fetch(PDO::FETCH_ASSOC)) {
$total_user_level_2_count = $row['total_user_level_2_count'];
}

//total_user_level_3
$total_user_level_3_count_data = $dbConn->query("SELECT 
COUNT(user_id) as total_user_level_3_count
  FROM user 
  WHERE level IN ('3')
  AND level_update_count_status IN ('$active')  
");
while($row = $total_user_level_3_count_data->fetch(PDO::FETCH_ASSOC)) {
$total_user_level_3_count = $row['total_user_level_3_count'];
}

//total_user_level_4
$total_user_level_4_count_data = $dbConn->query("SELECT 
COUNT(user_id) as total_user_level_4_count
  FROM user 
  WHERE level IN ('4')  
  AND level_update_count_status IN ('$active')
");
while($row = $total_user_level_4_count_data->fetch(PDO::FETCH_ASSOC)) {
$total_user_level_4_count = $row['total_user_level_4_count'];
}



//level_1
//level_1_stage_1
$total_user_level_1_stage_1_count_data = $dbConn->query("SELECT 
COUNT(user_id) as total_user_level_1_stage_1_count
  FROM user 
  WHERE referral_count BETWEEN ('1') AND ('4')  
  AND level IN ('1')
  AND level_update_count_status IN ('$active')
");
while($row = $total_user_level_1_stage_1_count_data->fetch(PDO::FETCH_ASSOC)) {
$total_user_level_1_stage_1_count = $row['total_user_level_1_stage_1_count'];
}

//level_1_stage_2
$total_user_level_1_stage_2_count_data = $dbConn->query("SELECT 
COUNT(user_id) as total_user_level_1_stage_2_count
  FROM user 
  WHERE avg_count BETWEEN ('5') AND ('20')  
  AND level IN ('1')
  AND level_update_count_status IN ('$active')
");
while($row = $total_user_level_1_stage_2_count_data->fetch(PDO::FETCH_ASSOC)) {
$total_user_level_1_stage_2_count = $row['total_user_level_1_stage_2_count'];
}

//level_1_stage_3
$total_user_level_1_stage_3_count_data = $dbConn->query("SELECT 
COUNT(user_id) as total_user_level_1_stage_3_count
  FROM user 
  WHERE avg_count BETWEEN ('21') AND ('84')  
  AND level IN ('1')
  AND level_update_count_status IN ('$active')
");
while($row = $total_user_level_1_stage_3_count_data->fetch(PDO::FETCH_ASSOC)) {
$total_user_level_1_stage_3_count = $row['total_user_level_1_stage_3_count'];
}

//level_2
//level_2_stage_1
$total_user_level_2_stage_1_count_data = $dbConn->query("SELECT 
COUNT(user_id) as total_user_level_2_stage_1_count
  FROM user 
  WHERE referral_count BETWEEN ('1') AND ('4')  
  AND level IN ('2')
  AND level_update_count_status IN ('$active')
");
while($row = $total_user_level_2_stage_1_count_data->fetch(PDO::FETCH_ASSOC)) {
$total_user_level_2_stage_1_count = $row['total_user_level_2_stage_1_count'];
}

//level_2_stage_2
$total_user_level_2_stage_2_count_data = $dbConn->query("SELECT 
COUNT(user_id) as total_user_level_2_stage_2_count
  FROM user 
  WHERE avg_count BETWEEN ('5') AND ('20')  
  AND level IN ('2')
  AND level_update_count_status IN ('$active')
");
while($row = $total_user_level_2_stage_2_count_data->fetch(PDO::FETCH_ASSOC)) {
$total_user_level_2_stage_2_count = $row['total_user_level_2_stage_2_count'];
}

//level_2_stage_3
$total_user_level_2_stage_3_count_data = $dbConn->query("SELECT 
COUNT(user_id) as total_user_level_2_stage_3_count
  FROM user 
  WHERE avg_count BETWEEN ('21') AND ('84')  
  AND level IN ('2')
  AND level_update_count_status IN ('$active')
");
while($row = $total_user_level_2_stage_3_count_data->fetch(PDO::FETCH_ASSOC)) {
$total_user_level_2_stage_3_count = $row['total_user_level_2_stage_3_count'];
}

//level_3
//level_3_stage_1
$total_user_level_3_stage_1_count_data = $dbConn->query("SELECT 
COUNT(user_id) as total_user_level_3_stage_1_count
  FROM user 
  WHERE referral_count BETWEEN ('1') AND ('4')  
  AND level IN ('3')
  AND level_update_count_status IN ('$active')
");
while($row = $total_user_level_3_stage_1_count_data->fetch(PDO::FETCH_ASSOC)) {
$total_user_level_3_stage_1_count = $row['total_user_level_3_stage_1_count'];
}

//level_3_stage_2
$total_user_level_3_stage_2_count_data = $dbConn->query("SELECT 
COUNT(user_id) as total_user_level_3_stage_2_count
  FROM user 
  WHERE avg_count BETWEEN ('5') AND ('20')  
  AND level IN ('3')
  AND level_update_count_status IN ('$active')
");
while($row = $total_user_level_3_stage_2_count_data->fetch(PDO::FETCH_ASSOC)) {
$total_user_level_3_stage_2_count = $row['total_user_level_3_stage_2_count'];
}

//level_3_stage_3
$total_user_level_3_stage_3_count_data = $dbConn->query("SELECT 
COUNT(user_id) as total_user_level_3_stage_3_count
  FROM user 
  WHERE avg_count BETWEEN ('21') AND ('84')  
  AND level IN ('3')
  AND level_update_count_status IN ('$active')
");
while($row = $total_user_level_3_stage_3_count_data->fetch(PDO::FETCH_ASSOC)) {
$total_user_level_3_stage_3_count = $row['total_user_level_3_stage_3_count'];
}

//level_4
//level_4_stage_1
$total_user_level_4_stage_1_count_data = $dbConn->query("SELECT 
COUNT(user_id) as total_user_level_4_stage_1_count
  FROM user 
  WHERE referral_count BETWEEN ('1') AND ('4')  
  AND level IN ('4')
  AND level_update_count_status IN ('$active')
");
while($row = $total_user_level_4_stage_1_count_data->fetch(PDO::FETCH_ASSOC)) {
$total_user_level_4_stage_1_count = $row['total_user_level_4_stage_1_count'];
}

//level_4_stage_2
$total_user_level_4_stage_2_count_data = $dbConn->query("SELECT 
COUNT(user_id) as total_user_level_4_stage_2_count
  FROM user 
  WHERE avg_count BETWEEN ('5') AND ('20')  
  AND level IN ('4')
  AND level_update_count_status IN ('$active')
");
while($row = $total_user_level_4_stage_2_count_data->fetch(PDO::FETCH_ASSOC)) {
$total_user_level_4_stage_2_count = $row['total_user_level_4_stage_2_count'];
}

//level_4_stage_3
$total_user_level_4_stage_3_count_data = $dbConn->query("SELECT 
COUNT(user_id) as total_user_level_4_stage_3_count
  FROM user 
  WHERE avg_count BETWEEN ('21') AND ('84')  
  AND level IN ('4')
  AND level_update_count_status IN ('$active')
");
while($row = $total_user_level_4_stage_3_count_data->fetch(PDO::FETCH_ASSOC)) {
$total_user_level_4_stage_3_count = $row['total_user_level_4_stage_3_count'];
}


//user_data_for_member_list
$user_data_for_member_list = $dbConn->query("SELECT
    *
 FROM user
 WHERE level_update_count_status IN ('$active')
    ORDER BY user_id DESC
    ");


//book_data_for_book_list
$book_data_for_book_list = $dbConn->query("SELECT
    *
 FROM book
    ");

//category_data_for_category_list
$category_data_for_category_list = $dbConn->query("SELECT
    *
 FROM category
    ");

//author_data_for_author_list
$author_data_for_author_list = $dbConn->query("SELECT
    *
 FROM author
    ");

//payment_data_for_payment_list
$payment_data_for_payment_list = $dbConn->query("SELECT
    *
 FROM payment
    ");


//user_data_for_payment_list
$user_data_for_payment_list = $dbConn->query("SELECT
    payment.payment_id_razorpay,
    user.name,
    payment.payment_date,
    payment.payment_id,
    payment.book_id,
    book.book_name
 FROM payment
  LEFT JOIN 
  user ON
  user.mobile_number = payment.mobile_number
  LEFT JOIN 
  book ON
  book.book_id = payment.book_id
    ");

?>