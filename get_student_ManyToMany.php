<?php 
ini_set("display_errors",1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

include "database_connection.php";

$sql = "SELECT A.student_id, A.target_date, A.name, A.is_done,C.name AS course_name, C.category, C.credits, L.grade
        FROM assignment AS A, course AS C, enrolements_links AS L
        WHERE A.id = L.assignment_id AND C.id = L.course_id";

/*$sql = "SELECT A.student_id, A.target_date, A.name, A.is_done,C.name AS course_name, C.category, C.credits, L.grade
        FROM assignment AS A
        INNER JOIN enrolements_links AS L ON A.id = L.assignment_id
        INNER JOIN course AS C ON C.id = L.course_id"; */

$results = $conn->query($sql);

if($results->num_rows > 0){
    while($row = $results->fetch_assoc()){
        if ($row["is_done"] == 1){
            $is_done = "YES";
        } else {
            $is_done = "NO";
        }
        echo "Student_id: " . $row["student_id"] . " Due date: " . $row["target_date"] . " Name: " . $row["name"] . " Course: ". $row["course_name"] . " Submitted: " .$is_done . " Category: ". $row["category"] . " Credits: ".$row["credits"]. " Grade: ". $row["grade"] . "<br><br>";
    }
} else {
    echo "No data available";
}

?>