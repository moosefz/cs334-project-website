<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="CatShop - Your source for cats!">
        <meta name=viewport content="width=device-width, initial-scale=1">
        <title>CatShop - Your source for cats!</title>
        <link rel="stylesheet" href="css/index.css">
    </head>
    <body>
	      <!-- HEADER NAVIGATION WITH PHP ECHO BELOW BASED ON USER SESSION -->
        <header>
          <img class="logo" src="images/logo-1.png" alt="logo">
            <nav>
                <ul class="nav-links">
                  <li><a href="index.php">Home</a></li>
                  <li><a href="about.php">About</a></li>
                  <li><a href="store.php">Shop</a></li>
                  <li><a href="contactus.php">Contact Us</a></li>
				  <?php
					if(isset($_SESSION['uname']))
					{
						echo '<li><a href="myaccount.php">My Account</a></li>';
					}
				  ?>
                </ul>
            </nav>
			<!-- DISPLAY OF LOGIN BUTTONS AND LOGIN ERRORS -->
			<?php

			if(isset($_SESSION['uname']))
				{
					echo '<p class="welcome">Welcome back, '.$_SESSION['uname'].'</p>';
					echo '<a class="header-logout">
						<form action="internal/logout.internal.php" method="post">
							<button type="submit" name="logout-button">Logout</button>
						</form>
					</a>';
				}
			else
			{	
				if(isset($_GET['loginerror']))
				{
					if($_GET['loginerror'] == "emptyfield") 
					{
						echo '<br><p class="loginerror">Fill in both fields</p>';
					}
					else if($_GET['loginerror'] == "incorrectpassword") 
					{
						echo '<p class="loginerror">Incorrect password</p>';
					}
					else if($_GET['loginerror'] == "nosuchuser") 
					{
						echo '<p class="loginerror">'.$_GET['loginusername'].' is not registered</p>';
					}
				}
				
				if(isset($_GET['loginusername']))
				{		
					echo '<a class ="header-login">
						<form action="internal/login.internal.php" method="post">
							<input type="text" name="username" value="'.$_GET['loginusername'].'">
							<input type="password" name="password" placeholder="password">
							<button type="submit" name="login-button">Login</button>
						</form>
					</a>
					<a class="header-signup" href="signup.php"><b>Sign Up</b></a>';						
				}
				else
				{					
					echo '<a class ="header-login">
						<form action="internal/login.internal.php" method="post">
							<input type="text" name="username" placeholder="username">
							<input type="password" name="password" placeholder="password">
							<button type="submit" name="login-button">Login</button>
						</form>
					</a>
					<a class="header-signup" href="signup.php"><b>Sign Up</b></a>';
				}
			}
			?>
        </header>
			<!-- MAIN BODY OF INDEX PAGE -->
        <main>
					<div class="page-main">
              <h1>Welcome to CATSHOP<h1>
              <p>Your #1 source for cats daily.</p>
          </div>
        </main>

				<footer class="page-footer">
					<small>© Copyright CatShop 2020. All rights reserved.</small>
					<ul>
						<li><a href="#" target="_blank"><img src="images/fb.png"></a></li>
						<li><a href="#" target="_blank"><img src="images/twi.png"></a></li>
						<li><a href="#" target="_blank"><img src="images/ins.png"></i></a></li>
						<li><a href="#" target="_blank"><img src="images/gh.png"></i></a></li>
					</ul>
				</footer>

  </body>
</html>
