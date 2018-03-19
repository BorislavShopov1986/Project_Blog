<div class="right-top">
     	     	        <?php 
                        $table = "<h3 class=\"header\">Categories</h3>
                                   <table>";
                          foreach ($data as $key) {
                              $table .= "<tr><td><a class=\"a\" style=\"color: #cd7f32; text-decoration: none;\" href=\"$key[category].php\">".$key['category']."</a></td><td>(".$key['num'].")</td></tr>";
                          }

                          $table .= "</table>";

                         echo $table;     

                    ?>
  </div>