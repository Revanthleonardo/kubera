<?php
include "../config.php";


$user_id = $_GET['view_user'];

//send_message
if(isset($_POST['send_message'])) { 

$user_id = $_POST['user_id'];
$message = addslashes($_POST['message']);
$sent_by = "admin";

    //inserting_user
  $dbConn->query("INSERT INTO `message` (
    `user_id`,
    `message`,
    `sent_by`,
    `date`,
    `time`
    ) 
    VALUES (
    '{$user_id}',
    '{$message}',
    '{$sent_by}',
    '{$date}',
    '{$time}'
    )
    ;");

header("Location:messages.php?view_user=".$user_id);
}

//update_data
if(isset($_REQUEST['view_user'])){

//get_user_name
$get_user_name = $dbConn->query("SELECT
    *
 FROM user
 WHERE user_id IN ('$user_id')
    ");
while($row = $get_user_name->fetch(PDO::FETCH_ASSOC)) {
    $user_name = $row['name'];
}


//view_message
$view_message = $dbConn->query("SELECT
    *
 FROM message
 WHERE user_id IN ('$user_id')
    ");

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
    *
 FROM user
    WHERE user.status IN ('$active') 
    ");
while($row = $user_data_for_message->fetch(PDO::FETCH_ASSOC)) {
    $user_id_left_bar = $row['user_id'];
    $name = $row['name'];
                                    echo "
                                    <tr>
                                    <th><a href=\"messages.php?view_user=$user_id_left_bar\" class=\"btn\" style=\"float:right;\">$name</a></th>
                                    </tr>
                                    ";

    }
                                    ?>
                                </tr>
                            </thead>
                        </table>

</div>

<!-- message div -->

<div id="fixed_single_div" class="container col-6" style="background-color:#ffffff; margin: 10px; border-radius: 20px ; ">
    <h1 style="float:right;"><?php echo $user_name; ?></h1>

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
    
}

?>
</table>

<table style="position: absolute;
    bottom: 15%;">
    <form action="" method="POST">
    <tr>
        <td class="col-10"><input type="text" class="form-control" name="message" required></td>
        <td><input type="submit" class="btn btn-lg btn-primary" value="Send" name="send_message"></td>
        <input type="hidden" value="<?php echo $user_id; ?>" name="user_id">
    </tr>
    </form>
</table>
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