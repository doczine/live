<?php
include('viewer_functions.php');
 
function filled_out($form_vars)
{
  // test that each variable has a value
  foreach ($form_vars as $key => $value)
  {
     if (!isset($key) || ($value == '')) 
        return false;
  } 
  return true;
}

//this validates the email address
function valid_email($email)
{
  if (var_dump(filter_var($email, FILTER_VALIDATE_EMAIL)))
  {
    return true;
  }
  else
  {
    return false;
  }
}


function notify_password($username, $email)
// notify the user that their password has been changed
{
$conn = db_connect();
$password = random_password();

$query = "SELECT email FROM `docunator`.`user` WHERE `user`.`user_name` = '".$username."' AND `user`.`email` = '".$email."';";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $emailcheck);
    while (mysqli_stmt_fetch($stmt)) {
       $result = $emailcheck;
    }

    if (!$result)
    {
      throw new Exception('Could not find email address.');  
    }
    elseif($result == $email)
    {
      $email = $result;
      $from = "From: contact@doczine.com \r\n";
      $mesg = "Your Doczine password has been changed to $password \r\n"
              ."Please change it next time you log in. \r\n";

    }
    else
    {
	throw new Exception('Error, invalid user email.'); 
    }
      
		if (mail($email, 'Doczine Login Information', $mesg, $from)){
		echo "Password reset email sent to: $email.";
		echo "<br/>";
      
		$query1 = "UPDATE `docunator`.`password` SET `password` = '".$password."' WHERE `password`.`user_name` = '".$username."';";
		$stmt1 = mysqli_prepare($conn, $query1);
		mysqli_stmt_execute($stmt1);
		mysqli_stmt_close($stmt1);
		echo "Your password has been changed.";
		echo "<br/>";
      
		}
      else
      {
      	echo "Could not send reset email.";
      }
      mysqli_close($conn);
    }
} 

function do_html_user_email()
{
  // print an HTML footer
?>

<div id="stylized" class="myform">
	<form id="form" name="form" action="email.php" method="post" enctype="multipart/form-data">
			<p>Send a Document to Your Friend
			<br>
			Add Email Addresses Seperated by Commas to the Box Below
			</p>
			<p></p>
				<label>Email Addresses:
					<span class="small">Input Emails</span>
				</label>
					<input type="text" name="email" />
				<label>Email Title:
					<span class="small">Edit Email Title</span>
				</label>
					<input type="text" name="email" value='Someone Shared this Doczine File: <?php $doc = strip_tags($_GET['doc']);?>'/>	
					<br />
					<br />
					<?php do_html_captcha(); ?>
				<br />
			<div class="spacer">
		</div>
	</div>
<br />
<br />
<?php
}


?>