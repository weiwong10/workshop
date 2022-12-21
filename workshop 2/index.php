<?php
	include "connect.php";
	session_start();
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Travel Buddy</title>

	<!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">-->
	<link rel="stylesheet" type="text/css" href="index_style.css">

</head>

<body>
		<?php include("index_nav.php")?>
<!--
			<form action="search1.php" method="post" role="search">
				<div class="input-group mb-3" >
				<input class="form-control" type="text" name="search" placeholder="Search">

				<select name="search_type">
		  			<option selected>--Search by--</option>
		  			<option value="spot_name">
		  				Travel Spot Name
		  			</option>
		  			<option value="state">
		  				State
		  			</option>
		  			<option value="address">
		  				Address
		  			</option>
			  	</select>

				<button type="btn btn-primary" type="submit">Search</button>
				</div>
			</form>
-->
		<form action="search1.php" method="post" role="search">
				<div class="container" >
					<div class="search_wrap">
						<div class="search_box">
							<input class="form-control" type="text" name="search" placeholder="Search">

							<select name="search_type">
		  						<option selected>--Search by--</option>
		  						<option value="spot_name">
		  							Travel Spot Name
		  						</option>
					  			<option value="state">
					  				State
					  			</option>
					  			<option value="address">
					  				Address
					  			</option>
						  	</select>
						 	
							<button type="btn btn_common" type="submit"><img src="image/search.png" width="15" height="15"></button>
						
						</div>
					</div>
				</div>
			</form>
		

		<main>
			<?php
				$sql = "SELECT * FROM travel_spot";
				$all_spot = mysqli_query($conn,$sql) or die(mysqli_error($conn));

				while ($row = mysqli_fetch_assoc($all_spot)) {
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
							echo $row["spot_name"];			
							?>	
						</p>
						<p class="state">
							State: 
							<?php 
								echo $row["state"];	
							?>								
						</p>
					</div>
					<form action="information.php" method="post">
						<input type="hidden" name="spotID" value="<?php echo $row["spotID"]; ?>">
						
						<button class="more" type="submit">Read More</button>
					</form>
				</div>
			<?php
			}

			?>
		</main>


</body>
</html>