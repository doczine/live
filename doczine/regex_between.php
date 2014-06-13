<?php
//cp the apache logs to a different location to prevent corruption then run the awk script from terminal
//$cp = "cp /var/log/httpd-access.log /usr/home/capstone/httpd-access.log";
//$command = "awk '/q=/,/&/' /usr/home/capstone/httpd-access.log > /usr/home/capstone/search-terms.txt";

include("db.php");
$conn = db_connect();
$xmlUrl = "/usr/home/capstone/search-terms.txt";
$string = file_get_contents($xmlUrl);
$array = preg_split("/(\r\n|\n|\r)/", $string);

foreach ($array as $i => $row) {
    $s = urldecode($row);
    $matches = array();
    $t = preg_match('/q=(.*?)\&/s', $s, $matches);
    $string = print_r($matches[1], true);
    $string = urldecode($string);
    $null = NULL;
		if ($stmt = mysqli_prepare($conn, "INSERT INTO `docunator`.`file_seo_terms` (`seo_term`,`seo_researched`) VALUES (?,?)")); {
			mysqli_stmt_bind_param($stmt, "ss", $string, $null);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
}

/*
function Slug($string)
{
    return strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8')), '-'));
}
*/
//pull the terms from the apache logs and put them in a text file
//$command = "awk '/q=/,/&/' httpd-access.log";
//open the text file and read it into an array an then iterate through the array
//$s = '[15/May/2013:08:57:16 +0000] "GET /search.php?q=mor%27ning+rad%3Aio&searchsubmit=SEARCH HTTP/1.1" 200 5002 "http://doczine.com/search.php?q=sweet&searchsubmit=SEARCH" "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.8; rv:20.0) Gecko/20100101 Firefox/20.0"';
//$s = urldecode($s);
//$matches = array();
//match stuff between q= and & in the google search string
//$t = preg_match('/q=(.*?)\&/s', $s, $matches);
//print_r(urldecode($matches[1]));
//insert the search terms into the file_seo_terms.seo_term field in the db
?>