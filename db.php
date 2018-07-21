<?php
/*File to connect to the database*/

<<<<<<< HEAD
$host="127.0.0.1";
$port=3307;
$socket="";
$user="root";
$password="vagrant";
$dbname="nonnastable";

$mysqli = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());

//$mysqli->close();
=======
$mysqli = new mysqli('localhost', 'root', '', 'nonnastable');
>>>>>>> 4eff8b394dc2095919b05c494cc27d61b32a7bf6
/* check connection */
if ($mysqli->connect_error) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
//select a database to work with
$mysqli->select_db('nonnastable');