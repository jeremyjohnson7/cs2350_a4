<?php
   #Copyright (C) 2013 Jeremy Johnson
   
   include_once("globvar.php");
   
   $title = "Menu";
   
   //Database connection
   $db_error = false;
   $mysqli = new mysqli($db_host, $db_username, $db_password, $database);
   if($mysqli->connect_error){
      //die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
      $db_error = true;
   }else{
      //Get a list of categories
      $categories = array();
      $stmt = $mysqli->stmt_init();
      if($stmt->prepare("SELECT DISTINCT category FROM menu ORDER BY category")){
         $stmt->execute();
         $stmt->bind_result($out_category);
         while($stmt->fetch()){
            $categories[] = htmlspecialchars($out_category);
            //echo "<p>" . $out_category  . "</p>\n";
         }
      }
      //$stmt->close();
      
      //Get a list of the items in each category
      $items = array();
      foreach($categories as $cat){
         $items[$cat];
         $stmt = $mysqli->stmt_init();
         if($stmt->prepare("SELECT id, description, price FROM menu WHERE UPPER(category) = ? ORDER BY description")){
            $stmt->bind_param("s", strtoupper($cat));
            $stmt->execute();
            $stmt->bind_result($out_id, $out_description, $out_price);
            while($stmt->fetch()){
               $items[$cat][] = array(
                  'id' => htmlspecialchars($out_id),
                  'description' => htmlspecialchars($out_description),
                  'price' => htmlspecialchars($out_price)
               );
               //echo "<p>" . $out_description . " (" . $out_price . ")" . "</p>\n";
            }
         }
         $stmt->close();
      }
      
      //Terminate db connection
      $mysqli->close();
   }
   
   if($logged_in){
      if($mode_set = isset($_GET["mode"]))
         $mode = strtolower($_GET["mode"]);
      else
         $mode = "view";
      
      if($mode_set){
         switch($mode){
            case 'add':
               if(isset($_POST['add_category']) && isset($_POST['add_description']) && isset($_POST['add_price'])){
                  $add_category = $_POST['add_category'];
                  $add_description = $_POST['add_description'];
                  $add_price = floatval($_POST['add_price']);
                  
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
                     if($stmt->prepare("INSERT INTO menu(category, description, price) VALUES(?, ?, ?)")){
                        $stmt->bind_param("sss", $add_category, $add_description, $add_price);
                        $stmt->execute();
                     }
                     $stmt->close();
                     
                     //Terminate db connection
                     $mysqli->close();
                  }
                  
                  header("HTTP/1.1 303 See Other");
                  header("Location: $url");
               }
               break;
               
            case 'rm':
               if(isset($_POST['rm_item'])){
                  $rm_item = (int)$_POST['rm_item'];
                  
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
                     if($stmt->prepare("DELETE FROM menu WHERE id = ?")){
                        $stmt->bind_param("s", $rm_item);
                        $stmt->execute();
                     }
                     $stmt->close();
                     
                     //Terminate db connection
                     $mysqli->close();
                  }
                  
                  header("HTTP/1.1 303 See Other");
                  header("Location: $url");
               }
               break;
               
            case 'edit':
               if(isset($_POST['edit_item']) && isset($_POST['edit_price'])){
                  $edit_item = (int)$_POST['edit_item'];
                  $edit_price = floatval($_POST['edit_price']);
                  
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
                     if($stmt->prepare("UPDATE menu SET price = ? WHERE id = ?")){
                        $stmt->bind_param("ss", $edit_price, $edit_item);
                        $stmt->execute();
                     }
                     $stmt->close();
                     
                     //Terminate db connection
                     $mysqli->close();
                  }
                  
                  header("HTTP/1.1 303 See Other");
                  header("Location: $url");
               }
               break;
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
   switch($mode){
      case 'add':
         echo "      \n";
?>
      <script type="text/javascript">
         function validateForm(){
            var msg = "";
            var valid = false;
            
            if(!new RegExp("^.+$").test(document.getElementById("category").value))
               msg = "Please select a category";
            else if(!new RegExp("^.+$").test(document.getElementById("description").value))
               msg = "Please enter a description";
            else if(!new RegExp("^(?:[0-9]{1,8}|(?:[0-9]{0,8}\\.[0-9]{1,2}?))$").test(document.getElementById("price").value))
               msg = "Invalid price";
            else
               valid = true;
            
            if(valid){
               document.getElementById("message").innerHTML = msg;
               document.getElementById("message").hidden = "hidden";
            }else{
               document.getElementById("message").innerHTML = "<span style=\"color: red;\">" + msg + "</span>";
               document.getElementById("message").hidden = "";
            }
            
            return valid;
         }
      </script>
<?php
      break;
      
      case 'rm':
         echo "      \n";
?>
      <script type="text/javascript">
         function validateForm(){
            var msg = "";
            var valid = false;
            
            if(!new RegExp("^[0-9]+$").test(document.getElementById("item").value))
               msg = "Please select an item";
            else
               valid = true;
            
            if(valid){
               document.getElementById("message").innerHTML = msg;
               document.getElementById("message").hidden = "hidden";
            }else{
               document.getElementById("message").innerHTML = "<span style=\"color: red;\">" + msg + "</span>";
               document.getElementById("message").hidden = "";
            }
            
            return valid;
         }
      </script>
<?php
      break;
      
      case 'edit':
         echo "      \n";
?>
      <script type="text/javascript">
         function validateForm(){
            var msg = "";
            var valid = false;
            
            if(!new RegExp("^[0-9]+$").test(document.getElementById("item").value))
               msg = "Please select an item";
            else if(!new RegExp("^(?:[0-9]{1,8}|(?:[0-9]{0,8}\\.[0-9]{1,2}?))$").test(document.getElementById("price").value))
               msg = "Invalid price";
            else
               valid = true;
            
            if(valid){
               document.getElementById("message").innerHTML = msg;
               document.getElementById("message").hidden = "hidden";
            }else{
               document.getElementById("message").innerHTML = "<span style=\"color: red;\">" + msg + "</span>";
               document.getElementById("message").hidden = "";
            }
            
            return valid;
         }
      </script>
<?php
      break;
   }
