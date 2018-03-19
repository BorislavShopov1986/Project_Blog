<?php
      require_once "model.php";

      if (!empty($_POST['addtagg'])) {
      	
          if (!empty($_POST['taggs'])) {
             

              $db = DB::getInstance();
              $db->addTagg($_POST['taggs']);     
           }  
      }
       
       $taggs = array();
       $db = DB::getInstance();
       $taggs = $db->getTaggs($taggs);

      $checkboxes = "<div><label style=\"display: block;\"> Choose Tagg</label>";
      foreach ($taggs as $key) {
      	$checkboxes .= "<input type=\"checkbox\" value=\"".$key['tag_id']."\" name=\"alltaggs[]\"/>".$key['tag'];
      }

      $checkboxes .= "</div>";

      if (!empty($_POST['addCateg'])) {
         
         if (!empty($_POST['category'])) {
             
              
              $db->addCategory($_POST['category']);
         }
       } 

       $category  = array();

       $category = $db->getCategory($category);

       $select = " <label style=\"display: block;\">Choose Category</label><select name=\"choose\">
                    <option>---Choose Category---</option>";

                    foreach ($category as $key) {
                        $select .= "<option name=\"category\" value=\"".$key['Category_ID']."\">$key[category]</option>";
                    }

         $select .= "</select>"; 

         if (!empty($_POST['submit'])) 
         {
              
                 $addPhotos = "INSERT INTO `post_fotos`(`post_id`, `photo_path`) VALUES";

                 //var_dump($_FILES['files']);
              
                 

                 if (!empty($_FILES['files']) && !empty($_POST['title']) && !empty($_POST['alltaggs']) && !empty($_POST['choose']) && !empty($_POST['post'])) {
                   # code...
                 
                 $title = $_POST['title'];
                   $post = $_POST['post'];
                   $category = $_POST['choose'];

                   $db->addPost($title,$post,$category);

                 $countFiles = count($_FILES['files']['tmp_name']);

                 for ($i=0; $i < $countFiles; $i++) { 
                       
                       move_uploaded_file($_FILES['files']['tmp_name'][$i], dirname(__FILE__) . '\Images\\'.$_FILES['files']['name'][$i]);               
                       $addPhotos .= "(".$db->getLastId().",'". 'C:\\\xampp\\\htdocs\\\Images\\\\'.$_FILES['files']['name'][$i]."'),";  
                   
                       
                   }

                   $addPhotos = rtrim($addPhotos, ", ");

                   echo $addPhotos;

                   
                   $countTaggs = count($_POST['alltaggs']);
                    $taggs =  $_POST['alltaggs'];
                   
                   $addTaggs = "Insert into `post_and_tags`(`post_id`,`tag_id`) VALUES";


                   for ($i=0; $i < $countTaggs; $i++) { 
                     
                      $addTaggs .= "(".$db->getLastId().", $taggs[$i]),";      
                   }

                   $addTaggs = rtrim($addTaggs, ', ');

                   
                   $db->insert($addPhotos); 
                   $db->insert($addTaggs);
            }  
              /*
              foreach ($_FILES['files'] as $key) {
                  
                  move_uploaded_file($_FILES['files']['tmp_name'][$key][$i], dirname(__FILE__) . '/Images/'.$_FILES['files']['name'][$key][$i]); 
                   $i++;
              }
              */
         }          

      require_once "controlpanel.view.php";
?>