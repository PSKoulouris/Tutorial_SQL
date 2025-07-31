<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "database_connection.php";

$email = $_POST["name_email"];
$password = $_POST["name_password"];
$id = $_POST["name_id"];

//SQL to update password and email with student id from assignment table by joining students and assignment table 
$sql ="UPDATE students AS S
        INNER JOIN assignment AS A
        ON S.id = A.student_id
        SET S.email = ?, S.password = ?
        WHERE student_id = ?" ;

//prepared statement, binding parameters and execution:

$prepared_statement = $conn->prepare($sql);
$prepared_statement->bind_param("ssi",$email,$password,$id);
if ($prepared_statement->execute()){
    echo "Credentials Updated successfully: " . $email . ", " . $password;
} else {
    echo "Credentials not updated: " . $conn->error;
}



?>