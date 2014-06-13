<?php

ini_set('max_execution_time', 0);

include('db.php');

//query that will print viewer title with docid #

function display_viewer_title1($doc)
{
$conn = db_connect(); 
$query = "SELECT file_title FROM `docunator`.`file_title` WHERE `file_title`.`system_file_name` = '".$doc."';";

 
if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $file_description);
    while (mysqli_stmt_fetch($stmt)) {
       	$file_title = str_replace("_", " ", $file_description);
        echo $file_title;
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

//displays what categoires the file is in
function display_viewer_category($doc)
{
$conn = db_connect();
$query = "SELECT category_name FROM `docunator`.`file_category` WHERE `file_category`.`system_file_name` = '".$doc."';";


if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $category_name);
    while (mysqli_stmt_fetch($stmt)) {
        printf ("%s", $category_name);
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

//displays who uploaded the document
function display_viewer_username($doc)
{
$conn = db_connect();
$query = "SELECT user_name FROM `docunator`.`user_file` WHERE `user_file`.`system_file_name` = '".$doc."';";


if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $user_name);
    while (mysqli_stmt_fetch($stmt)) {
        printf ("%s", $user_name);
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

//displays the description of the document
function display_viewer_description($doc)
{
$conn = db_connect();
$query = "SELECT file_description FROM `docunator`.`file_title` WHERE `file_title`.`system_file_name` = '".$doc."';";


if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $file_description);
    while (mysqli_stmt_fetch($stmt)) {
        printf ("%s", $file_description);
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

//displays the comments that were made on the file
function display_viewer_comment($doc)
{
$conn = db_connect();
$query = "SELECT file_comment, user_name, comment_date FROM `docunator`.`file_comment` WHERE `file_comment`.`system_file_name` = '".$doc."';";


if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $file_comment, $user_name, $comment_date);
    while (mysqli_stmt_fetch($stmt)) {
    
		echo "<div class='horizontal-line'>";
		echo "</div>";
		
    		echo "<li class='one-half web'>";
		echo "<h6>";
			printf ("%s", $file_comment);
		echo "</h6>";
		echo "<p>";
			printf ("%s", $user_name);
		echo "<br>";
			printf ("%s", $comment_date);
		echo "</p>";
		echo "</li>";
			
	
        }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

//displays the post a comment form
function display_comment_post($doc) {

  if(isset($_SESSION['valid_user']))
	{
		echo "<div class='horizontal-line'>";
		echo "</div>";	
		$update_doc = display_comment_filename($doc);
		echo "<form action='comment.php?doc=".$update_doc;
		echo "' method='post'>";
		echo "<p>";
		echo "<textarea name='comment' id='comment' required=''></textarea>";
		echo "</p>";
		echo "<br>";
		echo "<h3>Post a comment</h3>";
		do_html_captcha(); 
		echo "</form>";

	}
	else
	{
	
		
 if(isset($_SESSION['valid_user'])){
		echo $_SESSION['valid_user'];
 }	

		echo "To post a comment ";
		echo "<a href='http://doczine.com/login_form.php'>login here.";
		echo "<br>";
		echo "<br>";

	}

}

function do_html_captcha()
{

if(!isset($_SESSION['valid_user'])){
session_start();
}

if (empty($_POST)) { 
?>

<div style="width: 430px; float: center; height: 90px">
      <img id="siimage" align="center" style="padding-right: 0px; border: 0" src="securimage/securimage_show.php?sid=<?php echo md5(time()) ?>" />
<br />
        
        <!-- pass a session id to the query string of the script to prevent ie caching -->
        <a tabindex="-1" style="border-style: none" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = 'securimage/securimage_show.php?sid=' + Math.random(); return false"><img src="securimage/images/refresh.gif" alt="Reload Image" border="0" onclick="this.blur()" align="right" /></a>
</div>
<div style="clear: both"></div>
Code:<br />

<!-- NOTE: the "name" attribute is "code" so that $img->check($_POST['code']) will check the submitted form field -->
<input type="text" name="code" size="12" /><br /><br />
<input type="submit" id="submit-comment" value="Submit Form" />
</form>

<?php

	}
}

function display_viewer_filename($doc)
{
$conn = db_connect();
$query = "SELECT system_file_name FROM `docunator`.`file` WHERE `file`.`system_file_name` = '".$doc."';";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $system_file_name);
    while (mysqli_stmt_fetch($stmt)) {
        echo $system_file_name;
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}


function display_comment_filename($doc)
{
$conn = db_connect();
$query = "SELECT system_file_name FROM `docunator`.`file` WHERE `file`.`system_file_name` = '".$doc."';";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $system_file_name);
    while (mysqli_stmt_fetch($stmt)) {
        return $system_file_name;
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}


function viewer_hit_counter($doc)
{
$conn = db_connect();
$query = "SELECT max(file_hit_count) FROM `docunator`.`file_hitcounter` WHERE `file_hitcounter`.`system_file_name` = '".$doc."'";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $file_hit_count);
    while (mysqli_stmt_fetch($stmt)) {
        $hitcounter = $file_hit_count;
			}
		$hitcounter = ($hitcounter + 1);
		echo $hitcounter;
		$query = "UPDATE `docunator`.`file_hitcounter` SET `file_hit_count` = '".$hitcounter."' WHERE `file_hitcounter`.`system_file_name` = '".$doc."';";
        if ($result = mysqli_real_query($conn, $query)) {
				mysqli_stmt_close($stmt);
		}	
            
    }
    // close statement
mysqli_close($conn);
}

function get_file_title($docs)
{
$conn = db_connect();
$query = "SELECT file_title FROM `docunator`.`file_title` WHERE `file_title`.`system_file_name` = '".$docs."';";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $system_file_name);
    while (mysqli_stmt_fetch($stmt)) {
        echo $system_file_name;
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

function get_file_taxo1($docs)
{
$conn = db_connect();
$query = "SELECT taxo_1, taxo_2 FROM `docunator`.`file_taxonomy` WHERE `file_taxonomy`.`system_file_name` = '".$docs."';";


if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $taxo1, $taxo2);
    while (mysqli_stmt_fetch($stmt)) {
        echo $taxo1." / ".$taxo2;
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

function get_file_share_url($docs)
{
$conn = db_connect();

$query = "SELECT `file_counter` FROM `docunator`.`file_counter` WHERE `file_counter`.`system_file_name` = '".$docs."';";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $file_counter);
    while (mysqli_stmt_fetch($stmt)) {
        $return = "http://doczine.com/".$file_counter.".html#/".get_file_share_title($docs);
        return $return;
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

function get_file_share_title($docs)
{
$conn = db_connect();
$query = "SELECT file_title FROM `docunator`.`file_title` WHERE `file_title`.`system_file_name` = '".$docs."';";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $system_file_name);
    while (mysqli_stmt_fetch($stmt)) {
    	$system_file_name = str_replace(" ", "_", $system_file_name);
        return $system_file_name."/";
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

function get_file_url($docs)
{
$conn = db_connect();
$query = "SELECT taxo_1, taxo_2 FROM `docunator`.`file_taxonomy` WHERE `file_taxonomy`.`system_file_name` = '".$docs."';";


if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $taxo1, $taxo2);
    while (mysqli_stmt_fetch($stmt)) {
        $taxo1 = str_replace(" ", "_", $taxo1);
        $taxo2 = str_replace(" ", "_", $taxo2);
        echo $taxo1."/".$taxo2;
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

function get_file_title_url($docs)
{
$conn = db_connect();
$query = "SELECT file_title FROM `docunator`.`file_title` WHERE `file_title`.`system_file_name` = '".$docs."';";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $system_file_name);
    while (mysqli_stmt_fetch($stmt)) {
    	$system_file_name = str_replace(" ", "_", $system_file_name);
        echo $system_file_name."/";
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

function display_iframe_user_file($doc)
{
$conn = db_connect();
$query = "SELECT short_name FROM `docunator`.`user_file` WHERE `user_file`.`system_file_name` = '".$doc."';";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $file_name);
    while (mysqli_stmt_fetch($stmt)) {
        return $file_name;
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

function display_txt_filename($docs)
{
$conn = db_connect();
$query = "SELECT `system_file_name`, `user_name`, `user_file_name`, `short_name`, `folder` FROM `docunator`.`user_file` WHERE `user_file`.`system_file_name` = '".$docs."';";
if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $system_file_name, $user_name, $user_file_name, $short_name, $folder);
    while (mysqli_stmt_fetch($stmt)) {
    
    
    
		//$myFile = "http://doczine.com/bigdata/".$folder."/".$system_file_name."/".$short_name."pdf";
		$filename = "/var/www/bigdata/".$folder."/".$system_file_name."/".$short_name."txt";
		
		//$txtFile = "http://doczine.com/bigdata/2/1366767492_e2b86956ed/tachyons.txt";
		//$filename = "/var/www/bigdata/2/1366767492_e2b86956ed/tachyons.txt";

		$handle = fopen($filename, "r");
		$contents = fread($handle, filesize($filename));
		echo $contents;
		fclose($handle);

    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}


function display_iframe_filename($doc)
{
$conn = db_connect();
$query = "SELECT system_file_name FROM `docunator`.`file` WHERE `file`.`system_file_name` = '".$doc."';";
if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $system_file_name);
    while (mysqli_stmt_fetch($stmt)) {
	echo "<iframe src='http://doczine.com/iframe.php?doc=".$system_file_name."' width=100% height=100%></iframe>";
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

function display_viewer_user_file($doc)
{
$conn = db_connect();
$query = "SELECT short_name FROM `docunator`.`user_file` WHERE `user_file`.`system_file_name` = '".$doc."';";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $file_name);
    while (mysqli_stmt_fetch($stmt)) {
        echo $file_name."swf";
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

function display_download_links($doc)
{

$conn = db_connect();

$query = "
SELECT `system_file_name`, `short_name`, `user_file_name`, `folder`, `file_extension`
FROM `docunator`.`user_file`
WHERE `user_file`.`system_file_name` ='".$doc."';";

if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $system_file_name, $short_name, $user_file_name, $folder);
		while (mysqli_stmt_fetch($stmt)) {
		echo "<p>";
		$trim_period = rtrim($short_name, '.');
		echo "<h3>";
		//echo "<a href='bigdata/".$system_file_name."/".$trim_period.".html 'target=_blank'>View HTML</a>";
		//echo "<br>";
		echo "<a href='http://doczine.com/bigdata/".$folder."/".$system_file_name."/".$trim_period.".pdf'>Download PDF</a>";
		echo "<br>";
		echo "<a href='http://doczine.com/bigdata/".$folder."/".$system_file_name."/".$user_file_name."'>Download Original</a>";
		echo "<br>";
		//echo "<a href='bigdata/".$system_file_name."/".$short_name."txt'>Download Text</a>";
		//echo "<br>"; 
		echo "</h3>";
		echo "</p>";
		}

		mysqli_stmt_close($stmt);
	}
	mysqli_close($conn);
}

function display_thumbnail($doc)
{

$conn = db_connect();

$query = "
SELECT `system_file_name`, `short_name`, `user_file_name`, `folder`
FROM `docunator`.`user_file`
WHERE `user_file`.`system_file_name` ='".$doc."';";

if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $system_file_name, $short_name, $user_file_name, $folder);
		while (mysqli_stmt_fetch($stmt)) {

		$trim_period = rtrim($short_name, '.');

		echo "<img src='http://image".$folder.".doczine.com/".$system_file_name."/".$short_name.".png'/>";							

		}
		mysqli_stmt_close($stmt);
	}
	mysqli_close($conn);
}


function display_conversion_links($doc)
{

$conn = db_connect();

$query = "
SELECT `system_file_name`, `short_name`, `user_file_name`, `folder`, `file_extension`
FROM `docunator`.`user_file`
INNER JOIN `docunator`.`file`
USING ( system_file_name )
WHERE `user_file`.`system_file_name` ='".$doc."';";

if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $system_file_name, $short_name, $user_file_name, $folder, $file_extension);
		while (mysqli_stmt_fetch($stmt)) {
		$trim_period = rtrim($short_name, '.');
		echo "<a href='http://doczine.com/bigdata/".$folder."/".$system_file_name."/".$short_name.$file_extension."'><img src='http://doczine.com/images/ORIGINAL_FILE.png' alt='Download Original File' ; width='110' height='110'/></a>";
		echo "<a href='http://doczine.com/bigdata/".$folder."/".$system_file_name."/".$short_name."pdf'><img src='http://doczine.com/images/PDF.png' alt='Convert to PDF' ; width='110' height='110'/></a>";
		//http://doczine.com/html/1365852872_895f310e5c.html
		echo "<a href='http://doczine.com/html/".$system_file_name.".html'><img src='http://doczine.com/images/HTML.png' alt='Convert to HTML' ; width='110' height='110'/></a>";
		//echo "<a href='http://doczine.com/convert.php?file=xml&doc=".$system_file_name."'><img src='http://doczine.com/images/XML.png' alt=' ; width='110' height='110'/></a>";
		//echo "<a href='http://doczine.com/convert.php?file=url&doc=".$system_file_name."'><img src='http://doczine.com/images/URL.png' alt=' ; width='110' height='110	'/></a>";
		//echo "<a href='http://doczine.com/convert.php?file=html&doc=".$system_file_name."'><img src='http://doczine.com/images/HTML.png' alt=' ; width='110' height='110'/></a>";

		//echo "<a href='http://doczine.com/convert.php?file=docx&doc=".$system_file_name."'><img src='http://doczine.com/images/DOCX.png' alt=' ; width='110' height='110'/></a>";
		echo "<a href='http://doczine.com/convert.php?file=doc&doc=".$system_file_name."'><img src='http://doczine.com/images/DOC.png' alt=' ; width='110' height='110'/></a>";
		//echo "<a href='http://doczine.com/convert.php?file=rtf&doc=".$system_file_name."'><img src='http://doczine.com/images/RTF.png' alt=' ; width='110' height='110'/></a>";
		//echo "<a href='http://doczine.com/convert.php?file=txt&doc=".$system_file_name."'><img src='http://doczine.com/images/TXT.png' alt=' ; width='110' height='110'/></a>";

		//echo "<a href='http://doczine.com/convert.php?file=xlsx&doc=".$system_file_name."'><img src='http://doczine.com/images/XLSX.png' alt=' ; width='110' height='110'/></a>";
		//echo "<a href='http://doczine.com/convert.php?file=xls&doc=".$system_file_name."'><img src='http://doczine.com/images/XLS.png' alt=' ; width='110' height='110'/></a>";
		//echo "<a href='http://doczine.com/convert.php?file=pptx&doc=".$system_file_name."'><img src='http://doczine.com/images/PPTX.png' alt=' ; width='110' height='110'/></a>";
		//echo "<a href='http://doczine.com/convert.php?file=tif&doc=".$system_file_name."'><img src='http://doczine.com/images/TIF.png' alt=' ; width='110' height='110'/></a>";

		}

		mysqli_stmt_close($stmt);
	}
	mysqli_close($conn);
}


function display_flexpaper_link($doc)
{

$conn = db_connect();

$query = "
SELECT `system_file_name`, `short_name`, `user_file_name`
FROM `docunator`.`user_file`
WHERE `user_file`.`system_file_name` ='".$doc."';";
 
if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $system_file_name, $short_name, $user_file_name);
		while (mysqli_stmt_fetch($stmt)) {
		$trim_period = rtrim($short_name, ".");
		echo "PDFFile : 'bigdata/".$system_file_name."/".$trim_period."docunator.com.pdf',";
		}

		mysqli_stmt_close($stmt);
	}
	mysqli_close($conn);
}


function display_images1($doc) {

$conn = db_connect();

$query = "
SELECT `system_file_name`, `short_name`, `user_file_name`, `folder`
FROM `docunator`.`user_file`
WHERE `user_file`.`system_file_name` ='".$doc."';";

if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $system_file_name, $short_name, $user_file_name, $folder);
		while (mysqli_stmt_fetch($stmt)) {

		echo "http://image".$folder.".doczine.com/".$system_file_name."/".$short_name."png";

		}  
 
		mysqli_stmt_close($stmt);
	}
	mysqli_close($conn);
}


function display_images2($doc)
{

$conn = db_connect();

$query = "
SELECT `system_file_name`, `short_name`, `user_file_name`
FROM `docunator`.`user_file`
WHERE `user_file`.`system_file_name` ='".$doc."';";

if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $system_file_name, $short_name, $user_file_name);
		while (mysqli_stmt_fetch($stmt)) {
		echo "http://doczine.com/bigdata/".$system_file_name."/".$short_name."-1.png";
		}  
		mysqli_stmt_close($stmt);
	}
	mysqli_close($conn);
}


