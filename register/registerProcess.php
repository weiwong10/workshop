<?php
session_start();
	
$username = "";
$name = "";
$gentle = "";
$dob = "";
$address = "";
$contactNo = "";
$email = "";
$icNo = "";
$errors = array();

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'tripbuddytest');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $name = mysqli_real_escape_string($db, $_POST['name']);
  $gentle = mysqli_real_escape_string($db, $_POST['gentle']);
  $dob = date('Y-m-d', strtotime($_POST['dateofbirth']));
  $address = mysqli_real_escape_string($db, $_POST['address']);
  $contactNo = mysqli_real_escape_string($db, $_POST['contactNo']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $icNo = mysqli_real_escape_string($db, $_POST['icNo']);
  
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { 
	header("Location: register.php?error=Username is required"); }
	
  if (empty($name)) { 
	header("Location: register.php?error=Fullname is required"); }
	
  if (empty($gentle)) { 
	header("Location: register.php?error=Gender is required"); }
	
  if (empty($dob)) { 
	header("Location: register.php?error=Date of Birth is required"); }
	
  if (empty($address)) { 
	header("Location: register.php?error=Address is required"); }
	
  if (empty($email)) { 
	header("Location: register.php?error=Email is required"); }
	
  if (empty($icNo)) { 
	header("Location: register.php?error=icNo is required"); }
	
  if (empty($password_1)) { 
	header("Location: register.php?error=Password is required");  }
	
  if ($password_1 != $password_2) {
	header("Location: register.php?error=The two passwords do not match"); }
	
if (isset($_FILES['image']['name']) AND !empty($_FILES['image']['name'])) {
         
         
         $img_name = $_FILES['image']['name'];
         $tmp_name = $_FILES['image']['tmp_name'];
         $error = $_FILES['image']['error'];
         
         if($error === 0){
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_to_lc = strtolower($img_ex);

            $allowed_exs = array('jpg', 'jpeg', 'png');
            if(in_array($img_ex_to_lc, $allowed_exs)){
               $new_img_name = uniqid($username, true).'.'.$img_ex_to_lc;
               $img_upload_path = '../upload/'.$new_img_name;
			move_uploaded_file($tmp_name, $img_upload_path); }
		 }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM Users WHERE username= '$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      header("Location: register.php?error=Username already exists");
	}
    if ($user['email'] === $email) {
      header("Location: register.php?error=Email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
	$password = ($password_1);//enzcrypt the password before saving in the database
	
  	$query = "INSERT INTO Users (name , username, gentle, dob, address, contactNo, email, icNo, password, image) 
  			  VALUES('$name','$username', '$gentle', '$dob', '$address', '$contactNo', '$email', '$icNo', '$password', '$new_img_name')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header("Location: ../main/main.php");
	}
  }
}
?>