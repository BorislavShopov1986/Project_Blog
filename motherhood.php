<?php
        require_once "includes.php";
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

        
        $dbM = DbModel::getInstance();

        $archive = array();

        
        $archive = $dbM->getArchive($archive);
         
        $dataDb = array();

        $dataDb = $dbM->getPostsByCategory("Motherhood",$dataDb);

      require_once "motherhood.view.php";
?>