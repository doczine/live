<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<title>CTI Recordings Login Page</title>
<meta name="CTI" content="CTI, Login"/>
<meta name="keywords" content="CTI"/>
<meta name="author" content="CTI"/>
</head>
<body>
<?php
if(!isset($_SESSION['valid_user'])){
?>
<div class="column3">
	   <form class="signin" id="sign-up-form" name="form" action="recordings.php" method="post" enctype="multipart/form-data">
		<fieldset>
			<p><label>Username</label><br />
			<input id="username" type="text" size="28" name="username" /></p>
			<p><label>Password</label><br />
			<input id="password" type="password" size="28" name="password" />
			</p>
			<button type="submit" name="submit" value="Submit">Sign in</button>
		</fieldset>
	</form>
</div>
<?php
session_start();
}
/*
if(isset($_POST)){
	echo "<table border='1'>
	";
	foreach($_POST as $stuff => $val ) {
	$val_array_post[$stuff] = $val;
	echo "<tr>";
	echo "<td>".strip_tags(stripslashes($stuff))." </td>";
	echo "<td>".strip_tags(stripslashes($val))." </td>";
	echo "</tr>
	";
	}
	echo "</table>";
	print_r($val_array_post);
}
*/
?>
</body>
</html>