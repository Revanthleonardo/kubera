<?php
include "../config.php";

session_start();
$user_name = $_SESSION["user_name"];

if ($user_name == "") {
  header("Location: login.php");
}

$graph_data = $dbConn->query("SELECT 
  count(mobile_number) as mobile_number_count,
  month_and_year
  FROM payment
  GROUP BY month_and_year
 ");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuberaa</title>

    <?php include"include.php"; ?>
    <script type = "text/javascript" src = "https://www.gstatic.com/charts/loader.js">
      </script>
      <script type = "text/javascript">
         google.charts.load('current', {packages: ['corechart']});     
      </script>
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

                        <div id = "container" style = "width: 550px; height: 400px; margin: 0 auto">

      </div>
      <script language = "JavaScript">
         function drawChart() {
            // Define the chart to be drawn.
            var data = google.visualization.arrayToDataTable([
               ['month', 'users'],
               <?php
                    while($row = $graph_data->fetch(PDO::FETCH_ASSOC)) {
                        echo "['".$row["month_and_year"]."', ".$row["mobile_number_count"]."],";
                    }
                ?>
            ]);

            
            var options = {title: 'Payment data',legend: { position: 'bottom' }}; 

            // Instantiate and draw the chart.
            var chart = new google.visualization.ColumnChart(document.getElementById('container'));
            chart.draw(data, options);
         }
         google.charts.setOnLoadCallback(drawChart);
      </script>


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