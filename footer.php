<?php
   #Copyright (C) 2013 Jeremy Johnson

   //The funny indentation is to make the html output readable
       ?><tr id="footer">
            <td colspan="2" nowrap="nowrap" align="left">
               <ul class="navbox">
                  <li><i><?php echo "Copyright &copy; " . roman_num(date("Y", getlastmod())) . " $company_name. All rights reserved."; ?></i></li>
               </ul>
            </td>
            
            <td colspan="1" nowrap="nowrap" align="right">
               <ul class="navbox">
                  <!--<li><i><?php /*echo "Updated " . date("j F Y", getlastmod());*/ ?></i></li>-->
                  <li><i>77&deg;31'51&quot;S 167&deg;4'39&quot;E</i></li>
                  <li><i>801-555-0123</i></li>
               </ul>
            </td>
         </tr>
