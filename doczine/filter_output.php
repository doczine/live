
<?php
require_once("sessions.php");
include("filter_functions.php");
include 'thumbsup/init.php';

function do_html_home()
{
  // print an HTML header
 $sess = new SessionManager();
 session_start();
  
?>




﻿<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<title>Docunator | <?php echo $header; ?></title>
<meta name="Doczine.com" content="<?php echo $meta; ?>"/>
<meta name="keywords" content="<?php echo $description1; ?>"/>
<!--META KEYWORDS-->
<meta name="author" content="<?php echo $author; ?>"/>
<!--CSS FILES STARTS-->
<link rel="stylesheet" id="skins-switcher" href="css/style.css" type="text/css" media="screen"/>
<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery-ui.js"></script>
<link rel="stylesheet" href="css/jquery-ui.css" />
<link rel="stylesheet" href="footer/footer.css" type="text/css" media="screen" /><!-- Footer Stylings -->
<!-- The following code targets IE6 only and enables mouse hover on non-anchor tags -->
<!--[if IE 6]>
<link rel="stylesheet" type="text/css" href="footer/htc/ie6.css" />
<![endif]-->
<link rel="stylesheet" type="text/css" href="header/stickyheader.css" />
<script type="text/javascript" src="js/custom_jquery2.js"></script> <!-- Infinite scroll script -->
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
</head>
<body>
<?php
do_html_header_sticky();
?> 
<div id="wrapper">
	<div class="center">
	<ul id="header-icons">
	</ul>
		<div id="container">

				<br><br>
			<!-- HEADER ENDS-->
			<!-- MAIN CONTAINER -->
			<div id="content">
<?php
}
function do_html_lower_home()
{

do_html_infinite_scroll();

?>

</div>


<?php
}

function do_html_footer_sticky() {
?>
<div id="footer"><!-- BEGIN FOOTER CONTAINER -->
    <ul id="footer_menu"><!-- Begin Footer Menu -->
        <li class="imgmenu"><a href="#"></a></li><!-- This Item is an Image -->
        <li><a href="http://doczine.com/home.php">Home Page</a><!-- Begin Second Menu Item -->
        </li><!-- End Second Menu Item -->    
        <li><a href="http://doczine.com/file_list.php?user=asdf">Your File List</a><!-- Begin Third Menu Item -->
            <ul class="dropup"><!-- Default Drop Up List -->
            </ul><!-- End Drop Up List -->
        </li><!-- End Third Menu Item -->
        <li><a href="http://doczine.com/upload_form.php">Upload File</a></li>
        <li><a href="http://doczine.com/category_list.php">Browse</a></li>
        <li><a href="http://doczine.com/user_form.php">Sign Up</a></li>
        <li><a href="http://doczine.com/filter.php">Most Viewed</a></li>
        <li class="right"><a href="http://doczine.com/login_form.php" class="drop">Log In</a></li>
    </ul><!-- End Footer Menu -->
    <p><a href="http://doczine.com/home.php">Docunator.com  </a> &copy; 2013</p>
    <ul id="social"><!-- Social Icons -->
    	<!-- The span is the text appearing on hover, use the tooltip class in the link -->
        <li><a href="#" class="tooltip"><img src='http://doczine.com/footer/img/twitter.png' alt="" /><span></span></a></li>
        <li><a href="#" class="tooltip"><img src='http://doczine.com/footer/img/rss.png' alt="" /><span></span></a></li>
        <li><a href="#" class="tooltip"><img src='http://doczine.com/footer/img/flickr.png' alt="" /><span></span></a></li>
        <li><a href="#" class="tooltip"><img src='http://doczine.com/footer/img/facebook.png' alt="" /><span></span></a></li>
    </ul><!-- End Social Icons -->
</div><!-- END FOOTER CONTAINER -->
<?php
}



function do_html_header_sticky() {

?>

<div id="header" class="black"> <!-- BEGIN STICKY HEADER CONTAINER -->
    <ul id="menu"> <!-- BEGIN MENU -->
						<li><a href="home.php">Home</a></li>
						<li><a href="upload_form.php">Upload</a></li>
						<li><a href="category_list.php">Browse</a></li>
						<li><a href="user_form.php">Sign Up</a></li>
						<li><a href="login_form.php">Log In</a></li>
                
        <li class="right"><a class="drop" href="#">Sign in</a> <!-- SIGN IN MENU ALIGNED RIGHT -->
            <div class="column3container dropcontent align_right">
                <div class="column3">
    	               <form class="signin" id="sign-up-form" name="form" action="login.php" method="post" enctype="multipart/form-data">
                        <fieldset>
                        	<p><label>Username</label><br />
                            <input id="username" type="text" size="28" name="username" /></p>
                            <p><label>Password</label><br />
                            <input id="password1" type="password" size="28" name="password" />
                            </p>
                            <button type="submit" name="submit" value="Submit">Sign in</button>
                        </fieldset>		
                    </form>
                    
                </div>
            </div>
        </li>
        <li class="right separator"></li>
        <li class="search"> 
			<form accept-charset="utf-8" method="get" action="search.php">
			<input id="q" name="q" size="50" maxlength="255" style="height: 30px; width: 250px; font-size: 12px;" value="" type="text">
			<input name="searchsubmit" value="SEARCH" type="submit" style="height: 35px; width: 80px">
			</form>                
        </li>  
        </ul> <!-- END MENU -->        
</div> <!-- END CONTAINER -->

<?php
}

?>
