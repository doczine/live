<?php


include("db.php");
$urlindex = "";
 
$conn = db_connect();

$i = 0;
do {
    $i++;
	
$query = "SELECT `system_file_name` FROM `docunator`.`file_transferred` WHERE `file_transferred`.`indexed` IS NULL LIMIT 1;";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $system_file_name);
    while (mysqli_stmt_fetch($stmt)) {
	echo $system_file_name;
    }
    mysqli_stmt_close($stmt);
}

if ($system_file_name != "") {
$doc = $system_file_name;

$urlindex = "";

$query = "SELECT `system_file_name`, `short_name`, `user_file_name`, `folder` FROM `docunator`.`user_file` WHERE `user_file`.`system_file_name` ='".$doc."';";

if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $system_file_name, $short_name, $user_file_name, $folder);
		while (mysqli_stmt_fetch($stmt)) {
		$trim_period = rtrim($short_name, ".");
		echo $trim_period;
		$urlindex = "/var/www/bigdata/".$system_file_name."/".$trim_period.".pdf";
		echo $urlindex;
		}
		mysqli_stmt_close($stmt);
	}
	
$query = "SELECT `file_counter` FROM `docunator`.`file_counter` WHERE `file_counter`.`system_file_name` = '".$doc."';";

if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $file_counter);
		while (mysqli_stmt_fetch($stmt)) {

		}
		mysqli_stmt_close($stmt);
	}
	
$query = "SELECT `file_extension` FROM `docunator`.`file` WHERE `file`.`system_file_name` = '".$doc."';";

if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $file_extension);
		while (mysqli_stmt_fetch($stmt)) {

		}
		mysqli_stmt_close($stmt);
	}


$query = "SELECT `file_title` FROM `docunator`.`file_title` WHERE `file_title`.`system_file_name` = '".$doc."';";

if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $file_title);
		while (mysqli_stmt_fetch($stmt)) {

		}
		mysqli_stmt_close($stmt);
	}

$file_title = str_replace(" ", "_", $file_title);

$index = "curl 'http://192.168.1.97:8983/solr/update/extract?&literal.id=".$system_file_name."&literal.filelink=http://doczine.com/".$file_counter.".html&literal.filename='".$short_name."pdf'&literal.filetype='".$file_extension."'&literal.title1='".$file_title."'&uprefix=attr_&fmap.content=body&commit=true' -F 'myfile=@/var/www/bigdata/".$folder."/".$system_file_name."/".$short_name."pdf'";

system($index, $retval3);

echo $index;

	$query = "UPDATE `docunator`.`file_transferred` SET `indexed` = 'Y' WHERE `file_transferred`.`system_file_name` = '".$doc."';";

	if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}	
	
}
} while ($i < 300000);

	mysqli_close($conn);

?>
