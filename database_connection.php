<?php 
//database connection:

$username = "root";
$password = "root";
$hostname = "localhost";
$database = "dbmgt";
$port = 8889;

$conn = mysqli_init();
$success = mysqli_real_connect(
    $conn,
    $hostname,
    $username,
    $password,
    $database,
    $port
);

if ($conn->connect_error) {
    echo "Connection Error: " . $conn->connect_error;
    die();
   //alternatively: die("Connection Error to database: " . $conn->connect_error);
} else {
    echo "Connection to databse dbmgt successful" . "<br><br>";
}