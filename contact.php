<?php
   #Copyright (C) 2013 Jeremy Johnson
   
   include_once("globvar.php");
   
   $title = "Contact Us";
   
   $submitted = isset($_POST['name']) && isset($_POST['age']) && isset($_POST['email'])
      && isset($_POST['phone']) && isset($_POST['address']) && isset($_POST['city'])
      && isset($_POST['state']) && isset($_POST['zip']) && isset($_POST['country'])
      && isset($_POST['food_quality']) && isset($_POST['overall_qos']) && isset($_POST['cleanliness'])
      && isset($_POST['order_accuracy']) && isset($_POST['timely_service'])
      && isset($_POST['overall_value']) && isset($_POST['overall_experience']);
      
   if($submitted){
      $post_name = $_POST['name'];
      $post_age = $_POST['age'];
      $post_email = $_POST['email'];
      $post_phone = $_POST['phone'];
      $post_address = $_POST['address'];
      $post_city = $_POST['city'];
      $post_state = $_POST['state'];
      $post_zip = $_POST['zip'];
      $post_country = $_POST['country'];
      $post_food_quality = $_POST['food_quality'];
      $post_overall_qos = $_POST['overall_qos'];
      $post_cleanliness = $_POST['cleanliness'];
      $post_order_accuracy = $_POST['order_accuracy'];
      $post_timely_service = $_POST['timely_service'];
      $post_overall_value = $_POST['overall_value'];
      $post_overall_experience = $_POST['overall_experience'];
      $post_comments = $_POST['comments'];
   
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
         if($stmt->prepare("INSERT INTO feedback(name, age, email, telephone, address, city, `state`, zip, country, food_quality, overall_qos, cleanliness, order_accuracy, timely_service, overall_value, overall_experience, comments, ip_address, hostname, unix_time) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")){
            $stmt->bind_param("ssssssssssssssssssss", $post_name, $post_age, $post_email, $post_phone, $post_address, $post_city, $post_state, $post_zip, $post_country, $post_food_quality, $post_overall_qos, $post_cleanliness, $post_order_accuracy, $post_timely_service, $post_overall_value, $post_overall_experience, $post_comments, $client_ip, strtolower(gethostbyaddr($client_ip)), time());
            $stmt->execute();
         }
         $stmt->close();
         
         //Terminate db connection
         $mysqli->close();
      }
   }
   
   //Start of output
   include_once("doctype.php");
