<?php
//this checks the users rights on the file, and will not display private files
include('file_output.php');
 
ini_set('max_execution_time', 0);

 require_once("sessions.php");
 $sess = new SessionManager();
 session_start();

 
  do_html_home();
  do_html_lower_home();


/*
$conn = db_connect();
 
do_html_file_list_upper(); 


if(isset($_GET['delete']) && isset($_SESSION['valid_user'])){
$doc = strip_tags(stripslashes($_GET['delete']));

$query = "SELECT user_name FROM `docunator`.`user_file` WHERE `user_file`.`user_name` = '".$_SESSION['valid_user']."' AND `system_file_name` = '".$doc."';";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $user_name);
    while (mysqli_stmt_fetch($stmt)) {

        if($user_name == $_SESSION['valid_user']) {
        mysqli_stmt_close($stmt);
        
        	$query = "UPDATE `docunator`.`file_permission` SET `rights_id` = '1' WHERE `file_permission`.`system_file_name` = '".$doc."';";
        						
			$stmt = mysqli_prepare($conn, $query);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);        	
			  echo "Updated ".$doc.", your file will be deleted soon.";
			  }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

do_html_file_list_lower();
do_html_footer();


	if ($first != "") { 
	$query = "UPDATE `docunator`.`user` SET `first_name` = '".$first."' WHERE `user`.`user_name` = '".$user."';";
	$stmt = mysqli_prepare($conn, $query);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	echo "First name changed to: ".$first;
	echo "<br/>";
	}
*/
?>
