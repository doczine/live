<?php
include('db.php');

echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";

echo "<rss version=\"2.0\">";
		echo "
";
echo "<channel>";
echo "<title>Newest Documents - Doczine.com</title>";
echo "<description>This is an RSS feed of the 1000 newest documents uploaded to Doczine.com</description>";
echo "<link>http://doczine.com/newest.rss</link>";
echo "<lastBuildDate>";
echo date("Y-m-d H:i:s");
echo "</lastBuildDate>";
echo "<pubDate>";
echo date("Y-m-d H:i:s");
echo "</pubDate>";
echo "<ttl>0</ttl>";


ini_set('max_execution_time', 0);

$conn = db_connect();
$query = "
SELECT `system_file_name` , `file_title` , `short_name` , `file_timestamp`, `user_name`, `user_file_name`, `file_counter`, `folder`, `file_snippet`, `file_counter`
FROM `docunator`.`file_counter`
INNER JOIN `docunator`.`file_title`
USING ( system_file_name ) 
INNER JOIN `docunator`.`user_file`
USING ( system_file_name )
INNER JOIN `docunator`.`file_snippet`
USING ( system_file_name )
ORDER BY `file_counter`.`file_timestamp` DESC 
LIMIT 0, 1000
;";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $system_file_name, $file_title, $short_name, $file_timestamp, $user_name, $user_file_name, $file_counter, $folder, $file_snippet, $file_counter);
    while (mysqli_stmt_fetch($stmt)) 
    	{ 

$file_snippet = str_replace("
", " ", $file_snippet);


	 echo "<item>";
	 echo "<title>";
	 echo $file_title;
	 echo "</title>";
	 //echo "<description>";
	 //echo $file_snippet;
	 //echo "</description>";
	 echo "<link>";
	 echo "http://doczine.com/".$file_counter.".html";
	 echo "</link>";
	 echo "<guid>";
	 echo $file_counter;
	 echo "</guid>";
	 echo "<pubDate>";
	 echo $file_timestamp;
	 echo "</pubDate>";
	 echo "</item>";

        }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
echo "</channel>";
echo "</rss>";

?>