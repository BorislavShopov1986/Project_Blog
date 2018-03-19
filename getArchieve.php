<div class="right-bottom">
<?php
 $tablePosts = "<h3 class=\"header\">Archive</h3> 
                           <table>
                               <tbody>";
         foreach ($archive as $key) 
         {
         
            $tablePosts .= "<tr>
         	                    <td>
         	                         <a style=\"color: #cd7f32; text-decoration: none;\" href=\"archive.php?month=$key[num]&year=$key[year]\">$key[month] $key[year]</a>
         	                    </td>
         	                    <td>
                                      ($key[sum])
         	                    </td>
         	               </tr>";
         }

         $tablePosts .= "</tbody>
                            </table>";

                            echo $tablePosts;
?>
</div>