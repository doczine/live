<?php
 include('edit_user_functions.php');
 include('footer.php');
 include('html_output1.php');
  
$user = $_GET["user"];
 
$conn = db_connect();

do_html_upper();

//check if user is signed it
if(($_SESSION['valid_user'] != $user))
	{
		echo "You must be signed in. <a href='login_form.php'> Doczine Log In."; 
	}
	//check if user that is signed in is actual account owner
	elseif(($_SESSION['valid_user'] == $user))	
	{
	  do_html_edit_form();

	}
	else
	{
		echo "Invalid user! Session terminated!";
	}
mysqli_close($conn);

?>
