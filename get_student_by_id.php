<?php

//Display errors on the browser that are hidden in PHP when connection fails
error_reporting(E_ALL);
ini_set('display_errors', 1);

//Database connection to phpMyAdmin:
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

if (!$success) {
    die("Connection error: " . mysqli_connect_error());
} else {
    echo "Connection successfull" . "<br>";
}

//get Id from the form:
$id = $_POST["name_id"];
//sql statement:
$sql = "SELECT * FROM students WHERE id = ?";

//Prepared statement, parameter binding, and execution

$prep_statement = $conn -> prepare($sql);
$prep_statement -> bind_param("i", $id);
$prep_statement -> execute();

$results = $prep_statement -> get_result();

//return students from results:

if ($results -> num_rows > 0) {
    $row = $results -> fetch_assoc();
    echo "ID: " . $row["id"] . " Email: " . $row["email"] . " Password: " . $row["password"] . "Date Created: " . $row["created_at"] . "<br>";
} else {
    echo "No student with the selected id exists.";
}

$prep_statement -> close();

$conn -> close();

?>