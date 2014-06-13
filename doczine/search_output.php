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

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<title>Doczine | <?php echo $header; ?></title>
<meta name="Doczine.com" content="<?php echo $meta; ?>"/>
<meta name="keywords" content="<?php echo $description1; ?>"/>
<!--META KEYWORDS-->
<meta name="author" content="<?php echo $author; ?>"/>
<!--CSS FILES STARTS-->
<script type="text/javascript" src="js/jquery.extensions.min.js"></script>

<link rel="stylesheet" href="css/jquery-ui.css" />
<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery-ui.js"></script>
	<script type="text/javascript">
	    $(document).ready(function(){
	        $('#example-1').sticklr({
				showOn		: 'hover',
				stickTo     : 'right'
			});
			$('#example-2').sticklr({
				showOn		: 'click',
				stickTo     : 'left'
			});
	    });
	</script>
</head>
<body>
<div id="wrapper">
	<div class="center">
		<p class="header-text-left">
		<strong>Doczine | Search Results</strong> 
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
		echo "<a href='file_list.php?user=".$_SESSION['valid_user']."'>File List</a>";
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
							<h4>Search <span class="colored">Doczine</span></h4>
							</h6>
		
							<form accept-charset="utf-8" method="get" action="search.php">
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
<?php 

}


function do_html_search()
{
  // print an HTML header
 $sess = new SessionManager();
 session_start();
  
?>


<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<title>Doczine | Welcome to Doczine.com</title>
<meta name="Doczine.com" content="Doczine.com"/>
<meta name="keywords" content="document, file upload, file conversion"/>
<!--META KEYWORDS-->
<meta name="author" content="Doczine.com"/>
<!--CSS FILES STARTS-->

<link rel="stylesheet" id="skins-switcher" href="css/style.css" type="text/css" media="screen"/>

  <link rel="stylesheet" type="text/css" href="lightbox/help/css/reset.css" />
  <link rel="stylesheet" type="text/css" href="lightbox/js/lightbox/themes/default/jquery.lightbox.css" />
  <!--[if IE 6]>
  <link rel="stylesheet" type="text/css" href="lightbox/js/lightbox/themes/default/jquery.lightbox.ie6.css" />
  <![endif]-->
  
  <script type="text/javascript" src="lightbox/js/jquery.min.js"></script>
  <script type="text/javascript" src="lightbox/js/lightbox/jquery.lightbox.min.js"></script>
  <!-- // <script type="text/javascript" src="lightbox/src/jquery.lightbox.js"></script>   -->

  <script type="text/javascript">
    jQuery(document).ready(function($){
      $('.lightbox').lightbox();
    });
  </script>
  
<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery-ui.js"></script>
<link rel="stylesheet" href="css/jquery-ui.css" />
<link rel="stylesheet" href="footer/footer.css" type="text/css" media="screen" /><!-- Footer Stylings -->
<!-- The following code targets IE6 only and enables mouse hover on non-anchor tags -->
<!--[if IE 6]>
<link rel="stylesheet" type="text/css" href="footer/htc/ie6.css" />
<![endif]-->

<link rel="Stylesheet" type="text/css" href="header/stickyheader.css" />
<script type="text/javascript" src="js/custom_jquery.js"></script> <!-- Infinite scroll script -->

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
			
			
			
			
<script>
//config floating menu jquery
$float_speed=200; //milliseconds
$float_easing="easeOutQuint";
$menu_fade_speed=100; //milliseconds
$closed_menu_opacity=0.75;

//cache vars
$fl_menu=$("#fl_menu");
$fl_menu_menu=$("#fl_menu .menu");
$fl_menu_label=$("#fl_menu .label");

$(window).load(function() {
	menuPosition=$('#fl_menu').position().top;
	FloatMenu();
	$fl_menu.hover(
		function(){ //mouse over
			$fl_menu_label.fadeTo($menu_fade_speed, 1);
			$fl_menu_menu.fadeIn($menu_fade_speed);
		},
		function(){ //mouse out
			$fl_menu_label.fadeTo($menu_fade_speed, $closed_menu_opacity);
			$fl_menu_menu.fadeOut($menu_fade_speed);
		}
	);
});

$(window).scroll(function () { 
	FloatMenu();
});

function FloatMenu(){
	var scrollAmount=$(document).scrollTop();
	var newPosition=menuPosition+scrollAmount;
	if($(window).height()<$fl_menu.height()+$fl_menu_menu.height()){
		$fl_menu.css("top",menuPosition);
	} else {
		$fl_menu.stop().animate({top: newPosition}, $float_speed, $float_easing);
	}
}
</script>

			
<?php
}
function do_html_lower_search()
{

//do_html_infinite_scroll();

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
    <p><a href="http://doczine.com/home.php">Doczine.com  </a> &copy; 2013</p>
</div><!-- END FOOTER CONTAINER -->
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



function display_pagination()
{
$conn = db_connect();

if(!isset($_GET['page']) && !isset($_GET['viewed'])) {
$page = 0;
$query = "
SELECT `system_file_name` , `file_title` , `short_name` , `file_timestamp`, `user_name`, `user_file_name`, `user_ip`
FROM `docunator`.`file`
INNER JOIN `docunator`.`file_title`
USING ( system_file_name )
INNER JOIN `docunator`.`user_file`
USING ( system_file_name )
ORDER BY `file`.`file_timestamp` DESC
LIMIT ".$page." , 100
;";
$page = 8;
	}
if(isset($_GET['page']) && !isset($_GET['viewed'])){
$page = strip_tags(stripslashes($_GET['page']));
$page = $page + 8;
$query = "
SELECT `system_file_name` , `file_title` , `short_name` , `file_timestamp`, `user_name`, `user_file_name`, `user_ip`
FROM `docunator`.`file`
INNER JOIN `docunator`.`file_title`
USING ( system_file_name )
INNER JOIN `docunator`.`user_file`
USING ( system_file_name )
ORDER BY `file`.`file_timestamp` DESC
LIMIT ".$page." , 100
;";
	}
}




?>
