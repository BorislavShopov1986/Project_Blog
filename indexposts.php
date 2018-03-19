<?php

if (!empty($arrIndexPosts)) 
{
	$template = "";
	foreach ($arrIndexPosts as $key) 
	{
		 $dt = new DateTime($key['date']);
          $spaceposition = strpos($key['post'], ' ', 500);
          $text = substr($key['post'], 0 ,$spaceposition);
          $date = $dt->format('d');
          $hours = $dt->format("H:i");
          $monthNum = date('m',strtotime($key['date'])); 
          $month   = DateTime::createFromFormat('!m', $monthNum);
          $monthName = strtoupper($month->format('M'));
          $year = $dt->format('Y');

          $template .= "<div id=\"posts-container\">
                              <h3>
                                    <a href=\"post.php?id=$key[post_id]\" style=\"color: #cd7f32; text-decoration: none;\">$key[post_title]</a>
                             </h3>
                              <span> 
                                     Added by Nikoleta Shopova on $date $monthName $year at $hours in <a href=\"key[category].php\">$key[category]</a>  
                              </span>
                                  <img src=\"$key[photo_path]\" style=\"\" />
                                  <p style=\" margin-left: 0px; padding-left: 0px;\" class=\"post-text\">
                                      $text...  
                                  </p>
                                <a style=\"color: #cd7f32;\" href=\"post.php?id=$key[post_id]\">Read More</a>
                       </div>";
	}

	   echo "<h3>$textline1</h3>";
	   echo "<p>$textline2</p>";
	   echo $template;
	  echo $paginationCtrls;
}