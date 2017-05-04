<?php
   #Copyright (C) 2013 Jeremy Johnson
   
   include_once("globvar.php");
   
   $title = "Users";
   
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
      if($stmt->prepare("SELECT DISTINCT id, username, `group` FROM users ORDER BY username")){
         $stmt->execute();
         $stmt->bind_result($out_id, $out_username, $out_group);
         while($stmt->fetch()){
            $users[] = array(
               'id' => htmlspecialchars($out_id),
               'username' => htmlspecialchars($out_username),
               'group' => htmlspecialchars($out_group)
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
                        <th width="320" align="left">Username</th>
                        <th width="128" align="left">Group</th>
                     </tr>
<?php
      foreach($users as $u){
         echo "                     <tr>\n";
         echo "                        <td align=\"left\">" . $u['id'] . "</td>\n";
         echo "                        <td align=\"left\">" . strtoupper(substr($u['username'], 0, 1)) . substr($u['username'], 1) . "</td>\n";
         echo "                        <td align=\"left\">" . strtoupper(substr($u['group'], 0, 1)) . substr($u['group'], 1) . "</td>\n";
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
