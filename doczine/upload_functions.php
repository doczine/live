<?php

function mysql_escape_mimic($inp) {
    if(is_array($inp))
        return array_map(__METHOD__, $inp);

    if(!empty($inp) && is_string($inp)) {
        return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('', '', '', '', '', '', ''), $inp);
    }

    return $inp;
} 

function pass_captcha_value($valid) {
$valid = $valid;
}

function filled_out1($form_vars)
{
  // test that each variable has a value
  foreach ($form_vars as $key => $value)
  {
     if (!isset($key) || ($value == '')) 
        return false;
  } 
  return true;
}

//this gets the files extension
function get_extension($file,$length=-1)
{
	$p = strrpos($file,".");
	$p++;
		if($length!=-1)
		{
			$ext = substr($file,$p,$length);
		}
		if($length==-1)
		{
			$ext = substr($file,$p);
		}
	$ext = strtolower($ext);
	return $ext;
}

function user_file_name($file,$length=-1)
{
	$p = strrpos($file,"/");
	$p++;
		if($length!=-1)
		{
			$ext = substr($file,$p,$length);
		}
		if($length==-1)
		{
			$ext = substr($file,$p);
		}
	$ext = strtolower($ext);
	return $ext;
}

function get_filename($file,$length=-1)
{
	$p = strrpos($file,"/");
	$p++;
		if($length!=-1)
		{
			$ext = substr($file,$p,$length);
		}
		if($length==-1)
		{
			$ext = substr($file,$p);
		}
	$ext = strtolower($ext);
	return $ext;
}

//this creates a random file name
function namefile($fileextension)
{
    return time() ."_". substr(md5(microtime()), 0, mt_rand(10, 10));
}

function do_html_captcha()
{
if(!isset($_SESSION['valid_user'])){
session_start();
}
// Start the session where the code will be stored.
if (empty($_POST)) { 
?>
<div style="width: 430px; float: center; height: 90px">
      <img id="siimage" align="center" style="padding-right: 0px; border: 0" src="securimage/securimage_show.php?sid=<?php echo md5(time()) ?>" />
<br />
        
        <!-- pass a session id to the query string of the script to prevent ie caching -->
        <a tabindex="-1" style="border-style: none" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = 'securimage/securimage_show.php?sid=' + Math.random(); return false"><img src="securimage/images/refresh.gif" alt="Reload Image" border="0" onclick="this.blur()" align="right" /></a>
</div>
<div style="clear: both"></div>

<!-- NOTE: the "name" attribute is "code" so that $img->check($_POST['code']) will check the submitted form field -->
<input type="text" name="code" size="12" /><br />
<input type="hidden" name="MAX_FILE_SIZE" value="1000000000">
<input type="submit" value="Submit Form" />
</form>

<?php
	}
}

