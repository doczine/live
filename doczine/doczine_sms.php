<?php
include('html_output1.php'); 
include('user_functions.php');
ini_set('max_execution_time', 0);
ini_set('display_errors', '1');

//"We are the Borg. We will add your biological and technological distinctiveness to our own. Resistance is futile."

function error_msg($text) {
     # add other stuff you may want here
     $hello_var = 'Problem: '; //example of addon to beginning
     $goodbye_var = ' goodbye'; //example of addon to end
     die($hello_var.'<br />'.$text.'<br />'.$goodbye_var);
} 

function display_project_search($term) {
$conn = db_connect_local();
$query = "SELECT `PROJECT_KEY`, `PROJECT_TYPE`, `PROJECT_NAME`, `PROJECT_DESCRIPTION`, `PARCEL`, `ADDRESS`, `CITY`, `ZIP`, `PROJECT_LOCATION`, `PROJECTADDDTTM`, `PROJECT_ISSDTTM`, `PROJECT_EXPDTTM`, `APPLICANT` FROM `citydata`.`api` WHERE `api`.`PROJECT_TYPE` LIKE '%".$term."%';";
?>
<table border="1">
<tr>
<th>PROJECT_KEY</th>
<th>PROJECT_TYPE</th>
<th>PROJECT_NAME</th>
<th>PROJECT_DESCRIPTION</th>
<th>PARCEL</th>
<th>Google Maps - ADDRESS</th>
<th>CITY</th>
<th>ZIP</th>
<th>PROJECT_LOCATION</th>
<th>PROJECTADDDTTM</th>
<th>PROJECT_ISSDTTM</th>
<th>PROJECT_EXPDTTM</th>
<th>APPLICANT</th>
</tr>
<tr>
<?php


if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $PROJECT_KEY, $PROJECT_TYPE, $PROJECT_NAME, $PROJECT_DESCRIPTION, $PARCEL, $ADDRESS, $CITY, $ZIP, $PROJECT_LOCATION, $PROJECTADDDTTM, $PROJECT_ISSDTTM, $PROJECT_EXPDTTM, $APPLICANT);
    while (mysqli_stmt_fetch($stmt)) {
			
			echo "<td>";
			echo $PROJECT_KEY;
			echo "</td>";
			echo "<td>";
			echo $PROJECT_TYPE;
			echo "</td>";
			echo "<td>";
			echo $PROJECT_NAME;
			echo "</td>";			
			echo "<td>";
			echo $PROJECT_DESCRIPTION;
			echo "</td>";			
			echo "<td>";
			echo $PARCEL;
			echo "</td>";
			echo "<td>";
			echo "<a href='https://maps.google.com/maps?q=".$ADDRESS." ".$CITY." ".$ZIP."'>".$ADDRESS."<a/>";
			echo "</td>";
			echo "<td>";
			echo $CITY;
			echo "</td>";
			echo "<td>";
			echo $ZIP;
			echo "</td>";
			echo "<td>";
			echo $PROJECT_LOCATION;
			echo "</td>";
			echo "<td>";
			echo $PROJECTADDDTTM;
			echo "</td>";
			echo "<td>";
			echo $PROJECT_ISSDTTM;
			echo "</td>";
			echo "<td>";
			echo $PROJECT_EXPDTTM;
			echo "</td>";
			echo "<td>";
			echo $APPLICANT;
			echo "</td>";
		echo "</tr>";
		}
		mysqli_stmt_close($stmt);
	}
	echo "</tr>";
	echo "</table>";
	
	mysqli_close($conn);
}

$conn = db_connect_local();  
$user = "joe";
$term = strip_tags(stripslashes($_GET["term_1"]));
$mysqltime = date("Y-m-d H:i:s");

			if(!isset($user)){
				$text = "You must be logged in to post search terms.";
				error_msg($text);	
			}


if($_GET["term_1"] == NULL) {
  echo 'The term is a required field';   
} else {
$term = strip_tags(stripslashes($_GET["term_1"]));
	seonow($user, $term, $mysqltime);
}

