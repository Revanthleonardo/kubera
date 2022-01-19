<?php
include "../config.php";


//send_message
if(isset($_POST['send_message'])) { 

$message = addslashes($_POST['message']);
$sent_by = "admin";


//broadcast_to_mobile_number
$broadcast_to_mobile_number = $dbConn->query("SELECT
    *
 FROM user
 WHERE level_update_count_status IN ('$active')
    ");
while($row = $broadcast_to_mobile_number->fetch(PDO::FETCH_ASSOC)) {
    $mobile_number = $row['mobile_number'];
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
}

echo "<script type='text/javascript'>alert('Sent');
  window.location.href = 'index.php';
  </script>";    

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.11.3/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.11.3/datatables.min.js"></script>

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
                <div class="col-md-9" style="margin-left:20px ;">
                                        <div id="fixed_single_div" class="container"
                        style="background-color:#ffffff; margin: 10px; border-radius: 20px  ; ">
                        <!--First Row Start-->
                        <h5 style="margin-top: 20px;text-align: center;">Broadcast</h5>
                        <form action="" method="POST">
                        <table class="table table-bordered table-hover" style="margin-top: 10px;">
                                <tr>
                                    <th class="bg-dark text-white">Message</th>
                                </tr>
                                <tr>
                                    <td><textarea name="message" id="" cols="30" rows="10" class="form-control" required></textarea></td>
                                </tr>
                                <tr><td><input type="submit" class="btn btn-primary" value="Send" name="send_message"></td></tr>
                                            
                            </tbody>
                        </table>
                    </form>
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