<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

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

if(!$success){
    die("Error: " . mysqli_connect_error());
} else {
    echo "connection succesfull";
}

$id = $_POST["name_id"];
$email = $_POST["name_email"];
$password = $_POST["name_password"];

$sql = "UPDATE students SET email = ?, password = ? WHERE id = ?";

$stmt = $conn -> prepare($sql);
$stmt -> bind_param("ssi", $email, $password, $id);

if ($stmt -> execute()){
    if($stmt->affected_rows > 0){
    echo "Student record successfully updated";
    } else {
    echo "Id does not exists-no record was updated";
    } 
} else {
    "Error: " . $sql . $conn->error;
    }

$stmt -> close();
$conn -> close();


?>