?>
   <head>
      <title><?php echo $title; ?></title>
      <link rel="stylesheet" type="text/css" href="<?php echo $stylesheet; ?>" />
      <meta http-equiv="content-type" content="text/html; charset=<?php echo $charset; ?>" />
      
      <script type="text/javascript">
         function validateForm(){
            var msg = "Thank you for your feedback. Please fill out the form below.";
            var valid = false;
            
            if(!new RegExp("^[a-zA-Z\\ \\'\\-]+$").test(document.getElementById("name").value))
               msg = "Name may contain only letters, spaces, hyphens, and apostrophes";
            else if(!new RegExp("^[0-9]+$").test(document.getElementById("age").value))
               msg = "Age must be a number";
            else if(!new RegExp("^[a-z0-9\\._\\-\\+]+@[a-z0-9\\.\\-]+\\.(?:ac|ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|asia|at|au|aw|ax|az|ba|bb|bd|be|bf|bg|bh|bi|bike|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|camera|cat|cc|cd|cf|cg|ch|ci|ck|cl|clothing|cm|cn|co|com|construction|contractors|coop|cr|cu|cv|cw|cx|cy|cz|de|diamonds|directory|dj|dk|dm|do|dz|ec|edu|ee|eg|enterprises|equipment|er|es|estate|et|eu|fi|fj|fk|fm|fo|fr|ga|gallery|gb|gd|ge|gf|gg|gh|gi|gl|gm|gn|gov|gp|gq|gr|graphics|gs|gt|gu|guru|gw|gy|hk|hm|hn|holdings|hr|ht|hu|id|ie|il|im|in|info|int|io|iq|ir|is|it|je|jm|jo|jobs|jp|ke|kg|kh|ki|kitchen|km|kn|kp|kr|kw|ky|kz|la|land|lb|lc|li|lighting|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|me|mg|mh|mil|mk|ml|mm|mn|mo|mobi|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nu|nz|om|org|pa|pe|pf|pg|ph|photography|pk|pl|plumbing|pm|pn|post|pr|pro|ps|pt|pw|py|qa|re|ro|rs|ru|rw|sa|sb|sc|sd|se|sexy|sg|sh|si|singles|sj|sk|sl|sm|sn|so|sr|st|su|sv|sx|sy|sz|tattoo|tc|td|technology|tel|tf|tg|th|tips|tj|tk|tl|tm|tn|to|today|tp|tr|travel|tt|tv|tw|tz|ua|ug|uk|us|uy|uz|va|vc|ve|ventures|vg|vi|vn|voyage|vu|wf|ws|xn--3e0b707e|xn--45brj9c|xn--80ao21a|xn--80asehdb|xn--80aswg|xn--90a3ac|xn--clchc0ea0b2g2a9gcd|xn--fiqs8s|xn--fiqz9s|xn--fpcrj9c3d|xn--fzc2c9e2c|xn--gecrj9c|xn--h2brj9c|xn--j1amh|xn--j6w193g|xn--kprw13d|xn--kpry57d|xn--l1acc|xn--lgbbat1ad8j|xn--mgb9awbf|xn--mgba3a4f16a|xn--mgbaam7a8h|xn--mgbayh7gpa|xn--mgbbh1a71e|xn--mgbc0a9azcg|xn--mgberp4a5d4ar|xn--mgbx4cd0ab|xn--ngbc5azd|xn--o3cw4h|xn--ogbpf8fl|xn--p1ai|xn--pgbs0dh|xn--q9jyb4c|xn--s9brj9c|xn--unup4y|xn--wgbh1c|xn--wgbl6a|xn--xkc2al3hye2a|xn--xkc2dl3a5ee0h|xn--yfro4i67o|xn--ygbi2ammx|xxx|ye|yt|za|zm|zw)$").test((document.getElementById("email").value).toLowerCase()))
               msg = "Invalid e-mail address";
            else if(!new RegExp("^[0-9]{3}([-.\\ ]?)[0-9]{3}\\1[0-9]{4}$").test(document.getElementById("phone").value))
               msg = "Invalid telephone number&mdash;use ten digit format, e.g. 123-456-7890";
            else if(!new RegExp("^.+$").test(document.getElementById("address").value))
               msg = "Please enter an address";
            else if(!new RegExp("^[a-zA-Z\\ \\'\\-]+$").test(document.getElementById("city").value))
               msg = "City may contain only letters, spaces, hyphens, and apostrophes";
            else if(!new RegExp("^[a-zA-Z\\ \\'\\-]+$").test(document.getElementById("state").value))
               msg = "State/province/region may contain only letters, spaces, and hyphens";
            else if(!new RegExp("^[0-9]{5}(?:\\-[0-9]{4})?$").test(document.getElementById("zip").value))
               msg = "Invalid zipcode";
            else if(!new RegExp("^[a-zA-Z\\ \\-]+$").test(document.getElementById("country").value))
               msg = "Country name may contain only letters, spaces, and hyphens";
            else if(!new RegExp("^[1-5]$").test(document.getElementById("food_quality").value))
               msg = "Please rate the food quality";
            else if(!new RegExp("^[1-5]$").test(document.getElementById("overall_qos").value))
               msg = "Please rate the quality of service";
            else if(!new RegExp("^[1-5]$").test(document.getElementById("cleanliness").value))
               msg = "Please rate the cleanliness of the restaurant";
            else if(!new RegExp("^[1-5]$").test(document.getElementById("order_accuracy").value))
               msg = "Please rate how accurately your order was filled";
            else if(!new RegExp("^[1-5]$").test(document.getElementById("timely_service").value))
               msg = "Please rate how timely the service was";
            else if(!new RegExp("^[1-5]$").test(document.getElementById("overall_value").value))
               msg = "Please rate the overall value";
            else if(!new RegExp("^[1-5]$").test(document.getElementById("overall_experience").value))
               msg = "Please rate your overall experience";
            else
               valid = true;
            
            if(valid)
               document.getElementById("message").innerHTML = msg;
            else
               document.getElementById("message").innerHTML = "<span style=\"color: red;\">" + msg + "</span>";
            
            return valid;
         }
      </script>
   </head>
   
   <body>
      <table id="container" width="100%" border="0" cellspacing="0">
         <?php include_once("header.php"); ?>
         
         <tr id="main">
            <td id="content" colspan="3">
