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

        $tablePosts = "<h3>Archive</h3> 
                           <table>
                               <tbody>";
        $archive = $dbM->getArchive($archive);
         
        $dataDb = array();

        $dataDb = $dbM->getPostsByCategory("Recipes",$dataDb);

      require_once "recipes.view.php";