<?php
//this is where password_reset_form posts the user information

include 'user_functions.php';
include('html_output1.php');

ini_set('max_execution_time', 0);

$conn = db_connect();

$username = strip_tags(stripslashes($_POST["username"]));
$email = strip_tags(stripslashes($_POST["email"]));
$user_ip = $_SERVER['REMOTE_ADDR'];  
$mysqltime = date("Y-m-d H:i:s");

    // check forms filled in
    if (!filled_out($_POST))
    {
 $header = "Doczine | Password Reset Page";
 $description = "Doczine | Password Reset";
 $meta = "Doczine, Login";
 $description = "This page contains the Doczine password reset form";
 $author = "Doczine.com";
  
  	do_html_upper($header, $description, $meta, $description, $author);
      echo 'You have not filled the form out correctly - please go back and try again.';    
    }
    else
    {
 $header = "Doczine | Password Reset Page";
 $description = "Doczine | Password Reset";
 $meta = "Doczine, Login";
 $description = "This page contains the Doczine password reset form";
 $author = "Doczine.com";
 
  	do_html_upper($header, $description, $meta, $description, $author);
	notify_password($username, $email);

  }

?>
