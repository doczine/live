<?php
//this is where the file information is posted into the db
ini_set('max_execution_time', 0);
include("upload_functions.php");
include("upload_output.php");
include("convert_functions.php");
include("db.php");
/*
if(isset($_GET['stream'])){
    $json = base64_decode($_GET['stream']);
    $json_array = json_decode($json, true);
        print_r($json_array);
}
else
{
    echo 'No URL was passed.';
    error_msg('No URL!');
}
*/
$json = base64_decode('eyJ1cmxjb3VudGVyIjoiMTIzMTQwIiwidGl0bGUiOiJBIGhvc3RvcmljIG1pc3Rha2UiLCJ1cmwiOiJodHRwOlwvXC93d3ctdGMucGJzLm9yZ1wvcHJvZHVjZXJzXC9wYnNraWRzc3VibWlzc2lvbmd1aWRlbGluZXNfMjAxMDEwLnBkZiIsImhvc3QiOiJ3d3ctdGMucGJzLm9yZyIsInNlb3Rlcm0iOiJ5b3VyIG1vbSBmaWxldHlwZTpwZGYiLCJkYXRlIjoiMjAxMy0xMS0yNSAwMDozNjo1MiJ9');
$json_array = json_decode($json, true);
print_r($json_array);
$urlcounter = $json_array[urlcounter];
$title = $json_array[title];
$url = $json_array[url];
$host = $json_array[host];
$seoterm = $json_array[seoterm];
$date = $json_array[date];
if($url == ""){
    echo 'No URL was passed.';
    error_msg('No URL!');
}
$conn = db_connect_62();
$url = str_replace("'", "%27", $url);
$title = str_replace("'", "", $title);
$remoteFile = $url;
$ch = curl_init($remoteFile);
curl_setopt($ch, CURLOPT_NOBODY, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
$data = curl_exec($ch);
curl_close($ch);
	if ($data === false) {
		echo 'cURL failed';
	    error_msg('cURL Failed URL!');
	  exit;
	}
$status = 'unknown';
if (preg_match('/^HTTP\/1\.[01] (\d\d\d)/', $data, $matches)) {
	$status = (int)$matches[1];
}
if (preg_match('/Content-Length: (\d+)/', $data, $matches)) {
	$contentLength = (int)$matches[1];
}
if ($contentLength > 30000001) {
	echo 'The file is too large';			
	error_msg('File too large!'); 		
}
if ($contentLength < 200) {
	echo 'The file is too small';	
	error_msg('File too small!'); 		
}
function fetchUrl($uri) {
    $handle = curl_init();
    curl_setopt($handle, CURLOPT_URL, $uri);
    curl_setopt($handle, CURLOPT_POST, false);
    curl_setopt($handle, CURLOPT_BINARYTRANSFER, false);
    curl_setopt($handle, CURLOPT_HEADER, true);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 10);
    $response = curl_exec($handle);
    $hlength  = curl_getinfo($handle, CURLINFO_HEADER_SIZE);
    $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
    $body     = substr($response, $hlength);
    // If HTTP response is not 200, throw exception
    if ($httpCode != 200) {
        throw new Exception($httpCode);
    }
    return $body;
}

try {
    $filepage = fetchUrl($url);
} 
catch (Exception $e)
{
    	echo 'The file url failed';
    	$rm_folder = "rm -R -f ".$file_folder_name;
    	system($rm_folder, $retrm);
    	error_msg('File link failed!');
}


$rights = 0;
$hitcounter = 1;
$description = "We work for the freedom of the webs.";
$category = "Freedom";
$user_ip = $_SERVER['SERVER_ADDR'];
$user = "asdf";
$mysqltime = date("Y-m-d H:i:s");
$valid = true;
$file_extension = "pdf";
//$file_extension = get_extension($url, $contentLength);
//echo "File Extension: ".$file_extension;
//echo "<br>";
$folderName = namefile($file_extension);


$rand_folder = rand(1, 2);
$check_extension = check_extension($file_extension);
$file_folder_name = "/var/www/ramdrive/".$folderName;
$bigdata_folder_name = "/var/www/bigdata/".$rand_folder."/".$folderName;
//echo $file_folder_name;
mkdir($file_folder_name, 0777);
chmod($file_folder_name, 0777);
$file_mime_type = "application/pdf";
$file_title = $title;
$user_file_name = user_file_name($url);
$new_file_name = str_replace(" ", "_", $user_file_name);
$new_file_name = mysql_escape_mimic($new_file_name);
$short_file_name = $new_file_name;
$short_file_name = str_replace($file_extension, "", $short_file_name);
$destination_file = "/var/www/ramdrive/".$folderName."/".$new_file_name;
$lfhandler = fopen($destination_file, "w");
fwrite($lfhandler, $filepage);
fclose ($lfhandler);
//delete source file