function seonow($user, $term, $mysqltime) {

$conn = db_connect_local();

$query = "SELECT `projectterm` FROM `citydata`.`project_type` WHERE `project_type`.`projectterm` = '".$term."' AND `project_type`.`username` = '".$user."';";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $user123);
    while (mysqli_stmt_fetch($stmt)) {
            
			if($user123 == ""){
				$text = "You already added this term.";
				error_msg($text);		
			}
        
    	}
    		  if (!isset($result)) {

    		    		  
				$stmt1 = mysqli_prepare($conn, "INSERT INTO `citydata`.`project_type` (`username`,`projectterm`,`projectdate`) VALUES (?,?,?)"); 
					mysqli_stmt_bind_param($stmt1, "sss", $user, $term, $mysqltime);
					mysqli_stmt_execute($stmt1);
					mysqli_stmt_close($stmt1);    		  
				
				echo "You succesfully added ".$term." to your SMS and Email alerts ".$user;
				

			}
				else
			{
				echo 'Something bad happened, sorry try again.';
			}

    mysqli_stmt_close($stmt);
	}

$query = "SELECT `seo`.`seoterm` FROM `citydata`.`seo` WHERE `seo`.`seoterm` = '".$term."' OR `seo`.`username` = '".$user."';";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $usera);
    while (mysqli_stmt_fetch($stmt)) {
        $result = $usera;
    	}
    if ($result == "") { 
	echo "Sign up failed, mostly likely our fault, try again.";	
		} 
		else 
		{
		echo "<br>";
		$curl = "curl -X POST 'https://api.twilio.com/2010-04-01/Accounts/AC9872b624b9c4cd7422b8237b1804f0a3/SMS/Messages.xml' -d 'From=%2B18052849853' -d 'To=6195127765' -d 'Body=You+Added+".$term."+to+your+city+project+alerts+".$user."' -u AC9872b624b9c4cd7422b8237b1804f0a3:6a0e25335829671886a91a37769996b9";
		exec($curl);
		$curl = "curl -X POST 'https://api.twilio.com/2010-04-01/Accounts/AC9872b624b9c4cd7422b8237b1804f0a3/SMS/Messages.xml' -d 'From=%2B18052849853' -d 'To=8057087143' -d 'Body=You+Added+".$term."+to+your+city+project+alerts+".$user."' -u AC9872b624b9c4cd7422b8237b1804f0a3:6a0e25335829671886a91a37769996b9";
		exec($curl);
		echo "Here is a list of the current projects related to: ".$term;
		echo "<br>";
		display_project_search($term);
		
		
		
				require '/var/www/PHPMailer/class.phpmailer.php';

				$mail = new PHPMailer;

				$mail->IsSMTP();                                      // Set mailer to use SMTP
				$mail->Host = 'smtp.gmail.com';  // Specify main and backup server
				$mail->SMTPAuth = true;                               // Enable SMTP authentication
				$mail->Username = 'joe@doczine.com';                            // SMTP username
				$mail->Password = 'KOALA123';                           // SMTP password
				$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted

				$mail->From = 'joe@doczine.com';
				$mail->FromName = 'Mailer';
				$mail->AddAddress('joe@doczine.com', 'Joe');  // Add a recipient
				$mail->AddAddress('joe@doczine.com');               // Name is optional
				$mail->AddReplyTo('joe@doczine.com', 'Joe');
				$mail->AddCC('ej@doczine.com');
				$mail->AddBCC('joeemailaddy@gmail.com');

				$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
				$mail->IsHTML(true);                                  // Set email format to HTML

				$mail->Subject = "You added ".$term." to your city project alerts!";
				$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
				$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

				if(!$mail->Send()) {
				   echo 'Message could not be sent.';
				   echo 'Mailer Error: ' . $mail->ErrorInfo;
				   exit;
				}

				echo 'Message has been sent';
		
		
	}
    mysqli_stmt_close($stmt);
    mysqli_close($conn);	

	}
}




?>