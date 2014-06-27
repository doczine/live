<?php
session_start();
print_r($_SESSION);
$today = date("Y-m-d");
error_reporting(E_ALL);
require_once('/var/www/etriever/pdflib/fpdf17/pdf_parser.php');
require_once('/var/www/etriever/pdflib/fpdf17/fpdf.php');
require_once('/var/www/etriever/pdflib/fpdf_tpl.php');
require_once('/var/www/etriever/pdflib/fpdi.php');
$conn = create_base_mysqli_test();
$pdf_key = "proof_of_the_intent_to_graduate_v1";
function create_base_mysqli_test() {
    $result = new mysqli("alps.ist.berkeley.edu", "entry", "tts,atosdtoami", "test", 3337);
    if (!$result)
        throw new Exception('Could not connect to database server');
    else
        return $result;
}
            echo "testing";
            
if(isset($_POST['approve'])){
    if(isset($_GET['student_id'])){

        $staff_id = "1047400";
        $student_id = $_GET[student_id];
        $query = "UPDATE `test`.`test` SET `staff_id` = '".$staff_id."' WHERE `student_id` = '".$student_id."';";
        if ($stmt = mysqli_prepare($conn, $query)); {
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }
        $query = "UPDATE `test`.`test` SET `eval_checkbox` = 'approve' WHERE `student_id` = '".$student_id."';";
        if ($stmt = mysqli_prepare($conn, $query)); {
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }
        $query = "UPDATE `test`.`test` SET `time_approve` = '".$today."' WHERE `student_id` = '".$student_id."';";
        if ($stmt = mysqli_prepare($conn, $query)); {
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }
            
            echo "testing approve";
            

    }
}
if(isset($_POST['deny'])){
    if(isset($_GET['student_id'])){

        $staff_id = "1047400";
        $student_id = $_GET[student_id];
        $query = "UPDATE `test`.`test` SET `staff_id` = '".$staff_id."' WHERE `student_id` = '".$student_id."';";
        if ($stmt = mysqli_prepare($conn, $query)); {
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }
        $query = "UPDATE `test`.`test` SET `eval_checkbox` = 'deny' WHERE `student_id` = '".$student_id."';";
        if ($stmt = mysqli_prepare($conn, $query)); {
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }
        $query = "UPDATE `test`.`test` SET `time_approve` = '".$today."' WHERE `student_id` = '".$student_id."';";
        if ($stmt = mysqli_prepare($conn, $query)); {
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }
            
            echo "testing deny";
            

    }
}

echo "Click here to return similar open petitions: ";
echo "<a href='https://etriever.berkeley.edu/test_report_open.php'>https://etriever.berkeley.edu/test_report_open.php</a>";

/* This will give an error. Note the output
 * above, which is before the header() call */


/*
//End output table
echo "</table>";
//Display PDF link, needs to make pdf name unique
echo "<a href='http://doczine.com/berkeley/newpdf3.pdf'>Here is your PDF print out of this form.</a>";
//Email sending library and logic
require '/usr/local/www/apache22/data/PHPMailer/class.phpmailer.php';
//Instantiate the PHPMailer object
$mail = new PHPMailer;
//Set mailer to use SMTP
$mail->IsSMTP();
//Specify main and backup server
$mail->Host = 'smtp.gmail.com';
//Enable SMTP authentication
$mail->SMTPAuth = true;
//SMTP username
$mail->Username = 'joe@doczine.com';
//SMTP password
$mail->Password = 'KOALA12345';
//Enable encryption, 'ssl' also accepted
$mail->SMTPSecure = 'tls';
//Email from address
$mail->From = 'joe@doczine.com';
//The email from title next to the email
$mail->FromName = 'eTriever';
//The primary sender addresss
$mail->AddAddress($email_verify, $student_name);
//Add a reply to address that is different from the sent
$mail->AddReplyTo('joe@doczine.com', 'Joe');
//Add an CC email
//$mail->AddCC($email_verify);
//Add an BCC email
$mail->AddBCC('joe@doczine.com', 'eTriever');
// Set word wrap to 50 characters
$mail->WordWrap = 50;
//Set email format to HTML
$mail->IsHTML(true);
//Set email text title 
$mail->Subject = "You Filled Out Berkeley.edu: Request for a Certificate of Completion";
//Set HTML email body
$mail->Body    = $student_name.' your online submission has been sent to the L&S database, here is a
PDF for your records. PDF Link: http://doczine.com/berkeley/newpdf3.pdf '.$csv."eTriever";
//Set TXT email body
$mail->AltBody = $student_name.' your online submission has been sent to the L&S database, here is a
PDF for your records. PDF Link: http://doczine.com/berkeley/newpdf3.pdf '.$csv."eTriever";
//Add PDF attachment to email body
$mail->AddAttachment('/usr/local/www/apache22/data/berkeley/newpdf3.pdf');
//If mail send method fails die and throw error
if(!$mail->Send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
}
//Email sent notice:
echo "An email notice was sent to the email address from the form: ".$email_verify;
//Close mysqli close connection
*/
?>