<?php

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

include "database_connection.php";

$student_id = $_POST["name_student_id"]; // student_id = a number existing in student table to meet the foregn key constraints.

//Begin transaction:
$conn->begin_transaction();

try {
    //delete from course first as student_id relies on the table assignment 
    $sql_1 = "DELETE FROM assignment
            WHERE student_id = ? ";
    //prepared statement:
    $stmt_1 = $conn ->prepare($sql_1);
    $stmt_1->bind_param("i", $student_id);
    if($stmt_1->execute()){
        echo "Data succesffully deleted for ID : " . $student_id . "<br><br>";
    } else {
        echo "Data not fully deleted for id: " . $student_id . "<br><br>";
    }

    //commit transaction:
    $conn->commit();

} catch (Exception $e) {
    $conn->rollback();
    echo "Transaction failed; data were not deleted: " . $e->getMessage() . "<br><br>";
}

?>