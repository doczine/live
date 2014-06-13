<?php
$file_temp = "/var/www/bigdata/serialized.txt";
$lfhandler = file_get_contents($file_temp);	
$myNewArray = unserialize($lfhandler);
print_r($myNewArray);
$last = count($myNewArray) - 1;
foreach ($myNewArray as $i => $row)
{ 
    $isFirst = ($i == 0);
    $isLast = ($i == $last);
    $title = $row['title'];
    $trim = $row['url'];
    $host = $row['host'];
    $test = $row[0]['keyword'];
    echo $test;
    echo "<br>";
    $trimmed = $row['url'];
	$strlen = strlen($trimmed);
	$length = strrpos($trimmed, '&sa=');
	if ($length === FALSE) {
	  $length = $strlen;
	}
	$result = substr($trimmed, 0, $length);
	echo $title;
    echo "<br>";
	echo $result;
	echo "<br>";
	echo $host;
	echo "<br>";	
}
?>