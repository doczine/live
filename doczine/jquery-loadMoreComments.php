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
LIMIT 0, 24
;";

$rand = rand(0, 1000000);

	echo "<div id='main'>";
	echo "<ul id='tiles".$rand."' class='tiles'>";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $system_file_name, $file_title, $short_name, $file_timestamp, $user_name, $user_file_name, $file_counter, $file_hit_count);
    while (mysqli_stmt_fetch($stmt)) {
		echo "<div class='postedComment' id='".$filtered."'>";
		?>

      <ul id="tiles">
      
        <li data-large="images/lychee/img2.jpg">
			<div class="front">
				<img src="images/lychee/img2.jpg"  width="200" height="134" /><p><strong><?php echo $file_title; ?></strong><br /> <?php echo $file_timestamp; ?></p>								
			</div>
			<div class="back">
				<h4><?php echo $file_title; ?></h4>				
				<p>
				<?php echo $file_timestamp; ?>
				</br>
				<?php echo $user_file_name; ?>
				</br>
				<?php echo $user_name; ?>
				</br>
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
			animateStyle: 'twirl',			
			gridOptions: {
		        autoResize: true, 
		        container: $('#main'), 
		        offset: 8, 
		        itemWidth: 210				
			}
		});
    });
  </script>
<?php
}