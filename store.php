<?php

session_start();
$product_ids = array();
//session_destroy();

//For testing - print session array in a nice format
function pre_r($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

//Check if add to cart button has been submitted
if(filter_input(INPUT_POST, 'add_to_cart')){
    if(isset($_SESSION['shopping_cart'])){
        //Keep track of how many products are in the shopping cart
        $count = count($_SESSION['shopping_cart']);

        //Create a sequential array for matching array keys to product ids
        $product_ids = array_column($_SESSION['shopping_cart'], 'id');

        //If the item is not in the cart, add it to the cart
        if(!in_array(filter_input(INPUT_GET, 'id'), $product_ids)){
            if(filter_INPUT(INPUT_POST, 'quantity') > 0){
            $_SESSION['shopping_cart'][$count] = array
                (
                    'id' => filter_input(INPUT_GET, 'id'),
                    'name' => filter_input(INPUT_POST, 'name'),
                    'price' => filter_INPUT(INPUT_POST, 'price'),
                    'quantity' => filter_INPUT(INPUT_POST, 'quantity')
                );
            }
        }
        else{
        //If the item is already in the cart, increment it by the desired amt
            for($i = 0; $i < count($product_ids); $i++){
                if ($product_ids[$i] == filter_input(INPUT_GET, 'id')){
                    if (filter_input(INPUT_POST, 'quantity') >= 0){
                        $_SESSION['shopping_cart'][$i]['quantity'] += filter_input(INPUT_POST, 'quantity');
                    }
                }
            }
        }
    }
    else{
        //if shopping cart doesn't exist, create first product with array key 0
        //Create array using submitted for data, start from key 0 and fill with values
        $_SESSION['shopping_cart'][0] = array
        (
            'id' => filter_input(INPUT_GET, 'id'),
            'name' => filter_input(INPUT_POST, 'name'),
            'price' => filter_INPUT(INPUT_POST, 'price'),
            'quantity' => filter_INPUT(INPUT_POST, 'quantity')
        );
    }
}

if(filter_input(INPUT_GET, 'action') == 'delete'){
    //If the user wants to delete an item, go through our array for find the matching product id
    foreach($_SESSION['shopping_cart'] as $key => $product){
        if ($product['id'] == filter_input(INPUT_GET, 'id')){
            //then delete it from the array
            unset($_SESSION['shopping_cart'][$key]);
        }
    }
}

//pre_r($_SESSION);
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
        <link rel="stylesheet" href="css/shop.css">
    </head>
    <body>
        <header>
          <!-- HEADER NAVIGATION WITH PHP ECHO BELOW BASED ON USER SESSION -->
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
					</a>
					<a class="header-signup" href="signup.php"><b>Sign Up</b></a>';
				}
			?>
        </header>

        <!-- Display items in the database-->
        <main>
          <section class = "products-container">
            <?php
                require "internal/databasehandler.internal.php";
                $query = 'SELECT * FROM products ORDER BY id ASC'; //Query to display items on the page
                $result = mysqli_query($connection, $query); //Result of the above query
                $row = mysqli_num_rows($result); //Number of rows from result, used to check if we got back some items

                //Check if the result is not empty
                if ($result){
                    if ($row != 0){
                        while ($product = mysqli_fetch_assoc($result)){
                            ?>
                                <div class = "product-card">
                                  <div class ="product-image">
                                    <!-- RETRIEVE IMAGE -->
                                    <img src="<?php echo $product['img']; ?>">
                                  </div>
                                  <div class="product-info">
                                    <form method = "post" action = "store.php?action=add&id=<?php echo $product['id']; ?>">
                                        <h4 class = "text-info"><?php echo $product['nam']; ?></h4>
                                        <h4>$<?php echo $product['price']; ?></h4>
                                        <?php if (isset($_SESSION['uname'])){ ?>
                                        <input type="text" name="quantity" class = "form-control" value="1">
                                        <?php } ?>
                                        <input type="hidden" name = "name" value= "<?php echo $product['nam']; ?>">
                                        <input type="hidden" name = "price" value= "<?php echo $product['price']; ?>">
                                        <?php if (isset($_SESSION['uname'])){ ?>
                                        <input type="submit" name = "add_to_cart" style = "margin-top: 5px" class = "btn btn-info" value = "Add to Cart">
                                        <?php } ?>
                                    </form>
                                </div>
                              </div>
                            <?php
                        }
                    }
                }
            ?>
            </section>

            <!-- Shopping cart display, table -->
            <?php if (isset($_SESSION['uname'])){ ?>
            <div style="clear:both"></div>
            <br>
            <div class ="shopping-cart">
                <table class= table">
                    <tr><th colspan="5"><h3>Cart Details</h3></th></tr>
                    <tr>
                        <th width="40%">Product Name</th>
                        <th width="10%">Quantity</th>
                        <th width="20%">Price</th>
                        <th width="15%">Total</th>
                        <th width="5%">Action</th>
                    </tr>
                    <?php
                    if(!empty($_SESSION['shopping_cart'])){
                        $total = 0;
                        foreach($_SESSION['shopping_cart'] as $key => $product){
                            ?>
                            <tr>
                                <td><?php echo $product['name']; ?></td>
                                <td><?php echo $product['quantity']; ?></td>
                                <td><?php echo $product['price']; ?></td>
                                <td><?php echo number_format($product['quantity'] * $product['price'], 2); ?></td>
                                <td>
                                    <a href="store.php?action=delete&id=<?php echo $product['id']; ?>">
                                        <button class="btn-remove">Remove</button>
                                    </a>
                                </td>
                            </tr>
                            <?php   $total = $total + ($product['quantity'] * $product['price']);
                        }
                        ?>
                        <tr>
                            <td colspan="3" align= "right">Total</td>
                            <td align="right"> <?php echo number_format($total, 2); ?></td>
                            <td></td>
                        </tr>
                        <tr>
                            <!-- Only show the checkout button if the shopping cart isn't empty -->
                            <td colspan="5">
                                <?php
                                    if (isset($_SESSION['shopping_cart'])){
                                        if (count($_SESSION['shopping_cart']) != 0){
                                            ?>
                                            <button class="btn-checkout">Checkout</button>
                                            <?php
                                        }
                                    }
                                    ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
            <?php } else{ ?>
                <p class="login-prompt">Please log in to access the store!</p>
            <?php } ?>
            <!-- End cart display -->

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
