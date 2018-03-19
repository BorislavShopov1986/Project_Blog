<?php 
     
 $fileContent = file_get_contents("https://www.vesti.bg/rss");

//var_dump($fileContent);

$fileContent = new SimpleXmlElement($fileContent);

$itemFirst = $fileContent->channel->item;

$list = "<div class=\"left-inner-bottom\" ><h3>News</h3>";

$list .= "<img class=\"img\" src=\"".$itemFirst->enclosure['url']."\"/>";


$counter = 1;

$list .= "<div style=\"float: right;\"><ul>";
foreach($itemFirst as $entry) {
    $list .= "<li style=\"margin-bottom: 4px; color: #fff;\">
                    <a class=\"links\" href='$entry->link' id=\"".$entry->enclosure['url']."\" title='$entry->title'>" . $entry->title . "</a>
                    
             </li>";

  if ($counter == 5) 
  {
    break;
  }
  
  $counter++;           
}

$list .= "</ul>
          </div>  
               </div>";

echo $list;

?>