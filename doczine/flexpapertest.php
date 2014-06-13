<?php
include 'viewer_functions.php';
require_once("sessions.php");
 
function do_html_upper()
{

 require_once("sessions.php");
 $sess = new SessionManager();
 if(!isset($_SESSION['valid_user'])){
 session_start();
 }
?>

			<!-- HEADER ENDS-->
			<!-- MAIN CONTAINER -->
			<div id="content">
		<div class="one">
			<!-- COLUMNS CONTAINER STARTS-->
			<div id="headline_container">
			<div class="headline"> 
				<div class="headline_inner_center"> 
					<h4>Welcome to <span class="colored">DOCUNATOR</span></h4>
					<h6 class="grey-intro">Upload Documents Here
					</h6>
				</div> 
		
			</div> 
		</div> 
			<!-- INTRO ENDS-->
		</div>
		<!-- COLUMNS CONTAINER ENDS-->
		<div class="one">

<?php 

}


function do_html_viewer_output()
{
  // print an HTML header
 $sess = new SessionManager();
 session_start();
 
$docs = display_flexpaper_test($doc);

$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
$ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");

if ($iphone || $android || $palmpre || $ipod || $berry || $ipad == true)
{
$header = "Location: ".display_mobile_link($docs);
header($header);
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="en-gb" xmlns="http://www.w3.org/1999/xhtml" lang="en-gb">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="robots" content="index, follow">
<meta name="keywords" content='docunator, <?php $doc = strip_tags($_GET['doc']); display_viewer_title($doc); ?>'>
<meta name="description" content='Docunator | <?php $doc = strip_tags($_GET['doc']); display_viewer_title($doc); ?>'>
<meta name="author" content="Docunator.com"/>
<meta name="generator" content="Docunator.com">
<title>Docunator | <?php $doc = strip_tags($_GET['doc']); display_viewer_title($doc); ?> </title>
<!--CHOOSE WICH FONT YOU WANT TO USE AND DELETE THE REST FOR FASTER LOADING-->
<link href='http://fonts.googleapis.com/css?family=Coustard|Questrial|Gloria+Hallelujah|Rochester|Abel|Rationale|Bowlby+One+SC|Snippet|Leckerli+One|Redressed|Aubrey|Open+Sans+Condensed:300|Paytone+One|Brawler|Tienne|Hammersmith+One|Rokkitt|Varela|Kreon|Oswald|Sunshiney|PT+Sans+Narrow|Istok+Web|Amaranth|Josefin+Sans|Nova+Script|Muli|Nova+Mono|Pompiere|News+Cycle|Old+Standard+TT|Cedarville+Cursive|Dancing+Script|Droid+Sans|Architects+Daughter|Smythe|Caudex|IM+Fell+Double+Pica|Zeyada|Buda:300|IM+Fell+French+Canon+SC|Josefin+Slab|Syncopate|Jura|Arimo|Coming+Soon|Quattrocento|Gruppo|IM+Fell+English+SC|Nova+Slim|Cuprum|Rock+Salt|Droid+Serif|Geostar+Fill|Geostar|Alice|Andika|Comfortaa|Delius+Swash+Caps|Actor|Marvel|Tulpen+One|Smokum|Carme|Delius|Black+Ops+One|Federo|Gentium+Basic|Yellowtail|The+Girl+Next+Door|Rosario|Swanky+and+Moo+Moo|Annie+Use+Your+Telescope|Play|Kameron|Lobster+Two|Anton|Just+Me+Again+Down+Here|Bangers|Coda:800|Open+Sans|Bigshot+One|UnifrakturCook:700|Shanti|IM+Fell+French+Canon|IM+Fell+Double+Pica+SC|Love+Ya+Like+A+Sister|Expletus+Sans|Merriweather|Kranky|IM+Fell+DW+Pica+SC|Ovo|PT+Serif|Copse|VT323|Coda+Caption:800|Allerta+Stencil|Lato|Meddon|Stardos+Stencil|Nobile' rel='stylesheet' type='text/css'>
<!--GOOGLE FONTS-->

<!--CSS FILES STARTS-->
<link rel="shortcut icon" type="image/gif" href="images/favicon.gif"/>
<link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen"/>
<link rel="stylesheet" id="skins-switcher" href="css/style.css" type="text/css" media="screen"/>
<link rel="stylesheet" type="text/css" href="css/flexpaper.css" />

<script type="text/javascript" src="js/viewer_flash.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.extensions.min.js"></script>
<script type="text/javascript" src="js/flexpaper.js"></script>
<script type="text/javascript" src="js/flexpaper_handlers.js"></script>

</head>

		<script type="text/javascript">
		var docs = '<?php get_file_title_url($docs); get_file_url($docs);?>';
		window.location.hash = "/"+docs;
		</script>

<body>

<div id="wrapper">

	<div class="center">

		<div id="containershadowless">
			<!--WRAPPER-->

<?php
	echo "<h4>";
	display_viewer_title($docs);
	echo " | ";
	display_user_filename($docs);
	echo " | ";
	get_file_taxo1($docs);
	echo "</h4>";
?>
<ul>
		<a href="home.php" class="button small round green:hover">Home</a>
		<a href="upload_form.php" class="button small round green:hover">Upload</a>
		<a href="category_list.php" class="button small round green:hover">Browse</a>
		<a href="user_form.php" class="button small round green:hover">Sign Up</a>
		<a href="login_form.php" class="button small round green:hover">Log In</a>
		<a href="file_list.php" class="button small round green:hover">Your File List</a>
</ul>
<div class="portfolio-container">
<input type=submit class="button big round grey"  value="     Search Text      " onclick="$FlexPaper('documentViewer').searchText($('#txt_searchtext').val())">
<input type=submit class="button big round grey" value="    Go To Page       " onclick="$FlexPaper('documentViewer').gotoPage($('#txt_pagenum').val())">
<input type=submit class="button big round grey" value="      Next Page       " onclick="$FlexPaper('documentViewer').nextPage()">
<input type=submit class="button big round grey"  value="    Previous Page     " onclick="$FlexPaper('documentViewer').prevPage()">
<input type=submit class="button big round grey"  value="   Fit Viewer Width   " onclick="$FlexPaper('documentViewer').fitWidth()">
<input type=submit class="button big round grey"  value="   Fit Viewer Height  " onclick="$FlexPaper('documentViewer').fitHeight()">
<input type=submit class="button big round grey"  value="     Print Paper       " onclick="$FlexPaper('documentViewer').printPaper()">
<br>
<input type=text style="width:132px; height:20px;" id="txt_searchtext" value="text">
<input type=text style="width:131px; height:20px;" id="txt_pagenum" value="3">



<?php
	do_html_viewer($doc);
?>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<div id="container">
<br><br>
<div class="portfolio-container">
<input type=submit class="button big round grey"  value="     Search Text      " onclick="$FlexPaper('documentViewer').searchText($('#txt_searchtext').val())">
<input type=submit class="button big round grey" value="    Go To Page       " onclick="$FlexPaper('documentViewer').gotoPage($('#txt_pagenum').val())">
<input type=submit class="button big round grey" value="      Next Page       " onclick="$FlexPaper('documentViewer').nextPage()">
<input type=submit class="button big round grey"  value="    Previous Page     " onclick="$FlexPaper('documentViewer').prevPage()">
<input type=submit class="button big round grey"  value="   Fit Viewer Width   " onclick="$FlexPaper('documentViewer').fitWidth()">
<input type=submit class="button big round grey"  value="   Fit Viewer Height  " onclick="$FlexPaper('documentViewer').fitHeight()">
<input type=submit class="button big round grey"  value="     Print Paper       " onclick="$FlexPaper('documentViewer').printPaper()">
<br>
<input type=text style="width:132px; height:20px;" id="txt_searchtext" value="text">
<input type=text style="width:131px; height:20px;" id="txt_pagenum" value="3">

	<ul>
		<li class="one-half web">
		<p>

		<div class="portfolio-item-preview">
			<a href="<?php display_images1($doc);?>" class="portfolio-img pretty-box"><img src="<?php display_images1($doc);?>" alt=" " width="216" height="280"/></a>
			<a href="<?php display_images2($doc);?>" class="portfolio-img pretty-box"><img src="<?php display_images2($doc);?>" alt=" " width="216" height="280"/></a>
		</div>

		</p>  
		<h5><a href="#"><?php display_viewer_description($doc); ?></a></h5> 
		<p> 
		

		<?php
		$doc = strip_tags(stripslashes(($_GET['doc'])));
		echo "<h6>";
		echo "File Category: ";
		echo stripslashes(get_file_taxo1($docs));
		echo "<br>";
		echo "Email File: ";
		echo "</h6>";
		?>
		<?php
		echo "<h6>";
		$doc = strip_tags(stripslashes(($_GET['doc'])));
		echo "Username: ";
		echo display_viewer_username($doc);
		echo "<br>";
		echo "Email to Friend: ";
		echo "</h6>";
		?>
		<?php 
		echo "<h6>";
		echo "Hitcount: ";
		echo viewer_hit_counter($doc);
		echo "<br>";
		echo "Vote Up: ";
		echo "</h6>";
		?>
		</p>
		</li>
		<li class="one-half logo">

		<p>

		</p>
		<h5><a href="#">Iframe Embed Code:</a></h5>
		<p>
		<?php
		echo "<textarea rows='1' cols='25' class='portfolio-item-preview' style=width:455px;height:220px;>";
		display_iframe_filename($docs);
		echo "</textarea>";
		?>

		</p>
		<h5><a href="#">Available Formats:</a></h5>
		<p>
		<?php
		display_download_links($doc); 

		$url = get_file_share_url($docs);
		$url = urlencode($url);

		$title = str_replace("_", " ", get_file_share_title($docs));
		$title = str_replace("/", "", $title)." ";
		$title = urlencode($title);
		
		echo "<br>";
		echo "<a href='http://www.facebook.com/sharer/sharer.php?u=".$url.$title." 'target=_blank'><img src=/images/share_facebook.png height=54 width=54></a>";
		echo "<a href='http://www.linkedin.com/shareArticle?mini=true&url=".$url."&title=".$title." 'target=_blank'><img src=/images/share_linkedin.png height=54 width=54></a>";
		echo "<a href='http://twitter.com/intent/tweet?source=webclient&text=".$title.$url." 'target=_blank'><img src=/images/share_twitter.png height=54 width=54></a>";
		echo "<a href='mailto:?Subject=".$title."&Body=".$url."'><img src=/images/share_mail.png height=54 width=54></a>";	
		echo "<br>";
		?>
		</p>
 
		</li>

	</ul>
	<!--END ul-->

<!--END portfolio-wrap-->


<?php
	
	$doc = strip_tags(stripslashes(($_GET['doc']))); 
	display_viewer_comment($doc);
	display_comment_post($doc);
?>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>

<?php

}


function do_html_viewer()
{
  // print an viewer
  
	$doc = strip_tags(stripslashes(($_GET['doc'])));
	$search = "1";
	
	//$search = strip_tags(stripslashes(($_GET['search'])));

	//allows http get to resize viewer

	        //script below creates viewer... http get filename is checked against database
	        //http get search is passed into url in order to highlight a document
?>

        <div id="documentViewer" class="flexpaper_viewer" wmode="transparent" style="position:absolute;left:0px;top:160px;margin-bottom:auto;width:100%;height:2000px;">  

        <script type="text/javascript">
            function getDocumentUrl(document){
                return "viewer/php/services/view.php?doc={doc}&format={format}&page={page}".replace("{doc}",document);
            }
            var startDocument = "Paper";
            $('#documentViewer').FlexPaperViewer(
                   { config : {
                     JSONFile : 'viewer/docs/Paper.js',
			<?php
			$docs = strip_tags(stripslashes(($_GET['doc'])));
			display_flexpaper_link($docs);
			?>
                     Scale : 0.6,
			key : '$eef3013294e695e8358',	
                     ZoomTransition : 'easeOut',
                     ZoomTime : 0.5,
                     ZoomInterval : 0.1,
                     FitPageOnLoad : false,
                     FitWidthOnLoad : true,
                     FullScreenAsMaxWindow : false,
                     ProgressiveLoading : false,
                     MinZoomSize : 0.2,
                     MaxZoomSize : 5,
                     SearchMatchAll : false,
                     InitViewMode : 'Portrait',
                     RenderingOrder : 'html5,html,flash',
                     StartAtPage : '',
                     ViewModeToolsVisible : true,
                     ZoomToolsVisible : true,
                     NavToolsVisible : true,
                     CursorToolsVisible : true,
                     SearchToolsVisible : true,
                     WMode : 'transparent',
                     localeChain: 'en_US'
                   }}
            );
		 function onDocumentLoaded(totalPages){
		 	getDocViewer().searchText(search);
		 }
        </script>
</div>
</div>

<?php
}

function do_html_lower()
{
?>
<br><br><br><br><br><br><br>

<br><br><br><br><br><br><br>

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
					<li><a href="http://www.facebook.com/pages/244602588893448">Facebook</a></li>	
					<li><a href="http://twitter.com/docunator">Twitter</a></li>
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
					
					<a href="home.php">Home</a> | <a href="upload_form.php">Upload</a> | <a href="category_list.php">Categories</a> | <a href="http://localhost/user_form.php">Sign Up | <a href="login_form.php">Log In</a> | <a href="file_list.php?user=joe">Your Files</a> | <a href="http://localhost/1317528419_6f613cfddb.html#/Contact_Us/Reference/General">Contact Us</a>
					</p>
					<span>© Copyright 2011. <a href="http://localhost/">Docunator.com | The Doc Bot</a></span>
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

?>



