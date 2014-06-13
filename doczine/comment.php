<?php
//this is the page that the comment box gets posted into
 
ini_set('max_execution_time', 0);
include("viewer_functions.php");
include("securimage/securimage.php");
include("footer.php");
include("html_output1.php"); 

$conn = db_connect();
$user_ip = $_SERVER['REMOTE_ADDR'];  
$code = strip_tags(stripslashes($_POST["code"]));
$user = $_SESSION['valid_user'];
$doc = strip_tags(stripslashes($_GET['doc']));
$mysqltime = date("Y-m-d H:i:s");
$comment = strip_tags(stripslashes($_POST["comment"]));
$mysqltime = date("Y-m-d H:i:s");

//this calls the captcha object
$img = new Securimage();
$valid = $img->check($code); 
 
 $header = "Doczine | Hello, ".$user." you have posted!";
 $description = "Doczine | Successful Posting";
 $meta = "Doczine, Posting";
 $description = "This page contains the docunator comment posting page";
 $author = "Doczine.com";
 
 do_html_upper($header, $description, $meta, $description, $author);

 
//checks if user is logged in, and if captcha was valid
if(($valid == true) && (isset($_SESSION['valid_user'])))
	{
		//inserts comment if checks are valid
		if ($stmt = mysqli_prepare($conn, "INSERT INTO `docunator`.`file_comment` (`system_file_name`,`comment_date`,`user_name`,`file_comment`) VALUES (?,?,?,?)")); {
			// bind parameters for markers s for string i for integer
			mysqli_stmt_bind_param($stmt, "ssss", $doc, $mysqltime, $user, $comment);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
			echo "Comment was posted:";
			echo "<br>";
			echo $doc;
			echo "<br>";
			echo $mysqltime;
			echo "<br>";
			echo $user;
			echo "<br>";
			echo $comment;
			echo "<br>";
			echo "<a href='viewer.php?doc=".$doc."'>Click here to return to the document.</a>";
		}
	}
	//if user session variable is blank post login link
	elseif(($user = ""))	
	{
      echo "You must be signed in to post. Create an account <a href='create_user_form.php'>Here</a> Comment, or captcha.";
      echo "<a href='http://localhost/viewer.php?doc=".$doc."'>Click here to return to the document.</a>";
	}
	else
	{
	echo "Captcha was invalid.";
	}
mysqli_close($conn);

?>
