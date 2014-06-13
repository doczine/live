<?php
 
include("upload_functions.php");
include("db.php");

$conn = db_connect();

$i = 0;
do {
    $i++;
$file_extension = "pdf";
$folderName = namefile($file_extension);
$file_size = "666666";
$mysqltime = date("Y-m-d H:i:s");
$file_mime_type = "application/pdf";
$file_extension = "pdf";
$cmd_result = "309421";
$file_title = "Some really long db replication script";
$description = "small";
$rights = "0";
$user = "asdf";
$new_file_name ="sexy_bitch.pdf";
$short_file_name = "sexy_bitch.";
$user_ip = "127.0.0.1";
$hitcounter = 1;

		if ($stmt = mysqli_prepare($conn, "INSERT INTO `docunator`.`file` (`system_file_name`,`file_size`,`file_timestamp`,`file_mime_type`,`file_extension`) VALUES (?,?,?,?,?)")); {
			mysqli_stmt_bind_param($stmt, "sssss", $folderName, $file_size, $mysqltime, $file_mime_type, $file_extension);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		
		$indexed = "Y";
		if ($stmt = mysqli_prepare($conn, "INSERT INTO `docunator`.`file_transferred` (`system_file_name`,`file_transferred`,`indexed`) VALUES (?,?,?)")); {
			mysqli_stmt_bind_param($stmt, "sss", $folderName, $cmd_result, $indexed);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}	
		if ($stmt = mysqli_prepare($conn, "INSERT INTO `docunator`.`file_title` (`system_file_name`,`file_title`,`file_description`) VALUES (?,?,?)")); {
			mysqli_stmt_bind_param($stmt, "sss", $folderName, $file_title, $description);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}

		if ($stmt = mysqli_prepare($conn, "INSERT INTO `docunator`.`file_permission` (`system_file_name`,`rights_id`) VALUES (?,?)")); {
			mysqli_stmt_bind_param($stmt, "si", $folderName, $rights);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		if ($stmt = mysqli_prepare($conn, "INSERT INTO `docunator`.`user_file` (`user_name`,`system_file_name`,`user_file_name`, `short_name`, `user_ip`) VALUES (?,?,?,?,?)")); {
			mysqli_stmt_bind_param($stmt, "sssss", $user, $folderName, $new_file_name, $short_file_name, $user_ip);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		if ($stmt = mysqli_prepare($conn, "INSERT INTO `docunator`.`file_hitcounter` (`system_file_name`,`file_hit_count`) VALUES (?,?)")); {
			mysqli_stmt_bind_param($stmt, "si", $folderName, $hitcounter);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}	
		if ($stmt = mysqli_prepare($conn, "INSERT INTO `docunator`.`file_url` (`system_file_name`,`url`,`seoterm`) VALUES (?,?,?)")); {
			mysqli_stmt_bind_param($stmt, "sss", $folderName, $url, $seoterm);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
} while ($i < 10000000);

?>