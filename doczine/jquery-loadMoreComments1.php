<?php 

ini_set('max_execution_time', 0);
	
include('viewer_functions.php');

$conn = db_connect();

if($_GET['lastComment']){

$filtered = filter_input(INPUT_GET, "lastComment", FILTER_SANITIZE_URL);


$query = "
SELECT `system_file_name` , `file_title` , `short_name` , `file_timestamp`, `user_name`, `user_file_name`, `file_counter`, `file_hit_count`
FROM `docunator`.`file_counter`
INNER JOIN `docunator`.`file_title`
USING ( system_file_name ) 
INNER JOIN `docunator`.`user_file`
USING ( system_file_name )
INNER JOIN `docunator`.`file_hitcounter`
USING ( system_file_name )
WHERE `file_hit_count` <= (select max(file_hit_count) from `docunator`.`file_hitcounter` where `file_hit_count` <= $filtered)
ORDER BY `file_hitcounter`.`file_hit_count` DESC 
LIMIT 0, 100
;";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $system_file_name, $file_title, $short_name, $file_timestamp, $user_name, $user_file_name, $file_counter, $file_hit_count);
    while (mysqli_stmt_fetch($stmt)) {
    		echo "<div class=\"one\" >";
    		
			echo "<div class='postedComment' id='".$file_hit_count."'>";
			?>
			<h3> 	
			<a href="<?php echo "http://doczine.com/iframe.php?doc=".$system_file_name; ?>" class="lightbox" title="maximized=true" data-options='{"width":1300, "height":800, "iframe": true}'> <?php echo $file_title; echo " | Posted By: "; echo $user_name; ?> </a>
			</h3>
			<br>
			<div class="one-fourth">
			<a href="<?php echo "viewer.php?doc=".htmlspecialchars($system_file_name);?>" ><img src="<?php display_images1($system_file_name);?>" alt=" " width="108" height="140"/></a>
			</div>
			<div class="one-fourth">
			<a href="<?php echo "viewer.php?doc=".htmlspecialchars($system_file_name);?>" ><img src="<?php display_images2($system_file_name);?>" alt=" " width="108" height="140"/></a>
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
}