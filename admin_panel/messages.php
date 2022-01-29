<?php
include "../config.php";

session_start();
$user_name = $_SESSION["user_name"];

if ($user_name == "") {
  header("Location: login.php");
}

$mobile_number = $_GET['view_user'];

//send_message
if(isset($_POST['send_message'])) { 

$mobile_number = $_POST['mobile_number'];
$message = addslashes($_POST['message']);
$sent_by = "admin";

    //inserting_user
  $dbConn->query("INSERT INTO `message` (
    `mobile_number`,
    `message`,
    `sent_by`,
    `date`,
    `time`,
    `notification`
    ) 
    VALUES (
    '{$mobile_number}',
    '{$message}',
    '{$sent_by}',
    '{$date}',
    '{$time}',
    '{$active}'
    )
    ;");

header("Location:messages.php?view_user=".$mobile_number);
}

//update_data
if(isset($_REQUEST['view_user'])){

//get_user_name
$get_user_name = $dbConn->query("SELECT
    *
 FROM user
 WHERE mobile_number IN ('$mobile_number')
    ");
while($row = $get_user_name->fetch(PDO::FETCH_ASSOC)) {
    $user_name = $row['name'];
}


//view_message
$view_message = $dbConn->query("SELECT
    *
 FROM message
 WHERE mobile_number IN ('$mobile_number')
    ");

//reset notification
        $dbConn->query("UPDATE `message` 
       SET `notification` = '$active'
       WHERE mobile_number IN ('$mobile_number')");

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


    <div id="head" class="container-fluid">
        <div class="head">
            <div class="col-2 p-4">
                <a href=""><img src="images/kuberaa.png" alt="Trulli" width="50" height="50" left=-20px></a>
                <span class="header">Kuberaa</span>
            </div>
            <div class="row " style="border-top: 2px solid rgb(206, 201, 201);">
                <!-- navbar  -->
                <?php include "nav_bar.php" ?>

                <!--Secand Column Start-->
                <div class="col-md-9 row" style="margin-left:20px ;">

<!-- user div -->

<div id="fixed_single_div" class="container col-5" style="background-color:#ffffff; margin: 10px; border-radius: 20px ; ">
                        <!-- add data -->
                        <table class="table table-bordered table-hover" style="margin-top: 10px;">
                            <thead>
                                <tr>
                                    <?php

                                    //user_data_for_member_list
$user_data_for_message = $dbConn->query("SELECT
 DISTINCT
 user.mobile_number,
 user.name,
 message.notification
 FROM user
 LEFT JOIN 
  message ON
  message.mobile_number = user.mobile_number
    WHERE user.status IN ('$active')
    ORDER BY message.notification DESC

    ");
while($row = $user_data_for_message->fetch(PDO::FETCH_ASSOC)) {
    $mobile_number_left_bar = $row['mobile_number'];
    $name = $row['name'];
    $notification = $row['notification'];

    if ($notification == "1") {
        echo "
            <tr>
            <th><a href=\"messages.php?view_user=$mobile_number_left_bar\" class=\"btn btn-primary\" style=\"float:right;\">$name</a></th>
            </tr>
            ";
    }
    else{
         echo "
            <tr>
            <th><a href=\"messages.php?view_user=$mobile_number_left_bar\" class=\"btn\" style=\"float:right;\">$name</a></th>
            </tr>
            ";

    }

                                    

    }
                                    ?>
                                </tr>
                            </thead>
                        </table>

</div>

<!-- message div -->

<div id="message_div" class="container col-6" style="background-color:#ffffff; margin: 10px; border-radius: 20px ;">
    <div class="row">
    <h1 style="float:right;"><?php echo $user_name; ?></h1>
    
<div class="container" style="height: 50vh; overflow: auto;">
<table class="table table-borderless table-hover" style="margin-top: 10px;">
<?php


while($row = $view_message->fetch(PDO::FETCH_ASSOC)) {
    $message = $row['message'];
    $date = $row['date'];
    $time = $row['time'];
    $sent_by = $row['sent_by'];

if ($sent_by == "user") {
    echo "
    
        <tr>
        <td class=\"bg-dark text-white rounded\" style=\"float:right;\">$message</td>
        </tr>

    ";
}

if ($sent_by == "admin") {
    echo "
    
        <tr>
        <td class=\"bg-warning rounded\" style=\"float:left;\">$message</td>
        </tr>

    ";
}
echo "<tr><th><th></tr>";
    
}

?>
</table>
</div>
<div class="container" style="height: 10vh;">
<table>
    <form action="" method="POST">
    <tr>
        <td class="col-10"><input type="text" class="form-control" name="message" required></td>
        <input type="hidden" value="<?php echo $mobile_number; ?>" name="mobile_number">
        <td><input type="submit" class="btn btn-lg btn-primary" value="Send" name="send_message"></td>
    </tr>
    </form>
</table>
</div>
                </div>
                </div>

                    <div class="row">
                        <div class="col">
                            <h5>Copywrites@Kuberaa</h5>
                        </div>
                        <div class="col" style="text-align: center;">
                            <h5>Powered by Besttech</h5>
                        </div>
                    </div>
                </div>

            </div>




        </div>
    </div>


</body>


</html>