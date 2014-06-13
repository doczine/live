<?php
//this is where the file information is posted into the db
ini_set('max_execution_time', 0);
include("upload_functions.php");
include("upload_output.php");
include("convert_functions.php");
include("db.php");
 
//check_system_file_name($doc); 
 
//$conn = db_connect_local();
$conn1 = db_connect_scraper_100();

$conn = db_connect_100();

//$rand = rand(1, 1952455);

$s = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 1)), 0, 1);

$query = "SELECT `urlcounter`, `title`, `url`, `host`, `seoterm`, `date` FROM `scraper`.`results` WHERE `results`.`converted` IS NULL AND `results`.`urlcounter` LIKE '%".$s."%' limit 1;";
echo $query;

if ($stmt = mysqli_prepare($conn1, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $urlcounter, $title, $url, $host, $seoterm, $date);
    while (mysqli_stmt_fetch($stmt)) {
		echo $urlcounter;
    }
    mysqli_stmt_close($stmt);
}

$query = "SELECT `urlcounter`, `title`, `url`, `host`, `seoterm`, `date` FROM `scraper`.`results` WHERE `results`.`converted` IS NULL AND `results`.`urlcounter` = '".$urlcounter."' limit 1;";
echo $query;

if ($stmt = mysqli_prepare($conn1, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $urlcounter, $title, $url, $host, $seoterm, $date);
    while (mysqli_stmt_fetch($stmt)) {

		if(!isset($urlcounter)) {
			
			echo 'The file is already scraped';  
			$rm_folder = "rm -R -f ".$file_folder_name;
			system($rm_folder, $retrm);
			error_msg('File is duplicate!'); 		
			
		}
    }
    mysqli_stmt_close($stmt);
}


$randomsec = rand(0, 5);
sleep($randomsec);

echo $url;

//$query = "DELETE FROM `scraper`.`results` WHERE `results`.`urlcounter` = '".$urlcounter."';";

$query = "UPDATE `scraper`.`results` SET `converted` = 'Y' WHERE `results`.`urlcounter` = '".$urlcounter."';";

if ($stmt = mysqli_prepare($conn1, $query)) {
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
}

$url = str_replace("'", "''", $url);
$urlfixed = str_replace("'", "%27", $url);
$title = str_replace("'", "", $title);

/*
$query = "SELECT `url` FROM `docunator`.`file_url` WHERE `file_url`.`url` = '".$url."';";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $file_url);
    while (mysqli_stmt_fetch($stmt)) {
	echo "Existing URL: ".$file_url;
	echo "<br>";
    }
    mysqli_stmt_close($stmt);
}

    if(($file_url == $url)){
    	echo 'The url has already been scraped.';
    	error_msg('File already scraped!');		
    }
*/

/*
function is_connected()
{
    $connected = @fsockopen("google.com", 80); //website and port
    
    if ($connected)
    {
        $is_conn = true; //action when connected
        fclose($connected);
    }
    else
    {
        $is_conn = false; //action in connection failure
        
		echo 'The internet is down';  
		echo "<br> ".$file_title;
		error_msg('Internet is down!');        
        
    }
    return $is_conn;
}

is_connected();
*/

echo $url."<br>";

/*
$query = "SELECT `file_title` FROM `docunator`.`file_title` WHERE `file_title`.`file_title` = '".$title."';";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $file_title);
    while (mysqli_stmt_fetch($stmt)) {

    }
    mysqli_stmt_close($stmt);
}


	if($file_title == $title){
		echo 'The file already exists';  
		echo "<br> ".$file_title;
    	$rm_folder = "rm -R -f ".$file_folder_name;
		system($rm_folder, $retrm);
		error_msg('Title exists!');	
	}
*/

echo $url;

$remoteFile = $url;
$ch = curl_init($remoteFile);
curl_setopt($ch, CURLOPT_NOBODY, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); //not necessary unless the file redirects (like the PHP example we're using here)
$data = curl_exec($ch);
curl_close($ch);
	if ($data === false) {
	  echo 'cURL failed';
	  exit;
	}

$status = 'unknown';
	if (preg_match('/^HTTP\/1\.[01] (\d\d\d)/', $data, $matches)) {
	  $status = (int)$matches[1];
	}
	if (preg_match('/Content-Length: (\d+)/', $data, $matches)) {
	  $contentLength = (int)$matches[1];
	}

/*
echo $contentLength;

$query = "UPDATE `scraper`.`results` SET `url` = '".$urlfixed."' WHERE `results`.`urlkey` = '".$url."';";

if ($stmt = mysqli_prepare($connscraper97, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
*/

$urlfixed = mysqli_real_escape_string($conn, $urlfixed);


//echo $urlfixed;

