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
SELECT `system_file_name`, `short_name`, `user_file_name`, `folder`
FROM `docunator`.`user_file`
WHERE `user_file`.`system_file_name` ='".$doc."';";

if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $system_file_name, $short_name, $user_file_name, $folder);
		while (mysqli_stmt_fetch($stmt)) {
		$trim_period = rtrim($short_name, ".");
		$file_link = "/var/www/bigdata/".$folder."/".$system_file_name."/".$trim_period;
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

function display_html_link($doc)
{

$conn = db_connect();

$query = "
SELECT `system_file_name`, `short_name`, `user_file_name`, `folder`
FROM `docunator`.`user_file`
WHERE `user_file`.`system_file_name` ='".$doc."';";

if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $system_file_name, $short_name, $user_file_name, $folder);
		while (mysqli_stmt_fetch($stmt)) {
		$trim_period = rtrim($short_name, ".");
		$html_link_new = "http://doczine.com/ramdrive/".$system_file_name."/".$trim_period;
		return $html_link_new;
		}

		mysqli_stmt_close($stmt);
	}
	mysqli_close($conn);
}

function display_download_link($doc)
{

$conn = db_connect();

$query = "
SELECT `system_file_name`, `short_name`, `user_file_name`, `folder`
FROM `docunator`.`user_file`
WHERE `user_file`.`system_file_name` ='".$doc."';";

if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $system_file_name, $short_name, $user_file_name, $folder);
		while (mysqli_stmt_fetch($stmt)) {
		$trim_period = rtrim($short_name, ".");
		$file_link_new = "http://doczine.com/bigdata/1/convert/".$system_file_name."/".$trim_period;
		return $file_link_new;
		}

		mysqli_stmt_close($stmt);
	}
	mysqli_close($conn);
}

function display_bigdata_link($doc)
{

$conn = db_connect();

$query = "
SELECT `system_file_name`, `short_name`, `user_file_name`, `folder`
FROM `docunator`.`user_file`
WHERE `user_file`.`system_file_name` ='".$doc."';";

if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $system_file_name, $short_name, $user_file_name, $folder);
		while (mysqli_stmt_fetch($stmt)) {
		$folder_name = "/var/www/bigdata/1/convert/".$system_file_name;
		chmod($folder_name, 0777);
		$trim_period = rtrim($short_name, ".");
		$bigdata_folder_name = "/var/www/bigdata/1/convert/".$system_file_name."/".$trim_period;
		return $bigdata_folder_name;
		}

		mysqli_stmt_close($stmt);
	}
	mysqli_close($conn);
}

?>