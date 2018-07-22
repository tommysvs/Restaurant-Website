<?php
/*File to connect to the database*/

$host="127.0.0.1";
$port=3307;
$socket="";
$user="root";
$password="vagrant";
$dbname="nonnastable";
$mysqli = new mysqli($host, $user, $password, $dbname, $port, $socket)
or die ('Could not connect to the database server' . mysqli_connect_error());
//$mysqli->close();