function display_mobile_link($doc) 
{

$conn = db_connect();

$query = "
SELECT `system_file_name`, `short_name`, `user_file_name`, `folder`
FROM `docunator`.`user_file`
WHERE `user_file`.`system_file_name` ='".$doc."';";

if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $system_file_name, $short_name, $user_file_name, $folder);
		while (mysqli_stmt_fetch($stmt)) {
		$trim_period = rtrim($short_name, ".");
		$link = "http://doczine.com/bigdata/".$folder."/".$system_file_name."/".$short_name."pdf";
		return $link;
		}

		mysqli_stmt_close($stmt);
	}
	mysqli_close($conn);
}

function display_file_link($doc) 
{

$conn = db_connect();

$query = "
SELECT `system_file_name`, `short_name`, `user_file_name`, `folder`
FROM `docunator`.`user_file`
WHERE `user_file`.`system_file_name` ='".$doc."';";

if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $system_file_name, $short_name, $user_file_name, $folder);
		while (mysqli_stmt_fetch($stmt)) {
		$link = "http://doczine.com/bigdata/".$folder."/".$system_file_name."/".$short_name."pdf";
		return $link;
		}

		mysqli_stmt_close($stmt);
	}
	mysqli_close($conn);
}



function display_user_filename($doc)
{

$conn = db_connect();

$query = "
SELECT `system_file_name`, `short_name`, `user_file_name`
FROM `docunator`.`user_file`
WHERE `user_file`.`system_file_name` ='".$doc."';";

if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $system_file_name, $short_name, $user_file_name);
		while (mysqli_stmt_fetch($stmt)) {
		$user_file = str_replace("_", " ", $user_file_name);
		echo $user_file;
		}
		mysqli_stmt_close($stmt);
	}
	mysqli_close($conn);
}


