<?php
      use PHPMailer\PHPMailer\PHPMailer;
      use PHPMailer\PHPMailer\Exception;

      require_once "includes.php";
      require './SMTP.php';
      require './Exception.php';
      require './PHPMailer.php';
      


      $dbM = DbModel::getInstance();

      $data = array();

      $data = $dbM->getEmails($data);

      
      if ($_POST) 
      {
      	 $dbData = array();

         $dbData =  $dbM->getPostsForFeed($dbData);
         $links = " ";
           if(!empty($dbData))
            {
        	  foreach ($dbData as $key) 
        	  {
        	      $links .=  "<a style=\"color: #cd7f32; margin-left: 4px;\" href=\"Nikoleta/post.php?id=$key[post_id]\">$key[post_title]</a>";
        	  }
       
            
  
                      
                $mail = new PHPMailer();                             
			    
			                                     
			    $mail->isSMTP();                                      
			    $mail->Host = 'smtp.gmail.com';  
			    $mail->SMTPAuth = true;                               
			    $mail->Username = '';            
			    $mail->Password = '';                          
			    $mail->SMTPSecure = 'tls';                            
			    $mail->Port = 587;                                    

			    
			    $mail->setFrom('shopovborislav@gmail.com', 'Borislav');
			    

			    $emails = $_POST['emails'];

			    for ($i=0; $i < count($emails); $i++) 
			    {
			         $mail->addAddress($emails[$i]); 
			    }
                $mail->isHTML(true);
			    $mail->Subject = $_POST['subject'];
                $mail->Body   =  $links;

                $mail->send();

                echo "Email is sent";
       
		}      
     }

      
      require_once "sendemail.view.php";      
?>