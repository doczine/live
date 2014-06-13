<?php
//this is where the file information is posted into the db
ini_set('max_execution_time', 0);
include("upload_functions.php");
include("upload_output.php");
include("db.php");
include("convert_functions.php");

function chmod_R($path, $filemode, $dirmode) {
    if (is_dir($path) ) {
        if (!chmod($path, $dirmode)) {
            $dirmode_str=decoct($dirmode);
            print "Failed applying filemode '$dirmode_str' on directory '$path'\n";
            print "  `-> the directory '$path' will be skipped from recursive chmod\n";
            return;
        }
        $dh = opendir($path);
        while (($file = readdir($dh)) !== false) {
            if($file != '.' && $file != '..') {  // skip self and parent pointing directories
                $fullpath = $path.'/'.$file;
                chmod_R($fullpath, $filemode,$dirmode);
            }
        }
        closedir($dh);
    } else {
        if (is_link($path)) {
            print "link '$path' is skipped\n";
            return;
        }
        if (!chmod($path, $filemode)) {
            $filemode_str=decoct($filemode);
            print "Failed applying filemode '$filemode_str' on file '$path'\n";
            return;
        }
    }
}

require_once("sessions.php");
$sess = new SessionManager();
if(!isset($_SESSION['valid_user'])){
session_start();
}

$conn = db_connect_100();

$doc = strip_tags(stripslashes(($_GET['doc'])));

if (is_numeric($doc)) {
	$doc = display_file_counter($doc);
}

$bigdata_folder_name = display_bigdata_link($doc);
chmod($bigdata_folder_name, 0777);

$file = strip_tags(stripslashes(($_GET['file'])));
//echo $file;

$system_file_name = check_system_file_name($doc);
//echo $system_file_name;

$file_link = display_file_link($doc);
$new_file_link = display_newfile_link($doc);

$file_folder_name = "/var/www/ramdrive/".$system_file_name;
//echo $file_folder_name;
mkdir($file_folder_name, 0777);
chmod($file_folder_name, 0777);
 
if(($system_file_name == ""))
{
	echo 'No such file in database';
	error_msg('Please upload file!'); 		
}

switch ($file) {
case "html":
		$pdf_html = "pdftohtml -c -s -p ".$file_link.".pdf ".$new_file_link.".html";
		system($pdf_html, $retval4);
		$conversion_string = "java -jar /var/www/mod/jodconverter4/lib/jodconverter-core-3.0-beta-4.jar ".$file_link."html-html.html ".$new_file_link.".".$file;
		system($conversion_string, $retval0);
		chmod_R($file_folder_name, 0777, 0777);
		$download =  display_html_link($doc);
		$download_link = $download."-html.html";
		$header = "Location: ".$download_link;
		header($header);
return true;
break;
case "pdf":
return true;
break;
case "rtf":
		$pdf_html = "pdftohtml -c -s -p ".$file_link.".pdf ".$new_file_link."html";
		system($pdf_html, $retval4);		
		$conversion_string = "java -jar /var/www/mod/jodconverter4/lib/jodconverter-core-3.0-beta-4.jar ".$new_file_link."html-html.html ".$bigdata_folder_name.".".$file;
		echo $conversion_string;
		system($conversion_string, $retval0);
		chmod_R($file_folder_name, 0777, 0777);
		$download =  display_download_link($doc);		
		$download_link = $download.".".$file;
		$header = "Location: ".$download_link;
		header($header);
return true;
break;
case "xls":


		$pdf_html = "pdftohtml -c -s -p ".$file_link.".pdf ".$new_file_link."html";
		echo $pdf_html;
		system($pdf_html, $retval4);
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
		system($pdf_html, $retval4);		
		$conversion_string = "java -jar /var/www/mod/jodconverter4/lib/jodconverter-core-3.0-beta-4.jar ".$new_file_link."html-html.html ".$bigdata_folder_name.".".$file;
		echo $conversion_string;
		chmod_R($file_folder_name, 0777, 0777);
		system($conversion_string, $retval0);
		$download =  display_download_link($doc);		
		$download_link = $download.".doc";
		$header = "Location: ".$download_link;
		header($header);
return true;
break;
case "docx":

		$pdf_html = "pdftohtml -c -s -p ".$file_link.".pdf ".$new_file_link."html";
		echo $pdf_html;
		system($pdf_html, $retval4);
		echo "<br>";
				
		$conversion_string = "java -jar /var/www/mod/jodconverter4/lib/jodconverter-core-3.0-beta-4.jar ".$file_link."-html.html ".$new_file_link.".".$file;
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

case "odt":
		$pdf_html = "pdftohtml -c -s -p ".$file_link.".pdf ".$new_file_link."html";
		system($pdf_html, $retval4);		
		$conversion_string = "java -jar /var/www/mod/jodconverter4/lib/jodconverter-core-3.0-beta-4.jar ".$new_file_link."html-html.html ".$bigdata_folder_name.".".$file;
		echo $conversion_string;
		chmod_R($file_folder_name, 0777, 0777);
		system($conversion_string, $retval0);
		$download =  display_download_link($doc);		
		$download_link = $download.".".$file;
		$header = "Location: ".$download_link;
		header($header);
return true;
break;

case "epub":
		$pdf_epub = "xvfb-run ebook-convert ".$file_link.".pdf ".$new_file_link.".".$file;
		echo $pdf_epub;
		system($pdf_epub, $retval4);		
		$download =  display_download_link($doc);
		$download_link = $download.".".$file;
		$header = "Location: ".$download_link;
		header($header);
		//xvfb-run ebook-convert /var/www/bigdata/1/1367087106_3120bfb734/nominados-grammys-esp.pdf /var/www/bigdata/1/1367087106_3120bfb734/nominados-grammys-esp.epub
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