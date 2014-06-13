<?php

include("upload_functions.php");
 
include("db.php");
 
$conn = db_connect_100();
$conn1 = db_connect_100();

echo "wtf";

$i = 0;
do {
    $i++;
	
$query = "SELECT `system_file_name` FROM `docunator`.`file_transferred` WHERE `file_transferred`.`meta_data` = 'NULL' LIMIT 1;";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $system_file_name);
    while (mysqli_stmt_fetch($stmt)) {
	
    }
    mysqli_stmt_close($stmt);
}

if ($system_file_name != "") {
$doc = $system_file_name;

$query = "SELECT `system_file_name`, `meta_data` FROM `docunator`.`file_metadata` WHERE `file_metadata`.`system_file_name` ='".$doc."';";

if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $system_file_name, $meta_data);		
			while (mysqli_stmt_fetch($stmt)) {

			$meta_data = unserialize($meta_data);
			
			foreach ($meta_data as $key => $value){
			
					$order   = array("\r\n", "\n", "\r");
					$replace = '';

					$key = str_replace($order, $replace, $key);
					$value = str_replace($order, $replace, $value);		
						
						if ($key == "title") {
							echo $key.": ";
							echo $value;
							echo "<br>";
							
							$value = mysqli_real_escape_string($conn1, $value);
							
							$query1 = "UPDATE `docunator`.`file_metadata` SET `meta_title` = '".$value."' WHERE `file_metadata`.`system_file_name` = '".$system_file_name."';";
							echo $query1;
							if ($stmt1 = mysqli_prepare($conn1, $query1)) {
							mysqli_stmt_execute($stmt1);
							mysqli_stmt_close($stmt1);
							
							}
						 
						}	
			
					}

				}
		
			}
		mysqli_stmt_close($stmt);
		
			$query = "UPDATE `docunator`.`file_transferred` SET `meta_data` = 'N' WHERE `file_transferred`.`system_file_name` = '".$doc."';";

			if ($stmt = mysqli_prepare($conn, $query)) {
				mysqli_stmt_execute($stmt);
				mysqli_stmt_close($stmt);
			}
		
			$query = "UPDATE `docunator`.`file_transferred` SET `meta_data` = 'Y' WHERE `file_transferred`.`system_file_name` = '".$system_file_name."';";

			if ($stmt = mysqli_prepare($conn, $query)) {
				mysqli_stmt_execute($stmt);
				mysqli_stmt_close($stmt);
			}
		
	}
} while ($i < 58000);

	mysqli_close($conn);

	mysqli_close($conn1);

?>