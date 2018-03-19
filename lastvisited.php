<div id="right-bottom" class="right-bottom">
<?php 

      $lastVisitedPosts .= "<h3 class=\"header\">Recently Viewed</h3>";

   if (!empty($results)) 
   {
      
      

      foreach ($results as $key) 
      {
      	                    $monthNum = date('m',strtotime($key['post_date'])); 

                              $dt = new DateTime($key['post_date']);                    
                              $date = $dt->format('d');                               
                              $hours = $dt->format('h:i:s');
                              $month   = DateTime::createFromFormat('!m', $monthNum);
                              $monthName = $month->format('F');
                              $year = $dt->format('Y'); 

      	  $lastVisitedPosts .= " <h2><a style=\"color: #cd7f32; text-decoration: none;\" href=\"post.php?id=$key[post_id]\">$key[post_title]</a></h2>
      	                          <span> 
                                          Added by Nikoleta Shopova on $date $monthName $year at $hours
                                 </span>
                                 ";
      }
    }
    else 
    {
      $lastVisitedPosts .= "<span>
                                   Not seen posts;        
                           </span>";
    }

      echo $lastVisitedPosts;
?>
</div>