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
<?php
 require_once("db.php");
 include('tag_functions.php');
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
