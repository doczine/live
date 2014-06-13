<?php

function get_file_title($id)
{
$conn = db_connect_local();
$query = "SELECT short_name FROM `docunator`.`user_file` WHERE `user_file`.`system_file_name` = '".$id."';";


if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $short_name);
    while (mysqli_stmt_fetch($stmt)) {
        return $short_name;
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

function get_file_titlename($id)
{
$conn = db_connect_local();
$query = "SELECT file_title FROM `docunator`.`file_title` WHERE `file_title`.`system_file_name` = '".$id."';";


if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $short_name);
    while (mysqli_stmt_fetch($stmt)) {
       	$file_title = str_replace("_", " ", $short_name);
        return $file_title;
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

function get_file_metatitle($id)
{
$conn = db_connect_local();
$query = "SELECT `meta_title` FROM `docunator`.`file_metadata` WHERE `file_metadata`.`system_file_name` = '".$id."';";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $meta_title);
    while (mysqli_stmt_fetch($stmt)) {
        return $meta_title;
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

function get_file_taxo1($id)
{
$conn = db_connect_local();
$query = "SELECT taxo_1, taxo_2 FROM `docunator`.`file_taxonomy` WHERE `file_taxonomy`.`system_file_name` = '".$id."';";


if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $taxo1, $taxo2);
    while (mysqli_stmt_fetch($stmt)) {
        echo $taxo1;
        echo " / ";
        echo $taxo2;
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

function get_file_upload($id)
{

$conn = db_connect_local();

$query = "SELECT `file_timestamp` FROM `docunator`.`file` WHERE `file`.`system_file_name` = '".$id."';";

if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $file_timestamp);
		while (mysqli_stmt_fetch($stmt)) {
				return $file_timestamp;
		}
	 mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

function get_file_name($id)
{

$conn = db_connect_local();

$query = "SELECT `user_file_name` FROM `docunator`.`user_file` WHERE `user_file`.`system_file_name` = '".$id."';";

if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $file_timestamp);
		while (mysqli_stmt_fetch($stmt)) {
				return $file_timestamp;
		}
	 mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

function get_folder_name($id)
{
$conn = db_connect_local();

$query = "SELECT `folder` FROM `docunator`.`user_file` WHERE `user_file`.`system_file_name` = '".$id."';";
if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $folder);
		while (mysqli_stmt_fetch($stmt)) {
				return $folder;
		}
	 mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}


function get_file_counter($id)
{
$conn = db_connect_local();

$query = "SELECT `file_counter` FROM `docunator`.`file_counter` WHERE `file_counter`.`system_file_name` = '".$id."';";
if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $file_counter);
		while (mysqli_stmt_fetch($stmt)) {
				return $file_counter;
		}
	 mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}
 
function display_search_results($id, $i, $search)
{
//echo $search;
$file_title = get_file_titlename($id);
$last_modified = get_file_upload($id);
$file_name = get_file_name($id);
//$meta_title = get_file_metatitle($id); 
$folder = get_folder_name($id); 
$shortname = get_file_title($id);
$file_counter = get_file_counter($id);

if ( $file_name != "") {

?>				
						<div id="accordion<?php echo $i; ?>" style="width:1000px; color:#333;" >
						<h3> 
						<?php 
						echo "<p>";
						echo $file_title."   "; 
						echo "<br>";
						echo $file_name;
						echo "<br>";
						echo "<br>";
						//echo $meta_title;
						echo "<a href='http://doczine.com/".$file_counter.".html' class='button small round blue'>Read This Article</a>";			
						//echo "<img src='http://doczine.com/bigdata/".$folder."/".$id."/".$shortname."png' style='height:200px; background-color:white; color:white;'>";
						echo "</p>";				
						//echo $last_modified;
						?>
						</h3>
						<iframe id='frame<?php echo $i; ?>' src='' width="100%" height="100%">
						</iframe>
						</div>
						<p>
						<?php
 						//display_metadata($system_file_name);
						?>
						</p>
							<script type="text/javascript">
							$("#accordion<?php echo $i; ?>").accordion({ collapsible: true, active: false });
							$('#accordion<?php echo $i; ?>').click(function () { 
							$('#frame<?php echo $i; ?>').attr('src', '<?php echo "http://doczine.com/".$id.".html'"; ?>);
							});
							</script>
       		<?php
	}
}

function do_html_infinite_scroll() {
include('viewer_functions.php');

?>
<div id="postedComments">
<?php
ini_set('max_execution_time', 0);
$conn = db_connect_local();

$query = "
SELECT `system_file_name` , `file_title` , `short_name` , `file_timestamp`, `user_name`, `user_file_name`, `file_counter`
FROM `docunator`.`file_counter`
INNER JOIN `docunator`.`file_title`
USING ( system_file_name ) 
INNER JOIN `docunator`.`user_file`
USING ( system_file_name )
ORDER BY `file_counter`.`file_timestamp` DESC 
LIMIT 0, 10
;";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $system_file_name, $file_title, $short_name, $file_timestamp, $user_name, $user_file_name, $file_counter);
    while (mysqli_stmt_fetch($stmt)) { 
    
    $GLOBALS['myVar'] = $file_counter;
    
    //onclick="location.href='http://doczine.com/iframe.php?doc=1362686101_464de14e5f" class="lightbox" title="maximized=true" data-options="{&quot;width&quot;:1300, &quot;height&quot;:800, &quot;iframe&quot;: true}';"
	//   <div onclick="window.open('http://doczine.com/iframe.php?doc=1362686101_464de14e5f');" class='lightbox' title='maximized=true' data-options='{'width':1300, 'height':800, 'iframe': true}'">test</div> 
// <a href="#" onClick="window.open('<iframe width="560" height="315" src="http://www.youtube.com/embed/wrqlWXbOA4o?rel=0" frameborder="0" allowfullscreen></iframe>','bla','width=560, height=315, toolbar=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes')">klick here</a>  

    		echo "<div class='one'>";    	
			echo "<div class='postedComment' id='".$file_counter."'>";
			?>
			<h3> 	
			<a href="<?php echo "http://doczine.com/iframe.php?doc=".$system_file_name; ?>" class="lightbox" title="maximized=true" data-options='{"width":1300, "height":800, "iframe": true}'> <?php echo $file_title; echo " | Posted By: "; echo $user_name; ?> </a>
			</h3>
			<br>
			<div class="one-fourth">
			<a href="<?php echo "viewer.php?doc=".htmlspecialchars($system_file_name)."";?>" ><img src="<?php display_images1($system_file_name);?>" alt=" " width="120" height="160"/></a>
			</div>
			<div class="one-fourth">
			<a href="<?php echo "viewer.php?doc=".htmlspecialchars($system_file_name)."";?>" ><img src="<?php display_images2($system_file_name);?>" alt=" " width="120" height="160"/></a>
			</div>
			<div class="one-third-big last">
			<?php
			echo "<br />";
			echo $user_file_name;  
			echo "<br />";
			echo $file_title;
			echo "<br />";
			echo $file_timestamp;
			echo "<br />";
			echo $user_name;
			echo "<br />";
			echo $file_counter;
			echo "<br />";
			//echo ThumbsUp::item($system_file_name)->template('thumbs_up_down');

?>
			<br />
			<br />
           
			<?php echo "<a href='viewer.php?doc=".htmlspecialchars($system_file_name)."' ";?> class="button small round blue">Read This Article</a>
			<?php echo "<a href='delete.php?doc=".htmlspecialchars($system_file_name)."' ";?> class="button small round blue">DELETE ME PLEASE</a>
			<br>
			<br>
</div>
</div>
<br>
</div>
<?php
 
			echo "<div class=\"horizontal-line\">";
			echo "</div>";
	}
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
?>
</div>
<div id="loadMoreComments" style="display:none;" > <center>test for hidden field</center></div>    

<?php
}


?>
