<?php
include("db.php");
include("user_functions.php");

$conn = db_connect();

require_once("sessions.php");
$sess = new SessionManager();

if (strlen(session_id()) < 1) {
    session_start();
}

function error_msg($text) {
     # add other stuff you may want here
     $hello_var = 'Problem: '; //example of addon to beginning
     $goodbye_var = ' goodbye'; //example of addon to end
     die($hello_var.' '.$text.'<br />'.$goodbye_var);
}

//print_r($_SERVER);
//var_dump($_SERVER);

$user_ip = $_SERVER['REMOTE_ADDR'];
$mysqltime = date("Y-m-d H:i:s");

if(isset($_SESSION['valid_user'])){
	$user = $_SESSION['valid_user'];
	echo "You are logged in as: ";
	echo $_SESSION['valid_user'];
	echo "<br>";
}
if(!isset($_SESSION['valid_user'])){
	echo "You must be logged in to properly bookmark files.";
	echo "The system will temporarily identify and register you by your IP Address: ".$user_ip;
	echo "We do suggest that you sign up to use the site, your IP might change.";
	echo "Here is the sign up page: ";
	echo "<br>";	
	echo "<a href='http://doczine.com/user_form.php'>http://doczine.com/user_form.php</a>";
	$user = $user_ip;
	$email = $user_ip;
	$first = "Bookmark";
	$last = "Bookmark";
	$address = "123 Bookmark Road";
	$phone = "8092522242";
	$password = random_password();
	$_SESSION['valid_user'] = $user_ip;
	register($user, $email, $first, $last, $address, $phone, $password, $mysqltime, $user_ip);
}

if(isset($_GET['doc'])){
	$doc = strip_tags(stripslashes($_GET['doc']));
}
else
{
	echo 'You did not enter a file id to bookmark.';
	echo "<br>";
	error_msg('System cannot bookmark a NULL file id.');		
}



//INSERT INTO `docunator`.`user_file_bookmark` (`user_name`, `system_file_name`, `user_ip`, `search_date`) VALUES ('asdf', '1370469473_006bcd23a1', '127.0.0.1', '2013-06-05 10:09:29');

		if ($stmt = mysqli_prepare($conn, "INSERT INTO `docunator`.`user_file_bookmark` (`user_name`, `system_file_name`, `user_ip`, `search_date`) VALUES (?,?,?,?)")); {
			mysqli_stmt_bind_param($stmt, "ssss", $user, $doc, $user_ip, $mysqltime);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
echo "<br>";
echo "<a href='http://doczine.com/bookmark_list.php?user=".$user."'>File should be added to your bookmark list here</a>";


?>