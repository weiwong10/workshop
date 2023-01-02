<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="mainInformation.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<title>Theme Detail</title>
</head>
<body>
	<?php include("nav/nav_home.php")?>

	<section class="details">
		<?php
			include "../connect.php";
			$themeID = $_POST['themeID'];
			$sql = "SELECT * FROM theme WHERE themeID = '".$themeID."'";

			$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

			while ($row = mysqli_fetch_assoc($result)) {
		
		?>
		
		<h1 class="themename"><?php echo $row["themeName"]?></h1>
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
					
				</p>

				<button onclick="window.open('http://localhost/workshop%202/main/mainTheme.php', '_self')" class="back">Back</button>
			</div>
		</div>

	<?php 
		}

	?>
	</section>

    <section class="container">
        <?php
        $trip_feature = "SELECT t.tripID, u.name, start_date, duration, current_people, max_people FROM trip t, theme h, users u WHERE t.themeID = h.themeID AND h.themeID = '" . $themeID . "' AND t.username = u.username AND featuredID != 'NULL' AND start_date > sysdate()";
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
                                <form action="tripDetails.php" method="post">
                                    <input type="hidden" name="tripID" value="<?php echo $row["tripID"]; ?>">						
                                    <button class="btn" type="submit">Book Now</button>
                                </form>
                                </td>
                            </tr>
                            <?php
                                }
                            ?>

                        </table>

    </section>

    <section class="container">
        <?php
            $trip = "SELECT tripID,u.name, start_date, duration, current_people, max_people FROM trip t, theme h, users u WHERE t.themeID = h.themeID AND h.themeID = '" . $themeID . "' AND t.username = u.username AND start_date > sysdate()";
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
                                <form action="tripDetails.php" method="post">
                                    <input type="hidden" name="tripID" value="<?php echo $row["tripID"]; ?>">						
                                    <button class="btn" type="submit">Book Now</button>
                                </form>
                                </td>
                            </tr>
                            <?php
                                }
                            ?>

                        </table>

    </section>

    <button onclick="window.open('mainTheme.php', '_self')" id="home">Back</button>


</body>
</html>