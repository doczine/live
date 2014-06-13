<?php
include("db.php");

$urlindex = "";
 
$conn = db_connect();

$i = 0;
do {
    $i++;
	
$query = "SELECT `system_file_name` FROM `docunator`.`file_transferred` WHERE `file_transferred`.`snippet_confirmed` IS NULL LIMIT 1;";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $system_file_name);
    while (mysqli_stmt_fetch($stmt)) {

    }
    mysqli_stmt_close($stmt);
}

	$query = "UPDATE `docunator`.`file_transferred` SET `snippet_confirmed` = 'Y' WHERE `file_transferred`.`system_file_name` = '".$system_file_name."';";

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
		$urlindex = "http://192.168.1.100/bigdata/".$folder."/".$system_file_name."/".$trim_period.".txt";
		}
		mysqli_stmt_close($stmt);
	}
	
    $file = fopen($urlindex, 'r');
    //The first 20 characters are stored in the $theOutput 
    $theOutput = fread($file, 300);
    //echo $theOutput;
    fclose($file);    


	if ($stmt = mysqli_prepare($conn, "INSERT INTO `docunator`.`file_snippet` (`system_file_name`, `file_snippet`) VALUES (?,?)")); {
		mysqli_stmt_bind_param($stmt, "ss", $system_file_name, $theOutput);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}
sleep(20);
} while ($i < 1000000);
    
?>