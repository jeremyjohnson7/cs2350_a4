<?php
   #Copyright (C) 2013 Jeremy Johnson
   
   include_once("globvar.php");
   
   $title = "Feedback";
   
   //Database connection
   $db_error = false;
   $mysqli = new mysqli($db_host, $db_username, $db_password, $database);
   if($mysqli->connect_error){
      //die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
      $db_error = true;
   }else{
      //Get a list of users
      $feedback = array();
      $stmt = $mysqli->stmt_init();
      if($stmt->prepare("SELECT DISTINCT name, age, email, telephone, address, city, `state`, zip, country, food_quality, overall_qos, cleanliness, order_accuracy, timely_service, overall_value, overall_experience, comments, ip_address, hostname, unix_time FROM feedback ORDER BY unix_time DESC")){
         $stmt->execute();
         $stmt->bind_result($out_name, $out_age, $out_email, $out_phone, $out_address, $out_city, $out_state, $out_zip, $out_country, $out_food_quality, $out_overall_qos, $out_cleanliness, $out_order_accuracy, $out_timely_service, $out_overall_value, $out_overall_experience, $out_comments, $out_ip_address, $out_hostname, $out_unix_time);
         while($stmt->fetch()){
            $feedback[] = array(
               'name' => htmlspecialchars($out_name),
               'age' => htmlspecialchars($out_age),
               'email' => htmlspecialchars($out_email),
               'telephone' => htmlspecialchars($out_phone),
               'address' => htmlspecialchars($out_address),
               'city' => htmlspecialchars($out_city),
               'state' => htmlspecialchars($out_state),
               'zip' => htmlspecialchars($out_zip),
               'country' => htmlspecialchars($out_country),
               'food_quality' => htmlspecialchars($out_food_quality),
               'overall_qos' => htmlspecialchars($out_overall_qos),
               'cleanliness' => htmlspecialchars($out_cleanliness),
               'order_accuracy' => htmlspecialchars($out_order_accuracy),
               'timely_service' => htmlspecialchars($out_timely_service),
               'overall_value' => htmlspecialchars($out_overall_value),
               'overall_experience' => htmlspecialchars($out_overall_experience),
               'comments' => htmlspecialchars($out_comments),
               'ip_address' => htmlspecialchars($out_ip_address),
               'hostname' => htmlspecialchars($out_hostname),
               'unix_time' => htmlspecialchars($out_unix_time)
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
<?php
      $th_width = 128;
      $td_width = 320;
      foreach($feedback as $f){
         echo "                  <table border=\"1\" cellspacing=\"0\">\n";
         echo "                     <tr>\n";
         echo "                        <th width=\"$th_width\" align=\"left\">IP Address</th>\n";
         echo "                        <td width=\"$td_width\" align=\"left\">" . $f['ip_address'] . "</td>\n";
         echo "                     </tr>\n";
         echo "                     <tr>\n";
         echo "                        <th width=\"$th_width\" align=\"left\">Hostname</th>\n";
         echo "                        <td width=\"$td_width\" align=\"left\">" . $f['hostname'] . "</td>\n";
         echo "                     </tr>\n";
         echo "                     <tr>\n";
         echo "                        <th width=\"$th_width\" align=\"left\">Timestamp</th>\n";
         echo "                        <td width=\"$td_width\" align=\"left\">" . date("F j, Y; g:i A", (int)$f['unix_time']) . "</td>\n";
         echo "                     </tr>\n";
         echo "                     <tr>\n";
         echo "                        <th width=\"$th_width\" align=\"left\">Name</th>\n";
         echo "                        <td width=\"$td_width\" align=\"left\">" . strtoupper(substr($f['name'], 0, 1)) . substr($f['name'], 1) . "</td>\n";
         echo "                     </tr>\n";
         echo "                     <tr>\n";
         echo "                        <th width=\"$th_width\" align=\"left\">Age</th>\n";
         echo "                        <td width=\"$th_width\" align=\"left\">" . $f['age'] . "</td>\n";
         echo "                     </tr>\n";
         echo "                     <tr>\n";
         echo "                        <th width=\"$th_width\" align=\"left\">E-mail</th>\n";
         echo "                        <td width=\"$td_width\" align=\"left\">" . strtolower($f['email']) . "</td>\n";
         echo "                     </tr>\n";
         echo "                     <tr>\n";
         echo "                        <th width=\"$th_width\" align=\"left\">Telephone</th>\n";
         echo "                        <td width=\"$td_width\" align=\"left\">" . $f['telephone'] . "</td>\n";
         echo "                     </tr>\n";
         echo "                     <tr>\n";
         echo "                        <th width=\"$th_width\" align=\"left\">Address</th>\n";
         echo "                        <td width=\"$td_width\" align=\"left\">" . $f['address'] . "</td>\n";
         echo "                     </tr>\n";
         echo "                     <tr>\n";
         echo "                        <th width=\"$th_width\" align=\"left\">City</th>\n";
         echo "                        <td width=\"$td_width\" align=\"left\">" . $f['city'] . "</td>\n";
         echo "                     </tr>\n";
         echo "                     <tr>\n";
         echo "                        <th width=\"$th_width\" align=\"left\">State</th>\n";
         echo "                        <td width=\"$td_width\" align=\"left\">" . $f['state'] . "</td>\n";
         echo "                     </tr>\n";
         echo "                     <tr>\n";
         echo "                        <th width=\"$th_width\" align=\"left\">Zip</th>\n";
         echo "                        <td width=\"$td_width\" align=\"left\">" . $f['zip'] . "</td>\n";
         echo "                     </tr>\n";
         echo "                     <tr>\n";
         echo "                        <th width=\"$th_width\" align=\"left\">Country</th>\n";
         echo "                        <td width=\"$td_width\" align=\"left\">" . $f['country'] . "</td>\n";
         echo "                     </tr>\n";
         echo "                     <tr>\n";
         echo "                        <th width=\"$th_width\" align=\"left\">Food Quality</th>\n";
         echo "                        <td width=\"$td_width\" align=\"left\">" . $f['food_quality'] . "</td>\n";
         echo "                     </tr>\n";
         echo "                     <tr>\n";
         echo "                        <th width=\"$th_width\" align=\"left\">Quality of Service</th>\n";
         echo "                        <td width=\"$td_width\" align=\"left\">" . $f['overall_qos'] . "</td>\n";
         echo "                     </tr>\n";
         echo "                     <tr>\n";
         echo "                        <th width=\"$th_width\" align=\"left\">Cleanliness</th>\n";
         echo "                        <td width=\"$td_width\" align=\"left\">" . $f['cleanliness'] . "</td>\n";
         echo "                     </tr>\n";
         echo "                     <tr>\n";
         echo "                        <th width=\"$th_width\" align=\"left\">Order Accuracy</th>\n";
         echo "                        <td width=\"$td_width\" align=\"left\">" . $f['order_accuracy'] . "</td>\n";
         echo "                     </tr>\n";
         echo "                     <tr>\n";
         echo "                        <th width=\"$th_width\" align=\"left\">Timely Service</th>\n";
         echo "                        <td width=\"$td_width\" align=\"left\">" . $f['timely_service'] . "</td>\n";
         echo "                     </tr>\n";
         echo "                     <tr>\n";
         echo "                        <th width=\"$th_width\" align=\"left\">Overall Value</th>\n";
         echo "                        <td width=\"$td_width\" align=\"left\">" . $f['overall_value'] . "</td>\n";
         echo "                     </tr>\n";
         echo "                     <tr>\n";
         echo "                        <th width=\"$th_width\" align=\"left\">Overall Experience</th>\n";
         echo "                        <td width=\"$td_width\" align=\"left\">" . $f['overall_experience'] . "</td>\n";
         echo "                     </tr>\n";
         echo "                     <tr>\n";
         echo "                        <th width=\"$th_width\" align=\"left\">Comments</th>\n";
         echo "                        <td width=\"$td_width\" align=\"left\">" . $f['comments'] . "</td>\n";
         echo "                     </tr>\n";
         echo "                  </table><br />\n";
      }
?>
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
