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
        <link rel="stylesheet" href="css/contact.css">
        <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
          <!-- USED FOR CONTACT FORM TINY MCE INTEGRATION -->
          <script>
            tinymce.init({
              selector: '#mytextarea'
            });
          </script>
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
						<form action="internal/injection.php" method="post">
							<input type="text" name="username" placeholder="username">
							<input type="password" name="password" placeholder="password">
							<button type="submit" name="login-button">Login</button>
						</form>
						</form>
					</a>
					<a class="header-signup" href="signup.php"><b>Sign Up</b></a>';
				}
			?>

        </header>
        <!-- MAIN BODY FOR CONTACT US -->
        <main>
          <h1>Contact Us</h1>
            <div class="contact-container">
        				<form class="form-group" name="ContactForm"  method="post" action="internal/contact.php">
						     <form action="internal/injection.php" method="post">
        					<label for="name">Name:</label>
        					<input type="text" name = "name" class="form-control" id="name">

        					<label for="email">Email Address:</label>
        					<input type="email" name = "email" class="form-control" id="email">

        					<label for="message">Message:</label>
        					<textarea id="mytextarea" class="form-control" name="message" id="message"></textarea>
        					<button type="submit" name = "submit" class="btn btn-default">Submit</button>

        				 </form>
        				</form>

      				<div class="message_box" style="margin:10px 0px;"></div>
      				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      				<script src="internal/contact.js" type="application/javascript"></script>
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
