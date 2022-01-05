<?php
include "../config.php";

include "query.php";

$book_list_count = 1;

//view_category_option
$category_option = "SELECT 
  *
  FROM category ";
$category_stmt = $dbConn->prepare($category_option);
$category_stmt->execute(); 
$categorys = $category_stmt->fetchAll();

//view_author_option
$author_option = "SELECT 
  *
  FROM author ";
$author_stmt = $dbConn->prepare($author_option);
$author_stmt->execute(); 
$authors = $author_stmt->fetchAll();


//add_book_list
if(isset($_POST['add_book_list'])) { 

$book_name = $_POST['book_name'];
$category_id = $_POST['category_id'];
$author_id = $_POST['author_id'];

  //image
$file_name = basename($_FILES["fileToUpload"]["name"]);
$target_dir = "../uploads/";
$file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
$target_file = $target_dir . $time_random .".".$file_extension ;

if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

    $dbConn->query("INSERT INTO `book` (
    `book_name`,
    `book_image`,
    `author_id`,
    `category_id`
    ) 
    VALUES (
    '{$book_name}',
    '{$target_file}',
    '{$author_id}',
    '{$category_id}'
    )
    ;");

echo "<script type='text/javascript'>alert('Updated');
  window.location.href = 'book.php';
  </script>";

}

}

