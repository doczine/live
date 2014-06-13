<?php

include("upload_functions.php");
 
include("db.php");
 
$conn = db_connect_100();

$i = 0;
do {
    $i++;
    
$query = "SELECT `system_file_name` FROM `docunator`.`file_transferred` WHERE `file_transferred`.`pdftxt` IS NULL LIMIT 1;";

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
 
			if (file_exists($urltxt)) {
				echo "The file exists";
				
					$query = "UPDATE `docunator`.`file_transferred` SET `pdftxt` = 'Y' WHERE `file_transferred`.`system_file_name` = '".$doc."';";
					//echo $query;
				
					if ($stmt = mysqli_prepare($conn, $query)) {
						mysqli_stmt_execute($stmt);
						mysqli_stmt_close($stmt);
					}					
				
			} 
			else 
			{
				
				$pdf_text = "pdftotext ".$urlindex."pdf ".$urlindex."txt";
				system($pdf_text, $retval5);
				
				echo $pdf_text;

				$query = "UPDATE `docunator`.`file_transferred` SET `pdftxt` = 'Y' WHERE `file_transferred`.`system_file_name` = '".$doc."';";
				//echo $query;
			
				if ($stmt = mysqli_prepare($conn, $query)) {
					mysqli_stmt_execute($stmt);
					mysqli_stmt_close($stmt);
				}	

			}	
			
 		}
 		
	} while ($i < 1);

	mysqli_close($conn);

?>