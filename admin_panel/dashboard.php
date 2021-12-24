<?php
include "../config.php";

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
                    <div id="fixed" class="container"
                        style="background-color:#ffffff; margin: 10px; border-radius: 20px  ; ">
                        <!--First Row Start-->
                        <div class="row" style="margin-bottom:30px ;">
                            <div id="chart" class="col p-4  text-white"
                                style="border-radius: 15px; background-color:#2BBABA;">
                                <div class="row">
                                    <div class="col-6">
                                        <h2><?php echo $total_user_count; ?></h2>
                                    </div>
                                    <div class="col-6">
                                        <i id="icon" class="fas fa-user-circle"></i>
                                    </div>
                                </div>
                                <div class="row" style="text-align: center;">
                                    <h4>Total Member</h4>
                                </div>
                            </div>
                            <div id="chart" class="col p-4  text-white "
                                style="border-radius: 15px; background-color: #52F543;">
                                <div class="row">
                                    <div class="col-6">
                                        <h2><?php echo $total_payment_count; ?></h2>
                                    </div>
                                    <div class="col-6">
                                        <i id="icon" class="fas fa-rupee-sign"></i>
                                    </div>
                                </div>
                                <div class="row" style="text-align: center;">
                                    <h4>Total Purchase</h4>
                                </div>
                            </div>
                            <div id="chart" class="col p-4  text-white "
                                style="border-radius: 15px; background-color: #F1F524;">
                                <div class="row">
                                    <div class="col-6">
                                        <h2><?php echo $total_book_count; ?></h2>
                                    </div>
                                    <div class="col-6">
                                        <i id="icon" class="fas fa-book"></i>
                                    </div>
                                </div>
                                <div class="row" style="text-align: center;">
                                    <h4>Total Books</h4>
                                </div>
                            </div>
                        </div>
                        <!--Heading-->
                        <div class="col text-center">
                            <h5>Members By Levels</h5>
                        </div>
                        <!--Secand Row Start-->
                        <div class="row" style="margin-bottom:30px ;">
                            <div id="chart" class="col p-4  text-white"
                                style="border-radius: 15px; background-color:#CCF4FA;">
                                <div class="row text-dark">
                                    <div class="col-6">
                                        <h2><?php  echo $total_user_level_1_count; ?></h2>
                                    </div>
                                    <div class="col-6">
                                        <i id="icon-1" class="fas fa-users"></i>
                                    </div>
                                </div>
                                <div class="row text-dark" style="text-align: center;">
                                    <h4>Level 1</h4>
                                </div>
                            </div>
                            <div id="chart" class="col p-4  text-white "
                                style="border-radius: 15px; background-color: #94e8f3">
                                <div class="row text-dark">
                                    <div class="col-6">
                                        <h2>1</h2>
                                    </div>
                                    <div class="col-6">
                                        <i id="icon-1" class="fas fa-users"></i>
                                    </div>
                                </div>
                                <div class="row text-dark" style="text-align: center;">
                                    <h4>Level 2</h4>
                                </div>
                            </div>
                            <div id="chart" class="col p-4  text-white "
                                style="border-radius: 15px; background-color: #4FE9FE;">
                                <div class="row text-dark">
                                    <div class="col-6">
                                        <h2>1</h2>
                                    </div>
                                    <div class="col-6">
                                        <i id="icon-1" class="fas fa-users"></i>
                                    </div>
                                </div>
                                <div class="row text-dark" style="text-align: center;">
                                    <h4>Level 3</h4>
                                </div>
                            </div>
                            <div id="chart" class="col p-4  text-white "
                                style="border-radius: 15px; background-color: #00CEEA;">
                                <div class="row text-dark">
                                    <div class="col-6">
                                        <h2>1</h2>
                                    </div>
                                    <div class="col-6">
                                        <i id="icon-1" class="fas fa-users"></i>
                                    </div>
                                </div>
                                <div class="row text-dark" style="text-align: center;">
                                    <h4>Level 4</h4>
                                </div>
                            </div>


                        </div>


                        <!--Heading 2-->
                        <div class="col text-center">
                            <h5>Level-1 Member By Stages</h5>
                        </div>
                        <!--Third Row Start-->
                        <div class="row" style="margin-bottom:30px ;">
                            <div id="chart" class="col p-4  text-white"
                                style="border-radius: 15px; background-color:#D99C79;">
                                <div class="row text-dark">
                                    <div class="col-6">
                                        <h2>1</h2>
                                    </div>
                                    <div class="col-6">
                                        <i id="icon-1" class="fas fa-users"></i>
                                    </div>
                                </div>
                                <div class="row text-dark" style="text-align: center;">
                                    <h4>Stage 1</h4>
                                </div>
                            </div>
                            <div id="chart" class="col p-4  text-white "
                                style="border-radius: 15px; background-color: #F26A4B">
                                <div class="row text-dark">
                                    <div class="col-6">
                                        <h2>1</h2>
                                    </div>
                                    <div class="col-6">
                                        <i id="icon-1" class="fas fa-users"></i>
                                    </div>
                                </div>
                                <div class="row text-dark" style="text-align: center;">
                                    <h4>Stage 2</h4>
                                </div>
                            </div>
                            <div id="chart" class="col p-4  text-white "
                                style="border-radius: 15px; background-color: #F23005;">
                                <div class="row text-dark">
                                    <div class="col-6">
                                        <h2>1</h2>
                                    </div>
                                    <div class="col-6">
                                        <i id="icon-1" class="fas fa-users"></i>
                                    </div>
                                </div>
                                <div class="row text-dark" style="text-align: center;">
                                    <h4>Stage 3</h4>
                                </div>
                            </div>
                        </div>
                        <!--Heading 3-->
                        <div class="col text-center">
                            <h5>Level-2 Member By Stages</h5>
                        </div>
                        <!--Fourth Row Start-->
                        <div class="row" style="margin-bottom:30px ;">
                            <div id="chart" class="col p-4  text-white"
                                style="border-radius: 15px; background-color:#F2D785;">
                                <div class="row text-dark">
                                    <div class="col-6">
                                        <h2>1</h2>
                                    </div>
                                    <div class="col-6">
                                        <i id="icon-1" class="fas fa-users"></i>
                                    </div>
                                </div>
                                <div class="row text-dark" style="text-align: center;">
                                    <h4>Stage 1</h4>
                                </div>
                            </div>
                            <div id="chart" class="col p-4  text-white "
                                style="border-radius: 15px; background-color: #F2BC1B">
                                <div class="row text-dark">
                                    <div class="col-6">
                                        <h2>1</h2>
                                    </div>
                                    <div class="col-6">
                                        <i id="icon-1" class="fas fa-users"></i>
                                    </div>
                                </div>
                                <div class="row text-dark" style="text-align: center;">
                                    <h4>Stage 2</h4>
                                </div>
                            </div>
                            <div id="chart" class="col p-4  text-white "
                                style="border-radius: 15px; background-color: #F2CE16;">
                                <div class="row text-dark">
                                    <div class="col-6">
                                        <h2>1</h2>
                                    </div>
                                    <div class="col-6">
                                        <i id="icon-1" class="fas fa-users"></i>
                                    </div>
                                </div>
                                <div class="row text-dark" style="text-align: center;">
                                    <h4>Stage 3</h4>
                                </div>
                            </div>
                        </div>
                        <!--Heading 4-->
                        <div class="col text-center">
                            <h5>Level-3 Member By Stages</h5>
                        </div>
                        <!--Fifth Row Start-->
                        <div class="row" style="margin-bottom:30px ;">
                            <div id="chart" class="col p-4  text-white"
                                style="border-radius: 15px; background-color:#C5CED9;">
                                <div class="row text-dark">
                                    <div class="col-6">
                                        <h2>1</h2>
                                    </div>
                                    <div class="col-6">
                                        <i id="icon-1" class="fas fa-users"></i>
                                    </div>
                                </div>
                                <div class="row text-dark" style="text-align: center;">
                                    <h4>Stage 1</h4>
                                </div>
                            </div>
                            <div id="chart" class="col p-4  text-white "
                                style="border-radius: 15px; background-color: #8a81ac">
                                <div class="row text-dark">
                                    <div class="col-6">
                                        <h2>1</h2>
                                    </div>
                                    <div class="col-6">
                                        <i id="icon-1" class="fas fa-users"></i>
                                    </div>
                                </div>
                                <div class="row text-dark" style="text-align: center;">
                                    <h4>Stage 2</h4>
                                </div>
                            </div>
                            <div id="chart" class="col p-4  text-white "
                                style="border-radius: 15px; background-color: #B2A0D9;">
                                <div class="row text-dark">
                                    <div class="col-6">
                                        <h2>1</h2>
                                    </div>
                                    <div class="col-6">
                                        <i id="icon-1" class="fas fa-users"></i>
                                    </div>
                                </div>
                                <div class="row text-dark" style="text-align: center;">
                                    <h4>Stage 3</h4>
                                </div>
                            </div>
                        </div>
                        <!--Heading 5-->
                        <div class="col text-center">
                            <h5>Level-4 Member By Stages</h5>
                        </div>
                        <!--sixth Row Start-->
                        <div class="row" style="margin-bottom:30px ;">
                            <div id="chart" class="col p-4  text-white"
                                style="border-radius: 15px; background-color:#eb688f;">
                                <div class="row text-dark">
                                    <div class="col-6">
                                        <h2>1</h2>
                                    </div>
                                    <div class="col-6">
                                        <i id="icon-1" class="fas fa-users"></i>
                                    </div>
                                </div>
                                <div class="row text-dark" style="text-align: center;">
                                    <h4>Stage 1</h4>
                                </div>
                            </div>
                            <div id="chart" class="col p-4  text-white "
                                style="border-radius: 15px; background-color: #db3a6b">
                                <div class="row text-dark">
                                    <div class="col-6">
                                        <h2>1</h2>
                                    </div>
                                    <div class="col-6">
                                        <i id="icon-1" class="fas fa-users"></i>
                                    </div>
                                </div>
                                <div class="row text-dark" style="text-align: center;">
                                    <h4>Stage 2</h4>
                                </div>
                            </div>
                            <div id="chart" class="col p-4  text-white "
                                style="border-radius: 15px; background-color: #ff034e;">
                                <div class="row text-dark">
                                    <div class="col-6">
                                        <h2>1</h2>
                                    </div>
                                    <div class="col-6">
                                        <i id="icon-1" class="fas fa-users"></i>
                                    </div>
                                </div>
                                <div class="row text-dark" style="text-align: center;">
                                    <h4>Stage 3</h4>
                                </div>
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