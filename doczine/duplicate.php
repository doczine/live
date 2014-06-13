<?php
include("db.php");

$urlindex = "";

$conn = db_connect_100();
$conn1 = db_connect_replicate();
	 
$i = 0;
do {
    $i++;

/*
$query = "SELECT `system_file_name` FROM `docunator`.`file_transferred` WHERE `file_transferred`.`search_txt` IS NULL LIMIT 1;";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $system_file_name);
    while (mysqli_stmt_fetch($stmt)) {
    
    }
    mysqli_stmt_close($stmt);
}
*/

$query = "SELECT `search_table`.`system_file_name`, COUNT(*) FROM `docunator`.`search_table` WHERE `file_seo`.`carrot_seo_term` LIKE '".$term."' GROUP BY carrot_seo_term;";

//$query = "SELECT `file_seo`.`carrot_seo_term`, COUNT(*) FROM `docunator`.`file_seo` WHERE `file_seo`.`carrot_seo_term` LIKE '".$term."' GROUP BY carrot_seo_term;";

$query = "SELECT `system_file_name` FROM `docunator`.`file_snippet` INNER JOIN `docunator`.`file_transferred` USING ( system_file_name ) WHERE `file_snippet`.`file_snippet` != '' AND `file_transferred`.`search_txt` IS NULL;";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $system_file_name);
    while (mysqli_stmt_fetch($stmt)) {
    
    }
    mysqli_stmt_close($stmt);
}

	$query = "UPDATE `docunator`.`file_transferred` SET `search_txt` = 'Y' WHERE `file_transferred`.`system_file_name` = '".$system_file_name."';";

	if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}

$query = "SELECT `file_counter` FROM `docunator`.`file_counter` WHERE `file_counter`.`system_file_name` = '".$system_file_name."';";

if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $file_counter);
		while (mysqli_stmt_fetch($stmt)) {

		}
		mysqli_stmt_close($stmt);
	}

$query = "SELECT `short_name`, `user_file_name`, `folder` FROM `docunator`.`user_file` WHERE `user_file`.`system_file_name` ='".$system_file_name."';";

if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $short_name, $user_file_name, $folder);
		while (mysqli_stmt_fetch($stmt)) {
		$trim_period = rtrim($short_name, ".");
		$urlindex = "http://localhost/bigdata/".$folder."/".$system_file_name."/".$trim_period.".txt";
		}
		mysqli_stmt_close($stmt);
	}
	
    $file = file_get_contents($urlindex);

	if ($stmt = mysqli_prepare($conn1, "INSERT INTO `docunator`.`search_table` (`system_file_name`, `search`) VALUES (?,?)")); {
		mysqli_stmt_bind_param($stmt, "ss", $system_file_name, $file);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}
	
} while ($i < 100000);
    
?>