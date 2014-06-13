<?php
/*
include("db.php");
$conn1 = db_connect_100();
$conn = db_connect_scraper_local();
$query = "SELECT `urlcounter`, `title`, `url`, `host`, `seoterm`, `date` FROM `scraper`.`results` WHERE `results`.`converted` IS NULL LIMIT 1;";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $urlcounter, $title, $url, $host, $seoterm, $date);
    while (mysqli_stmt_fetch($stmt)) {

    }
    mysqli_stmt_close($stmt);
}
*/
$url_array = array();
$urlcounter = "123140";
$title = "A hostoric mistake";
$url = "http://www-tc.pbs.org/producers/pbskidssubmissionguidelines_201010.pdf";
$host = "www-tc.pbs.org";
$seoterm = "your mom filetype:pdf";
$date = date("Y-m-d H:i:s");
$url_array[urlcounter] = $urlcounter;
$url_array[title] = $title;
$url_array[url] = $url;
$url_array[host] = $host;
$url_array[seoterm] = $seoterm;
$url_array[date] = $date;
//print_r($url_array);
$json_array = json_encode($url_array);
//echo $json_array;
$return_value = "";
$fp = fsockopen("192.168.1.69", 80, $errno, $errstr, 0.4);
if($errno == "0") {
        $fileContents = $json_array;
        $file_txt = base64_encode($fileContents);
        $url = "curl http://localhost/push.php?stream=".$file_txt." > /dev/null";
        //echo $url;
        system($url, $return_value);
        echo $return_value;
}
if($return_value == "TRUE") {
        echo "TRYE";
        /*
		$query = "UPDATE `scraper`.`results` SET `converted` = 'Y' WHERE `results`.`urlcounter` = '".$urlcounter."';";
		if ($stmt = mysqli_prepare($conn1, $query)) {
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		*/
}
?>