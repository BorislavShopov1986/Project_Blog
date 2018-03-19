<?php 
         session_start();
         require_once "includes.php";

        $data = array();
        $db = DB::getInstance();  
         
        $data = $db->postByCategories($data);

        $taggs = array();

        $taggs = $db->getUsedTaggs($taggs);

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


        $dbResults = array();
        $month =  (int)$_GET['month']; 
        $year = (int)$_GET['year'];

        $dbResults = $dbm->getPostsByMonth($month,$dbResults, $year);

        $published = " "; 
              
        require_once "archive.view.php";

?>