$filename = $destination_file;

$file_folder = "/var/www/ramdrive/".$folderName."/";
$file_old = $file_folder.$new_file_name;

$command_file_name = $new_file_name;
$command_file_name = str_replace($file_extension, "", $command_file_name);

$file_new = $file_folder.$command_file_name;

if (file_exists($filename)) {
	echo "The file $filename exists";
} else {
	echo "The file $filename does not exist";
	error_msg('File is empty!'); 
}

//echo "<br>";
$file_size = filesize($filename);
//echo "This is the file size: ".$file_size;
//echo "<br>";


$pdf_thumbnail = "convert -thumbnail x280 ".$file_new."pdf[0] ".$file_new."png";
system($pdf_thumbnail, $retval2);

$thumbnail = $file_new."png";

$optimize_thumbnail = "optipng -o7 ".$thumbnail;
system($optimize_thumbnail, $retval23);

//echo $thumbnail;
//echo "<br>";


if (!file_exists($thumbnail)) {

	$thumbnailcheck = "fail";

	echo 'The file is not renderable.';  
	$rm_folder = "rm -R -f ".$file_folder_name;
	system($rm_folder, $retrm);
	error_msg('This file sucks!'); 		

}

$mysqldate = date("Y-m-d");
$file_size_dup = 0;
	
    if(($file_size < 2000) and ($contentLength < 2000))
    {
		echo 'The file is empty';  
		$rm_folder = "rm -R -f ".$file_folder_name;
		system($rm_folder, $retrm);
		error_msg('File is empty!'); 		
    }
    
    elseif(($file_size > 30000001) and ($contentLength > 30000001)){
    	echo 'The file is larger than 20 MB';  
    	$rm_folder = "rm -R -f ".$file_folder_name;
    	system($rm_folder, $retrm);
    	error_msg('File is too big!');
    }

	elseif(($valid == true) && ($user != "")){	
	
		$pdfcount = "pdfinfo ".$file_new."pdf | grep 'Pages' - | awk '{print $2}'";
		$pdfcountresult = system($pdfcount, $retval12);
		
		$file_chmod = "chmod -R 777 ".$file_folder;
		system($file_chmod, $retval);

		//$conversion_string = "java -jar /var/www/mod/jodconverter4/lib/jodconverter-core-3.0-beta-4.jar ".$file_old." ".$file_new."pdf";
		//system($conversion_string, $retval0);


		$file_new = rtrim($file_new, ".");
		
		
		$file_chmod = "chmod -R 777 ".$file_folder;
		system($file_chmod, $retval);

	
		$damn_file_name = str_replace(".", "", $command_file_name);
		
		$curlfile = rtrim($short_file_name, ".");
		
		$internalip = $file_folder.$curlfile;
		
		echo "<br>";
		echo $internalip;
		echo "<br>";
		
		//echo $internalip;
		//echo "<br>";
		//echo $directory;
		echo "<br>";
		
		$pdf_text = "pdftotext ".$file_new.".pdf ".$file_new.".txt";
		echo $pdf_text;
		system($pdf_text, $retval5);		
		
		//$index = "curl 'http://192.168.1.150:8983/solr/update/extract?&literal.id=1370555463_015816dc5c&uprefix=attr_&fmap.content=body&commit=true' -F 'myfile=@/var/www/bigdata/2/1370555463_015816dc5c/1569105304.pdf'";		
		$index = "curl 'http://192.168.1.50:8983/solr/update/extract?&literal.id=".$folderName."&uprefix=attr_&fmap.content=body&commit=true' -F 'myfile=@".$internalip.".pdf' > /dev/null";
		echo $index;		
		system($index, $retval);
		
		$array_json = mysqli_real_escape_string($conn, $fuck);
		$folderName = mysqli_real_escape_string($conn, $folderName);
		$file_size = mysqli_real_escape_string($conn, $file_size);
		$mysqltime = mysqli_real_escape_string($conn, $mysqltime);
		$file_mime_type = mysqli_real_escape_string($conn, $file_mime_type);
		$file_extension = mysqli_real_escape_string($conn, $file_extension);
		$folderName = mysqli_real_escape_string($conn, $folderName);
		$cmd_result = mysqli_real_escape_string($conn, $cmd_result);
		$folderName = mysqli_real_escape_string($conn, $folderName);
		$file_title = mysqli_real_escape_string($conn, $file_title);
		$description = mysqli_real_escape_string($conn, $description);
		$folderName = mysqli_real_escape_string($conn, $folderName);
		$category = mysqli_real_escape_string($conn, $category);
		$folderName = mysqli_real_escape_string($conn, $folderName);
		$rights = mysqli_real_escape_string($conn, $rights);
		$user = mysqli_real_escape_string($conn, $user);
		$folderName = mysqli_real_escape_string($conn, $folderName);
		$new_file_name = mysqli_real_escape_string($conn, $new_file_name);
		$short_file_name = mysqli_real_escape_string($conn, $short_file_name);
		$user_ip = mysqli_real_escape_string($conn, $user_ip);
		$folderName = mysqli_real_escape_string($conn, $folderName);
		$hitcounter = mysqli_real_escape_string($conn, $hitcounter);


		$file_size = intval($file_size);
		$file_size_ex = intval($file_size_ex);

		if ($stmt = mysqli_prepare($conn, "INSERT INTO `docunator`.`file_fuck` (`file_size`, `user_file_name`) VALUES (?,?)")); {
			mysqli_stmt_bind_param($stmt, "ss", $file_size, $new_file_name);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}    

		$copy_files = "cp -R ".$file_folder_name." ".$bigdata_folder_name;
		echo $copy_files;
		system($copy_files, $retval10);
		
		$rm_folder = "rm -R -f ".$file_folder_name;
		system($rm_folder, $retrm);
	
		if ($stmt = mysqli_prepare($conn, "INSERT INTO `docunator`.`file` (`system_file_name`,`file_size`,`file_timestamp`,`file_mime_type`,`file_extension`) VALUES (?,?,?,?,?)")); {
			mysqli_stmt_bind_param($stmt, "sssss", $folderName, $file_size, $mysqltime, $file_mime_type, $file_extension);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}		
		
		$indexed = "Y";
		if ($stmt = mysqli_prepare($conn, "INSERT INTO `docunator`.`file_transferred` (`system_file_name`,`file_transferred`,`indexed`) VALUES (?,?,?)")); {
			mysqli_stmt_bind_param($stmt, "sss", $folderName, $cmd_result, $indexed);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}	
		if ($stmt = mysqli_prepare($conn, "INSERT INTO `docunator`.`file_title` (`system_file_name`,`file_title`,`file_description`) VALUES (?,?,?)")); {
			mysqli_stmt_bind_param($stmt, "sss", $folderName, $file_title, $description);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}

		if ($stmt = mysqli_prepare($conn, "INSERT INTO `docunator`.`file_permission` (`system_file_name`,`rights_id`) VALUES (?,?)")); {
			mysqli_stmt_bind_param($stmt, "si", $folderName, $rights);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		if ($stmt = mysqli_prepare($conn, "INSERT INTO `docunator`.`user_file` (`user_name`,`system_file_name`,`user_file_name`, `short_name`, `user_ip`, `folder`) VALUES (?,?,?,?,?,?)")); {
			mysqli_stmt_bind_param($stmt, "ssssss", $user, $folderName, $new_file_name, $short_file_name, $user_ip, $rand_folder);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		if ($stmt = mysqli_prepare($conn, "INSERT INTO `docunator`.`file_hitcounter` (`system_file_name`,`file_hit_count`) VALUES (?,?)")); {
			mysqli_stmt_bind_param($stmt, "si", $folderName, $hitcounter);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}	
		if ($stmt = mysqli_prepare($conn, "INSERT INTO `docunator`.`file_url` (`system_file_name`,`url`,`seoterm`) VALUES (?,?,?)")); {
			mysqli_stmt_bind_param($stmt, "sss", $folderName, $url, $seoterm);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}

		if ($stmt = mysqli_prepare($conn, "INSERT INTO `docunator`.`file_metadata` (`system_file_name`,`meta_data`) VALUES (?,?)")); {
			mysqli_stmt_bind_param($stmt, "ss", $folderName, $array_json);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		if ($stmt = mysqli_prepare($conn, "INSERT INTO `docunator`.`file_counter` (`system_file_name`, `file_size`, `file_timestamp`, `file_mime_type`, `file_extension`) VALUES (?,?,?,?,?)")); {
			mysqli_stmt_bind_param($stmt, "sssss", $folderName, $file_size, $mysqltime, $file_mime_type, $file_extension);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}

		if ($stmt = mysqli_prepare($conn, "INSERT INTO `docunator`.`file_location` (`system_file_name`, `folder`) VALUES (?,?)")); {
			mysqli_stmt_bind_param($stmt, "ss", $folderName, $rand_folder);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}			
		
	}
	else 
	{
      echo "Invalid File Format, or captcha"; 
      
        echo 'Something failed bad, this is the catchall.';
    	$rm_folder = "rm -R -f ".$file_folder_name;
		system($rm_folder, $retrm);
    	error_msg('File already scraped!');	
      
}

mysqli_close($conn);
mysqli_close($conn1);
?>


