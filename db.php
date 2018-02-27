<?php
	//Database Connect
 $servername = "localhost";
 $username = "root";
 $password = "P88sI55d";
 $dbname = "csddatabase";

// Create connection
 $conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	echo "What Happen";
}
?>