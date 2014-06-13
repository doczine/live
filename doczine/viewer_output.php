<?php
include 'viewer_functions.php';
require_once("sessions.php");
include 'quickqrcode.php';


function do_html_upper()
{
 require_once("sessions.php");
 $sess = new SessionManager();
 if(!isset($_SESSION['valid_user'])){
 session_start();
 }
?>
		<div id="content">
		<div class="one">
			<div id="headline_container">
			<div class="headline"> 
				<div class="headline_inner_center"> 
					<h4>Welcome to <span class="colored">Doczine</span></h4>
					<h6 class="grey-intro">Upload Documents Here
					</h6>
				</div> 
			</div> 
		</div> 
		</div>
		<div class="one">
<?php 
}

function do_html_viewer_output()
{
 $sess = new SessionManager();
 session_start();

$docs = "";
	
 if(isset($_GET['doc'])){
	$docs = strip_tags(stripslashes(($_GET['doc'])));
 }
	
 if(isset($_GET['search'])){
	$search = strip_tags(stripslashes(($_GET['search'])));
 }
	
 if(!isset($_GET['search'])){
	$search = "";
 }
 
if (is_numeric($docs)) {
	$docs = display_file_counter($docs);
}

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
<meta name="keywords" content='doczine, <?php display_viewer_title1($docs); ?>'>
<meta name="description" content='<?php display_viewer_title1($docs); ?>'>
<meta name="author" content="Doczine.com"/>
<meta name="generator" content="Doczine.com">
<title><?php display_viewer_title1($docs); ?> | Doczine.com </title>

<link rel="stylesheet" href="footer/footer.css" type="text/css" media="screen" /><!-- Footer Stylings -->
<link rel="Stylesheet" type="text/css" href="header/stickyheader.css" />

<!--CSS FILES STARTS-->
<link rel="shortcut icon" type="image/gif" href="images/favicon.ico"/>
<link rel="stylesheet" id="skins-switcher" href="css/style.css" type="text/css" media="screen"/>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.extensions.min.js"></script>



    <link rel="stylesheet" href="view/viewer.css"/>

<!--#if !(FIREFOX || MOZCENTRAL || CHROME)-->
    <script type="text/javascript" src="view/compatibility.js"></script>
<!--#endif-->

<!--#if !PRODUCTION-->
    <script type="text/javascript" src="external/webL10n/l10n.js"></script>
<!--#endif-->

<!--#if !PRODUCTION-->
    <script type="text/javascript" src="src/core.js"></script>
    <script type="text/javascript" src="src/util.js"></script>
    <script type="text/javascript" src="src/api.js"></script>
    <script type="text/javascript" src="src/metadata.js"></script>
    <script type="text/javascript" src="src/canvas.js"></script>
    <script type="text/javascript" src="src/obj.js"></script>
    <script type="text/javascript" src="src/function.js"></script>
    <script type="text/javascript" src="src/charsets.js"></script>
    <script type="text/javascript" src="src/cidmaps.js"></script>
    <script type="text/javascript" src="src/colorspace.js"></script>
    <script type="text/javascript" src="src/crypto.js"></script>
    <script type="text/javascript" src="src/evaluator.js"></script>
    <script type="text/javascript" src="src/fonts.js"></script>
    <script type="text/javascript" src="src/glyphlist.js"></script>
    <script type="text/javascript" src="src/image.js"></script>
    <script type="text/javascript" src="src/metrics.js"></script>
    <script type="text/javascript" src="src/parser.js"></script>
    <script type="text/javascript" src="src/pattern.js"></script>
    <script type="text/javascript" src="src/stream.js"></script>
    <script type="text/javascript" src="src/worker.js"></script>
    <script type="text/javascript" src="external/jpgjs/jpg.js"></script>
    <script type="text/javascript" src="src/jpx.js"></script>
    <script type="text/javascript" src="src/jbig2.js"></script>
    <script type="text/javascript" src="src/bidi.js"></script>
    <script type="text/javascript">PDFJS.workerSrc = 'src/worker_loader.js';</script>
    
	
<!--#endif-->

<!--#if GENERIC || CHROME-->
<!--#include viewer-snippet.html-->
<!--#endif-->

    <script type="text/javascript" src="view/debugger.js"></script>
    <script type="text/javascript" src="view/viewer.php?docs=<?php echo $docs; ?>"></script>

</head>
		<script type="text/javascript">
		var docs = '<?php get_file_title_url($docs); get_file_url($docs);?>';
		window.location.hash = "/"+docs;
		</script>
<body>
<div id="wrapper">
	<div class="center">

<?php
	echo "<h4>";
	//display_viewer_title($docs);
	echo " | ";
	display_user_filename($docs);
	echo " | ";
	get_file_taxo1($docs);
	echo " | ";
	echo "Doczine.com";
	echo "</h4>";
?>

<?php

	do_html_viewer($docs, $search);

?>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<div id="container">
<br><br>
<div class="portfolio-container">

		<li class="one-half web">
		<p>
		<a href="<?php display_images1($docs);?>" class="portfolio-img pretty-box"><img src="<?php display_images1($docs);?>" alt=" " /></a>
		<h5><a href="#">Text Results:</a></h5>
		<p>
		<?php
		echo "<textarea rows='1' cols='25' class='portfolio-item-preview' style=width:455px;height:220px;>";
		display_txt_filename($docs);
		echo "</textarea>";
		?>
		</p>
		</p>  
		
		<h5><a href="#">File Information:</a></h5>
<textarea rows='1' cols='25' class='portfolio-item-preview' style=width:455px;height:220px;>
<?php
display_viewer_description($docs);
echo "

";
echo "File Category: ";
echo stripslashes(get_file_taxo1($docs));
echo "
";
echo "Email File: ";
//echo display_mobile_link($docs);
echo "
";
echo "Username: ";
echo display_viewer_username($docs);
echo "
";
echo "Email to Friend: ";
echo "
";
echo "Hitcount: ";
echo viewer_hit_counter($docs);
echo "
";
echo "Vote Up: ";
echo "

";
echo "File Metadata:";
echo "
";
display_metadata($docs);
echo "</textarea>";
?>
</p>
</li>
		<li class="one-half logo">
		<?php
		echo quickqrcode("292","yes");
		?>
		<h5><a href="#">Iframe Embed Code:</a></h5>
		<p>
		<?php
		echo "<textarea rows='1' cols='25' class='portfolio-item-preview' style='width:455px;height:220px;'>";
		display_iframe_filename($docs);
		echo "</textarea>";
		?>
		</p>
		<h5>
		<a href="#">Available Formats:</a>
		</h5>
		<?php
		display_conversion_links($docs);
		echo "<br>";
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
		display_download_links($docs);
		?>
 
		</li>


	<!--END ul-->

<!--END portfolio-wrap-->
<center>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-40167070-1']);
  _gaq.push(['_setDomainName', 'doczine.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<script type="text/javascript">
ch_client = "cajayone";
ch_width = 550;
ch_height = 250;
ch_type = "mpu";
ch_sid = "Chitika Default";
ch_color_site_link = "0000CC";
ch_color_title = "0000CC";
ch_color_border = "FFFFFF";
ch_color_text = "000000";
ch_color_bg = "FFFFFF";
</script>
<script src="http://scripts.chitika.net/eminimalls/amm.js" type="text/javascript">
</script>

<br>
<br>
<br>

<?php	
	display_viewer_comment($docs);
	display_comment_post($docs);
?>

</div>
<?php

do_html_footer_share($docs);

}

function do_html_viewer($docs, $search)
{
?>
<div id="wrapper">
    <div id="outerContainer">
      <div id="sidebarContainer">
        <div id="toolbarSidebar">
          <div class="splitToolbarButton toggled">
            <button id="viewThumbnail" class="toolbarButton group toggled" title="Show Thumbnails" tabindex="2" data-l10n-id="thumbs">
               <span data-l10n-id="thumbs_label">Thumbnails</span>
            </button>
            <button id="viewOutline" class="toolbarButton group" title="Show Document Outline" tabindex="3" data-l10n-id="outline">
               <span data-l10n-id="outline_label">Document Outline</span>
            </button>
          </div>
        </div>
        <div id="sidebarContent">
          <div id="thumbnailView">
          </div>
          <div id="outlineView" class="hidden">
          </div>
        </div>
      </div>  <!-- sidebarContainer -->
      <div id="mainContainer">
        <div class="findbar hidden doorHanger hiddenSmallView" id="findbar">
          <label for="findInput" class="toolbarLabel" data-l10n-id="find_label">Find:</label>
          <input id="findInput" class="toolbarField" value="<?php echo $search; ?>" tabindex="21">
          <div class="splitToolbarButton">
            <button class="toolbarButton findPrevious" title="" id="findPrevious" tabindex="22" data-l10n-id="find_previous">
              <span data-l10n-id="find_previous_label">Previous</span>
            </button>
            <div class="splitToolbarButtonSeparator"></div>
            <button class="toolbarButton findNext" title="" id="findNext" tabindex="23" data-l10n-id="find_next">
              <span data-l10n-id="find_next_label">Next</span>
            </button>
          </div>
          <input type="checkbox" id="findHighlightAll" class="toolbarField" checked="checked">
          <label for="findHighlightAll" class="toolbarLabel" tabindex="24" data-l10n-id="find_highlight">Highlight all</label>
          <input type="checkbox" id="findMatchCase" class="toolbarField">
          <label for="findMatchCase" class="toolbarLabel" tabindex="25" data-l10n-id="find_match_case_label">Match case</label>
          <span id="findMsg" class="toolbarLabel"></span>
        </div>
        <div class="toolbar">
          <div id="toolbarContainer">
            <div id="toolbarViewer">
              <div id="toolbarViewerLeft">
                <button id="sidebarToggle" class="toolbarButton" title="Toggle Sidebar" tabindex="4" data-l10n-id="toggle_sidebar">
                  <span data-l10n-id="toggle_sidebar_label">Toggle Sidebar</span>
                </button>
                <div class="toolbarButtonSpacer"></div>
                <button id="viewFind" class="toolbarButton group hiddenSmallView" title="Find in Document" tabindex="5" data-l10n-id="findbar">
                   <span data-l10n-id="findbar_label">Find</span>
                </button>
                <div class="splitToolbarButton">
                  <button class="toolbarButton pageUp" title="Previous Page" id="previous" tabindex="6" data-l10n-id="previous">
                    <span data-l10n-id="previous_label">Previous</span>
                  </button>
                  <div class="splitToolbarButtonSeparator"></div>
                  <button class="toolbarButton pageDown" title="Next Page" id="next" tabindex="7" data-l10n-id="next">
                    <span data-l10n-id="next_label">Next</span>
                  </button>
                </div>
                <label id="pageNumberLabel" class="toolbarLabel" for="pageNumber" data-l10n-id="page_label">Page: </label>
                <input type="number" id="pageNumber" class="toolbarField pageNumber" value="1" size="4" min="1" tabindex="8">
                </input>
                <span id="numPages" class="toolbarLabel"></span>


              </div>
              <div id="toolbarViewerRight">
                <input id="fileInput" class="fileInput" type="file" oncontextmenu="return false;" style="visibility: hidden; position: fixed; right: 0; top: 0" />

                <button id="fullscreen" class="toolbarButton fullscreen hiddenSmallView" title="Switch to Presentation Mode" tabindex="12" data-l10n-id="presentation_mode">
                  <span data-l10n-id="presentation_mode_label">Presentation Mode</span>
                </button>

                <button id="openFile" class="toolbarButton openFile hiddenSmallView" title="Open File" tabindex="13" data-l10n-id="open_file">
                   <span data-l10n-id="open_file_label">Open</span>
                </button>

                <button id="print" class="toolbarButton print" title="Print" tabindex="14" data-l10n-id="print">
                  <span data-l10n-id="print_label">Print</span>
                </button>

                <button id="download" class="toolbarButton download" title="Download" tabindex="15" data-l10n-id="download">
                  <span data-l10n-id="download_label">Download</span>
                </button>
                <!-- <div class="toolbarButtonSpacer"></div> -->
                
                <button id="bookmark" class="toolbarButton bookmark" title="bookmark" tabindex="16" data-l10n-id="bookmark">                
            		<span data-l10n-id="bookmark_label">Current View</span>
                </button>
                
                
             </div>
              <div class="outerCenter">
                <div class="innerCenter" id="toolbarViewerMiddle">
                  <div class="splitToolbarButton">
                    <button class="toolbarButton zoomOut" id="zoom_out" title="Zoom Out" tabindex="9" data-l10n-id="zoom_out">
                      <span data-l10n-id="zoom_out_label">Zoom Out</span>
                    </button>
                    <div class="splitToolbarButtonSeparator"></div>
                    <button class="toolbarButton zoomIn" id="zoom_in" title="Zoom In" tabindex="10" data-l10n-id="zoom_in">
                      <span data-l10n-id="zoom_in_label">Zoom In</span>
                     </button>
                  </div>
                  <span id="scaleSelectContainer" class="dropdownToolbarButton">  
                     <select id="scaleSelect" title="Zoom" oncontextmenu="return false;" tabindex="11" data-l10n-id="zoom">
                      <option selected="selected" id="pageWidthOption" value="page-width" data-l10n-id="page_scale_width">Full Width</option>
                      <option id="pageAutoOption" value="auto" data-l10n-id="page_scale_auto">Automatic Zoom</option>
                      <option id="pageActualOption" value="page-actual" data-l10n-id="page_scale_actual">Actual Size</option>
                      <option id="pageFitOption" value="page-fit" data-l10n-id="page_scale_fit">Fit Page</option>
                      <option id="customScaleOption" value="custom"></option>
                      <option value="0.5">50%</option>
                      <option value="0.75">75%</option>
                      <option value="1">100%</option>
                      <option value="1.25">125%</option>
                      <option value="1.5">150%</option>
                      <option value="2">200%</option>
                    </select>
                  </span>

					                <div class="toolbarButtonSpacer"></div>
                <a href='http://doczine.com/home.php'><img src='http://doczine.com/images/home1.png' height=25 width=25></a>
					                <div class="toolbarButtonSpacer"></div>
                <a href='http://doczine.com/user_form.php'><img src='http://doczine.com/images/signup1.png' height=25 width=25></a>
					                <div class="toolbarButtonSpacer"></div>
                <a href='http://doczine.com/file_list.php?user=asdf'><img src='http://doczine.com/images/filelist.png' height=25 width=25></a>
					                <div class="toolbarButtonSpacer"></div>
                <a href='http://doczine.com/category_list.php'><img src='http://doczine.com/images/browse1.png' height=25 width=25></a>
					                <div class="toolbarButtonSpacer"></div>
                <a href='http://doczine.com/upload_form.php'><img src='http://doczine.com/images/upload1.png' height=25 width=25></a>
					                <div class="toolbarButtonSpacer"></div>
                <a href='http://doczine.com/search.php'><img src='http://doczine.com/search.png' height=25 width=25></a>
					                <div class="toolbarButtonSpacer"></div>
				<a href='http://doczine.com/analytics/search'><img src='http://doczine.com/ANALYTICS.png' height=25 width=25></a>
									<div class="toolbarButtonSpacer"></div>  
                </div> 
              </div>
            </div>
          </div>
        </div>

        <menu type="context" id="viewerContextMenu">
          <menuitem label="First Page" id="first_page"
                    data-l10n-id="first_page" ></menuitem>
          <menuitem label="Last Page" id="last_page"
                    data-l10n-id="last_page" ></menuitem>
          <menuitem label="Rotate Counter-Clockwise" id="page_rotate_ccw"
                    data-l10n-id="page_rotate_ccw" ></menuitem>
          <menuitem label="Rotate Clockwise" id="page_rotate_cw"
                    data-l10n-id="page_rotate_cw" ></menuitem>
        </menu>

        <div id="viewerContainer" tabindex="1">
          <div id="viewer" contextmenu="viewerContextMenu"></div>
        </div>

        <div id="loadingBox">
          <div id="loading"></div>
          <div id="loadingBar"><div class="progress"></div></div>
        </div>

        <div id="errorWrapper" hidden='true'>
          <div id="errorMessageLeft">
            <span id="errorMessage"></span>
            <button id="errorShowMore" onclick="" oncontextmenu="return false;" data-l10n-id="error_more_info">
              More Information
            </button>
            <button id="errorShowLess" onclick="" oncontextmenu="return false;" data-l10n-id="error_less_info" hidden='true'>
              Less Information
            </button>
          </div>
          <div id="errorMessageRight">
            <button id="errorClose" oncontextmenu="return false;" data-l10n-id="error_close">
              Close
            </button>
          </div>
          <div class="clearBoth"></div>
          <textarea id="errorMoreInfo" hidden='true' readonly="readonly"></textarea>
        </div>
      </div> <!-- mainContainer -->

    </div> <!-- outerContainer -->
    <div id="printContainer"></div>
</div>
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


function do_html_footer_sticky() {
?>
<div id="footer" style="width:100%;"><!-- BEGIN FOOTER CONTAINER -->
    <ul id="footer_menu" style="width:100%;"><!-- Begin Footer Menu -->
                    
        <li class="imgmenu"><a href="http://doczine.com/home.php"></a></li><!-- This Item is an Image -->
        <li><a href="http://doczine.com/home.php">Home Page</a><!-- Begin Second Menu Item -->
        </li><!-- End Second Menu Item -->    
        <li><a href="http://doczine.com/file_list.php?user=asdf">Your File List</a><!-- Begin Third Menu Item -->
            <ul class="dropup"><!-- Default Drop Up List -->
            </ul><!-- End Drop Up List -->
        </li><!-- End Third Menu Item -->
        <li><a href="http://doczine.com/upload_form.php">Upload File</a></li>
        <li><a href="http://doczine.com/category_list.php">Browse</a></li>
        <li><a href="http://doczine.com/user_form.php">Sign Up</a></li>
        <li class="right"><a href="http://doczine.com/login_form.php" class="drop">Log In</a></li>
        
    	 <li class="search" style="height: 30px; width: 340px; font-size: 12px; margin:0 0 0 0; padding:0 0 0 0;"> 
			<form accept-charset="utf-8" method="get" action="search.php">
			<input id="q" name="q" size="50" maxlength="255" style="height: 35px; width: 252px; font-size: 12px; margin:0 0 0 0;" value="" type="text">
			<input name="searchsubmit" value="SEARCH" type="submit" style="height: 39px; width: 82px">
			</form>                
        </li>  
        
    </ul><!-- End Footer Menu -->
    <p><a href="http://doczine.com/home.php">Doczine.com  </a> &copy; 2013</p>
</div><!-- END FOOTER CONTAINER -->
<?php
}



?>



