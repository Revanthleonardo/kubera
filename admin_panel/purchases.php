<?php
include "../config.php";

include "query.php";

$payment_list_count = 1;

//add_payment_list
if(isset($_POST['add_payment_list'])) { 

$payment_name = $_POST['payment_name'];

  //image
$file_name = basename($_FILES["fileToUpload"]["name"]);
$target_dir = "../uploads/";
$file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
$target_file = $target_dir . $time_random .".".$file_extension ;

if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

    $dbConn->query("INSERT INTO `payment` (
    `payment_name`,
    `payment_image`
    ) 
    VALUES (
    '{$payment_name}',
    '{$target_file}'
    )
    ;");

echo "<script type='text/javascript'>alert('Updated');
  window.location.href = 'payment.php';
  </script>";

}

}

//update_data
if(isset($_REQUEST['edit_payment'])){
$payment_id = $_REQUEST['edit_payment'];
$update_data_view = $hide;

$edit_payment = $dbConn->query("SELECT 
  * 
  FROM payment 
  WHERE payment_id IN ('$payment_id')");
while($row = $edit_payment->fetch(PDO::FETCH_ASSOC)) {
    $edit_payment_name = $row['payment_name'];
    $edit_payment_id = $row['payment_id'];
}
}


//update_selected_data
if(isset($_POST['edit_selected_payment'])) { 
$payment_name = $_POST['payment_name'];
$payment_id = $_POST['payment_id'];

$file_name = basename($_FILES["fileToUpload"]["name"]);
$target_dir = "../uploads/";
$file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
$target_file = $target_dir . $time_random .".".$file_extension ;

    $dbConn->query("UPDATE `payment` 
        SET `payment_name` = '$payment_name'
         WHERE payment_id IN ('$payment_id')");

if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    $dbConn->query("UPDATE `payment` 
        SET `payment_image` = '$target_file'
         WHERE payment_id IN ('$payment_id')");
}

echo "<script type='text/javascript'>alert('Updated');
  window.location.href = 'payment.php';
  </script>";

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

<!-- add_payment -->

<div id="fixed_add_div" class="container" <?php echo $update_data_view; ?>
                        style="background-color:#ffffff; margin: 10px; border-radius: 20px ; ">
                        <!-- add data -->
                        <table class="table table-bordered table-hover" style="margin-top: 10px;">
                            <thead>
                                <tr>
                                    <th class="bg-dark text-white">payment Name</th>
                                    <th class="bg-dark text-white">payment Image</th>
                                    <th class="bg-dark text-white">Add</th>
                                </tr>
                            </thead>
                            <tbody>
                                <form action="" method="POST" enctype = "multipart/form-data">
                                    <td><input type="text" placeholder="payment_name" name="payment_name" class="form-control" required></td>
                                    <td><input type="file" name="fileToUpload" class="form-control" required></td>
                                    <td><button type="submit"  name="add_payment_list" class="btn btn-primary">Add</button></td>
                                </form>
                            </tbody>
                        </table>

</div>


<!-- edit_payment -->

<div id="fixed_add_div" class="container"
<?php
if ($update_data_view === NULL) {
   echo $hide;
 } 
 ?>
                        style="background-color:#ffffff; margin: 10px; border-radius: 20px  ; ">
                        <!-- add data -->
                        <table class="table table-bordered table-hover" style="margin-top: 10px;">
                            <thead>
                                <tr>
                                    <th class="bg-dark text-white">payment Name</th>
                                    <th class="bg-dark text-white">payment Image</th>
                                    <th class="bg-dark text-white">Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <form action="" method="POST" enctype = "multipart/form-data">
                                    <td><input type="text" placeholder="payment_name" name="payment_name" class="form-control" required 
                                        value="<?php echo $edit_payment_name; ?>"></td>
                                    <td><input type="file" name="fileToUpload" class="form-control" ></td>
                                    <input type="hidden" value="<?php echo $edit_payment_id; ?>" name="payment_id">
                                    <td><button type="submit"  name="edit_selected_payment" class="btn btn-primary">Edit</button></td>
                                </form>
                            </tbody>
                        </table>

</div>

                                        <div id="fixed" class="container"
                        style="background-color:#ffffff; margin: 10px; border-radius: 20px  ; ">
                        <!--First Row Start-->
                        <h5 style="margin-top: 20px;text-align: center;">payment List</h5>
                        <table class="table table-bordered table-hover" style="margin-top: 10px;">
                            <thead>
                                <tr>
                                    <th class="bg-dark text-white">Sl No</th>
                                    <th class="bg-dark text-white">payment Name</th>
                                    <th class="bg-dark text-white">payment Image</th>
                                    <th class="bg-dark text-white">Edit</th>
                                    <th class="bg-dark text-white">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                        <?php
while($row = $payment_data_for_payment_list->fetch(PDO::FETCH_ASSOC)) {
    $payment_name = $row['payment_name'];
    $payment_image = $row['payment_image'];
    $payment_id = $row['payment_id'];

    echo "

    <tr>
        <td>".$payment_list_count++."</td>
        <td>$payment_name</td>
        <td><img src=\"$payment_image\" class=\"table_image\"></td>
        <td align=\"center\">
            <a href=\"payment.php?edit_payment=$payment_id\" class=\"btn btn-success\">Edit</a>
        </td>
        <td align=\"center\">
            <a href=\"payment.php?delete_payment=$payment_id\" class=\"btn btn-danger\">Delete</a>
        </td>
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

</html>