//update_data
if(isset($_REQUEST['edit_book'])){
$book_id = $_REQUEST['edit_book'];
$update_data_view = $hide;

$edit_book = $dbConn->query("SELECT 
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
  WHERE book.book_id IN ('$book_id')");
while($row = $edit_book->fetch(PDO::FETCH_ASSOC)) {
    $edit_book_name = $row['book_name'];
    $edit_book_id = $row['book_id'];
    $edit_category_id = $row['category_id'];
    $edit_category_name = $row['category_name'];
    $edit_author_id = $row['author_id'];
    $edit_author_name = $row['author_name'];
    $edit_amount = $row['amount'];
}
}


//update_selected_data
if(isset($_POST['edit_selected_book'])) { 
$book_name = $_POST['book_name'];
$book_id = $_POST['book_id'];
$author_id = $_POST['author_id'];
$category_id = $_POST['category_id'];
$amount = $_POST['amount'];

$file_name = basename($_FILES["fileToUpload"]["name"]);
$target_dir = "https://gymtech.besttech.in/kubera/uploads/";
$file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
$target_file = $target_dir . $time_random .".".$file_extension ;

//book_path
$file_name_for_book_path = basename($_FILES["book_path"]["name"]);
$target_dir = "https://gymtech.besttech.in/kubera/uploads/";
$file_extension_for_book_path = pathinfo($file_name_for_book_path, PATHINFO_EXTENSION);
$target_file_for_book_path = $target_dir . $time_random .".".$file_extension_for_book_path ;

    $dbConn->query("UPDATE `book` 
        SET `book_name` = '$book_name',
        `author_id` = '$author_id',
        `category_id` = '$category_id',
        `amount` = '$amount'
         WHERE book_id IN ('$book_id')");

if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    $dbConn->query("UPDATE `book` 
        SET `book_image` = '$target_file'
         WHERE book_id IN ('$book_id')");
}

if (move_uploaded_file($_FILES["book_path"]["tmp_name"], $target_file_for_book_path)) {
    $dbConn->query("UPDATE `book` 
        SET `book_path` = '$target_file_for_book_path'
         WHERE book_id IN ('$book_id')");
}

echo "<script type='text/javascript'>alert('Updated');
  window.location.href = 'book.php';
  </script>";

}

//delete_selected_data
if(isset($_REQUEST['delete_book'])) { 
$book_id = $_REQUEST['delete_book'];

   $dbConn->query("DELETE FROM `book` 
    WHERE book_id IN ('$book_id')");

echo "<script type='text/javascript'>alert('Deleted');
  window.location.href = 'book.php';
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

<!-- add_book -->

<div id="fixed_add_div" class="container" <?php echo $update_data_view; ?>
                        style="background-color:#ffffff; margin: 10px; border-radius: 20px ; ">
                        <!-- add data -->
                        <table class="table table-bordered table-hover" style="margin-top: 10px;">
                            <thead>
                                <tr>
                                    <th class="bg-dark text-white">book Name</th>
                                    <th class="bg-dark text-white">book Image</th>
                                    <th class="bg-dark text-white">Category</th>
                                    <th class="bg-dark text-white">Author</th>
                                    <th class="bg-dark text-white">Add</th>
                                </tr>
                            </thead>
                            <tbody>
                                <form action="" method="POST" enctype = "multipart/form-data">
                                    <td><input type="text" placeholder="book_name" name="book_name" class="form-control" required></td>
                                    <td><input type="file" name="fileToUpload" class="form-control" required></td>
                                    <td>
                        <select class="form-control" name="category_id" required>
                        <option value="">Select</option>
                        <?php foreach($categorys as $category): ?>
                        <option value="<?= $category['category_id']; ?>">
                        <?= $category['category_name']; ?>
                        </option>
                        <?php endforeach; ?>
                        </select>                                        
                                    </td>
                                    <td>
                        <select class="form-control" name="author_id" required>
                        <option value="">Select</option>
                        <?php foreach($authors as $author): ?>
                        <option value="<?= $author['author_id']; ?>">
                        <?= $author['author_name']; ?>
                        </option>
                        <?php endforeach; ?>
                        </select>                                        
                                    </td>
                                    <td><button type="submit"  name="add_book_list" class="btn btn-primary">Add</button></td>
                                </form>
                            </tbody>
                        </table>

</div>


<!-- edit_book -->

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
                                    <th class="bg-dark text-white">book Name</th>
                                    <th class="bg-dark text-white">book pdf</th>
                                    <th class="bg-dark text-white">book amount</th>
                                    <th class="bg-dark text-white">book Image</th>
                                    <th class="bg-dark text-white">Category</th>
                                    <th class="bg-dark text-white">Author</th>
                                    <th class="bg-dark text-white">Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <form action="" method="POST" enctype = "multipart/form-data">
                                    <td><input type="text" placeholder="book_name" name="book_name" class="form-control" required 
                                        value="<?php echo $edit_book_name; ?>"></td>

                                    <td><input type="file" name="book_path" class="form-control" ></td>

                                
                                        <td><input type="number"  name="amount" class="form-control" required 
                                        value="<?php echo $edit_amount; ?>"></td>

                                    <td><input type="file" name="fileToUpload" class="form-control" ></td>
                                    <td>
                        <select class="form-control" name="category_id" required>
                        <option value="<?php echo $edit_category_id; ?>"><?php echo $edit_category_name; ?></option>
                        <?php foreach($categorys as $category): ?>
                        <option value="<?= $category['category_id']; ?>">
                        <?= $category['category_name']; ?>
                        </option>
                        <?php endforeach; ?>
                        </select>                                        
                                    </td>
                                    <td>
                        <select class="form-control" name="author_id" required>
                        <option value="<?php echo $edit_author_id; ?>"><?php echo $edit_author_name; ?></option>
                        <?php foreach($authors as $author): ?>
                        <option value="<?= $author['author_id']; ?>">
                        <?= $author['author_name']; ?>
                        </option>
                        <?php endforeach; ?>
                        </select>                                        
                                    </td>
                                    <input type="hidden" value="<?php echo $edit_book_id; ?>" name="book_id">
                                    <td><button type="submit"  name="edit_selected_book" class="btn btn-primary">Edit</button></td>
                                </form>
                            </tbody>
                        </table>

</div>

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
                                    <th class="bg-dark text-white">Edit</th>
                                    <th class="bg-dark text-white">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                        <?php
while($row = $book_data_for_book_list->fetch(PDO::FETCH_ASSOC)) {
    $book_name = $row['book_name'];
    $book_image = $row['book_image'];
    $book_id = $row['book_id'];

    echo "

    <tr>
        <td>".$book_list_count++."</td>
        <td>$book_name</td>
        <td><img src=\"$book_image\" class=\"table_image\"></td>
        <td align=\"center\">
            <a href=\"book.php?edit_book=$book_id\" class=\"btn btn-success\">Edit</a>
        </td>
        <td align=\"center\">
            <a href=\"book.php?delete_book=$book_id\" class=\"btn btn-danger\">Delete</a>
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