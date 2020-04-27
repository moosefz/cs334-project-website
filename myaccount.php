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
        <!-- Include bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
        <link rel="stylesheet" href="css/about.css">
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
							<input type="text" name="username" placeholder="username">
							<input type="password" name="password" placeholder="password">
							<button type="submit" name="login-button">Login</button>
						</form>
					</a>
					<a class="header-signup" href="signup.php"><b>Sign Up</b></a>';
        }

        //If the user is logged in, connect to the database and get their address info
        if(isset($_SESSION['uname'])){
            require "internal/databasehandler.internal.php";
            $query = 'SELECT `address` FROM `users` WHERE `username` ="' . $_SESSION['uname'] .'"'; //Query to display items on the page
            $result = mysqli_query($connection, $query); //Result of the above query
            $address_text = mysqli_fetch_assoc($result);

            //Check if user is updating their address
            if(filter_input(INPUT_POST, 'update_address')){
                $newText = filter_INPUT(INPUT_POST, 'address');
                $newText = $connection->real_escape_string($newText);
                $_SESSION['uname'] = $connection->real_escape_string($_SESSION['uname']);
                $query = 'UPDATE users SET address="' . $newText . '"WHERE users.username ="' . $_SESSION['uname'] . '"';
                $result = mysqli_query($connection, $query); //Result of the above query
                $query = 'SELECT `address` FROM `users` WHERE `username` ="' . $_SESSION['uname'] .'"'; //Query to display items on the page
                $result = mysqli_query($connection, $query); //Result of the above query
                $address_text = mysqli_fetch_assoc($result);
            }
        }
			?>
        </header>

			<!-- MAIN BODY -->
        <main>
					<div class="page-main">

            <h1>Profile</h1>
            <?php 
              if(isset($_SESSION['uname'])){
              echo "My address is: ". $address_text['address']; 
              }
            ?>

          <!-- If user is admin, display an edit box + button which will update the DB about text. -->
          <?php
            if(isset($_SESSION['uname'])){
              ?>
                <br>
                <form method = "post" action = "myaccount.php?action=update_address">
                    <div class = "products">
                        <h4 class = "text-info">Update my Address</h4>
                        <input type="text" name="address" class = "form-control" value="">
                        <input type="submit" name = "update_address" style = "margin-top: 5px" class = "btn btn-info" value = "Submit">
                    </div>
                </form>
              <?php
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
    <!-- Bootstrap reqs -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
  </body>
</html>
