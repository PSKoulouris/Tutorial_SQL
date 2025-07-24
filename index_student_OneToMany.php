<?php
  //connecto database and return results for students and assignments with one to many relationships

  //databaae connection 

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


$sql = "SELECT *
        FROM students AS A
        INNER JOIN assignment AS B
        WHERE  A.id = B.student_id";
        
$results = $conn->query($sql);

if ($results->num_rows>0) {
    while($row = $results->fetch_assoc()){

        if ($row["is_done"] == 0) {
            $submissionStatus = "Submitted";
        } else {
            $submissionStatus = "Due";
        }
        echo "Id: " . $row["id"] . " Email: " . $row["email"] . " Assignment type: " . $row["name"] . " Assignment submission: " . $submissionStatus . " Submission date: " . $row["target_date"] . "<br>";
    }
} else {
    echo "No data available";
}

$conn->close();

?>