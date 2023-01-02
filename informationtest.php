<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="informationtest.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<title>Spot Detail</title>
</head>
<body>
	<?php include("index_nav.php")?>

	<section class="details">
		<?php
			include "connect.php";
			$spotID = $_POST['spotID'];
			$sql = "SELECT * FROM travel_spot WHERE spotID = '".$spotID."'";

			$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

			while ($row = mysqli_fetch_assoc($result)) {
		
		?>
		
		<h1 class="spotname"><?php echo $row["spot_name"]?></h1>
		<hr>

		<div class="cards">
			<div class="images">
				<?php 
					echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'"/>';
				?>
			</div>

			<div class="caption">
				<p class="description">

					<b>Description</b>:<br>
					<?php echo $row["description"];?>
					
				</p><br>
				<p class="address">

					<b>Address</b>:<br>
					 <?php echo $row["address"]?>
					
				</p>

			</div>
		</div>

	<?php 
		}

	?>
	</section>

    <section class="container">
        <?php
            $trip_feature = "SELECT DISTINCT u.name, start_date, duration, current_people, max_people FROM trip t, travel_itinerary i, travel_spot s, users u WHERE s.spotID = i.spotID AND i.tripID = t.tripID AND s.spotID= '".$spotID."' AND t.username = u.username AND start_date > sysdate() AND featuredID != 'NULL'";
            $result = mysqli_query($conn,$trip_feature) or die(mysqli_error($conn));
        ?>

                <h1 class="related">Feature Trip</h1>
		        <hr>
                        <table class="table table-bordered text-center table-warning">
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
                                <a href="login/login.php" class="btn">Book Now</a>
                                </td>
                            </tr>
                            <?php
                                }
                            ?>

                        </table>

    </section>

    <section class="container">
        <?php
            $trip = "SELECT DISTINCT u.name, start_date, duration, current_people, max_people FROM trip t, travel_itinerary i, travel_spot s, users u WHERE s.spotID = i.spotID AND i.tripID = t.tripID AND s.spotID= '".$spotID."' AND t.username = u.username AND start_date > sysdate();";
            $result1 = mysqli_query($conn,$trip) or die(mysqli_error($conn));
        ?>
  
                <h1 class="related">Related Trip</h1>
		        <hr>
                        <table class="table table-bordered text-center table-light">
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
                                    while ($row = mysqli_fetch_assoc($result1)) {
                                ?>
                                <td><?php echo $row["name"] ?></td>
                                <td><?php echo $row["start_date"] ?></td>
                                <td><?php echo $row["duration"] ?></td>
                                <td><?php echo $row["current_people"] ?></td>
                                <td><?php echo $row["max_people"] ?></td>
                                <td>
                                <a href="login/login.php" class="btn">Book Now</a>
                                </td>
                            </tr>
                            <?php
                                }
                            ?>

                        </table>

    </section>

    <div id="home"><a href="travelspot1.php">Back</a></div>

</body>
</html>