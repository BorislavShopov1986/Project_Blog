<!DOCTYPE html>
<html>
<head>
     <title>Private</title>
     <link rel="stylesheet" type="text/css" href="./style.css">
  <script src="./jquery/jquery-3.2.1.min.js"></script>
  <script src="./jquery/loaddata.js"></script>
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
          <div style="width: 80%;">
                   
                   <?php 
                         require_once "secondincludes.php";  
                   ?>

                  <div>
                          <?php 
                                 require_once "getpostsbycategorie.php";
                          ?>
                  </div>        
          </div>
</body>
</html>