<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usr = $_POST['username'];
    $phone = $_POST['phone'];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "tripbuddytest";


    $data=mysqli_connect($servername,$username,$password,$database);
    if($data===false)
    {
        die("connection_error");
    }
    $sql="select * from users where username= '".$usr. "' AND contactNo = '".$phone. "'";
	$result=mysqli_query($data,$sql);
	$row=mysqli_fetch_array($result);

	if(mysqli_num_rows($result) > 0) {
        http_response_code(200);
    }
    else{
        http_response_code(400);
    }

};


?>