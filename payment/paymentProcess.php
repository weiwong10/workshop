<?
	include "../connect.php";
	session_start();
    $username = $_SESSION['username'];

    //Insert the data to the payment table
    $insert_payment = "INSERT INTO payment (...)";

    //Update the trip based on the payment id that generate just now
    //Before update try select the auto increment id from the payment we insert just now
    
    $update_payment = "UPDATE trip set paymentID = ...";


    if(mysqli_query($conn, $update_payment){
        echo "<script>alert('Payment Success!!!');</script>";
        echo"<meta http-equiv='refresh' content='0; url=mainTrip.php'/>";
    })
    else{
        echo "Error: " . $update_payment . "<br>" . mysqli_error($conn);
    }
?>