<?php

include('user_functions.php');


function display_upload_dropdown() {
$conn = db_connect_local();
$query = "SELECT PROJECT_TYPE, COUNT(*) FROM `citydata`.`api` GROUP BY PROJECT_TYPE;";
if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $carrot_seo_term, $count);
    while (mysqli_stmt_fetch($stmt)) {

    	echo "<a href='http://204.77.0.186/doczine_project.php?term_1=".$carrot_seo_term."'>";
		echo "View Project Type: ";
		echo $carrot_seo_term;
		echo " (";
		echo $count;
		echo ")";
		echo "</a>";

		echo "<br>";
		echo "<h3>";
    	echo "<a href='http://204.77.0.186/doczine_sms.php?term_1=".$carrot_seo_term."'>";
		echo "Add alerts for this project type: ";
		echo $carrot_seo_term;
		echo "</a>";
		echo "</h3>";

		}
		mysqli_stmt_close($stmt);
	}
	mysqli_close($conn);
}

display_upload_dropdown();





/*
//send email alert link
$to      = 'nobody@example.com';
$subject = 'the subject';
$message = 'hello';
$headers = 'From: webmaster@example.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
*/


//send sms alert link
/*
curl -X POST 'https://api.twilio.com/2010-04-01/Accounts/AC9872b624b9c4cd7422b8237b1804f0a3/SMS/Messages.xml' -d 'From=%2B18052849853' -d 'To=8057087143' -d 'Body=Yo+Joe+wassup' -u AC9872b624b9c4cd7422b8237b1804f0a3:6a0e25335829671886a91a37769996b9
*/





/*
check to see if a new notice was sent already, if not send sms and email alert 
login
add your preferred search terms, or location radius


*/

?>