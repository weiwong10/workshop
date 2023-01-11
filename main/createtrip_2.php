<?php
  include "../connect.php";
  session_start();
  $username = $_SESSION['username'];
?>


<?php  
include('tripserver.php');
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="createtrip.css">
  <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">-->
  <title>Create Trip</title>
</head>
<body>
    
<?php include("nav/nav_createTrip.php")?>



<div>
<br>
<table class="center_table" id="table1">
  <form method="post" action="tripserver.php" enctype="multipart/form-data">
    <tr>
      <td>
        <?php if (isset($_GET['error'])) { ?>
        <div class="alert" role="alert">
          <?=$_GET['error']?>
        </div>
        <?php } ?>
      </td>
    </tr>
    <tr>      
      <td>
      <?php
      $sql = mysqli_query($db, "SELECT * FROM trip WHERE tripID = (SELECT MAX(tripID) FROM trip WHERE username = '{$_SESSION['username']}')");
      while ($tripID = $sql->fetch_assoc())
      {
      ?>
        <input class="input" type="hidden" name="tripID" value="<?php echo $tripID['tripID'];?>">
      <?php
      }
      ?>
      </td>     
    </tr>
    <tr>
      <td>
      <label>Travel Spot :</label><br>
      <select name="spotID">
      <option value="">--- Select ---</option> 
      <?php 
      $sql = mysqli_query($db, "SELECT * FROM travel_spot WHERE spotID NOT IN (SELECT spotID FROM travel_itinerary WHERE tripID = (SELECT MAX(tripID) FROM trip))");
      while ($spotID = $sql->fetch_assoc())
      {
      ?>
        <option value="<?php echo $spotID['spotID'];?>"><?php echo $spotID['spot_name'];?></option>
      <?php
      }
      ?>
      </select>
      </td>     
    </tr>
    <tr>      
      <td>
      <label>Description :</label><br>
      <input class="input" type="text" name="description" value="<?php echo $description; ?>" placeholder="Description">
      </td>     
    </tr>
    <tr>
      <td colspan="3">
      <?php 
      $sql = mysqli_query($db, "SELECT * FROM travel_spot WHERE spotID NOT IN (SELECT spotID FROM travel_itinerary WHERE tripID = (SELECT MAX(tripID) FROM trip))");
      $row = mysqli_num_rows($sql);
      if($row > 1)
      {
      ?>
        <button class="btn" type="submit" name="save2" id="save2" >Add More Travel Spots</button>
      <?php
      }
      ?>
      </td>  
    </tr>
    <tr>
      <td colspan="3">
        <button class="btn" type="submit" name="save3" id="save3" >Next</button>
      </td>  
    </tr>
  </form>
</table>
<br>
</div>



</body>
</html>