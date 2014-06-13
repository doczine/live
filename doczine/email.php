<?php
//this is where login_form posts the user login information
 
include 'user_functions.php';
include('user_output.php');

ini_set('max_execution_time', 0);

$conn = db_connect();
$username = strip_tags(stripslashes($_POST["username"]));
$password = strip_tags(stripslashes($_POST["password"]));
$user_ip = $_SERVER['REMOTE_ADDR'];  
$mysqltime = date("Y-m-d H:i:s");

  try
  {
    // check forms filled in
    if (!filled_out($_POST))
    {
      throw new Exception('You have not filled the form out correctly - please go back and try again.');    
    }

    // check password length is ok
    if (strlen($password)<6 || strlen($password) >16)
    {
      throw new Exception('Your password must be between 6 and 16 characters. Please go back and try again.');
    }
       
    do_html_header();

	login($username, $password);
		
	do_html_footer();
	
  }
  catch (Exception $e)
  {
     do_html_header('Problem:');
     echo $e->getMessage(); 
     do_html_footer();
     exit;
  } 
?>