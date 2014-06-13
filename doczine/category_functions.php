<?php
 
//this creates the category menu based on the previous click
//this also returns the files that were in the previous click

include('db.php');

function display_upload_dropdown()
{

//select top taxo_1 values
if((!isset($_GET['sub1'])) && (!isset($_GET['sub2']))) {

$conn = db_connect();
$query = "SELECT taxo_1 FROM `docunator`.`taxo_1`;";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $category_name);
    while (mysqli_stmt_fetch($stmt)) {
        echo "<a href='category_list.php?sub1=";
        echo $category_name;
        echo "'>".$category_name."</a><br/>";
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

//select taxo_2 values based on taxo_1 get click
if((isset($_GET['sub1'])) && (!isset($_GET['sub2']))) {

$sub1 = strip_tags(stripslashes($_GET['sub1']));

$conn = db_connect();
$query = "SELECT taxo_2 FROM `docunator`.`taxo_2` WHERE `taxo_2`.`taxo_1` = '".$sub1."';";

if ($stmt = mysqli_prepare($conn, $query)) {
	mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $category_name);
    while (mysqli_stmt_fetch($stmt)) {
        echo "<a href='category_list.php?sub1=".$sub1."&sub2=";
        echo $category_name;
        echo "'>".$category_name."</a><br/>";
    }
    mysqli_stmt_close($stmt);
}
	mysqli_close($conn);
}

//select taxo_3 values based on taxo_2 get click
if((isset($_GET['sub1'])) && (isset($_GET['sub2']))) {

echo "No more sub-categories";

}

}

function display_upload_dropdown_file()
{

//select taxo_2 values based on taxo_1 get click
if((isset($_GET['sub1'])) && (!isset($_GET['sub2']))) {

$sub1 = strip_tags(stripslashes($_GET['sub1']));

$conn = db_connect();

//shows files in subcat 1
$query = "
SELECT `system_file_name`, `file_title`, `short_name`
FROM `docunator`.`file_taxonomy`
INNER JOIN `docunator`.`file_title` 
USING (system_file_name)
INNER JOIN `docunator`.`user_file`
USING ( system_file_name )
WHERE `file_taxonomy`.`taxo_1` = '".$sub1."'
LIMIT 0 , 20
;";


if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $system_file_name, $file_title, $short_name);
		while (mysqli_stmt_fetch($stmt)) {
		?>
			<div class="rt-grid-13">
			<div class="box1 button2 nomarginbottom">
			<div class="rt-block">
			<div class="rt-module-surround">
			<div class="module-title-surround">
			</div>
			<div class="rt-module-inner">
			<div class="module-content">
			<ul class="bullet-check">
 					
			<div class="mosaic-block bar2">
				<?php
					echo "<a href='viewer.php?doc=".htmlspecialchars($system_file_name)."' class='mosaic-overlay'>";
				?>
					<div class="details">
						<h4><?php echo $file_title; ?></h4>
						<p><?php echo $system_file_name; ?></p>
						<p><?php echo $short_name; ?></p>
					</div>
				</a>
				<div class="mosaic-backdrop">
				<img src='<?php echo "bigdata/".$system_file_name."/".$short_name."jpg"; ?>'/>
				<img src='<?php echo "bigdata/".$system_file_name."/".$short_name."-1.jpg"; ?>'/>
			</div>
			</div>
			<div class="clear">
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>		
       <?php
	
		}
		mysqli_stmt_close($stmt);
	}
	mysqli_close($conn);
}

//select taxo_3 values based on taxo_2 get click
if((isset($_GET['sub1'])) && (isset($_GET['sub2']))) {

$sub1 = strip_tags(stripslashes($_GET['sub1']));
$sub2 = strip_tags(stripslashes($_GET['sub2']));

$conn = db_connect();

//shows files in subcat 2
$query = "
SELECT `system_file_name`, `file_title`, `short_name`
FROM `docunator`.`file_taxonomy`
INNER JOIN `docunator`.`file_title` 
USING (system_file_name)
INNER JOIN `docunator`.`user_file`
USING ( system_file_name )
WHERE `file_taxonomy`.`taxo_1` = '".$sub1."'
AND `file_taxonomy`.`taxo_2` = '".$sub2."'
LIMIT 0 , 20
";

if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $system_file_name, $file_title, $short_name);
		while (mysqli_stmt_fetch($stmt)) {
		?>
			<div class="rt-grid-13">
			<div class="box1 button2 nomarginbottom">
			<div class="rt-block">
			<div class="rt-module-surround">
			<div class="module-title-surround">
			</div>
			<div class="rt-module-category">
			<div class="module-content">
			<ul class="bullet-check">
			<div class="mosaic-block bar2">
				<?php
					echo "<a href='viewer.php?doc=".htmlspecialchars($system_file_name)."' class='mosaic-overlay'>";
				?>
					<div class="details">
						<h4><?php echo $file_title; ?></h4>
						<p><?php echo $system_file_name; ?></p>
						<p><?php echo $short_name; ?></p>
					</div>
				</a>
				<div class="mosaic-backdrop">
				<img src='<?php echo "bigdata/".$system_file_name."/".$short_name."jpg"; ?>'/>
				<img src='<?php echo "bigdata/".$system_file_name."/".$short_name."-1.jpg"; ?>'/>
			</div>
			</div>
			<div class="clear">
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>		
       <?php
		}
		mysqli_stmt_close($stmt);
	}
	mysqli_close($conn);
}

}

?>
