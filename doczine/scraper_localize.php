<?php

/*

include("db.php");
 
//$conn = db_connect();
$connscraper97 = db_connect_scraper_97();
$conn = db_connect_scraper_local();

$i = 0;
do {
    $i = $i + 1;
	
$query = "SELECT `urlcounter`, `title`, `url`, `host`, `seoterm`, `date` FROM `scraper`.`results` WHERE `results`.`converted` IS NULL LIMIT 1;";

if ($stmt = mysqli_prepare($connscraper97, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $urlcounter, $title, $url, $host, $seoterm, $date);
    while (mysqli_stmt_fetch($stmt)) {

    }
    mysqli_stmt_close($stmt);
}

//INSERT INTO `scraper`.`results` (`urlcounter`, `title`, `url`, `host`, `seoterm`, `date`, `converted`, `system_file_name`, `file_verified`) VALUES (NULL, 'sadf', 'wsad', 'aSD', 'asd', 'ASD', NULL, NULL, NULL);

if ($stmt = mysqli_prepare($conn, "INSERT INTO `scraper`.`results` (`urlcounter`, `title`, `url`, `host`, `seoterm`, `date`) VALUES (?,?,?,?,?,?)")); {
	mysqli_stmt_bind_param($stmt, "ssssss",  $urlcounter, $title, $url, $host, $seoterm, $date);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
}	


$query = "UPDATE `scraper`.`results` SET `converted` = 'Y' WHERE `results`.`urlcounter` = '".$urlcounter."';";

if ($stmt = mysqli_prepare($connscraper97, $query)) {
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
}


} while ($i < 3000);

	mysqli_close($conn);
	mysqli_close($connscraper97);


*/

$i = 1;

include("db.php");

$conn = db_connect_ej();

do {
$i = $i + 1;
$user = $i;
$folderName = "aafd@askdjf".$i.".com";
$new_file_name = "asdf".$i.".pdf";
$short_file_name = "asdf".$i.".pdf";
$user_ip = "127.0.0.1";
$rand_folder = "1";

if ($stmt = mysqli_prepare($conn, "INSERT INTO `docunator`.`user` (`user_name`, `email`, `first_name`, `last_name`, `address`, `phone`) VALUES (?,?,?,?,?,?)")); {
	mysqli_stmt_bind_param($stmt, "sssssi", $user, $folderName, $new_file_name, $short_file_name, $user_ip, $rand_folder);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
}

$query = "SELECT `user_name` FROM `docunator`.`user` WHERE `user`.`user_name` = '".$user."';";

	if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $i);
		while (mysqli_stmt_fetch($stmt)) {
			echo $i;
		}
		mysqli_stmt_close($stmt);
	}

} while ($i < 3000);


?>