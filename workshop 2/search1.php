<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<title>Search Result</title>
	
</head>
<body>
	<?php 
	session_start();
	include ("connect.php");
	include("index_nav.php");
	?>
	<div>
	<table class="table table-hover text-center">
		<tr>
			<th>Image</th>
			<th>Travel Spot Name</th>
			<th>State</th>
			<th> </th>
		</tr>
	<?php 
		$search = $_POST['search'];
		$type = $_POST['search_type'];
			
		if(empty($search)){
			echo "<script>alert('Please insert the keyword');</script>";
			echo"<meta http-equiv='refresh' content='0; url=index.php'/>";
		}
		elseif($type !='spot_name' && $type !='state' && $type !='address'){
			echo "<script>alert('Please choose the search type');</script>";
			echo"<meta http-equiv='refresh' content='0; url=index.php'/>";
		}
		else{

		switch ($type) {
			case 'spot_name':
				$sql = "SELECT * FROM travel_spot WHERE spot_name LIKE '%".$search."%'";
				break;
				
			case 'state':
				$sql = "SELECT * FROM travel_spot WHERE state LIKE '%".$search."%'";
				break;

			case 'address':
				$sql = "SELECT * FROM travel_spot WHERE address LIKE '%".$search."%'";
				break;
		}

		$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

		if(mysqli_num_rows($result) > 0)
		{

			while ($row = mysqli_fetch_assoc($result)) 
			{						
	?>
		<tbody>
			<tr>
				<td>
				<?php 
					echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'" size=40x40 style="width:150 px; height: 150px;"/>';
				?>	
				</td>
				<td><?php echo $row["spot_name"];?></td>
				<td><?php echo $row["state"];?></td>
				<td>
					<form action="information.php" method="post">
						<input type="hidden" name="spotID" value="<?php echo $row["spotID"]; ?>">
						
						<button class="btn btn-outline-info" type="submit">Read More</button>
					</form>
				</td>
			</tr>
		</tbody>
		<?php
			}
		}

		else{
		?>	
		<tr>
			<td colspan="4">No Record Found</td>
		</tr>

		<?php
		}
		}
		?>


	</table>
	</div>

	<div class="d-grid gap-2 col-6 mx-auto">
	  <button class="btn btn-primary" type="button" onclick="window.open('http://localhost/workshop%202/index.php', '_self')">Back</button>
	</div>

</body>
</html>