<?php
include('db.php');
 
function filled_out($form_vars)
{
  // test that each variable has a value
  foreach ($form_vars as $key => $value)
  {
     if (!isset($key) || ($value == '')) 
        return false;
  } 
  return true;
}

//this validates the email address
function valid_email($email)
{
  if (var_dump(filter_var($email, FILTER_VALIDATE_EMAIL)))
  {
    return true;
  }
  else
  {
    return false;
  }
}

//this registers a user, first checks if the user exists
function register($user, $email, $first, $last, $address, $phone, $password, $mysqltime, $user_ip)
{
$password = hash('sha512', $password);
$result = "";

$conn = db_connect();
$conn1 = db_connect_110();
$conn2 = db_connect_120();
$conn3 = db_connect_130();

$query = "SELECT user_name FROM `docunator`.`user` WHERE `user`.`user_name` = '".$user."' OR `user`.`email` = '".$email."';";
if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $user);
    while (mysqli_stmt_fetch($stmt)) {
        $result = $user;
    	}
    		  if ($result == "") { 
				$stmt1 = mysqli_prepare($conn, "INSERT INTO `docunator`.`user` (`user_name`,`email`,`first_name`,`last_name`,`address`,`phone`) VALUES (?,?,?,?,?,?)"); 
					mysqli_stmt_bind_param($stmt1, "ssssss", $user, $email, $first, $last, $address, $phone);
					mysqli_stmt_execute($stmt1);
					mysqli_stmt_close($stmt1);
					
				$stmt2 = mysqli_prepare($conn, "INSERT INTO `docunator`.`user_sign_up` (`user_name`,`sign_up_date`,`sign_up_ip`) VALUES (?,?,?)"); 
					mysqli_stmt_bind_param($stmt2, "sss", $user, $mysqltime, $user_ip);
					mysqli_stmt_execute($stmt2);
					mysqli_stmt_close($stmt2);
				
				$stmt3 = mysqli_prepare($conn, "INSERT INTO `docunator`.`password` (`user_name`,`password`,`email`) VALUES (?,?,?)"); 
					mysqli_stmt_bind_param($stmt3, "sss", $user, $password, $email);
					mysqli_stmt_execute($stmt3);
					mysqli_stmt_close($stmt3);


				$stmt1 = mysqli_prepare($conn1, "INSERT INTO `docunator`.`user` (`user_name`,`email`,`first_name`,`last_name`,`address`,`phone`) VALUES (?,?,?,?,?,?)"); 
					mysqli_stmt_bind_param($stmt1, "ssssss", $user, $email, $first, $last, $address, $phone);
					mysqli_stmt_execute($stmt1);
					mysqli_stmt_close($stmt1);
					
				$stmt2 = mysqli_prepare($conn1, "INSERT INTO `docunator`.`user_sign_up` (`user_name`,`sign_up_date`,`sign_up_ip`) VALUES (?,?,?)"); 
					mysqli_stmt_bind_param($stmt2, "sss", $user, $mysqltime, $user_ip);
					mysqli_stmt_execute($stmt2);
					mysqli_stmt_close($stmt2);
				
				$stmt3 = mysqli_prepare($conn1, "INSERT INTO `docunator`.`password` (`user_name`,`password`,`email`) VALUES (?,?,?)"); 
					mysqli_stmt_bind_param($stmt3, "sss", $user, $password, $email);
					mysqli_stmt_execute($stmt3);
					mysqli_stmt_close($stmt3);
					
					
				$stmt1 = mysqli_prepare($conn2, "INSERT INTO `docunator`.`user` (`user_name`,`email`,`first_name`,`last_name`,`address`,`phone`) VALUES (?,?,?,?,?,?)"); 
					mysqli_stmt_bind_param($stmt1, "ssssss", $user, $email, $first, $last, $address, $phone);
					mysqli_stmt_execute($stmt1);
					mysqli_stmt_close($stmt1);
					
				$stmt2 = mysqli_prepare($conn2, "INSERT INTO `docunator`.`user_sign_up` (`user_name`,`sign_up_date`,`sign_up_ip`) VALUES (?,?,?)"); 
					mysqli_stmt_bind_param($stmt2, "sss", $user, $mysqltime, $user_ip);
					mysqli_stmt_execute($stmt2);
					mysqli_stmt_close($stmt2);
				
				$stmt3 = mysqli_prepare($conn2, "INSERT INTO `docunator`.`password` (`user_name`,`password`,`email`) VALUES (?,?,?)"); 
					mysqli_stmt_bind_param($stmt3, "sss", $user, $password, $email);
					mysqli_stmt_execute($stmt3);
					mysqli_stmt_close($stmt3);
					
					
				$stmt1 = mysqli_prepare($conn3, "INSERT INTO `docunator`.`user` (`user_name`,`email`,`first_name`,`last_name`,`address`,`phone`) VALUES (?,?,?,?,?,?)"); 
					mysqli_stmt_bind_param($stmt1, "ssssss", $user, $email, $first, $last, $address, $phone);
					mysqli_stmt_execute($stmt1);
					mysqli_stmt_close($stmt1);
					
				$stmt2 = mysqli_prepare($conn3, "INSERT INTO `docunator`.`user_sign_up` (`user_name`,`sign_up_date`,`sign_up_ip`) VALUES (?,?,?)"); 
					mysqli_stmt_bind_param($stmt2, "sss", $user, $mysqltime, $user_ip);
					mysqli_stmt_execute($stmt2);
					mysqli_stmt_close($stmt2);
				
				$stmt3 = mysqli_prepare($conn3, "INSERT INTO `docunator`.`password` (`user_name`,`password`,`email`) VALUES (?,?,?)"); 
					mysqli_stmt_bind_param($stmt3, "sss", $user, $password, $email);
					mysqli_stmt_execute($stmt3);
					mysqli_stmt_close($stmt3);									
				//set user session variable
				
				$_SESSION['valid_user'] = $user;
				
				echo $_SESSION['valid_user'];
				echo "<br>";
				echo "You have successfully created an account, to upload documents go here:";
				echo "<a href='upload_form.php'> UPLOAD</a>";

		
				$from = "From: support@www.docunator.com \r\n";
				$mesg = "Hello, $user thank you for signing up for www.docunator.com, the endpoint of documents. \r\n You can start uploading your documents here: http://docunator.com/upload_form.php \r\n";
				
				mail($email, 'Welcome to www.docunator.com BETA', $mesg, $from);

			}
				else
			{
				echo 'That username or email is already taken, sorry.';
				echo "<br>";
				echo "<a href='password_reset_form.php'>Click here to reset your password.</a>";
			}

    mysqli_stmt_close($stmt);
	}


