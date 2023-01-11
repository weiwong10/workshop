<?php
    session_start();
    include_once '../connect.php';
    //Admin nav bar
    //include_once 'adminNavBar.php';

     $username = $_SESSION['username'];

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name ="viewreport" content="width=device-width, initial-scale =1.0">
    <title>Resort Report</title>
    <h1 align="center">Report</h1>

  </head>
  <body>

    <!---select date and method-->
    <form action="" method="post" action="">
        <table width="100%" height="117"  border="0">
        <tr>
        <th width="27%" height="63" scope="row">Report Type: </th>
        <td width="73%">

        <select name="type">
            <option value="user">User</option>
            <option value="spot">Travel Spot</option>
            <option value="feature">Feature</option>
        </select>
        </td>
        </tr>
        <tr>
            <th width="27%" height="63" scope="row"></th>
            <td width="73%">
            <button class="btn-primary btn" type="submit" name="submit">Submit</button>
        </tr>
        </table>
    </form>
    <hr>

    <?php
        if(isset($_POST['submit'])){
            $type = $_POST['type'];
        

        if($type == 'user'){
            header('Location:reportUser.php');
        }
        elseif($type == 'spot'){
            header('Location:reportSpot.php');
        }
        elseif($type == 'feature'){
            header('Location:featureReport.php');
        }
    }
    ?>
