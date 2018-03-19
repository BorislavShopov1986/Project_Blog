<?php
      function  postOnDay($date)
      {
      	    
      	      

			   $time_ago = strtotime($date);
			   $cur_time   = time();
			   $time_elapsed   = $cur_time - $time_ago;
			   $seconds    = $time_elapsed ;
			   $minutes    = round($time_elapsed / 60 );
			   $hours      = round($time_elapsed / 3600);
			   $days       = round($time_elapsed / 86400 );
			   $weeks      = round($time_elapsed / 604800);
			   $months     = round($time_elapsed / 2600640 );
			   $years      = round($time_elapsed / 31207680 );
			   // Seconds
			  
			  if($seconds <= 60)
			   {
			       echo "Hi";
			       return "just now";
			   }
			   //Minutes
			   else if($minutes <=60)
			   {
			       echo "By";
			       if($minutes==1)
			       {
			           return "one minute ago";
			       }
			       else
			       {
			           return "$minutes minutes ago";
			       }
			   }
			   //Hours
			   else if($hours <=24)
			   {
			       if($hours==1)
			       {
			           return "an hour ago";
			       }
			       else
			       {
			           return "$hours hrs ago";
			       }
			   }
			   //Days
			   else if($days <= 7)
			   {
			       if($days==1)
			       {
			           return "yesterday";
			       }
			       else
			       {
			           return "$days days ago";
			       }
			   }
			   //Weeks
			   else if($weeks <= 4.3)
			   {
			       if($weeks==1)
			       {
			           return "a week ago";
			       }
			       else
			       {
			           return "$weeks weeks ago";
			       }
			   }
			   //Months
			   else if($months <=12)
			   {
			       if($months==1)
			       {
			           return "a month ago";
			       }
			       else
			       {
			           return "$months months ago";
			       }
			   }
			   //Years
			   else
			   {
			       if($years==1)
			       {
			           return "one year ago";
			       }
			       else
			       {
			           return "$years years ago";
			       }
			   }
			  
      }

      function highlightkeyword($str, $search) 
      {
            $highlightcolor = "#cd7f32";
		    $occurrences = substr_count(mb_strtolower($str,'UTF-8'),mb_strtolower($search,'UTF-8'));
		    $newstring = $str;
		    $match = array();
		 
		    for ($i=0;$i<$occurrences;$i++) {
		        $match[$i] = mb_stripos($str, $search, $i,'UTF-8');
		        $match[$i] = mb_substr($str, $match[$i], mb_strlen($search,'UTF-8'),'UTF-8');
		        $newstring = str_replace($match[$i], '[#]'.$match[$i].'[@]', strip_tags($newstring));
		    }
		 
		    $newstring = str_replace('[#]', '<span style="background-color: '.$highlightcolor.';">', $newstring);
		    $newstring = str_replace('[@]', '</span>', $newstring);
		    return $newstring;
 
}
?>