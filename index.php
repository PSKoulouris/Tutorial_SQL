<?php 

$user = 'root';
$password = 'root';
$db = 'dbmgt';
$host = 'localhost';
$port = 8889;

$conn = mysqli_init();
$success = mysqli_real_connect(
    $conn,
    $host,
    $user,
    $password,
    $db,
    $port
);


 if ($conn->connect_error) {
    echo 'Errno: '.$conn->connect_errno;
    echo '<br>';
    echo 'Error: '.$conn->connect_error;
    echo '<br>';
    exit();
 } else {
    echo 'Success: A proper connection to MySQL was made.';
    echo '<br>';
    echo 'Host information: '.$conn->host_info;
    echo '<br>';
    echo 'Protocol version: '.$conn->protocol_version;
    echo '<br>';
 }

 // Close the database connection
 $conn->close();
 




?>