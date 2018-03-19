<!DOCTYPE html>
<html>
<head>
     <title>Trainings</title>
     <link rel="stylesheet" type="text/css" href="./style.css">
  <script src="./jquery/jquery-3.2.1.min.js"></script>
  <script src="./jquery/loaddata.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta charset="UTF-8">
     <script src="./jquery/scrolltotop.js"></script>
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