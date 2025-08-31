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

try {

//sql query and prepared statement for table assignment:
    $sql_1 = "INSERT INTO assignment (is_done, name, student_id, target_date)
            VALUES (?, ?, ?, ?)";
    $prep_stmt_1 = $conn->prepare($sql_1);
    $prep_stmt_1 ->bind_param("isis", $assignment_is_done, $assignment_name, $student_id, $assignment_date);
    if($prep_stmt_1->execute()){
        echo "query sql1 successfully executed" . "<br><br>";
    } else {
        echo "query sql1 failed" . "<br><br>";
    }
//Assign auto-inserted id to variable assignment_id:
    $assignment_id = $prep_stmt_1->insert_id; 

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
//sql query and prepared statement for table course
    $sql_2 = "INSERT INTO course (category, credits, name)
                VALUES (?, ?, ?)";
    $prep_stmt_2 = $conn->prepare($sql_2);
    $prep_stmt_2->bind_param("sis", $course_category, $course_credits, $course_name);
    if($prep_stmt_2->execute()) {
        echo "sql_2 query successfully executed" . "<br><br>";
    } else {
        echo "sql_2 query failed" . "<br><br>";
    }
//Assign auto-inserted id to variable course_id:
    $course_id = $prep_stmt_2->insert_id;

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//sql query_3 for enrolements_links table:
    $sql_3 = "INSERT INTO enrolements_links (assignment_id, course_id)
            VALUES (?, ?)";
    $prep_stmt_3 = $conn->prepare($sql_3);
    $prep_stmt_3->bind_param("ii", $assignment_id, $course_id);
    if($prep_stmt_3->execute()) {
        echo "query sql_3 successfully executed" . "<br><br>";
    } else {
        echo "sql_3 query failed";
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $conn->commit();

} catch (Exception $e) {
    $conn->rollback();
    echo "Transaction failed-Data not inserted" . $e->getMessage();
}

//closing prepared statements and connection:
$prep_stmt_1->close();
$prep_stmt_2->close();
$prep_stmt_3->close();

$conn->close();
?>