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
        <link rel="stylesheet" type="text/css" href="report.css">
        <title>Feature Report</title>
        <h1 align="center">FEATURE REPORT</h1>

  </head>
<body>

<!---select date and method-->
<form name="bwdatesdata" action="" method="post" action="">
<table class="center_table">
    <tr>
        <th width="27%" height="63" scope="row">Year: </th>
        <td width="73%">
        
            <?php 
                $query = "SELECT DISTINCT YEAR(created_date) FROM TRIP;";
                $result = mysqli_query($conn,$query);
            ?>

            <select name="year">
                <option value="null">--- Select Year ---</option>
                <?php while ($row = mysqli_fetch_array($result)):; ?>
                <option value="<?php echo $row[0]?>"><?php echo $row[0]?></option>
                <?php endwhile;?>
            </select>
        </td>
    </tr>
    <tr>
        <th width="27%" height="63" scope="row">Type: </th>
        <td width="73%">
            <select name="month">
                <option value="null">-- Select Month --</option>
                <option value="all">Whole Year</option>
                <option value="1">January</option>
                <option value="2">February</option>
                <option value="3">March</option>
                <option value="4">April</option>
                <option value="5">May</option>
                <option value="6">June</option>
                <option value="7">July</option>
                <option value="8">August</option>
                <option value="9">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
            </select>
    </tr>
    <tr>
        <th width="27%" height="63" scope="row"></th>
        <td width="73%">
            <button class="btn-primary btn" type="submit" name="submit">Check</button>
        </td>
    </tr>
</table>
</form>
<hr>
<div class="row">
<div class="col-xs-12">
    <?php

        if(isset($_POST['submit']))
        {
            $year = $_POST['year'];
            $month = $_POST['month'];
        
            if($month == "null"){
                echo "<script>alert('Please Choose the valid month');</script>";
                echo"<meta http-equiv='refresh' content='0; url=featureReport.php'/>";
            } 
            
            else{
    ?>

    <section class="container">
        <?php
            if ($month == 'all') {
                $query = "SELECT f.duration, COUNT(t.featuredID) AS 'number', f.price FROM trip t, featured f WHERE t.featuredID = f.featuredID AND YEAR(created_date) = '$year' GROUP BY f.duration;";
                $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
            }
            else{
                $query = "SELECT f.duration, COUNT(t.featuredID) AS 'number', f.price FROM trip t, featured f WHERE t.featuredID = f.featuredID AND YEAR(created_date) = '$year' AND MONTH(created_date) = '$month' GROUP BY f.duration;";
                $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
            }
        
            if (mysqli_num_rows($result) >= 1) {
        ?>
                <h1 class="related">Report</h1>
		        <hr>
                        <table class="table table-bordered text-center table-warning">
                            <tr>
                                <td>Duration</td>
                                <td>Price</td>
                                <td>Total Trip</td>
                            </tr>
                            <tr>
                               <?php
                                    while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <td><?php echo $row["duration"] ?></td>
                                <td><?php echo $row["price"] ?></td>
                                <td><?php echo $row["number"] ?></td>
                            </tr>
                            <?php
                                }
                            ?>

                        </table>
        <?php
            }else
            {
                echo "<script>alert('No Record Found');</script>";
                echo"<meta http-equiv='refresh' content='0; url=featureReport.php'/>";                
            }
        ?>
    </section>

        <?php
            }
        }
        ?>


</body>
</html>
