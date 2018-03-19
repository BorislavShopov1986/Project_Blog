<?php
   
     if (!empty($dataDb)) 
     {
         
         
         $template = " ";

         $id = " ";
         $category = " ";
         foreach ($dataDb as $key) 
         {
              $dt = new DateTime($key['post_date']);
          $spaceposition = strpos($key['post'], ' ', 500);
          $text = substr($key['post'], 0 ,$spaceposition);
          $date = $dt->format('d');
          $hours = $dt->format("H:i");
          $monthNum = date('m',strtotime($key['post_date'])); 
          $month   = DateTime::createFromFormat('!m', $monthNum);
          $monthName = strtoupper($month->format('M'));
          $year = $dt->format('Y'); 
                    
          
           $template .= "<div id=\"last\" class=\"align-text\"><h3 id=\"title\" style=\" margin-bottom: 0px;\">
                 <a href=\"post.php?id=$key[post_id]\" style=\"color: #cd7f32; text-decoration: none;\">$key[post_title]</a>
         </h3>
         <span> 
                  Added by Nikoleta Shopova on $date $monthName $year at $hours  
         </span>
         <img src=\"$key[photo_path]\" style=\"\" />
         <p style=\" margin-left: 0px; padding-left: 0px;\" class=\"post-text\">
               $text...  
         </p>
         <a style=\"color: #cd7f32;\" href=\"post.php?id=$key[post_id]\">Read More</a>
             ";
             $id = $key['post_id'];

             $category = $key['category'];
         }

         $template .= "<button value = \"$category\"  class=\"button\" id=\"$id\">See More</button>";

         echo $template;
         
     }
     else 
     {
        echo "No results";
     }

?>