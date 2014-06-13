<?php
//this is where the file information is posted into the db
ini_set('max_execution_time', 0);
include("upload_functions.php");
include("upload_output.php");
include("db.php");
include("convert_functions.php");

 require_once("sessions.php");
 $sess = new SessionManager();
 session_start();
 
$conn100 = db_connect_100();
$conn110 = db_connect_110();
$conn120 = db_connect_120();
$conn130 = db_connect_130(); 

do_html_upper_upload();

$rand_folder = rand(1, 2);


 echo "<div class='one-half last'>";
 echo "<h1>Document Upload Results</h1>";

$contentLength = $rand_folder;
$user_file_name = $_FILES["file"]["name"];
$file_type = $_FILES["file"]["type"];
$file_size = $_FILES["file"]["size"];
$contentLength = $file_size;
if ($contentLength > 20000001) {
		echo 'The file is too large';		
		error_msg('File too large, 20MB max.'); 		
}
$file_temp = $_FILES["file"]["tmp_name"];
$file_mime_type = mime_content_type($_FILES["file"]["tmp_name"]);
$description = strip_tags(stripslashes($_POST["description"]));
$file_title_space = strip_tags(stripslashes($_POST["title"]));
$file_title = strip_tags(stripslashes(str_replace(" ", "_", $_POST["title"])));
$code = "code";
$taxo1 = $_POST["firstOption"];
echo "<strong>Category 1: </strong>".$taxo1;
echo "<br>";
if(isset($_POST["secondOption"]) != FALSE) {
$taxo2 = $_POST["secondOption"];
}
$rights = 0;
$hitcounter = 1;
$user_ip = $_SERVER['REMOTE_ADDR'];
echo "<strong>Upload IP: </strong>".$user_ip;
echo "<br>";
$user = $_SESSION['valid_user'];
//echo "<strong>Username: </strong>".$_SESSION['valid_user'];
echo "<br>";
$mysqltime = date("Y-m-d H:i:s");
echo "<strong>Filename: </strong>".$user_file_name;
echo "<br>";
echo "<strong>Mime Type: </strong>".$file_mime_type;
echo "<br>";
echo "<strong>Your Description: </strong>".$description;
echo "<br>";
echo "<strong>Your Title: </strong>".$file_title;
echo "<br>";
echo "<strong>Upload Time: </strong>".$mysqltime;
echo "<br>";

$valid = true;

$file_extension = get_extension($user_file_name);
echo "<strong>File Extension: </strong>".$file_extension;
echo "<br>";
$folderName = namefile($file_extension);
$check_extension = check_extension($file_extension);

