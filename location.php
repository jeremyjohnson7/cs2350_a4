<?php
   #Copyright (C) 2013 Jeremy Johnson
   
   include_once("globvar.php");
   
   $title = "Location";
   
   /*$latitude = rand(40, 66);
   $longitude = rand(-180, 180);
   $company_location = (($latitude >= 0) ? ($latitude . "&deg;N ") : (-$latitude . "&deg;S ")) . (($longitude >= 0) ? ($longitude . "&deg;E") : (-$longitude . "&deg;W"));*/
   
   $latitude = -77.530833;
   $longitude = 167.0775;
   $zoom_level = 16;
   $company_location = (($latitude >= 0) ? ($latitude . "&deg;N ") : (-$latitude . "&deg;S ")) . (($longitude >= 0) ? ($longitude . "&deg;E") : (-$longitude . "&deg;W"));
   $google_map = "https://maps.google.com/maps?hl=en&amp;t=h&amp;ie=UTF8&amp;ll=$latitude,$longitude&amp;spn=0.004844,0.008572&amp;z=$zoom_level";
   
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
               <div class="contentbox">
                  <h1><?php echo $title; ?></h1>
                  <p>We are located at 77&deg;31'51&quot;S 167&deg;4'39&quot;E, near the top of Mt. Erebus on Ross Island.</p>
                  <!--<p>We are located at <?php /*echo $company_location;*/ ?>, near the top of Mt. Erebus on Ross Island.</p>-->
                  
                  <iframe width="800" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php echo $google_map; ?>&amp;output=embed"></iframe><br />
                  <a href="<?php echo $google_map; ?>&amp;output=embed">View Larger Map</a>
                  
                  <!--<iframe width="800" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?hl=en&amp;t=h&amp;ie=UTF8&amp;ll=41.193607,-111.942937&amp;spn=0.004844,0.008572&amp;z=17&amp;output=embed"></iframe><br />
                  <a href="https://maps.google.com/maps?hl=en&amp;t=h&amp;ie=UTF8&amp;ll=41.193607,-111.942937&amp;spn=0.004844,0.008572&amp;z=17&amp;source=embed" style="color:#0000FF;text-align:left">View Larger Map</a>-->
               </div>
            </td>
         </tr>
         
         <?php include_once("footer.php"); ?>
      </table>
   </body>
</html>
