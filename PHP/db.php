<?php

	$host= "localhost";  
	$user= "adisha";
	$pass= "Ff7AXqxIxF7b";
	$db= "adisha_shape4you_managment";

// Create connection
$conn = new mysqli($host, $user, $pass, $db);
// Check the connection
if ($conn->connect_error) 
{
    die("Connection failed:".$conn->connect_error());
}


if (!$conn->set_charset("utf8")) {
    die("Error loading character set utf8: $conn->error");
}
?>