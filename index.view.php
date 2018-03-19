<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="./style.css">
	<script src="./jquery/jquery-3.2.1.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta charset="UTF-8">
     <script src="./jquery/scrolltotop.js"></script>
     <script src="./jquery/jquery.sticky.js"></script>
     <script src="./jquery.color.js"></script>
     <script>
     
               $(document).ready(function(){
                     
                    $('.links').mouseover(function(event){
                         var id = event.target.id;
                          $('.img').attr('src', id);
                    });

                  $(".li-item").mouseenter(function() {
                               $(this).animate({'background-color': "#fff"}, 1200);
                         }),

                    $(".li-item").mouseleave(function() {
                            $(this).animate({'background-color': "#cd7f32"}, 1200);
                       });
                    


                  
                     //$("#sticker").sticky({topSpacing:1});
               });

     </script>
</head>
<body>
	
               <?php require_once "head.php";?>
 
     
     	   
        <div class="main">
             <?php 
                    
                   require_once "indexposts.php";
             ?>   
        </div>
           <?php
                require_once "secondincludes.php";
                require_once "emailform.php";

           ?>
           
             <?php             
                  require_once "getmostcommented.php"; 
             ?>   
           
           <?php
                  require_once "scrolltotop.php";      
          ?>
     
     
     <?php
             require_once "footer.php";
     ?> 
</body>
</body>
</html>