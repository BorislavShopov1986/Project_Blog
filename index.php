<?php 
    session_start();
       require_once "includes.php";
        require_once "./pagination.php";

         $data = array();
        $db = DB::getInstance();  
         
         $data = $db->postByCategories($data);

         $taggs = array();

         $taggs = $db->getUsedTaggs($taggs);

         $lastVisitedPosts = " ";
        $results = array(); 
         
        
        if (!empty($_SESSION['postsId'])) 
           {
              $ids = implode(',', $_SESSION['postsId']);
              $results  = $db->selectLastVistdPosts($results, $ids);
           }

        $po = " ";

        
        //$dbM = DbModel::getInstance();

        $archive = array();

       
        $archive = $dbM->getArchive($archive);

        $arrMostCommented = array();
         
        $arrMostCommented = $dbM->getMostCommented($arrMostCommented); 

        $arrComments = array();

        $arrComments = $dbM->getLastComments($arrComments);
          
        $arrIndexPosts = array();
        
        $arrIndexPosts = $dbM->getIndexPosts($limit, $arrIndexPosts);   
        
        require_once "setemail.php";
        require_once "index.view.php";
?>