//echo "wtf work ".$contentLength;


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
    $filepage = fetchUrl($urlfixed);
} 
catch (Exception $e)
{
    	echo 'The file url failed';
    	$rm_folder = "rm -R -f ".$file_folder_name;
    	system($rm_folder, $retrm);
    	error_msg('File link failed!');
}

$seoterm = mysqli_real_escape_string($conn, $seoterm);
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

/*

$query = "UPDATE `scraper`.`results` SET `system_file_name` = '".$folderName."' WHERE `results`.`urlcounter` = '".$urlcounter."';";
//echo $query;

if ($stmt = mysqli_prepare($connscraper97, $query)) {
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
}
*/

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


$query = "SELECT `file_size` FROM `docunator`.`file` WHERE `file`.`file_size` = '".$file_size."';";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $file_size_ex);
    while (mysqli_stmt_fetch($stmt)) {

    }
    mysqli_stmt_close($stmt);
}

$mysqldate = date("Y-m-d");
$file_size_dup = 0;

//SELECT `file_size` FROM `docunator`.`file_counter` WHERE `file_counter`.`file_size` = '6435340' AND `file_counter`.`file_timestamp` LIKE '%2013-06-27%';

/*
$query = "SELECT `file_size` FROM `docunator`.`file_counter` WHERE `file_counter`.`file_size` = '".$file_size."' AND `file_counter`.`file_timestamp` LIKE '%".$mysqldate."%';";
echo $query;

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $file_size_dup);
    while (mysqli_stmt_fetch($stmt)) {
		echo $file_size_dup;
		echo "anything";

			echo 'The file is already scraped';  
			$rm_folder = "rm -R -f ".$file_folder_name;
			system($rm_folder, $retrm);
			error_msg('File is duplicate!'); 		
		
    }
    mysqli_stmt_close($stmt);
}
*/

$query = "SELECT `user_file_name` FROM `docunator`.`user_file` WHERE `user_file`.`user_file_name` = '".$new_file_name."';";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $file_name1);
    while (mysqli_stmt_fetch($stmt)) {

    }
    mysqli_stmt_close($stmt);
}

	
    if(($file_size < 2000) and ($contentLength < 2000))
    {
		echo 'The file is empty';  
		$rm_folder = "rm -R -f ".$file_folder_name;
		system($rm_folder, $retrm);
		error_msg('File is empty!'); 		
    }
    
    /*
    if(($check_extension == false))
    {
		echo "Invalid file type";
    	$rm_folder = "rm -R -f ".$file_folder_name;
		system($rm_folder, $retrm);		
    }
    */
    
    elseif(($file_size > 30000001) and ($contentLength > 30000001)){
    	echo 'The file is larger than 20 MB';  
    	$rm_folder = "rm -R -f ".$file_folder_name;
    	system($rm_folder, $retrm);
    	error_msg('File is too big!');
    }
    
