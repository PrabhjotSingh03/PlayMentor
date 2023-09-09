<?php
include '/php_Handler/database_connection.php';
include '/php_Handler/create_schema.php';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Play Mentor</title>
		<link rel="stylesheet" type="text/css" href="style/style.css">
	</head>

	<body>
		<div class="bg">
			<Header id="header">
				<h1 id="site-name"><a href="#">Play Mentor</a></h1>
                <div class="admin_button"><a href="./pages/admin.php">Admin Panel </a></div>
			</Header>
			<main id="slideshow">
				<div class="slideshow-container">
					<div class="slideshow-box">
				  		<div class="slideshow-image">
							<img class="ss-img1" src="images/s1_5_hero_cropped.png" alt="Old wooden pirate ships sailing in sea">
				  		</div>
				  		<div class="slideshow-image">
							<img class="ss-img2" src="images/22.jpg" alt="far cry 6 character on a street holding a torch and gun ">
				  		</div>
				  		<div class="slideshow-image">
							<img class="ss-img4" src="images/Tom_Clancy_screenshot_2.jpg" alt="Tom clancy game character watching from top of hill">
							<!--https://www.wallpaperflare.com/tom-clancy-s-bolivia-chopper-weapon-gun-landscape-commando-wallpaper-cutrh-->
				  		</div>
				  		<div class="slideshow-image">
							<img class="ss-img1" src="images/social-share-image.jpg" alt="man in black suit holding cane and sitting on a chair">
				  		</div>
				  		<div class="slideshow-image">
							<img class="ss-img2" src="images/tomb_raider.jpg" alt="lara croft sitting on a tree branch with knife in her hand">
							<!--https://www.wallpaperflare.com/shadow-of-the-tomb-raider-2018-puzzle-video-game-lara-croft-tomb-raider-digital-wallpaper-wallpaper-pogrp-->
				  		</div>
				  		<div class="slideshow-image">
							<img class="ss-img3" src="images/witcher_horse.jpg" alt="Witcher game main character riding a horse going towards a castle">
							<!--https://www.wallpaperflare.com/warrior-horse-painting-sky-aenami-video-games-the-witcher-wallpaper-gqqgg-->
				  		</div>
					</div>
				</div>
			</main>
			<section id="forms">
				<div>
					<h2 class="slogan">"Wanna play games but confused which one, Don't worry just select the genre below"</h2>
				</div>
				<form name="gameForm" action="game.php" method="POST">
					<div class="input-container">
						<div class="dd">
							<label for="first_Choice">Choose Choice of Genre</label>
							<div>
								<select name="gameChoise" id="first_Choice">
								<option value="X" disabled selected>CHOOSE ONE</option>
									<?php
										$host = 'sql109.epizy.com';
										$user = 'epiz_34301171';
										$pass = 'JtQuL2g5nw';
										$db = 'epiz_34301171_playmentor';

										$con = mysqli_connect($host, $user, $pass, $db);

										if (mysqli_connect_error()) {
											echo "Failed to connect to MySQL: " . mysqli_connect_error();
											exit();
										}


										$query = "SELECT * FROM CategoryTable";
										$result = mysqli_query($con,$query);

										if(mysqli_num_rows($result)>0){
											while ($row = mysqli_fetch_assoc($result)){
												echo '<option value="' . $row['category_id'] . '">' . $row['Category_type'] . '</option>';
											}
										}else{
											echo "No data";
										}

										mysqli_close($con);


									?>
								</select>
							</div>
						</div>
					</div>
					<div id="btn">
						<input type="submit" value="Submit Your Selection">
					</div>
				</form>
			</section>
		</div>
    </body>
</html>