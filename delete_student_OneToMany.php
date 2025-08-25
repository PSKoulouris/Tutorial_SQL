<?php 
//View hidden errors in PHP:
ini_set("display_errors", 1);
ini_set("display_startup_errors",1);
error_reporting(E_ALL);

//Connect to database phpMyAdmin:
include "database_connection.php";

//Define variable ID:
$id = $_POST["name_id"];

//TRANSACTION with begin_transaction, commit, and rollback for DELETE operation:
    try{
        $conn->begin_transaction();

        //sql qerry 1: DELETE from both tables without CASCADE option
        $sql_1 = "DELETE FROM students WHERE id = ?";
        //"DELETE S, A
                  //FROM students AS S
                 //INNER JOIN assignment AS A
                 //ON S.id = A.student_id
                 //WHERE S.id = ?";
        
        //Prepared statement: prepare, bind paramaters,and execute:
        $prepared_statement_1 = $conn->prepare($sql_1);
        $prepared_statement_1->bind_param("i",$id);
        
        //Conditional execution:
        if($prepared_statement_1->execute()) {
            echo "prepared statement 1 executed successfully"."<br>";
        } else {
            echo " prepared stement 1 not executed"."<br>";
        }
        //close prepared statement 1:
        $prepared_statement_1->close();


        $conn->commit();
        echo "Transaction Committed/Successful"."<br>";

    } catch (Exception $e) {
        $conn->rollback();
        echo "Transaction cancelled: " . $e->getMessage()."<br>";
    }

//close conection:
$conn->close();
?>