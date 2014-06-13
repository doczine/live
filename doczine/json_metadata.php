<?php

include("upload_functions.php");
 
include("db.php");
 
$conn = db_connect_100();

$i = 0;
do {
    $i++;
    
//SELECT domain FROM table WHERE LENGTH(SUBSTRING_INDEX(domain, '.', 1)) = 3       meta_data 
	
$query = "SELECT `system_file_name` FROM `docunator`.`file_metadata` WHERE length(`file_metadata`.`meta_data`) < 5 LIMIT 1;";

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
		$urlindex = "/var/www/bigdata/".$folder."/".$system_file_name."/".$user_file_name;
		//echo $urlindex;
		}
		mysqli_stmt_close($stmt);
	}
 
$tika = "java -jar /var/www/mod/tika-app-1.3.jar -j ".$urlindex;
echo $tika;
$fuck = system($tika, $retval1);
//$fuck = shell_exec($tika);
//echo "<br>";
$array_json = utf8_encode_mix($fuck);
$array_json = json_decode($array_json, true);
$array_json = serialize($array_json);
echo $array_json;

		if ($stmt = mysqli_prepare($conn, "INSERT INTO `docunator`.`file_metadata` (`system_file_name`,`meta_data`) VALUES (?,?)")); {
			mysqli_stmt_bind_param($stmt, "ss", $system_file_name, $array_json);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
			
	$query = "UPDATE `docunator`.`file_transferred` SET `indexed` = 'YY' WHERE `file_transferred`.`system_file_name` = '".$doc."';";

	if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}	
	
}
} while ($i < 1);

	mysqli_close($conn);

?>