<?php
	// Authorisation details.	
	$username = "kuberaatechnologies@gmail.com";
	$hash = "952d864be5d8d4bbb35f695b9b2978e7356c854271e7b4834afdfe76a5db0651";
	
	// You shouldn't need to change anything here.	
	$data = "username=".$username."&hash=".$hash;
	$ch = curl_init('http://api.textlocal.in/balance/?');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$credits = curl_exec($ch);
	// This is the number of credits you have left	
	curl_close($ch);

	echo $credits;
?>