<!DOCTYPE html>
<html>
<head>
	<title>Search</title>
	<link rel="stylesheet" type="text/css" href="./style.css">
	<script src="./jquery/jquery-3.2.1.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta charset="UTF-8">
     <script src="./jquery/scrolltotop.js"></script>
      <script src="./jquery.color.js"></script>
      <script src="./jquery/getdata.js"></script>
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

         
               <div class="from-left">
               	  <div class="from-left-inner">
               	      <input type="text"  name="searchValue" style="width: 150%; padding: 8px; font-weight: bolder; color: #cd7f32; font-size: 14px; margin-bottom: 14px;" value="Results for: <?php echo htmlentities($_GET['s'])?>"/>      
                   </div>
               	      <?php
                          if (empty($isSetQString)) 
                            {
                            	require_once "getdsvalues.php";
                            }
                            else 
                            {
                                require_once "getsearchedvalues.php";       
                            }

                            require_once "scrolltotop.php";  
               	      ?>
               </div>
        </div>
</body>
</html>