$query = "SELECT user_name FROM `docunator`.`user` WHERE `user`.`user_name` = '".$user."' OR `user`.`email` = '".$email."';";
if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $usera);
    while (mysqli_stmt_fetch($stmt)) {
        $result = $usera;
    	}
    if ($result == "") { 
	echo "Sign up failed";	
	}
    mysqli_stmt_close($stmt);
    mysqli_close($conn);	

	}
}



//this logs a user in, and sets the session variable for the user
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

//this sends a random password to the user

function notify_password($username, $email)
// notify the user that their password has been changed
{
$conn = db_connect();
$password = random_password();
$hash = hash('sha512', $password);
$result = "";

$query = "SELECT email FROM `docunator`.`user` WHERE `user`.`user_name` = '".$username."' AND `user`.`email` = '".$email."';";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $emailcheck);
    while (mysqli_stmt_fetch($stmt)) {
       $result = $emailcheck;
    }


      $email = $result;
      $from = "From: contact@doczine.com \r\n";
      $mesg = "Your Doczine password has been changed to $password \r\n"
              ."Please change it next time you log in. \r\n";
      
		if (mail($email, 'Doczine Login Information', $mesg, $from)){
		echo "Password reset email sent to: $email.";
		echo "<br/>";
      
		$query1 = "UPDATE `docunator`.`password` SET `password` = '".$hash."' WHERE `password`.`user_name` = '".$username."';";
		$stmt1 = mysqli_prepare($conn, $query1);
		mysqli_stmt_execute($stmt1);
		mysqli_stmt_close($stmt1);
		echo "Your password has been changed.";
		echo "<br/>";
      
      mysqli_close($conn);
    }
} 
}

