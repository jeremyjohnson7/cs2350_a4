<?php
   #Copyright (C) 2013 Jeremy Johnson
   
   include_once("globvar.php");
   
   $title = "Time Card";
   
   $authorized = logged_in;
   
   if($authorized){
      $mysqli = null;
      
      if(isset($_POST['employee']) && isset($_POST['start']) && isset($_POST['end'])){
         $post_employee = $_POST['employee'];
         $post_start = $_POST['start'];
         $post_end = $_POST['end'];
         
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
            if($stmt->prepare("INSERT INTO timecard(employee, start_time, end_time) VALUES(?, ?, ?)")){
               $stmt->bind_param("sss", $post_employee, $post_start, $post_end);
               $stmt->execute();
            }
            $stmt->close();
            
            //Terminate db connection
            $mysqli->close();
         }
      }else{
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
      }
   }
   
   //Start of output
   include_once("doctype.php");
?>
   <head>
      <title><?php echo $title; ?></title>
      <link rel="stylesheet" type="text/css" href="<?php echo $stylesheet; ?>" />
      <meta http-equiv="content-type" content="text/html; charset=<?php echo $charset; ?>" />
<?php
   /*if($logged_in)
      echo '<meta http-equiv="refresh" content="3; url=/">';*/
?>
   </head>
   
   <body>
      <table id="container" width="100%" border="0" cellspacing="0">
         <?php include_once("header.php"); ?>
         
         <tr id="main">
            <td id="content" colspan="3">
<?php
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
                  <p>Thank you for your feedback. Please fill out the form below.</p>
                  
                  <form method="post">
                     <table class="formbox">
                        <tr>
                           <td>Name:&nbsp;</td>
                           <td>
                              <select name="employee" tabindex="1">
                                 <option selected="selected" disabled="disabled" style="display:none;" value="0">Select an employee</option>
<?php
      foreach($employees as $e)
         echo "                                 <option value=\"" . $e['id'] . "\">" . $e['last_name'] . ", " . $e['first_name'] . " (" . $e['title'] . ")</option>\n";
?>
                              </select>
                           </td>
                        </tr>
                        
                        <tr>
                           <td>Start Time (Unix time):&nbsp;</td>
                           <td><input type="text" name="start" size="32" tabindex="2" /></td>
                        </tr>
                        
                        <tr>
                           <td>End Time (Unix time):&nbsp;</td>
                           <td><input type="text" name="end" size="32" tabindex="3" /></td>
                        </tr>
                        
                        <tr>
                           <td colspan="2" style="text-align: center;">
                              <input type="submit" style="padding: 0.15em;" name="login" value=" Submit " tabindex="4" />
                           </td>
                        </tr>
                     </table>
                  </form>
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
