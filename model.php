<?php 
      class DB {

      	   protected $dbh = NULL;
      	   protected static $instance = NULL;

      	   protected function __construct(){

                $this->dbh = new mysqli('localhost','root', '123', 'blog');

                if ($this->dbh->connect_errno) 
                {
                    printf("Connect failed: %s\n", $this->dbh->connect_error);
                    exit();
                }

                
                   
            }


      	       final static public function getInstance() {

      	    	   static $instances = array();
                  $calledClass = get_called_class();  
                 
                 if (!isset($instances[$calledClass])) {
      	    	   	   
                         $instances[$calledClass] = new $calledClass();
                         
      	    	   }

      	    	   return $instances[$calledClass];
      	    }

      	    public function addTagg($tagg) {

      	    	$sql = "Insert into `Tags`(`tag`) values('".$this->dbh->real_escape_string($tagg)."')";
      	    	//echo $sql;
      	    	$this->dbh->query($sql);
                 
                 //echo $this->dbh->error;   
                 
      	    }

      	    public function getTaggs($taggs)
      	    {
      	    	$sql = "select * from `tags`";

      	    	$result = $this->dbh->query($sql);

                while ($row = $result->fetch_assoc()) {
                     	
                     	$taggs[] = $row;
                }

                $result->free();

               
                
                return $taggs;        
      	    }

            public function AddCategory($category)
            {
                 $sql = "Insert into `Category`(`category`) values('".$this->dbh->real_escape_string($category)."')";
                 $this->dbh->query($sql);
                 
                 echo $this->dbh->error;   
                  

            }

               
           public function getCategory($category)
           {
              $sql = "select * from `category`";

              $result = $this->dbh->query($sql);

                while ($row = $result->fetch_assoc()) {
                      
                      $category[] = $row;
                }

                $result->free();

                
                
                return $category;   
           }


           public function addPost($title,$post,$id)
           {
                 $title = $this->dbh->real_escape_string($title);
                 $post = $this->dbh->real_escape_string($post);
                 $id = $this->dbh->real_escape_string($id);

                $sql = "INSERT INTO `posts`(`post_title`, `post`, `post_date`, `category_id`) VALUES ('$title','$post',Now(),$id)";

                
                $this->dbh->query($sql);
                echo $this->dbh->error;
           }


           public function insert($sql)
           {
                $this->dbh->query($sql);
                
                 
                echo $this->dbh->error;
           }
           
           public function getLastId()
           {
              return $this->dbh->insert_id;
           }


           public function postByCategories($data)
           {
               $sql = "SELECT `category`, `posts`.`category_id` as `id` ,count(`posts`.`category_id`) as `num` from `category` 
                       inner join `posts` 
                       on `category`. `category_id` = `posts`.`category_id` 
                       group by `posts`.`category_id`";

                $result = $this->dbh->query($sql);

                while ($row = $result->fetch_assoc()) {
                  
                  $data[] = $row;
                }

                $result->free();

                return $data;
           
           }

            public function getPostByTagg($posts, $id)
            {
               $sql = "SELECT `post_title`,`category`, `post`, `post_date`, `tag`, `posts`.`post_id`, `photo_path`  
                       from `posts` 
                       inner join `post_and_tags` 
                       on `posts`.`post_id` = `post_and_tags`.`post_id`
                       inner join `tags`
                       on `tags`.`tag_id` = `post_and_tags`.`tag_id`
                       inner join `post_fotos`
                       on `posts`.`post_id` = `post_fotos`.`post_id`
                       inner join `category` 
                       on `posts`.`category_id` = `category`.`category_id`  
                       where `post_and_tags`.`tag_id` = ".$this->dbh->real_escape_string($id)." limit 1";


                 if ($result = $this->dbh->query($sql)) {
                          
                        while ($row =  $result->fetch_assoc()) {
                              
                              $posts[] = $row;
                        }    
                  }
                  else {

                       echo $this->dbh->error;
                       die();
                  }   


                  $result->free();

                  return $posts;
            }

             public function getPostsByCateg($posts,$categId)
             {

                  $sql = "select `post`, `post_title`, 
                         `post_date`, `posts`.`post_id`, 
                          `photo_path`, `category` 
                          from `posts` 
                          inner join `category` 
                          on `posts`.`category_id` = `category`.`category_id` 
                          inner join `post_fotos` 
                          on `posts`.`post_id` = `post_fotos`.`post_id` 
                          where `posts`.`category_id` = ".$this->dbh->real_escape_string($categId)." Order by `post_date` DESC";

                          if ($result = $this->dbh->query($sql)) 
                          {
                             while ($row = $result->fetch_assoc()) {
                               
                                  $posts[] = $row; 
                             
                             }
                          }
                          else 
                          {

                                echo $this->dbh->error;

                                die();
                          }

                          $result->free();

                          return $posts;
             }

             public function getPostByAjax($posts,$id,$taggId)
             {
               
                  $sql = "Select `post_title`, `category`, `post`, `post_date`, `tag`, `posts`.`post_id`, `photo_path`  
                       from `posts` 
                       inner join `post_and_tags` 
                       on `posts`.`post_id` = `post_and_tags`.`post_id`
                       inner join `tags`
                       on `tags`.`tag_id` = `post_and_tags`.`tag_id`
                       inner join `post_fotos`
                       on `posts`.`post_id` = `post_fotos`.`post_id`
                       inner join `category`
                       on `posts`.`category_id` = `category`.`category_id` 
                       where `post_and_tags`.`tag_id` > ".$this->dbh->real_escape_string($taggId)." AND `posts`.`post_id` > ".$this->dbh->real_escape_string($taggId)." limit 1";
                       
                  if ($result = $this->dbh->query($sql)) 
                    {
                       
                        if ($result->num_rows > 0) 
                       {
                          
                          while ($row = $result->fetch_assoc()) 
                          {
                               
                             $posts[] = $row; 
                             
                          }
                    }
                      
                    else 
                    {

                          echo $this->dbh->error;

                          die();
                    }

                    $result->free();
                    return $posts;

             
             }
           }

           public function getUsedTaggs($taggs)
           {
               $sql = "SELECT `tags`.`tag_id`, `tag`, count(`post_and_tags`.`tag_id`) as `num` 
                               from `tags` 
                               inner join `post_and_tags` 
                               on `tags`.`tag_id` = `post_and_tags`.`tag_id` 
                               group by `post_and_tags`.`tag_id` 
                               order by `num` DESC";

                       if ($result = $this->dbh->query($sql)) 
                       {
                            while ($row = $result->fetch_assoc()) 
                            {
                                 $taggs[] = $row;
                            }

                            $result->free();

                       }
                       else 
                       {
                              echo $this->dbh->error;
                              die();
                       }

                       return $taggs;
           }

           public function getPostById($post, $id)
           {
              $sql = "Select `post_title`, `post`, `post_date`, `posts`.`post_id`, `photo_path`  
                      from `posts` 
                      inner join `post_fotos`
                      on `posts`.`post_id` = `post_fotos`.`post_id` 
                      where `posts`.`post_id` = ".$this->dbh->real_escape_string($id). " group by `posts`.`post_id`";

                      if ($result = $this->dbh->query($sql)) {
                        
                          while ($row = $result->fetch_assoc()) {
                            
                               $post[] = $row;
                          }

                          $result->free();
                      }
                      else 
                      {
                        echo $this->dbh->error;
                              die();  
                      }

                      return $post;
           }
            
            public function checkIfRowExists($ip, $flagg, $id)
            {
               $sql = "SELECT EXISTS(SELECT * FROM `post_visitations` WHERE `ip_address` = '$ip' and `post_id` = $id as `exists`)";

                $result = $this->dbh->query($sql);
                


                return $result;
            }

            public function insertLastSeenPostId($postId,$ip)
            {
                $sql = "insert into `post_visitations`(`post_id`,`ip_address`) 
                values(".$this->dbh->real_escape_string($postId).",'$ip')";

                $this->dbh->query($sql);
                echo $this->dbh->error;

            }

            public function selectLastVistdPosts($results,$ids)
            {
               $sql = "Select `post_title`,`post_date`,`post_id`   
                      from `posts` 
                      where `post_id` in ($ids)";

                      if ($result = $this->dbh->query($sql)) 
                      {
                          while ($row = $result->fetch_assoc()) 
                          {
                             $results[] = $row;
                          }

                          $result->free();
                      }
                      else 
                      {
                           echo $this->dbh->error;
                           die();
                      }

                      return $results;
            }

            final private function __clone()
           {

           }

           function __destruct()
           {

                 $this->dbh->close();
           }

      }


       
?>