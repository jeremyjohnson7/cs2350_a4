<?php
   include_once("globvar.php");
   
   //Database connection
   $db_error = false;
   $mysqli = new mysqli($db_host, $db_username, $db_password, $database);
   if($mysqli->connect_error){
      //die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
      $db_error = true;
   }else{
      //Get a list of users
      $users = array();
      $stmt = $mysqli->stmt_init();
      if($stmt->prepare("
      DELETE
      FROM visits
      WHERE url = '/log.php'
      ")){
         $stmt->execute();
         $stmt->close();
      }
      
      //Terminate db connection
      $mysqli->close();
   }
?>
