<?php
include ('../connect.php');
$username=$_GET['updateusername'];
$sql = "select username,name,contactNo,email,status_acc from users";
$result = mysqli_query($conn,$sql);
if ($result) {
  while ($row = mysqli_fetch_assoc($result)) {
    $username = $row['username'];
    $name = $row['name'];
    $contactNo = $row['contactNo'];
    $email = $row['email'];
    $status_acc = $row['status_acc'];
  }
}
if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $contactNo = $_POST['contactNo'];
  $email = $_POST['email'];
  $status_acc = $_POST['status_acc'];

  $sql = "update from users set username-$username,name='$name', contactNo ='$contactNo', email='$email', status_acc='$status_acc' where username=$username";
  $result = mysqli_query($conn, $sql);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    // header('location: display.php');
  } else {
    // echo "updated successfully";
    header('location: display.php');
  }
}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Update User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container my-5">
    <form method="post">
    <div class="form-group">
  <label>Name</label>
    <input type="text" class="form-control" placeholder="Enter Name"
    name="name" autocomplete="off" value=<?php echo $name;?>>
  </div>
  <div class="form-group">
  <label>Contact Number</label>
    <input type="text" class="form-control" placeholder="Enter Contact No"
    name="contact" autocomplete="off" value=<?php echo $contactNo;?>>
  </div>
  <div class="form-group">
  <label>Email</label>
    <input type="text" class="form-control" placeholder="Enter Email"
    name="email" autocomplete="off" value=<?php echo $email;?>>
    </div>
    <form class="form-inline">
  <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Status Account</label>
  <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
    <option selected>Choose...</option>
    <option value="1">Active</option>
    <option value="2">Unactive</option>
  </select>
  <div>
  <button type="submit" class="btn btn-primary my-1" name="Submit">Submit</button>
</form>
    <div>
</body>

</html>


	 