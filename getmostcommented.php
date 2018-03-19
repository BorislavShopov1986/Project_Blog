<?php
                         $mostCommented = "<div  class=\"right-bottom\"><h2>Most Commented</h2>";
                         foreach ($arrMostCommented as $key) 
                         {
                            $dt = new DateTime($key['post_date']);
                              
                                       $date = $dt->format('d');
                                       $hours = $dt->format("H:i");
                                       $monthNum = date('m',strtotime($key['post_date'])); 
                                        $month   = DateTime::createFromFormat('!m', $monthNum);
                                        $monthName = strtoupper($month->format('M'));
                                        $year = $dt->format('Y'); 
                                            
                                  $spaceposition = strpos($key['post'], ' ', 10);
                                  
                               
                                  $mostCommented .= "<div class=\"inner\" id=\"last-$key[id]\"><h3 id=\"title_$key[id]\" style=\"color: #cd7f32; margin-bottom: 0px;\">
                                         <a href=\"post.php?id=$key[id]\">$key[post_title]</a>
                                 </h3>
                                 <span style=\"width: 5%;\"> 
                                          Added by Nikoleta Shopova in <a style=\"text-decoration: none; color: #cd7f32;\" href=\"$key[category].php\">$key[category]</a> <br/> on $date $monthName $year at $hours  
                                 </span>
                                    <span style=\"display: block\"> $key[num] comments </span>
                                    <a style=\"color: #cd7f32;\" href=\"post.php?id=$key[id]\">Read More</a>
                                     </div>";
                         }
                          $mostCommented .= "</div>";
                         echo $mostCommented;
                   ?>