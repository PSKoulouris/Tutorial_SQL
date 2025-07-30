<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "database_connection.php";

//Define variables:
$email = $_POST["name_email"];
$password = $_POST["name_password"];
$assignment = $_POST["name_frontBackEnd"];
$submission_status = $_POST["name_submission"];
$assignment_due_date = $_POST["name_date"];

//Enter a new student record and assignments only if student does not exists or update assignments only if student already exist:

// 1-Check if student already exists with email address and retrieve id to generate foreign key student_id
// or insert new student entry and generate id_student:

//Sql_check query:
$sql_check = "SELECT id FROM students
                WHERE email = ?";

//Prepared statement 1:
$prepared_statement_check = $conn->prepare($sql_check);
//bind parameters:
$prepared_statement_check->bind_param("s", $email);
//execute
$prepared_statement_check->execute();
//get results:
$results_1 = $prepared_statement_check->get_result();

//if student exist, get id_student = id:
if($results_1->num_rows>0) {
    $row = $results_1->fetch_assoc();
    $student_id = $row["id"];
    echo "id already exists: " . $student_id . "<br>";
    echo "row: " . print_r($row) . "<br><br>";

    $prepared_statement_check->close();

} else {
    //Create new student with new id and student_id = newly generated id:
    $sql_2 = "INSERT INTO students (email, password) VALUES (?,?)";

    $prepared_statement_2 = $conn->prepare($sql_2);
    $prepared_statement_2->bind_param("ss", $email, $password);
    $prepared_statement_2->execute();

    //get newly generated id and assign it as student_id:
    $student_id = $conn->insert_id;
    echo "New student id generated: " . $student_id . "<br>";

    $prepared_statement_2->close();
}

//Insert information into assignments with student_id as foreign key:

$sql_3 = "INSERT INTO assignment (name, is_done, target_date, student_id) VALUES (?,?,?,?)";

$prepared_statement_3 = $conn->prepare($sql_3);
$prepared_statement_3->bind_param("sisi",$assignment, $submission_status, $assignment_due_date, $student_id);
if($prepared_statement_3->execute()){
    echo "Data inserted into assignment table for student id: " . $student_id;
} else {
    echo "data not inserted: " . $prepared_statement_3->error;
}

$prepared_statement_3->close();

$conn->close();
?>