<?php
 include('html_output1.php'); 
 include('user_functions.php');
 
 $header = "Doczine | Password Reset Page";
 $description = "Doczine | Password Reset";
 $meta = "Doczine, Login";
 $description = "This page contains the Doczine password reset form";
 $author = "Doczine.com";
 
  do_html_upper($header, $description, $meta, $description, $author);
  do_html_password_reset();
  
?>
