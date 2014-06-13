<?php

include('viewer_functions.php');	

$conn = db_connect();
$conn1 = db_connect_scraper();

$i = 0;
do {
    $i++;
    
$urlindex = "";
$file_new = "";
$system_file_name = "";

$query = "SELECT `system_file_name` FROM `docunator`.`file_transferred` WHERE `file_transferred`.`seo_term` = 'N' LIMIT 1;";

if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $system_file_name);
		while (mysqli_stmt_fetch($stmt)) {
		echo $system_file_name;
		echo "<br>";
		}
		mysqli_stmt_close($stmt);
	}	

$query = "SELECT `system_file_name`, `short_name`, `user_file_name` FROM `docunator`.`user_file` WHERE `user_file`.`system_file_name` ='".$system_file_name."';";

if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $system_file_name, $short_name, $user_file_name);
		while (mysqli_stmt_fetch($stmt)) {
		$trim_period = rtrim($short_name, ".");
		$urlindex = "/var/www/bigdata/".$system_file_name."/".$trim_period.".pdf";
		$file_new = "/var/www/bigdata/".$system_file_name."/".$trim_period.".txt";
		}
		mysqli_stmt_close($stmt);
	}	

		$pdf_text = "pdftotext ".$urlindex." ".$file_new;
		//echo $pdf_text;
		system($pdf_text, $retval5);
		//echo $retval5;
		
$cat = "cat ".$file_new." | tr -d '[:punct:]' | tr ' ' '\n' | tr 'A-Z' 'a-z' | sort | uniq -c | sort -rn";

$sTempUsers = shell_exec($cat);
$aTempUsers = explode("\n", $sTempUsers);

$sUsers = array();
foreach($aTempUsers AS $sUser)
{
$string = $sUser;
$string = trim($string);

$word = strstr($string, ' ');
$number = strstr($string, ' ', true); // As of PHP 5.3.0

//echo $word;
//echo $number;  

	if ($stmt = mysqli_prepare($conn1, "INSERT INTO `scraper`.`seotermcounts` (`seoterm`,`system_file_name`, `seocount`) VALUES (?,?,?);")); {
		mysqli_stmt_bind_param($stmt, "sss", $word, $system_file_name, $number);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}	
	  
}
	$query = "UPDATE `docunator`.`file_transferred` SET `seo_term` = 'Y' WHERE `file_transferred`.`system_file_name` = '".$system_file_name."';";

	if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}	

} while ($i < 55000);

	mysqli_close($conn);

	mysqli_close($conn1);

?>