?>
   </head>
   
   <body>
      <table id="container" width="100%" border="0" cellspacing="0">
         <?php include_once("header.php"); ?>
         
         <tr id="main">
            <td id="content" colspan="3">
               <div class="contentbox">
                  <h1><?php echo $title; ?></h1>
<?php
   //List keys
   /*print_r(array_keys($categories));
   foreach($categories as $key => $value){
      print_r(array_keys($categories[$key]));
   }*/
   
   //List categories
   //var_dump($categories);
   /*echo "<pre>";
   var_dump($items);
   echo "</pre>\n";*/
   
   if($logged_in){
?>
                  <p><a href="./menu.php">View</a>&nbsp;&nbsp;&nbsp;<a href="./menu.php?mode=add">Add</a>&nbsp;&nbsp;&nbsp;<a href="./menu.php?mode=edit">Edit</a>&nbsp;&nbsp;&nbsp;<a href="./menu.php?mode=rm">Remove</a></p><hr />
<?php
      if($mode_set = isset($_GET["mode"]))
         $mode = strtolower($_GET["mode"]);
      else
         $mode = "view";
      
      if($mode_set){
         switch($mode){
            case 'add':
?>
                  <h2>Add</h2>
                  <p id="message" hidden="hidden">Invalid input</p>
                  <form method="post" onsubmit="return validateForm();">
                     <table class="formbox">
                        <tr>
                           <td>Category:&nbsp;</td>
                           <td>
                              <select id="category" name="add_category" tabindex="1">
                                 <option selected="selected" disabled="disabled" style="display:none;" value="">Select category</option>
<?php
               foreach($categories as $cat)
                  echo "                                 <option value=\"" . $cat . "\">" . $cat . "</option>\n";
?>
                              </select>
                           </td>
                        </tr>
                        
                        <tr>
                           <td>Description:&nbsp;</td>
                           <td><input type="text" id="description" name="add_description" size="54" tabindex="2" /></td>
                        </tr>
                        
                        <tr>
                           <td>Price:&nbsp;</td>
                           <td><input type="text" id="price" name="add_price" size="54" tabindex="3" /></td>
                        </tr>
                        
                        <tr>
                           <td colspan="2" style="text-align: center;">
                              <input type="submit" style="padding: 0.15em;" name="login" value=" Submit " tabindex="4" /></td>
                        </tr>
                     </table>
                  </form>
                  <hr /><br />
<?php
               break;
               
            case 'rm':
?>
                  <h2>Remove</h2>
                  <p id="message" hidden="hidden">Invalid input</p>
                  <form method="post" onsubmit="return validateForm();">
                     <table class="formbox">
                        <tr>
                           <td>Item:&nbsp;</td>
                           <td>
                              <select id="item" name="rm_item" tabindex="1">
                                 <option selected="selected" disabled="disabled" style="display:none;" value="">Select item</option>
<?php
               foreach($categories as $cat){
                  foreach($items[$cat] as $item)
                     echo "                                 <option value=\"" . $item['id'] . "\">" . $cat . ": " . $item['description'] . "</option>\n";
               }
?>
                              </select>
                           </td>
                        </tr>
                        
                        <tr>
                           <td colspan="2" style="text-align: center;">
                              <input type="submit" style="padding: 0.15em;" name="login" value=" Submit " tabindex="2" /></td>
                        </tr>
                     </table>
                  </form>
                  <hr /><br />
<?php
               break;
               
            case 'edit':
?>
                  <h2>Edit</h2>
                  <p id="message" hidden="hidden">Invalid input</p>
                  <form method="post" onsubmit="return validateForm();">
                     <table class="formbox">
                        <tr>
                           <td>Item:&nbsp;</td>
                           <td>
                              <select id="item" name="edit_item" tabindex="1">
                                 <option selected="selected" disabled="disabled" style="display:none;" value="">Select item</option>
<?php
               foreach($categories as $cat){
                  foreach($items[$cat] as $item)
                     echo "                                 <option value=\"" . $item['id'] . "\">" . $cat . ": " . $item['description'] . "</option>\n";
               }
?>
                              </select>
                           </td>
                        </tr>
                        
                        <tr>
                           <td>Price:&nbsp;</td>
                           <td><input type="text" id="price" name="edit_price" size="54" tabindex="2" /></td>
                        </tr>
                        
                        <tr>
                           <td colspan="2" style="text-align: center;">
                              <input type="submit" style="padding: 0.15em;" name="login" value=" Submit " tabindex="3" /></td>
                        </tr>
                     </table>
                  </form>
                  <hr /><br />
<?php
               break;
         }
      }
   }
   
   foreach($categories as $cat){
      echo "                  <h2>" . $cat . "</h2>\n";
      echo "                  <table border=\"1\" cellspacing=\"0\">\n";
      
      echo "                     <tr>\n";
      /*if($logged_in){
         echo "                        <th width=\"32\" align=\"left\">No.</th>\n";
      }*/
      echo "                        <th width=\"320\" align=\"left\">Description</th>\n";
      echo "                        <th width=\"48\" align=\"right\">Price</th>\n";
      echo "                     </tr>\n";
      
      foreach($items[$cat] as $item){
         echo "                     <tr>\n";
         /*if($logged_in){
            echo "                        <td align=\"left\">" . $item['id'] . "</td>\n";
         }*/
         echo "                        <td align=\"left\">" . $item['description'] . "</td>\n";
         echo "                        <td align=\"right\">\$" . $item['price'] . "</td>\n";
         echo "                     </tr>\n";
      }
      
      echo "                  </table><br />\n";
   }
?>
               </div>
            </td>
         </tr>
         
         <?php include_once("footer.php"); ?>
      </table>
   </body>
</html>