function list_user_files($user)
{
$conn = db_connect();
  
$query = "SELECT system_file_name, user_file_name, file_timestamp, user_name, file_description, file_title, category_name, user_file_index, file_mime_type, file_extension
FROM `docunator`.`user_file` 
INNER JOIN file_title USING (system_file_name)
INNER JOIN file_category USING (system_file_name)
INNER JOIN file USING (system_file_name)
INNER JOIN file_index USING (system_file_name)
WHERE user_name = '".$user."'
GROUP BY file_title.system_file_name, user_file.system_file_name";

// prepare statement 
	if ($stmt = mysqli_prepare($conn, $query)) {
	
		// execute statement 
		mysqli_stmt_execute($stmt);
	
		// bind result variables
		mysqli_stmt_bind_result($stmt, $system_file_name);
		
		//this is really important, it binds the system_file_name value to an array
		//I can then pass this array into any table in the database
		while(mysqli_stmt_fetch($stmt)) {
				echo "create_viewer.php?doc=";
				echo $system_file_name;
				echo "&search=investment&h=1200&w=1000#";
				$fields[] = $system_file_name;
       				
				}
		mysqli_stmt_close($stmt);
	}
	print_r($fields);
	
	foreach ($fields as $doc)
    {
    $url = "create_viewer.php?doc=";
    $urlVariable = "&search=investment&h=1200&w=1000#";
      // remember to call htmlspecialchars() when we are displaying user data
      echo "<tr bgcolor='666'><td><a href=\"$url$doc&search=investment&h=1200&w=1000#\">".htmlspecialchars($doc)."</a></td>";
      echo "<td><input type='checkbox' name=\"del_me[]\"
             value=\"$url\"></td>";
      echo "</tr>"; 
    }
	
}

//this creates a rnadmn password for the user email
function random_password() 
{
	$pass='';
	$salt = 'abchefghjkmnpqrstuvw3456789';
	srand((double)microtime()*1000000); 
	$i = 0;
	while ($i <= 10) 
	{
			$num = rand() % 33;
			$tmp = substr($salt, $num, 1);
			$pass = $pass . $tmp;
			$i++;
	}
return $pass;	
}      


function do_html_login_form()
{

  if (!isset($_SESSION['valid_user'])) 
  {
  	do_html_user_login();
  }
	else
{
    echo "You are logged in as: ";
    echo $_SESSION['valid_user'];
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    
}

}

function do_html_user_login()
{
  // print an HTML footer
?>
<div class="one-half last">
	<form id="sign-up-form" name="form" action="login.php" method="post" enctype="multipart/form-data">
		<h1>User Sign In</h1>
			<p>Sign Into Doczine</p>
				<label>User Name or Email:
					<span class="small">Input User Name or Email</span>
				</label>
					<input type="text" name="username" />
				<label>Password:
					<span class="small">Input Password</span>
				</label>
					<input type="password" name="password" />
					<br />
					<br />
					<input type="submit" name="submit" value="Submit" />
				<br />
				<?php
				echo "<a href='password_reset_form.php'>Click here to reset your password.</a>";
				?>
			<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
			<div class="spacer">
		</div>
	</div>
<br />
<br />
<?php
}


function do_html_password_reset()
{
  // print an HTML footer
?>

<div id="stylized" class="myform">
	<form id="sign-up-form" name="form" action="password_reset.php" method="post" enctype="multipart/form-data">
		<h1>Forgot Password?</h1>
				<label>User Name:
					<span class="small">Input User Name</span>
				</label>
					<input type="text" name="username" />
				<label>Email Address:
					<span class="small">Input Email Address</span>
				</label>
					<input type="text" name="email" />
					<br />
					<br />
					<input type="submit" name="submit" value="Submit" />
				<br />
			<div class="spacer">
		</div>
	</div>
<br />
<br />
<?php
}



?>
