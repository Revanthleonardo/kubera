<?php
include "../config.php";

session_start();
$user_name = $_SESSION["user_name"];

if ($user_name == "") {
  header("Location: login.php");
}

$user_id_input = $_GET['user_id'];
$selected_user_id = $_GET['selected_user_id'];

$level_data = $dbConn->query("SELECT 
*
  FROM user   
  WHERE user_id IN ('$user_id_input')
");
while($row = $level_data->fetch(PDO::FETCH_ASSOC)) {
$level_input = $row['level'];
$actual_user_name = $row['name'];
}

//stage_1
$stage_1_data = $dbConn->query("SELECT 
*
  FROM user   
  WHERE referral_id IN ('$user_id_input')
  AND level IN ('$level_input')
");
while($row = $stage_1_data->fetch(PDO::FETCH_ASSOC)) {

$stage_1_user_id[] = $row['user_id'];
}
//stage_1

//stage_2
foreach ($stage_1_user_id as $key => $stage_1_user_id_value) {
$stage_2_data = $dbConn->query("SELECT 
*
  FROM user   
  WHERE referral_id IN ('$stage_1_user_id_value')
  AND level IN ('$level_input')
  
");
while($row = $stage_2_data->fetch(PDO::FETCH_ASSOC)) {

$stage_2_user_id[] = $row['user_id'];
}
}
//stage_2

$actual_array = array_merge($stage_1_user_id,$stage_2_user_id);


if (isset($selected_user_id)) {

$user_data = $dbConn->query("SELECT 
*
  FROM user   
  WHERE user_id IN ('$selected_user_id')
");
while($row = $user_data->fetch(PDO::FETCH_ASSOC)) {
$user_name = $row['name'];
$user_referral_number = $row['referral_number'];
}

$view_tree_user_data = $dbConn->query("SELECT
    user_id,
    name,
    referral_number,
    level
 FROM user
 WHERE referral_id IN ('$selected_user_id')
 AND level IN ('$level_input')
    ");

while($row = $view_tree_user_data->fetch(PDO::FETCH_ASSOC)) {
    $view_tree_user_id[] = $row['user_id'];
    $view_tree_name[] = $row['name'];
    $view_tree_referral_number[] = $row['referral_number'];
    $view_tree_level[] = $row['level'];
}

}

else{

$user_data = $dbConn->query("SELECT 
*
  FROM user   
  WHERE user_id IN ('$user_id_input')
");
while($row = $user_data->fetch(PDO::FETCH_ASSOC)) {
$user_name = $row['name'];
$user_referral_number = $row['referral_number'];
}

$view_tree_user_data = $dbConn->query("SELECT
    user_id,
    name,
    referral_number,
    level
 FROM user
 WHERE referral_id IN ('$user_id_input')
 AND level IN ('$level_input')
    ");

while($row = $view_tree_user_data->fetch(PDO::FETCH_ASSOC)) {
    $view_tree_user_id[] = $row['user_id'];
    $view_tree_name[] = $row['name'];
    $view_tree_referral_number[] = $row['referral_number'];
    $view_tree_level[] = $row['level'];
}

}


/*
if (in_array("4", $actual_array))
  {
  echo "Match found";
  }
else
  {
  echo "Match not found";
  }
*/





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
                        style="background-color:#ffffff; margin: 10px; border-radius: 20px ; display: grid; place-items:center; ">

                <h1><?php
                echo " 
                <a class=\"text-decoration-none text-dark\" href=\"tree_view.php?user_id=$user_id_input\"> $actual_user_name | level - $level_input </a> ";
                ?></h1>

            	<div class="row" >
            		<div class="col-12 text-center">
            			<h4><?php echo $user_name; ?></h4>
                        <h4><?php echo $user_referral_number; ?></h4>
                        <hr class="vertical_line" >
            		</div>

                    <div class="col-12 text-center">
                        <hr>
                    </div>

                    <?php
                    //0
                    if (in_array($view_tree_user_id[0], $actual_array))
                    {
                    echo "
                    <div class=\"col-3 text-center\">
                        <hr class=\"vertical_line\" >
                        <h4>
                        <a class=\"text-decoration-none text-dark\" href=\"tree_view.php?user_id=$user_id_input&&selected_user_id=$view_tree_user_id[0]\"> $view_tree_name[0] </a>
                        <br>
                        <a class=\"text-decoration-none text-dark\" href=\"tree_view.php?user_id=$user_id_input&&selected_user_id=$view_tree_user_id[0]\"> $view_tree_referral_number[0]</a>
                        </h4>
                    </div>
                    ";
                    }
                    else
                    {
                    echo "
                    <div class=\"col-3 text-center\">
                        <hr class=\"vertical_line\" >
                        <h4>
                        <a class=\"text-decoration-none text-dark\" href=\"#\"> $view_tree_name[0] </a>
                        <br>
                        <a class=\"text-decoration-none text-dark\" href=\"#\"> $view_tree_referral_number[0]</a>
                        </h4>
                    </div>
                    ";
                    }
                    
                    ?>

            		<?php
                    //1
                    if (in_array($view_tree_user_id[1], $actual_array))
                    {
                    echo "
                    <div class=\"col-3 text-center\">
                        <hr class=\"vertical_line\" >
                        <h4>
                        <a class=\"text-decoration-none text-dark\" href=\"tree_view.php?user_id=$user_id_input&&selected_user_id=$view_tree_user_id[1]\"> $view_tree_name[1] </a>
                        <br>
                        <a class=\"text-decoration-none text-dark\" href=\"tree_view.php?user_id=$user_id_input&&selected_user_id=$view_tree_user_id[1]\"> $view_tree_referral_number[1]</a>
                        </h4>
                    </div>
                    ";
                    }
                    else
                    {
                    echo "
                    <div class=\"col-3 text-center\">
                        <hr class=\"vertical_line\" >
                        <h4>
                        <a class=\"text-decoration-none text-dark\" href=\"#\"> $view_tree_name[1] </a>
                        <br>
                        <a class=\"text-decoration-none text-dark\" href=\"#\"> $view_tree_referral_number[1]</a>
                        </h4>
                    </div>
                    ";
                    }
                    
                    ?>

            		<?php
                    //2
                    if (in_array($view_tree_user_id[2], $actual_array))
                    {
                    echo "
                    <div class=\"col-3 text-center\">
                        <hr class=\"vertical_line\" >
                        <h4>
                        <a class=\"text-decoration-none text-dark\" href=\"tree_view.php?user_id=$user_id_input&&selected_user_id=$view_tree_user_id[2]\"> $view_tree_name[2] </a>
                        <br>
                        <a class=\"text-decoration-none text-dark\" href=\"tree_view.php?user_id=$user_id_input&&selected_user_id=$view_tree_user_id[2]\"> $view_tree_referral_number[2]</a>
                        </h4>
                    </div>
                    ";
                    }
                    else
                    {
                    echo "
                    <div class=\"col-3 text-center\">
                        <hr class=\"vertical_line\" >
                        <h4>
                        <a class=\"text-decoration-none text-dark\" href=\"#\"> $view_tree_name[2] </a>
                        <br>
                        <a class=\"text-decoration-none text-dark\" href=\"#\"> $view_tree_referral_number[2]</a>
                        </h4>
                    </div>
                    ";
                    }
                    
                    ?>

            		<?php
                    //3
                    if (in_array($view_tree_user_id[3], $actual_array))
                    {
                    echo "
                    <div class=\"col-3 text-center\">
                        <hr class=\"vertical_line\" >
                        <h4>
                        <a class=\"text-decoration-none text-dark\" href=\"tree_view.php?user_id=$user_id_input&&selected_user_id=$view_tree_user_id[3]\"> $view_tree_name[3] </a>
                        <br>
                        <a class=\"text-decoration-none text-dark\" href=\"tree_view.php?user_id=$user_id_input&&selected_user_id=$view_tree_user_id[3]\"> $view_tree_referral_number[3]</a>
                        </h4>
                    </div>
                    ";
                    }
                    else
                    {
                    echo "
                    <div class=\"col-3 text-center\">
                        <hr class=\"vertical_line\" >
                        <h4>
                        <a class=\"text-decoration-none text-dark\" href=\"#\"> $view_tree_name[3] </a>
                        <br>
                        <a class=\"text-decoration-none text-dark\" href=\"#\"> $view_tree_referral_number[3]</a>
                        </h4>
                    </div>
                    ";
                    }
                    
                    ?>
            		
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