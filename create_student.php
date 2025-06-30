<?php

$user = 'root';
$password = 'root';
$db = 'dbmgt';
$host = 'localhost';
$port = 8889;

$conn = mysqli_init();
$success = mysqli_real_connect(
   $link,
   $host,
   $user,
   $password,
   $db,
   $port
);

if ($conn -> connect_error) {
    echo "connection failed";
    exit();
} else {
    "connected with success";
}

$conn -> close();







?>