<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "database_connection.php";

$email = $_POST["name_email"];
$password = $_POST["name_password"];
$id = $_POST["name_id"];

// Use begin_transaction, commit, and rollback with try/catch
//to ensure updates are saved only if all commands succeed or rollback any changes if an error occurs:

    try{

        //Begin transaction:
        $conn->begin_transaction();

        //SQL to update password and email with student id from assignment table by joining students and assignment table 
        $sql ="UPDATE students AS S
                INNER JOIN assignment AS A
                ON S.id = A.student_id
                SET S.email = ?, S.password = ?
                WHERE student_id = ?" ;

        //prepared statement, binding parameters and execution:

        $prepared_statement_1 = $conn->prepare($sql);
        $prepared_statement_1->bind_param("ssi",$email,$password,$id);
        if ($prepared_statement_1->execute()){
            echo "Credentials Updated successfully: " . $email . ", " . $password . "<br>";
        } else {
            echo "Credentials not updated: " . $conn->error . "<br>";
        }
        //close prepared statemnent_1:
        $prepared_statement_1->close();

        // Select new inserted information and dispaly them:

        $sql_2 = "SELECT S.email, S.password, A.student_id
                    FROM students AS S
                    INNER JOIN assignment AS A
                    ON S.id = A.student_id
                    WHERE A.student_id = ?";

        $prepared_statement_2 = $conn->prepare($sql_2);
        $prepared_statement_2->bind_param("i", $id);
        $prepared_statement_2->execute();

        $results = $prepared_statement_2->get_result();
        if($results->num_rows>0){
            $row = $results->fetch_assoc();
            echo " Updated data for id: " . $row["student_id"] ."<br>"
                     . "email: " . $row["email"] . "<br>"
                    . "password: " . $row["password"]. "<br><br>"; 
        } else {
            echo "No data available" . "<br>";
        }

        //Close prepared_statement_2:
        $prepared_statement_2->close();

        //Commit changes:
        $conn->commit();
        echo "Transaction commited successfully";
    
    } catch (Exception $e){
        //rollback to cancel any changes that occured during failed transaction:
        $conn->rollback(); 
        echo "Transaction failed: " . $e->getMessage();
    }

    //Close connection: 
        $conn->close();
?>