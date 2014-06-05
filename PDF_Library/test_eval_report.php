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
                            Etriever - Proof of the Intent to Graduate - Electronic Form Results View
                            </div>
                            <div class="portlet-body form">
                                <div class="tabbable portlet-tabs">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="portlet_tab1">
<br>
<br>
<?php

$student_id = "";
$student_name = "";
$email_verify = "";
$major = "";
$mailing_address = "";
$city = "";
$state = "";
$zip = "";
$phone = "";
$pdf_key = "";
$time = "";
$mailing_address_second = "";
$city_second = "";
$state_second = "";
$zip_second = "";
$on_degree_list_checkbox = "";
$current_study_list_checkbox = "";
$approval_memo_checkbox = "";
$dept_cd_text_1 = "";
$course_title_text_1 = "";
$unit_text_1 = "";
$repeat_yes_1 = "";
$repeat_no_1 = "";
$pass_no_pass_no_1 = "";
$pass_no_pass_yes_1 = "";
$dept_cd_text_2 = "";
$course_title_text_2 = "";
$unit_text_2 = "";
$repeat_yes_2 = "";
$repeat_no_2 = "";
$pass_no_pass_no_2 = "";
$pass_no_pass_yes_2 = "";
$dept_cd_text_3 = "";
$course_title_text_3 = "";
$unit_text_3 = "";
$repeat_yes_3 = "";
$repeat_no_3 = "";
$pass_no_pass_no_3 = "";
$pass_no_pass_yes_3 = "";
$dept_cd_text_4 = "";
$course_title_text_4 = "";
$unit_text_4 = "";
$repeat_yes_4 = "";
$repeat_no_4 = "";
$pass_no_pass_no_4 = "";
$pass_no_pass_yes_4 = "";
$dept_cd_text_5 = "";
$course_title_text_5 = "";
$unit_text_5 = "";
$repeat_yes_5 = "";
$repeat_no_5 = "";
$pass_no_pass_no_5 = "";
$pass_no_pass_yes_5 = "";
$dept_cd_text_6 = "";
$course_title_text_6 = "";
$unit_text_6 = "";
$repeat_yes_6 = "";
$repeat_no_6 = "";
$pass_no_pass_no_6 = "";
$pass_no_pass_yes_6 = "";
$dept_cd_text_7 = "";
$course_title_text_7 = "";
$unit_text_7 = "";
$repeat_yes_7 = "";
$repeat_no_7 = "";
$pass_no_pass_no_7 = "";
$pass_no_pass_yes_7 = "";
$dept_cd_text_8 = "";
$course_title_text_8 = "";
$unit_text_8 = "";
$repeat_yes_8 = "";
$repeat_no_8 = "";
$pass_no_pass_no_8 = "";
$pass_no_pass_yes_8 = "";
$dept_cd_text_9 = "";
$course_title_text_9 = "";
$unit_text_9 = "";
$repeat_yes_9 = "";
$repeat_no_9 = "";
$pass_no_pass_no_9 = "";
$pass_no_pass_yes_9 = "";
$dept_cd_text_10 = "";
$course_title_text_10 = "";
$unit_text_10 = "";
$repeat_yes_10 = "";
$repeat_no_10 = "";
$pass_no_pass_no_10 = "";
$pass_no_pass_yes_10 = "";
$dept_cd_text_11 = "";
$course_title_text_11 = "";
$unit_text_11 = "";
$repeat_yes_11 = "";
$repeat_no_11 = "";
$pass_no_pass_no_11 = "";
$pass_no_pass_yes_11 = "";
$dept_cd_text_12 = "";
$course_title_text_12 = "";
$unit_text_12 = "";
$repeat_yes_12 = "";
$repeat_no_12 = "";
$pass_no_pass_no_12 = "";
$pass_no_pass_yes_12 = "";
$dept_cd_text_13 = "";
$course_title_text_13 = "";
$unit_text_13 = "";
$repeat_yes_13 = "";
$repeat_no_13 = "";
$pass_no_pass_no_13 = "";
$pass_no_pass_yes_13 = "";
$dept_cd_text_14 = "";
$course_title_text_14 = "";
$unit_text_14 = "";
$repeat_yes_14 = "";
$repeat_no_14 = "";
$pass_no_pass_no_14 = "";
$pass_no_pass_yes_14 = "";
$dept_cd_text_15 = "";
$course_title_text_15 = "";
$unit_text_15 = "";
$repeat_yes_15 = "";
$repeat_no_15 = "";
$pass_no_pass_no_15 = "";
$pass_no_pass_yes_15 = "";
$dept_cd_text_16 = "";
$course_title_text_16 = "";
$unit_text_16 = "";
$repeat_yes_16 = "";
$repeat_no_16 = "";
$pass_no_pass_no_16 = "";
$pass_no_pass_yes_16 = "";
$dept_cd_text_17 = "";
$course_title_text_17 = "";
$unit_text_17 = "";
$repeat_yes_17 = "";
$repeat_no_17 = "";
$pass_no_pass_no_17 = "";
$pass_no_pass_yes_17 = "";
$dept_cd_text_18 = "";
$course_title_text_18 = "";
$unit_text_18 = "";
$repeat_yes_18 = "";
$repeat_no_18 = "";
$pass_no_pass_no_18 = "";
$pass_no_pass_yes_18 = "";
$dept_cd_text_19 = "";
$course_title_text_19 = "";
$unit_text_19 = "";
$repeat_yes_19 = "";
$repeat_no_19 = "";
$pass_no_pass_no_19 = "";
$pass_no_pass_yes_19 = "";
$dept_cd_text_20 = "";
$course_title_text_20 = "";
$unit_text_20 = "";
$repeat_yes_20 = "";
$repeat_no_20 = "";
$pass_no_pass_no_20 = "";
$pass_no_pass_yes_20 = "";
$dept_cd_text_21 = "";
$course_title_text_21 = "";
$unit_text_21 = "";
$repeat_yes_21 = "";
$repeat_no_21 = "";
$pass_no_pass_no_21 = "";
$pass_no_pass_yes_21 = "";
$dept_cd_text_22 = "";
$course_title_text_22 = "";
$unit_text_22 = "";
$repeat_yes_22 = "";
$repeat_no_22 = "";
$pass_no_pass_no_22 = "";
$pass_no_pass_yes_22 = "";
$dept_cd_text_23 = "";
$course_title_text_23 = "";
$unit_text_23 = "";
$repeat_yes_23 = "";
$repeat_no_23 = "";
$pass_no_pass_no_23 = "";
$pass_no_pass_yes_23 = "";
$dept_cd_text_24 = "";
$course_title_text_24 = "";
$unit_text_24 = "";
$repeat_yes_24 = "";
$repeat_no_24 = "";
$pass_no_pass_no_24 = "";
$pass_no_pass_yes_24 = "";
$dept_cd_text_25 = "";
$course_title_text_25 = "";
$unit_text_25 = "";
$repeat_yes_25 = "";
$repeat_no_25 = "";
$pass_no_pass_no_25 = "";
$pass_no_pass_yes_25 = "";
$dept_cd_text_26 = "";
$course_title_text_26 = "";
$unit_text_26 = "";
$repeat_yes_26 = "";
$repeat_no_26 = "";
$pass_no_pass_no_26 = "";
$pass_no_pass_yes_26 = "";
$dept_cd_text_27 = "";
$course_title_text_27 = "";
$unit_text_27 = "";
$repeat_yes_27 = "";
$repeat_no_27 = "";
$pass_no_pass_no_27 = "";
$pass_no_pass_yes_27 = "";
$dept_cd_text_28 = "";
$course_title_text_28 = "";
$unit_text_28 = "";
$repeat_yes_28 = "";
$repeat_no_28 = "";
$pass_no_pass_no_28 = "";
$pass_no_pass_yes_28 = "";
$dept_cd_text_29 = "";
$course_title_text_29 = "";
$unit_text_29 = "";
$repeat_yes_29 = "";
$repeat_no_29 = "";
$pass_no_pass_no_29 = "";
$pass_no_pass_yes_29 = "";
$dept_cd_text_30 = "";
$course_title_text_30 = "";
$unit_text_30 = "";
$repeat_yes_30 = "";
$repeat_no_30 = "";
$pass_no_pass_no_30 = "";
$pass_no_pass_yes_30 = "";
$degree_list_checkbox = "";
$study_list_checkbox = "";
$memo_checkbox = "";
$pickup = "";
$notes = "";
$eval_checkbox = "";

