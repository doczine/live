<?php
 
 include('email_functions.php');
 include('footer.php');
 include('html_output.php');

 $header = "User Page";
 $description1 = "Log In Results Page";
 $meta = "Doczine, Login";
 $description2 = "This page contains the Doczine login";
 $author = "Doczine.com";
 

	do_html_upper($header, $description1, $meta, $description2, $author);

	do_html_user_email();

?>
