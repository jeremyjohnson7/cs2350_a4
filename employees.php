<?php
   #Copyright (C) 2013 Jeremy Johnson
   
   include_once("globvar.php");
   
   $title = "Employees";
   
   //Database connection
   $db_error = false;
   $mysqli = new mysqli($db_host, $db_username, $db_password, $database);
   if($mysqli->connect_error){
      //die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
      $db_error = true;
   }else{
      //Get a list of users
      $employees = array();
      $stmt = $mysqli->stmt_init();
      if($stmt->prepare("SELECT id, first_name, last_name, title, email, pay_rate FROM employees ORDER BY last_name, first_name")){
         $stmt->execute();
         $stmt->bind_result($out_id, $out_first_name, $out_last_name, $out_title, $out_email, $out_pay_rate);
         while($stmt->fetch()){
            $employees[] = array(
               'id' => htmlspecialchars($out_id),
               'first_name' => htmlspecialchars($out_first_name),
               'last_name' => htmlspecialchars($out_last_name),
               'title' => htmlspecialchars($out_title),
               'email' => htmlspecialchars($out_email),
               'pay_rate' => htmlspecialchars($out_pay_rate)
            );
         }
      }
      $stmt->close();
      
      //Terminate db connection
      $mysqli->close();
   }
   
   //Start of output
   include_once("doctype.php");
?>
   <head>
      <title><?php echo $title; ?></title>
      <link rel="stylesheet" type="text/css" href="<?php echo $stylesheet; ?>" />
      <meta http-equiv="content-type" content="text/html; charset=<?php echo $charset; ?>" />
   </head>
   
   <body>
      <table id="container" width="100%" border="0" cellspacing="0">
         <?php include_once("header.php"); ?>
         
         <tr id="main">
            <td id="content" colspan="3">
<?php
   $authorized = true;
   foreach($user_links as $ln){
      if($ln[0] == $title && !$logged_in)
         $authorized = false;
   }
   
   if(!$authorized){
?>
               <div class="contentbox">
                  <h1>Unauthorized</h1>
                  <p>You must be logged in to view this page.</p>
               </div>
<?php
   }else{
?>
               <div class="contentbox">
                  <h1><?php echo $title; ?></h1>
                  <table border="1" cellspacing="0">
                     <tr>
                        <th width="32" align="left">ID</th>
                        <th width="320" align="left">Name</th>
                        <th width="128" align="left">Title</th>
                        <th width="192" align="left">E-mail</th>
                        <th width="64" align="right">Pay Rate</th>
                     </tr>
<?php
      foreach($employees as $e){
         echo "                     <tr>\n";
         echo "                        <td align=\"left\">" . $e['id'] . "</td>\n";
         echo "                        <td align=\"left\">" . strtoupper(substr($e['last_name'], 0, 1)) . substr($e['last_name'], 1)
            . ", " . strtoupper(substr($e['first_name'], 0, 1)) . substr($e['first_name'], 1) . "</td>\n";
         //echo "                        <td align=\"left\">" . strtoupper(substr($e['first_name'], 0, 1)) . substr($e['first_name'], 1) . "</td>\n";
         //echo "                        <td align=\"left\">" . strtoupper(substr($e['last_name'], 0, 1)) . substr($e['last_name'], 1) . "</td>\n";
         echo "                        <td align=\"left\">" . strtoupper(substr($e['title'], 0, 1)) . substr($e['title'], 1) . "</td>\n";
         echo "                        <td align=\"left\">" . strtolower($e['email']) . "</td>\n";
         echo "                        <td align=\"right\">\$" . $e['pay_rate'] . "</td>\n";
         echo "                     </tr>\n";
      }
?>
                  </table>
               </div>
<?php
   }
?>
            </td>
         </tr>
         
         <?php include_once("footer.php"); ?>
      </table>
   </body>
</html>
