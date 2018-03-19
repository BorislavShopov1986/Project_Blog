<?php 
          session_start();
         require_once "includes.php";
         
        

        $data = array();
        $db = DB::getInstance();  
         
         $data = $db->postByCategories($data);

         $taggs = array();

         $taggs = $db->getUsedTaggs($taggs);
          
          $posts = array();

          $results = array(); 
         $lastVisitedPosts = " ";
           
           if (!empty($_SESSION['postsId'])) 
           {
              $ids = implode(',', $_SESSION['postsId']);
              $results  = $db->selectLastVistdPosts($results, $ids);
           }

          //$results  = $db->selectLastVistdPosts($results, implode(',', $_SESSION['postsId']));

          $po = " ";

          $dbm = DbModel::getInstance();


          $post = " ";
          $archive = array();

          $archive = $dbm->getArchive($archive);

 
          

          
          switch ($_GET['page']) {
          	
          	case 'tagg':

                        $id =  intval($_GET['id']);
                        $posts = $db->getPostByTagg($posts, $id);

                        $post = " ";

                        $lastId = " ";  
          		
          		break;

          	
          	default:
          		       header("Location: ./index.php");
          		break;
          }
   

       require_once "./posts.view.php";    
?>