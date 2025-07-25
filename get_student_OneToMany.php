<?php 
//connect to database and return information with a specific ID:

//database connection:

$username = "root";
$password = "root";
$hostname = "localhost";
$database = "dbmgt";
$port = 8889;

$conn = mysqli_init();
$success = mysqli_real_connect(
    $conn,
    $hostname,
    $username,
    $password,
    $database,
    $port
);

if ($conn->connect_error) {
    echo "Connection Error: " . $conn->connect_error;
} else {
    echo "Connection to databse dbmgt successful" . "<br><br>";
}

// Get POSTed id: 
$id = $_POST["name_id"];
//sql query:
$sql = "SELECT *
        FROM students AS S
        INNER JOIN assignment AS A
        ON S.id = A.student_id
        WHERE S.id = ?";

//Prepare statement, bind parameters, execute. and return results
$prepared_statement = $conn->prepare($sql);
$prepared_statement->bind_param("i", $id);
$prepared_statement->execute();
$results = $prepared_statement->get_result();

//return results:
if ($results->num_rows > 0) {
    while($row = $results->fetch_assoc()) {
        echo "Id: " . $row["student_id"] . " Email: " . $row["email"] . "<br>" . " Assignment type: " . $row["name"] . " Assignment submission: " . $submissionStatus . " Submission date: " . $row["target_date"] . "<br><br>";
    }
} else {
        echo "No data available for student Id: " . $id;
    }

?>