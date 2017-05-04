<?php
   #Copyright (C) 2013 Jeremy Johnson
   
   $company_name = 'Mt. Erebus Restaurant';
   $debug = false;
   
   $url = $_SERVER['REQUEST_URI'];
   $filename = basename($_SERVER['REQUEST_URI']);
   $request_method = $_SERVER['REQUEST_METHOD'];
   //$query = substr($url, strpos($url, '?'));
   $query = '';
   
   $charset = "UTF-8";
   $doctype = "XHTML 1.0 Transitional";
   date_default_timezone_set('UTC');
   
   $logged_in = false;
   $username = "Null";
   $group = 0;
   $client_ip = strtolower($_SERVER['REMOTE_ADDR']);
   $server_ip = strtolower($_SERVER['SERVER_ADDR']);
   
   //Detect Internet Explorer
   $user_agent = $_SERVER['HTTP_USER_AGENT'];
   $stylesheet = !(strpos($user_agent, 'Trident') !== false || strpos($user_agent, 'MSIE') !== false) ? 'styles.css' : 'styles_ie.css';
   
   //Database information
   if(strpos(strtolower(gethostbyaddr($client_ip)), 'jjj') !== false){
      $db_host = "127.0.0.1";
      $db_username = "root";
      $db_password = "";
      $database = "cs2350";
   }else{
      $db_host = "localhost";
      $db_username = "cs2350x1_dbuser";
      $db_password = "Ia44u6zMwXhnj6";
      $database = "cs2350x1_db1";
   }
   
   //Determine if a user is logged in
   if(isset($_COOKIE['logged_in']) && $_COOKIE['logged_in'] != ''){
      $logged_in = true;
      $username = strtoupper(substr($_COOKIE['logged_in'], 0, 1)) . substr($_COOKIE['logged_in'], 1);
      setcookie("logged_in", $username, time() + 3600);
   }
   
   $username = htmlspecialchars($logged_in ? $username : $client_ip);
   
   function roman_num($num){
      $str = "";
      $max = 1000000000;
      
      if($num < 1 || $num > $max)
         return $num;
      
      $places = 0;
      $place = $max;
      for($x = $place; $x > 0; $x = (int)($x / 10))
         $places++;
      
      for($x = $places; $x > 5; $x--){
         $place = (int)($place / 10);
         $left = "";
         $right = "";
         
         for($y = 0; $y < ($x - 4); $y++){
            $left .= "C";
            $right .= "&#390;";   //Apostrophus
         }
         
         switch((int)(($num % ($place * 10)) / $place)){
            case 0: break;
            case 1: $str .= $left . "I" . $right; break;
            case 2: $str .= $left . "I" . $right . $left . "I" . $right; break;
            case 3: $str .= $left . "I" . $right . $left . "I" . $right . $left . "I" . $right; break;
            case 4: $str .= $left . "I" . $right . "I&#390;" . $right; break;
            case 5: $str .= "I&#390;" . $right; break;
            case 6: $str .= "I&#390;" . $right . $left . "I" . $right; break;
            case 7: $str .= "I&#390;" . $right . $left . "I" . $right . $left . "I" . $right; break;
            case 8: $str .= "I&#390;" . $right . $left . "I" . $right . $left . "I" . $right . $left . "I" . $right; break;
            case 9: $str .= $left . "I" . $right . $left . "CI&#390;" . $right; break;
         }
      }
      
      switch((int)(($num % 10000) / 1000)){
         case 0: break;
         case 1: $str .= "M"; break;
         case 2: $str .= "MM"; break;
         case 3: $str .= "MMM"; break;
         //case 4: $str .= "MMMM"; break;
         case 4: $str .= "CI&#390;I&#390;&#390;"; break;
         case 5: $str .= "I&#390;&#390;"; break;
         case 6: $str .= "I&#390;&#390;CI&#390;"; break;
         case 7: $str .= "I&#390;&#390;CI&#390;CI&#390;"; break;
         case 8: $str .= "I&#390;&#390;CI&#390;CI&#390;CI&#390;"; break;
         case 9: $str .= "CI&#390;CCI&#390;&#390;"; break;
      }
      
      switch((int)(($num % 1000) / 100)){
         case 0: break;
         case 1: $str .= "C"; break;
         case 2: $str .= "CC"; break;
         case 3: $str .= "CCC"; break;
         case 4: $str .= "CD"; break;
         case 5: $str .= "D"; break;
         case 6: $str .= "DC"; break;
         case 7: $str .= "DCC"; break;
         case 8: $str .= "DCCC"; break;
         case 9: $str .= "CM"; break;
      }
      
      switch((int)(($num % 100) / 10)){
         case 0: break;
         case 1: $str .= "X"; break;
         case 2: $str .= "XX"; break;
         case 3: $str .= "XXX"; break;
         case 4: $str .= "XL"; break;
         case 5: $str .= "L"; break;
         case 6: $str .= "LX"; break;
         case 7: $str .= "LXX"; break;
         case 8: $str .= "LXXX"; break;
         case 9: $str .= "XC"; break;
      }
      
      switch((int)($num % 10)){
         case 0: break;
         case 1: $str .= "I"; break;
         case 2: $str .= "II"; break;
         case 3: $str .= "III"; break;
         case 4: $str .= "IV"; break;
         case 5: $str .= "V"; break;
         case 6: $str .= "VI"; break;
         case 7: $str .= "VII"; break;
         case 8: $str .= "VIII"; break;
         case 9: $str .= "IX"; break;
      }
      
      return $str;
   }
   
   //Log visits
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
      if($stmt->prepare("INSERT INTO visits(ip_address, hostname, url, unix_time) VALUES(?, ?, ?, ?)")){
         $stmt->bind_param("ssss", $client_ip, strtolower(gethostbyaddr($client_ip)), $url, time());
         $stmt->execute();
      }
      $stmt->close();
      
      //Terminate db connection
      $mysqli->close();
   }
?>
