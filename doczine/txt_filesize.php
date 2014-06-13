<?php

include("upload_functions.php");
 
include("db.php");
 
$conn = db_connect_100();

$i = 0;
do {
    $i++;
    
$query = "SELECT `system_file_name` FROM `docunator`.`file_transferred` WHERE `file_transferred`.`pdfocr` IS NULL;";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $system_file_name);
    while (mysqli_stmt_fetch($stmt)) {
	//echo $system_file_name;
    }
    mysqli_stmt_close($stmt);
}

if ($system_file_name != "") {
$doc = $system_file_name;

$query = "SELECT `system_file_name`, `short_name`, `user_file_name`, `folder` FROM `docunator`.`user_file` WHERE `user_file`.`system_file_name` ='".$doc."';";
//echo $query;

if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $system_file_name, $short_name, $user_file_name, $folder);
		while (mysqli_stmt_fetch($stmt)) {
		$trim_period = rtrim($short_name, ".");
		//echo $trim_period;
		$urlindex = "/var/www/bigdata/".$folder."/".$system_file_name."/".$short_name;
		$urltxt = "/var/www/bigdata/".$folder."/".$system_file_name."/".$short_name."txt";
		}
		mysqli_stmt_close($stmt);
	}
 
			if (filesize($urltxt) > 0) {
				echo "The file exists";
				
					$query = "UPDATE `docunator`.`file_transferred` SET `pdfocr` = 'N' WHERE `file_transferred`.`system_file_name` = '".$doc."';";
					//echo $query;
				
					if ($stmt = mysqli_prepare($conn, $query)) {
						mysqli_stmt_execute($stmt);
						mysqli_stmt_close($stmt);
					}					
				
			} 
			else 
			{
				
				echo "File is small OCR needed";

				$query = "UPDATE `docunator`.`file_transferred` SET `pdfocr` = 'Y' WHERE `file_transferred`.`system_file_name` = '".$doc."';";
			
				if ($stmt = mysqli_prepare($conn, $query)) {
					mysqli_stmt_execute($stmt);
					mysqli_stmt_close($stmt);
				}	

			}	
			
 		}
 		
	} while ($i < 10);

	mysqli_close($conn);

?>