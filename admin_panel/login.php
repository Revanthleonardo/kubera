<?php
include "../config.php";

//unset
session_start();
session_unset();
session_destroy();

//login
if(isset($_POST['login'])) { 

$user_name = $_POST['user_name'];
$password = $_POST['password'];

if ($user_name == $kubera_user_name || $password == $kubera_password) {
  session_start();
  $_SESSION["user_name"] = $user_name;
  $_SESSION["password"] = $password;
  header("Location:index.php");
}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.11.3/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.11.3/datatables.min.js"></script>

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
                        style="background-color:#ffffff; margin: 10px; border-radius: 20px  ; display: grid; place-items:center;">
                        <!--First Row Start-->
<div>

    <h2>Login</h2>
                <form class="align-middle" action="" method="post">
                  <div class="mb-3">
                    <input type="text" class="form-control" name="user_name" placeholder="username">
                  </div>
                  <div class="mb-3">
                    <input type="password" class="form-control" name="password" placeholder="password">
                  </div>
                  <button type="submit" name="login" class="btn btn-primary form-control">Submit</button>
                </form>

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
<script>
    $(document).ready(function() {
    $('#example').DataTable();
} );
</script>

</html>