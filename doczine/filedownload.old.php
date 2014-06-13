<?php
//this is where the file information is posted into the db
ini_set('max_execution_time', 0);
include("upload_functions.php");
include("upload_output.php");
include("db.php");
include("convert_functions.php");

 
check_system_file_name($doc); 
 
$conn = db_connect_100();
$conn1 = db_connect_scraper();

$contentLength = 0;

$query = "SELECT `urlcounter`, `title`, `url`, `host`, `seoterm`, `date` FROM `scraper`.`results` WHERE `results`.`converted` IS NULL limit 1;";

if ($stmt = mysqli_prepare($conn1, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $urlcounter, $title, $url, $host, $seoterm, $date);
    while (mysqli_stmt_fetch($stmt)) {

    }
    mysqli_stmt_close($stmt);
}

$query = "UPDATE `scraper`.`results` SET `converted` = 'Y' WHERE `results`.`urlcounter` = '".$urlcounter."';";

if ($stmt = mysqli_prepare($conn1, $query)) {
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
}

$url = str_replace("'", "''", $url);
$urlfixed = str_replace("'", "%27", $url);
$title = str_replace("'", "", $title);
echo "test";

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

echo $contentLength;

$query = "UPDATE `scraper`.`results` SET `url` = '".$urlfixed."' WHERE `results`.`urlkey` = '".$url."';";

if ($stmt = mysqli_prepare($conn1, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

$urlfixed = mysqli_real_escape_string($conn, $urlfixed);
echo $urlfixed;

echo "wtf work ".$contentLength;

if ($contentLength > 10000001) {
		echo 'The file is too large';		
		$query = "UPDATE `scraper`.`results` SET `converted` = 'Y' WHERE `results`.`url` = '".$urlfixed."';";
		if ($stmt = mysqli_prepare($conn1, $query)) {
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}		
		error_msg('File too large!'); 		
}

if ($contentLength < 20000) {
		echo 'The file is too small';
		$query = "UPDATE `scraper`.`results` SET `converted` = 'Y' WHERE `results`.`url` = '".$urlfixed."';";
		if ($stmt = mysqli_prepare($conn1, $query)) {
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}		
		error_msg('File too small!'); 		
}

$seoterm = mysqli_real_escape_string($conn, $seoterm);
$filepage = file_get_contents($urlfixed);
$rights = 0;
$hitcounter = 1;
$description = "We work for the freedom of the webs.";
$category = "Freedom";
$user_ip = $_SERVER['SERVER_ADDR'];
$user = "asdf";
$mysqltime = date("Y-m-d H:i:s");
$valid = true;
$file_extension = get_extension($url, $contentLength);
echo "File Extension: ".$file_extension;
echo "<br>";
$folderName = namefile($file_extension);

$query = "UPDATE `scraper`.`results` SET `system_file_name` = '".$folderName."' WHERE `results`.`urlcounter` = '".$urlcounter."';";
echo $query;

if ($stmt = mysqli_prepare($conn1, $query)) {
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
}

$check_extension = check_extension($file_extension);
$file_folder_name = "/var/www/ramdrive/".$folderName;
$bigdata_folder_name = "/var/www/bigdata/".$folderName;
echo $file_folder_name;
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

echo "<br>";
$file_size = filesize($filename);
echo "This is the file size: ".$file_size;
echo "<br>";

$pdf_thumbnail = "convert -thumbnail x280 ".$file_new."pdf[0] ".$file_new."png";
system($pdf_thumbnail, $retval2);

$thumbnail = $file_new."png";
echo $thumbnail;
echo "<br>";

if (file_exists($thumbnail)) {
	$thumbnailcheck = null;
} else {
	$thumbnailcheck = "fail";
}

$query = "UPDATE `scraper`.`results` SET `converted` = 'Y' WHERE `results`.`url` = '".$urlfixed."';";

if ($stmt = mysqli_prepare($conn1, $query)) {
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
}

$query = "SELECT `file_size` FROM `docunator`.`file` WHERE `file`.`file_size` = '".$file_size."';";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $file_size_ex);
    while (mysqli_stmt_fetch($stmt)) {
	echo "Existing File Size: ".$file_size_ex;
	echo "<br>";
    }
    mysqli_stmt_close($stmt);
}

