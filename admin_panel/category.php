<?php
include "../config.php";

include "query.php";

$category_list_count = 1;

//add_category_list
if(isset($_POST['add_category_list'])) { 

$category_name = $_POST['category_name'];

  //image
$file_name = basename($_FILES["fileToUpload"]["name"]);
$target_dir = "../uploads/";
$file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
$target_file = $target_dir . $time_random .".".$file_extension ;

if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

    $dbConn->query("INSERT INTO `category` (
    `category_name`,
    `category_image`
    ) 
    VALUES (
    '{$category_name}',
    '{$target_file}'
    )
    ;");

echo "<script type='text/javascript'>alert('Updated');
  window.location.href = 'category.php';
  </script>";

}

}

//update_data
if(isset($_REQUEST['edit_category'])){
$category_id = $_REQUEST['edit_category'];
$update_data_view = $hide;

$edit_category = $dbConn->query("SELECT 
  * 
  FROM category 
  WHERE category_id IN ('$category_id')");
while($row = $edit_category->fetch(PDO::FETCH_ASSOC)) {
    $edit_category_name = $row['category_name'];
    $edit_category_id = $row['category_id'];
}
}


//update_selected_data
if(isset($_POST['edit_selected_category'])) { 
$category_name = $_POST['category_name'];
$category_id = $_POST['category_id'];

$file_name = basename($_FILES["fileToUpload"]["name"]);
$target_dir = "../uploads/";
$file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
$target_file = $target_dir . $time_random .".".$file_extension ;

    $dbConn->query("UPDATE `category` 
        SET `category_name` = '$category_name'
         WHERE category_id IN ('$category_id')");

if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    $dbConn->query("UPDATE `category` 
        SET `category_image` = '$target_file'
         WHERE category_id IN ('$category_id')");
}

echo "<script type='text/javascript'>alert('Updated');
  window.location.href = 'category.php';
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

<!-- add_category -->

<div id="fixed_add_div" class="container" <?php echo $update_data_view; ?>
                        style="background-color:#ffffff; margin: 10px; border-radius: 20px ; ">
                        <!-- add data -->
                        <table class="table table-bordered table-hover" style="margin-top: 10px;">
                            <thead>
                                <tr>
                                    <th class="bg-dark text-white">Category Name</th>
                                    <th class="bg-dark text-white">Category Image</th>
                                    <th class="bg-dark text-white">Add</th>
                                </tr>
                            </thead>
                            <tbody>
                                <form action="" method="POST" enctype = "multipart/form-data">
                                    <td><input type="text" placeholder="category_name" name="category_name" class="form-control" required></td>
                                    <td><input type="file" name="fileToUpload" class="form-control" required></td>
                                    <td><button type="submit"  name="add_category_list" class="btn btn-primary">Add</button></td>
                                </form>
                            </tbody>
                        </table>

</div>


<!-- edit_category -->

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
                                    <th class="bg-dark text-white">Category Name</th>
                                    <th class="bg-dark text-white">Category Image</th>
                                    <th class="bg-dark text-white">Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <form action="" method="POST" enctype = "multipart/form-data">
                                    <td><input type="text" placeholder="category_name" name="category_name" class="form-control" required 
                                        value="<?php echo $edit_category_name; ?>"></td>
                                    <td><input type="file" name="fileToUpload" class="form-control" ></td>
                                    <input type="hidden" value="<?php echo $edit_category_id; ?>" name="category_id">
                                    <td><button type="submit"  name="edit_selected_category" class="btn btn-primary">Edit</button></td>
                                </form>
                            </tbody>
                        </table>

</div>

                                        <div id="fixed" class="container"
                        style="background-color:#ffffff; margin: 10px; border-radius: 20px  ; ">
                        <!--First Row Start-->
                        <h5 style="margin-top: 20px;text-align: center;">Category List</h5>
                        <table class="table table-bordered table-hover" style="margin-top: 10px;">
                            <thead>
                                <tr>
                                    <th class="bg-dark text-white">Sl No</th>
                                    <th class="bg-dark text-white">Category Name</th>
                                    <th class="bg-dark text-white">Category Image</th>
                                    <th class="bg-dark text-white">Edit</th>
                                    <th class="bg-dark text-white">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                        <?php
while($row = $category_data_for_category_list->fetch(PDO::FETCH_ASSOC)) {
    $category_name = $row['category_name'];
    $category_image = $row['category_image'];
    $category_id = $row['category_id'];

    echo "

    <tr>
        <td>".$category_list_count++."</td>
        <td>$category_name</td>
        <td><img src=\"$category_image\" class=\"table_image\"></td>
        <td align=\"center\">
            <a href=\"category.php?edit_category=$category_id\" class=\"btn btn-success\">Edit</a>
        </td>
        <td align=\"center\">
            <a href=\"category.php?delete_category=$category_id\" class=\"btn btn-danger\">Delete</a>
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