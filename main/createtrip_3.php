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
      <label>Transportation :</label><br>
      <select name="transportationID">
      <option value="">--- Select ---</option> 
      <?php 
      $sql = mysqli_query($db, "SELECT * FROM transportation");
      while ($transportationID = $sql->fetch_assoc())
      {
      ?>
        <option value="<?php echo $transportationID['transportationID'];?>"><?php echo $transportationID['trans_type'];?></option>
      <?php
      }
      ?>
      </select>
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
      <label>Description :</label><br>
      <input class="input" type="text" name="description" value="<?php echo $description; ?>" placeholder="Description">
      </td>     
    </tr>
    <tr>
      <td>
        <br>
        <label>Add Car Plate No. ?</label>
        <br>
      </td>
    </tr>
    <tr>
      <td>
        <lable class="radio_lable">
        <input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="yesCheck"> Yes
        </lable>
        <lable class="radio_lable">
        <input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="noCheck" checked="checked"> No
        </lable>
      </td>
    </tr>
    <tr>      
      <td id="ifYes" style="display:none">
      <br>
      <label>Car Plate No. :</label><br>
      <input class="input" type="text" name="carPlateNo" value="<?php echo $carPlateNo; ?>">
      </td>     
    </tr>
    <tr>
      <td colspan="3">
        <button class="btn" type="submit" name="save4" id="save4" >Next</button>
      </td>  
    </tr>
  </form>
</table>
<br>
</div>

<script type="text/javascript">
  function yesnoCheck() {
    if (document.getElementById('yesCheck').checked) 
    {
      document.getElementById('ifYes').style.display = 'block';
    } 
    else
    {
      document.getElementById('ifYes').style.display = 'none';
    }
  }
</script>


</body>
</html>