<?php
   #Copyright (C) 2013 Jeremy Johnson
   
   $navigation_links = array(
      array("Home", "./"),
      array("Menu", "./menu.php"),
      array("Location", "./location.php"),
      array("About", "./about.php"),
      array("Contact Us", "./contact.php")
   );
   
   $user_links = array(
      array("Feedback", "./feedback.php"),
      array("Video", "./video.php"),
      array("Users", "./users.php"),
      null,
      array("Employees", "./employees.php"),
      array("Time Card", "./timecard.php"),
      array("Payroll", "./payroll.php"),
      array("Suppliers", "./suppliers.php"),
      array("Statistics", "./stats.php"),
      array("Traffic", "./traffic.php"),
      array("Visitors", "./visitors.php")
   );
   
   $login_links = array(
      array("Login", "./login.php"),
      array("Logout", "./logout.php")
   );
   
   function headlink($category_name, $category_link){
      global $title, $query;
      echo "                  <li class=\"" . (($title == $category_name) ? "navcurrent" : "navlink") . "\"><a href=\"" . $category_link . $query;
      echo "\">" . $category_name . "</a></li>\n";
   }

   //The funny indentation is to make the html output readable
       ?><tr id="header">
            <td colspan="2" nowrap="nowrap" align="left">
            <!--<td colspan="2" nowrap="nowrap" align="left" style="overflow: auto;">-->
               <ul class="navbox">
<?php
   /*foreach($navigation_links as $v)
      headlink($v[0], $v[1], $v[2]);
   
   if($logged_in){
      foreach($user_links as $v)
         headlink($v[0], $v[1], $v[2]);
   }*/
   
   foreach($navigation_links as $v)
      headlink($v[0], $v[1], $v[2]);
   
   if($logged_in){
      foreach($user_links as $v)
         if($v != null)
            headlink($v[0], $v[1], $v[2]);
         else
            echo "                  <br />\n";
   }
?>
               </ul>
            </td>
            
            <td colspan="1" nowrap="nowrap" align="right">
               <ul class="navbox">
<?php
   if($logged_in){
      echo '                  <li class="navcurrent">' . $username . "</li>\n";
      //echo '                  <li class="navcurrent">' . $client_ip . "</li>\n";
      //echo '                  <li class="navcurrent">' . $server_ip . "</li>\n";
      headlink($login_links[1][0], $login_links[1][1], $login_links[1][2]);
   }else{
      //echo '                  <li class="navcurrent">' . $client_ip . "</li>\n";
      //echo '                  <li class="navcurrent">' . $server_ip . "</li>\n";
      headlink($login_links[0][0], $login_links[0][1], $login_links[0][2]);
   }
   
   /*if($logged_in){
      echo '                  <li class="navcurrent">' . $username . " (" . $client_ip . ")</li>\n";
      headlink($login_links[1][0], $login_links[1][1], $login_links[1][2]);
   }else{
      echo '                  <li class="navcurrent">' . $client_ip . "</li>\n";
      headlink($login_links[0][0], $login_links[0][1], $login_links[0][2]);
   }*/
   
   /*if($logged_in){
      echo '                  <li class="navcurrent">' . $username . "</li>\n";
      headlink($login_links[1][0], $login_links[1][1], $login_links[1][2]);
   }else{
      headlink($login_links[0][0], $login_links[0][1], $login_links[0][2]);
   }*/
?>
               </ul>
            </td>
         </tr>
