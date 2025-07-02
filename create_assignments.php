<?php 
//Display errors on the browser that are hidden in PHP when connection fails
error_reporting(E_ALL);
ini_set('display_errors', 1);

$user = "root";
$password = "root";
$host = "localhost";
$db = "dbmgt";
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
    die("error: " . $conn . $conn->error);
} else {
    echo "Successfull connection" . "<br>";
}

/*
$sql = " CREATE TABLE assignment (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        is_done  BOOLEAN NOT NULL DEFAULT FALSE,
        target_date DATE,
        student_id INT,
        FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE ON UPDATE CASCADE
    )";


if ($conn-> query($sql)){
    echo "Table successfully created";
} else {
    echo "Error: " . $conn->error;
}
*/

//Insert values with a prepare statement:

$sql = "INSERT INTO assignment (name, is_done, target_date, student_id)
        VALUES (?,?,?,?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sisi", $name, $is_done, $target_date, $student_id);

//student id=2:

$name = "Front-end";
$is_done = 1;
$target_date = "2025-09-30";
$student_id = 2;

if ($stmt->execute()){
    $autoIncrementId = $conn->insert_id;
    echo "input id: {$autoIncrementId} successfully inserted";
} else {
    echo "Error: " . $stmt->error;
}

$name = "Back-end";
$is_done = 0;
$target_date = "2025-09-24";
$student_id = 2;

if ($stmt->execute()){
    $autoIncrementId = $conn->insert_id;
    echo "input id: {$autoIncrementId} successfully inserted";
} else {
    echo "Error: " . $stmt->error;
}

//student id=3:

$name = "Front-end";
$is_done = 1;
$target_date = "2025-09-30";
$student_id = 3;

if ($stmt->execute()){
    $autoIncrementId = $conn->insert_id;
    echo "input id: {$autoIncrementId} successfully inserted";
} else {
    echo "Error: " . $stmt->error;
}

$name = "Back-end";
$is_done = 1;
$target_date = "2025-09-20";
$student_id = 3;

if ($stmt->execute()){
    $autoIncrementId = $conn->insert_id;
    echo "input id: {$autoIncrementId} successfully inserted";
} else {
    echo "Error: " . $stmt->error;
}

//student id=4:

$name = "Front-end";
$is_done = 0;
$target_date = "2025-09-30";
$student_id = 4;

if ($stmt->execute()){
    $autoIncrementId = $conn->insert_id;
    echo "input id: {$autoIncrementId} successfully inserted";
} else {
    echo "Error: " . $stmt->error;
}

$name = "Back-end";
$is_done = 0;
$target_date = "2025-09-15";
$student_id = 4;

if ($stmt->execute()){
    $autoIncrementId = $conn->insert_id;
    echo "input id: {$autoIncrementId} successfully inserted";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();



/*
function insertAssignment($stmt, $name, $is_done, $target_date, $student_id, $conn) {
    $stmt->bind_param("sisi", $name, $is_done, $target_date, $student_id);
    if ($stmt->execute()){
        $insertId = $conn->insert_id;
        echo "Input id: {$insertId} successfully inserted<br>";
    } else {
        echo "Error: " . $stmt->error . "<br>";
    }
}

// Insert rows:
insertAssignment($stmt, "Front-end", 1, "2025-09-30", 2);
insertAssignment($stmt, "Back-end", 0, "2025-09-24", 2);

*/

?>