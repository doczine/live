<?php
//this is where user_form posts the user information lll

include('html_output1.php'); 

//include("securimage/securimage.php");
include('user_functions.php');

ini_set('max_execution_time', 0);
ini_set('display_errors', '1');

$conn = db_connect();  
$user = strip_tags(stripslashes($_POST["username"]));
$email = strip_tags(stripslashes($_POST["email"]));
$password = strip_tags(stripslashes($_POST["pwd"]));
$password1 = strip_tags(stripslashes($_POST["pwd1"]));
$user_ip = strip_tags(stripslashes($_SERVER['REMOTE_ADDR']));  
$mysqltime = date("Y-m-d H:i:s");
//$code = strip_tags(stripslashes($_POST['code']));
$code = "code";
$first = "first";
$last = "last";
$phone = "8059682020";
$address = "123 main st";

//$img = new Securimage();
//$valid = $img->check($code);
$valid = TRUE;

 $header = "Doczine | Hello, ".$user." you have registered!";
 $description = "Doczine | Successful Registration";
 $meta = "Doczine, Registration";
 $description = "This page contains the Doczine registration landing page";
 $author = "Doczine.com";
 
  do_html_upper($header, $description, $meta, $description, $author);


    // check forms filled in
    if($_POST["username"] == NULL)
    {
      echo 'Username is a required field';   
    }
    
        // email address not valid
    elseif ($_POST["email"] == NULL)
    {
      echo 'That is not a valid email address.  Please go back and try again.';
    } 
    
    elseif ($_POST["pwd"] == NULL)
    {
      echo 'Password is required.  Please go back and try again.';
    } 
   
    elseif ($_POST["pwd1"] == NULL)
    {
      echo 'Password is required.  Please go back and try again.';
    } 
      
    // email address not valid
    elseif (valid_email($email))
    {
      echo 'That is not a valid email address.  Please go back and try again.';
    } 

    // passwords not the same 
    elseif ($password != $password1)
    {
      echo 'The passwords you entered do not match - please go back and try again.';
    }

    // check password length is ok
    // ok if username truncates, but passwords will get
    // munged if they are too long.
    elseif (strlen($password)<6 || strlen($password) >16)
    {
      echo 'Your password must be between 6 and 16 characters. Please go back and try again.';
    }
   
    elseif ($valid != TRUE)
    {
      echo 'The captcha was entered wrong.';
    }
else
{
    
	// attempt to register
	register($user, $email, $first, $last, $address, $phone, $password, $mysqltime, $user_ip);

}
?>