function display_flexpaper_test($doc)
{
$conn = db_connect();
$query = "SELECT system_file_name FROM `docunator`.`file`';";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $system_file_name);
    while (mysqli_stmt_fetch($stmt)) {
        return $system_file_name;
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

function display_metadata($docs) {

$conn = db_connect();
if ($docs != "") {

$query = "SELECT `system_file_name`, `meta_data` FROM `docunator`.`file_metadata` WHERE `file_metadata`.`system_file_name` ='".$docs."';";

if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $system_file_name, $meta_data);		
			while (mysqli_stmt_fetch($stmt)) {

			$meta_data = unserialize($meta_data);
				
			foreach ($meta_data as $key => $value){
					$order   = array("\r\n", "\n", "\r");
					$replace = '';
					$key = str_replace($order, $replace, $key);
					$value = str_replace($order, $replace, $value);						
echo "$key: $value";
echo "
";
			}

		}
		mysqli_stmt_close($stmt);
		}
		
			$query = "UPDATE `docunator`.`file_transferred` SET `indexed` = 'Y' WHERE `file_transferred`.`system_file_name` = '".$docs."';";

			if ($stmt = mysqli_prepare($conn, $query)) {
				mysqli_stmt_execute($stmt);
				mysqli_stmt_close($stmt);
			}
		
	}
	mysqli_close($conn);
}


