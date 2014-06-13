<?php

include 'header.php';
require_once("sessions.php");

function do_html_upper_upload()
{

$header = "Doczine | Document Upload Form";

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
<title> <?php echo $header; ?></title>
<meta name="Doczine.com" content="Upload Content"/>
<meta name="keywords" content="Upload Documents to Doczine.com"/>
<!--META KEYWORDS-->
<meta name="author" content="Doczine.com"/>
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
			<!--WRAPPER-->
			<!-- HEADER ENDS-->
			<!-- MAIN CONTAINER -->
			<div id="content">
				<div class="one">
					<!-- COLUMNS CONTAINER STARTS-->
				<div id="headline_container">

				</div> 
				<!-- INTRO ENDS-->
				</div>
				<!-- COLUMNS CONTAINER ENDS-->
				<div class="one">
					<div class="inner-content">
						<!--POST TITLE-->
						<!--PAGINATION ENDS-->
					</div>

<?php 
do_html_upload_form();


}

function do_html_upload_form()
{
  if(isset($_SESSION['valid_user']))
	{
	?>


<div class="one-half last">
	<form id="sign-up-form" name="form" action="upload.php" method="post" enctype="multipart/form-data">
		<h1>Document Upload Form</h1>
			<p>Please upload a document and include a description. Allowed filetypes:</p>
			<p>PDF RTF XLS XLSX TXT DOC DOCX PPT PPTX ODF ODT ODS TIF JPG PNG GIF</p>
				<label>File Title:
				<span class="small">Add a title</span>
				</label>
				<input type="text" name="title" style="width:450px;" />
				<label>Description:
				<span class="small">Add a description</span>
				</label>
				<textarea  name="description" cols="45" rows="5"></textarea><br />
				<br>
				<label for="file">Upload File:</label>
				<input type="file" name="file" id="file" style="width:600px;"/>
				<br><br>
				<div id="txtResult0">
				<select name='firstOption' style="width:450px;" onchange="htmlData('ajaxOption.php', 'ch='+this.value)" />
					<option value="#"></option>
					<option value="Arts - Photography">Arts - Photography</option>
					<option value="Biographies - Memoirs">Biographies - Memoirs</option>
					<option value="Brochures - Catalogs">Brochures - Catalogs</option>
					<option value="Business - Investing">Business - Investing</option>
					<option value="Childrens Books">Childrens Books</option>
					<option value="Comics - Graphic Novels">Comics - Graphic Novels</option>
					<option value="Computers - Internet">Computers - Internet</option>
					<option value="Cooking, Food - Wine">Cooking, Food - Wine</option>
					<option value="Entertainment">Entertainment</option>
					<option value="Government">Government</option>
					<option value="Health, Mind - Body">Health, Mind - Body</option>							
					<option value="History">History</option>
					<option value="Home - Garden">Home - Garden</option>
					<option value="How to Guides - Manuals">How to Guides - Manuals</option>					
					<option value="Law">Law</option>
					<option value="Literature - Fiction">Literature - Fiction</option>
					<option value="Medicine">Medicine</option>
					<option value="Mystery - Thrillers">Mystery - Thrillers</option>
					<option value="Nonfiction">Nonfiction</option>
					<option value="Magazine - Newspapers">Magazine - Newspapers</option>
					<option value="Outdoors - Nature">Outdoors - Nature</option>
					<option value="Parenting - Families">Parenting - Families</option>
					<option value="Personal">Personal</option>
					<option value="Presentation Art - Design">Presentation Art - Design</option>
					<option value="Professional - Technical">Professional - Technical</option>
					<option value="Recipes - Menus">Recipes - Menus</option>
					<option value="Research">Research</option>
					<option value="Reference">Reference</option>
					<option value="Religion - Spirituality">Religion - Spirituality</option>
					<option value="Romance">Romance</option>
					<option value="Science">Science</option>
					<option value="Science Fiction - Fantasy">Science Fiction - Fantasy</option>
					<option value="School">School</option>
					<option value="Speeches">Speeches</option>
					<option value="Sports">Sports</option>
					<option value="Spreadsheets">Spreadsheets</option>					
					<option value="Teens">Teens</option>
					<option value="Travel">Travel</option>
				</select>
				</div>
				<br>
				<div id="txtResult">
				<select name='secondOption' style="width: 450px;" onchange="htmlData1('ajaxOption.php', 'ch1='+this.value)" />
				</select>
				</div>
				
					
					<br />

				<input type="hidden" name="MAX_FILE_SIZE" value="1000000000">
				<input type="submit" value="Submit Form" />
					<br />
					<br />
				<br />
			<div class="spacer">
		</div>
	</div>

<?php

	}
	else
	{
		//do_html_user_login_upload();
		echo "You must be logged in to upload files.";
		echo "<br>";
		echo "<a href='http://doczine.com/login_form.php'>Login in here</a>";
		echo "<br>";
		echo "<a href='http://doczine.com/user_form.php'>Sign up here</a>";
		echo "<br>";
	}

}