/*    
    elseif(($thumbnailcheck == "fail")){
    	echo 'The file is not renderable.';  
    	$rm_folder = "rm -R -f ".$file_folder_name;
		system($rm_folder, $retrm);
    	error_msg('This file sucks!'); 		
    }
*/


	elseif(($file_size == $file_size_ex) && ($file_name1 ==	$new_file_name)){
		echo 'The file already exists';  
		echo '<br>';
    	$rm_folder = "rm -R -f ".$file_folder_name;
		system($rm_folder, $retrm);
		error_msg('File already exists!'); 		
	}	
	
	elseif(($valid == true) && ($user != "")){	

/*

		echo "Filename: ".$user_file_name;
		echo "<br>";
		echo "Mime Type: ".$file_mime_type;
		echo "<br>";
		echo "Your Description: ".$description;
		echo "<br>";
		echo "Your Title: ".$file_title;
		echo "<br>";
		echo "Upload Time: ".$mysqltime;
		echo "<br>";
		echo "File Extension: ".$file_extension;
		echo "<br>";
		echo "Valid Extension: ".$check_extension;
		echo "<br>";
		echo "File Name: ".$user_file_name;
		echo "<br>";
		echo "New File Name: ".$folderName;
		echo "<br>";
		echo "Upload IP: ".$user_ip;
		echo "<br>";
		echo "There are this many pages: ";
		
*/		

		$pdfcount = "pdfinfo ".$file_new."pdf | grep 'Pages' - | awk '{print $2}'";
		$pdfcountresult = system($pdfcount, $retval12);

/*
		echo "<br>";
		echo "<h3>";
		echo "<a href='viewer.php?doc=".$folderName."'>Here is your upload link!</a>";
		echo "</h3>";

		echo "<h3>";
		echo "<a href='".$file_new."pdf'>Here is your PDF file link!</a>";
		echo "</h3>";

		echo "<h3>";
		echo "<a href='".$file_new.$file_extension."'>Here is your original file link!</a>";
		echo "</h3>";
*/		
		
		$file_chmod = "chmod -R 777 ".$file_folder;
		system($file_chmod, $retval);

		$conversion_string = "java -jar /var/www/mod/jodconverter4/lib/jodconverter-core-3.0-beta-4.jar ".$file_old." ".$file_new."pdf";
		system($conversion_string, $retval0);
		//echo "<br>";
		
		//$pdf_thumbnail = "convert -thumbnail x280 ".$file_new."pdf[1] ".$file_new."-1.png";
		//system($pdf_thumbnail, $retval3);
		
/*
		if ($pdfcountresult == 0) {
		    echo "There are no pages in this PDF";
		} elseif (($pdfcountresult >= 1) && ($pdfcountresult <= 10)) {
			$pdfsplit = 4;
		} elseif (($pdfcountresult >= 11) && ($pdfcountresult <= 25)) {
		    	$pdfsplit = 5;
		} elseif (($pdfcountresult >= 26) && ($pdfcountresult <= 75)) {
			$pdfsplit = 7;
		} elseif (($pdfcountresult >= 76) && ($pdfcountresult <= 100)) {
			$pdfsplit = 10;
		} elseif ($pdfcountresult >= 101) {
			$pdfsplit = 20;
		}

		echo "We split at ".$pdfsplit;

		$split_wig = "java -jar /var/www/mod/pdfbox-app-1.6.0.jar PDFSplit -split ".$pdfsplit." ".$file_new."pdf";
		system($split_wig, $retval0);

		//evil pdf page inserts ftw
		$file_new = rtrim($file_new, ".");
		$file_new = "/var/www/".$file_new;

		$directory = $file_folder_name."/";

		if (glob($directory . "*.pdf") != false)
		{
		 $filecount = count(glob($directory . "*.pdf"));
		 $filecount = $filecount - 1;
		 $i = 0;
			$java_prepend = "java -jar /var/www/mod/pdfbox-app-1.6.0.jar PDFMerger ".$file_new."-".$i.".pdf ";
			$java_postpend = $file_new."docunator.pdf";
			$java_mid = "";
		}

		while ($i < $filecount) {
			$java_mid .= "/var/www/bigdata/1360119209_b0f676af07/ad.pdf ".$file_new."-".$i.".pdf ";
			$i = $i + 1;
			}

			$java_merge = $java_prepend.$java_mid.$java_postpend;
			system($java_merge, $retval10);

		$i = 0;
		while ($i < $filecount) {	
			$rm = "rm ".$file_new."-".$i.".pdf";
			system($rm, $retrm);
			$i = $i + 1;
			}
*/

		$file_new = rtrim($file_new, ".");
		
/*		
   		$ghostscript = "gs -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -dPDFSETTINGS=/screen -dNOPAUSE -dQUIET -dBATCH -sOutputFile=".$file_new."docunator1.pdf ".$file_new.".pdf";
		echo $ghostscript;
		system($ghostscript, $retval11);
*/
		
		$file_chmod = "chmod -R 777 ".$file_folder;
		system($file_chmod, $retval);

/*
		$pdfmetadata = "pdftk ".$file_new.".pdf update_info /var/www/css/in.info output ".$file_new."docunator.com.pdf";
		system($pdfmetadata, $retrm1);
*/

	
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
		
		$index = "curl 'http://192.168.1.150:8983/solr/update/extract?&literal.id=1370555463_015816dc5c&uprefix=attr_&fmap.content=body&commit=true' -F 'myfile=@/var/www/bigdata/2/1370555463_015816dc5c/1569105304.pdf'";
		
		$index = "curl 'http://192.168.1.150:8983/solr/update/extract?&literal.id=".$folderName."&uprefix=attr_&fmap.content=body&commit=true' -F 'myfile=@".$internalip.".pdf'";
		echo $index;
		
		system($index, $retval);
		
		$tika = "java -jar /var/www/data/mod/tika-app-1.3.jar -j ".$file_new.".pdf";
		echo $tika;
		//system($tika, $fuck);
		
		$fuck = exec($tika);

/*
		$array_json = utf8_encode_mix($fuck);
		$array_json = json_decode($array_json, true);
		$array_json = serialize($array_json);
*/
		
		//echo $array_json;

		//$file_chmod = "chmod 755 ".$file_folder;
		//system($file_chmod, $retval6);

		//this error coding should have headers
		$cmd_result = $retval.$retval0.$retval2.$retval5.$retval6;

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

/*		
		
echo $folderName;
echo "<br>";
echo $file_size;
echo "<br>";
echo $mysqltime;
echo "<br>";
echo $file_mime_type;
echo "<br>";
echo $file_extension;
echo "<br>";
echo $folderName;
echo "<br>";
echo $cmd_result;
echo "<br>";
echo $folderName;
echo "<br>";
echo $file_title;
echo "<br>";
echo $description;
echo "<br>";
echo $folderName;
echo "<br>";
echo $category;
echo "<br>";
echo $folderName;
echo "<br>";
echo $rights;
echo "<br>";
echo $user;
echo "<br>";
echo $folderName;
echo "<br>";
echo $new_file_name;
echo "<br>";
echo $short_file_name;
echo "<br>";
echo $user_ip;
echo "<br>";
echo $folderName;
echo "<br>";
echo $hitcounter;
echo "<br>";

*/

$query = "SELECT `file_size` FROM `docunator`.`file` WHERE `file`.`file_size` = '".$file_size."';";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $file_size_ex);
    while (mysqli_stmt_fetch($stmt)) {

    }
    mysqli_stmt_close($stmt);
}
	
