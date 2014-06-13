<?php

require_once("sessions.php");

function do_html_user()
{

require_once("sessions.php");
$sess = new SessionManager();

if (strlen(session_id()) < 1) {
    session_start();
}

?>

﻿<!doctype html>
<html lang="en">
<head> 
<meta charset="utf-8"/>
<title>Doczine | Welcome to Doczine.com</title>
<meta name="Doczine.com" content="Doczine.com"/>
<meta name="keywords" content=""/>
<!--META KEYWORDS-->
<meta name="author" content="Doczine.com"/>
<!--CSS FILES STARTS-->
<link rel="stylesheet" id="skins-switcher" href="css/style.css" type="text/css" media="screen"/>
<!--CHOOSE WICH FONT YOU WANT TO USE AND DELETE THE REST FOR FASTER LOADING-->

</head>
<body>
<div id="wrapper">
	<div class="center">
		<p class="header-text-left">
		<strong>Doczine | Document Storage and Search</strong> 
		</p>
	<ul id="header-icons">

	</ul>
		<div id="container">
			<!--WRAPPER-->
			<div id="header">
				<!-- HEADER  -->
				<!-- LOGO -->
				<a id="logo" title="Homepage" href="index.html"></a>
				<!--LOGO ENDS  -->

				<div id="main_navigation" class="main-menu ">
					<!--  MAIN  NAVIGATION-->
					<ul>

						<li><a href="home.php">Home</a></li>
						<li><a href="upload_form.php">Upload</a></li>
						<li><a href="category_list.php">Browse</a></li>
						<li><a href="user_form.php">Sign Up</a></li>
						<li><a href="login_form.php">Log In</a></li>
	<li>
	<?php
	
 if(isset($_SESSION['valid_user'])){
	echo "<a href='file_list.php?user=".$_SESSION['valid_user']."'>File List</a>";
 }	
		
	?>
	</li>
					</ul>
				</div>
				<!-- MAIN NAVIGATION ENDS-->
			</div>
			<!-- HEADER ENDS-->
			<!-- MAIN CONTAINER -->
			<div id="content">
				<div class="one">
					<!-- COLUMNS CONTAINER STARTS-->
				<div id="headline_container">
					<div class="headline"> 
						<div class="headline_inner_center"> 
							<h4>Search <span class="colored">DOCUNATOR</span></h4>
							</h6>
		
							<form accept-charset="utf-8" method="get" action="top.php">
							<input id="q" name="q" size="50" maxlength="255" style="height: 26px; width: 300px; font-size: 12px;" value="" type="text">
							<input name="searchsubmit" value="SEARCH" type="submit" style="height: 28px; width: 80px">
							</form>
							<br>
				
					</div> 
				</div> 
				<!-- INTRO ENDS-->
				</div>
				<!-- COLUMNS CONTAINER ENDS-->
				<div class="one">
					<div class="inner-content">
						<!--POST TITLE-->
						<!--PAGINATION ENDS-->
					</div>
	


					<div class="one-fourth">
						<ul class="simple-nav">
							<li><a href="home.php">Home</a></li>
							<li><a href="upload_form.php">Upload Documents</a></li>
							<li><a href="category_list.php">Browse Categories</a></li>
							<li><a href="user_form.php">Sign Up</a></li>
							<li><a href="login_form.php">Log In</a></li>
							<li><a href="file_list.php?user=joe">Your File List</a></li>
							
						</ul>
					</div>
<?php 
echo "<div class='one-half last'>";
do_html_user_form(); 

if(isset($_SESSION['registration'])){
echo $_SESSION['registration'];
	}
echo "</div>";
}


function do_html_user_form()
{

  if (!isset($_SESSION['valid_user'])) 
  {
  	do_html_user_form_output();
  	do_html_captcha();
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
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
}

}




function do_html_user_form_output() {
?>
<div class="one-half last"> 
	<form id="sign-up-form" name="form" action="registration.php" method="post" enctype="multipart/form-data">
		<h1>User Sign Up</h1>
			<p>Sign up for Doczine access below</p>
				<label>User Name <b>*</b>
					<span class="small">Add a User Name</span>
				</label>
					<input type="text" name="username" />
				<label>Email Address <b>*</b>
					<span class="small">Add your email address:</span>
				</label>
					<input type="text" name="email" />					
				<label>Password <b>*</b>
					<span class="small">Enter your password:</span>
				</label>
					<input type="password" name="pwd" />
				<label>Re-enter Password <b>*</b>
					<span class="small">Re-enter your password:</span>
				</label>
					<input type="password" name="pwd1" />	
					<br />		
					<br />
				<input type="submit" value="Submit Form" />	
<?php
//do_html_captcha();
}

