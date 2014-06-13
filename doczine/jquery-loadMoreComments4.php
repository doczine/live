<?php 
ini_set('max_execution_time', 0);	
include('viewer_functions.php');
$conn = db_connect();
if($_GET['lastComment']){
$filtered = filter_input(INPUT_GET, "lastComment", FILTER_SANITIZE_URL);

 require_once("sessions.php");
 $sess = new SessionManager();
 session_start();

if(isset($_GET['user'])){
	$user = strip_tags(stripslashes($_GET['user']));
} 
if(isset($_SESSION['valid_user'])){
	$user = $_SESSION['valid_user'];
}

$query = "
SELECT `system_file_name` , `file_title` , `short_name` , `file_timestamp` , `user_file`.`user_name`, `user_file_name` , `file_counter`, `folder`, `file_snippet`
FROM `docunator`.`file_counter`
INNER JOIN `docunator`.`file_title`
USING ( system_file_name )
INNER JOIN `docunator`.`user_file`
USING ( system_file_name )
INNER JOIN `docunator`.`file_snippet`
USING ( system_file_name )
INNER JOIN `docunator`.`user_file_bookmark`
USING ( system_file_name )
WHERE `file_counter` <= ".$filtered." AND `user_file_bookmark`.`user_name` = '".$user."'
ORDER BY `file_counter`.`file_timestamp` DESC
LIMIT 0 , 64;";

/*
SELECT `system_file_name` , `file_title` , `short_name` , `file_timestamp`,  `user_file`.`user_name`, `user_file_name`, `file_counter`, `folder`, `file_snippet`
FROM `docunator`.`file_counter`
INNER JOIN `docunator`.`file_title`
USING ( system_file_name ) 
INNER JOIN `docunator`.`user_file`
USING ( system_file_name )
INNER JOIN `docunator`.`file_snippet`
USING ( system_file_name )
INNER JOIN `docunator`.`user_file_bookmark`
USING ( system_file_name )
WHERE `user_file_bookmark`.`user_name` = '".$user."'
ORDER BY `file_counter`.`file_timestamp` DESC
LIMIT 0, 64;
*/

/*
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
LIMIT 0, 60
;";
*/

$rand = rand(0, 1000000);

	echo "<div id='main1'>";
	echo "<ul id='tiles".$rand."' class='tiles'>";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $system_file_name, $file_title, $short_name, $file_timestamp, $user_name, $user_file_name, $file_counter, $folder, $file_snippet);
    while (mysqli_stmt_fetch($stmt)) {
		echo "<div class='postedComment' id='".$file_counter."'>";
		?>

      <ul id="tiles">
        <li> 
			<div class="front">
				<p>
				</br>
				<strong>
				<a href='<?php echo "http://doczine.com/".$file_counter.".html"; ?>'>
				<?php echo $file_title; ?> 
				</a>
				</strong>
				<br /> 
				<?php echo $file_timestamp; ?>
				</p>
				<img src="<?php echo "http://image".$folder.".doczine.com/".$system_file_name."/".$short_name."png"; ?>" width="216"/>											
			</div>
			<div class="back">
				<h4 style="height:100px; color:F5FFFA;">
				<a href='<?php echo "http://doczine.com/".$file_counter.".html"; ?>'>
				<?php echo $file_title; ?> 
				</a>
				</h4>				
				<p>
				<?php echo $file_timestamp; ?>
				</br>
				<?php echo $user_file_name; ?>
				</br>
				<?php //echo $user_name; ?>
				</br>
				<p style="text-align:left;">
				<?php echo $file_snippet; ?>
				</p>
				<!--
 				<a href='<?php echo "http://doczine.com/".$file_counter.".html"; ?>' class='button small round blue'>Read This Full Article</a>
				-->
				</p>	
			</div>
		</li>
      </ul>
<?php

	}
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
?>

</ul>
</div>
	</div>
  <script src="js/jquery.wookmark.min.js" type="text/javascript"></script>
  <script src="js/jquery.pinterestgallery.min.js" type="text/javascript"></script>
  <script src="js/modernizr.custom.js" type="text/javascript"></script>	  
  <script type="text/javascript">
    $(document).ready(new function() {
		$('#tiles<?php echo $rand; ?>').pinterestGallery({
			largeContainerID: 'largeImage',
			animateStyle: 'none',			
			gridOptions: {
		        autoResize: true, 
		        container: $('#main1'), 
		        offset: 2, 
		        itemWidth: 220				
			}
		});
    });
  </script>
<?php
}
?>
