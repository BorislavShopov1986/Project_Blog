<?php
      require_once "model.php";
      require_once "dbmodel.php";

      $data = array();
      
      $dataTemplate = " ";      
      $dbM = DbModel::getInstance();



      $data = $dbM->getPostsByCategory($_POST['category'],$data, $_POST['id']);

      if (!empty($data))
      {
      	  
      	 foreach ($data as $key) 
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
		                    
		          
		           $dataTemplate .= "<div id=\"last\"><h3 id=\"title\" style=\" margin-bottom: 0px;\">
		                 <a href=\"post.php?id=$key[post_id]\" style=\"color: #cd7f32; text-decoration: none;\">$key[post_title]</a>
		         </h3>
		         <span> 
		                  Added by Nikoleta Shopova on $date $monthName $year at $hours  
		         </span>
		         <img src=\"$key[photo_path]\" style=\"\" />
		         <p style=\" margin-left: 0px; padding-left: 0px;\">
		               $text...  
		         </p>
		         <a style=\"color: #cd7f32;\" href=\"post.php?id=$key[post_id]\">Read More</a>
		             ";
		             $id = $key['post_id'];

		             $category = $key['category'];
         }

            $dataTemplate .= "<button value = \"$category\" style=\"display: block; padding: 7px; color: #FFFFFF; margin-top: 4px; width: 115px; margin-top: 25px;\" class=\"button\" id=\"$id\">See More</button>";
      	 
               

      	 }
          
      	 echo $dataTemplate; 


      
?>
