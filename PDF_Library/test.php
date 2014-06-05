<?php

$mysqltime = date("Y-m-d H:i:s");

include('/var/www/etriever/html/models/user_auth_fns.php');
require_once('/var/www/etriever/conf/db_base.php');
require_once('/var/www/etriever/conf/bfdb.php');
require_once('/var/www/etriever/conf/aodb.php');
require_once('/var/www/etriever/conf/db.php');
require_once('/var/www/etriever/html/models/helper_fns.php');
//require_once('/var/www/etriever/html/index.php');

//Franklin's test: Array ( [LAST_ACTIVITY] => 1380575390 [staff_id] => 1041754 [access_grp] => peer [access_lvl] => 10 )

session_start();
//print_r($_SESSION);

//echo $c_page_id;
//echo $c_var;
//echo $c_value;
//echo $uid;

//phpinfo();

if(isset($_SESSION['staff_id'])){
//	$user = $_SESSION['staff_id'];
//	echo $user;
}

//auth($uid);

$oci_conn = oci_connect($ora_usr, $ora_pass, $ora_db, 'AL32UTF8');
if (!$oci_conn) {
$e = oci_error();
trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$stid = oci_parse($oci_conn,"SELECT STU_ID, STU_NAME, EMAIL_ADDRESS, BILLING_STREET1, BILLING_STREET2, BILLING_CITY, BILLING_STATE, BILLING_ZIP, LOCAL_STREET1, LOCAL_STREET2, LOCAL_CITY, LOCAL_STATE, LOCAL_ZIP, PERM_STREET1, PERM_STREET2, PERM_CITY, PERM_STATE, PERM_ZIP
FROM ADV.STUDENT_COL_VW
LEFT JOIN ADV.STUADDR_COL_VW USING (STU_ID)
WHERE STU_ID = '10046939';");
oci_execute($stid);
$row1 = oci_fetch_assoc($stid);
print_r($row1);
oci_free_statement($stid);
print_r($row1);
ini_set('display_errors',1);
error_reporting(E_ALL|E_STRICT);

$page_id = null;
$var = null;
$value = null;

do_html_upper_upload();

function do_html_upper_upload()
{
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Etriever - Form Retrieval</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link href="https://etriever.berkeley.edu/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="https://etriever.berkeley.edu/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="https://etriever.berkeley.edu/css/style-responsive.css" rel="stylesheet" type="text/css"/>
    <link href="https://etriever.berkeley.edu/css/default.css" rel="stylesheet" type="text/css" id="style_color"/>
    <link rel="shortcut icon" href="favicon.ico" />
</head>
<body class="page-header-fixed">
    <div class="header navbar navbar-inverse navbar-fixed-top">
    </div>
    <div class="page-container row-fluid">
        <div class="page-sidebar nav-collapse collapse">
            <ul class="page-sidebar-menu">
                <li class="active ">
                    <a href="">
                    <span class="title">Etriever Form Stuff</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="page-content">
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="portlet box blue tabbable">
                            <div class="portlet-title">
                            Etriever - Proof of the Intent to Graduate - Electronic Form
                            </div>
                            <div class="portlet-body form">
                                <div class="tabbable portlet-tabs">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="portlet_tab1">
<br>
<br>
<br>

<?php 
do_html_upload_form();
}
function do_html_upload_form()
{


session_start();
//print_r($_SESSION);
$ora_db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = dba-oracle-prod-30.IST.berkeley.edu)(PORT = 1521)))(CONNECT_DATA=(SID=STUPROD)))";
$ora_usr = 'applns';
$ora_pass = '$MIbn1pf';
$oci_conn = oci_connect($ora_usr, $ora_pass, $ora_db, 'AL32UTF8');
if (!$oci_conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$mysqli_base = create_base_mysqli();

$staff_id = $_SESSION[staff_id];

$query = "SELECT `staff`.`STAFF_ID`, `staff`.`STAFF_NAME_LAST`, `staff`.`STAFF_NAME_FIRST` FROM `etrv`.`staff` WHERE `staff`.`STAFF_ID` = '".$staff_id."'";

if ($stmt = mysqli_prepare($mysqli_base, $query)) {
    //print_r($stmt);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $staff, $staff_last, $staff_first);
    while (mysqli_stmt_fetch($stmt)) {
        //echo $staff;
        //echo $staff_last;
        //echo $staff_first;
    }
    mysqli_stmt_close($stmt);
}

$slistq = oci_parse($oci_conn,"
SELECT STU_ID, STU_NAME, LOCAL_TEL_AREA_CD, LOCAL_TEL_NUM, EMAIL_ADDRESS, LOCAL_STREET1, LOCAL_STREET2, LOCAL_CITY, LOCAL_STATE, LOCAL_ZIP
FROM ADV.STUDENT_COL_VW
LEFT JOIN ADV.STUADDR_COL_VW USING (STU_ID)
WHERE STU_ID = '10046939'
");
oci_execute($slistq);
$slist = array();
$slist_units = 0;
$k = 0;
while ($slist_row = oci_fetch_assoc($slistq)) { 
    $slist = $slist_row;
    //print_r($slist_row);
}
//print_r($slist);
$student_name = trim($slist["STU_NAME"]," ");
$student_id = trim($slist["STU_ID"]," ");
$email_address = trim($slist["EMAIL_ADDRESS"]," ");
$email_address = trim($slist["EMAIL_ADDRESS"]," ");
$street = trim($slist["LOCAL_STREET1"]," ");
$city = trim($slist["LOCAL_CITY"]," ");
$zip = trim($slist["LOCAL_ZIP"]," ");
$state = trim($slist["LOCAL_STATE"]," ");
$phone_prefix = trim($slist["LOCAL_TEL_NUM"]," ");
$phone_postfix = trim($slist["LOCAL_TEL_AREA_CD"]," ");


$query = "SELECT MAJ_CD, MAJ_TITLE, MAJ_DESC FROM ADV.STUMAJ_COL_VW LEFT JOIN DSC.MAJOR_VW USING (MAJ_CD) WHERE STU_ID = '10046939'";
$slistq1 = oci_parse($oci_conn, $query);
oci_execute($slistq1);
$slist1 = array();
$slist_units1 = 0;
$k1 = 0;
while ($slist_row1 = oci_fetch_assoc($slistq1)) { 
    $slist1 = $slist_row1;
    //print_r($slist_row1);
}
//print_r($slist1);
$major_cd = trim($slist1["MAJ_CD"]," ");
$major_title = trim($slist1["MAJ_TITLE"]," ");
$major_desc = trim($slist1["MAJ_DESC"]," ");
$major = $major_cd.", ".$major_title.", ".$major_desc;

$phone = $phone_prefix.$phone_postfix;

if(($access_level < 19)) {
?>


<form id="sign-up-form" name="form" action="test_post.php" method="post" enctype="multipart/form-data">
<h2>Proof of the Intent to Graduate (LETTER)</h2>
<h4>
<p style="width:880px; text-align:left;">If you have not yet completed all work for the degree, but anticipate graduating at the end of the current term, you may request a "Letter of Intent" (you may request a 
maximum of two letters). This letter verifies that you will graduate upon satisfactory completion of remaining requirements. We will need a Major Approval memo from your department in 
order to process this request.</p>
</h4>
<br>
<h2>
<a href="http://ls-advise.berkeley.edu/fp/24Intent_To_Grad.pdf">Proof of the Intent to Graduate PDF Version</a>
</h2>
<br>


<table>
<tr>


<tr>
<td>
<h3>
Verify Student ID:&nbsp;&nbsp;&nbsp;
</h3>
</td>
<td>
<input type="text" style="width:590px; height:40px;" name="student_id" value="<?php echo $student_id; ?>" style="width:500px;" />
</td>
</tr>


<tr>
<td>
<h3>
Student Name:&nbsp;&nbsp;&nbsp;
</h3>
</td>
<td>
<input type="text" style="width:590px; height:40px;" name="student_name" value="<?php echo $student_name; ?>" style="width:500px;" />
</td>


<tr>
<td>
<h3>
Verify Email Address:&nbsp;&nbsp;&nbsp;
</h3>
</td>
<td>
<input type="text" style="width:590px; height:40px;" name="email_verify" value="<?php echo $email_address; ?>" style="width:500px;" />
</td>
<tr>


<tr>
<td>
<h3>
Major(s):&nbsp;&nbsp;&nbsp;
</h3>
</td>
<td>
<input type="text" style="width:590px; height:40px;" name="major" value="<?php echo $major; ?>" style="width:500px;" />
</td>
</tr>


<tr>
<td>
<h3>
Mailing Address:&nbsp;&nbsp;&nbsp;
</h3>
</td>
<td>
<input type="text" style="width:590px; height:40px;" name="mailing_address" value="<?php echo $street; ?>" style="width:500px;" />
</td>
</tr>


<tr>
<td>
<h3>
City:&nbsp;&nbsp;&nbsp;
</h3>
</td>
<td>
<input type="text" style="width:590px; height:40px;" name="city" value="<?php echo $city; ?>" style="width:500px;" />
</td>
</tr>


<tr>
<td>
<h3>
State:&nbsp;&nbsp;&nbsp;
</h3>
</td>
<td>
<input type="text" style="width:590px; height:40px;" name="state" value="<?php echo $state; ?>" style="width:500px;" />
</td>
</tr>


<tr>
<td>
<h3>
Zip Code:&nbsp;&nbsp;&nbsp;
</h3>
</td>
<td>
<input type="text" style="width:590px; height:40px;" name="zip" value="<?php echo $zip; ?>" style="width:500px;" />
</td>
</tr>


<tr>
<td>
<h3>
Phone Number:&nbsp;&nbsp;&nbsp;
</h3>
</td>
<td>
<input type="text" style="width:590px; height:40px;" name="phone" value="<?php echo $phone; ?>" style="width:500px;" />
</td>
</tr>
</table>
<br>
<br>
<tr></tr>


<table style="width:778px;">
<tr>
<td>
<h4>
<span class="smallerest"  style="width:760px;">Do you want to pick up the Letter of Intent at 206 Evans Hall?
</h4>
</span>
<td><input type="checkbox" name="pickup" style="height:40px; width:40px;" /></td>
</td>
</tr>
</table>
<br>


<p style="width:760px; text-align:left;">
<h4>
If yes, the letter will be available at the reception desk in 10 working days.
</h4>
<h4>
If no, and you want it sent to an address other than the one above, please indicate where you would like the Letter of Intent sent.
</h4>
</p>
<br>


<table>
<div>
<div>
<tr>
<td style="width:165px;">
<h3>
    Mailing&nbsp;Address:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</h3>
</td>
<td>
    <input type="text" style="width:590px; height:40px;" name="mailing_address_second" value="<?php echo $street; ?>" style="width:500px;" />
</td>
</tr>


<tr>
<td style="width:165px;">
<h3>
    City:
</h3>
</td>
<td>
    <input type="text" style="width:590px; height:40px;" name="city_second" value="<?php echo $city; ?>" style="width:500px;" />
</td>
</tr>


<tr>
<td style="width:165px;">
<h3>
    State:&nbsp;&nbsp;&nbsp;
<h3>
</td>
<td>
    <input type="text" style="width:590px; height:40px;" name="state_second" value="<?php echo $state; ?>" style="width:500px;" />
</td>
</tr>


<tr>
<td style="width:165px;">
<h3>
    Zip Code:&nbsp;&nbsp;&nbsp;</span>
<h3>
</td>
<td>
    <input type="text" style="width:590px; height:40px;" name="zip_second" value="<?php echo $zip; ?>" style="width:500px;" />
</td>
</tr>
<input name="pdf_key" value="proof_of_the_intent_to_graduate_v1" type="hidden">
<input name="time" value="<?php $mysqltime = date("Y-m-d H:i:s"); echo $mysqltime; ?>" type="hidden">
</div>
</div>
</table>


<br>
    <table style="width:745px;">
    <tbody><tr>
    	
        <td style="width:745px;">
        <h4>
        I am on the currently degree list:
        </h4>
        </td>
        <td><input name="degree_list_checkbox" type="checkbox"  style="height:40px; width:40px;"></td>
    	</h4>
    </tr>
    <tr>
    	<h4>
        <td style="width:745px;">
        <h4>
        I have listed my current study list above:
        </h4>
        </td>
        <td><input name="study_list_checkbox" type="checkbox"  style="height:40px; width:40px;"></td>
    	</h4>
    </tr>
    <tr>
    	<h4>
        <td style="width:745px;">
        <h4>
        I have attached to this form a Major Approval memo from my major department:
        </h4>
        </td>
        <td><input name="memo_checkbox" type="checkbox"  style="height:40px; width:40px;"></td>
    	</h4>
    </tr>
</tbody>
</table>
<br>
<br>

<h3>
Please check the table below for your current class history, 
</h3>
<h3>
and select which classes are pass no pass, or repeat classes.
</h3>

<?php

$query = "SELECT STU_ID, COURSE_CNTL_NUM, UNIT, COURSE_TITLE, ADV.CLASS_VW.DEPT_CD, ADV.CLASS_VW.COURSE_PREFIX_NUM, ADV.CLASS_VW.COURSE_NUM, ADV.CLASS_VW.COURSE_SUF_2_NUM, ADV.CLASS_VW.LOAD_DATE, ADV.ENROLL_COL_VW.TERM_YR, ADV.ENROLL_COL_VW.TERM_CD
FROM ADV.ENROLL_COL_VW
LEFT JOIN ADV.CLASS_VW USING (COURSE_CNTL_NUM)
WHERE (STU_ID = '10046939' AND concat(ADV.ENROLL_COL_VW.TERM_YR, ADV.ENROLL_COL_VW.TERM_CD) = '2013D')";
//echo $query;
$slistq1 = oci_parse($oci_conn, $query);
oci_execute($slistq1);
$slist1 = array();
$slist_units1 = 0;
$k1 = 0;

echo "<br style='max-width:40px; margin-bottom:15px;'>";
echo "Institution:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Dept_Course:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Units:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Repeat?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Pass No Pass?
";
echo "<br>
";
$title_array = array();
while ($slist_row1 = oci_fetch_assoc($slistq1)) { 
    $k1 = $k1 + 1;
    $slist1 = $slist_row1;
    //print_r($slist1);

$dept_cd = $slist1[DEPT_CD];
$course_title = $slist1[COURSE_TITLE];
$unit = $slist1[UNIT];

$title_array["dept_cd_text_".$k1] = $dept_cd;
$title_array["course_title_text_".$k1] = $course_title;
$title_array["unit_text_".$k1] = $unit;

echo "<br>";
//echo "<span class='small' style='max-width:40px; margin-bottom:15px;'>Institution:</span>";
echo "<input type='text' name='dept_cd_text_".$k1."' value='".$slist1[DEPT_CD]."'style='width:100px; height:40px; margin: 0 0 0 0; margin-right:30px;' />";
echo "<input type='text' name='course_title_text_".$k1."' value='".$slist1[COURSE_TITLE]."' style='width:220px; height:40px; margin: 0 0 0 0; margin-right:30px;' />";
echo "<input type='text' name='unit_text_".$k1."' value='".floatval($slist1[UNIT])."' style='width:40px; height:40px; margin: 0 0 0 0; margin-right:30px;' />";
echo "<input type='checkbox' name='repeat_yes_".$k1."' style='width:40px; margin: 0 0 0 0; height:40px; margin-left:40px;'  />";
echo "<input type='checkbox' name='pass_no_pass_yes_".$k1."' style='width:40px; margin: 0 0 0 0; height:40px; margin-left:100px;' />";
echo "<br>";


}

?>
<br>
<tr>
<td>
<input type='text' name='dept_cd_text_28' style='width:100px; height:40px;  margin: 0 0 0 0; margin-right:30px;' /></td><td><input type='text' name='course_title_text_28' style='width:220px; height:40px;  margin: 0 0 0 0; margin-right:30px;' /></td><td><input type='text' name='unit_text_28' style='width:40px; height:40px;  margin: 0 0 0 0; margin-right:30px;' /></td><td><input type='checkbox' name='repeat_yes_28' style='width:40px; height:40px; margin: 0 0 0 0; margin-left:40px;' /></td><td><input type='checkbox' name='pass_no_pass_yes_28' style='width:40px; height:40px;  margin: 0 0 0 0; margin-left:100px;' /><br><br></td>
</tr>
<tr>
<td>
<input type='text' name='dept_cd_text_29' style='width:100px; height:40px;  margin: 0 0 0 0; margin-right:30px;' /></td><td><input type='text' name='course_title_text_29' style='width:220px; height:40px;  margin: 0 0 0 0; margin-right:30px;' /></td><td><input type='text' name='unit_text_29' style='width:40px; height:40px;  margin: 0 0 0 0; margin-right:30px;' /></td><td><input type='checkbox' name='repeat_yes_29' style='width:40px; height:40px;  margin: 0 0 0 0; margin-left:40px;' /></td><td><input type='checkbox' name='pass_no_pass_yes_29' style='width:40px; height:40px;  margin: 0 0 0 0; margin-left:100px;' /><br><br></td>
</tr>
<tr>
<td>
<input type='text' name='dept_cd_text_30' style='width:100px; height:40px;  margin: 0 0 0 0; margin-right:30px;' /></td><td><input type='text' name='course_title_text_30' style='width:220px; height:40px;  margin: 0 0 0 0; margin-right:30px;' /></td><td><input type='text' name='unit_text_30' style='width:40px; height:40px;  margin: 0 0 0 0; margin-right:30px;' /></td><td><input type='checkbox' name='repeat_yes_20' style='width:40px; height:40px;  margin: 0 0 0 0; margin-left:40px;' /></td><td><input type='checkbox' name='pass_no_pass_yes_30' style='width:40px; height:40px;  margin: 0 0 0 0; margin-left:100px;' /></td>
</td>
</tr>

<br>
<br>
<h2>
Notes to Advisors:
</h2>
<br>
<textarea  name="notes"style="width:730px; height:200px"></textarea>
<br>

<br>
<button type="submit">Submit Form</button>
<div class="spacer"></div>
<br>
<br>
</form> 
</table> 

<?php

echo "<br>";
//print_r($title_array);
//print_r($slist_row1);
//print_r($slist1);
$access_level = $_SESSION[access_lvl];
}
else
{

echo "working on it";

    }
}

?>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="footer-inner">
            2013 &copy; Etriever FormCalc
        </div>
        <div class="footer-tools">
        </div>
    </div>
</body>
</html>

<?php




    
?>
