<?php
	include "../connect.php";
	session_start();
    $username = $_SESSION['username'];

    //Insert the data to the payment table
    $insert_payment = "INSERT INTO payment (amount) SELECT price FROM featured WHERE featuredID = (SELECT featuredID FROM trip WHERE tripID = (SELECT MAX(tripID) FROM trip WHERE username = '{$_SESSION['username']}'))";

    //Update date on payment table
    $update_payment = "UPDATE payment SET payment_date = CURRENT_DATE WHERE paymentID = (SELECT MAX(paymentID) FROM (SELECT * FROM payment) as test)";

    //Update paymentID into trip table
    $update_trip = "UPDATE trip SET paymentID = (SELECT MAX(paymentID) FROM payment) WHERE tripID = (SELECT MAX(tripID) FROM (SELECT * FROM trip) as test WHERE username = '{$_SESSION['username']}')";

    if(mysqli_query($conn, $insert_payment))
    {
        mysqli_query($conn, $update_payment);
        mysqli_query($conn, $update_trip);
        echo "<script>alert('Payment Success!!!');</script>";
        echo "<meta http-equiv='refresh' content='0; url=../main/mainTrip.php'/>";
    }
    else
    {
        echo "Error: " . $insert_payment . "<br>" . mysqli_error($conn);
    }
?>
