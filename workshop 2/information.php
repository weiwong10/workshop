<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="information.css">
	<title>Spot Detail</title>
</head>
<body>
	<?php include("index_nav.php")?>

	<main>
		<?php
			include "connect.php";
			$spotID = $_POST['spotID'];
			$sql = "SELECT * FROM travel_spot WHERE spotID = '".$spotID."'";

			$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

			while ($row = mysqli_fetch_assoc($result)) {
		
		?>
		
		<h1 class="spotname"><?php echo $row["spot_name"]?></h1>
		<hr>

		<div class="card">
			<div class="images">
				<?php 
					echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'"/>';
				?>
			</div>

			<div class="caption">
				<p class="description">

					<b>Description</b>:<br>
					<?php echo $row["description"]?>
					
				</p><br>
				<p class="address">

					<b>Address</b>:<br>
					 <?php echo $row["address"]?>
					
				</p>

				<button onclick="window.open('http://localhost/workshop%202/index.php', '_self')" class="back">Back</button>
			</div>
		</div>

	<?php 
		}

	?>

	</main>

</body>
</html>