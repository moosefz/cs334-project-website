<?php


if(isset($_POST['submit'])){
    sleep(4);
	$name = $_POST['name'];
	$subject = "You have receieved a feedback";
	$mailFrom = $_POST['email'];
	$message = $_POST['message'];



	 //Fill in relevant contact receiver here for Contact Form
	$mailTo = " ";
	$headers = "From: ".$mailFrom;
	$txt = "You have received an e-mail from ".$name.".\n\n".$message;

	mail($mailTo, $subject, $txt, $headers);
	header("Location: ../contactus.php?mailsend");


}
