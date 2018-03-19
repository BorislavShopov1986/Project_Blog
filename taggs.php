<div class="right-middle">
                 <?php 
                         
                       $links = "<h3 class=\"header\">Taggs</h3>";

                       $count = 1;

                       $counter = 0;

                       foreach ($taggs as $key) {
                           
                           if ($count > 6) {
                              $count = 6;
                           }



                           $links .= "<a style=\"margin-left: 5px;\" href=\"posts.php?id=$key[tag_id]&page=tagg\"><h$count style=\"display: inline-block; color: #cd7f32;\">$key[tag]</h$count></a>";
                             
                          if ($counter % 2 == 0) {
                             
                              $count++;
                           }

                           $counter++;
                       }

                        echo $links 
                 ?>
                        
           </div>