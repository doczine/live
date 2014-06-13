<?php
include("db.php");

$urlindex = "";
 
$conn = db_connect();
$conn1 = db_connect_replicate();
$conn2 = db_connect();

$i = 0;
do {
    $i++;
	
	$query = "SELECT carrot_seo_term FROM `docunator`.`file_seo` GROUP BY carrot_seo_term;";

	if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $seo_term);
		while (mysqli_stmt_fetch($stmt)) {

			$query = "SELECT `system_file_name` FROM `docunator`.`search_table` WHERE `search_table`.`search` LIKE '%".$seo_term."%';";

			echo $query;

			if ($stmt = mysqli_prepare($conn1, $query)) {
				mysqli_stmt_execute($stmt);
				mysqli_stmt_bind_result($stmt, $system_file_name);
				while (mysqli_stmt_fetch($stmt)) {
									
						
					if ($stmt = mysqli_prepare($conn2, "INSERT INTO `docunator`.`file_seo` (`system_file_name`, `carrot_seo_term`) VALUES (?,?)")); {
					mysqli_stmt_bind_param($stmt, "ss", $system_file_name, $seo_term);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_close($stmt);
					}
						
				}
				mysqli_stmt_close($stmt);
			}
		
		}
		mysqli_stmt_close($stmt);
	}

	echo $seo_term;
	echo $system_file_name;

} while ($i < 10);
    
?>