<?php
include "../connect.php";?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
 <div>
<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand">List Users</a>
    <form class="d-flex" role="search">
      <input class="form-control me-2" type="search" placeholder="Search data" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
    <div class="container-fluid">
      <table class="table">

      </table>
</div>
  </div>
</nav>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">Username</th>
      <th scope="col">Name</th>
      <th scope="col">Contact No</th>
      <th scope="col">Email</th>
      <th scope="col">Status Account</th>
      <th scope="col">Operations</th>
    </tr>
  </thead>
  <tbody>


    <?php

    $sql = "Select username,name,contactNo,email,status_acc from users";
    $result = mysqli_query($conn,$sql);
    if($result){
        while($row=mysqli_fetch_assoc($result)){
            $username = $row['username'];
            $name = $row['name'];
            $contactNo = $row['contactNo'];
            $email = $row['email'];
            $status_acc = $row['status_acc'];
            echo '<tr>
            <th scope="row">'.$username.'</th>
            <td>'.$name.'</td>
            <td>' .$contactNo.'</td>
            <td>'.$email.'</td>
            <td>'.$status_acc.'</td>
            <td>
            <button class="btn btn-primary"><a href="update.php? updateusername='.$username.'"class="text-light">Update</a></button>
            </td>
          </tr>';
        }
    }

    
    ?>
  </tbody>
</table>
</div>
</body>
</html>

<!-- <button class="btn btn-danger"><a href="delete.php? deleteusername='.$username.'"class="text-light">Delete</a></button> -->