<?php
 
 include('user_functions.php');
 include('html_output1.php');
 include('user_output.php');
 
 $header = "Doczine | User Upload Page";
 $description = "Doczine | Upload";
 $meta = "Doczine, Login";
 $description = "This page contains the Doczine login";
 $author = "Doczine.com";
 
  do_html_upper($header, $description, $meta, $description, $author);
  do_html_user_form_output();

?>
