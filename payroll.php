<?php
   #Copyright (C) 2013 Jeremy Johnson
   
   include_once("globvar.php");
   
   $title = "Payroll";
   
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
      if($stmt->prepare("SELECT id, first_name, last_name, pay_rate, hours_worked, pay_rate * hours_worked AS amount_due FROM employees e JOIN( SELECT employee, SUM(end_time - start_time) / 3600 AS hours_worked FROM timecard GROUP BY employee ) t1 ON t1.employee = e.id ORDER BY last_name, first_name")){
         $stmt->execute();
         $stmt->bind_result($out_id, $out_first_name, $out_last_name, $out_pay_rate, $out_hours_worked, $out_amount_due);
         while($stmt->fetch()){
            $employees[] = array(
               'id' => htmlspecialchars($out_id),
               'first_name' => htmlspecialchars($out_first_name),
               'last_name' => htmlspecialchars($out_last_name),
               'pay_rate' => htmlspecialchars($out_pay_rate),
               'hours_worked' => floatval($out_hours_worked),
               'amount_due' => floatval($out_amount_due)
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
                        <th width="320" align="left">Employee</th>
                        <th width="64" align="right">Pay Rate</th>
                        <th width="64" align="right">Hours Worked</th>
                        <th width="64" align="right">Amount Due</th>
                     </tr>
<?php
      foreach($employees as $e){
         echo "                     <tr>\n";
         echo "                        <td align=\"left\">" . $e['id'] . "</td>\n";
         echo "                        <td align=\"left\">" . strtoupper(substr($e['last_name'], 0, 1)) . substr($e['last_name'], 1)
            . ", " . strtoupper(substr($e['first_name'], 0, 1)) . substr($e['first_name'], 1) . "</td>\n";
         echo "                        <td align=\"right\">\$" . $e['pay_rate'] . "</td>\n";
         echo "                        <td align=\"right\">" . $e['hours_worked'] . "</td>\n";
         echo "                        <td align=\"right\">\$" . number_format($e['amount_due'], 2) . "</td>\n";
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
