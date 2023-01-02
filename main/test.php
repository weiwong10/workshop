<?php
	include "../connect.php";
	session_start();
    $username = $_SESSION['username'];
    $tripID = $_POST['tripID'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="tripDetails.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<title>Join Trip</title>
</head>
<body>
	<?php include("nav/nav_home.php")?>

    <section class="tripmate">
        <h1 class="related">Your Tripmates</h1><hr>
			<?php
				$trip = "SELECT name, image FROM trip t, trip_joining j, users u WHERE t.tripID = j.tripID AND j.username = u.username AND t.tripID = 1";
                $result = mysqli_query($conn,$trip) or die(mysqli_error($conn));

				while ($row = mysqli_fetch_assoc($result)) {
			?>

				<div class="card">
					<div class="image">

						<?php 
							echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'"/>';
						?>
	
					</div>

					<div class="caption">
						<p class="spot_name">
							<?php 
							echo $row["name"];			
							?>	
						</p>
					</div>
				</div>
			<?php
			}

			?>
    </section>

</body>
</html>
