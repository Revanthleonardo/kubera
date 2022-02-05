<?php
include "../config.php";

session_start();
$user_name = $_SESSION["user_name"];

if ($user_name == "") {
    header("Location: login.php");
  }

$user_id = $_GET['user_id'];

//user_data_for_member_list_info
$user_data_for_member_list_info = $dbConn->query("SELECT
    *
 FROM user
    WHERE user_id IN ('$user_id') 
    ");

while($row = $user_data_for_member_list_info->fetch(PDO::FETCH_ASSOC)) {
    $name = $row['name'];
    $mobile_number = $row['mobile_number'];
    $email = $row['email'];
    $registered_date = $row['registered_date'];
    $level = $row['level'];
    $referral_number = $row['referral_number'];
    $avg_count = $row['avg_count'];
    $password = $row['password'];

    //for stage_1 1 to 4
    if($avg_count >= "1" && $avg_count <= "4"){
        $stage = "1";
    }

    //for stage_2 5 to 20
    if($avg_count >= "5" && $avg_count <= "20"){
        $stage = "2";
    }

    //for stage_2 21 to 84
    if($avg_count >= "21" && $avg_count <= "84"){
        $stage = "3";
    }
}


//bank_details_data
$bank_details_data = $dbConn->query("SELECT
    *
 FROM bank_details
    WHERE mobile_number IN ('$mobile_number') 
    ");

while($row = $bank_details_data->fetch(PDO::FETCH_ASSOC)) {
    $account_holder_name = $row['account_holder_name'];
    $account_no = $row['account_no'];
    $ifsc_code = $row['ifsc_code'];
    $bank_name = $row['bank_name'];
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
                <div class="col-md-9" style="margin-left:20px ;">
                                        <div id="fixed_single_div" class="container"
                        style="background-color:#ffffff; margin: 10px; border-radius: 20px  ; ">
                        <!--First Row Start-->
                        <h5 style="margin-top: 20px;text-align: center;"><?php echo $name; ?> <a href="member_list.php" class="btn btn-primary" style="float: right;">Back</a></h5>

                        <table class="table table-bordered table-hover" style="margin-top: 10px;">
                        <?php
                        echo "
                        <tr>
                        <td>Name</td>
                        <td>$name</td>

                        <td>Acc holder name</td>
                        <td>$account_holder_name</td>
                        </tr>
                        <tr>
                        <td>Mobile number</td>
                        <td>$mobile_number</td>

                        <td>Acc no</td>
                        <td>$account_no</td>
                        </tr>
                        <tr>
                        <td>Password</td>
                        <td>$password</td>

                        <td>IFSC</td>
                        <td>$ifsc_code</td>
                        </tr>
            
                        <tr>
                        <td>Registered date</td>
                        <td>$registered_date</td>

                        <td>Bank name</td>
                        <td>$bank_name</td>
                        </tr>
                        <tr>
                        <td>Level</td>
                        <td>$level</td>
                        </tr>
                        <tr>
                        <td>Stage</td>
                        <td>$stage</td>
                        </tr>
                        <tr>
                        <td>Count</td>
                        <td>$avg_count</td>
                        </tr>
                        ";
                        ?>
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