<!DOCTYPE html>
<html>
<head>
	<title>Posts</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="./jquery/jquery-3.2.1.min.js"></script>
  <script src="./jquery/scrolltotop.js"></script>
  <script src="./jquery.color.js"></script>
	<script>
		
		      $(document).ready(function()
		      {

		      	  $("body").on("click","button.button",function(event) {
                       
                       var last_id = $('.button').val();
                       var tagg_id = event.target.id;
                       $(".button").html('Loading...');

                       $.ajax({
                             url: "loadData.php",
                             method: "POST",
                             data: {last_id:last_id,
                                     tagg_id:tagg_id
                                 
                                      },
                             dataType: "text",
                             error: function(xhr, status, error) {
                                 alert(status);
                             },
                             success: function(data)
                             {
                             	if (data != '') 
                             	{
                                    
                                    $(".button").remove(); 
                                    $('#last').append(data);
                                      
                             	}
                             	else 
                             	{
                                       $('.button').html("No more posts");
                             	}
                             }         

                       });
                     
                     
                     
                      
		      	  });
             $(".li-item").mouseenter(function() {
                               $(this).animate({'background-color': "#fff"}, 1200);
                         }),

                    $(".li-item").mouseleave(function() {
                            $(this).animate({'background-color': "#cd7f32"}, 1200);
                       });
		      	 
		      });     
	</script>
</head>
<body>
      <?php

            require_once "head.php"; 
      ?>

      <div style="width: 80%; margin-top: 20px;">
     	
     	   <div class="left">
     	   	   <?php

     	            foreach ($posts as $key) {
                          	 
                               $spaceposition = strpos($key['post'], ' ', 500);
                               $text = substr($key['post'], 0 ,$spaceposition);
                                        
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

                          

                          echo $post;
                  ?>
                  <button class="button" style="display: block; padding: 7px; color: #FFFFFF; margin-top: 4px; width: 74px; margin-top: 25px;"  type="button" id="<?php echo htmlentities($_GET['id']); ?>" value="<?php echo $lastId ?>" name="loadmore">More</button>
     	   </div>  
           

           <?php
                require_once "secondincludes.php";
                require_once "scrolltotop.php";   
           ?> 
              
     </div> 
</body>
</html>