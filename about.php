<?php
   #Copyright (C) 2013 Jeremy Johnson
   
   include_once("globvar.php");
   
   $title = "About";
   
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
               <div class="contentbox">
                  <h1><?php echo $title; ?></h1>
                  <p>Established  by Robert Scott in 1911, <?php echo $company_name; ?> is situated near the top of Mt. Erebus on ross island.</p>
                  <center><img src="http://upload.wikimedia.org/wikipedia/commons/3/3d/Scotts_Hut_Antarctica.jpg" alt="Scott's Hut" title="Scott's Hut" width="998" /></center>
                  <br />
                  
                  <h2>Our Staff</h2>
<?php
      foreach($employees as $e)
         echo "                  <p>" . $e['first_name'] . " " . $e['last_name'] . " (" . $e['title'] . ")</p>\n";
?>
               </div>
            </td>
         </tr>
         
         <?php include_once("footer.php"); ?>
      </table>
   </body>
</html>
