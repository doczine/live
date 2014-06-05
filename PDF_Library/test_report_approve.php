<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Etriever - Proof of the Intent to Graduate Unprocessed Form Submittals</title>
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
                <li>
                </li>
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
                            Etriever - Proof of the Intent to Graduate Unprocessed Form Submittals
                            </div>
                            <div class="portlet-body form">
                                <div class="tabbable portlet-tabs">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="portlet_tab1">
<br>
<br>
<br>
<?php
include('/var/www/etriever/html/models/user_auth_fns.php');
require_once('/var/www/etriever/conf/db_base.php');
require_once('/var/www/etriever/conf/bfdb.php');
require_once('/var/www/etriever/conf/aodb.php');
require_once('/var/www/etriever/conf/db.php');
require_once('/var/www/etriever/html/models/helper_fns.php');
session_start();
//print_r($_SESSION);
$conn = create_base_mysqli();
$query = "SELECT `student_id`,`student_name`,`email_verify`,`major`,`mailing_address`,`city`,`state`,`zip`,`phone`,`mailing_address_second`,`city_second`,`state_second`,`zip_second`,`pdf_key`,`time`,`dept_cd_text_1`,`course_title_text_1`,`unit_text_1`,`dept_cd_text_2`,`course_title_text_2`,`unit_text_2`,`dept_cd_text_3`,`course_title_text_3`,`unit_text_3`,`dept_cd_text_4`,`course_title_text_4`,`unit_text_4`,`dept_cd_text_5`,`course_title_text_5`,`unit_text_5`,`dept_cd_text_6`,`course_title_text_6`,`unit_text_6`,`dept_cd_text_7`,`course_title_text_7`,`unit_text_7`,`dept_cd_text_8`,`course_title_text_8`,`unit_text_8`,`dept_cd_text_9`,`course_title_text_9`,`unit_text_9`,`dept_cd_text_10`,`course_title_text_10`,`unit_text_10`,`dept_cd_text_11`,`course_title_text_11`,`unit_text_11`,`dept_cd_text_12`,`course_title_text_12`,`unit_text_12`,`dept_cd_text_13`,`course_title_text_13`,`unit_text_13`,`notes` FROM `test`.`test` WHERE `test`.`eval_checkbox` = 'approve';";
echo "<table border ='1'>";
echo "<th>Student ID</th><th>Student Name</th><th>Student Email</th><th>Major</th><th>PDF Key</th><th>Date Time Stamp</th><th>Notes</th>";
if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $student_id, $student_name, $email_verify, $major, $mailing_address, $city, $state, $zip, $phone, $mailing_address_second, $city_second, $state_second, $zip_second, $pdf_key, $time, $dept_cd_text_1, $course_title_text_1, $unit_text_1, $dept_cd_text_2, $course_title_text_2, $unit_text_2, $dept_cd_text_3, $course_title_text_3, $unit_text_3, $dept_cd_text_4, $course_title_text_4, $unit_text_4, $dept_cd_text_5, $course_title_text_5, $unit_text_5, $dept_cd_text_6, $course_title_text_6, $unit_text_6, $dept_cd_text_7, $course_title_text_7, $unit_text_7, $dept_cd_text_8, $course_title_text_8, $unit_text_8, $dept_cd_text_9, $course_title_text_9, $unit_text_9, $dept_cd_text_10, $course_title_text_10, $unit_text_10, $dept_cd_text_11, $course_title_text_11, $unit_text_11, $dept_cd_text_12, $course_title_text_12, $unit_text_12, $dept_cd_text_13, $course_title_text_13, $unit_text_13, $notes);
    while (mysqli_stmt_fetch($stmt)) {
		echo "<tr>";
		echo "<td>";
		echo $student_id;echo "</td>"; echo "<td>";
		echo $student_name;echo "</td>"; echo "<td>";
		echo $email_verify;echo "</td>"; echo "<td>";
		echo $major;echo "</td>"; echo "<td>";
		echo $pdf_key;echo "</td>"; echo "<td>";
		echo $time;echo "</td>"; echo "<td>";
		echo $notes;
		echo "</td>";
		echo "</tr>";
    }
    mysqli_stmt_close($stmt);
}
echo "</table>";
?>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
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