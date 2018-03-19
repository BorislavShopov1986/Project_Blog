<!DOCTYPE html>
<html>
<head>
	<title>Archive</title>
	<link rel="stylesheet" type="text/css" href="style.css">
  <script src="./jquery/jquery-3.2.1.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta charset="UTF-8">
     <script src="./jquery/scrolltotop.js"></script>
     <script src="./jquery.color.js"></script>
     <script>
           
              $(document).ready(function(){
                  

                      $(".li-item").mouseenter(function() 
                      {
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
      <div style="width: 80%">
      	       <?php 
                     require_once "secondincludes.php";
      	       ?>
              
      	       <div class="left">
      	                
                      <?php 
                             foreach ($dbResults as $key) 
                             {
                               $spaceposition = strpos($key['post'], ' ', 500);
                               $text = substr($key['post'], 0 ,$spaceposition);
                                        
                                        $dt = new DateTime($key['post_date']);
                                        $date = $dt->format('d');
                                        $hours = $dt->format("H:i:s");
                                        $monthNum = date('m',strtotime($key['post_date'])); 
                                        $month   = DateTime::createFromFormat('!m', $monthNum);
                                        $monthName = strtoupper($month->format('M'));
                                        $year = $dt->format('Y');                                      
                                $postedOn = "<h3 class=\"header\">Posts from: $monthName $year</h3>";
                          	 $published .= "<div id=\"last\"><h3 style=\"color: #cd7f32; margin-bottom: 0px;\">
                                       $key[post_title]
                                 </h3>
                                 <span> 
                                          Added by Nikoleta Shopova on $date $monthName $year at $hours
                                 </span>
                                 <img src=\"$key[fotos]\" style=\"\" />
                                 <p style=\" margin-left: 0px;\">
                                       $text...<br/>  
                                 </p>
                                 <a href=\"post.php?id=$key[post_id]\" style=\"color: #cd7f32;\">Read More</a></div>";
                                  $lastId = $key['post_id'];
                             }
                               

                             echo $postedOn.$published;
                             require_once "scrolltotop.php";
                      ?>
      	       </div>

      </div> 

</body>
</html>