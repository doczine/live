<?php
//this is where the file information is posted into the db
ini_set('max_execution_time', 0);
include("upload_functions.php");
include("upload_output.php");
include("db.php");
include("convert_functions.php");

require_once("sessions.php");
$sess = new SessionManager();
if(!isset($_SESSION['valid_user'])){
session_start();
}

$conn = db_connect_100();

$doc = strip_tags(stripslashes(($_GET['doc'])));
echo $doc;
$file = strip_tags(stripslashes(($_GET['file'])));
echo $file;

$system_file_name = check_system_file_name($doc);
echo $system_file_name;

$file_link = display_file_link($doc);
$new_file_link = display_newfile_link($doc);


$file_folder_name = "/var/www/ramdrive/".$system_file_name;
echo $file_folder_name;
mkdir($file_folder_name, 0777);
chmod($file_folder_name, 0777);
 
if(($system_file_name == ""))
{
	echo 'No such file in database';
	error_msg('Please upload file!'); 		
}

switch ($file) {
case "pdf":

		$pdf_html = "pdftohtml -c -s -p ".$file_link.".pdf ".$new_file_link."html";
		echo $pdf_html;
		system($pdf_html, $retval4);
		echo "<br>";
				
		$conversion_string = "java -jar /var/www/mod/jodconverter4/lib/jodconverter-core-3.0-beta-4.jar ".$file_link."html-html.html ".$new_file_link.".".$file;
		echo $conversion_string;
		echo $conversion_string;
		system($conversion_string, $retval0);
		echo "<br>";

return true;
break;
case "rtf":

		$pdf_html = "pdftohtml -c -s -p ".$file_link.".pdf ".$new_file_link."html";
		echo $pdf_html;
		system($pdf_html, $retval4);
		echo "<br>";
				
		$conversion_string = "java -jar /var/www/mod/jodconverter4/lib/jodconverter-core-3.0-beta-4.jar ".$file_link."html-html.html ".$new_file_link.".".$file;
		echo $conversion_string;
		echo $conversion_string;
		system($conversion_string, $retval0);
		echo "<br>";
		
return true;
break;
case "xls":


		$pdf_html = "pdftohtml -c -s -p ".$file_link.".pdf ".$new_file_link."html";
		echo $pdf_html;
		system($pdf_html, $retval4);
		echo "<br>";
				
		$conversion_string = "java -jar /var/www/mod/jodconverter4/lib/jodconverter-core-3.0-beta-4.jar ".$file_link."html-html.html ".$new_file_link.".".$file;
		echo $conversion_string;
		echo $conversion_string;
		system($conversion_string, $retval0);
		echo "<br>";

return true;
break;
case "xlsx":
return true;
break;
case "txt":
return true;
break;
case "doc":

		$pdf_html = "pdftohtml -c -s -p ".$file_link.".pdf ".$new_file_link."html";
		echo $pdf_html;
		system($pdf_html, $retval4);
		echo "<br>";
				
		$conversion_string = "java -jar /var/www/mod/jodconverter4/lib/jodconverter-core-3.0-beta-4.jar ".$file_link."html-html.html ".$new_file_link.".".$file;
		echo $conversion_string;
		echo $conversion_string;
		system($conversion_string, $retval0);
		echo "<br>";

return true;
break;
case "docx":

		$pdf_html = "pdftohtml -c -s -p ".$file_link.".pdf ".$new_file_link."html";
		echo $pdf_html;
		system($pdf_html, $retval4);
		echo "<br>";
				
		$conversion_string = "java -jar /var/www/mod/jodconverter4/lib/jodconverter-core-3.0-beta-4.jar ".$file_link."html-html.html ".$new_file_link.".".$file;
		echo $conversion_string;
		echo $conversion_string;
		system($conversion_string, $retval0);
		echo "<br>";

return true;
break;
case "ppt":
return true;
break;
case "pptx":
return true;
break;
case "odf":
return true;
break;
case "odt":
return true;
break;
case "ods":
return true;
break;
case "tif":
return true;
break;
case "tiff":
return true;
break;
case "jpg":
return true;
break;
case "jpeg":
return true;
break;
case "png":
return true;
break;
case "gif":
return true;
break;
default:
return false;
}
 

mysqli_close($conn);
mysqli_close($conn1);
?>