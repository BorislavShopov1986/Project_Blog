<?php 
     require_once "./model.php";
     require_once "./dbmodel.php";
     require_once "./functions.php";
$data = array();
      
      $dataTemplate = " ";      
      $dbM = DbModel::getInstance();


       
       $data = $dbM->getSearchQuery($_POST['searchBy'],$_POST['id'],$data);

      if (!empty($data))
      {
      	  
      	 foreach ($data as $key) 
      	 {
		      	 	$dt = new DateTime($key['date']);
		          $spaceposition = strpos($key['post'], ' ', 300);
		          $text = substr($key['post'], 0 ,$spaceposition);
		          $date = $dt->format('d');
		          $hours = $dt->format("H:i");
		          $monthNum = date('m',strtotime($key['date'])); 
		          $month   = DateTime::createFromFormat('!m', $monthNum);
		          $monthName = strtoupper($month->format('M'));
		          $year = $dt->format('Y'); 
		                    
		          $text = highlightkeyword($text, $_POST['searchBy']);
		          $dataTemplate .= "<div id=\"last-$key[post_id]\"><h3><a href=\"$key[category].php\">Category: $key[category]</a>
                                      <a style=\"color: #cd7f32; margin-bottom: 0px; text-decoration: none;\" href=\"post.php?id=$key[post_id]\">
                                          $key[post_title]
                                       </a>
                                 </h3>
                                 <span> 
                                          Added by Nikoleta Shopova on $date $monthName $year at $hours
                                  </span>
                                 <img src=\"$key[photo_path]\" style=\"\" />
                                 <p style=\" margin-left: 0px; padding-left: 0px;\">
                                       $text...<br/>  
                                 </p>
                                 <a href=\"post.php?id=$key[post_id]\" style=\"color: #cd7f32;\">Read More</a></div>";
		          $id = $key['post_id'];

		            
         }

           
            $dataTemplate .= "<button value = \"$_POST[searchBy]\" style=\"display: block; padding: 7px; color: #FFFFFF; margin-top: 4px; width: 115px; margin-top: 25px;\" class=\"button\" id=\"$id\">See More</button>";
      	 
               

      	 }
          
      	 echo $dataTemplate; 