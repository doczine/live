<?php

include('db.php');

//$doc = strip_tags(stripslashes(($_GET['doc'])));

$conn = db_connect_100();
$conn1 = db_connect_replicate();

$i = 0;
do {
$doc = "";

$i = $i + 1;

$query = "SELECT `system_file_name` FROM `docunator`.`file_transferred` WHERE `file_transferred`.`replicate_130` = 'NULL' LIMIT 1;";
	
	if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $doc);
		while (mysqli_stmt_fetch($stmt)) {
			echo $doc;
			echo " not replicated <br>";	
		}
		mysqli_stmt_close($stmt);
	}

$query = "SELECT `system_file_name`, `file_size`, `file_timestamp`, `file_mime_type`, `file_extension` FROM `docunator`.`file` WHERE `file`.`system_file_name` ='".$doc."';";

if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $folderName, $file_size, $mysqltime, $file_mime_type, $file_extension);
		while (mysqli_stmt_fetch($stmt)) {
		}
		mysqli_stmt_close($stmt);
	}
	
echo $folderName;
	
$query = "SELECT `file_transferred`, `indexed`, `seo_term`, `meta_data`, `replicate_130` FROM `docunator`.`file_transferred` WHERE `file_transferred`.`system_file_name` ='".$doc."';";

if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $cmd_result, $indexed, $seo_term, $meta_data, $replicate_130);
		while (mysqli_stmt_fetch($stmt)) {
		}
		mysqli_stmt_close($stmt);
	}	
	
$query = "SELECT `file_transferred`, `indexed` FROM `docunator`.`file_title` WHERE `file_title`.`system_file_name` ='".$doc."';";

if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $file_title, $description);
		while (mysqli_stmt_fetch($stmt)) {
		}
		mysqli_stmt_close($stmt);
	}	

$query = "SELECT `rights_id` FROM `docunator`.`file_permission` WHERE `file_permission`.`system_file_name` ='".$doc."';";

if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $rights);
		while (mysqli_stmt_fetch($stmt)) {
		}
		mysqli_stmt_close($stmt);
	}	
	

$query = "SELECT `user_name`, `user_file_name`, `short_name`, `user_ip` FROM `docunator`.`user_file` WHERE `user_file`.`system_file_name` ='".$doc."';";

if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $user, $new_file_name, $short_file_name, $user_ip);
		while (mysqli_stmt_fetch($stmt)) {
		}
		mysqli_stmt_close($stmt);
	}	
	
$query = "SELECT `file_hit_count` FROM `docunator`.`file_hitcounter` WHERE `file_hitcounter`.`system_file_name` ='".$doc."';";

if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $hitcounter);
		while (mysqli_stmt_fetch($stmt)) {
		}
		mysqli_stmt_close($stmt);
	}	
	
	
$query = "SELECT `url`, `seoterm` FROM `docunator`.`file_url` WHERE `file_url`.`system_file_name` ='".$doc."';";

if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $url, $seoterm);
		while (mysqli_stmt_fetch($stmt)) {
		}
		mysqli_stmt_close($stmt);
	}	
		
	
$query = "SELECT `meta_data` FROM `docunator`.`file_metadata` WHERE `file_metadata`.`system_file_name` ='".$doc."';";

if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $array_json);
		while (mysqli_stmt_fetch($stmt)) {
		}
		mysqli_stmt_close($stmt);
	}	
	
	
$query = "SELECT `file_size`, `file_timestamp`, `file_mime_type`, `file_extension` FROM `docunator`.`file_counter` WHERE `file_counter`.`system_file_name` ='".$doc."';";

if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $file_size, $mysqltime, $file_mime_type, $file_extension);
		while (mysqli_stmt_fetch($stmt)) {
		}
		mysqli_stmt_close($stmt);
	}	
	
$query = "SELECT `session_id`, `session_data`, `expires` FROM `docunator`.`sessions`;";

if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $session_id, $session_data, $expires);
		while (mysqli_stmt_fetch($stmt)) {		
		
			if ($stmt = mysqli_prepare($conn1, "INSERT INTO `docunator`.`sessions` (`session_id`, `session_data`, `expires`) VALUES (?,?,?)")); {
				mysqli_stmt_bind_param($stmt, "sss", $session_id, $session_data, $expires);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_close($stmt);
			}		
		
		}
		mysqli_stmt_close($stmt);
	}	

		if ($stmt = mysqli_prepare($conn1, "INSERT INTO `docunator`.`file` (`system_file_name`,`file_size`,`file_timestamp`,`file_mime_type`,`file_extension`) VALUES (?,?,?,?,?)")); {
			mysqli_stmt_bind_param($stmt, "sssss", $folderName, $file_size, $mysqltime, $file_mime_type, $file_extension);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		
		$indexed = "Y";
		if ($stmt = mysqli_prepare($conn1, "INSERT INTO `docunator`.`file_transferred` (`system_file_name`,`file_transferred`,`indexed`) VALUES (?,?,?)")); {
			mysqli_stmt_bind_param($stmt, "sss", $folderName, $cmd_result, $indexed);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}	
		
		if ($stmt = mysqli_prepare($conn1, "INSERT INTO `docunator`.`file_title` (`system_file_name`,`file_title`,`file_description`) VALUES (?,?,?)")); {
			mysqli_stmt_bind_param($stmt, "sss", $folderName, $file_title, $description);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}

		if ($stmt = mysqli_prepare($conn1, "INSERT INTO `docunator`.`file_permission` (`system_file_name`,`rights_id`) VALUES (?,?)")); {
			mysqli_stmt_bind_param($stmt, "si", $folderName, $rights);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		if ($stmt = mysqli_prepare($conn1, "INSERT INTO `docunator`.`user_file` (`user_name`,`system_file_name`,`user_file_name`, `short_name`, `user_ip`) VALUES (?,?,?,?,?)")); {
			mysqli_stmt_bind_param($stmt, "sssss", $user, $folderName, $new_file_name, $short_file_name, $user_ip);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		if ($stmt = mysqli_prepare($conn1, "INSERT INTO `docunator`.`file_hitcounter` (`system_file_name`,`file_hit_count`) VALUES (?,?)")); {
			mysqli_stmt_bind_param($stmt, "si", $folderName, $hitcounter);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}	
		if ($stmt = mysqli_prepare($conn1, "INSERT INTO `docunator`.`file_url` (`system_file_name`,`url`,`seoterm`) VALUES (?,?,?)")); {
			mysqli_stmt_bind_param($stmt, "sss", $folderName, $url, $seoterm);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}

		if ($stmt = mysqli_prepare($conn1, "INSERT INTO `docunator`.`file_metadata` (`system_file_name`,`meta_data`) VALUES (?,?)")); {
			mysqli_stmt_bind_param($stmt, "ss", $folderName, $array_json);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		if ($stmt = mysqli_prepare($conn1, "INSERT INTO `docunator`.`file_counter` (`system_file_name`, `file_size`, `file_timestamp`, `file_mime_type`, `file_extension`) VALUES (?,?,?,?,?)")); {
			mysqli_stmt_bind_param($stmt, "sssss", $folderName, $file_size, $mysqltime, $file_mime_type, $file_extension);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}



	$query = "UPDATE `docunator`.`file_transferred` SET `replicate_130` = 'Y' WHERE `file_transferred`.`system_file_name` = '".$doc."';";

	if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		}	

} while ($i < 100000);

?>
