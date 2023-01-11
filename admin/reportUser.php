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
    <title>Admin Report</title>
    <h1 align="center">Report</h1>

  </head>
  <body>

    <!---select date and method-->
    <form name="bwdatesdata" action="" method="post" action="">
        <table width="100%" height="117"  border="0">
        <tr>
        <th width="27%" height="63" scope="row">Type: </th>
        <td width="73%">
        <select name="type">
            <option value="null">-- Select Type --</option>
            <option value="rate">Top 10 User's Rating</option>
            <option value="lead">Top 10 User's who the most trip</option>
        </select>
        </tr>
        <tr>

        <th width="27%" height="63" scope="row"></th>
        <td width="73%">
        <button class="btn-primary btn" type="submit" name="submit">Submit</button>
        </tr>
        </table>
    </form>
    </div>
    </div>
    <hr>
      <div class="row">
      <div class="col-xs-12">
    <?php

        if(isset($_POST['submit']))
        {
            $type = $_POST['type'];

            if($type == 'null'){
                echo "<script>alert('Please Choose the valid Type');</script>";
                echo"<meta http-equiv='refresh' content='0; url=reportUser.php'/>";
            } 
            elseif($type == "rate"){
   
    ?>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['Resort', 'Trip'],

           <?php
           //display by year
   
           $query = "SELECT username, average_rate FROM users ORDER BY average_rate DESC LIMIT 10;";
           $result = mysqli_query($conn, $query);
           //display data from db
           if (mysqli_num_rows($result) >= 1) {
               while ($row = $result->fetch_assoc()) {

                   echo "['" . $row['username'] . "'," . $row['average_rate'] . "],";

               }
           } else {
               echo "No data found.";
           }


           ?>
        ]);

        var options = {
          title: 'Top Users Rating Report',
          width: 900,
          legend: { position: 'none' },
          chart: { title: 'Top 10 Users Report',
                   subtitle: 'popularity by rating of user' },
          bars: 'vertical', // Required for Material Bar Charts.
          axes: {
            x: {
              0: { side: 'top', label: 'Username'} // Top x-axis.
            }
          },
          bar: { groupWidth: "90%" }


        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        chart.draw(data, options);
      };
    </script>

    <div id="top_x_div" style="width: 900px; height: 500px;"></div>

      <?php
        }
        elseif($type == "lead")
        {
      ?>
 
        <form name="bwdatesdata" action="" method="post" action="">
            <table width="100%" height="117"  border="0">
            <tr>
            <th width="27%" height="63" scope="row">Year: </th>
            <td width="73%">
            
            <?php 
                $query = "SELECT DISTINCT YEAR(start_date) FROM TRIP;";
                $result = mysqli_query($conn,$query);
            ?>

            <select name="year">
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
            <button class="btn-primary btn" type="submit" name="apply">Submit</button>
            </tr>
            </table>
        </form>
    <?php  
        }

        }
        elseif(isset($_POST['apply'])){
    
            $year = $_POST['year'];
            $type = $_POST['month'];

            if($type == 'null'){
                echo "<script>alert('Please Choose the valid month');</script>";
                echo"<meta http-equiv='refresh' content='0; url=reportUser.php'/>";
            } 
            else{
   
    ?>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['Resort', 'Trip'],

           <?php
           //display by year
        if($type == 'all'){
            $query = "SELECT u.username, COUNT(tripID) as 'count' FROM users u, trip t WHERE t.username = u.username AND YEAR(start_date) = '$year' GROUP BY t.username ORDER BY COUNT(tripID) DESC LIMIT 10;";
            $result = mysqli_query($conn, $query);
        }
        else{
            $query = "SELECT u.username, COUNT(tripID) as 'count' FROM users u, trip t WHERE t.username = u.username AND YEAR(start_date) = '$year' AND MONTH(start_date) = '$type' GROUP BY t.username ORDER BY COUNT(tripID) DESC LIMIT 10;";
            $result = mysqli_query($conn, $query);
        }
           

           //display data from db
           if (mysqli_num_rows($result) >= 1) {
               while ($row = $result->fetch_assoc()) {

                   echo "['" . $row['username'] . "'," . $row['count'] . "],";

               }
           } 
           else {
                echo "<script>alert('The admin password is incorrect. Please retry.');</script>";
                echo "<script>alert('No Record Found');</script>";
                echo"<meta http-equiv='refresh' content='0; url=reportUser.php'/>";
           }


           ?>
        ]);

        var options = {
          title: 'Top Users Rating Report',
          width: 900,
          legend: { position: 'none' },
          chart: { title: 'Top 10 Users Report',
                   subtitle: 'popularity by rating of user' },
          bars: 'vertical', // Required for Material Bar Charts.
          axes: {
            x: {
              0: { side: 'top', label: 'Username'} // Top x-axis.
            }
          },
          bar: { groupWidth: "90%" }


        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        chart.draw(data, options);
      };
    </script>

    <div id="top_x_div" style="width: 900px; height: 500px;"></div>

    <?php        
        }
    }

      ?>

  </body>
</html>