function do_html_user_files()
{
  // print an HTML footer
?>

<div class="one-half last">
	<form id="sign-up-form" name="form" action="login.php" method="post" enctype="multipart/form-data">
		<h1>User Sign In</h1>
			<p>Sign Into Doczine</p>
					<p>
					<?php
					$user = $_GET["user"];
					echo $user;
					list_user_files($user);
					?>
					</p>
					<br />

				<br />
			<div class="spacer">
		</div>
	</div>
<br />
<br />
<?php

}

function do_html_captcha()
{

if(isset($_SESSION['valid_user'])){
session_start();  // Start the session where the code will be stored.
}

if (empty($_POST)) { 
?>
<form method="POST">
<div style="width: 430px; float: center; height: 90px">
      <img id="siimage" align="center" style="padding-right: 0px; border: 0" src="securimage/securimage_show.php?sid=<?php echo md5(time()) ?>" />
<br />
        
        <!-- pass a session id to the query string of the script to prevent ie caching -->
        <a tabindex="-1" style="border-style: none" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = 'securimage/securimage_show.php?sid=' + Math.random(); return false"><img src="securimage/images/refresh.gif" alt="Reload Image" border="0" onclick="this.blur()" align="right" /></a>
</div>
<div style="clear: both"></div>
Code:<br />

<!-- NOTE: the "name" attribute is "code" so that $img->check($_POST['code']) will check the submitted form field -->
<input type="text" name="code" size="12" /><br /><br />
<input type="submit" value="Submit Form" />
</form>
			<div class="spacer">
		</div>
	</div>
<?php

	}
}


function do_html_logged_in($username, $password)
{

 require_once("sessions.php");
 $sess = new SessionManager();
 session_start();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="en-gb" xmlns="http://www.w3.org/1999/xhtml" lang="en-gb">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="robots" content="index, follow">
<meta name="keywords" content='doczine'>
<meta name="description" content='Doczine | User Sign Up'>
<meta name="generator" content="www.doczine.com">
<title>Docunator | Logged In</title>
<link rel="stylesheet" href="css/main.css" type="text/css">
<link rel="stylesheet" href="css/style.css" type="text/css">

		<script type="text/javascript" src="js/flexpaper_flash_debug.js"></script>
		<script type="text/javascript" src="js/jquery.js"></script>

</head>

<?php do_html_header(); ?>

<div class="clear">
</div>
</div>
</div>
</div>
<div id="rt-body-background">
<br>
<br>
<br>
<div class="rt-container">
<div class="clear">
</div>
<div id="rt-main" class="mb8-sa4">
<div class="rt-main-inner">
<div class="rt-grid-21">
<div id="rt-content-top">
<div class="rt-grid-21 rt-alpha rt-omega">
<div class="noticebox4 tabs nomargintop">
<div class="rt-block">
<div class="rt-module-surround">
<div class="rt-module-inner">
<div class="module-content">
<div class="roktabs-wrapper" style="width: 1050px;">
<div class="roktabs base top">
<div class="roktabs-links">
</div>
<div style="width: 1050px;" class="roktabs-container-inner">
<div style="width: 1050px;" class="roktabs-container-wrapper">
<div style="width: 1050px;" class="roktabs-tab2">
<div class="wrapper">
<div class="wrapper-inner">

<?php 
login($username, $password);
?>


<br>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="clear">
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="clear">
</div>
</div>
</div>
<div class="rt-grid-4">
<div id="rt-sidebar-a">
<div class="modulehover-1">
<div class="rt-block">
<div class="rt-module-surround">
<div class="module-title-surround">
<div class="module-title">
</div>
</div>
</div>
<div class="module-icon">
</div>
</div>
</div>
<div class="clear">
</div>
</div>
</div>
<div class="clear">
</div>
</div>
</div>
</div>
<?php
}



?>