<?php
   if($submitted){
?>
               <div class="contentbox">
                  <h1><?php echo $title; ?></h1>
                  <p>The form has been submitted successfully. Thank you for your feedback.</p>
               </div>
<?php
   }else{
?>
               <div class="contentbox">
                  <h1><?php echo $title; ?></h1>
                  <p id="message">Thank you for your feedback. Please fill out the form below.</p>
                  
                  <form method="post" action="<?php echo "$url"; ?>" onsubmit="return validateForm();">
                     <table class="formbox">
                        <tr>
                           <td>Name:&nbsp;</td>
                           <td><input type="text" id="name" name="name" size="64" tabindex="1" /></td>
                        </tr>
                        
                        <tr>
                           <td>Age:&nbsp;</td>
                           <td><input type="text" id="age" name="age" size="64" tabindex="2" /></td>
                        </tr>
                        
                        <tr>
                           <td>E-mail:&nbsp;</td>
                           <td><input type="text" id="email" name="email" size="64" tabindex="3" /></td>
                        </tr>
                        
                        <tr>
                           <td>Telephone:&nbsp;</td>
                           <td><input type="text" id="phone" name="phone" size="64" tabindex="4" /></td>
                        </tr>
                        
                        <tr>
                           <td>Address:&nbsp;</td>
                           <td><input type="text" id="address" name="address" size="64" tabindex="5" /></td>
                        </tr>
                        
                        <tr>
                           <td>City:&nbsp;</td>
                           <td><input type="text" id="city" name="city" size="64" tabindex="6" /></td>
                        </tr>
                        
                        <tr>
                           <td>State/Province/Region:&nbsp;</td>
                           <td><input type="text" id="state" name="state" size="64" tabindex="7" /></td>
                        </tr>
                        
                        <tr>
                           <td>Zip:&nbsp;</td>
                           <td><input type="text" id="zip" name="zip" size="64" tabindex="8" /></td>
                        </tr>
                        
                        <tr>
                           <td>Country:&nbsp;</td>
                           <td><input type="text" id="country" name="country" size="64" tabindex="9" /></td>
                        </tr>
                        
                        <tr>
                           <td>Food Quality:&nbsp;</td>
                           <td>
                              <select id="food_quality" name="food_quality" tabindex="10">
                                 <option selected="selected" disabled="disabled" style="display:none;" value="0">Select an option</option>
                                 <option value="5">Excellent</option>
                                 <option value="4">Good</option>
                                 <option value="3">Acceptable</option>
                                 <option value="2">Poor</option>
                                 <option value="1">Terrible</option>
                              </select>
                           </td>
                        </tr>
                        
                        <tr>
                           <td>Quality of Service:&nbsp;</td>
                           <td>
                              <select id="overall_qos" name="overall_qos" tabindex="11">
                                 <option selected="selected" disabled="disabled" style="display:none;" value="0">Select an option</option>
                                 <option value="5">Excellent</option>
                                 <option value="4">Good</option>
                                 <option value="3">Acceptable</option>
                                 <option value="2">Poor</option>
                                 <option value="1">Terrible</option>
                              </select>
                           </td>
                        </tr>
                        
                        <tr>
                           <td>Cleanliness:&nbsp;</td>
                           <td>
                              <select id="cleanliness" name="cleanliness" tabindex="12">
                                 <option selected="selected" disabled="disabled" style="display:none;" value="0">Select an option</option>
                                 <option value="5">Excellent</option>
                                 <option value="4">Good</option>
                                 <option value="3">Acceptable</option>
                                 <option value="2">Poor</option>
                                 <option value="1">Terrible</option>
                              </select>
                           </td>
                        </tr>
                        
                        <tr>
                           <td>Order Accuracy:&nbsp;</td>
                           <td>
                              <select id="order_accuracy" name="order_accuracy" tabindex="13">
                                 <option selected="selected" disabled="disabled" style="display:none;" value="0">Select an option</option>
                                 <option value="5">Excellent</option>
                                 <option value="4">Good</option>
                                 <option value="3">Acceptable</option>
                                 <option value="2">Poor</option>
                                 <option value="1">Terrible</option>
                              </select>
                           </td>
                        </tr>
                        
                        <tr>
                           <td>Timely Service:&nbsp;</td>
                           <td>
                              <select id="timely_service" name="timely_service" tabindex="14">
                                 <option selected="selected" disabled="disabled" style="display:none;" value="0">Select an option</option>
                                 <option value="5">Excellent</option>
                                 <option value="4">Good</option>
                                 <option value="3">Acceptable</option>
                                 <option value="2">Poor</option>
                                 <option value="1">Terrible</option>
                              </select>
                           </td>
                        </tr>
                        
                        <tr>
                           <td>Overall Value:&nbsp;</td>
                           <td>
                              <select id="overall_value" name="overall_value" tabindex="15">
                                 <option selected="selected" disabled="disabled" style="display:none;" value="0">Select an option</option>
                                 <option value="5">Excellent</option>
                                 <option value="4">Good</option>
                                 <option value="3">Acceptable</option>
                                 <option value="2">Poor</option>
                                 <option value="1">Terrible</option>
                              </select>
                           </td>
                        </tr>
                        
                        <tr>
                           <td>Overall Experience:&nbsp;</td>
                           <td>
                              <select id="overall_experience" name="overall_experience" tabindex="16">
                                 <option selected="selected" disabled="disabled" style="display:none;" value="0">Select an option</option>
                                 <option value="5">Excellent</option>
                                 <option value="4">Good</option>
                                 <option value="3">Acceptable</option>
                                 <option value="2">Poor</option>
                                 <option value="1">Terrible</option>
                              </select>
                           </td>
                        </tr>
                        
                        <tr>
                           <td>Comments:&nbsp;</td>
                           <td><textarea id="comments" name="comments" rows="8" cols="64" tabindex="17"></textarea></td>
                        </tr>
                        
                        <tr>
                           <td colspan="2" style="text-align: center;">
                              <input type="submit" style="padding: 0.15em;" value=" Submit " tabindex="18" />
                           </td>
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