function display_upload_dropdown_1()
{
$conn = db_connect();
$query = "SELECT taxo_1  FROM `docunator`.`taxo_1`;";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $category_name);
    while (mysqli_stmt_fetch($stmt)) {
        echo "<option value='";
        printf ("%s", $category_name);    
		echo "'>";
		printf ("%s", $category_name);
		echo "</option>";
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

function display_upload_dropdown_2()
{
$conn = db_connect();
$query = "SELECT taxo_2  FROM `docunator`.`taxo_2`;";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $category_name);
    while (mysqli_stmt_fetch($stmt)) {
        echo "<option value='";
        printf ("%s", $category_name);    
		echo "'>";
		printf ("%s", $category_name);
		echo "</option>";
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

function display_upload_dropdown_3()
{
$conn = db_connect();
$query = "SELECT taxo_3  FROM `docunator`.`taxo_3`;";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $category_name);
    while (mysqli_stmt_fetch($stmt)) {
        echo "<option value='";
        printf ("%s", $category_name);    
		echo "'>";
		printf ("%s", $category_name);
		echo "</option>";
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

function display_upload_dropdown_4()
{
$conn = db_connect();
$query = "SELECT taxo_4  FROM `docunator`.`taxo_4`;";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $category_name);
    while (mysqli_stmt_fetch($stmt)) {
        echo "<option value='";
        printf ("%s", $category_name);    
		echo "'>";
		printf ("%s", $category_name);
		echo "</option>";
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

function display_upload_dropdown_5()
{
$conn = db_connect();
$query = "SELECT taxo_5  FROM `docunator`.`taxo_5`;";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $category_name);
    while (mysqli_stmt_fetch($stmt)) {
        echo "<option value='";
        printf ("%s", $category_name);    
		echo "'>";
		printf ("%s", $category_name);
		echo "</option>";
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

function check_extension($file)
{
switch ($file) {
case "pdf":
return true;
break;
case "rtf":
return true;
break;
case "xls":
return true;
break;
case "xlsx":
return true;
break;
case "txt":
return true;
break;
case "doc":
return true;
break;
case "docx":
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
}

//this returns the files mime type and then posts to the dbß
function check_mime($file)
{
switch ($file) {
case "application/andrew-inset":
echo "Valid";
break;
case "application/cu-seeme":
echo "Valid";
break;
case "application/vnd.ms-excel":
echo "Valid";
break;
case "application/mac-binhex40":
echo "Valid";
break;
case "application/mac-compactpro":
echo "Valid";
break;
case "application/msword":
echo "Valid";
break;
case "application/octet-stream":
echo "Valid";
break;
case "application/oda":
echo "Valid";
break;
case "application/pdf":
echo "Valid";
break;
case "application/pgp":
echo "Valid";
break;
case "application/postscript":
echo "Valid";
break;
case "application/vnd.ms-powerpoint":
echo "Valid";
break;
case "application/rtf":
echo "Valid";
break;
case "application/wordperfect5.1":
echo "Valid";
break;
case "application/x-123":
echo "Valid";
break;
case "application/x-Wingz":
echo "Valid";
break;
case "application/x-bcpio":
echo "Valid";
break;
case "application/x-cdlink":
echo "Valid";
break;
case "application/x-chess-pgn":
echo "Valid";
break;
case "application/x-compress":
echo "Valid";
break;
case "application/x-compress":
echo "Valid";
break;
case "application/x-cpio":
echo "Valid";
break;
case "application/x-csh":
echo "Valid";
break;
case "application/x-debian-package":
echo "Valid";
break;
case "application/x-director":
echo "Valid";
break;
case "application/x-dvi":
echo "Valid";
break;
case "application/x-gtar":
echo "Valid";
break;
case "application/x-gtar":
echo "Valid";
break;
case "application/x-gzip":
echo "Valid";
break;
case "application/x-hdf":
echo "Valid";
break;
case "application/x-koan":
echo "Valid";
break;
case "application/x-latex":
echo "Valid";
break;
case "application/x-maker":
echo "Valid";
break;
case "application/x-mif":
echo "Valid";
break;
case "application/x-msdos-program":
echo "Valid";
break;
case "application/x-netcdf":
echo "Valid";
break;
case "application/x-netcdf":
echo "Valid";
break;
case "application/x-ns-proxy-autoconfig":
echo "Valid";
break;
case "application/x-shar":
echo "Valid";
break;
case "application/x-stuffit":
echo "Valid";
break;
case "application/x-sv4cpio":
echo "Valid";
break;
case "application/x-sv4crc":
echo "Valid";
break;
case "application/x-tar":
echo "Valid";
break;
case "application/x-tex":
echo "Valid";
break;
case "application/x-texinfo":
echo "Valid";
break;
case "application/x-texinfo":
echo "Valid";
break;
case "application/x-troff":
echo "Valid";
break;
case "application/x-troff":
echo "Valid";
break;
case "application/x-troff":
echo "Valid";
break;
case "application/x-troff-man":
echo "Valid";
break;
case "application/x-troff-me":
echo "Valid";
break;
case "application/x-troff-ms":
echo "Valid";
break;
case "application/x-ustar":
echo "Valid";
break;
case "application/x-wais-source":
echo "Valid";
break;
case "application/zip":
echo "Valid";
break;
case "audio/basic":
echo "Valid";
break;
case "audio/basic":
echo "Valid";
break;
case "audio/midi":
echo "Valid";
break;
case "audio/mpeg":
echo "Valid";
break;
case "audio/x-aiff":
echo "Valid";
break;
case "audio/x-pn-realaudio":
echo "Valid";
break;
case "audio/x-realaudio":
echo "Valid";
break;
case "audio/x-wav":
echo "Valid";
break;
case "chemical/x-pdb":
echo "Valid";
break;
case "chemical/x-pdb":
echo "Valid";
break;
case "image/gif":
echo "Valid";
break;
case "image/ief":
echo "Valid";
break;
case "image/jpeg":
echo "Valid";
break;
case "image/png":
echo "Valid";
break;
case "image/tiff":
echo "Valid";
break;
case "image/tiff":
echo "Valid";
break;
case "image/x-cmu-raster":
echo "Valid";
break;
case "image/x-portable-anymap":
echo "Valid";
break;
case "image/x-portable-bitmap":
echo "Valid";
break;
case "image/x-portable-graymap":
echo "Valid";
break;
case "image/x-portable-pixmap":
echo "Valid";
break;
case "image/x-rgb":
echo "Valid";
break;
case "image/x-xbitmap":
echo "Valid";
break;
case "image/x-xpixmap":
echo "Valid";
break;
case "image/x-xwindowdump":
echo "Valid";
break;
case "model/iges":
echo "Valid";
break;
case "model/mesh":
echo "Valid";
break;
case "model/vrml":
echo "Valid";
break;
case "text/css":
echo "Valid";
break;
case "text/html":
echo "Valid";
break;
case "text/plain":
echo "Valid";
break;
case "text/richtext":
echo "Valid";
break;
case "text/tab-separated-values":
echo "Valid";
break;
case "text/x-setext":
echo "Valid";
break;
case "text/x-sgml":
echo "Valid";
break;
case "text/x-sgml":
echo "Valid";
break;
case "text/x-vCalendar":
echo "Valid";
break;
case "text/x-vCard":
echo "Valid";
break;
case "text/xml":
echo "Valid";
break;
case "video/dl":
echo "Valid";
break;
case "video/fli":
echo "Valid";
break;
case "video/gl":
echo "Valid";
break;
case "video/mpeg":
echo "Valid";
break;
case "video/mpeg":
echo "Valid";
break;
case "video/mpeg":
echo "Valid";
break;
case "video/mpeg":
echo "Valid";
break;
case "video/quicktime":
echo "Valid";
break;
case "video/quicktime":
echo "Valid";
break;
case "video/x-msvideo":
echo "Valid";
break;
case "video/x-sgi-movie":
echo "Valid";
break;
case "x-conference/x-cooltalk":
echo "Valid";
break;
case "application/octet-stream":
echo "Valid";
break;
case "application/vnd.oasis.opendocument.text":
echo "Valid";
break;
case "application/vnd.oasis.opendocument.presentation":
echo "Valid";
break;
case "application/vnd.oasis.opendocument.spreadsheet":
echo "Valid";
break;
case "application/vnd.sun.xml.writer":
echo "Valid";
break;
case "application/vnd.sun.xml.calc":
echo "Valid";
break;
case "application/vnd.sun.xml.draw":
echo "Valid";
break;
case "application/vnd.sun.xml.impress":
echo "Valid";
break;
case "application/vnd.sun.xml.math":
echo "Valid";
break;
case "application/vnd.oasis.opendocument.text-template":
echo "Valid";
break;
case "application/vnd.oasis.opendocument.graphics":
echo "Valid";
break;
case "application/vnd.oasis.opendocument.chart":
echo "Valid";
break;
case "application/vnd.oasis.opendocument.database":
echo "Valid";
break;
case "application/vnd.oasis.opendocument.chart":
echo "Valid";
break;
case "application/vnd.oasis.opendocument.formula":
echo "Valid";
break;
case "application/vnd.oasis.opendocument.graphics":
echo "Valid";
break;
case "application/vnd.oasis.opendocument.image":
echo "Valid";
break;
case "application/vnd.oasis.opendocument.text-master":
echo "Valid";
break;
case "application/vnd.oasis.opendocument.presentation":
echo "Valid";
break;
case "application/vnd.oasis.opendocument.spreadsheet":
echo "Valid";
break;
case "application/vnd.oasis.opendocument.text":
echo "Valid";
break;
case "application/vnd.oasis.opendocument.graphics-template":
echo "Valid";
break;
case "application/vnd.oasis.opendocument.text-web":
echo "Valid";
break;
case "application/vnd.oasis.opendocument.presentation-template":
echo "Valid";
break;
case "application/vnd.oasis.opendocument.spreadsheet-template":
echo "Valid";
break;
case "application/vnd.oasis.opendocument.text-template":
echo "Valid";
break;
case "application/vnd.stardivision.draw":
echo "Valid";
break;
case "application/vnd.stardivision.calc":
echo "Valid";
break;
case "application/vnd.stardivision.impress":
echo "Valid";
break;
case "application/vnd.stardivision.writer":
echo "Valid";
break;
case "application/vnd.stardivision.writer-global":
echo "Valid";
break;
case "application/vnd.stardivision.math":
echo "Valid";
break;
case "application/vnd.sun.xml.calc.template":
echo "Valid";
break;
case "application/vnd.sun.xml.draw.template":
echo "Valid";
break;
case "application/vnd.sun.xml.impress.template":
echo "Valid";
break;
case "application/vnd.sun.xml.writer.template":
echo "Valid";
break;
case "application/vnd.sun.xml.calc":
echo "Valid";
break;
case "application/vnd.sun.xml.draw":
echo "Valid";
break;
case "application/vnd.sun.xml.writer.global":
echo "Valid";
break;
case "application/vnd.sun.xml.impress":
echo "Valid";
break;
case "application/vnd.sun.xml.math":
echo "Valid";
break;
case "application/vnd.sun.xml.writer":
echo "Valid";
break;
default:
echo "Invalid";
	}
}

function error_msg($text) {
     # add other stuff you may want here
     $hello_var = 'Problem: '; //example of addon to beginning
     $goodbye_var = ' goodbye'; //example of addon to end
     die($hello_var.'<br />'.$text.'<br />'.$goodbye_var);
} 
 
function utf8_encode_mix($input, $encode_keys=false)
{
	if(is_array($input))
	{
		$result = array();
		foreach($input as $k => $v)
		{               
			$key = ($encode_keys)? utf8_encode($k) : $k;
			$result[$key] = utf8_encode_mix( $v, $encode_keys);
		}
	}
	else
	{
		$result = utf8_encode($input);
	}

	return $result;
}



?>
