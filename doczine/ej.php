<?php
 require_once("db.php");
 include('ej_functions.php');
 include('html_output1.php');
 
 $header = "Tag Cloud";
 $description1 = "Document Tag Cloud";
 $meta = "Document Tags";
 $description2 = "This page contains document tags";
 $author = "doczine.com";
 
	do_html_upper($header, $description1, $meta, $description2, $author);
	
	echo "<script type='text/javascript' src='js/jquery.easing.1.3.js'></script>";

	display_tag_terms();



?>
