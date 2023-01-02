<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<link rel="stylesheet" type="text/css" href="navAdmin_style.css">

</head>
<body>
	<!--The nav bar-->	
		<div class="menu_bar">

			<h1 class="logo"> Travel<span>Buddy</span><h1>

			<ul>
				<li>
					<!-- <a class="active" href="#">Dashboard</a> -->
					<a href="#">Dashboard </i></a>
				</li>
				<li>
					<a href="display.php">Manage User </i></a>
					<!-- <div class="dropdown_menu">
						<ul>
							<li><a href="#">Update User</a></li>
							<li><a href="#">Delete User</a></li>
							<li><a href="#">View User</a></li> -->
						<!-- </ul>
					</div> -->
				</li>
				<li>
					 <a href="travel.php">Travel Spot</i></a>
				<!-- <li>
				<li>
					 <a href="#">Travel Spot Information</a></li>					  -->
				</li>
				<li>
					<a href="#">My Profile <i class="fas fa-caret-down"></i></a>
					<div class="dropdown_menu">
						<ul>
							<li><a href="manageProfile.php">Profile</a></li>
							<li><a href="#">Logout</a></li>
						</ul>
				</li>
			</ul>
		</div>


</body>
</html>