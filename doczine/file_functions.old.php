<?php
 
include('viewer_functions.php');

//this checks to see if the user has rights over the files using valid_user
//if the user has rights it will display a delete button

function display_upload_newest()
{

$conn = db_connect();

  
if(!isset($_GET['page'])) {
$user = ($_GET['user']);
$page = 0;
$page_limit = 8;
$query = "
SELECT `system_file_name` , `file_title` , `short_name` , `file_timestamp`, `user_name`, `user_file_name`, `user_ip`, `file_description`
FROM `docunator`.`file`
INNER JOIN `docunator`.`file_title`
USING ( system_file_name ) 
INNER JOIN `docunator`.`user_file`
USING ( system_file_name )
INNER JOIN `docunator`.`file_permission`
USING ( system_file_name )
WHERE `user_file`.`user_name` = '".$user."'
ORDER BY `file`.`file_timestamp` DESC
LIMIT ".$page." , 8
;";
$page = 8;
}

if(isset($_GET['page'])) {
$page = strip_tags(stripslashes(($_GET['page'])));
$user = ($_GET['user']);
$query = "
SELECT `system_file_name` , `file_title` , `short_name` , `file_timestamp`, `user_name`, `user_file_name`, `user_ip`, `file_description`
FROM `docunator`.`file`
INNER JOIN `docunator`.`file_title`
USING ( system_file_name )
INNER JOIN `docunator`.`user_file`
USING ( system_file_name )
INNER JOIN `docunator`.`file_permission`
USING ( system_file_name )
WHERE `user_file`.`user_name` = '".$user."'
ORDER BY `file`.`file_timestamp` DESC
LIMIT ".$page." , 8
;";
}

if((!isset($_GET['user'])) or ($_GET['user'] = NULL)) {
echo "You did not select a user.";
}

$user = ($_GET['user']);
echo $user;

if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $system_file_name, $file_title, $short_name, $file_timestamp, $user_name, $user_file_name, $user_ip, $file_description);
		while (mysqli_stmt_fetch($stmt)) {
		?>

		
	<div class="one">
		<div class="horizontal-line">
		</div>
		<div class="one-fourth">
<a href="<?php display_images1($system_file_name);?>" class="portfolio-img pretty-box"><img src="<?php display_images1($system_file_name);?>" alt=" " width="216" height="280"/></a>
		</div>
		<div class="one-fourth">
<a href="<?php display_images2($system_file_name);?>" class="portfolio-img pretty-box"><img src="<?php display_images2($system_file_name);?>" alt=" " width="216" height="280"/></a>
		</div>
		<div class="one-half last">

		<br>
		</div>
		
		<div class="one-third-big last">
		<h1 a><a href='	<?php echo "http://192.168.1.100/viewer.php?doc=".htmlspecialchars($system_file_name)."";?> '>
		<?php echo str_replace("_"," ",$file_title); ?></a></h1 a>
		<p>
		
		<?php
		echo "File Title:&nbsp;";
		echo $file_title;
		echo "<br>";
		echo "File Name:&nbsp;";
		echo $user_file_name;
		echo "<br>";
		echo "Posted By:&nbsp;";
		echo $user_name;
		echo "<br>";

		?>
		</p>
			 
		<p><?php 
		$time = $file_timestamp;
		$time = strtotime($time);						
		$mysqldate = date( 'Y-m-d', $time ); 
		echo "Uploaded On:&nbsp;";
		echo $mysqldate; 
		?>

		<!--POST DETAILS-->
		<!--POST INTRO-->
		<p>

		</p>
		<?php echo "<a href='http://192.168.1.100/viewer.php?doc=".htmlspecialchars($system_file_name)."' ";?> class="button small round blue">Read This Article</a>
		
		</div>
		<!--POST LINK-->
				</div>	
		<div class="horizontal-line">
		</div>		

	 
       		<?php
		}
		?>
		<br>
		
		<?php
		if(isset($results_page)){
		//echo "<a href='http://localhost/file_list.php?page=".$page.$results_page."'> More Results </a>";
		}
		else
		{
		//echo "<a href='http://localhost/file_list.php?page=".$page."'> More Results </a>";
		}
		mysqli_stmt_close($stmt);
	}
	mysqli_close($conn);
}


function display_pagination()
{

?>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	<ul class="blog-pagination">
		<li><a href="#"><b>page 1 of 15</b></a></li>
		<li class="current">
		<a href="#">1</a></li>
		<li><a href="file_list.php?page=8">2</a></li>
		<li><a href="file_list.php?page=16">3</a></li>
		<li><a href="file_list.php?page=24">4</a></li>
		<li><a href="file_list.php?page=32">5</a></li>
		<li><a href="file_list.php?page=40">6</a></li>
		<li><a href="file_list.php?page=48">7</a></li>
		<li><a href="file_list.php?page=56">8</a></li>
		<li><a href="file_list.php?page=64">9</a></li>
		<li><a href="file_list.php?page=72">10</a></li>
		<li><a href="file_list.php?page=80">11</a></li>
		<li><a href="file_list.php?page=88">12</a></li>
		<li><a href="file_list.php?page=96">13</a></li>
		<li><a href="file_list.php?page=104">14</a></li>
		<li><a href="file_list.php?page=112">15</a></li>
		<li><a href="file_list.php?page=120">Next</a>
		</li>
	</ul>
<?php
}

?>
