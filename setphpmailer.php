<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    
    require './SMTP.php';
    require './Exception.php';
    require './PHPMailer.php';
     

     $mail = new PHPMailer();                             
			    
                                      
     $mail->isSMTP();                                      
     $mail->Host = 'smtp.gmail.com';  
     $mail->SMTPAuth = true;                               
     $mail->Username = '';            
     $mail->Password = '';                          
     $mail->SMTPSecure = 'tls';                            
     $mail->Port = 587;          
    
     $mail->setFrom('shopovborislav@gmail.com', 'Borislav');



?>