<?php

function display_tag_terms()
{

$conn = db_connect();

$query = "SELECT `file_seo`.`carrot_seo_term`, COUNT(*) FROM `docunator`.`file_seo` GROUP BY `file_seo`.`carrot_seo_term` ORDER BY RAND();";

    	echo "<div id='tagcloud'>";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $carrot_seo_term, $count);
    while (mysqli_stmt_fetch($stmt)) {
    
    	$grr = $count;
	    	
    	$count = $count * (rand(20,200));
    	$count = substr($count,0,3);
		
			$fsize = $grr;
			
						if($fsize <= 300) {
				$fresize = "50";
				$fcolor = "#D3643B";
			}
			if($fsize <= 200) {
				$fresize = "40";
				$fcolor = "#403B33";
			}
			if($fsize <= 50)	{
				$fresize = "36";
				  $fcolor = "#94C7B6";
			}				
			if($fsize <= 25)	{
				$fresize = "32";
				  $fcolor = "#D6E1C7";
			}	
			if($fsize <= 20)	{
				$fresize = "28";
				  $fcolor = "#EDEBE6";
			}
			if($fsize <= 15)	{
				$fresize = "24";
				  $fcolor = "Green";
			}				
			if($fsize <= 10)	{
				$fresize = "20";
				  $fcolor = "LimeGreen";
			}				
			if($fsize <= 6)	{
				$fresize = "18";
				  $fcolor = "DarkGreen";
			}					
			if($fsize <= 3)	{
				$fresize = "14";
				  $fcolor = "Blue";
			}
			if($fsize <= 2)	{
				$fresize = "12";
				  $fcolor = "LightBlue";
			}
			if($fsize <= 1)	{
				$fresize = "10";
				  $fcolor = "LightBlue";
			}

		
    	$color = sprintf("#%x%x%x", rand(0,255), rand(0,255), rand(0,255));    

        echo "<a style='font-size: ".$fresize."pt; color:".$fcolor.";' href='http://doczine.com/category_list.php?term_1=".$carrot_seo_term."' 
rel='0.1'>".$carrot_seo_term;
		#echo " (";
		#echo $grr;
		#echo ")";
        echo "</a>";
		echo "  	";        

			}
		}
			mysqli_stmt_close($stmt);
			echo "</div>";
	}


?>
