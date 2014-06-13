<?php

include('viewer_output.php');

$docs = strip_tags(stripslashes(($_GET['doc'])));
$search = strip_tags(stripslashes(($_GET['search'])));

$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
$ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");

//if ($iphone || $android || $palmpre || $ipod || $berry || $ipad == true)
//{
//$header = "Location: ".display_mobile_link($docs);
//header($header);
//}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="en-gb" xmlns="http://www.w3.org/1999/xhtml" lang="en-gb">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="robots" content="index, follow">
<meta name="keywords" content='Doczine, <?php $doc = strip_tags($_GET['doc']); display_viewer_title1($doc); ?>'>
<meta name="description" content='Doczine | <?php $doc = strip_tags($_GET['doc']); display_viewer_title1($doc); ?>'>
<meta name="author" content="Doczine.com"/>
<meta name="generator" content="Doczine.com">
<title>Doczine | <?php $doc = strip_tags($_GET['doc']); display_viewer_title1($doc); ?> </title>
<link rel="stylesheet" id="skins-switcher" href="css/style.css" type="text/css" media="screen"/>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.extensions.min.js"></script>
    <script type="text/javascript">    
    setInterval(function () {document.getElementById("findNext").click();}, 1000);
	</script>

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

<?php
$docs = strip_tags(stripslashes(($_GET['doc'])));
?>
    <script type="text/javascript" src="view/debugger.js"></script>
    <script type="text/javascript" src="view/viewer.php?docs=<?php echo $docs; ?>"></script>
</head>
<body>
<div id="wrapper">
	<div class="center">
<?php
$doc = $_GET['doc'];
do_html_viewer($doc, $search);
?>
</body>
</head>