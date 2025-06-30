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

/*
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
 } */


    $sql = "SELECT * FROM students";
    $results = $conn -> query($sql);

    if ($results->num_rows > 0) {
        while ($row = $results->fetch_assoc()) {
            echo "id: " . $row["id"] . " Name: " . $row["name"] . " Email: " . $row["email"] . $row["created_at"] . "<br>";
    }
        } else {
        echo "No data available";
    }


 // Close the database connection
 $conn->close();
 




?>