if(isset($_GET['student_id'])){

include('/var/www/etriever/html/models/user_auth_fns.php');
require_once('/var/www/etriever/conf/db_base.php');
require_once('/var/www/etriever/conf/bfdb.php');
require_once('/var/www/etriever/conf/aodb.php');
require_once('/var/www/etriever/conf/db.php');
require_once('/var/www/etriever/html/models/helper_fns.php');

session_start();
//print_r($_SESSION);

$conn = create_base_mysqli();

echo "lordy";

$student_id = strip_tags(stripslashes($_GET['student_id']));

$query = "SELECT DISTINCT `student_id`, `student_name`, `email_verify`, `major`, `mailing_address`, `city`, `state`, `zip`, `phone`, `pdf_key`, `time`, `mailing_address_second`, `city_second`, `state_second`, `zip_second`, `on_degree_list_checkbox`, `current_study_list_checkbox`, `approval_memo_checkbox`, `dept_cd_text_1`, `course_title_text_1`, `unit_text_1`, `repeat_yes_1`, `repeat_no_1`, `pass_no_pass_no_1`, `pass_no_pass_yes_1`, `dept_cd_text_2`, `course_title_text_2`, `unit_text_2`, `repeat_yes_2`, `repeat_no_2`, `pass_no_pass_no_2`, `pass_no_pass_yes_2`, `dept_cd_text_3`, `course_title_text_3`, `unit_text_3`, `repeat_yes_3`, `repeat_no_3`, `pass_no_pass_no_3`, `pass_no_pass_yes_3`, `dept_cd_text_4`, `course_title_text_4`, `unit_text_4`, `repeat_yes_4`, `repeat_no_4`, `pass_no_pass_no_4`, `pass_no_pass_yes_4`, `dept_cd_text_5`, `course_title_text_5`, `unit_text_5`, `repeat_yes_5`, `repeat_no_5`, `pass_no_pass_no_5`, `pass_no_pass_yes_5`, `dept_cd_text_6`, `course_title_text_6`, `unit_text_6`, `repeat_yes_6`, `repeat_no_6`, `pass_no_pass_no_6`, `pass_no_pass_yes_6`, `dept_cd_text_7`, `course_title_text_7`, `unit_text_7`, `repeat_yes_7`, `repeat_no_7`, `pass_no_pass_no_7`, `pass_no_pass_yes_7`, `dept_cd_text_8`, `course_title_text_8`, `unit_text_8`, `repeat_yes_8`, `repeat_no_8`, `pass_no_pass_no_8`, `pass_no_pass_yes_8`, `dept_cd_text_9`, `course_title_text_9`, `unit_text_9`, `repeat_yes_9`, `repeat_no_9`, `pass_no_pass_no_9`, `pass_no_pass_yes_9`, `dept_cd_text_10`, `course_title_text_10`, `unit_text_10`, `repeat_yes_10`, `repeat_no_10`, `pass_no_pass_no_10`, `pass_no_pass_yes_10`, `dept_cd_text_11`, `course_title_text_11`, `unit_text_11`, `repeat_yes_11`, `repeat_no_11`, `pass_no_pass_no_11`, `pass_no_pass_yes_11`, `dept_cd_text_12`, `course_title_text_12`, `unit_text_12`, `repeat_yes_12`, `repeat_no_12`, `pass_no_pass_no_12`, `pass_no_pass_yes_12`, `dept_cd_text_13`, `course_title_text_13`, `unit_text_13`, `repeat_yes_13`, `repeat_no_13`, `pass_no_pass_no_13`, `pass_no_pass_yes_13`, `dept_cd_text_14`, `course_title_text_14`, `unit_text_14`, `repeat_yes_14`, `repeat_no_14`, `pass_no_pass_no_14`, `pass_no_pass_yes_14`, `dept_cd_text_15`, `course_title_text_15`, `unit_text_15`, `repeat_yes_15`, `repeat_no_15`, `pass_no_pass_no_15`, `pass_no_pass_yes_15`, `dept_cd_text_16`, `course_title_text_16`, `unit_text_16`, `repeat_yes_16`, `repeat_no_16`, `pass_no_pass_no_16`, `pass_no_pass_yes_16`, `dept_cd_text_17`, `course_title_text_17`, `unit_text_17`, `repeat_yes_17`, `repeat_no_17`, `pass_no_pass_no_17`, `pass_no_pass_yes_17`, `dept_cd_text_18`, `course_title_text_18`, `unit_text_18`, `repeat_yes_18`, `repeat_no_18`, `pass_no_pass_no_18`, `pass_no_pass_yes_18`, `dept_cd_text_19`, `course_title_text_19`, `unit_text_19`, `repeat_yes_19`, `repeat_no_19`, `pass_no_pass_no_19`, `pass_no_pass_yes_19`, `dept_cd_text_20`, `course_title_text_20`, `unit_text_20`, `repeat_yes_20`, `repeat_no_20`, `pass_no_pass_no_20`, `pass_no_pass_yes_20`, `dept_cd_text_21`, `course_title_text_21`, `unit_text_21`, `repeat_yes_21`, `repeat_no_21`, `pass_no_pass_no_21`, `pass_no_pass_yes_21`, `dept_cd_text_22`, `course_title_text_22`, `unit_text_22`, `repeat_yes_22`, `repeat_no_22`, `pass_no_pass_no_22`, `pass_no_pass_yes_22`, `dept_cd_text_23`, `course_title_text_23`, `unit_text_23`, `repeat_yes_23`, `repeat_no_23`, `pass_no_pass_no_23`, `pass_no_pass_yes_23`, `dept_cd_text_24`, `course_title_text_24`, `unit_text_24`, `repeat_yes_24`, `repeat_no_24`, `pass_no_pass_no_24`, `pass_no_pass_yes_24`, `dept_cd_text_25`, `course_title_text_25`, `unit_text_25`, `repeat_yes_25`, `repeat_no_25`, `pass_no_pass_no_25`, `pass_no_pass_yes_25`, `dept_cd_text_26`, `course_title_text_26`, `unit_text_26`, `repeat_yes_26`, `repeat_no_26`, `pass_no_pass_no_26`, `pass_no_pass_yes_26`, `dept_cd_text_27`, `course_title_text_27`, `unit_text_27`, `repeat_yes_27`, `repeat_no_27`, `pass_no_pass_no_27`, `pass_no_pass_yes_27`, `dept_cd_text_28`, `course_title_text_28`, `unit_text_28`, `repeat_yes_28`, `repeat_no_28`, `pass_no_pass_no_28`, `pass_no_pass_yes_28`, `dept_cd_text_29`, `course_title_text_29`, `unit_text_29`, `repeat_yes_29`, `repeat_no_29`, `pass_no_pass_no_29`, `pass_no_pass_yes_29`, `dept_cd_text_30`, `course_title_text_30`, `unit_text_30`, `repeat_yes_30`, `repeat_no_30`, `pass_no_pass_no_30`, `pass_no_pass_yes_30`, `degree_list_checkbox`, `study_list_checkbox`, `memo_checkbox`, `pickup`, `notes`, `eval_checkbox` FROM `test`.`test` WHERE `test`.`student_id` = '".$student_id."' AND `test`.`eval_checkbox` = '';";

echo $query;

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $student_id, $student_name, $email_verify, $major, $mailing_address, $city, $state, $zip, $phone, $pdf_key, $time, $mailing_address_second, $city_second, $state_second, $zip_second, $on_degree_list_checkbox, $current_study_list_checkbox, $approval_memo_checkbox, $dept_cd_text_1, $course_title_text_1, $unit_text_1, $repeat_yes_1, $repeat_no_1, $pass_no_pass_no_1, $pass_no_pass_yes_1, $dept_cd_text_2, $course_title_text_2, $unit_text_2, $repeat_yes_2, $repeat_no_2, $pass_no_pass_no_2, $pass_no_pass_yes_2, $dept_cd_text_3, $course_title_text_3, $unit_text_3, $repeat_yes_3, $repeat_no_3, $pass_no_pass_no_3, $pass_no_pass_yes_3, $dept_cd_text_4, $course_title_text_4, $unit_text_4, $repeat_yes_4, $repeat_no_4, $pass_no_pass_no_4, $pass_no_pass_yes_4, $dept_cd_text_5, $course_title_text_5, $unit_text_5, $repeat_yes_5, $repeat_no_5, $pass_no_pass_no_5, $pass_no_pass_yes_5, $dept_cd_text_6, $course_title_text_6, $unit_text_6, $repeat_yes_6, $repeat_no_6, $pass_no_pass_no_6, $pass_no_pass_yes_6, $dept_cd_text_7, $course_title_text_7, $unit_text_7, $repeat_yes_7, $repeat_no_7, $pass_no_pass_no_7, $pass_no_pass_yes_7, $dept_cd_text_8, $course_title_text_8, $unit_text_8, $repeat_yes_8, $repeat_no_8, $pass_no_pass_no_8, $pass_no_pass_yes_8, $dept_cd_text_9, $course_title_text_9, $unit_text_9, $repeat_yes_9, $repeat_no_9, $pass_no_pass_no_9, $pass_no_pass_yes_9, $dept_cd_text_10, $course_title_text_10, $unit_text_10, $repeat_yes_10, $repeat_no_10, $pass_no_pass_no_10, $pass_no_pass_yes_10, $dept_cd_text_11, $course_title_text_11, $unit_text_11, $repeat_yes_11, $repeat_no_11, $pass_no_pass_no_11, $pass_no_pass_yes_11, $dept_cd_text_12, $course_title_text_12, $unit_text_12, $repeat_yes_12, $repeat_no_12, $pass_no_pass_no_12, $pass_no_pass_yes_12, $dept_cd_text_13, $course_title_text_13, $unit_text_13, $repeat_yes_13, $repeat_no_13, $pass_no_pass_no_13, $pass_no_pass_yes_13, $dept_cd_text_14, $course_title_text_14, $unit_text_14, $repeat_yes_14, $repeat_no_14, $pass_no_pass_no_14, $pass_no_pass_yes_14, $dept_cd_text_15, $course_title_text_15, $unit_text_15, $repeat_yes_15, $repeat_no_15, $pass_no_pass_no_15, $pass_no_pass_yes_15, $dept_cd_text_16, $course_title_text_16, $unit_text_16, $repeat_yes_16, $repeat_no_16, $pass_no_pass_no_16, $pass_no_pass_yes_16, $dept_cd_text_17, $course_title_text_17, $unit_text_17, $repeat_yes_17, $repeat_no_17, $pass_no_pass_no_17, $pass_no_pass_yes_17, $dept_cd_text_18, $course_title_text_18, $unit_text_18, $repeat_yes_18, $repeat_no_18, $pass_no_pass_no_18, $pass_no_pass_yes_18, $dept_cd_text_19, $course_title_text_19, $unit_text_19, $repeat_yes_19, $repeat_no_19, $pass_no_pass_no_19, $pass_no_pass_yes_19, $dept_cd_text_20, $course_title_text_20, $unit_text_20, $repeat_yes_20, $repeat_no_20, $pass_no_pass_no_20, $pass_no_pass_yes_20, $dept_cd_text_21, $course_title_text_21, $unit_text_21, $repeat_yes_21, $repeat_no_21, $pass_no_pass_no_21, $pass_no_pass_yes_21, $dept_cd_text_22, $course_title_text_22, $unit_text_22, $repeat_yes_22, $repeat_no_22, $pass_no_pass_no_22, $pass_no_pass_yes_22, $dept_cd_text_23, $course_title_text_23, $unit_text_23, $repeat_yes_23, $repeat_no_23, $pass_no_pass_no_23, $pass_no_pass_yes_23, $dept_cd_text_24, $course_title_text_24, $unit_text_24, $repeat_yes_24, $repeat_no_24, $pass_no_pass_no_24, $pass_no_pass_yes_24, $dept_cd_text_25, $course_title_text_25, $unit_text_25, $repeat_yes_25, $repeat_no_25, $pass_no_pass_no_25, $pass_no_pass_yes_25, $dept_cd_text_26, $course_title_text_26, $unit_text_26, $repeat_yes_26, $repeat_no_26, $pass_no_pass_no_26, $pass_no_pass_yes_26, $dept_cd_text_27, $course_title_text_27, $unit_text_27, $repeat_yes_27, $repeat_no_27, $pass_no_pass_no_27, $pass_no_pass_yes_27, $dept_cd_text_28, $course_title_text_28, $unit_text_28, $repeat_yes_28, $repeat_no_28, $pass_no_pass_no_28, $pass_no_pass_yes_28, $dept_cd_text_29, $course_title_text_29, $unit_text_29, $repeat_yes_29, $repeat_no_29, $pass_no_pass_no_29, $pass_no_pass_yes_29, $dept_cd_text_30, $course_title_text_30, $unit_text_30, $repeat_yes_30, $repeat_no_30, $pass_no_pass_no_30, $pass_no_pass_yes_30, $degree_list_checkbox, $study_list_checkbox, $memo_checkbox, $pickup, $notes, $eval_checkbox);
    while (mysqli_stmt_fetch($stmt)) {

echo $student_id;
echo $student_name;
echo $email_verify;
echo $major;
echo $mailing_address;
echo $city;
echo $state;
echo $zip;
echo $phone;
echo $pdf_key;
echo $time;
echo $mailing_address_second;
echo $city_second;
echo $state_second;
echo $zip_second;
echo $on_degree_list_checkbox;
echo $current_study_list_checkbox;
echo $approval_memo_checkbox;
echo $dept_cd_text_1;
echo $course_title_text_1;
echo $unit_text_1;
echo $repeat_yes_1;
echo $repeat_no_1;
echo $pass_no_pass_no_1;
echo $pass_no_pass_yes_1;
echo $dept_cd_text_2;
echo $course_title_text_2;
echo $unit_text_2;
echo $repeat_yes_2;
echo $repeat_no_2;
echo $pass_no_pass_no_2;
echo $pass_no_pass_yes_2;
echo $dept_cd_text_3;
echo $course_title_text_3;
echo $unit_text_3;
echo $repeat_yes_3;
echo $repeat_no_3;
echo $pass_no_pass_no_3;
echo $pass_no_pass_yes_3;
echo $dept_cd_text_4;
echo $course_title_text_4;
echo $unit_text_4;
echo $repeat_yes_4;
echo $repeat_no_4;
echo $pass_no_pass_no_4;
echo $pass_no_pass_yes_4;
echo $dept_cd_text_5;
echo $course_title_text_5;
echo $unit_text_5;
echo $repeat_yes_5;
echo $repeat_no_5;
echo $pass_no_pass_no_5;
echo $pass_no_pass_yes_5;
echo $dept_cd_text_6;
echo $course_title_text_6;
echo $unit_text_6;
echo $repeat_yes_6;
echo $repeat_no_6;
echo $pass_no_pass_no_6;
echo $pass_no_pass_yes_6;
echo $dept_cd_text_7;
echo $course_title_text_7;
echo $unit_text_7;
echo $repeat_yes_7;
echo $repeat_no_7;
echo $pass_no_pass_no_7;
echo $pass_no_pass_yes_7;
echo $dept_cd_text_8;
echo $course_title_text_8;
echo $unit_text_8;
echo $repeat_yes_8;
echo $repeat_no_8;
echo $pass_no_pass_no_8;
echo $pass_no_pass_yes_8;
echo $dept_cd_text_9;
echo $course_title_text_9;
echo $unit_text_9;
echo $repeat_yes_9;
echo $repeat_no_9;
echo $pass_no_pass_no_9;
echo $pass_no_pass_yes_9;
echo $dept_cd_text_10;
echo $course_title_text_10;
echo $unit_text_10;
echo $repeat_yes_10;
echo $repeat_no_10;
echo $pass_no_pass_no_10;
echo $pass_no_pass_yes_10;
echo $dept_cd_text_11;
echo $course_title_text_11;
echo $unit_text_11;
echo $repeat_yes_11;
echo $repeat_no_11;
echo $pass_no_pass_no_11;
echo $pass_no_pass_yes_11;
echo $dept_cd_text_12;
echo $course_title_text_12;
echo $unit_text_12;
echo $repeat_yes_12;
echo $repeat_no_12;
echo $pass_no_pass_no_12;
echo $pass_no_pass_yes_12;
echo $dept_cd_text_13;
echo $course_title_text_13;
echo $unit_text_13;
echo $repeat_yes_13;
echo $repeat_no_13;
echo $pass_no_pass_no_13;
echo $pass_no_pass_yes_13;
echo $dept_cd_text_14;
echo $course_title_text_14;
echo $unit_text_14;
echo $repeat_yes_14;
echo $repeat_no_14;
echo $pass_no_pass_no_14;
echo $pass_no_pass_yes_14;
echo $dept_cd_text_15;
echo $course_title_text_15;
echo $unit_text_15;
echo $repeat_yes_15;
echo $repeat_no_15;
echo $pass_no_pass_no_15;
echo $pass_no_pass_yes_15;
echo $dept_cd_text_16;
echo $course_title_text_16;
echo $unit_text_16;
echo $repeat_yes_16;
echo $repeat_no_16;
echo $pass_no_pass_no_16;
echo $pass_no_pass_yes_16;
echo $dept_cd_text_17;
echo $course_title_text_17;
echo $unit_text_17;
echo $repeat_yes_17;
echo $repeat_no_17;
echo $pass_no_pass_no_17;
echo $pass_no_pass_yes_17;
echo $dept_cd_text_18;
echo $course_title_text_18;
echo $unit_text_18;
echo $repeat_yes_18;
echo $repeat_no_18;
echo $pass_no_pass_no_18;
echo $pass_no_pass_yes_18;
echo $dept_cd_text_19;
echo $course_title_text_19;
echo $unit_text_19;
echo $repeat_yes_19;
echo $repeat_no_19;
echo $pass_no_pass_no_19;
echo $pass_no_pass_yes_19;
echo $dept_cd_text_20;
echo $course_title_text_20;
echo $unit_text_20;
echo $repeat_yes_20;
echo $repeat_no_20;
echo $pass_no_pass_no_20;
echo $pass_no_pass_yes_20;
echo $dept_cd_text_21;
echo $course_title_text_21;
echo $unit_text_21;
echo $repeat_yes_21;
echo $repeat_no_21;
echo $pass_no_pass_no_21;
echo $pass_no_pass_yes_21;
echo $dept_cd_text_22;
echo $course_title_text_22;
echo $unit_text_22;
echo $repeat_yes_22;
echo $repeat_no_22;
echo $pass_no_pass_no_22;
echo $pass_no_pass_yes_22;
echo $dept_cd_text_23;
echo $course_title_text_23;
echo $unit_text_23;
echo $repeat_yes_23;
echo $repeat_no_23;
echo $pass_no_pass_no_23;
echo $pass_no_pass_yes_23;
echo $dept_cd_text_24;
echo $course_title_text_24;
echo $unit_text_24;
echo $repeat_yes_24;
echo $repeat_no_24;
echo $pass_no_pass_no_24;
echo $pass_no_pass_yes_24;
echo $dept_cd_text_25;
echo $course_title_text_25;
echo $unit_text_25;
echo $repeat_yes_25;
echo $repeat_no_25;
echo $pass_no_pass_no_25;
echo $pass_no_pass_yes_25;
echo $dept_cd_text_26;
echo $course_title_text_26;
echo $unit_text_26;
echo $repeat_yes_26;
echo $repeat_no_26;
echo $pass_no_pass_no_26;
echo $pass_no_pass_yes_26;
echo $dept_cd_text_27;
echo $course_title_text_27;
echo $unit_text_27;
echo $repeat_yes_27;
echo $repeat_no_27;
echo $pass_no_pass_no_27;
echo $pass_no_pass_yes_27;
echo $dept_cd_text_28;
echo $course_title_text_28;
echo $unit_text_28;
echo $repeat_yes_28;
echo $repeat_no_28;
echo $pass_no_pass_no_28;
echo $pass_no_pass_yes_28;
echo $dept_cd_text_29;
echo $course_title_text_29;
echo $unit_text_29;
echo $repeat_yes_29;
echo $repeat_no_29;
echo $pass_no_pass_no_29;
echo $pass_no_pass_yes_29;
echo $dept_cd_text_30;
echo $course_title_text_30;
echo $unit_text_30;
echo $repeat_yes_30;
echo $repeat_no_30;
echo $pass_no_pass_no_30;
echo $pass_no_pass_yes_30;
echo $degree_list_checkbox;
echo $study_list_checkbox;
echo $memo_checkbox;
echo $pickup;
echo $notes;
echo $eval_checkbox;

		}
		mysqli_stmt_close($stmt);
	}

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
                <li>
                </li>
                <li class="active ">
                    <a href="javascript:;">
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
}


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

if(($access_level < 19)) {
?>


<form id="sign-up-form" name="form" action="test_post.php" method="post" enctype="multipart/form-data">
<h1>Proof of the Intent to Graduate (LETTER)</h1>
<h4>
<p style="width:880px; text-align:left;">If you have not yet completed all work for the degree, but anticipate graduating at the end of the current term, you may request a "Letter of Intent" (you may request a 
maximum of two letters). This letter verifies that you will graduate upon satisfactory completion of remaining requirements. We will need a Major Approval memo from your department in 
order to process this request.</p>
</h4>
<br>
<h1>
<a href="http://ls-advise.berkeley.edu/fp/24Intent_To_Grad.pdf">Proof of the Intent to Graduate PDF Version</a>
</h1>
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
<input type="text" style="width:590px; height:40px;" name="email_verify" value="<?php echo $email_verify; ?>" style="width:500px;" />
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
<input name="time" value="2013-09-24 12:48:45" type="hidden">
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
Semester_Units:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
//$access_level = $_SESSION[access_lvl];
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
