<?php
   #Copyright (C) 2013 Jeremy Johnson
   
   include_once("globvar.php");
   
   $title = "Visitors";
   
   //Database connection
   $db_error = false;
   $mysqli = new mysqli($db_host, $db_username, $db_password, $database);
   if($mysqli->connect_error){
      //die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
      $db_error = true;
   }else{
      //Get a list of visitors
      $visits = array();
      $stmt = $mysqli->stmt_init();
      if($stmt->prepare(
         "SELECT t1.ip_address, t2.hostname, t1.number_of_visits, t2.most_recent"
         . " FROM("
         . " SELECT ip_address, COUNT(*) AS number_of_visits"
         . " FROM visits"
         . " GROUP BY ip_address"
         . " ORDER BY ip_address"
         . " ) t1"
         . " JOIN("
         . " SELECT ip_address, hostname, MAX(unix_time) AS most_recent"
         . " FROM visits"
         . " GROUP BY ip_address, hostname"
         . " ORDER BY ip_address"
         . " ) t2"
         . " ON t1.ip_address = t2.ip_address"
         . " ORDER BY t1.number_of_visits DESC, t2.most_recent DESC, t1.ip_address"
         )
      ){
         $stmt->execute();
         $stmt->bind_result($out_ip_address, $out_hostname, $out_number_of_visits, $out_most_recent);
         while($stmt->fetch()){
            $visits[] = array(
               'ip_address' => $out_ip_address,
               'hostname' => $out_hostname,
               'number_of_visits' => $out_number_of_visits,
               'most_recent' => $out_most_recent
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
                        <th width="128" align="left">IP Address</th>
                        <th width="320" align="left">Hostname</th>
                        <th width="200" align="left">Last Seen</th>
                        <th width="86" align="right">Page Views</th>
                     </tr>
<?php
      foreach($visits as $v){
         echo "                     <tr>\n";
         echo "                        <td align=\"left\">" . $v['ip_address'] . "</td>\n";
         echo "                        <td align=\"left\">" . strtolower($v['hostname']) . "</td>\n";
         //echo "                        <td align=\"left\">" . date("j F Y, g:i A", (int)$v['most_recent']) . "</td>\n";
         echo "                        <td align=\"left\">" . date("F j, Y; g:i A", (int)$v['most_recent']) . "</td>\n";
         echo "                        <td align=\"right\">" . $v['number_of_visits'] . "</td>\n";
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
