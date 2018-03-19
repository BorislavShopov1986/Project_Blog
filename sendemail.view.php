<!DOCTYPE html>
<html>
<head>
	<title>Send Emails</title>
</head>
<body>
         

   <form action="" method="post" name="form" id="form">
         <input type="text" placeholder="Enter subject" name="subject" id="subject">
         <?php 
                $template = " ";

               if(!empty($data))
               {
               	   foreach ($data as $key) 
               	   {
               	   	  $template .= "<input type=\"checkbox\" name=\"emails[]\" value=\"$key[sub_email]\" checked>$key[sub_email]";  
               	   }

               	   echo $template;
               }
               else
               {
               	   echo "No emails in the Database";
               }

              
         ?>
         <input type="submit" name="submit" id="submit">
   </form>
         	         
        
</body>
</html>