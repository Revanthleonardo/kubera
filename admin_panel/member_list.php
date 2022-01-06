<?php
include "../config.php";

include "query.php";

$member_list_count = 1;

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
                        style="background-color:#ffffff; margin: 10px; border-radius: 20px  ; ">
                        <!--First Row Start-->
                        <h5 style="margin-top: 20px;text-align: center;">Members List</h5>
                        <table id="example" class="table table-bordered table-hover" style="margin-top: 10px;">
                            <thead>
                                <tr>
                                    <th class="bg-dark text-white">Sl No</th>
                                    <th class="bg-dark text-white">Ref ID</th>
                                    <th class="bg-dark text-white">Name</th>
                                    <th class="bg-dark text-white">Mobile</th>
                                    <th class="bg-dark text-white">Level</th>
                                    <th class="bg-dark text-white">Score</th>
                                    <th class="bg-dark text-white">User Panel</th>
                                    <th class="bg-dark text-white">Info</th>
                                </tr>
                            </thead>
                            <tbody>
                        <?php
while($row = $user_data_for_member_list->fetch(PDO::FETCH_ASSOC)) {
    $user_id = $row['user_id'];
    $referral_number = $row['referral_number'];
    $name = $row['name'];
    $mobile_number = $row['mobile_number'];
    $avg_count = $row['avg_count']; 
    $level = $row['level'];  

    echo "

    <tr>
        <td>".$member_list_count++."</td>
        <td>$referral_number</td>
        <td>$name</td>
        <td>$mobile_number</td>
        <td>$level</td>
        <td>$avg_count/84</td>
        <td align=\"center\">
            <div class=\"btn btn-success\">Go Panel</div>
        </td>
        <td align=\"center\">
            <a href=\"member_list_info.php?user_id=$user_id\" class=\"btn btn-primary\">Info</a>
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
<script>
    $(document).ready(function() {
    $('#example').DataTable();
} );
</script>

</html>