function do_html_lower()
{
?>
				<div id="footer-wrapper">
					<!-- FOOTER WRAPPER STARTS-->
					<div id="footer-container">
						<!-- FOOTER CONTAINER STARTS-->
						<div id="footer">
							<!-- FOOTER STARTS-->
							<div class="one">
								<!-- COLUMN CONTAINER STARTS-->
								<div class="one-fourth">
									<!-- COLUMN STARTS-->
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
								<!-- COLUMN ENDS-->
								<div class="one-fourth">
									<!-- COLUMN STARTS-->
									<strong>Updates</strong>
									<!--END UL-->
								</div>
								<!-- COLUMN ENDS-->
								<div class="one-fourth">
									<!-- COLUMN STARTS-->
									<strong>Contact Info</strong>
									<ul id="footer-info">
									<li>Please contact us at these locations</li>
									<li><a href="http://www.facebook.com/pages/244602588893448">Facebook</a></li>									<li><a href="http://twitter.com/docunator">Twitter</a></li>
									<li><a href="http://www.linkedin.com/pub/joe-hettich/43/480/a91">Linked In</a></li>
									<li><a href="http://localhost/1317528419_6f613cfddb.html#/Contact_Us/Reference/General">Email Us</a></li>
										<!-- SOCIAL LINKS ENDS-->
									</ul>
								</div>
								<!-- COLUMN ENDS-->
								<div class="one-fourth last">
									<!-- COLUMN STARTS-->
									<strong>Latest Posts</strong>
									<ul class="simple-nav">	
										<li><a href="#">Document Hosting</a></li>
										<li><a href="#">Document Conversion</a></li>
										<li><a href="#">Mobile Viewing</a></li>
										<li><a href="#">Backup</a></li>
									</ul>	
								</div>
								<!-- COLUMN ENDS-->
							</div>
							<!-- COLUMN CONTAINER ENDS-->
						</div>
						<!-- FOOTER ENDS-->
					</div>
					<!-- FOOTER CONTAINER ENDS-->
				</div>
				<!-- FOOTER WRAPPER ENDS-->
				<div id="copyright-wrapper">
					<!-- COPYRIGHTS WRAPPER STARTS-->
					<div id="copyright">
						<a id="logo-copyright" title="Homepage" href="#"></a>
						<div class="right">
							<p>
							
							<a href="home.php">Home</a> | <a href="upload_form.php">Upload</a> | <a href="category_list.php">Categories</a> | <a href="user_form.php">Sign Up | <a href="login_form.php">Log In</a> | <a href="file_list.php?user=joe">Your Files</a> | <a href="1317528419_6f613cfddb.html#/Contact_Us/Reference/General">Contact Us</a>
							</p>
							<span>© Copyright 2011. <a href="http://docunator.com/">Docunator.com | The Doc Bot</a></span>
						</div>
					</div>
					<!-- COPYRIGHTS ENDS-->
				</div>
				<!-- COPYRIGHTS WRAPPER ENDS-->	
		</div>
		</div>
	</div>
</div>
</body>
<!--BODY ENDS  -->
</html>
<!--HTML ENDS  -->

<?php
}



function do_html_header_sticky() {

?>

<div id="header" class="black"> <!-- BEGIN STICKY HEADER CONTAINER -->
    <ul id="menu"> <!-- BEGIN MENU -->
	    <li><a href="home.php"><img src='http://doczine.com/images/doczine.png' alt="" width="140" height="39"/></li>
					
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
</div><!-- END FOOTER CONTAINER -->
<?php
}


?>
