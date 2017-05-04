<?php
   switch($doctype){
      case 'XHTML 1.0 Transitional':
         echo '<?xml version="1.0" encoding="' . $charset . '" ?>', "\n";
         echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">', "\n";
         echo '<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">', "\n";
         break;
         
      case 'HTML 4.01 Transitional':
         echo '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">', "\n";
         echo '<html lang="en">', "\n";
         break;
   }
   
   echo '   <!--Copyright (C) ' . date("Y", getlastmod()) . ' Jeremy Johnson-->', "\n\n";
?>
