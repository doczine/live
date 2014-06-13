 
<?php
require_once("sessions.php");

function do_html_files()
{
  // print an HTML header
 $sess = new SessionManager();
 session_start();
  
?>


<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<title>Docunator | Your Personal Files</title>
<meta name="Your Documents" content="Docunator.com"/>
<meta name="Documents" content="Docunator"/>
<!--META KEYWORDS-->
<meta name="author" content="Docunator.com"/>
<!--CSS FILES STARTS-->
<link rel="shortcut icon" type="image/gif" href="images/favicon.gif"/>
<link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen"/>
<link rel="stylesheet" id="skins-switcher" href="css/style.css" type="text/css" media="screen"/>
<!--CHOOSE WICH FONT YOU WANT TO USE AND DELETE THE REST FOR FASTER LOADING-->
<link href='http://fonts.googleapis.com/css?family=Coustard|Questrial|Gloria+Hallelujah|Rochester|Abel|Rationale|Bowlby+One+SC|Snippet|Leckerli+One|Redressed|Aubrey|Open+Sans+Condensed:300|Paytone+One|Brawler|Tienne|Hammersmith+One|Rokkitt|Varela|Kreon|Oswald|Sunshiney|PT+Sans+Narrow|Istok+Web|Amaranth|Josefin+Sans|Nova+Script|Muli|Nova+Mono|Pompiere|News+Cycle|Old+Standard+TT|Cedarville+Cursive|Dancing+Script|Droid+Sans|Architects+Daughter|Smythe|Caudex|IM+Fell+Double+Pica|Zeyada|Buda:300|IM+Fell+French+Canon+SC|Josefin+Slab|Syncopate|Jura|Arimo|Coming+Soon|Quattrocento|Gruppo|IM+Fell+English+SC|Nova+Slim|Cuprum|Rock+Salt|Droid+Serif|Geostar+Fill|Geostar|Alice|Andika|Comfortaa|Delius+Swash+Caps|Actor|Marvel|Tulpen+One|Smokum|Carme|Delius|Black+Ops+One|Federo|Gentium+Basic|Yellowtail|The+Girl+Next+Door|Rosario|Swanky+and+Moo+Moo|Annie+Use+Your+Telescope|Play|Kameron|Lobster+Two|Anton|Just+Me+Again+Down+Here|Bangers|Coda:800|Open+Sans|Bigshot+One|UnifrakturCook:700|Shanti|IM+Fell+French+Canon|IM+Fell+Double+Pica+SC|Love+Ya+Like+A+Sister|Expletus+Sans|Merriweather|Kranky|IM+Fell+DW+Pica+SC|Ovo|PT+Serif|Copse|VT323|Coda+Caption:800|Allerta+Stencil|Lato|Meddon|Stardos+Stencil|Nobile' rel='stylesheet' type='text/css'>
<!--GOOGLE FONTS-->
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript" src="js/jqueryTools/jquery.tools.min.js"></script>
<script type="text/javascript" src="js/slides/slides.min.jquery.js"></script>
<script type="text/javascript" src="js/cycle-slider/cycle.js"></script>
<script type="text/javascript" src="js/nivo-slider/jquery.nivo.slider.js"></script>
<script type="text/javascript" src="js/tabify/jquery.tabify.js"></script>
<script type="text/javascript" src="js/prettyPhoto/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="js/scrolltop/scrolltopcontrol.js"></script>
<script type="text/javascript" src="js/portfolio/filterable.js"></script>
<script type="text/javascript" src="js/modernizr/modernizr-2.0.3.js"></script>
<script type="text/javascript" src="js/easing/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/kwicks/jquery.kwicks-1.5.1.pack.js"></script>
<script type="text/javascript" src="js/swfobject/swfobject.js"></script>
<!--CUFON FONTS-->
<script type="text/javascript" src="js/cufon-fonts/cufon.js"></script>
<script type="text/javascript" src="js/cufon-fonts/cufon-settings.js"></script>
<script type="text/javascript" src="js/cufon-fonts/cufon.museo.js"></script>
<script type="text/javascript" src="js/cufon-fonts/Titillium.font.js"></script>
</head>
<body>
<div id="wrapper">
	<div class="center">
		<p class="header-text-left">
		<strong>Docunator | The Doc Bot</strong> 
		</p>

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
						<li><a href="file_list.php">Your File List</a></li>
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
							<h4>Welcome to <span class="colored">DOCUNATOR</span></h4>
							<h6 class="grey-intro">Eliminating file types
							</h6>
						</div> 
				
					</div> 
				</div> 
				<!-- INTRO ENDS-->
				</div>
				<!-- COLUMNS CONTAINER ENDS-->
				<div class="one">
					<div class="inner-content">
						<!--POST TITLE-->
<?php display_upload_newest(); ?>
						<!--PAGINATION I am not going to build out home anymore because it is going to change, this was to test new template -->
<?php display_pagination(); ?>
						<!--PAGINATION ENDS-->
						
					</div>

<?php

}



?>
