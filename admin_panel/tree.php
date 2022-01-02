<?php

include '../config.php';


$user_id_input = "11";

//view_tree_user_data
//and status whether referral_number updated
$view_tree_user_data = $dbConn->query("SELECT
    user_id,
    name,
    referral_number,
    level
 FROM user
 WHERE referral_id IN ('$user_id_input')
    ");
while($row = $view_tree_user_data->fetch(PDO::FETCH_ASSOC)) {
     $user_id[] = $row['user_id'];
     $name = $row['name'];
     $referral_number = $row['referral_number'];
     $level = $row['level'];

 }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuberaa</title>

    <?php include"include.php"; ?>

</head>

<body>
	
<?php
    echo "

    <table class=\"table\">
		<tr>
		<td>$user_id[0]</td>
		<td>$user_id[1]</td>
		<td>$user_id[2]</td>
		<td>$user_id[3]</td>
		</tr>		
	</table>
	
	";

?>
</body>

</html>