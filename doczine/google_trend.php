<?php
include("db.php");
$conn = db_connect();

class GoogleHotrends {
private $trendsurl = "http://www.google.com/trends/hottrends/atom/hourly";

public function fetch_trends()
{
	$c = curl_init($this->trendsurl);
	curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
	$responsedata = curl_exec($c);
	curl_close($c);
	return $this->parse_trend_feed($responsedata);
}

private function parse_trend_feed($data) {
	preg_match_all('/.+?<a href=".+?">(.+?)<\/a>.+?/',$data,$matches);
	return $matches[1];
	}
}

// Fetches google hot hourly 20 trends
$trends = new GoogleHotrends();
$keywords = $trends->fetch_trends();
//print_r($keywords);

foreach ($keywords as $i)
{

    $string = print_r($i, true);
    echo $string;
    $mysqltime = date("Y-m-d H:i:s");
    $null = NULL;
    
	if ($stmt = mysqli_prepare($conn, "INSERT INTO `docunator`.`google_trend_terms` (`search_term`,`search_date`, `search_page`) VALUES (?,?,?)")); {
		mysqli_stmt_bind_param($stmt, "sss", $string, $mysqltime, $null);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}

}


/*
INSERT INTO `docunator`.`google_trend_terms` (`search_term`,`search_date`, `search_page`) VALUES ('tnt', '2013-06-04 00:00:00', NULL);
*/

?>