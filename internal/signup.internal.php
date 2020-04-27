<?php
if (isset($_POST['signup-button'])) 
{
	require "databasehandler.internal.php";
    
	$username = $_POST['username'];
	$password = $_POST['password'];
	$passwordVerify = $_POST['password-verify'];
	
	if(empty($username) || empty($password) || empty($passwordVerify))
	{
		header("Location: ../signup.php?error=emptyfield&username=".$username);
		exit();
	}
	
	else if($password !== $passwordVerify) 
	{
		header("Location: ../signup.php?error=passwordmismatch&username=".$username);
		exit();
	}
	else
	{
		$sql = "SELECT * FROM `users` WHERE `username` LIKE '$username'";
		$result = mysqli_query($connection, $sql); //Result of the above query
		$row = mysqli_num_rows($result); //Number of rows from result, used to check if we got back some items
		if(!$result) 
		{
			header("Location: ../signup.php?error=sqlerror");
			exit();
		}
		else
		{
			if($row > 0) {
				header("Location: ../signup.php?error=userexists&username=".$username);
				exit();	
			}
			else
			{
				$username = $connection->real_escape_string($username);
				$password = $connection->real_escape_string($password);
				$sql = "INSERT INTO `users` (`usernum`, `username`, `password`) VALUES (NULL, '$username', '$password');";
				$result = mysqli_query($connection, $sql); //Result of the above query
				
				if(!$result)
				{
					header("Location: ../signup.php?error=sqlerror");
					exit();
				}
				else
				{
					header("Location: ../signup.php?signup=successful");
					exit();
				}
			}
		}
	}
	
	mysqli_stmt_close($statement);
	mysqli_close($connection);

}
else
{
	header("Location: ../signup.php");
	exit();	
}



?>