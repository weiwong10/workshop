<?php 
error_reporting(0);
session_start();
$db = mysqli_connect('localhost', 'root', '', 'tripbuddytest');


$username = $_SESSION['username'];



/*-------------------------------------------------------------CREATE_TRIP-------------------------------------------------------------*/

if (isset($_POST['save'])) 
{
  $title = $_POST['title'];
  $price = $_POST['price'];
  $start_date = $_POST['start_date'];
  $end_date = $_POST['end_date'];
  $duration = $_POST['duration'];
  $current_people = $_POST['current_people'];
  $max_people = $_POST['max_people'];
  $accommodation = $_POST['accommodation'];
  $description = $_POST['description'];
  $username = $_POST['username'];
  $themeID = $_POST['themeID'];
  $paymentID = $_POST['paymentID'];
  $featuredID = $_POST['featuredID'];
  $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));

  if(empty($title))
  {
    header("Location: createtrip.php?error=Title is Required");
  }
  elseif (empty($price)) 
  {
    header("Location: createtrip.php?error=Price is Required");
  }
  elseif ($price < 0 || $price > 9999) 
  {
    header("Location: createtrip.php?error=Price need to be between 0.00 - 9999.00");
  }
  elseif (empty($start_date)) 
  {
    header("Location: createtrip.php?error=Start Date is Required");
  }
  elseif (empty($end_date)) 
  {
    header("Location: createtrip.php?error=End Date is Required");
  }
  elseif ($end_date < $start_date) 
  {
    header("Location: createtrip.php?error=End Date must be after Start Date");
  }
  elseif (empty($max_people)) 
  {
    header("Location: createtrip.php?error=Maximum number of people is Required");
  }
  elseif (empty($accommodation)) 
  {
    header("Location: createtrip.php?error=Accommodation is Required");
  }
  elseif (empty($description)) 
  {
    header("Location: createtrip.php?error=Description is Required");
  }
  elseif (empty($themeID)) 
  {
    header("Location: createtrip.php?error=Please select a Theme");
  }
  elseif (empty($file)) 
  {
    header("Location: createtrip.php?error=Trip picture is Required");
  }
  else
  {
    mysqli_query($db, "INSERT INTO trip (title, price, start_date, end_date, duration, current_people, max_people, accommodation, description, username, themeID, paymentID, featuredID, image) VALUES ('$title', '$price', '$start_date', '$end_date', 0, 0, '$max_people', '$accommodation', '$description', '$username', '$themeID', NULL, NULL, '$file')");

    mysqli_query($db, "UPDATE trip SET duration = (SELECT DATEDIFF(end_date, start_date) + 1)");

    header('location: createtrip_2.php');
  }
}


/*-----------------------------------------------------------SELECT_TRAVEL_SPOT-----------------------------------------------------------*/
if (isset($_POST['save2'])) 
{
	$tripID = $_POST['tripID'];
  $spotID = $_POST['spotID'];
  $description = $_POST['description'];

  if(empty($spotID))
  {
    header("Location: createtrip_2.php?error=Please select a Travel Spot");
  }
  elseif(empty($description))
  {
    header("Location: createtrip_2.php?error=Description is Required");
  }
  else
  {
    mysqli_query($db, "INSERT INTO travel_itinerary (tripID, spotID, description) VALUES ('$tripID', '$spotID', '$description')");

    header('location: createtrip_2.php');
  } 
}

if (isset($_POST['save3'])) 
{
  $tripID = $_POST['tripID'];
  $spotID = $_POST['spotID'];
  $description = $_POST['description'];

  if(empty($spotID))
  {
    header("Location: createtrip_2.php?error=Please select a Travel Spot");
  }
  elseif(empty($description))
  {
    header("Location: createtrip_2.php?error=Description is Required");
  }
  else
  {
    mysqli_query($db, "INSERT INTO travel_itinerary (tripID, spotID, description) VALUES ('$tripID', '$spotID', '$description')");

    header('location: createtrip_3.php');
  }
}



/*---------------------------------------------------------SELECT_TRANSPORTATION---------------------------------------------------------*/


if (isset($_POST['save4'])) 
{
  $transportationID = $_POST['transportationID'];
  $tripID = $_POST['tripID'];
  $description = $_POST['description'];
  $carPlateNo = $_POST['carPlateNo'];

  if(empty($transportationID))
  {
    header("Location: createtrip_3.php?error=Please select Transportation");
  }
  elseif(empty($description))
  {
    header("Location: createtrip_3.php?error=Description is Required");
  }
  else
  {
    mysqli_query($db, "INSERT INTO transportation_trip (transportationID, tripID, description, carPlateNo) VALUES ('$transportationID', '$tripID', '$description', '$carPlateNo')");

    header('location: createtrip_4.php');
  }
}



/*-----------------------------------------------------------CHOOSE_FEATURE-----------------------------------------------------------*/


if (isset($_POST['save5'])) 
{
  $featuredID = $_POST['featuredID'];
  $yesno = $_POST['yesno'];

  if($yesno == 1)
  {
    if(empty($featuredID))
    {
      header("Location: createtrip_4.php?error=Please select Feature Type");
    }
    else
    {
      mysqli_query($db, "UPDATE trip SET featuredID = '$featuredID' WHERE tripID = (SELECT MAX(tripID) FROM (SELECT * FROM trip) as test WHERE username = '{$_SESSION['username']}')");
    
      header('location: ../payment/index.php');
    }
  }
  else if ($yesno == 2)
  {
    header('location: myTrip.php');
  }
}