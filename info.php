<?php
require_once 'db.php';

$name = $_GET['name'];
$surname = $_GET['surname'];

//$name = "Rogmer";
//$surname ="Bulaclac";

$infosql = "INSERT INTO `info` (`Name`,`Surname`) VALUES ('$name','$surname') ";
$result = $conn->query($infosql);
echo "success";
?>

