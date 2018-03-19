<?php
$template = "<div style=\"clear:both margin-bottom: 14px; margin-top: 74px;\" id=\"from-left-middle\">
                 <h3>
                    Last comments
                 </h3>
               "; 

      if (!empty($arrComments)) 
      {
      	  
           $template .= "<ul>";
      	  foreach ($arrComments as $key) 
      	  {
      	  	 $template .= "
      	  	                <li>
      	  	                     <span>
      	  	                          $key[name]
      	  	                          on
      	  	                          <a href=\"post.php?id=$key[post_id]#id-$key[comment_id]\">$key[post_title]</a>
      	  	                      </span>
      	  	                  </li>";
      	  }

      	  $template .= "  </ul>
      	                <div>";
      }
      else 
      {
              $template .= "No comments yet
                            </div>"; 
      }

      echo $template;
?>