<?php

include '../config.php';

if(isset($_POST['referral_number_input'])) { 
$user_id = $_POST['user_id'];
$referral_number = $_POST['referral_number'];

echo $user_id;
echo "<br>";
echo $referral_number;
echo "<br>";

//user_payment_check
$user_payment_check = $dbConn->query("SELECT
    *
 FROM user
 WHERE user_id IN ('$user_id')
 AND payment_status IN ('$inactive')
    ");

while($row = $user_payment_check->fetch(PDO::FETCH_ASSOC)) {
    $payment_status = $row['payment_status'];
}

//if paid
if (isset($payment_status)) {


	//referral_number_user_data
$referral_number_user_data = $dbConn->query("SELECT
    *
 FROM user
 WHERE referral_number IN ('$referral_number')
 AND payment_status IN ('$inactive')
    ");

while($row = $referral_number_user_data->fetch(PDO::FETCH_ASSOC)) {
    $referral_number_user_data_referral_count = $row['referral_count'];

    //if less than 4 insert and update count
    if ($referral_number_user_data_referral_count < 4) {
    	echo "insert data and update count";
    }

}


}
else{
	echo "not paid";
}


}

?>

<form action="" method="POST">
	<table>
		<tr>
		<th>User ID</th>
		<td><input type="number" name="user_id" min="6" max="1000"></td>
		</tr>
		<tr>
		<th>Referral number</th>
		<td><input type="number" name="referral_number" min="1" max="1000" value="1"></td>
		</tr>
		<tr>
			<td><input type="submit" name="referral_number_input" value="submit"></td>
		</tr>
	</table>
	
	
</form>