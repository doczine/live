<?php
header('Content-Type: text/xml');
include('db.php');

$i = 0;

function wtfwork($string) {
	return str_replace ( array ( '&', '"', "'", '<', '>', '�' ), array ( '&amp;' , '&quot;', '&apos;' , '&lt;' , '&gt;', '&apos;' ), $string );
} 

function stripInvalidXml($value)
{
    $ret = "";
    $current;
    if (empty($value)) 
    {
        return $ret;
    }

    $length = strlen($value);
    for ($i=0; $i < $length; $i++)
    {
        $current = ord($value{$i});
        if (($current == 0x9) ||
            ($current == 0xA) ||
            ($current == 0xD) ||
            (($current >= 0x20) && ($current <= 0xD7FF)) ||
            (($current >= 0xE000) && ($current <= 0xFFFD)) ||
            (($current >= 0x10000) && ($current <= 0x10FFFF)))
        {
            $ret .= chr($current);
        }
        else
        {
            $ret .= " ";
        }
    }
    return $ret;
}

echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";

echo "<searchresult>";


/*
echo "<rss version=\"2.0\">";

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
*/

ini_set('max_execution_time', 0);

$conn1 = db_connect();
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
INNER JOIN `docunator`.`file_transferred`
USING ( system_file_name )
WHERE `file_transferred`.`carrot_seo_300` IS NULL
ORDER BY `file_counter`.`file_timestamp` DESC 
LIMIT 0, 5000
;";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $system_file_name, $file_title, $short_name, $file_timestamp, $user_name, $user_file_name, $file_counter, $folder, $file_snippet, $file_counter);
    while (mysqli_stmt_fetch($stmt)) 
    	{ 
    	$i = $i + 1;
    	
			$query1 = "UPDATE `docunator`.`file_transferred` SET `carrot_seo_300` = 'Y' WHERE `file_transferred`.`system_file_name` = '".$system_file_name."';";

			if ($stmt1 = mysqli_prepare($conn1, $query1)) {
				mysqli_stmt_execute($stmt1);
				mysqli_stmt_close($stmt1);
			}	

$file_snippet = str_replace("
", " ", $file_snippet);

/*
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
*/

$file_title = wtfwork($file_title);
$file_title = stripInvalidXml($file_title);

$file_snippet = wtfwork($file_snippet);
$file_snippet = stripInvalidXml($file_snippet);

		echo "<document id=\"".$system_file_name."\">";
		echo "<title>";
		echo $file_title;
		echo "</title>";
		echo "<snippet>";
		echo $file_snippet;
		echo "</snippet>";
		echo "<url>";
		echo "http://doczine.com/".$file_counter.".html";
		echo "</url>";
		echo "</document>";


        }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
//echo "</channel>";
//echo "</rss>";

echo "</searchresult>";

?>