//displays the system file name based on the file_counter number
function display_file_counter($doc)
{
$conn = db_connect();
$query = "SELECT `system_file_name` FROM `docunator`.`file_counter` WHERE `file_counter`.`file_counter` = '".$doc."';";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $file_counter);
    while (mysqli_stmt_fetch($stmt)) {

    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
return $file_counter;
}

function display_conversion_footer($doc)
{

$conn = db_connect();

$query = "
SELECT `system_file_name`, `short_name`, `user_file_name`, `folder`, `file_extension`
FROM `docunator`.`user_file`
INNER JOIN `docunator`.`file`
USING ( system_file_name )
WHERE `user_file`.`system_file_name` ='".$doc."';";


if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $system_file_name, $short_name, $user_file_name, $folder, $file_extension);
		while (mysqli_stmt_fetch($stmt)) {
		$trim_period = rtrim($short_name, '.');

		echo "<li style='height: 40px; width: 40px; font-size: 12px; margin:0 0 0 0; padding:0 0 0 0;'>";
		echo "<a href='http://doczine.com/bigdata/".$folder."/".$system_file_name."/".$short_name.$file_extension."'><img src='http://doczine.com/images/ORIGINAL_FILE.png' width='40' height='40' title='Download Original File'/></a>";
		echo "</li>";

		echo "<li style='height: 40px; width: 40px; font-size: 12px; margin:0 0 0 0; padding:0 0 0 0;'>";
		echo "<a href='http://doczine.com/bigdata/".$folder."/".$system_file_name."/".$short_name."pdf'><img src='http://doczine.com/images/PDF.png' width='40' height='40' title='Download as PDF'/></a>";
		echo "</li>";

		echo "<li style='height: 40px; width: 40px; font-size: 12px; margin:0 0 0 0; padding:0 0 0 0;'>";
		echo "<a href='http://doczine.com/convert.php?doc=".$system_file_name."&file=html'><img src='http://doczine.com/images/HTML.png' width='40' height='40' title='Convert to HTML, may take a moment'/></a>";
		echo "</li>";

		echo "<li style='height: 40px; width: 40px; font-size: 12px; margin:0 0 0 0; padding:0 0 0 0;'>";
		echo "<a href='http://doczine.com/bigdata/".$folder."/".$system_file_name."/".$short_name."txt'><img src='http://doczine.com/images/TXT.png' width='40' height='40' title='Download as Text'/></a>";
		echo "</li>";

		//echo "<a href='http://doczine.com/bigdata/".$folder."/".$system_file_name."/".$short_name."pdf'><img src='http://doczine.com/images/PDF.png' alt='Convert to PDF' ; width='110' height='110'/></a>";
		//http://doczine.com/html/1365852872_895f310e5c.html
		//echo "<a href='http://doczine.com/html/".$system_file_name.".html'><img src='http://doczine.com/images/HTML.png' alt='Convert to HTML' ; width='110' height='110'/></a>";
		//echo "<a href='http://doczine.com/convert.php?file=xml&doc=".$system_file_name."'><img src='http://doczine.com/images/XML.png' alt=' ; width='110' height='110'/></a>";
		//echo "<a href='http://doczine.com/convert.php?file=url&doc=".$system_file_name."'><img src='http://doczine.com/images/URL.png' alt=' ; width='110' height='110	'/></a>";
		//echo "<a href='http://doczine.com/convert.php?file=html&doc=".$system_file_name."'><img src='http://doczine.com/images/HTML.png' alt=' ; width='110' height='110'/></a>";

		//echo "<a href='http://doczine.com/convert.php?file=docx&doc=".$system_file_name."'><img src='http://doczine.com/images/DOCX.png' alt=' ; width='110' height='110'/></a>";
		echo "<a href='http://doczine.com/convert.php?file=doc&doc=".$system_file_name."'><img src='http://doczine.com/images/DOC.png' alt='' width='40' height='40' title='Download as DOC, may take a moment'/></a>";
		echo "<a href='http://doczine.com/convert.php?file=rtf&doc=".$system_file_name."'><img src='http://doczine.com/images/RTF.png' alt='' width='40' height='40' title='Download as RTF, may take a moment'/></a>";
		echo "<a href='http://doczine.com/convert.php?file=odt&doc=".$system_file_name."'><img src='http://doczine.com/images/ODT.png' alt='' width='40' height='40' title='Download as ODT, may take a moment'/></a>";
		echo "<a href='http://doczine.com/convert.php?file=epub&doc=".$system_file_name."'><img src='http://doczine.com/images/EPUB.png' alt='' width='40' height='40' title='Download as EPUB, may take a moment'/></a>";


		//echo "<a href='http://doczine.com/convert.php?file=rtf&doc=".$system_file_name."'><img src='http://doczine.com/images/RTF.png' alt=' ; width='110' height='110'/></a>";
		//echo "<a href='http://doczine.com/convert.php?file=txt&doc=".$system_file_name."'><img src='http://doczine.com/images/TXT.png' alt=' ; width='110' height='110'/></a>";

		//echo "<a href='http://doczine.com/convert.php?file=xlsx&doc=".$system_file_name."'><img src='http://doczine.com/images/XLSX.png' alt=' ; width='110' height='110'/></a>";
		//echo "<a href='http://doczine.com/convert.php?file=xls&doc=".$system_file_name."'><img src='http://doczine.com/images/XLS.png' alt=' ; width='110' height='110'/></a>";
		//echo "<a href='http://doczine.com/convert.php?file=pptx&doc=".$system_file_name."'><img src='http://doczine.com/images/PPTX.png' alt=' ; width='110' height='110'/></a>";
		//echo "<a href='http://doczine.com/convert.php?file=tif&doc=".$system_file_name."'><img src='http://doczine.com/images/TIF.png' alt=' ; width='110' height='110'/></a>";

		}

		mysqli_stmt_close($stmt);
	}
	mysqli_close($conn);
}

