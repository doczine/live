<?php

include('viewer_functions.php');

function do_html_infinite_scroll() {
?>
<div id="postedComments">
<?php
ini_set('max_execution_time', 0);
$conn = db_connect();

$query = "
SELECT `system_file_name` , `file_title` , `short_name` , `file_timestamp`, `user_name`, `user_file_name`, `file_counter`, `file_hit_count`
FROM `docunator`.`file_counter`
INNER JOIN `docunator`.`file_title`
USING ( system_file_name ) 
INNER JOIN `docunator`.`user_file`
USING ( system_file_name )
INNER JOIN `docunator`.`file_hitcounter`
USING ( system_file_name )
ORDER BY `file_hitcounter`.`file_hit_count` DESC 
LIMIT 0, 10
;";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $system_file_name, $file_title, $short_name, $file_timestamp, $user_name, $user_file_name, $file_counter, $file_hit_count);
    while (mysqli_stmt_fetch($stmt)) { 

    //onclick="location.href='http://192.168.1.100/iframe.php?doc=1362686101_464de14e5f" class="lightbox" title="maximized=true" data-options="{&quot;width&quot;:1300, &quot;height&quot;:800, &quot;iframe&quot;: true}';"
	//   <div onclick="window.open('http://192.168.1.100/iframe.php?doc=1362686101_464de14e5f');" class='lightbox' title='maximized=true' data-options='{'width':1300, 'height':800, 'iframe': true}'">test</div> 
// <a href="#" onClick="window.open('<iframe width="560" height="315" src="http://www.youtube.com/embed/wrqlWXbOA4o?rel=0" frameborder="0" allowfullscreen></iframe>','bla','width=560, height=315, toolbar=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes')">klick here</a>  

    		echo "<div class='one'>";    	
			echo "<div class='postedComment' id='".$file_hit_count."'>";
			?>
			<h3> 	
			<a href="<?php echo "http://192.168.1.100/iframe.php?doc=".$system_file_name; ?>" class="lightbox" title="maximized=true" data-options='{"width":1300, "height":800, "iframe": true}'> <?php echo $file_title; echo " | Posted By: "; echo $user_name; ?> </a>
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
