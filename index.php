<?php
   #Copyright (C) 2013 Jeremy Johnson
   
   include_once("globvar.php");
   
   $title = "Home";
   
   //Start of output
   include_once("doctype.php");
?>
   <head>
      <title><?php echo $company_name; ?></title>
      <link rel="stylesheet" type="text/css" href="<?php echo $stylesheet; ?>" />
      <meta http-equiv="content-type" content="text/html; charset=<?php echo $charset; ?>" />
   </head>
   
   <body>
      <table id="container" width="100%" border="0" cellspacing="0">
         <?php include_once("header.php"); ?>
         
         <tr id="main">
            <td id="content" colspan="3">
               <div class="contentbox">
                  <h1><?php echo $company_name; ?></h1>
                  <p>Welcome to Mt. Erebus, the most active and second highest volcano in Antarctca. Eat the most delicious food in Antarctica while you watch volcanic eruptions, look out over the Ross Ice Shelf, McMurdo Sound, and the McMurdo Dry Valleys, or enjoy the magnificent view of Mt. Terror, Mt. Bird, and Mt. Terra Nova from our unique and remote location.</p>
                  <!--<img src="http://upload.wikimedia.org/wikipedia/commons/4/4e/Mt_erebus.jpg" alt="Mt. Erebus in 1972 (Richard Waitt, U.S. Geological Survey)" title="Mt. Erebus in 1972 (Richard Waitt, U.S. Geological Survey)" />-->
                  <center><img src="http://upload.wikimedia.org/wikipedia/commons/4/4e/Mt_erebus.jpg" alt="Mt. Erebus in 1972 (Richard Waitt, U.S. Geological Survey)" title="Mt. Erebus in 1972 (Richard Waitt, U.S. Geological Survey)" width="998" /></center>
                  
                  <p><i>Disclaimer: This website contains fictional information.</i></p>
               </div>
            </td>
         </tr>
         
         <?php include_once("footer.php"); ?>
      </table>
   </body>
</html>
