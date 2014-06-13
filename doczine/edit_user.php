<?php
//allows user to edit user infomraiton, captcha must be entered
//this is where edit_user_output posts into
include ('edit_user_functions.php');
include('edit_user_output.php');
//include("securimage/securimage.php");
include('html_output1.php');
 
ini_set('max_execution_time', 0);

 require_once("sessions.php");
 $sess = new SessionManager();
 if(!isset($_SESSION['valid_user'])){
 session_start();
 }

$conn = db_connect();

$user = $_SESSION['valid_user'];
$first = strip_tags(stripslashes($_POST["first"]));
$last = strip_tags(stripslashes($_POST["last"]));
$address = strip_tags(stripslashes($_POST["address"]));
$phone = strip_tags(stripslashes($_POST["phone"]));
$email = strip_tags(stripslashes($_POST["email"]));
$oldpassword = $_POST["oldpwd"];
$passwordnew = $_POST["pwd"];
$passwordnew1 = $_POST["pwd1"];
$user_ip = strip_tags(stripslashes($_SERVER['REMOTE_ADDR']));  
$mysqltime = date("Y-m-d H:i:s");
$code = strip_tags(stripslashes($_POST['code']));

//$img = new Securimage();
//$valid = $img->check($code);
$valid = TRUE;

 $header = "User Page";
 $description1 = "Log In Results Page";
 $meta = "Doczine, Login";
 $description2 = "This page contains the Doczine login";
 $author = "Doczine.com";
 
	do_html_upper($header, $description1, $meta, $description2, $author);

    if ($valid == TRUE)
    {
    if((isset($_POST["pwd"])) && (isset($_POST["pwd1"])) && (isset($_POST["oldpwd"])) && ($password == $password1)) {
	change_password($user, $oldpassword, $passwordnew, $passwordnew1);
	}
	update_user($user, $email, $first, $last, $address, $phone, $password, $mysqltime, $user_ip);
    }
    else
    {
    echo "Invalid captcha.";
    }

?>
