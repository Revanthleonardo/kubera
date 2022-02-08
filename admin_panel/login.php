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

$login = $dbConn->query("SELECT
    *
 FROM admin
 WHERE user_name IN ('$user_name')
 AND password IN ('$password')
    ");
while($row = $login->fetch(PDO::FETCH_ASSOC)) {
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
    <title>Kuberaa</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

        <style>

.login_div_logo{
    height: 10em;
}

        </style>


</head>

<body style="
background-color: gray;
display: grid !important;
    place-items: center !important;
    height: 100vh !important;
  width: 100vw !important;">

        

    <div class="col-4" style="display:grid; place-items:center; height: 25em;
        width: 25vw;">

              <img src="../kuberaa.png" class="login_div_logo">
                <form class="align-middle" action="" method="post">
                  <div class="mb-3">
                    <input type="text" class="form-control" name="user_name" placeholder="username">
                  </div>
                  <div class="mb-3">
                    <input type="password" class="form-control" name="password" placeholder="password">
                  </div>
                  <button type="submit" name="login" class="btn btn-primary form-control">Submit</button>
                </form>


                <a href="get_otp.php" class="text-white">Reset Password</a>
                

    </div>
   

    


</body>

</html>