function do_html_footer_share($docs) {
?>
<div id="footer" style="width:100%;"><!-- BEGIN FOOTER CONTAINER -->
    <ul id="footer_menu" style="margin-left:300px; margin-right:300px;"><!-- Begin Footer Menu -->
                    
                
       
        <?php
        echo "<li style='height: 40px; width: 40px; font-size: 12px; margin:0 0 0 0; padding:0 0 0 0;'>";
		echo "<a href='http://doczine.com/home.php'><img src='http://doczine.com/images/home1.png' height=40 width=40></a>";
		echo "</li>";

        echo "<li style='height: 40px; width: 40px; font-size: 12px; margin:0 0 0 0; padding:0 0 0 0;'>";
		echo "<a href='http://doczine.com/user_form.php'><img src='http://doczine.com/images/signup1.png' height=40 width=40></a>";
		echo "</li>";

        echo "<li style='height: 40px; width: 40px; font-size: 12px; margin:0 0 0 0; padding:0 0 0 0;'>";
		echo "<a href='http://doczine.com/file_list.php?user=asdf'><img src='http://doczine.com/images/filelist.png' height=40 width=40></a>";
		echo "</li>";

        echo "<li style='height: 40px; width: 40px; font-size: 12px; margin:0 0 0 0; padding:0 0 0 0;'>";
		echo "<a href='http://doczine.com/category_list.php'><img src='http://doczine.com/images/browse1.png' height=40 width=40></a>";
		echo "</li>";

        echo "<li style='height: 40px; width: 40px; font-size: 12px; margin:0 0 0 0; padding:0 0 0 0;'>";
		echo "<a href='http://doczine.com/upload_form.php'><img src='http://doczine.com/images/upload1.png' height=40 width=40></a>";
		echo "</li>";
        
        $url = get_file_share_url($docs);
		$url = urlencode($url);
		$title = str_replace("_", " ", get_file_share_title($docs));
		$title = str_replace("/", "", $title)." ";
		$title = urlencode($title);

		echo "<li style='height: 40px; width: 40px; font-size: 12px; margin:0 0 0 0; padding:0 0 0 0;'>";
		echo "<a href='http://www.facebook.com/sharer/sharer.php?u=".$url.$title." 'target=_blank'><img src=/images/share_facebook.png height=40 width=40></a>";
		echo "</li>";
		
		echo "
        
    	 ";

		echo "<li style='height: 40px; width: 40px; font-size: 12px; margin:0 0 0 0; padding:0 0 0 0;'>";
		echo "<a href='http://www.linkedin.com/shareArticle?mini=true&url=".$url."&title=".$title." 'target=_blank'><img src=/images/share_linkedin.png height=40 width=40></a>";
		echo "</li>";

		echo "
        
    	 ";

		echo "<li style='height: 40px; width: 40px; font-size: 12px; margin:0 0 0 0; padding:0 0 0 0;'>";
		echo "<a href='http://twitter.com/intent/tweet?source=webclient&text=".$title.$url." 'target=_blank'><img src=/images/share_twitter.png height=40 width=40></a>";
		echo "</li>";
		
		echo "
        
    	 ";

		echo "<li style='height: 40px; width: 40px; font-size: 12px; margin:0 0 0 0; padding:0 0 0 0;'>";
		echo "<a href='mailto:?Subject=".$title."&Body=".$url."'><img src=/images/share_mail.png height=40 width=40></a>";	
		echo "</li>";
		

		display_conversion_footer($docs);
	
	    ?>

<p>
Beta
</p>

<!--
    	<li class="search" style="height: 39px; width: 300px; font-size: 12px; margin:0 0 0 0; padding:0 0 0 0;"> 
			<form accept-charset="utf-8" method="get" action="search.php">
			<input id="q" name="q" size="50" maxlength="255" style="height: 39px; width: 220px; font-size: 18px;  margin:0 0 0 0; padding:0 0 0 0;" value="" type="text">
			<input name="searchsubmit" value="SEARCH" type="submit" style="height: 48px; width: 70px; margin:0 0 0 0; padding:0 0 0 0; font-size: 12px;">
			</form>                
        </li>  
-->
        
    </ul><!-- End Footer Menu -->

</div><!-- END FOOTER CONTAINER -->
<?php
}



?>
