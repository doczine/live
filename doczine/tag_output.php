<?php

require_once("sessions.php");

function do_html_upper($header, $description1, $meta, $description2, $author)
{

 require_once("sessions.php");
 $sess = new SessionManager();
 if(!isset($_SESSION['valid_user'])){
 session_start();
 }
	
?>

﻿<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<title>Doczine | <?php echo $header; ?></title>
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
<script type="text/javascript" src="js/jquery.tagcloud.js"></script>

	<script type="text/javascript" charset="utf-8">
	 $(document).ready(function(){
	   $("#tagcloud a").tagcloud();
	   
	   $('#tagForm').submit(function() {
	     $("#tagcloud a").tagcloud({
         size: {
           start: parseInt($('#minFont').val()), 
           end: parseInt($('#maxFont').val()), 
           unit: $('#unit').val()
         }, 
         color: {
           start: "#"+$('#startColour').val(), 
           end: "#"+$('#endColour').val()
         }
       })
       return false;
     })
   })
   
	</script>
	<style type="text/css">
		body {
  		margin-top: 1.0em;
  		background-color: #ffffff;
		  font-family: "helvetica"; 
  		color: #000000;
    }
    #container {
      margin: 0 auto;
      width: 700px;
    }
		h1 { font-size: 3.8em; color: #000000; margin-bottom: 3px; }
		h1 .small { font-size: 0.4em; }
		h1 a { text-decoration: none }
		h2 { font-size: 1.5em; color: #000000; }
    h3 { text-align: center; color: #000000; }
    a { color: #000000; }
    .description { font-size: 1.2em; margin-bottom: 30px; margin-top: 30px; font-style: italic;}
    .download { float: right; }
		pre { background: #000; color: #fff; padding: 15px;}
    hr { border: 0; width: 80%; border-bottom: 1px solid #aaa}
    .footer { text-align:center; padding-top:30px; font-style: italic; }
    
    body {
      text-align:center;
    }
    #tagcloud a {
  	  text-decoration: none;
  	}

  	#tagcloud a:hover {
  	  text-decoration: underline;
  	}

  	#tagcloud {
  	  margin: 25px auto;
  	  font: 75% Arial, "MS Trebuchet", sans-serif;
  	}
	</style>

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
			<div id="content">
				<div class="one">
				<div id="headline_container">
				</div> 
				</div>
				<div class="one">
					<div class="inner-content">
					</div>
<?php 
}

function do_html_header_sticky() {

?>
<div id="header" class="black">
    <ul id="menu">
	    <li><a href="home.php"><img src='http://doczine.com/images/doczine.png' alt="" width="140" height="39"/></li>	
						<li><a href="upload_form.php">Upload</a></li>
						<li><a href="tag.php">Browse</a></li>
						<li><a href="user_form.php">Sign Up</a></li>
						<li><a href="login_form.php">Log In</a></li>
        <li class="right"><a class="drop" href="#">Sign in</a>
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
        </ul>
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
        <li><a href="http://doczine.com/tag.php">Browse</a></li>
        <li><a href="http://doczine.com/user_form.php">Sign Up</a></li>
        <li><a href="http://doczine.com/filter.php">Most Viewed</a></li>
        <li class="right"><a href="http://doczine.com/login_form.php" class="drop">Log In</a></li>
    </ul><!-- End Footer Menu -->
    <p><a href="http://doczine.com/home.php">Docunator.com  </a> &copy; 2013</p>
</div><!-- END FOOTER CONTAINER -->
<?php
}

function do_html_lower()
{
?>
				<div id="footer-wrapper">
					<div id="footer-container">
						<div id="footer">
							<div class="one">
								<div class="one-fourth">
									<strong>© Docunator.com | The Doc Bot</strong>
										<ul id="our-photos-footer">
										<li><a href="#"><img src="images/clients/1.jpg" width="40" height="40" alt=" " /></a></li>
										<li><a href="#"><img src="images/clients/2.jpg" width="40" height="40" alt=" " /></a></li>
										<li><a href="#"><img src="images/clients/3.jpg" width="40" height="40" alt=" " /></a></li>
										<li class="last"><a href="#"><img src="images/clients/4.jpg" width="40" height="40" alt=" " /></a></li>	
										<li><a href="#"><img src="images/clients/5.jpg" width="40" height="40" alt=" " /></a></li>
										<li><a href="#"><img src="images/clients/6.jpg" width="40" height="40" alt=" " /></a></li>
										<li><a href="#"><img src="images/clients/7.jpg" width="40" height="40" alt=" " /></a></li>
										<li class="last"><a href="#"><img src="images/clients/8.jpg" width="40" height="40" alt=" " /></a></li>
									</ul>
								</div>
								<div class="one-fourth">
									<strong>Updates</strong>
								</div>
								<div class="one-fourth">
									<strong>Contact Info</strong>
									<ul id="footer-info">
									<li>Please contact us at these locations</li>
									<li><a href="http://www.facebook.com/pages/244602588893448">Facebook</a></li>									
									<li><a href="http://twitter.com/docunator">Twitter</a></li>
									<li><a href="1326738058_aa0407d026.html">Email Us</a></li>
									</ul>
								</div>
								<div class="one-fourth last">
									<strong>Latest Posts</strong>
									<ul class="simple-nav">	
										<li><a href="#">Document Hosting</a></li>
										<li><a href="#">Document Conversion</a></li>
										<li><a href="#">Mobile Viewing</a></li>
										<li><a href="#">Backup</a></li>
									</ul>	
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="copyright-wrapper">
					<div id="copyright">
						<a id="logo-copyright" title="Homepage" href="#"></a>
						<div class="right">
							<p>
							<a href="home.php">Home</a> | <a href="upload_form.php">Upload</a> | <a href="tag.php">Categories</a> | 
<a 
href="user_form.php">Sign Up | <a href="login_form.php">Log In</a> | <a href="file_list.php?user=joe">Your Files</a> | <a href="1317528419_6f613cfddb.html#/Contact_Us/Reference/General">Contact Us</a>
							</p>
							<span>© Copyright 2011. <a href="http://docunator.com/">Docunator.com | The Doc Bot</a></span>
						</div>
					</div>
				</div>
		</div>
		</div>
	</div>
</div>
</div>
</body>
</html>
<?php
}



?>
