<?php
include "../config.php";

session_start();
$user_name = $_SESSION["user_name"];

if ($user_name == "") {
    header("Location: login.php");
  }

//book_data_for_book_list
$book_data_for_book_list = $dbConn->query("SELECT
    book.book_id,
    book.book_name,
    book.book_image,
    book.amount,
    book.book_path,
    book.trending,
    author.author_id,
    author.author_name,
    author.author_image,
    category.category_id,
    category.category_name,
    category.category_image
 FROM book
  LEFT JOIN 
  author ON
  author.author_id = book.author_id
  LEFT JOIN 
  category ON
  category.category_id = book.category_id
 WHERE book.status IN ('$active')
    ");

$book_list_count = 1;

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
                        <h5 style="margin-top: 20px;text-align: center;">book List</h5>
                        <table class="table table-bordered table-hover" style="margin-top: 10px;">
                            <thead>
                                <tr>
                                    <th class="bg-dark text-white">Sl No</th>
                                    <th class="bg-dark text-white">book Name</th>
                                    <th class="bg-dark text-white">book Image</th>
                                    <th class="bg-dark text-white">book amount</th>
                                    
                                    <th class="bg-dark text-white">author name</th>
                                    
                                    <th class="bg-dark text-white">author image</th>
                                    
                                    <th class="bg-dark text-white">category name</th>
                                    
                                    <th class="bg-dark text-white">category image</th>
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
                        <?php
while($row = $book_data_for_book_list->fetch(PDO::FETCH_ASSOC)) {
    $book_name = $row['book_name'];
    $book_image = $row['book_image'];
    $book_id = $row['book_id'];
    $amount = $row['amount'];
    $author_name = $row['author_name'];
    $category_name = $row['category_name'];
    $author_image = $row['author_image'];
    $category_image = $row['category_image'];

    echo "

    <tr>
        <td>".$book_list_count++."</td>
        <td>$book_name</td>
        <td><img src=\"$book_image\" class=\"table_image\"></td>
        <td>$amount</td>
        <td>$author_name</td>
        <td><img src=\"$author_image\" class=\"table_image\"></td>
        <td>$category_name</td>
        <td><img src=\"$category_image\" class=\"table_image\"></td>
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