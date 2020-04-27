<?php


if ( ($_POST['name']!="") && ($_POST['email']!="")){
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];


	echo "<span style='color:green; font-weight:bold;'>
	Thank you for contacting us, we will get back to you shortly.
	</span>";



}
?>