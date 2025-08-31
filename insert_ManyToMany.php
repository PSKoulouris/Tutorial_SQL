<?php 
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);


include "database_connection.php";

//Field submissions:

$course_category = $_POST["name_course_category"];
$course_credits = $_POST["name_course_credits"];
$course_name = $_POST["name_course_name"];
$assignment_is_done = $_POST["name_assignment_is_done"];
$assignment_name = $_POST["name_assignment_name"];
$assignment_date = $_POST["name_assignemnt_date"];




?>