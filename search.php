<?php
   session_start();
   require_once "includes.php";
   require_once "functions.php";
   mb_internal_encoding("UTF-8");
    
   $isSetQString = 0; 

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



        if (empty($_GET['s'])) 
        {
            $searchValues = array();
            $searchValues = $dbM->getDefaultSearchValues($searchValues); 	
        }
        else 
        {
           $isSetQString = 1;

            $queryString = htmlentities($_GET['s']);

            $arrCChars = array("а","б","в","г","д","е","ж","з","и",
                               "й","к","л","м","н","о","п","р","с",
                               "т","у","ф","х","ц","ч","ш","щ","ъ","ь","ю","я",
                               "А","Б","В","Г","Д","Е","Ж","З","И",
                               "Й","К","Л","М","Н","О","П","Р","С",
                               "Т","У","Ф","Х","Ц","Ч","Ш","Щ","Ъ","ь","Ю","Я"
                             );

            $arrLatinChars = array("а","b","v","g","d","e","j","z","i",
                                    "y","k","l","m","n","o","p","r","s","t",
                                    "u","f","h","ts","ch","sh","sht","a","a","yu","ya",
                                    "A","B","V","G","D","E","J","Z","I",
                                    "Y","K","L","M","N","O","P","R","S","T",
                                    "U","F","H","TS","CH","SH","SHT","A","A","YU","YA");

            $queryString = str_replace($arrCChars, $arrLatinChars, $queryString);


            

            $arrQValues = array();
            $arrQvalues =  $dbM->getSearchQuery($queryString,0,$arrQValues);
            
            

        }


      
     require_once "search.view.php";

?>