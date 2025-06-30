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

if ($conn -> connect_error) {
    die("Connection failed" . $conn->connect_error);
} else {
   echo "connected with success";
}


$email = $_POST["email"];
$password = $_POST["password"];

$sql = "INSERT INTO students (email, password) VALUES (?,?)";

$prepared_statement = $conn -> prepare($sql);
$prepared_statement -> bind_param("ss", $email, $password);

if ($prepared_statement -> execute()){
    echo "data successfully inserted";
} else {
    echo "Error: " . $sql . "<br>" . $conn -> error;
}

$prepared_statement -> close();

$conn -> close();







?>