<?php

        
       if (!empty($arrQvalues)) 
       {
            
             

             $dataRow = " <div id=\"searchvaluescontainer\">";

           $counter = 0;


        foreach ($arrQvalues as $key) 
        {
                            $spaceposition = strpos($key['post'], ' ', 300);
                               $text = substr($key['post'], 0 ,$spaceposition);
                                        
                                        $dt = new DateTime($key['date']);
                                        $date = $dt->format('d');
                                        $hours = $dt->format("H:i");
                                        $monthNum = date('m',strtotime($key['date'])); 
                                        $month   = DateTime::createFromFormat('!m', $monthNum);
                                        $monthName = strtoupper($month->format('M')); 
                                        $year = $dt->format('Y');                                      

                                 $text = highlightkeyword($text, $queryString);
                                $lastId = $key['post_id'];
                               $dataRow .= "<div id=\"last-$key[post_id]\"><h3><a href=\"$key[category].php\">Category: $key[category]</a>
                                      <a style=\"color: #cd7f32; margin-bottom: 0px; text-decoration: none;\" href=\"post.php?id=$key[post_id]\">
                                          $key[post_title]
                                       </a>
                                 </h3>
                                 <span> 
                                          Added by Nikoleta Shopova on $date $monthName $year at $hours
                                  </span>
                                 <img src=\"$key[photo_path]\" style=\"\" />
                                 <p style=\" margin-left: 0px;\">
                                       $text...<br/>  
                                 </p>
                                 <a href=\"post.php?id=$key[post_id]\" style=\"color: #cd7f32;\">Read More</a></div>";

                  $counter++;
        }
            $dataRow .= "<button id=\"$lastId\" value=\"$queryString\" class=\"button\">Load More</button><div>";
            
             $numRes = "<span  style=\"margin-top: 17px; \">Number of results: $counter</span>";
             echo $numRes.$dataRow;
   }
   else 
   {
        echo "<h1>No results</h1>";
   }


?>