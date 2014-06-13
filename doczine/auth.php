<?php

/*
include("user_functions.php");
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

if(!isset($_GET['user'])){
	$text = "Try entering the form again, something failed to work.";
	error_msg($text);
}
if(!isset($_GET['pwd'])){
	$text = "Try entering the form again, something failed to work.";
	error_msg($text);
}


if(isset($_GET['user'])){
	$user = strip_tags(stripslashes($_GET['user']));
}

if(isset($_GET['pwd'])){
	$pwd = strip_tags(stripslashes($_GET['pwd']));
}

login($user, $pwd);
*/

?>