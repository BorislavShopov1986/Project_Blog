<?php
     require_once "./model.php";

     $db = DB::getInstance();

     $posts = array();

     $post = " ";

     
     $posts = $db->getPostByAjax($posts,$_POST['last_id'],$_POST['tagg_id']);

      if (!empty($posts)) 
      {
      	# code...
      

		      foreach ($posts as $key) 
		      {
		                          	 
			       $spaceposition = strpos($key['post'], ' ', 500);
			       $text = mb_substr($key['post'], 0 ,$spaceposition);

			  	   $today = new DateTime("today");
                              $dt = new DateTime($key['post_date']);
                              
                               $date = $dt->format('d');
                               $hours = $dt->format("H:i");
                               $monthNum = date('m',strtotime($key['post_date'])); 
                                $month   = DateTime::createFromFormat('!m', $monthNum);
                                $monthName = strtoupper($month->format('M'));
                                $year = $dt->format('Y'); 
                                       




			  	   $post .= "<div id=\"last\"><h3 style=\"color: #cd7f32; margin-bottom: 0px;\">
			               $key[post_title]
			         </h3>
			         <span> 
			                  Added by Nikoleta Shopova on $date $monthName $year at $hours in <a style=\"color: #cd7f32; text-decoration: none;\" href=\"$key[category].php\">$key[category]</a>
			         </span>
			         <img src=\"$key[photo_path]\" style=\"\" />
			         <p style=\" margin-left: 0px; padding-left: 0px; margin-bottom: 30px;\">
			               $text...<br/>  
			         </p>
			         <a href=\"post.php?id=$key[post_id]\" class=\"link-readmore\">Read More</a></div>";
			          $lastId = $key['post_id'];
		        }

		        $post .= "<button class=\"button\" 
		                     style=\"display: block; padding: 7px; color: #FFFFFF; margin-top: 4px; width: 74px; margin-top: 25px;\"  
		                       type=\"button\" 
		                       id=\"<?php echo $_POST[tagg_id]; ?>\" 
		                       value=\"<?php echo $lastId ?>\" 
		                       name=\"loadmore\">More
		                   </button>";

        }
        else
        {
            $post .= "<span>No more results</span>";
        }                            

                          echo $post;
?>