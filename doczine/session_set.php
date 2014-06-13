<?php
 require_once("sessions.php");
 include('user_functions.php');
 
 $sess = new SessionManager();
 if(!isset($_SESSION['valid_user'])){
 session_start();
 }
 
 do_html_login_form();

echo $_SESSION['valid_user'];
if (isset($_SESSION['valid_user'])) {
echo "something";
}



function login($username, $password) {
$password = hash('sha512', $password);

$conn = db_connect();
                        
$query = "SELECT password FROM `docunator`.`password` WHERE `password`.`user_name` = '".$username."' OR `password`.`email` = '".$username."' AND `password`.`password` = '".$password."';";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $password);
    while (mysqli_stmt_fetch($stmt)) {
       $result = $password;
    }
  if (!$result) 
  {
  	echo "Could not log in";
  }
	elseif($result!="") {
  	$_SESSION['valid_user'] = $username;
  	echo "<h2>";
  	echo "Hello ";
  	echo $_SESSION['valid_user'];
  	echo ", you are logged in.";
  	echo "<br>";
  	echo "<a href='upload_form.php'>Click Here to Upload Files.</a>";
  	echo "<br>";
	echo "Click the following link to view your file list: ";
	echo "<br>";
  	echo "<a href='file_list.php?user=".$_SESSION['valid_user']."'>File List</a>";
  	echo "<br>";
  	echo "<a href='edit_user_form.php?user=".$_SESSION['valid_user']."'>Edit User Info</a>";
  	echo "</h2>";
  	echo "<br>";
  	echo "<br>";
  	echo "<br>";
  	echo "<br>";
  	echo "<br>";
  	
    }
    mysqli_stmt_close($stmt);
	}
mysqli_close($conn);                   
}

function check_valid_user()
// see if somebody is logged in and notify them if not
{
  if (isset($_SESSION['valid_user']))
  {
      echo 'Logged in as '.$_SESSION['valid_user'].'.';
      echo '<br />';

  	echo "<h2>";
  	echo "Hello ";
  	echo $_SESSION['valid_user'];
  	echo ", you are logged in.";
  	echo "<br>";
  	echo "<a href='upload_form.php'>Click Here to Upload Files.</a>";
  	echo "<br>";
	echo "Click the following link to view your file list: ";
	echo "<br>";
  	echo "<a href='file_list.php?user=".$_SESSION['valid_user']."'>File List</a>";
  	echo "<br>";
  	echo "<a href='edit_user_form.php?user=".$_SESSION['valid_user']."'>Edit User Info</a>";
  	echo "</h2>";
  	echo "<br>";
  	echo "<br>";
  	echo "<br>";
  	echo "<br>";
  	echo "<br>";
  }
  else
  {
     // they are not logged in 
     do_html_heading('Problem:');
     echo 'You are not logged in.<br />';
     do_html_url('login.php', 'Login');
     do_html_footer();
     exit;
  }  
}






?>