<?php
include "../config.php";

//user_data_for_payment_list
$user_data_for_payment_list = $dbConn->query("SELECT
    payment.payment_id_razorpay,
    user.name,
    payment.payment_date,
    payment.payment_id,
    payment.book_id,
    book.book_name
 FROM payment
  LEFT JOIN 
  user ON
  user.mobile_number = payment.mobile_number
  LEFT JOIN 
  book ON
  book.book_id = payment.book_id
    ");

$payment_list_count = 1;

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
                        <h5 style="margin-top: 20px;text-align: center;">Purchases</h5>
                        <table class="table table-bordered table-hover" id="example" style="margin-top: 10px;">
                            <thead>
                                <tr>
                                    <th class="bg-dark text-white">Sl No</th>
                                    <th class="bg-dark text-white">P ID</th>
                                    <th class="bg-dark text-white">Name</th>
                                    <th class="bg-dark text-white">PU Date</th>
                                </tr>
                            </thead>
                            <tbody>
                        <?php
while($row = $user_data_for_payment_list->fetch(PDO::FETCH_ASSOC)) {
    $payment_id_razorpay = $row['payment_id_razorpay'];
    $name = $row['name'];
    $payment_date = $row['payment_date'];
    $payment_id = $row['payment_id'];


    echo "

    <tr>
        <td>".$payment_list_count++."</td>
        <td>$payment_id_razorpay</td>
        <td>$name</td>
        <td>$payment_date</td>
    </tr>

    ";
}
    ?>
                                            
                            </tbody>
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
<script>
    $(document).ready(function() {
    $('#example').DataTable();
} );
</script>

</html>