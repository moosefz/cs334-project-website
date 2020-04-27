<?php

$servername = "localhost";
$db_username = " ";
$db_password = " ";
$db_name = " ";

$connection = new mysqli($servername, $db_username, $db_password, $db_name); //Connect to the DB (server, uname, pw, dbname)

if ($connection -> connect_errno) {
  echo "Failed to connect to MySQL: " . $connection -> connect_error;
  exit();
}

?>
