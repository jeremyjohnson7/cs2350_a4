<?php
   #Copyright (C) 2013 Jeremy Johnson
   
   include_once("globvar.php");
   
   $title = "Login";
   
   //Authentication
   $failed = false;
   
   if(isset($_POST['username'])){
      if(preg_match('/[a-zA-Z0-9]/', $_POST['username']))
         $post_username = strtolower($_POST['username']);
      else
         $failed = true;
   }else{
      $failed = true;
   }
      
   if(isset($_POST['password']))
      $post_password = $_POST['password'];
   else
      $failed = true;
   
   if(!$failed){
      //Hash password
      $password_hash = md5((roman_num(strlen($post_username . roman_num(strlen($post_username) * strlen($post_username))
         . $post_password . roman_num(strlen($post_password) * strlen($post_password)))) . $post_username
         . roman_num(strlen($post_username) * strlen($post_username)) . $post_password
         . roman_num(strlen($post_password) * strlen($post_password * 3)) . strlen(roman_num(strlen($post_username
         . roman_num(strlen($post_username) * strlen($post_username)) . $post_password
         . roman_num(strlen($post_password) * strlen($post_password)))) . $post_username
         . roman_num(strlen($post_username) * strlen($post_username * 5)) . $post_password
         . roman_num(strlen($post_password) * strlen($post_password))))
         . md5(roman_num(strlen($post_username . roman_num(strlen($post_username) * strlen($post_username))
         . $post_password . roman_num(strlen($post_password) * strlen($post_password)))) . $post_username
         . roman_num(strlen($post_username) * strlen($post_username)) . $post_password
         . roman_num(strlen($post_password) * strlen($post_password)) . strlen(roman_num(strlen($post_username
         . roman_num(strlen($post_username) * strlen($post_username)) * strlen($post_username)) . $post_password
         . roman_num(strlen($post_password) * strlen($post_password * 2)))) . $post_username
         . roman_num(strlen($post_username) * strlen($post_username)) . $post_password
         . roman_num(strlen($post_password) * strlen($post_password))));
      
      //Database connection
      $db_error = false;
      $mysqli = new mysqli($db_host, $db_username, $db_password, $database);
      if($mysqli->connect_error){
         //die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
         $db_error = true;
      }else{
         //Check database
         $failed = true;
         $stmt = $mysqli->stmt_init();
         if($stmt->prepare("SELECT username, password FROM users WHERE LOWER(username) = ? AND password = ?")){
            $stmt->bind_param("ss", $post_username, $password_hash);
            $stmt->execute();
            $stmt->bind_result($out_username, $out_password);
            while($stmt->fetch()){
               if((strtolower($out_username) == $post_username) == ($out_password == $password_hash)){
                  $failed = false;
                  setcookie("logged_in", $out_username, time() + 3600);
                  header("HTTP/1.1 303 See Other");
                  header("Location: $url");
               }
            }
         }
         $stmt->close();
         $mysqli->close();
      }
   }else{
      $failed = false;
      
      if(isset($_POST['username']) || isset($_POST['password'])){
         header("HTTP/1.1 303 See Other");
         header("Location: $url");
      }
   }
   
   if($failed){
      setcookie("login_failed", $client_ip, time() + 900);
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
   if($logged_in){
?>
               <div class="contentbox">
                  <h1><?php echo $title; ?></h1>
                  <p>You have been logged in successfully.</p>
               </div>
<?php
   }else{
?>
               <div class="contentbox">
                  <h1><?php echo $title; ?></h1>
<?php
   if($failed){
      if($debug){
         echo "<p>Username: " . $post_username . "</p>\n";
         echo "<p>Password: " . $post_password . "</p>\n";
         echo "<p>Hash: " . $password_hash . "</p>\n";
      }
?>
                  <p style="color: red;">Error: Incorrect username or password.</p>
<?php
   }else{
?>
                  <p>Please enter your username and password.</p>
<?php
   }
?>
                  <form method="post">
                     <table class="formbox">
                        <tr>
                           <td>Username:&nbsp;</td>
                           <td><input type="text" name="username" size="64" tabindex="1" /></td>
                        </tr>
                        
                        <tr>
                           <td>Password:&nbsp;</td>
                           <td><input type="password" name="password" size="64" tabindex="2" /></td>
                        </tr>
                        
                        <tr>
                           <td colspan="2" style="text-align: center;"><input type="submit" style="padding: 0.15em;" name="login" value=" Submit " tabindex="3" /></td>
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
