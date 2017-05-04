<?php
   #Copyright (C) 2013 Jeremy Johnson
   
   include_once("globvar.php");
   
   $title = "Traffic";
   
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
         "SELECT mcmlxx, COUNT(ip_address) AS unique_visitors, SUM(visits) AS page_views"
         . " FROM("
         . "    SELECT FLOOR(unix_time / 86400) AS mcmlxx, ip_address, COUNT(*) AS visits"
         . "    FROM visits"
         . "    GROUP BY FLOOR(unix_time / 86400), ip_address"
         . " ) t1"
         . " GROUP BY mcmlxx"
         . " ORDER BY mcmlxx DESC"
         )
      ){
         $stmt->execute();
         $stmt->bind_result($out_mcmlxx, $out_unique_visitors, $out_page_views);
         while($stmt->fetch()){
            $visits[] = array(
               'days_since_1970' => htmlspecialchars($out_mcmlxx),
               'unique_visitors' => htmlspecialchars($out_unique_visitors),
               'page_views' => htmlspecialchars($out_page_views)
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
                        <th width="154" align="left">Day</th>
                        <th width="110" align="right">Unique Visitors</th>
                        <th width="110" align="right">Page Views</th>
                     </tr>
<?php
      foreach($visits as $v){
         echo "                     <tr>\n";
         echo "                        <td align=\"left\">" . date("F j, Y", 86400 * (int)$v['days_since_1970']) . "</td>\n";
         echo "                        <td align=\"right\">" . $v['unique_visitors'] . "</td>\n";
         echo "                        <td align=\"right\">" . $v['page_views'] . "</td>\n";
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
