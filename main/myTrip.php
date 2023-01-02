<?php
	include "../connect.php";
	session_start();
    $username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="mainInformation.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<title>Join Trip</title>
</head>
<body>
	<?php include("nav/nav_myTrip.php")?>

    <section class="container">
        <?php

            $host_trip = "SELECT tripID, start_date, duration, current_people, max_people FROM trip WHERE username = '".$username."';";
            $result = mysqli_query($conn,$host_trip) or die(mysqli_error($conn));

            ?>

                <h1 class="related">Hosted Trip</h1>
		        <hr>
                <?php
                if (mysqli_num_rows($result)) {
                    ?>
                        <table class="table table-bordered text-center table-warning">
                            <tr>
                                <td>Start Date</td>
                                <td>Duration</td>
                                <td>Current People</td>
                                <td>Maximum People</td>
                                <td> </td>
                            </tr>
                            <tr>
                               <?php
                               while ($row = mysqli_fetch_assoc($result)) {
                                   ?>
                                <td><?php echo $row["start_date"] ?></td>
                                <td><?php echo $row["duration"] ?></td>
                                <td><?php echo $row["current_people"] ?></td>
                                <td><?php echo $row["max_people"] ?></td>
                                <td>
                                    <form action="hostTripDetails.php" method="post">
                                        <input type="hidden" name="tripID" value="<?php echo $row["tripID"]; ?>">						
                                        <button class="btn" type="submit">View Detail</button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                               }
                               ?>

                        </table>
                <?php
                } else {
                    ?>
                        <h2 style="text-align: center;">--No Record Found--</h2>
                <?php
                }
                ?>
    </section>

    <section class="container">
        <?php
            $trip_feature = "SELECT DISTINCT t.tripID, u.name, start_date, duration, current_people, max_people from trip_joining j, trip t , users u WHERE t.tripID IN (SELECT tripID from trip_joining WHERE username = '".$username."') AND t.username = u.username AND start_date > sysdate();";
            $result = mysqli_query($conn,$trip_feature) or die(mysqli_error($conn));
        ?>

                <h1 class="related">Joined Trip</h1>
		        <hr>
                <?php
                if (mysqli_num_rows($result)) {
                    ?>
                        <table class="table table-bordered text-center table-success">
                            <tr>
                                <td>Host</td>
                                <td>Start Date</td>
                                <td>Duration</td>
                                <td>Current People</td>
                                <td>Maximum People</td>
                                <td> </td>
                            </tr>
                            <tr>
                               <?php
                               while ($row = mysqli_fetch_assoc($result)) {
                                   ?>
                                <td><?php echo $row["name"] ?></td>
                                <td><?php echo $row["start_date"] ?></td>
                                <td><?php echo $row["duration"] ?></td>
                                <td><?php echo $row["current_people"] ?></td>
                                <td><?php echo $row["max_people"] ?></td>
                                <td>
                                    <form action="cancelTripDetails.php" method="post">
                                        <input type="hidden" name="tripID" value="<?php echo $row["tripID"]; ?>">						
                                        <button class="btn" type="submit">Cancel Booking</button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                               }
                               ?>

                        </table>
                <?php
                }
                else{
                ?>
                    <h2 style="text-align: center;">--No Record Found--</h2>
                <?php
                }
                ?>
    </section>

    <section class="container">
        <?php
            $trip_feature = "SELECT DISTINCT t.tripID, u.name, start_date, duration from trip_joining j, trip t , users u WHERE t.tripID IN (SELECT tripID from trip_joining WHERE username = '".$username."') AND t.username = u.username AND start_date < sysdate();";
            $result = mysqli_query($conn,$trip_feature) or die(mysqli_error($conn));
        ?>

                <h1 class="related">Trip History</h1>
		        <hr>
                <?php
                if (mysqli_num_rows($result)) {
                    ?>
                        <table class="table table-bordered text-center table-success">
                            <tr>
                                <td>Host</td>
                                <td>Date</td>
                                <td>Duration</td>
                                <td> </td>
                            </tr>
                            <tr>
                               <?php
                               while ($row = mysqli_fetch_assoc($result)) {
                                   ?>
                                <td><?php echo $row["name"] ?></td>
                                <td><?php echo $row["start_date"] ?></td>
                                <td><?php echo $row["duration"] ?></td>
                                <td>
                                    <form action="tripRating.php" method="post">
                                        <input type="hidden" name="tripID" value="<?php echo $row["tripID"]; ?>">						
                                        <button class="btn" type="submit">Rate</button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                               }
                               ?>

                        </table>
                <?php
                }
                else{
                ?>
                    <h2 style="text-align: center;">--No Record Found--</h2>
                <?php
                }
                ?>
    </section>


</body>
</html>