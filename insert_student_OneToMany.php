<?php 
//Display errors on the browser that are hidden in PHP
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "database_connection.php";

$email = $_POST["name_email"];
$password = $_POST["name_password"];
$assignment = $_POST["name_frontBackEnd"];
$submission_status = $_POST["name_submission"];
$assignment_due_date = $_POST["name_date"];

//Submission to table student and Assignment in two steps
//1-Submission to table student
//SQL query:
$sql_1 = "INSERT INTO students (email, password) VALUES (?,?)";
//prepared statement, bind parameters, execute:
$prepared_statement = $conn->prepare($sql_1);
$prepared_statement->bind_param("ss", $email,$password);
if($prepared_statement->execute()){
    echo "Data inserted into students successfully" . "<br>";
} else {
    echo "Error " . $prepared_statement->error;
}

//2- Submission to assignments table
//assign student id to auto_incremented id in table:
$student_id = $conn->insert_id;
//SQL query:
$sql2 = "INSERT INTO assignment (name, is_done, target_date, student_id) VALUES (?,?,?,?)";
//prepared statement, binding parameters, execution:
$prepared_statement_2 = $conn->prepare($sql2);
$prepared_statement_2->bind_param("sisi", $assignment, $submission_status, $assignment_due_date, $student_id);
if($prepared_statement_2->execute()){
    echo "Data inserted successfully into assignments";
} else {
    echo "Error: " . $prepared_statement_2->error;
}

//close prepared statement and connection
$prepared_statement->close();
$prepared_statement_2->close();
$conn->close();

//However, If a student already exist, then the student will be registered with a new id 
//and not as expected with one user entry and two assignment entries. 
//Solution: condition statement for user entry before defining student id
?>