echo "<strong>Valid Extension: </strong>".$check_extension;
echo "<br>";

    // check forms filled in
    if(!filled_out1($_POST))
    {
      echo 'You have not filled the form out correctly - please go back and try again.';   
    }
    elseif(($_FILES["file"]["error"] > 0) OR ($check_extension == false))
    {
		echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
		echo "Invalid file type";
    } 
	elseif(($valid == true) && ($user != "") && ($check_extension == true))
	{
		echo "<strong>Header: </strong>".$file_type."<br/>";
		echo "<strong>File Size: </strong>".$file_size." bytes<br/>";
		echo "<strong>File Name: </strong>".$user_file_name."<br/>";
		echo "<strong>New File Name: </strong>".$folderName."<br/>";
		echo "<br>";
		echo "<h3>";
		echo "<a href='viewer.php?doc=".$folderName."'>Here is your upload link!</a>";
		echo "</h3>";

		$file_folder_name = "/var/www/bigdata/".$rand_folder."/".$folderName;
		//echo $file_folder_name;
		mkdir($file_folder_name, 0777);
		chmod($file_folder_name, 0777);
		
		//read and close
		$lfhandler = fopen($file_temp, "r");
		$lfcontent = fread($lfhandler, filesize($file_temp));
		fclose ($lfhandler);
		//write and close
		
		$new_file_name = str_replace(" ", "_", $user_file_name);
		$new_file_name = mysql_escape_mimic($new_file_name);
		$short_file_name = $new_file_name;
		$short_file_name = str_replace($file_extension, "", $short_file_name);

		$destination_file = "/var/www/bigdata/".$rand_folder."/".$folderName."/".$new_file_name;
		
		$lfhandler = fopen($destination_file, "w");
		fwrite($lfhandler, $lfcontent);
		fclose ($lfhandler);

		$file_folder = "/var/www/bigdata/".$rand_folder."/".$folderName."/";
		$file_old = $file_folder.$new_file_name;

		$command_file_name = $new_file_name;
		$command_file_name = str_replace($file_extension, "", $command_file_name);
		$file_new = $file_folder.$command_file_name;

		echo "<h3>";
		echo "<a href='bigdata/".$rand_folder."/".$folderName."/".$file_new."pdf'>Here is your PDF file link!</a>";
		echo "</h3>";

		echo "<h3>";
		echo "<a href='bigdata/".$rand_folder."/".$folderName."/".$file_new.$file_extension."'>Here is your original file link!</a>";
		echo "</h3>";
		
		$file_chmod = "chmod -R 777 ".$file_folder;
		system($file_chmod, $retval);		

		$conversion_string = "java -jar mod/jodconverter4/lib/jodconverter-core-3.0-beta-4.jar ".$file_old." ".$file_new."pdf";
		system($conversion_string, $retval0);

		echo "</ br>";
		echo "Iframe Embed Code:";	
		echo "<textarea rows='1' cols='25' class='portfolio-item-preview' style=width:455px;height:100px;>";
		echo "<iframe src='http://doczine.com/iframe.php?doc=".$folderName."' width=100% height=100%></iframe>";
		echo "</textarea>";
		echo "</ br>";
		
		$pdf_thumbnail = "convert -thumbnail x280 ".$file_new."pdf[0] ".$file_new."png";
		system($pdf_thumbnail, $retval2);

		$pdfcount = "pdfinfo ".$file_new."pdf | grep 'Pages' - | awk '{print $2}'";
		$pdfcountresult = system($pdfcount, $retval12);
		echo "There are this many pages ".$pdfcountresult;

		$file_new = rtrim($file_new, ".");
		
		$file_chmod = "chmod -R 777 ".$file_folder;
		system($file_chmod, $retval);
	
		$damn_file_name = str_replace(".", "", $command_file_name);
		
		$internalip = $file_old;
		 
		$index = "curl 'http://192.168.1.50:8983/solr/update/extract?&literal.id=".$folderName."&uprefix=attr_&fmap.content=body&commit=true' -F \"myfile=@".$internalip.'"';
		system($index, $retval);

		$pdf_text = "pdftotext ".$file_new.".pdf ".$file_new.".txt";
		system($pdf_text, $retval5);		

		$file_chmod = "chmod 755 ".$file_folder;
		system($file_chmod, $retval6);

		unlink($file_temp);
		
		$cmd_result = "1";
		
		$tika = "java -jar /var/www/mod/tika-app-1.3.jar -j ".$file_new.".pdf";
		$fuck = shell_exec($tika);
		
		$array_json = utf8_encode_mix($fuck);
		$array_json = json_decode($array_json, true);
		$array_json = serialize($array_json);


		$folderName = mysqli_real_escape_string($conn100, $folderName);
		$file_size = mysqli_real_escape_string($conn100, $file_size);
		$mysqltime = mysqli_real_escape_string($conn100, $mysqltime);
		$file_mime_type = mysqli_real_escape_string($conn100, $file_mime_type);
		$file_extension = mysqli_real_escape_string($conn100, $file_extension);
		$cmd_result = mysqli_real_escape_string($conn100, $cmd_result);
		$file_title = mysqli_real_escape_string($conn100, $file_title);
		$description = mysqli_real_escape_string($conn100, $description);
		$rights = mysqli_real_escape_string($conn100, $rights);
		$user = mysqli_real_escape_string($conn100, $user);
		$new_file_name = mysqli_real_escape_string($conn100, $new_file_name);
		$short_file_name = mysqli_real_escape_string($conn100, $short_file_name);
		$user_ip = mysqli_real_escape_string($conn100, $user_ip);
		$hitcounter = mysqli_real_escape_string($conn100, $hitcounter);
		
/*		
echo $folderName;
echo "folderName <br>";
echo $file_size;
echo "file_size <br>";
echo $mysqltime;
echo "mysqltime <br>";
echo $file_mime_type;
echo "file_mime_type <br>";
echo $file_extension;
echo "file_extension <br>";
echo $cmd_result;
echo "cmd_result <br>";
echo $file_title;
echo "file_title <br>";
echo $description;
echo "description <br>";
echo $rights;
echo "rights <br>";
echo $user;
echo "user <br>";
echo $new_file_name;
echo "new_file_name <br>";
echo $short_file_name;
echo "short_file_name <br>";
echo $user_ip;
echo "user_ip <br>";
echo $hitcounter;
echo "hitcounter <br>";
echo $rand_folder;
echo "rand_folder <br>";
*/		
	
		if ($stmt = mysqli_prepare($conn100, "INSERT INTO `docunator`.`file` (`system_file_name`,`file_size`,`file_timestamp`,`file_mime_type`,`file_extension`) VALUES (?,?,?,?,?)")); {
			mysqli_stmt_bind_param($stmt, "sssss", $folderName, $file_size, $mysqltime, $file_mime_type, $file_extension);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		$indexed = "Y";
		if ($stmt = mysqli_prepare($conn100, "INSERT INTO `docunator`.`file_transferred` (`system_file_name`,`file_transferred`,`indexed`) VALUES (?,?,?)")); {
			mysqli_stmt_bind_param($stmt, "sss", $folderName, $cmd_result, $indexed);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}	
		if ($stmt = mysqli_prepare($conn100, "INSERT INTO `docunator`.`file_title` (`system_file_name`,`file_title`,`file_description`) VALUES (?,?,?)")); {
			mysqli_stmt_bind_param($stmt, "sss", $folderName, $file_title, $description);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		if ($stmt = mysqli_prepare($conn100, "INSERT INTO `docunator`.`file_permission` (`system_file_name`,`rights_id`) VALUES (?,?)")); {
			mysqli_stmt_bind_param($stmt, "si", $folderName, $rights);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		if ($stmt = mysqli_prepare($conn100, "INSERT INTO `docunator`.`user_file` (`user_name`,`system_file_name`,`user_file_name`, `short_name`, `user_ip`, `folder`) VALUES (?,?,?,?,?,?)")); {
			mysqli_stmt_bind_param($stmt, "sssssi", $user, $folderName, $new_file_name, $short_file_name, $user_ip, $rand_folder);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		if ($stmt = mysqli_prepare($conn100, "INSERT INTO `docunator`.`file_hitcounter` (`system_file_name`,`file_hit_count`) VALUES (?,?)")); {
			mysqli_stmt_bind_param($stmt, "si", $folderName, $hitcounter);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}	
		$url = "upload";
		$seoterm = "upload";
		if ($stmt = mysqli_prepare($conn100, "INSERT INTO `docunator`.`file_url` (`system_file_name`,`url`,`seoterm`) VALUES (?,?,?)")); {
			mysqli_stmt_bind_param($stmt, "sss", $folderName, $url, $seoterm);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		if ($stmt = mysqli_prepare($conn100, "INSERT INTO `docunator`.`file_metadata` (`system_file_name`,`meta_data`) VALUES (?,?)")); {
			mysqli_stmt_bind_param($stmt, "ss", $folderName, $array_json);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		if ($stmt = mysqli_prepare($conn100, "INSERT INTO `docunator`.`file_counter` (`system_file_name`, `file_size`, `file_timestamp`, `file_mime_type`, `file_extension`) VALUES (?,?,?,?,?)")); {
			mysqli_stmt_bind_param($stmt, "sssss", $folderName, $file_size, $mysqltime, $file_mime_type, $file_extension);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		if ($stmt = mysqli_prepare($conn100, "INSERT INTO `docunator`.`file_location` (`system_file_name`, `folder`) VALUES (?,?)")); {
			mysqli_stmt_bind_param($stmt, "si", $folderName, $rand_folder);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		
		
		
		if ($stmt = mysqli_prepare($conn110, "INSERT INTO `docunator`.`file` (`system_file_name`,`file_size`,`file_timestamp`,`file_mime_type`,`file_extension`) VALUES (?,?,?,?,?)")); {
			mysqli_stmt_bind_param($stmt, "sssss", $folderName, $file_size, $mysqltime, $file_mime_type, $file_extension);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		$indexed = "Y";
		if ($stmt = mysqli_prepare($conn110, "INSERT INTO `docunator`.`file_transferred` (`system_file_name`,`file_transferred`,`indexed`) VALUES (?,?,?)")); {
			mysqli_stmt_bind_param($stmt, "sss", $folderName, $cmd_result, $indexed);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}	
		if ($stmt = mysqli_prepare($conn110, "INSERT INTO `docunator`.`file_title` (`system_file_name`,`file_title`,`file_description`) VALUES (?,?,?)")); {
			mysqli_stmt_bind_param($stmt, "sss", $folderName, $file_title, $description);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		if ($stmt = mysqli_prepare($conn110, "INSERT INTO `docunator`.`file_permission` (`system_file_name`,`rights_id`) VALUES (?,?)")); {
			mysqli_stmt_bind_param($stmt, "si", $folderName, $rights);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		if ($stmt = mysqli_prepare($conn100, "INSERT INTO `docunator`.`user_file` (`user_name`,`system_file_name`,`user_file_name`, `short_name`, `user_ip`, `folder`) VALUES (?,?,?,?,?,?)")); {
			mysqli_stmt_bind_param($stmt, "sssssi", $user, $folderName, $new_file_name, $short_file_name, $user_ip, $rand_folder);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		if ($stmt = mysqli_prepare($conn110, "INSERT INTO `docunator`.`file_hitcounter` (`system_file_name`,`file_hit_count`) VALUES (?,?)")); {
			mysqli_stmt_bind_param($stmt, "si", $folderName, $hitcounter);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}	
		$url = "upload";
		$seoterm = "upload";
		if ($stmt = mysqli_prepare($conn110, "INSERT INTO `docunator`.`file_url` (`system_file_name`,`url`,`seoterm`) VALUES (?,?,?)")); {
			mysqli_stmt_bind_param($stmt, "sss", $folderName, $url, $seoterm);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		if ($stmt = mysqli_prepare($conn110, "INSERT INTO `docunator`.`file_metadata` (`system_file_name`,`meta_data`) VALUES (?,?)")); {
			mysqli_stmt_bind_param($stmt, "ss", $folderName, $array_json);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		if ($stmt = mysqli_prepare($conn110, "INSERT INTO `docunator`.`file_counter` (`system_file_name`, `file_size`, `file_timestamp`, `file_mime_type`, `file_extension`) VALUES (?,?,?,?,?)")); {
			mysqli_stmt_bind_param($stmt, "sssss", $folderName, $file_size, $mysqltime, $file_mime_type, $file_extension);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		if ($stmt = mysqli_prepare($conn110, "INSERT INTO `docunator`.`file_location` (`system_file_name`, `folder`) VALUES (?,?)")); {
			mysqli_stmt_bind_param($stmt, "si", $folderName, $rand_folder);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		
		
		
		
		
			
		if ($stmt = mysqli_prepare($conn120, "INSERT INTO `docunator`.`file` (`system_file_name`,`file_size`,`file_timestamp`,`file_mime_type`,`file_extension`) VALUES (?,?,?,?,?)")); {
			mysqli_stmt_bind_param($stmt, "sssss", $folderName, $file_size, $mysqltime, $file_mime_type, $file_extension);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		$indexed = "Y";
		if ($stmt = mysqli_prepare($conn120, "INSERT INTO `docunator`.`file_transferred` (`system_file_name`,`file_transferred`,`indexed`) VALUES (?,?,?)")); {
			mysqli_stmt_bind_param($stmt, "sss", $folderName, $cmd_result, $indexed);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}	
		if ($stmt = mysqli_prepare($conn120, "INSERT INTO `docunator`.`file_title` (`system_file_name`,`file_title`,`file_description`) VALUES (?,?,?)")); {
			mysqli_stmt_bind_param($stmt, "sss", $folderName, $file_title, $description);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		if ($stmt = mysqli_prepare($conn120, "INSERT INTO `docunator`.`file_permission` (`system_file_name`,`rights_id`) VALUES (?,?)")); {
			mysqli_stmt_bind_param($stmt, "si", $folderName, $rights);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		if ($stmt = mysqli_prepare($conn100, "INSERT INTO `docunator`.`user_file` (`user_name`,`system_file_name`,`user_file_name`, `short_name`, `user_ip`, `folder`) VALUES (?,?,?,?,?,?)")); {
			mysqli_stmt_bind_param($stmt, "sssssi", $user, $folderName, $new_file_name, $short_file_name, $user_ip, $rand_folder);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		if ($stmt = mysqli_prepare($conn120, "INSERT INTO `docunator`.`file_hitcounter` (`system_file_name`,`file_hit_count`) VALUES (?,?)")); {
			mysqli_stmt_bind_param($stmt, "si", $folderName, $hitcounter);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}	
		$url = "upload";
		$seoterm = "upload";
		if ($stmt = mysqli_prepare($conn120, "INSERT INTO `docunator`.`file_url` (`system_file_name`,`url`,`seoterm`) VALUES (?,?,?)")); {
			mysqli_stmt_bind_param($stmt, "sss", $folderName, $url, $seoterm);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		if ($stmt = mysqli_prepare($conn120, "INSERT INTO `docunator`.`file_metadata` (`system_file_name`,`meta_data`) VALUES (?,?)")); {
			mysqli_stmt_bind_param($stmt, "ss", $folderName, $array_json);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		if ($stmt = mysqli_prepare($conn120, "INSERT INTO `docunator`.`file_counter` (`system_file_name`, `file_size`, `file_timestamp`, `file_mime_type`, `file_extension`) VALUES (?,?,?,?,?)")); {
			mysqli_stmt_bind_param($stmt, "sssss", $folderName, $file_size, $mysqltime, $file_mime_type, $file_extension);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		if ($stmt = mysqli_prepare($conn120, "INSERT INTO `docunator`.`file_location` (`system_file_name`, `folder`) VALUES (?,?)")); {
			mysqli_stmt_bind_param($stmt, "si", $folderName, $rand_folder);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		
		
		
		
		
		
			
		if ($stmt = mysqli_prepare($conn130, "INSERT INTO `docunator`.`file` (`system_file_name`,`file_size`,`file_timestamp`,`file_mime_type`,`file_extension`) VALUES (?,?,?,?,?)")); {
			mysqli_stmt_bind_param($stmt, "sssss", $folderName, $file_size, $mysqltime, $file_mime_type, $file_extension);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		$indexed = "Y";
		if ($stmt = mysqli_prepare($conn130, "INSERT INTO `docunator`.`file_transferred` (`system_file_name`,`file_transferred`,`indexed`) VALUES (?,?,?)")); {
			mysqli_stmt_bind_param($stmt, "sss", $folderName, $cmd_result, $indexed);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}	
		if ($stmt = mysqli_prepare($conn130, "INSERT INTO `docunator`.`file_title` (`system_file_name`,`file_title`,`file_description`) VALUES (?,?,?)")); {
			mysqli_stmt_bind_param($stmt, "sss", $folderName, $file_title, $description);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		if ($stmt = mysqli_prepare($conn130, "INSERT INTO `docunator`.`file_permission` (`system_file_name`,`rights_id`) VALUES (?,?)")); {
			mysqli_stmt_bind_param($stmt, "si", $folderName, $rights);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		if ($stmt = mysqli_prepare($conn100, "INSERT INTO `docunator`.`user_file` (`user_name`,`system_file_name`,`user_file_name`, `short_name`, `user_ip`, `folder`) VALUES (?,?,?,?,?,?)")); {
			mysqli_stmt_bind_param($stmt, "sssssi", $user, $folderName, $new_file_name, $short_file_name, $user_ip, $rand_folder);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		if ($stmt = mysqli_prepare($conn130, "INSERT INTO `docunator`.`file_hitcounter` (`system_file_name`,`file_hit_count`) VALUES (?,?)")); {
			mysqli_stmt_bind_param($stmt, "si", $folderName, $hitcounter);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}	
		$url = "upload";
		$seoterm = "upload";
		if ($stmt = mysqli_prepare($conn130, "INSERT INTO `docunator`.`file_url` (`system_file_name`,`url`,`seoterm`) VALUES (?,?,?)")); {
			mysqli_stmt_bind_param($stmt, "sss", $folderName, $url, $seoterm);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		if ($stmt = mysqli_prepare($conn130, "INSERT INTO `docunator`.`file_metadata` (`system_file_name`,`meta_data`) VALUES (?,?)")); {
			mysqli_stmt_bind_param($stmt, "ss", $folderName, $array_json);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		if ($stmt = mysqli_prepare($conn130, "INSERT INTO `docunator`.`file_counter` (`system_file_name`, `file_size`, `file_timestamp`, `file_mime_type`, `file_extension`) VALUES (?,?,?,?,?)")); {
			mysqli_stmt_bind_param($stmt, "sssss", $folderName, $file_size, $mysqltime, $file_mime_type, $file_extension);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		if ($stmt = mysqli_prepare($conn130, "INSERT INTO `docunator`.`file_location` (`system_file_name`, `folder`) VALUES (?,?)")); {
			mysqli_stmt_bind_param($stmt, "si", $folderName, $rand_folder);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		
		
		//email sent when file has been uploaded
		$email = "joeemailaddy@gmail.com";
		$from = "contact@docunator.com";
		$mesg = "New file uploaded here: http://doczine.com/viewer.php?doc=".$folderName;
		mail($email, 'Welcome to Doczine.com BETA', $mesg, $from);
		
	}
	else 
	{
      echo "Invalid File Format, or captcha"; 
}
echo "</div>";
mysqli_close($conn100);
mysqli_close($conn110);
mysqli_close($conn120);
mysqli_close($conn130);

?>
