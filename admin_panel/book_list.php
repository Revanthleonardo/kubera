<?php
include "../config.php";

include "query.php";

$book_list_count = 1;


//add_book_list
if(isset($_POST['add_book_list'])) { 

$book_name = $_POST['book_name'];
$amount = $_POST['amount'];
$no_of_answers = $_POST['no_of_answers'];
$question_name_array = $_POST['question_name'];

  //image
$file_name = $_FILES['image']['name'];;
$target_dir = "../uploads/";
$file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
$target_file = $target_dir . $time_random .".".$file_extension ;

if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    $dbConn->query("INSERT INTO `book` (
    `book_name`,
    `mobile_number`,
    `email`,
    `password`,
    `referral_number`
    ) 
    VALUES (
    '{$book_name}',
    '{$mobile_number}',
    '{$email}',
    '{$password}',
    '{$referral_number}'
    )
    ;");
}

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
                                        
<div id="fixed_add_div" class="container"
                        style="background-color:#ffffff; margin: 10px; border-radius: 20px  ; ">
                        <!-- add data -->
                        <table class="table table-bordered table-hover" style="margin-top: 10px;">
                            <thead>
                                <tr>
                                    <th class="bg-dark text-white">Book Name</th>
                                    <th class="bg-dark text-white">Book Image</th>
                                    <th class="bg-dark text-white">Price</th>
                                    <th class="bg-dark text-white">Add</th>
                                </tr>
                            </thead>
                            <tbody>
                                <form action="" method="POST">
                                    <td><input type="text" placeholder="book_name" name="book_name" class="form-control" required></td>
                                    <td><input type="text" placeholder="book_image" name="book_image" class="form-control" required></td>
                                    <td><input type="file" name="fileToUpload" class="form-control" required></td>
                                    <td><button type="submit"  name="add_book_list" class="btn btn-primary">Add</button></td>
                                </form>
                            </tbody>
                        </table>

</div>
<div id="fixed" class="container"
                        style="background-color:#ffffff; margin: 10px; border-radius: 20px  ; ">
                        <!--First Row Start-->
                        <h5 style="margin-top: 20px;text-align: center;">Members List</h5>
                        <table class="table table-bordered table-hover" style="margin-top: 10px;">
                            <thead>
                                <tr>
                                    <th class="bg-dark text-white">Sl No</th>
                                    <th class="bg-dark text-white">Book Name</th>
                                    <th class="bg-dark text-white">Book Image</th>
                                    <th class="bg-dark text-white">Price</th>
                                    <th class="bg-dark text-white">Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                        <?php
while($row = $book_data_for_book_list->fetch(PDO::FETCH_ASSOC)) {
    $book_name = $row['book_name'];
    $book_image = $row['book_image'];
    $amount = $row['amount'];

    echo "

    <tr>
        <td>".$book_list_count++."</td>
        <td>$book_name</td>
        <td><img src=\"$book_image\" style=\"height:12vh;\"></td>
        <td>$amount</td>
        <td align=\"center\">
            <div class=\"btn btn-success\">Edit</div>
        </td>
        <td align=\"center\">
            <div class=\"btn btn-danger\">Delete</div>
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