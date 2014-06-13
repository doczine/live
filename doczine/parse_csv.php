<?php

include("db.php");
$conn = db_connect();

$query = "SELECT `delete` FROM `delete`.`delete` LIMIT 1;";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $delete);
    while (mysqli_stmt_fetch($stmt)) {

		$system_id = $delete;
    }
    mysqli_stmt_close($stmt);
}

$system_id = $delete;

				$query = "DELETE FROM `docunator`.`user_file` WHERE `user_file`.`system_file_name` = '".$system_id."';";

				if ($stmt = mysqli_prepare($conn, $query)) {
					mysqli_stmt_execute($stmt);
					mysqli_stmt_close($stmt);
				}

				$query = "DELETE FROM `docunator`.`file_url` WHERE `file_url`.`system_file_name` = '".$system_id."';";

				if ($stmt = mysqli_prepare($conn, $query)) {
					mysqli_stmt_execute($stmt);
					mysqli_stmt_close($stmt);
				}


				$query = "DELETE FROM `docunator`.`file_transferred` WHERE `file_transferred`.`system_file_name` = '".$system_id."';";

				if ($stmt = mysqli_prepare($conn, $query)) {
					mysqli_stmt_execute($stmt);
					mysqli_stmt_close($stmt);
				}


				$query = "DELETE FROM `docunator`.`file_title` WHERE `file_title`.`system_file_name` = '".$system_id."';";

				if ($stmt = mysqli_prepare($conn, $query)) {
					mysqli_stmt_execute($stmt);
					mysqli_stmt_close($stmt);
				}


				$query = "DELETE FROM `docunator`.`file_taxonomy` WHERE `file_taxonomy`.`system_file_name` = '".$system_id."';";

				if ($stmt = mysqli_prepare($conn, $query)) {
					mysqli_stmt_execute($stmt);
					mysqli_stmt_close($stmt);
				}


				$query = "DELETE FROM `docunator`.`file_permission` WHERE `file_permission`.`system_file_name` = '".$system_id."';";

				if ($stmt = mysqli_prepare($conn, $query)) {
					mysqli_stmt_execute($stmt);
					mysqli_stmt_close($stmt);
				}


				$query = "DELETE FROM `docunator`.`file_hitcounter` WHERE `file_hitcounter`.`system_file_name` = '".$system_id."';";

				if ($stmt = mysqli_prepare($conn, $query)) {
					mysqli_stmt_execute($stmt);
					mysqli_stmt_close($stmt);
				}


				$query = "DELETE FROM `docunator`.`file_comment` WHERE `file_comment`.`system_file_name` = '".$system_id."';";

				if ($stmt = mysqli_prepare($conn, $query)) {
					mysqli_stmt_execute($stmt);
					mysqli_stmt_close($stmt);
				}

				$query = "DELETE FROM `docunator`.`file_counter` WHERE `file_counter`.`system_file_name` = '".$system_id."';";

				if ($stmt = mysqli_prepare($conn, $query)) {
					mysqli_stmt_execute($stmt);
					mysqli_stmt_close($stmt);
				}
		

				$query = "DELETE FROM `docunator`.`file` WHERE `file`.`system_file_name` = '".$system_id."';";

				if ($stmt = mysqli_prepare($conn, $query)) {
					mysqli_stmt_execute($stmt);
					mysqli_stmt_close($stmt);
				}

				$query = "DELETE FROM `docunator`.`file_location` WHERE `file`.`system_file_name` = '".$system_id."';";

				if ($stmt = mysqli_prepare($conn, $query)) {
					mysqli_stmt_execute($stmt);
					mysqli_stmt_close($stmt);
				}

				$query = "DELETE FROM `docunator`.`file_metadata` WHERE `file_metadata`.`system_file_name` = '".$system_id."';";

				if ($stmt = mysqli_prepare($conn, $query)) {
					mysqli_stmt_execute($stmt);
					mysqli_stmt_close($stmt);
				}

				$query = "DELETE FROM `docunator`.`file_seo` WHERE `file_seo`.`system_file_name` = '".$system_id."';";

				if ($stmt = mysqli_prepare($conn, $query)) {
					mysqli_stmt_execute($stmt);
					mysqli_stmt_close($stmt);
				}	

				$query = "DELETE FROM `docunator`.`kmeans_file_seo` WHERE `file_seo_kmeans`.`system_file_name` = '".$system_id."';";

				if ($stmt = mysqli_prepare($conn, $query)) {
					mysqli_stmt_execute($stmt);
					mysqli_stmt_close($stmt);
				}	

				$query = "DELETE FROM `docunator`.`file_seo` WHERE `file_seo_sdc`.`system_file_name` = '".$system_id."';";

				if ($stmt = mysqli_prepare($conn, $query)) {
					mysqli_stmt_execute($stmt);
					mysqli_stmt_close($stmt);
				}	

				$query = "DELETE FROM `docunator`.`file_seo` WHERE `file_seo_lingo`.`system_file_name` = '".$system_id."';";

				if ($stmt = mysqli_prepare($conn, $query)) {
					mysqli_stmt_execute($stmt);
					mysqli_stmt_close($stmt);
				}	

				$query = "DELETE FROM `docunator`.`file_snippet` WHERE `file_snippet`.`system_file_name` = '".$system_id."';";

				if ($stmt = mysqli_prepare($conn, $query)) {
					mysqli_stmt_execute($stmt);
					mysqli_stmt_close($stmt);
				}	

		
				$rmsolr = "curl -H 'Content-Type: text/xml' http://192.168.1.150:8983/solr/update --data-binary '<delete><id>".$system_id."</id></delete>'";

				system($rmsolr, $retval);
			
				$query = "DELETE FROM `delete`.`delete` WHERE `delete`.`delete` = '".$system_id."';";

				if ($stmt = mysqli_prepare($conn, $query)) {
					mysqli_stmt_execute($stmt);
					mysqli_stmt_close($stmt);
				}
				
				echo $system_id;
            
?>