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
        <link rel="stylesheet" href="css/signup.css">
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
						echo '<li><a href="profile.php">My Account</a></li>';
					}
				  ?>
                </ul>
            </nav>

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
				echo '<a class ="header-login">
					<form action="internal/login.internal.php" method="post">
						<input type="text" name="username" placeholder="username">
						<input type="password" name="password" placeholder="password">
						<button type="submit" name="login-button">Login</button>
					</form>
				</a>
				<a class="header-signup" href="signup.php"><b>Sign Up</b></a>';
			}
			?>
        </header>
      <!-- MAIN SIGN UP FORM BODY -->
              <main>
					<h1>Sign Up</h1>
    				<div class="signup-container">
					<?php
					if(isset($_GET['error']))
					{	
						if($_GET['error'] == "emptyfield") 
						{
							echo '<p class="signuperror">Please fill in all fields</p>';
						}
						else if($_GET['error'] == "passwordmismatch") 
						{
							echo '<p class="signuperror">Your passwords must match</p>';
						}
						else if($_GET['error'] == "userexists") 
						{
							echo '<p class="signuperror">That username is taken - please choose a different one</p>';
						}
					}
					else if($_GET['signup'] == "successful")
					{
						echo '<p class="signupsuccess">You have successfully signed up for CatShop!</p>';
					}
					
					if(isset($_SESSION['uname']))
					{
						echo '<p>Hi '.$_SESSION['uname'].', you already have an account!</p>';
					}
					else
					{
						if(isset($_GET['username']))
						{
							echo '<form class="form-signup" action="internal/signup.internal.php" method="post">
								<input type="text" name="username" value="'.$_GET['username'].'">
								<input type="password" name="password" placeholder="Password">
								<input type="password" name="password-verify" placeholder="Verify password">
								<button type="submit" name="signup-button">Sign Up</button>
							</form>';							
						}	
						else
						{
							echo '<form class="form-signup" action="internal/signup.internal.php" method="post">
								<input type="text" name="username" placeholder="Username">
								<input type="password" name="password" placeholder="Password">
								<input type="password" name="password-verify" placeholder="Verify password">
								<button type="submit" name="signup-button">Sign Up</button>
							</form>';							
						}	
					}
					?>
					</div>
        </main>

				<!-- FOOTER -->
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
