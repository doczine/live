<?php
/*
include("db.php");

$docs = strip_tags(stripslashes(($_GET['doc'])));
$conn = db_connect();
$system_id = $docs;
 
$file_folder_name = "/var/www/bigdata/".$system_id;

chmod($file_folder_name, 0777);

rrmdir($file_folder_name);

$file_chmod = "sudo chmod -R 777 ".$file_folder_name;
system($file_chmod, $retval);

$rm_folder = "sudo rm -R -f ".$file_folder_name;
system($rm_folder, $retrm);
		
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


		$query = "DELETE FROM `docunator`.`file` WHERE `file`.`system_file_name` = '".$system_id."';";

		if ($stmt = mysqli_prepare($conn, $query)) {
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		
		$rmsolr = "curl -H 'Content-Type: text/xml' http://192.168.1.150:8983/solr/update --data-binary '<delete><id>".$system_id."</id></delete>'";
		system($rmsolr, $retval);

 function rrmdir($dir) {
   if (is_dir($dir)) {
     $objects = scandir($dir);
     foreach ($objects as $object) {
       if ($object != "." && $object != "..") {
         if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
       }
     }
     reset($objects);
     rmdir($dir);
   }
 } 
*/
?>