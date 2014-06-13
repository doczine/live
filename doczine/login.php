<?php
//this is where login_form posts the user login information

include('html_output1.php');
include('user_functions.php');

ini_set('max_execution_time', 0);

$conn = db_connect();
$username = $_POST["username"];
$password = $_POST["password"];
$user_ip = $_SERVER['REMOTE_ADDR'];  
$mysqltime = date("Y-m-d H:i:s");

 $header = "User Page";
 $description1 = "Log In Results Page";
 $meta = "Doczine, Login";
 $description2 = "This page contains the Doczine login";
 $author = "Doczine.com";
 

	do_html_upper($header, $description1, $meta, $description2, $author);
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
        
    login($username, $password);

	
  }
  catch (Exception $e)
  {
     do_html_header('Problem:');
     echo $e->getMessage(); 
     exit;
  } 
?>