$query = "SELECT `user_file_name` FROM `docunator`.`user_file` WHERE `user_file`.`user_file_name` = '".$new_file_name."';";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $file_name1);
    while (mysqli_stmt_fetch($stmt)) {
	echo "Existing File Name: ".$file_name1;
	echo "<br>";
    }
    mysqli_stmt_close($stmt);
}

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

    if(($file_size < 20000))
    {
		echo 'The file is empty';  
		$rm_folder = "rm -R -f ".$file_folder_name;
		system($rm_folder, $retrm);
		error_msg('File is empty!'); 		
    }
    elseif(($check_extension == false))
    {
		echo "Invalid file type";
    	$rm_folder = "rm -R -f ".$file_folder_name;
		system($rm_folder, $retrm);		
    }
    elseif(($file_size > 10000001)){
    	echo 'The file is larger than 20 MB';  
    	$rm_folder = "rm -R -f ".$file_folder_name;
    	system($rm_folder, $retrm);
    	error_msg('File is too big!');    	
    }
    elseif(($file_url == $url)){
    	echo 'The file has already been scraped.';
    	$rm_folder = "rm -R -f ".$file_folder_name;
		system($rm_folder, $retrm);
    	error_msg('File already scraped!');		
    }
    elseif(($thumbnailcheck == "fail")){
    	echo 'The file is not renderable.';  
    	$rm_folder = "rm -R -f ".$file_folder_name;
		system($rm_folder, $retrm);
    	error_msg('This file sucks!'); 		
    }
	elseif(($file_size == $file_size_ex) && ($file_name1 ==	$new_file_name)){
		echo 'The file already exists';  
    	$rm_folder = "rm -R -f ".$file_folder_name;
		system($rm_folder, $retrm);
		error_msg('File already exists!'); 		
	}

	
	elseif(($valid == true) && ($user != "") && ($check_extension == true)){	
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
		$pdfcount = "pdfinfo ".$file_new."pdf | grep 'Pages' - | awk '{print $2}'";
		$pdfcountresult = system($pdfcount, $retval12);

		
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
		
		$file_chmod = "chmod -R 777 ".$file_folder;
		system($file_chmod, $retval);

		$conversion_string = "java -jar /var/www/mod/jodconverter4/lib/jodconverter-core-3.0-beta-4.jar ".$file_old." ".$file_new."pdf";
		system($conversion_string, $retval0);
		echo "<br>";
		
		$pdf_thumbnail = "convert -thumbnail x280 ".$file_new."pdf[1] ".$file_new."-1.png";
		system($pdf_thumbnail, $retval3);


		

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
   		//$ghostscript = "gs -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -dPDFSETTINGS=/screen -dNOPAUSE -dQUIET -dBATCH -sOutputFile=".$file_new."docunator1.pdf ".$file_new.".pdf";
		//echo $ghostscript;
		//system($ghostscript, $retval11);
		
		$file_chmod = "chmod -R 777 ".$file_folder;
		system($file_chmod, $retval);

		$pdfmetadata = "pdftk ".$file_new.".pdf update_info /var/www/css/in.info output ".$file_new."docunator.com.pdf";
		system($pdfmetadata, $retrm1);

		$rm = "rm ".$file_new."docunator.pdf";
		system($rm, $retrm);

		$rm = "rm ".$file_new."docunator1.pdf";
		system($rm, $retrm);
		
		$damn_file_name = str_replace(".", "", $command_file_name);
		
		$curlfile = rtrim($short_file_name, ".");
		
		$internalip = "/var/www/".$file_folder.$curlfile;
		echo $internalip;
		echo "<br>";
		echo $directory;
		echo "<br>";
		
		$index = "curl 'http://192.168.1.120:8983/solr/update/extract?&literal.id=".$folderName."&uprefix=attr_&fmap.content=body&commit=true' -F 'myfile=@".$internalip."docunator.com.pdf'";
		echo $index;
		
		//$index = "curl 'http://192.168.1.101:8983/solr/update/extract?&literal.id=".$folderName."&uprefix=attr_&fmap.content=body&commit=true' -F \"myfile=@/../../..".$file_new."pdf\"";

		shell_exec($index);
		system($index, $retval);
		
		$tika = "java -jar /var/www/mod/tika-app-1.3.jar -j ".$file_new.".pdf";
		$fuck = shell_exec($tika);
		echo "<br>";
		$array_json = utf8_encode_mix($fuck);
		$array_json = json_decode($array_json, true);
		$array_json = serialize($array_json);
		echo $array_json;

		$file_chmod = "chmod 755 ".$file_folder;
		system($file_chmod, $retval6);

		//this error coding should have headers
		$cmd_result = $retval.$retval0.$retval1.$retval2.$retval3.$retval4.$retval5.$retval6;

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

$quer = "INSERT INTO `docunator`.`user_file` (`user_name`, `system_file_name`, `user_file_name`, `short_name`, `user_ip`) VALUES ('".$user."', '".$folderName."', '".$new_file_name."', '".$short_file_name."', '".$user_ip."');";
ECHO $quer;
		
$query = "SELECT `file_size` FROM `docunator`.`file` WHERE `file`.`file_size` = '".$file_size."';";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $file_size_ex);
    while (mysqli_stmt_fetch($stmt)) {
	echo "Existing File Size: ".$file_size_ex;
	echo "<br>";
    }
    mysqli_stmt_close($stmt);
}
	
$query = "SELECT `user_file_name` FROM `docunator`.`user_file` WHERE `user_file`.`user_file_name` = '".$new_file_name."';";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $file_name1);
    while (mysqli_stmt_fetch($stmt)) {
	echo "Existing File Name: ".$file_name1;
	echo "<br>";
    }
    mysqli_stmt_close($stmt);
}

	if(($file_size == $file_size_ex) && ($file_name1 ==	$new_file_name)){
		echo 'The file already exists';  
    	$rm_folder = "rm -R -f ".$file_folder_name;
		system($rm_folder, $retrm);
		error_msg('File already exists!'); 		
	}
	
	
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
    	echo 'The file has already been scraped.';
    	$rm_folder = "rm -R -f ".$file_folder_name;
		system($rm_folder, $retrm);
    	error_msg('File already scraped!');		
    }

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
		if ($stmt = mysqli_prepare($conn, "INSERT INTO `docunator`.`user_file` (`user_name`,`system_file_name`,`user_file_name`, `short_name`, `user_ip`) VALUES (?,?,?,?,?)")); {
			mysqli_stmt_bind_param($stmt, "sssss", $user, $folderName, $new_file_name, $short_file_name, $user_ip);
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
		

		$copy_files = "cp -avr ".$file_folder_name." ".$bigdata_folder_name;
		echo $copy_files;
		system($copy_files, $retval10);
		
		$rm_folder = "rm -R -f ".$file_folder_name;
		system($rm_folder, $retrm);

		//email sent when file has been uploaded
		//$email = "joeemailaddy@gmail.com";
		//$from = "From: support@docunator.com \r\n";
		//$mesg = "New file uploaded here: http://192.168.0.46/".$folderName.".html \r\n";
		//mail($email, 'Welcome to 192.168.0.46/docunator BETA', $mesg, $from);
		
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