$query = "SELECT `user_file_name` FROM `docunator`.`user_file` WHERE `user_file`.`user_file_name` = '".$new_file_name."';";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $file_name1);
    while (mysqli_stmt_fetch($stmt)) {

    }
    mysqli_stmt_close($stmt);
}

$query = "SELECT `user_file_name`, `file_size` FROM `docunator`.`file_fuck` WHERE `user_file_name` LIKE '".$new_file_name."' AND `file_size` LIKE '".$file_size."';";
echo $query;

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);    
	mysqli_stmt_bind_result($stmt, $user_file_name_1, $file_size_1);
    while (mysqli_stmt_fetch($stmt)) {
		echo $user_file_name_1;
		echo $file_size_1;
		
		$user_file_name_len = strlen($user_file_name_1);
		$file_size_len = strlen($file_size_1);
		
		echo $user_file_name_len;
		echo $file_size_len;
		
		if(($user_file_name_len > 2) AND ($file_size_len > 2))
		{
			echo 'The file is duplicated';  
			$rm_folder = "rm -R -f ".$file_folder_name;
			system($rm_folder, $retrm);
			error_msg('File is check is duplicate!'); 		
		}
		
    }
    mysqli_stmt_close($stmt);
}

$file_size = intval($file_size);
$file_size_ex = intval($file_size_ex);



if ($stmt = mysqli_prepare($conn, "INSERT INTO `docunator`.`file_fuck` (`file_size`, `user_file_name`) VALUES (?,?)")); {
	mysqli_stmt_bind_param($stmt, "ss", $file_size, $new_file_name);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
}    



/*
		$urlindex = "http://localhost/bigdata/".$rand_folder."/".$folderName."/".$command_file_name."txt";

echo $urlindex;

    $file = file_get_contents($urlindex);
    //The first 20 characters are stored in the $theOutput 
    $theOutput = fread($file, 300);
    //echo $theOutput;
    fclose($file);    

echo $theOutput;
*/



/*
	if(($file_size == $file_size_ex) && ($file_name1 ==	$new_file_name)){
		echo 'The file already exists';  
    	$rm_folder = "rm -R -f ".$file_folder_name;
		system($rm_folder, $retrm);
		error_msg('File already exists!'); 		
	}
*/
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
			mysqli_stmt_bind_param($stmt, "sss", $folderName, $urlfixed, $seoterm);
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
		
		
/*		
		if ($stmt = mysqli_prepare($conn, "INSERT INTO `docunator`.`file_snippet` (`system_file_name`, `file_snippet`) VALUES (?,?)")); {
			mysqli_stmt_bind_param($stmt, "ss", $folderName, $theOutput);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}		
*/		
		
		




/*
		email sent when file has been uploaded
		$email = "joeemailaddy@gmail.com";
		$from = "From: support@docunator.com \r\n";
		$mesg = "New file uploaded here: http://192.168.0.46/".$folderName.".html \r\n";
		mail($email, 'Welcome to 192.168.0.46/docunator BETA', $mesg, $from);
*/
		
	}
	else 
	{
      echo "Invalid File Format, or captcha"; 
      
        echo 'Something failed bad, this is the catchall.';
    	$rm_folder = "rm -R -f ".$file_folder_name;
		system($rm_folder, $retrm);
    	error_msg('File already scraped!');	
      
      echo "<br>";
      echo "<br>";
      echo "<br>";
      echo "<br>";
      echo "<br>";
      echo "<br>";
      echo "<br>";
      echo "<br>";
      echo "<br>";
      echo "<br>";
      echo "<br>";
      echo "<br>";
      echo "<br>";
      echo "<br>";
      echo "<br>";
      echo "<br>";
      
}

mysqli_close($conn);
mysqli_close($conn1);
?>


