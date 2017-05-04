<?php
   #Copyright (C) 2013 Jeremy Johnson
   
   include_once("globvar.php");
   
   $title = "Video";
   
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
                  <video controls autoplay>
                     <source width="800" height="600" src="video.mp4" type="video/mp4">
                  </video>
                  <p><i>Music: Fugue in G Minor (BWV 578) by Johann Sebastian Bach, ca. 1707</i></p>
               </div>
            </td>
         </tr>
         
         <?php include_once("footer.php"); ?>
      </table>
   </body>
</html>
