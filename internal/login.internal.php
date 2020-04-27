<?php

if (isset($_POST['login-button'])) 
{
	require "databasehandler.internal.php";
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if(empty($username) || empty($password))
	{
		header("Location: ../index.php?loginerror=emptyfield&loginusername=".$username);
		exit();
	}	
	else
	{
		$sql = "SELECT * FROM `users` WHERE `username` LIKE '$username'";
		
		$result = mysqli_query($connection, $sql);
		$row = mysqli_num_rows($result);
		$data = $result->fetch_assoc();
		
		if(!$result)
		{
			header("Location: ../signup.php?error=sqlerror");
			exit();
		}	
		else
		{
			if ($row > 0)
			{	
				if($password == $data["password"])
				{
					session_start();
					$_SESSION['uname'] = $username;
					header("Location: ../index.php?login=success");
					exit();
				}
				else
				{
					header("Location: ../index.php?loginerror=incorrectpassword&loginusername=".$username);
					exit();					
				}
			}
			else
			{
				header("Location: ../index.php?loginerror=nosuchuser&loginusername=".$username);
				exit();	
			}
		}
	}
}
?>