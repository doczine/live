<?php

function display_tag_terms()
{

$conn = db_connect();

$query = "SELECT `file_seo`.`carrot_seo_term`, COUNT(*) FROM `docunator`.`file_seo` GROUP BY `file_seo`.`carrot_seo_term`;";

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
			}
			if($fsize <= 200) {
				$fresize = "40";
			}
			if($fsize <= 50)	{
				$fresize = "36";
			}				
			if($fsize <= 25)	{
				$fresize = "32";
			}	
			if($fsize <= 20)	{
				$fresize = "28";
			}
			if($fsize <= 15)	{
				$fresize = "24";
			}				
			if($fsize <= 10)	{
				$fresize = "20";
			}				
			if($fsize <= 6)	{
				$fresize = "18";
			}					
			if($fsize <= 3)	{
				$fresize = "14";
			}
			if($fsize <= 2)	{
				$fresize = "12";
			}
			if($fsize <= 1)	{
				$fresize = "10";
			}




			
    	$color = sprintf("#%x%x%x", rand(0,255), rand(0,255), rand(0,255));    
        echo "<a style='font-size: ".$fresize."pt; color:".$color.";' href='http://doczine.com/category_list.php?term_1=".$carrot_seo_term."' rel='0.1'>".$carrot_seo_term;
		echo " (";
		echo $grr;
		echo ")";
        echo "</a>";
		echo "  	";        

			}
		}
			mysqli_stmt_close($stmt);
			echo "</div>";
	}


?>