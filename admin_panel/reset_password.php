<?php
include "../config.php";

$mobile_number = $_GET['mobile_number'];

date_default_timezone_set("Asia/Kolkata");
$time = date("hi");

//login
if(isset($_POST['reset_password'])) { 

$password = addslashes($_POST['password']);
$otp = $_POST['otp'];

$mobile_number_sub = substr($mobile_number, 7, 9); //last 3 digit
$otp_decode = abs($mobile_number_sub - $otp) ; //otp_decode
$otp_check = abs($otp_decode - $time);


//for 3 min
//valid
if ($otp_check < 4){
        //update referral count for referrer
        $dbConn->query("UPDATE `admin` SET `password` = '$password' WHERE mobile_number IN ('$mobile_number')");

        echo "<script type='text/javascript'>alert('Updated');
  window.location.href = 'login.php';
  </script>";
    
}
else{
    echo "<script type='text/javascript'>alert('Error');
  window.location.href = 'login.php';
  </script>";
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
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">        
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
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
                    <input type="number" class="form-control" name="otp" placeholder="otp" required>
                  </div>
                  <div class="mb-3">
                    <input type="password" class="form-control" name="password" placeholder="password" required>
                  </div>
                  <button type="submit" name="reset_password" class="btn btn-primary form-control">Reset Password</button>
                </form>
                

    </div>
   

    


</body>

</html>