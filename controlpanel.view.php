<!DOCTYPE html>
<html>
<head>
	<title>Control Panel</title>
	<link rel="stylesheet" type="text/css" href="style.css">
  
  <script src="./jquery/jquery-3.2.1.min.js"></script>
  <script>
           $(document).ready(function()
          {
               $("#add").on("click",function(event) {
                      
                    var myTextArea = $("#post");
                    myTextArea.val(myTextArea.val() + "<p></p>");
               });

          });
  </script>
</head>
<body>
         <form method="post" action="./controlpanel.php" enctype="multipart/form-data" >
         	    
           <div class="contain"> 
         	    <div class="border" >  
         	          <input type="text" name="taggs" class="text" placeholder="Add Tagg">
         	          <input type="submit" name="addtagg" value="Add Tagg">
                </div>   
          </div>

          <div class="contain"> 
              <div class="border" >  
                    <input type="text" name="category" class="text" placeholder="Add Category">
                    <input type="submit" name="addCateg" value="Add Category">
                </div>   
          </div>

          <div class="container">
          	       <input type="text" name="title" placeholder="Add Title">
          	       
                    <?php 
                          echo $checkboxes;
                          echo $select;      
                    ?> 
                 <input style="display: block;" name="files[]" type="file" accept="image/*" multiple>
                 <a href="#" id="add" value="<p></p>">Add paragraph</a>
                 <textarea id="post" style="display: block;" name="post"  rows="5" cols="25" placeholder="Add post"></textarea>

                 <input type="submit" name="submit">    
          </div>
         </form>
</body>
</html>