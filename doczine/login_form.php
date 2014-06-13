<?php

 include('html_output1.php');
 include('user_functions.php');
 
 $header = "User Login";
 $description = "Doczine | User Login";
 $meta = "Doczine, Login";
 $description = "This page contains the Doczine login";
 $author = "Doczine.com";
  
  do_html_upper($header, $description, $meta, $description, $author);
  do_html_login_form();

 
 ?>
