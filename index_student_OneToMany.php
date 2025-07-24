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










?>