<?php
   #Copyright (C) 2013 Jeremy Johnson
   
   include_once("globvar.php");
   
   $title = "Statistics";
   
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
      if($stmt->prepare("SELECT DISTINCT url, COUNT(*) AS views, MAX(unix_time) AS most_recent FROM visits WHERE url IS NOT NULL GROUP BY url ORDER BY views DESC")){
         $stmt->execute();
         $stmt->bind_result($out_url, $out_views, $out_most_recent);
         while($stmt->fetch()){
            $visits[] = array(
               'url' => $out_url,
               'views' => $out_views,
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
                        <th width="320" align="left">Page</th>
                        <th width="86" align="right">Views</th>
                        <th width="200" align="left">Most Recent</th>
                     </tr>
<?php
      foreach($visits as $v){
         echo "                     <tr>\n";
         echo "                        <td align=\"left\">" . $v['url'] . "</td>\n";
         echo "                        <td align=\"right\">" . $v['views'] . "</td>\n";
         echo "                        <td align=\"left\">" . date("F j, Y; g:i A", (int)$v['most_recent']) . "</td>\n";
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
