<?php

 
function check_system_file_name($doc)
{
$conn = db_connect();
$query = "SELECT system_file_name FROM `docunator`.`file` WHERE `file`.`system_file_name` = '".$doc."';";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $system_file_name);
    while (mysqli_stmt_fetch($stmt)) {
        return $system_file_name;
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}


function display_file_link($doc)
{

$conn = db_connect();

$query = "
SELECT `system_file_name`, `short_name`, `user_file_name`
FROM `docunator`.`user_file`
WHERE `user_file`.`system_file_name` ='".$doc."';";

if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $system_file_name, $short_name, $user_file_name);
		while (mysqli_stmt_fetch($stmt)) {
		$trim_period = rtrim($short_name, ".");
		$file_link = "/var/www/ramdrive/".$system_file_name."/".$trim_period;
		return $file_link;
		}

		mysqli_stmt_close($stmt);
	}
	mysqli_close($conn);
}

function display_newfile_link($doc)
{

$conn = db_connect();

$query = "
SELECT `system_file_name`, `short_name`, `user_file_name`
FROM `docunator`.`user_file`
WHERE `user_file`.`system_file_name` ='".$doc."';";

if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $system_file_name, $short_name, $user_file_name);
		while (mysqli_stmt_fetch($stmt)) {
		$trim_period = rtrim($short_name, ".");
		$file_link_new = "/var/www/ramdrive/".$system_file_name."/".$trim_period;
		return $file_link_new;
		}

		mysqli_stmt_close($stmt);
	}
	mysqli_close($conn);
}

?>