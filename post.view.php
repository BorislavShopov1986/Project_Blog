<!DOCTYPE html>
<html>
<head>
	<title>Post</title>
	<link rel="stylesheet" type="text/css" href="style.css">
  <meta charset="UTF-8">
  <script src="./jquery/jquery-3.2.1.min.js"></script>
  <script src="./jquery/scrolltotop.js"></script>
  <script src="./jquery/jquery.sticky.js"></script>
  <script src="./jquery.color.js"></script>
  <script src="./jquery/readmore.js"></script>
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
            require_once "./head.php";
       ?>

       <section id="container" style="width: 80%;">

       	           <?php 
                         require_once "secondincLudes.php";    
       	           ?>
       	           <div id="left-box" style="position: relative; width: 45%;"> 

       	                   <?php

                                 foreach ($post as $key) 
                                 {
                                 	
                                       $dt = new DateTime($key['post_date']);
                              
                                       $date = $dt->format('d');
                                       $hours = $dt->format("H:i");
                                       $monthNum = date('m',strtotime($key['post_date'])); 
                                        $month   = DateTime::createFromFormat('!m', $monthNum);
                                        $monthName = $month->format('F');
                                        $year = $dt->format('Y'); 
                                            
                                  
                                  $po .= "<div id=\"last\"><h3 id=\"title\" style=\"color: #cd7f32; margin-bottom: 0px;\">
                                         $key[post_title]
                                 </h3>
                                 <span> 
                                          Added by Nikoleta Shopova on $date $monthName $year at $hours  
                                 </span>
                                 <img src=\"$key[photo_path]\" style=\"\" />
                                 <div style=\" margin-left: 0px; padding-left: 0px; text-align: justify;\">
                                       $key[post]  
                                 </div>
                                 
                                     ";
                                }
                                 
                                echo $po;
       	                   ?>        

       	           </div>
                  
                         <div id="left-middle" class="left-middle">
                      <form id="form" method="post" action="./post.php?id=<?php echo htmlentities($_GET['id']); ?>#comment" accept-charset="UTF-8">  
                                  <table>
                                          <tbody>
                                                  <tr>
                                                        <td>
                                                              <?php if(!empty($reqfield)) echo "<label style=\"color: red; display: block;\">".$reqfield."
                                                                     </label>"   ?>                                                            
                                                             <input type="text" id="name" name="name" placeholder="Name"/>
                                                        </td>

                                                  </tr>
                                                  <tr>
                                                        <td>
                                                              <?php if(!empty($reqfieldThree)) echo "<label style=\"color: red; display: block;\">".$reqfieldThree."
                                                                     </label>"   ?>                                                            
                                                             <input type="text" id="email" name="email" placeholder="Email"/>
                                                        </td>

                                                  </tr>
                                                  <tr>
                                                        <td>
                                                               <?php if(!empty($reqfieldTwo)) echo "<label style=\"color: red; display: block;\">".$reqfieldTwo."
                                                                     </label>"   ?>
                                                              <textarea placeholder="Comment" id="comment" name="comment"></textarea>
                                                        </td>
                                                  </tr>
                                                  <tr>
                                                       <td>
                                                             <input type="checkbox" name="notify" id="notify">Notify me when next comment is added
                                                       </td>
                                                  </tr>
                                                  <tr>
                                                        <td>
                                                               <input type="submit" name="submit" value="Comment" id="submit"/>
                                                        </td>
                                                  </tr>

                                          </tbody>
                                  </table>
                            </form> 
                           </div>
                         
                         <div id="left-bottom" class="left-bottom">
                                  
                                  <?php
                                       $comment = " ";
                                       $counter = 1;

                                       $arrReplacements = array(":)","&lt;3",":(", "(sun)","(victory)","(star)");
                                       $arrReplaceWith = array("&#9786","&#10084","&#9785","&#9788","&#9996","&#10026");

                                         if (!empty($arrComments)) 
                                         {
                                           foreach ($arrComments as $key) 
                                           {
                                              $dt = new DateTime($key['comment_date']);
                              
                                              $date = $dt->format('d');
                                              $hours = $dt->format("H:i:s");
                                              $monthNum = date('m',strtotime($key['comment_date'])); 
                                              $month   = DateTime::createFromFormat('!m', $monthNum);
                                              $monthName = $month->format('F');
                                              $year = $dt->format('Y');
                                               
                                              $text = str_replace($arrReplacements, $arrReplaceWith, $key['c_text']);
                                                 $numComments   = "<label style=\"display: block; color: #cd7f32; \"> $counter Comments </label>";     
                                              $comment .= "<div class=\"left-bottom-inner\">

                                               
                                               <h3 id=\"id-$key[ID]\" style=\"dispaly: block; color: #cd7f32;\">$key[name] 
                                                        <span style=\"color: #000\">
                                                            added on
                                                        </span> 
                                                        $date $monthName $year at $hours
                                               </h3>
                                               <span style=\"width: 10%; padding: 10px; border: 1px #ddd solid;\">$counter</span>
                                                <p class=\"comment more\">

                                                       $text
                                                </p>

                                                </div> 
                                               "; 
                                              $counter++;
                                           }
                                             echo $numComments.$comment; 
                                         }
                                         else 
                                         {
                                             echo "<label style=\"display: block; color: #cd7f32;\">Leave the first comment!</label>";
                                         }

                                        require_once "scrolltotop.php";        
                                   ?>   
                         </div>
                  
       </div>
     </section>
</body>
</html>