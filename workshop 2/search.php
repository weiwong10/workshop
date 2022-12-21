<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Travel Buddy</title>

</head>
<body>
	<div>
		<?php include("index_nav.php");

			include ("connect.php");

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
			
			?>
				<table width="60%" border="1" cellpadding="5" cellspacing="5">
					<thead>
					<tr>
						<th>Image</th>
						<th>Travel Spot Name</th>
						<th>State</th>
						<th> </th>
					</tr>
					</thead>
			<?php

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
						echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'" style="width:100 px; height: 100px;"/>';
					?>	
					</td>
					<td><?php echo $row["spot_name"];?></td>
					<td><?php echo $row["state"];?></td>
					<td>Action</td>
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

				</table>
			<?php
				}
			?>
			<div>
			<button onclick="window.open('http://localhost/workshop%202/index.php', '_self')" class="back">Back</button>
			</div>
			<?php
			}
			?>

	</div>



</body>
</html>