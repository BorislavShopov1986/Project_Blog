<?php
    session_start();
   
        require_once "./includes.php";
        require_once "./setphpmailer.php";

    if(filter_var($_GET['id'], FILTER_VALIDATE_INT))
    {   
        $id = (int) htmlentities($_GET['id']);
        
        if (empty($_SESSION['postsId'])) 
         {
              
              $_SESSION['postsId'] = array();
          }
          
            
           if (!in_array($id, $_SESSION['postsId'])) 
           {
                $_SESSION['postsId'][] = $id;  
           }

           
            

         //var_dump($_SESSION['postsId']);

        $data = array();
        $db = DB::getInstance();  
         
        $data = $db->postByCategories($data);

        $taggs = array();

        $taggs = $db->getUsedTaggs($taggs);

        $post = array();

        

         $post = $db->getPostById($post,$id);
         $dbm = DbModel::getInstance();

          $archive = array();

          $archive = $dbm->getArchive($archive);              
          
      
        $lastVisitedPosts = " ";
        $results = array(); 
       if (!empty($_SESSION['postsId'])) 
           {
              $ids = implode(',', $_SESSION['postsId']);
              $results  = $db->selectLastVistdPosts($results, $ids);
           }

        $po = " ";

        $arrComments = array();

       $arrComments =  $dbm->getComments($id,$arrComments);        
    }
    
    else 
    {
        header("Location: ./index.php");
    }
       
       require_once "setComments.php";        
      $arrComments = array();

       $arrComments =  $dbm->getComments($id,$arrComments);
  
        require_once "./post.view.php";
?>