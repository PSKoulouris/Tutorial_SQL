<?php
  //connection to database and return results for students and assignments with one to many relationships

  //database connection 

  $user = "root";
  $password = "root";
  $db = "dbmgt";
  $host = "localhost";
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

  /*
  if ($conn->connect_error) {
    echo "Connection Error: " . $conn->connect_error;
  } else {
    echo "Successfull connection to database";
  }
*/

// SQL query and result return:
/*
$sql = "SELECT *
        FROM students AS A
        INNER JOIN assignment AS B
        ON A.id = B.student_id
        ";
*/

$sql = "SELECT *
        FROM students AS A
        INNER JOIN assignment AS B
        ON A.id = B.student_id
        WHERE A.id = 3";

$results = $conn->query($sql);

if ($results->num_rows>0) {
    while($row = $results->fetch_assoc()){

        if ($row["is_done"] == 0) {
            $submissionStatus = "Submitted";
        } else {
            $submissionStatus = "Due";
        }
        echo "Id: " . $row["student_id"] . " Email: " . $row["email"] . "<br>" . " Assignment type: " . $row["name"] . " Assignment submission: " . $submissionStatus . " Submission date: " . $row["target_date"] . "<br><br>";
    }
} else {
    echo "No data available";
}

$conn->close();

?>