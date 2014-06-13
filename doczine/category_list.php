<?php
 
 include('category_functions.php');
 include('html_output1.php');
 
 $header = "Category Listing";
 $description1 = "Document Categories";
 $meta = "Document Categories";
 $description2 = "This page contains document categories";
 $author = "Doczine.com";
 
  do_html_upper($header, $description1, $meta, $description2, $author);

	echo "<div class='one-half last'>";
	display_upload_dropdown();
	display_upload_dropdown_file();
	echo "</div>";


?>
