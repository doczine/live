<?php
//this is where the files are supposed to be marked as private
//this is currently not working
include 'file_functions.php';
include 'html_output.php';

 echo $_SESSION['valid_user'];

$doc = strip_tags(stripslashes($_GET["doc"]));

if(isset($_SESSION['valid_user'])){
	
$query = "SELECT system_file_name FROM `docunator`.`user_file` WHERE `user_file`.`user_name` = '".$_SESSION['valid_user']."' AND `system_file_name` = '".$doc."';";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $system_file_name);
    while (mysqli_stmt_fetch($stmt)) {
    
        if($system_file_name != NULL) {
        	$query = "UPDATE `docunator`.`file_permission` SET `rights_id` = '1' WHERE `file_permission`.`system_file_name` = '".$doc."';";
        	
        	$stmt = mysqli_prepare($conn, $query);
        	mysqli_stmt_execute($stmt);
        	mysqli_stmt_bind_result($stmt, $system_file_name);
        	while (mysqli_stmt_fetch($stmt)) {
			  echo "Updated ";
			  printf ("%s", $system_file_name);
			}
        	}
        }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
	
	}
	else
	{
		echo "You are not logged in";
		echo "<a href='login_form.php'>login here.";
	}


?>
