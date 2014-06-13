<?php
include('db.php');
 
function valid_email($address)
{
  // check an email address is possibly valid
  if (ereg('^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$', $address))
    return true;
  else 
    return false;
}

//function to update user information
function update_user($user, $email, $first, $last, $address, $phone, $password, $mysqltime, $user_ip)
{
$conn = db_connect();
 
 	//checks if variables are set before running query
	if ($first != "") { 
	$query = "UPDATE `docunator`.`user` SET `first_name` = '".$first."' WHERE `user`.`user_name` = '".$user."';";
	$stmt = mysqli_prepare($conn, $query);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	echo "First name changed to: ".$first;
	echo "<br/>";
	}
	
	if ($last != "") { 
	$query = "UPDATE `docunator`.`user` SET `last_name` = '".$last."' WHERE `user`.`user_name` = '".$user."';";
	$stmt = mysqli_prepare($conn, $query);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	echo "Last name changed to: ".$last;
	echo "<br/>";
	}
	
	if ($email != "") { 
	$query = "UPDATE `docunator`.`user` SET `email` = '".$email."' WHERE `user`.`user_name` = '".$user."';";
	$stmt = mysqli_prepare($conn, $query);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	echo "Email changed to: ".$email;
	echo "<br/>";
	}
	
	if ($address != "") { 
	$query = "UPDATE `docunator`.`user` SET `address` = '".$address."' WHERE `user`.`user_name` = '".$user."';";
	$stmt = mysqli_prepare($conn, $query);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	echo "Address changed to: ".$address;
	echo "<br/>";
	}
	
	if ($phone != "") { 
	$query = "UPDATE `docunator`.`user` SET `phone` = '".$phone."' WHERE `user`.`user_name` = '".$user."';";
	$stmt = mysqli_prepare($conn, $query);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	echo "Phone changed to: ".$phone;
	echo "<br/>";
	}
mysqli_close($conn);
}


function change_password($user, $old_password, $passwordnew, $passwordnew1) {

$conn = db_connect();

$passwordold = hash('sha512', $old_password);
$password_new = hash('sha512', $passwordnew);

//checks to make sure passwords match
$query = "SELECT `password`.`password` FROM `docunator`.`password` WHERE `password`.`user_name` = '".$user."' AND `password`.`password` = '".$passwordold."';";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $password);
    while (mysqli_stmt_fetch($stmt)) {
	echo "<br>";
    }
  mysqli_stmt_close($stmt);
  if ($password == "") 
  {
  	echo "Please re-enter passwords";
	echo "<br>";
  }
	else
	{
	//changes passwords
	$query1 = "UPDATE `docunator`.`password` SET `password` = '".$password_new."' WHERE `password`.`user_name` = '".$user."';";
	$stmt1 = mysqli_prepare($conn, $query1);
	mysqli_stmt_execute($stmt1);
	mysqli_stmt_close($stmt1);
	echo "Password has been changed.";
	echo "<br/>";
    }
	}
mysqli_close($conn);
}


function do_html_edit_form()
{
?>

<div class="one-half last">
	<form id="sign-up-form" name="form" action="edit_user.php" method="post" enctype="multipart/form-data">
		<h1>Edit User Information</h1>
			<p>Edit User Information Below</p>

				<label>First Name:
					<span class="small">Edit your first name</span>
				</label>
					<input type="text" name="first" />
				<label>Last Name:
					<span class="small">Edit your last name:</span>
				</label>
					<input type="text" name="last" />
				<label>Email Address:
					<span class="small">Edit your email address:</span>
				</label>
					<input type="text" name="email" />					
				<label>Address:
					<span class="small">Edit your address:</span>
				</label>
					<input type="text" name="address" />
				<label>Phone Number:
					<span class="small">Edit your phone number:</span>
				</label>
					<input type="text" name="phone" />
				<label>Old Password:
					<span class="small">Enter your old password:</span>
				</label>
					<input type="password" name="oldpwd" />
				<label>New Password:
					<span class="small">Enter your new password:</span>
				</label>
					<input type="password" name="pwd" />
				<label>Re-enter Password:
					<span class="small">Re-enter new password:</span>
				</label>
					<input type="password" name="pwd1" />	
					<br />
				<br>
				<input type="submit" value="Submit Form" />
<br />
<?php
}

function do_html_user_login()
{
  // print an HTML footer
?>

<div id="stylized" class="myform">
	<form id="form" name="form" action="login.php" method="post" enctype="multipart/form-data">
		<h1>User Sign In</h1>
			<p>Sign Into Docunator</p>
				<label>User Name:
					<span class="small">Input User Name</span>
				</label>
					<input type="text" name="username" />
				<label>Password:
					<span class="small">Input Password</span>
				</label>
					<input type="text" name="password" />
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
