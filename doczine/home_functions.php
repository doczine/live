<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-40167070-1']);
  _gaq.push(['_setDomainName', 'doczine.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<?php
include('viewer_functions.php');

function do_html_infinite_scroll() {
?>
<div id="postedComments">
<?php
ini_set('max_execution_time', 0);
$conn = db_connect();

$query = "
SELECT `system_file_name` , `file_title` , `short_name` , `file_timestamp`, `user_name`, `user_file_name`, `file_counter`, `folder`
FROM `docunator`.`file_counter`
INNER JOIN `docunator`.`file_title`
USING ( system_file_name ) 
INNER JOIN `docunator`.`user_file`
USING ( system_file_name )
ORDER BY `file_counter`.`file_timestamp` DESC 
LIMIT 0, 36
;";

	echo "<div id='main'>";
	echo "<ul id='tiles' class='tiles'>";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $system_file_name, $file_title, $short_name, $file_timestamp, $user_name, $user_file_name, $file_counter, $folder);
    while (mysqli_stmt_fetch($stmt)) { 
	echo "<div class='postedComment' id='".$file_counter."'>";	
?>
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
				<img src="<?php echo "http://image".$folder.".doczine.com/".$system_file_name."/".$short_name."png"; ?>"/>											
			</div>
			<div class="back">
				<h4>
				<a href='<?php echo "http://doczine.com/".$file_counter.".html"; ?>'>
				<?php echo $file_title; ?> 
				</a>
				</h4>				
				<p>
				<?php echo $file_timestamp; ?>
				</br>
				<?php echo $user_file_name; ?>
				</br>
				<?php echo $user_name; ?>
				</br>
				</br>
 				<a href='<?php echo "http://doczine.com/".$file_counter.".html"; ?>' class='button small round blue'>Read This Full Article</a>
				</p>	
			</div>
		</li>
	</div>
<?php
	}
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
?>
</ul>
  <script src="js/jquery.wookmark.min.js" type="text/javascript"></script>
  <script src="js/jquery.pinterestgallery.min.js" type="text/javascript"></script>
  <script src="js/modernizr.custom.js" type="text/javascript"></script>	  
  <script type="text/javascript">
    $(document).ready(new function() {
		$('#tiles').pinterestGallery({
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
<div id="loadMoreComments" style="display:none;"><center>test for hidden field</center></div>    
<?php
}
?>
