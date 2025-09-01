<?php 
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);


include "database_connection.php";

//Field submissions for student_id = 4:

$course_category = $_POST["name_course_category"];
$course_credits = $_POST["name_course_credits"];
$course_name = $_POST["name_course_name"];

$assignment_is_done = $_POST["name_assignment_is_done"];
$assignment_name = $_POST["name_assignment_name"];
$assignment_date = $_POST["name_assignment_date"];

$student_id = 3; // student_id = a number existing in student table to meet the foregn key constraints. 

//Begin transaction, commit, and rollback:
$conn -> begin_transaction();
//To UPDATE two tables in Many to Many relationships, update each table separately with student_id and then a JOIN. Reading possible by joining but updating requires separatte statements:
try {

//UPDATE sql query and prepared statement for table assignment:
    $sql_1 = "UPDATE assignment
              SET is_done = ?, name = ?, target_date = ?
              WHERE student_id = ?";
    $prep_stmt_1 = $conn->prepare($sql_1);
    $prep_stmt_1 ->bind_param("issi", $assignment_is_done, $assignment_name, $assignment_date, $student_id);
    if($prep_stmt_1->execute()){
        echo "query sql1 successfully executed for student ID: " . $student_id . "<br><br>";
    } else {
        echo "query sql1 failed" . "<br><br>";
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
//UPDATE sql query and prepared statement for table course
    $sql_2 = "UPDATE course AS C
              INNER JOIN enrolements_links AS L ON C.id = L.course_id
              INNER JOIN  assignment AS A ON A.id = L.assignment_id
              SET C.category = ?, C.credits = ?, C.name = ?
              WHERE A.student_id = ?";
    $prep_stmt_2 = $conn->prepare($sql_2);
    $prep_stmt_2->bind_param("sisi", $course_category, $course_credits, $course_name, $student_id);
    if($prep_stmt_2->execute()) {
        echo "sql_2 query successfully executed for ID: " . $student_id . "<br><br>";
    } else {
        echo "sql_2 query failed" . "<br><br>";
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $conn->commit();

} catch (Exception $e) {
    $conn->rollback();
    echo "Transaction failed-Data not Updated" . $e->getMessage();
}

//closing prepared statements and connection:
$prep_stmt_1->close();
$prep_stmt_2->close();

$conn->close();
?>