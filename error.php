<?php
   #Copyright (C) 2013 Jeremy Johnson
   
   include_once("globvar.php");
   
   $title = "Error";
   $message = "There was an error processing your request.";
   
   if($status_set = isset($_GET["status"]))
      $status = (int)$_GET["status"];
   else
      $status = -1;
   
   switch($status){
      case 400:
         $title = "$status Bad Request";
         $message = "The request cannot be fulfilled due to bad syntax.";
         break;
         
      case 401:
         $title = "$status Unauthorized";
         $message = "You must be logged in to view this page.";
         break;
         
      case 403:
         $title = "$status Forbidden";
         $message = "You do not have permission to access the requested resource.";
         break;
         
      case 404:
         $title = "$status Not Found";
         $message = "The requested resource, <tt>$url</tt>, was not found on this server.";
         break;
         
      case 405:
         $title = "$status Method Not Allowed";
         $message = "The $request_method method is not allowed for the requested URL.";
         break;
         
      case 408:
         $title = "$status Request Timeout";
         $message = "The server closed the network connection because the client did not finish the request within the specified time.";
         break;
         
      case 410:
         $title = "$status Gone";
         $message = "The requested URL is no longer available on this server.";
         break;
         
      case 411:
         $title = "$status Length Required";
         $message = "A request with the $request_method method requires a valid <tt>Content-Length</tt> header.";
         break;
         
      case 412:
         $title = "$status Precondition Failed";
         $message = "The precondition on the request for the URL failed positive evaluation.";
         break;
         
      case 413:
         $title = "$status Request Entity Too Large";
         $message = "The $request_method method does not allow the data transmitted, or the data volume exceeds the capacity limit.";
         break;
         
      case 414:
         $title = "$status Request URI Too Large";
         $message = "The length of the requested URL exceeds the capacity limit for this server. The request cannot be processed.";
         break;
         
      case 415:
         $title = "$status Unsupported Media Type";
         $message = "The server does not support the media type transmitted in the request.";
         break;
         
      case 500:
         $title = "$status Internal Server Error";
         $message = "The requested resource, <tt>$url</tt>, was not found on the server.";
         break;
         
      case 501:
         $title = "$status Not Implemented";
         $message = "The server does not support the action requested by the client.";
         break;
         
      case 502:
         $title = "$status Bad Gateway";
         $message = "The proxy server received an invalid response from an upstream server.";
         break;
         
      case 503:
         $title = "$status Service Unavailable";
         $message = "The server is temporarily unable to service your request due to maintenance downtime or capacity problems. Please try again later.";
         break;
         
      case 504:
         $title = "$status Gateway Timeout";
         $message = "The gateway did not receive a timely response from an upstream server or application.";
         break;
         
      case 506:
         $title = "$status Variant Also Negotiates";
         $message = "A variant for the requested entity is itself a negotiable resource. Access is not possible.";
         break;
      
      case -1:
         $title = "Error";
         $message = "An unknown error has occurred.";
         break;
         
      default:
         $title = "$status Error";
         $message = "The server returned status code $status.";
         break;
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
               <div class="contentbox">
                  <h1><?php echo $title; ?></h1>
                  <p><?php echo $message; ?></p>
               </div>
            </td>
         </tr>
         
         <?php include_once("footer.php"); ?>
      </table>
   </body>
</html>
