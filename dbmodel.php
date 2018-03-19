<?php 
     
     class DbModel extends DB
     {
     


     	public function getArchive($posts)
     	{
     		$sql = "SELECT `post_id`,  
			count(`post_id`) as `sum`, 
			`post_date`, month(`post_date`) as `num`, 
			monthname(`post_date`) as `month`, year(`post_date`) as `year`,
			`category_id` 
			FROM `posts` 
			where `post_date` < DATE_SUB(curdate(), INTERVAL 2 WEEK) 
			group by  month(`post_date`)
			Order by  `num` DESC";

			if ($result = $this->dbh->query($sql)) 
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

			//var_dump($posts);
			return $posts;
     	}

        

        public function getPostsByMonth($month,$dbResults, $year)
        {
        	
             $sql = "SELECT `post_title`, 
			`posts`.`post_id`, 
			`post`, `photo_path` as `fotos`, 
			`post_date`, monthname(`post_date`) as `monthname` from `posts` 
			 inner join `post_fotos` 
			 on `posts`.`post_id` = `post_fotos`.`post_id` 
			 where month(`post_date`) = ".$this->dbh->real_escape_string($month) . " AND year(`post_date`) = ".$this->dbh->real_escape_string($year);

             if ($result = $this->dbh->query($sql)) 
             {
              	
                  while ($row = $result->fetch_assoc()) 
                  {
                  	
                  	  $dbResults[] = $row;
                  }
              }
              else 
              {
                 echo $this->dbh->error;
				
				 die(); 	
              } 

              $result->free();

              return $dbResults;

        }

        public function setComments($postId, $name, $text)
        {
             
              
              $sql = "INSERT INTO `comments`(`post_id`, `name`, `comment_date`, `c_text`) 
                      VALUES (".$this->dbh->real_escape_string($postId).",'".$this->dbh->real_escape_string($name)."',Now(), '".$this->dbh->real_escape_string($text)."')";

              $this->dbh->set_charset("utf8");
              $this->dbh->query($sql);
              echo $this->dbh->error;

        }

        public function getComments($id,$arrComments)
        {
          
              $sql = "SELECT  `comments`.`ID` as `ID`, `name`, `comment_date`, `c_text` 
                      from `comments` 
                      inner join `posts` 
                      on `posts`.`post_id` = `comments`.`post_id` 
                      where `posts`.`post_id` = ".$this->dbh->real_escape_string($id)."
                      ORDER BY `comment_date` DESC";

                      $this->dbh->set_charset("utf8");
                      if ($result = $this->dbh->query($sql)) 
                      {
                          while ($row = $result->fetch_assoc()) 
                          {
                             $arrComments[] = $row;
                          }
                      }
                      else 
                      {
                         die("Error: ".$this->dbh->error);
                      }
                       $result->free();
                      return $arrComments;
        }

        public function getMostCommented($arrMostCommented)
        {
           $sql = "SELECT `post_title`, `category`,`posts`.`category_id` as `category_id`, 
                          `post`, `post_date`, count(`comments`.`post_id`) as `num`,
                          `comments`.`post_id` as `id`, `photo_path`
                   from `posts`
                   inner join `post_fotos`
                   on `posts`.`post_id` = `post_fotos`.`post_id`
                   inner join `comments`
                   on `posts`.`post_id` = `comments`.`post_id`
                   inner join `category`
                   on `posts`.`category_id` = `category`.`category_id`
                   group by `comments`.`post_id`
                   order by `num` desc Limit 5";

            if ($result = $this->dbh->query($sql)) 
            {
                  while ($row = $result->fetch_assoc()) 
                  {
                     $arrMostCommented[] = $row;
                  }
            }
            else 
            {
                   die("Error: ".$this->dbh->error); 
            }
             $result->free();
            return $arrMostCommented;       
        }

        public function getDefaultSearchValues($searchValues)
        {
           
           $sql = "SELECT `posts`.`post_id` as `post_id`, `category`.`category_id` as `category_id`, `post`, `category` ,`post_date`, `photo_path`, `post_title` 
                   from `posts` 
                   inner join `post_fotos` 
                   on `posts`.`post_id` = `post_fotos`.`post_id` 
                   inner join `category` on `posts`.`category_id` = `category`.`category_id`
                   Limit 5";

                   if ($result = $this->dbh->query($sql)) 
                   {
                       while ($row = $result->fetch_assoc()) 
                       {
                          $searchValues[] = $row;
                       }
                   }
                   else 
                   {
                        die("Error: ".$this->dbh->error); 
                   }
                 
                 $result->free();
                 return $searchValues; 
        }

        public function getSearchQuery($searchBy,$arrQValues)
        {
            
            $searchBy = $this->dbh->real_escape_string($searchBy);
            
          
            $arrQValues = array();
            
            
           //echo $this->dbh->error; 
            //var_dump($searchBy);

            

            $sql = "SELECT `posts`.`post_id` as `post_id`,`post`, `category`,`category`.`category_id` as `category_id`, `post_date` as `date`, `photo_path`, `post_title` 
                    from `posts` 
                    inner join `post_and_tags` 
                    on `posts`.`post_id` = `post_and_tags`.`post_id` 
                    inner join `tags` 
                    on `tags`.`tag_id` = `post_and_tags`.`tag_id` 
                    inner join `post_fotos` 
                    on `posts`.`post_id` = `post_fotos`.`post_id` 
                    inner join `category` on `posts`.`category_id` = `category`.`category_id`
                    Where `category` = '$searchBy' OR `post` Like '%$searchBy%' OR `tag` = '$searchBy' OR `post_title` = '$searchBy' 
                    GROUP BY `posts`.`post_id`
                    order by `posts`.`post_id` DESC
                    
                    ";

              
             $this->dbh->set_charset("utf8");
            if ($result = $this->dbh->query($sql)) 
            {

                 

                while ($row = $result->fetch_assoc()) 
                {
                    $arrQValues[] = $row;
                    
                }
            }
            else 
            {
               die("Error: ".$this->dbh->error);
            }

            $result->free();
            return $arrQValues;        
        }
        

        public function getLastComments($arrComments)
        {
           $sql = "SELECT distinct(`ID`) as `comment_id`, `posts`.`post_id` as `post_id`, `name` , `comments`.`ID` as `id`, `post_title` 
                   from `comments` 
                   inner join `posts` 
                   on `posts`.`post_id` = `comments`.`post_id` 
                   order by `comment_date` DESC Limit 4";

                 
               $this->dbh->set_charset("utf8");
               if ($result = $this->dbh->query($sql)) 
               {
                  while ($row = $result->fetch_assoc()) 
                  {
                     $arrComments[] = $row;
                  }
               } 
               else 
               {
                   die("Error: ".$this->dbh->error);    
               }

               $result->free(); 
               return $arrComments;

        }
         
         public function getPostsByCategory($category,$data, $id = 0)
         {
               $sql = "SELECT `post_title`,category,`posts`.`post_id` as `post_id`, `post`, `post_date`, `photo_path` 
                       from `posts` 
                       inner join `category` 
                       on `posts`.`category_id` = `category`.`category_id` 
                       inner join `post_fotos` 
                       on `posts`.`post_id` = `post_fotos`.`post_id` 
                       where `category` = '".$this->dbh->real_escape_string($category)."' AND  `posts`.`post_id` > $id
                       Limit 1";

                       if ($result = $this->dbh->query($sql)) 
                       {
                          while ($dataRow = $result->fetch_assoc()) 
                          {
                             $data[] = $dataRow;

                          }
                       }
                       else 
                       {
                             die("Error: ".$this->dbh->error);   
                      }
                       
                       $result->free();

                       return $data;
         }

         public function getPostsForFeed($data)
         {
               $sql = "SELECT `post_title`, `post_id`, `post`,`post_date` 
                       from  `posts` order by `post_date` DESC Limit 10 ";

               if ($result = $this->dbh->query($sql)) 
               {
                  while ($dataRow = $result->fetch_assoc()) 
                  {
                     $data[] = $dataRow;
                  }
               }
               else 
               {
                     die("Error: ".$this->dbh->error);
               }

               $result->free();

               return $data;                       
         }
         
           public function setEmail($email)
           {
               $sql = "INSERT INTO `suscribers`(`sub_email`, `sub_date`) VALUES ('".$this->dbh->real_escape_string($email)."',NOW())";

                $this->dbh->query($sql);
           }

       
         public function getEmails($data)
         {
            $sql = "SELECT `sub_email` 
                    FROM `suscribers`";

            if($result = $this->dbh->query($sql))
            {
                
                while ($dataRow = $result->fetch_assoc()) 
                {
                   $data[] = $dataRow;
                }
            }
            else 
            {
              die("Error: ".$this->dbh->error);
            }

            $result->free();

            return $data;
         }

       	
          public function setNotifires($postId,$email)
          {
             $sql = "INSERT into `notifier`(`email`,`post_id`) 
                     values('".$this->dbh->real_escape_string($email)."',".$this->dbh->real_escape_string($postId).")";

              $this->dbh->query($sql);
          }




         public function getLastCommentId($id)
         {
             $sql = "SELECT `ID` 
                     from `comments` 
                     order by `ID` desc 
                     Limit 1";

             if ($result = $this->dbh->query($sql)) 
             {
                while ($row = $result->fetch_assoc()) 
                {
                   $id[] = $row;
                }
             }
             else 
             {
                die("Error: ".$this->dbh->error);
             }

             $result->free();

             return $id;         
         }

         public function checkIfPostIdExists($id,$booExists)
         {
             $sql = "SELECT * from `notifier`
                     where `post_id` = ".$this->dbh->real_escape_string($id)." ";

             if ($result = $this->dbh->query($sql)) 
             {
                 
                 $booExists = $result->num_rows; 
             }

             $result->free();

             return $booExists;        
         }


        
         public function getNotifierEmail($data)
         {
            $sql = "SELECT `email` from `notifier`";

            if ($result = $this->dbh->query($sql)) 
            {
               while ($row = $result->fetch_assoc()) 
               {
                  $data[] = $row; 
               }
            }
            else 
            {
               die("Error: ".$this->dbh->error);
            }

               $result->free();
               return $data;
         } 


        public function getIndexPosts($limit, $data)
        {
            $sql = "SELECT `posts`.`post_id` as `post_id`,`post`, `category`,`category`.`category_id` as `category_id`, `post_date` as `date`, `photo_path`, `post_title` 
                    from `posts` 
                    inner join `post_fotos` 
                    on `posts`.`post_id` = `post_fotos`.`post_id` 
                    inner join `category` on `posts`.`category_id` = `category`.`category_id`
                    order by `posts`.`post_id` DESC
                    $limit
                    ";


                    if ($result = $this->dbh->query($sql)) 
                    {
                          while ($row = $result->fetch_assoc()) 
                          {
                              $data[] = $row;
                          }
                    }
                    else 
                    {
                        die("Error: ".$this->dbh->error);
                    }

                    $result->free();
                    return $data; 
        }

        
        public function getDataRows($numRows)
        {
             $sql = "SELECT count(`post_id`) from `posts`";

             if ($result = $this->dbh->query($sql)) 
             {
                  $row = $result->fetch_row();

                  $numRows = $row[0];
             }
             else 
             {
                  die("Error: ".$this->dbh->error);
             }

             $result->free();   
             return $numRows;   
        }   


        function __destruct()
        {

                 $this->dbh->close();
        }
     }

     
?>