<?php
$user = "root";
$password ="root";
$host= "localhost";
$port = 8889;
$db = "dbmgt";

$conn = mysqli_init();
$success = mysqli_real_connect(
    $conn,
    $host,
    $user,
    $password,
    $db,
    $port
);

if (!$success){
    die("error: " . $conn->error);
} else {
    echo "connection successfull";
}

$id = $_POST["name_id"];

$sql = "DELETE FROM students WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if($stmt->execute()){
    if ($stmt -> affected_rows > 0){
    echo "Student entry id: {$id} successfully deleted";
    } else {
        echo " No student with id: {$id} specified exists";
    }
} else {
    echo "error: ". $sql . $conn->error;
}

$stmt -> close();
$conn -> close();

?>