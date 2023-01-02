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
	<title>Travel Buddy</title>

	<!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">-->
	<link rel="stylesheet" type="text/css" href="main_style.css">

</head>

<body>
		<?php include("nav/nav_home.php")?>

		<section class="home">
		<div class="slide" style="background:url(../image/image.jpg) no-repeat">
            <div class="content">
               <span><b>Explore, Discover, Travel</b></span>
               <h3>travel arround the world</h3>
               <a href="mainTrip.php" class="btn">Discover more</a>
            </div>
         </div>
		</section>

        <section>

        <section class="services">

        <h1 class="heading-title"> Explore By </h1>

        <div class="box-container">

        <div class="box">
            <a href="maintravelspot.php"><img src="../image/destination.png" alt=""></a>
            <h3>Travel Spot</h3>
        </div>

        <div class="box">
            <a href="mainTrip.php"><img src="../image/travel-luggage.png" alt=""></a>
            <h3>Trip</h3>
        </div>

    </div>

    </section>
        
    <section class="home-packages">

        <h1 class="heading-title"> theme </h1>
    
        <div class="box-container">
        
        <?php
            $theme = "SELECT * FROM theme limit 3";
            $theme_result = mysqli_query($conn,$theme) or die(mysqli_error($conn));

        while ($row = mysqli_fetch_assoc($theme_result)) {
        ?>


            <div class="box">
                <div class="image">
                    <?php 
						echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'"/>';
				    ?>
                </div>
                <div class="content">
                    <h3><?php echo $row["themeName"]?></h3>
                    <p><?php echo $row["description"]?></p>
                    <form action="mainThemeInfo.php" method="post">
						<input type="hidden" name="themeID" value="<?php echo $row["themeID"]; ?>">
						
						<button class="btn" type="submit">Book Now</button>
					</form>

                </div>
            </div>
        <?php
        }
        ?>
        </div>



        <div class="load-more"> <a href="mainTheme.php" class="btn">Load more</a> </div>

    </section>


</body>
</html>