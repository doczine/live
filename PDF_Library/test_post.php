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
                            Etriever - Proof of the Intent to Graduate Form Post Values Submitted
                            </div>
                            <div class="portlet-body form">
                                <div class="tabbable portlet-tabs">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="portlet_tab1">
<br><br><br>
<h2>Proof of the Intent to Graduate (LETTER) Form Post Values Submitted</h2>
<h4>
<p style="width:880px; text-align:left;">Below is the post values for the Proof of the Intent to Graduate (LETTER) Web Form.</p>
</h4>


<?php
$today = date("Y-m-d");
//echo $today;
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

$val_array_post = array();
foreach($_POST as $stuff => $val ) {
    $val_array_post[$stuff] = strip_tags(stripslashes($val));
}
//print_r($val_array_post);
//extract($val_array_post, EXTR_PREFIX_SAME);
extract($val_array_post, EXTR_SKIP);
$arr = get_defined_vars();
//print_r($arr);
$string_sql_insert = "INSERT INTO `test`.`test` (";
$string_sql_variable = "";
$string_sql_data = "";
$string_s = "";
$count_array = count($val_array_post, COUNT_RECURSIVE);
echo "<table border='1'>";
echo "<h2>";
echo "<a href=";
$pdf_key = "proof_of_the_intent_to_graduate_v1";
echo "https://etriever.berkeley.edu/test_pdf.php?student_id=";
echo $student_id;
echo "&pdf_id=";
echo $pdf_key;
echo ">Here is a link to your form post as a PDF receipt for your records</a>";
echo "<br>";
echo "</h2>";
foreach($val_array_post as $variable => $value) {
    echo "<tr>";
        echo "<td>".strip_tags(stripslashes($variable))."</td>";
        echo "<td>".strip_tags(stripslashes($value))."</td>";
    echo "</tr>";
    $string_sql_variable .= "`".$variable."`,";
    $string_sql_data .= "\"".$value."\",";
    $string_s .= "s";
}
echo "</table>";
$string_sql_variable = trim($string_sql_variable, ",");
$string_sql_data = trim($string_sql_data, ",");
$quer = $string_sql_insert.$string_sql_variable.") VALUES (".$string_sql_data.");";
//echo $quer;
$arr = get_defined_vars();
//print_r($arr);
if ($stmt = mysqli_prepare($conn, $quer)); {
    mysqli_stmt_execute($stmt); 
    mysqli_stmt_close($stmt);
}

//INSERT COMMENT INTO ETRIEVER NOTES PAGES FOR PDF POST
//TESTED ON TEST DB NOT ETRV YET!!

$staff_id = "010940625";
$student_id = $student_id;
$today = $today;
$form_entry = "Form Entry Made on ".$today.": ".$pdf_key;
$action_type_id = "45";
$location_id = "1";

$query = "INSERT INTO `test`.`advg_action` (`advg_action_date`, `advg_action_notes`, `student_id`, `staff_id`, `action_type_id`, `location_id`, `entry_date`, `entry_staff_id`) VALUES ('".$today."','".$form_entry."','".$student_id."','".$action_type_id."','".$action_type_id."','".$location_id."','".$today."','".$staff_id."');";
//echo $query;
if ($stmt = mysqli_prepare($conn, $query)); {
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
}

$pdf = new FPDI();
$pdf->AddPage();
$pdf->setSourceFile('/var/www/etriever/html/pdf/24Intent_To_Grad.pdf');
$tplIdx = $pdf->importPage(1);
$pdf->useTemplate($tplIdx, 0, 0, 0);
$specs = $pdf->getTemplateSize($tplIdx);
//print_r($specs);
$pdf->SetFont('Arial');
$pdf->SetTextColor(255,0,0);
$pdf->SetXY(150, 68);
$pdf->Write(0, $student_id);
$pdf->SetXY(15, 68);
$pdf->Write(0, $student_name);
$pdf->SetXY(15, 100);
$pdf->Write(0, $email_verify);
$pdf->SetXY(15, 84);
$pdf->Write(0, $mailing_address);
$pdf->SetXY(85, 84);
$pdf->Write(0, $city);
$pdf->SetXY(145, 84);
$pdf->Write(0, $state);
$pdf->SetXY(175, 84);
$pdf->Write(0, $zip);
$pdf->SetXY(145, 100);
$pdf->Write(0, $phone);
$pdf->SetXY(125, 117);
$pdf->Write(0, $pickup);
$pdf->SetXY(40, 140);
$pdf->Write(0, $mailing_address_second);
$pdf->SetXY(100, 140);
$pdf->Write(0, $city_second);
$pdf->SetXY(150, 140);
$pdf->Write(0, $state_second);
$pdf->SetXY(180, 140);
$pdf->Write(0, $zip_second);
$pdf->SetXY(45, 215);
$pdf->Write(0, $degree_list_checkbox);
$pdf->SetXY(45, 220.5);
$pdf->Write(0, $study_list_checkbox);
$pdf->SetXY(45, 227);
$pdf->Write(0, $memo_checkbox);

$pdf->SetXY(17, 175);
$pdf->Write(0, "Please see current study list on second page.");

$timestamp = date("Y-m-d H:i:s");
$pdf->SetXY(10, 250);
$pdf->Write(0, "eTriever Unique ID:");
$rand = rand(100000, 999999);
$pdf->SetXY(48, 250);
$pdf->Write(0, $rand);
$pdf->SetXY(110, 250);
$pdf->Write(0, "Date Timestamp: ".$timestamp);
$pdf->SetXY(10, 255);
$pdf->Write(0, "This PDF is for reference, keep it for your records, your data has already been submitted.");
$pdf->Output('/var/www/etriever/html/pdf/24Intent_To_Grad_NEW.pdf', 'F');

$pdf1 = new FPDI();
$pdf1->AddPage();
$pdf1->setSourceFile('/var/www/etriever/html/pdf/24Intent_To_Grad_2.pdf');
$tplIdx = $pdf1->importPage(1);
$pdf1->useTemplate($tplIdx, 0, 0, 0);
$pdf1->SetFont('Arial');
$pdf1->SetTextColor(255,0,0);
$pdf1->SetXY(150, 15);
$pdf1->Write(0, "StuID: ".$student_id);

$pdf1->SetXY(15, 15);
$pdf1->Write(0, "Degree of Study: ".$major);
$pdf1->SetXY(15, 20);
$pdf1->Write(0, "Dept              Course Title                       Units        Repeat  PnP");
$pdf1->SetXY(15, 25);
$pdf1->Write(0, $dept_cd_text_1);
$pdf1->SetXY(40, 25);
$pdf1->Write(0, $course_title_text_1);
$pdf1->SetXY(90, 25);
$pdf1->Write(0, $unit_text_1);
$pdf1->SetXY(110, 25);
$pdf1->Write(0, $repeat_yes_1);
$pdf1->SetXY(115, 25);
$pdf1->Write(0, $repeat_no_1);
$pdf1->SetXY(120, 25);
$pdf1->Write(0, $pass_no_pass_no_1);
$pdf1->SetXY(125, 25);
$pdf1->Write(0, $pass_no_pass_yes_1);
$pdf1->SetXY(15, 30);
$pdf1->Write(0, $dept_cd_text_2);
$pdf1->SetXY(40, 30);
$pdf1->Write(0, $course_title_text_2);
$pdf1->SetXY(90, 30);
$pdf1->Write(0, $unit_text_2);
$pdf1->SetXY(110, 30);
$pdf1->Write(0, $repeat_yes_2);
$pdf1->SetXY(115, 30);
$pdf1->Write(0, $repeat_no_2);
$pdf1->SetXY(120, 30);
$pdf1->Write(0, $pass_no_pass_no_2);
$pdf1->SetXY(125, 30);
$pdf1->Write(0, $pass_no_pass_yes_2);
$pdf1->SetXY(15, 35);
$pdf1->Write(0, $dept_cd_text_3);
$pdf1->SetXY(40, 35);
$pdf1->Write(0, $course_title_text_3);
$pdf1->SetXY(90, 35);
$pdf1->Write(0, $unit_text_3);
$pdf1->SetXY(110, 35);
$pdf1->Write(0, $repeat_yes_3);
$pdf1->SetXY(115, 35);
$pdf1->Write(0, $repeat_no_3);
$pdf1->SetXY(120, 35);
$pdf1->Write(0, $pass_no_pass_no_3);
$pdf1->SetXY(125, 35);
$pdf1->Write(0, $pass_no_pass_yes_3);
$pdf1->SetXY(15, 40);
$pdf1->Write(0, $dept_cd_text_4);
$pdf1->SetXY(40, 40);
$pdf1->Write(0, $course_title_text_4);
$pdf1->SetXY(90, 40);
$pdf1->Write(0, $unit_text_4);
$pdf1->SetXY(110, 40);
$pdf1->Write(0, $repeat_yes_4);
$pdf1->SetXY(115, 40);
$pdf1->Write(0, $repeat_no_4);
$pdf1->SetXY(120, 40);
$pdf1->Write(0, $pass_no_pass_no_4);
$pdf1->SetXY(125, 40);
$pdf1->Write(0, $pass_no_pass_yes_4);
$pdf1->SetXY(15, 45);
$pdf1->Write(0, $dept_cd_text_5);
$pdf1->SetXY(40, 45);
$pdf1->Write(0, $course_title_text_5);
$pdf1->SetXY(90, 45);
$pdf1->Write(0, $unit_text_5);
$pdf1->SetXY(110, 45);
$pdf1->Write(0, $repeat_yes_5);
$pdf1->SetXY(115, 45);
$pdf1->Write(0, $repeat_no_5);
$pdf1->SetXY(120, 45);
$pdf1->Write(0, $pass_no_pass_no_5);
$pdf1->SetXY(125, 45);
$pdf1->Write(0, $pass_no_pass_yes_5);
$pdf1->SetXY(15, 50);
$pdf1->Write(0, $dept_cd_text_6);
$pdf1->SetXY(40, 50);
$pdf1->Write(0, $course_title_text_6);
$pdf1->SetXY(90, 50);
$pdf1->Write(0, $unit_text_6);
$pdf1->SetXY(110, 50);
$pdf1->Write(0, $repeat_yes_6);
$pdf1->SetXY(115, 50);
$pdf1->Write(0, $repeat_no_6);
$pdf1->SetXY(120, 50);
$pdf1->Write(0, $pass_no_pass_no_6);
$pdf1->SetXY(125, 50);
$pdf1->Write(0, $pass_no_pass_yes_6);
$pdf1->SetXY(15, 55);
$pdf1->Write(0, $dept_cd_text_7);
$pdf1->SetXY(40, 55);
$pdf1->Write(0, $course_title_text_7);
$pdf1->SetXY(90, 55);
$pdf1->Write(0, $unit_text_7);
$pdf1->SetXY(110, 55);
$pdf1->Write(0, $repeat_yes_7);
$pdf1->SetXY(115, 55);
$pdf1->Write(0, $repeat_no_7);
$pdf1->SetXY(120, 55);
$pdf1->Write(0, $pass_no_pass_no_7);
$pdf1->SetXY(125, 55);
$pdf1->Write(0, $pass_no_pass_yes_7);
$pdf1->SetXY(15, 60);
$pdf1->Write(0, $dept_cd_text_8);
$pdf1->SetXY(40, 60);
$pdf1->Write(0, $course_title_text_8);
$pdf1->SetXY(90, 60);
$pdf1->Write(0, $unit_text_8);
$pdf1->SetXY(110, 60);
$pdf1->Write(0, $repeat_yes_8);
$pdf1->SetXY(115, 60);
$pdf1->Write(0, $repeat_no_8);
$pdf1->SetXY(120, 60);
$pdf1->Write(0, $pass_no_pass_no_8);
$pdf1->SetXY(125, 60);
$pdf1->Write(0, $pass_no_pass_yes_8);
$pdf1->SetXY(15, 65);
$pdf1->Write(0, $dept_cd_text_9);
$pdf1->SetXY(40, 65);
$pdf1->Write(0, $course_title_text_9);
$pdf1->SetXY(90, 65);
$pdf1->Write(0, $unit_text_9);
$pdf1->SetXY(110, 65);
$pdf1->Write(0, $repeat_yes_9);
$pdf1->SetXY(115, 65);
$pdf1->Write(0, $repeat_no_9);
$pdf1->SetXY(120, 65);
$pdf1->Write(0, $pass_no_pass_no_9);
$pdf1->SetXY(125, 65);
$pdf1->Write(0, $pass_no_pass_yes_9);
$pdf1->SetXY(15, 70);
$pdf1->Write(0, $dept_cd_text_10);
$pdf1->SetXY(40, 70);
$pdf1->Write(0, $course_title_text_10);
$pdf1->SetXY(90, 70);
$pdf1->Write(0, $unit_text_10);
$pdf1->SetXY(110, 70);
$pdf1->Write(0, $repeat_yes_10);
$pdf1->SetXY(115, 70);
$pdf1->Write(0, $repeat_no_10);
$pdf1->SetXY(120, 70);
$pdf1->Write(0, $pass_no_pass_no_10);
$pdf1->SetXY(125, 70);
$pdf1->Write(0, $pass_no_pass_yes_10);
$pdf1->SetXY(15, 75);
$pdf1->Write(0, $dept_cd_text_11);
$pdf1->SetXY(40, 75);
$pdf1->Write(0, $course_title_text_11);
$pdf1->SetXY(90, 75);
$pdf1->Write(0, $unit_text_11);
$pdf1->SetXY(110, 75);
$pdf1->Write(0, $repeat_yes_11);
$pdf1->SetXY(115, 75);
$pdf1->Write(0, $repeat_no_11);
$pdf1->SetXY(120, 75);
$pdf1->Write(0, $pass_no_pass_no_11);
$pdf1->SetXY(125, 75);
$pdf1->Write(0, $pass_no_pass_yes_11);
$pdf1->SetXY(15, 80);
$pdf1->Write(0, $dept_cd_text_12);
$pdf1->SetXY(40, 80);
$pdf1->Write(0, $course_title_text_12);
$pdf1->SetXY(90, 80);
$pdf1->Write(0, $unit_text_12);
$pdf1->SetXY(110, 80);
$pdf1->Write(0, $repeat_yes_12);
$pdf1->SetXY(115, 80);
$pdf1->Write(0, $repeat_no_12);
$pdf1->SetXY(120, 80);
$pdf1->Write(0, $pass_no_pass_no_12);
$pdf1->SetXY(125, 80);
$pdf1->Write(0, $pass_no_pass_yes_12);
$pdf1->SetXY(15, 85);
$pdf1->Write(0, $dept_cd_text_13);
$pdf1->SetXY(40, 85);
$pdf1->Write(0, $course_title_text_13);
$pdf1->SetXY(90, 85);
$pdf1->Write(0, $unit_text_13);
$pdf1->SetXY(110, 85);
$pdf1->Write(0, $repeat_yes_13);
$pdf1->SetXY(115, 85);
$pdf1->Write(0, $repeat_no_13);
$pdf1->SetXY(120, 85);
$pdf1->Write(0, $pass_no_pass_no_13);
$pdf1->SetXY(125, 85);
$pdf1->Write(0, $pass_no_pass_yes_13);
$pdf1->SetXY(15, 90);
$pdf1->Write(0, $dept_cd_text_14);
$pdf1->SetXY(40, 90);
$pdf1->Write(0, $course_title_text_14);
$pdf1->SetXY(90, 90);
$pdf1->Write(0, $unit_text_14);
$pdf1->SetXY(110, 90);
$pdf1->Write(0, $repeat_yes_14);
$pdf1->SetXY(115, 90);
$pdf1->Write(0, $repeat_no_14);
$pdf1->SetXY(120, 90);
$pdf1->Write(0, $pass_no_pass_no_14);
$pdf1->SetXY(125, 90);
$pdf1->Write(0, $pass_no_pass_yes_14);
$pdf1->SetXY(15, 95);
$pdf1->Write(0, $dept_cd_text_15);
$pdf1->SetXY(40, 95);
$pdf1->Write(0, $course_title_text_15);
$pdf1->SetXY(90, 95);
$pdf1->Write(0, $unit_text_15);
$pdf1->SetXY(110, 95);
$pdf1->Write(0, $repeat_yes_15);
$pdf1->SetXY(115, 95);
$pdf1->Write(0, $repeat_no_15);
$pdf1->SetXY(120, 95);
$pdf1->Write(0, $pass_no_pass_no_15);
$pdf1->SetXY(125, 95);
$pdf1->Write(0, $pass_no_pass_yes_15);
$pdf1->SetXY(15, 100);
$pdf1->Write(0, $dept_cd_text_16);
$pdf1->SetXY(40, 100);
$pdf1->Write(0, $course_title_text_16);
$pdf1->SetXY(90, 100);
$pdf1->Write(0, $unit_text_16);
$pdf1->SetXY(110, 100);
$pdf1->Write(0, $repeat_yes_16);
$pdf1->SetXY(115, 100);
$pdf1->Write(0, $repeat_no_16);
$pdf1->SetXY(120, 100);
$pdf1->Write(0, $pass_no_pass_no_16);
$pdf1->SetXY(125, 100);
$pdf1->Write(0, $pass_no_pass_yes_16);
$pdf1->SetXY(15, 105);
$pdf1->Write(0, $dept_cd_text_17);
$pdf1->SetXY(40, 105);
$pdf1->Write(0, $course_title_text_17);
$pdf1->SetXY(90, 105);
$pdf1->Write(0, $unit_text_17);
$pdf1->SetXY(110, 105);
$pdf1->Write(0, $repeat_yes_17);
$pdf1->SetXY(115, 105);
$pdf1->Write(0, $repeat_no_17);
$pdf1->SetXY(120, 105);
$pdf1->Write(0, $pass_no_pass_no_17);
$pdf1->SetXY(125, 105);
$pdf1->Write(0, $pass_no_pass_yes_17);
$pdf1->SetXY(15, 110);
$pdf1->Write(0, $dept_cd_text_18);
$pdf1->SetXY(40, 110);
$pdf1->Write(0, $course_title_text_18);
$pdf1->SetXY(90, 110);
$pdf1->Write(0, $unit_text_18);
$pdf1->SetXY(110, 110);
$pdf1->Write(0, $repeat_yes_18);
$pdf1->SetXY(115, 110);
$pdf1->Write(0, $repeat_no_18);
$pdf1->SetXY(120, 110);
$pdf1->Write(0, $pass_no_pass_no_18);
$pdf1->SetXY(125, 110);
$pdf1->Write(0, $pass_no_pass_yes_18);
$pdf1->SetXY(15, 115);
$pdf1->Write(0, $dept_cd_text_19);
$pdf1->SetXY(40, 115);
$pdf1->Write(0, $course_title_text_19);
$pdf1->SetXY(90, 115);
$pdf1->Write(0, $unit_text_19);
$pdf1->SetXY(110, 115);
$pdf1->Write(0, $repeat_yes_19);
$pdf1->SetXY(115, 115);
$pdf1->Write(0, $repeat_no_19);
$pdf1->SetXY(120, 115);
$pdf1->Write(0, $pass_no_pass_no_19);
$pdf1->SetXY(125, 115);
$pdf1->Write(0, $pass_no_pass_yes_19);
$pdf1->SetXY(15, 120);
$pdf1->Write(0, $dept_cd_text_20);
$pdf1->SetXY(40, 120);
$pdf1->Write(0, $course_title_text_20);
$pdf1->SetXY(90, 120);
$pdf1->Write(0, $unit_text_20);
$pdf1->SetXY(110, 120);
$pdf1->Write(0, $repeat_yes_20);
$pdf1->SetXY(115, 120);
$pdf1->Write(0, $repeat_no_20);
$pdf1->SetXY(120, 120);
$pdf1->Write(0, $pass_no_pass_no_20);
$pdf1->SetXY(125, 120);
$pdf1->Write(0, $pass_no_pass_yes_20);
$pdf1->SetXY(15, 125);
$pdf1->Write(0, $dept_cd_text_21);
$pdf1->SetXY(40, 125);
$pdf1->Write(0, $course_title_text_21);
$pdf1->SetXY(90, 125);
$pdf1->Write(0, $unit_text_21);
$pdf1->SetXY(110, 125);
$pdf1->Write(0, $repeat_yes_21);
$pdf1->SetXY(115, 125);
$pdf1->Write(0, $repeat_no_21);
$pdf1->SetXY(120, 125);
$pdf1->Write(0, $pass_no_pass_no_21);
$pdf1->SetXY(125, 125);
$pdf1->Write(0, $pass_no_pass_yes_21);
$pdf1->SetXY(15, 130);
$pdf1->Write(0, $dept_cd_text_22);
$pdf1->SetXY(40, 130);
$pdf1->Write(0, $course_title_text_22);
$pdf1->SetXY(90, 130);
$pdf1->Write(0, $unit_text_22);
$pdf1->SetXY(110, 130);
$pdf1->Write(0, $repeat_yes_22);
$pdf1->SetXY(115, 130);
$pdf1->Write(0, $repeat_no_22);
$pdf1->SetXY(120, 130);
$pdf1->Write(0, $pass_no_pass_no_22);
$pdf1->SetXY(125, 130);
$pdf1->Write(0, $pass_no_pass_yes_22);
$pdf1->SetXY(15, 135);
$pdf1->Write(0, $dept_cd_text_23);
$pdf1->SetXY(40, 135);
$pdf1->Write(0, $course_title_text_23);
$pdf1->SetXY(90, 135);
$pdf1->Write(0, $unit_text_23);
$pdf1->SetXY(110, 135);
$pdf1->Write(0, $repeat_yes_23);
$pdf1->SetXY(115, 135);
$pdf1->Write(0, $repeat_no_23);
$pdf1->SetXY(120, 135);
$pdf1->Write(0, $pass_no_pass_no_23);
$pdf1->SetXY(125, 135);
$pdf1->Write(0, $pass_no_pass_yes_23);
$pdf1->SetXY(15, 140);
$pdf1->Write(0, $dept_cd_text_24);
$pdf1->SetXY(40, 140);
$pdf1->Write(0, $course_title_text_24);
$pdf1->SetXY(90, 140);
$pdf1->Write(0, $unit_text_24);
$pdf1->SetXY(110, 140);
$pdf1->Write(0, $repeat_yes_24);
$pdf1->SetXY(115, 140);
$pdf1->Write(0, $repeat_no_24);
$pdf1->SetXY(120, 140);
$pdf1->Write(0, $pass_no_pass_no_24);
$pdf1->SetXY(125, 140);
$pdf1->Write(0, $pass_no_pass_yes_24);
$pdf1->SetXY(15, 145);
$pdf1->Write(0, $dept_cd_text_25);
$pdf1->SetXY(40, 145);
$pdf1->Write(0, $course_title_text_25);
$pdf1->SetXY(90, 145);
$pdf1->Write(0, $unit_text_25);
$pdf1->SetXY(110, 145);
$pdf1->Write(0, $repeat_yes_25);
$pdf1->SetXY(115, 145);
$pdf1->Write(0, $repeat_no_25);
$pdf1->SetXY(120, 145);
$pdf1->Write(0, $pass_no_pass_no_25);
$pdf1->SetXY(125, 145);
$pdf1->Write(0, $pass_no_pass_yes_25);
$pdf1->SetXY(15, 150);
$pdf1->Write(0, $dept_cd_text_26);
$pdf1->SetXY(40, 150);
$pdf1->Write(0, $course_title_text_26);
$pdf1->SetXY(90, 150);
$pdf1->Write(0, $unit_text_26);
$pdf1->SetXY(110, 150);
$pdf1->Write(0, $repeat_yes_26);
$pdf1->SetXY(115, 150);
$pdf1->Write(0, $repeat_no_26);
$pdf1->SetXY(120, 150);
$pdf1->Write(0, $pass_no_pass_no_26);
$pdf1->SetXY(125, 150);
$pdf1->Write(0, $pass_no_pass_yes_26);
$pdf1->SetXY(15, 155);
$pdf1->Write(0, $dept_cd_text_27);
$pdf1->SetXY(40, 155);
$pdf1->Write(0, $course_title_text_27);
$pdf1->SetXY(90, 155);
$pdf1->Write(0, $unit_text_27);
$pdf1->SetXY(110, 155);
$pdf1->Write(0, $repeat_yes_27);
$pdf1->SetXY(115, 155);
$pdf1->Write(0, $repeat_no_27);
$pdf1->SetXY(120, 155);
$pdf1->Write(0, $pass_no_pass_no_27);
$pdf1->SetXY(125, 155);
$pdf1->Write(0, $pass_no_pass_yes_27);
$pdf1->SetXY(15, 160);
$pdf1->Write(0, $dept_cd_text_28);
$pdf1->SetXY(40, 160);
$pdf1->Write(0, $course_title_text_28);
$pdf1->SetXY(90, 160);
$pdf1->Write(0, $unit_text_28);
$pdf1->SetXY(110, 160);
$pdf1->Write(0, $repeat_yes_28);
$pdf1->SetXY(115, 160);
$pdf1->Write(0, $repeat_no_28);
$pdf1->SetXY(120, 160);
$pdf1->Write(0, $pass_no_pass_no_28);
$pdf1->SetXY(125, 160);
$pdf1->Write(0, $pass_no_pass_yes_28);
$pdf1->SetXY(15, 165);
$pdf1->Write(0, $dept_cd_text_29);
$pdf1->SetXY(40, 165);
$pdf1->Write(0, $course_title_text_29);
$pdf1->SetXY(90, 165);
$pdf1->Write(0, $unit_text_29);
$pdf1->SetXY(110, 165);
$pdf1->Write(0, $repeat_yes_29);
$pdf1->SetXY(115, 165);
$pdf1->Write(0, $repeat_no_29);
$pdf1->SetXY(120, 165);
$pdf1->Write(0, $pass_no_pass_no_29);
$pdf1->SetXY(125, 165);
$pdf1->Write(0, $pass_no_pass_yes_29);
$pdf1->SetXY(15, 170);
$pdf1->Write(0, $dept_cd_text_30);
$pdf1->SetXY(40, 170);
$pdf1->Write(0, $course_title_text_30);
$pdf1->SetXY(90, 170);
$pdf1->Write(0, $unit_text_30);
$pdf1->SetXY(110, 170);
$pdf1->Write(0, $repeat_yes_30);
$pdf1->SetXY(115, 170);
$pdf1->Write(0, $repeat_no_30);
$pdf1->SetXY(120, 170);
$pdf1->Write(0, $pass_no_pass_no_30);
$pdf1->SetXY(125, 170);
$pdf1->Write(0, $pass_no_pass_yes_30);

$pdf1->SetXY(10, 250);
$pdf1->Write(0, "eTriever Unique ID:");
$pdf1->SetXY(48, 250);
$pdf1->Write(0, $rand);
$pdf1->SetXY(110, 250);
$pdf1->Write(0, "Date Timestamp: ".$timestamp);
$pdf1->SetXY(10, 255);
$pdf1->Write(0, "This PDF is for reference, keep it for your records, your data has already been submitted.");

$pdf1->Output('/var/www/etriever/html/pdf/24Intent_To_Grad_NEW_1.pdf', 'F');
class concat_pdf extends FPDI {
    var $files = array();
    function setFiles($files) {
        $this->files = $files;
    }
    function concat() {
        foreach($this->files AS $file) {
            $pagecount = $this->setSourceFile($file);
            for ($i = 1; $i <= $pagecount; $i++) {
                 $tplidx = $this->ImportPage($i);
                 $s = $this->getTemplatesize($tplidx);
                 $this->AddPage($s['w'] > $s['h'] ? 'L' : 'P', array($s['w'], $s['h']));
                 $this->useTemplate($tplidx);
            }
        }
    }
}

/*
//http://doczine.com/bigdata/1/1385787286_f1f12ef54e/mandatory_disclosure.pdf
//Becomes this url using mod_rewrite
//http://doczine.com/printer.com?doc=1385787286_f1f12ef54e
//Then metadata is pulled from the DB and then appended to first page with hyperlinks
//Hyperlinks files and metadata are then appended to first page
//Try to append to the first page, if not then overwrite the first page
//First page is written to the ramdrive, append file is added to the ramdrive
//The third new file concatenates both files and then writes them to the ramdrive
//The new file is pushed to the browser via the header command
//Write product file to the ramdrive, and then push the file back to the browser



RewriteEngine on
RewriteRule ^([^bigdata/]+)([^/]+).*$ printer.php?id=$2 [L]

RewriteEngine on
RewriteRule ^([^/]+)/([^/]+).*$ $1.php?id=$2 [L]
*/

$pdf2 = new concat_pdf();
$pdf2->setFiles(array('/var/www/etriever/html/pdf/24Intent_To_Grad_NEW.pdf','/var/www/etriever/html/pdf/24Intent_To_Grad_NEW_1.pdf'));
$pdf2->concat();
$final_destination = "/var/www/etriever/html/pdf/24Intent_To_Grad_NEW_FINAL_".$student_id.".pdf";
$pdf2->Output($final_destination, 'F');
chmod($final_destination, 0777);

$file = $final_destination;

if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($file));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    ob_clean();
    flush();
    readfile($file);
    exit;
}


/*
$buffer = "";
$handle = @fopen($final_destination, "r");
if ($handle) {
    while (($buffer = fgets($handle)) !== false) {
        //echo $buffer;
        $pdf_id = "PROOF OF INTENT TO GRADUATE V1";
        $query = "INSERT INTO `test`.`xpdf` (`student_id`, `pdf_id`, `pdf_blob`) VALUES (?,?,?)";
        if ($stmt = mysqli_prepare($conn, $query)); {
            mysqli_stmt_bind_param($stmt, "ssb", $student_id, $pdf_id, $buffer);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }
    if (!feof($handle)) {
        echo "Error: unexpected fgets() fail\n";
    }
    fclose($handle);
}
*/

//print_r($_SESSION);
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
</html>         <div class="row-fluid">
                    <div class="span12">
                        <div class="portlet box blue tabbable">
                            <div class="portlet-title">
                            Etriever - Proof of the Intent to Graduate Form Post Values Submitted
                            </div>
                            <div class="portlet-body form">
                                <div class="tabbable portlet-tabs">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="portlet_tab1">
<br><br><br>
<h2>Proof of the Intent to Graduate (LETTER) Form Post Values Submitted</h2>
<h4>
<p style="width:880px; text-align:left;">Below is the post values for the Proof of the Intent to Graduate (LETTER) Web Form.</p>
</h4>


<?php
$today = date("Y-m-d");
//echo $today;
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

$val_array_post = array();
foreach($_POST as $stuff => $val ) {
    $val_array_post[$stuff] = strip_tags(stripslashes($val));
}
//print_r($val_array_post);
//extract($val_array_post, EXTR_PREFIX_SAME);
extract($val_array_post, EXTR_SKIP);
$arr = get_defined_vars();
//print_r($arr);
$string_sql_insert = "INSERT INTO `test`.`test` (";
$string_sql_variable = "";
$string_sql_data = "";
$string_s = "";
$count_array = count($val_array_post, COUNT_RECURSIVE);
echo "<table border='1'>";
echo "<h2>";
echo "<a href=";
$pdf_key = "proof_of_the_intent_to_graduate_v1";
echo "https://etriever.berkeley.edu/test_pdf.php?student_id=";
echo $student_id;
echo "&pdf_id=";
echo $pdf_key;
echo ">Here is a link to your form post as a PDF receipt for your records</a>";
echo "<br>";
echo "</h2>";
foreach($val_array_post as $variable => $value) {
    echo "<tr>";
        echo "<td>".strip_tags(stripslashes($variable))."</td>";
        echo "<td>".strip_tags(stripslashes($value))."</td>";
    echo "</tr>";
    $string_sql_variable .= "`".$variable."`,";
    $string_sql_data .= "\"".$value."\",";
    $string_s .= "s";
}
echo "</table>";
$string_sql_variable = trim($string_sql_variable, ",");
$string_sql_data = trim($string_sql_data, ",");
$quer = $string_sql_insert.$string_sql_variable.") VALUES (".$string_sql_data.");";
//echo $quer;
$arr = get_defined_vars();
//print_r($arr);
if ($stmt = mysqli_prepare($conn, $quer)); {
    mysqli_stmt_execute($stmt); 
    mysqli_stmt_close($stmt);
}

//INSERT COMMENT INTO ETRIEVER NOTES PAGES FOR PDF POST
//TESTED ON TEST DB NOT ETRV YET!!

$staff_id = "010940625";
$student_id = $student_id;
$today = $today;
$form_entry = "Form Entry Made on ".$today.": ".$pdf_key;
$action_type_id = "45";
$location_id = "1";

$query = "INSERT INTO `test`.`advg_action` (`advg_action_date`, `advg_action_notes`, `student_id`, `staff_id`, `action_type_id`, `location_id`, `entry_date`, `entry_staff_id`) VALUES ('".$today."','".$form_entry."','".$student_id."','".$action_type_id."','".$action_type_id."','".$location_id."','".$today."','".$staff_id."');";
//echo $query;
if ($stmt = mysqli_prepare($conn, $query)); {
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
}

$pdf = new FPDI();
$pdf->AddPage();
$pdf->setSourceFile('/var/www/etriever/html/pdf/24Intent_To_Grad.pdf');
$tplIdx = $pdf->importPage(1);
$pdf->useTemplate($tplIdx, 0, 0, 0);
$specs = $pdf->getTemplateSize($tplIdx);
//print_r($specs);
$pdf->SetFont('Arial');
$pdf->SetTextColor(255,0,0);
$pdf->SetXY(150, 68);
$pdf->Write(0, $student_id);
$pdf->SetXY(15, 68);
$pdf->Write(0, $student_name);
$pdf->SetXY(15, 100);
$pdf->Write(0, $email_verify);
$pdf->SetXY(15, 84);
$pdf->Write(0, $mailing_address);
$pdf->SetXY(85, 84);
$pdf->Write(0, $city);
$pdf->SetXY(145, 84);
$pdf->Write(0, $state);
$pdf->SetXY(175, 84);
$pdf->Write(0, $zip);
$pdf->SetXY(145, 100);
$pdf->Write(0, $phone);
$pdf->SetXY(125, 117);
$pdf->Write(0, $pickup);
$pdf->SetXY(40, 140);
$pdf->Write(0, $mailing_address_second);
$pdf->SetXY(100, 140);
$pdf->Write(0, $city_second);
$pdf->SetXY(150, 140);
$pdf->Write(0, $state_second);
$pdf->SetXY(180, 140);
$pdf->Write(0, $zip_second);
$pdf->SetXY(45, 215);
$pdf->Write(0, $degree_list_checkbox);
$pdf->SetXY(45, 220.5);
$pdf->Write(0, $study_list_checkbox);
$pdf->SetXY(45, 227);
$pdf->Write(0, $memo_checkbox);

$pdf->SetXY(17, 175);
$pdf->Write(0, "Please see current study list on second page.");

$timestamp = date("Y-m-d H:i:s");
$pdf->SetXY(10, 250);
$pdf->Write(0, "eTriever Unique ID:");
$rand = rand(100000, 999999);
$pdf->SetXY(48, 250);
$pdf->Write(0, $rand);
$pdf->SetXY(110, 250);
$pdf->Write(0, "Date Timestamp: ".$timestamp);
$pdf->SetXY(10, 255);
$pdf->Write(0, "This PDF is for reference, keep it for your records, your data has already been submitted.");
$pdf->Output('/var/www/etriever/html/pdf/24Intent_To_Grad_NEW.pdf', 'F');

$pdf1 = new FPDI();
$pdf1->AddPage();
$pdf1->setSourceFile('/var/www/etriever/html/pdf/24Intent_To_Grad_2.pdf');
$tplIdx = $pdf1->importPage(1);
$pdf1->useTemplate($tplIdx, 0, 0, 0);
$pdf1->SetFont('Arial');
$pdf1->SetTextColor(255,0,0);
$pdf1->SetXY(150, 15);
$pdf1->Write(0, "StuID: ".$student_id);

$pdf1->SetXY(15, 15);
$pdf1->Write(0, "Degree of Study: ".$major);
$pdf1->SetXY(15, 20);
$pdf1->Write(0, "Dept              Course Title                       Units        Repeat  PnP");
$pdf1->SetXY(15, 25);
$pdf1->Write(0, $dept_cd_text_1);
$pdf1->SetXY(40, 25);
$pdf1->Write(0, $course_title_text_1);
$pdf1->SetXY(90, 25);
$pdf1->Write(0, $unit_text_1);
$pdf1->SetXY(110, 25);
$pdf1->Write(0, $repeat_yes_1);
$pdf1->SetXY(115, 25);
$pdf1->Write(0, $repeat_no_1);
$pdf1->SetXY(120, 25);
$pdf1->Write(0, $pass_no_pass_no_1);
$pdf1->SetXY(125, 25);
$pdf1->Write(0, $pass_no_pass_yes_1);
$pdf1->SetXY(15, 30);
$pdf1->Write(0, $dept_cd_text_2);
$pdf1->SetXY(40, 30);
$pdf1->Write(0, $course_title_text_2);
$pdf1->SetXY(90, 30);
$pdf1->Write(0, $unit_text_2);
$pdf1->SetXY(110, 30);
$pdf1->Write(0, $repeat_yes_2);
$pdf1->SetXY(115, 30);
$pdf1->Write(0, $repeat_no_2);
$pdf1->SetXY(120, 30);
$pdf1->Write(0, $pass_no_pass_no_2);
$pdf1->SetXY(125, 30);
$pdf1->Write(0, $pass_no_pass_yes_2);
$pdf1->SetXY(15, 35);
$pdf1->Write(0, $dept_cd_text_3);
$pdf1->SetXY(40, 35);
$pdf1->Write(0, $course_title_text_3);
$pdf1->SetXY(90, 35);
$pdf1->Write(0, $unit_text_3);
$pdf1->SetXY(110, 35);
$pdf1->Write(0, $repeat_yes_3);
$pdf1->SetXY(115, 35);
$pdf1->Write(0, $repeat_no_3);
$pdf1->SetXY(120, 35);
$pdf1->Write(0, $pass_no_pass_no_3);
$pdf1->SetXY(125, 35);
$pdf1->Write(0, $pass_no_pass_yes_3);
$pdf1->SetXY(15, 40);
$pdf1->Write(0, $dept_cd_text_4);
$pdf1->SetXY(40, 40);
$pdf1->Write(0, $course_title_text_4);
$pdf1->SetXY(90, 40);
$pdf1->Write(0, $unit_text_4);
$pdf1->SetXY(110, 40);
$pdf1->Write(0, $repeat_yes_4);
$pdf1->SetXY(115, 40);
$pdf1->Write(0, $repeat_no_4);
$pdf1->SetXY(120, 40);
$pdf1->Write(0, $pass_no_pass_no_4);
$pdf1->SetXY(125, 40);
$pdf1->Write(0, $pass_no_pass_yes_4);
$pdf1->SetXY(15, 45);
$pdf1->Write(0, $dept_cd_text_5);
$pdf1->SetXY(40, 45);
$pdf1->Write(0, $course_title_text_5);
$pdf1->SetXY(90, 45);
$pdf1->Write(0, $unit_text_5);
$pdf1->SetXY(110, 45);
$pdf1->Write(0, $repeat_yes_5);
$pdf1->SetXY(115, 45);
$pdf1->Write(0, $repeat_no_5);
$pdf1->SetXY(120, 45);
$pdf1->Write(0, $pass_no_pass_no_5);
$pdf1->SetXY(125, 45);
$pdf1->Write(0, $pass_no_pass_yes_5);
$pdf1->SetXY(15, 50);
$pdf1->Write(0, $dept_cd_text_6);
$pdf1->SetXY(40, 50);
$pdf1->Write(0, $course_title_text_6);
$pdf1->SetXY(90, 50);
$pdf1->Write(0, $unit_text_6);
$pdf1->SetXY(110, 50);
$pdf1->Write(0, $repeat_yes_6);
$pdf1->SetXY(115, 50);
$pdf1->Write(0, $repeat_no_6);
$pdf1->SetXY(120, 50);
$pdf1->Write(0, $pass_no_pass_no_6);
$pdf1->SetXY(125, 50);
$pdf1->Write(0, $pass_no_pass_yes_6);
$pdf1->SetXY(15, 55);
$pdf1->Write(0, $dept_cd_text_7);
$pdf1->SetXY(40, 55);
$pdf1->Write(0, $course_title_text_7);
$pdf1->SetXY(90, 55);
$pdf1->Write(0, $unit_text_7);
$pdf1->SetXY(110, 55);
$pdf1->Write(0, $repeat_yes_7);
$pdf1->SetXY(115, 55);
$pdf1->Write(0, $repeat_no_7);
$pdf1->SetXY(120, 55);
$pdf1->Write(0, $pass_no_pass_no_7);
$pdf1->SetXY(125, 55);
$pdf1->Write(0, $pass_no_pass_yes_7);
$pdf1->SetXY(15, 60);
$pdf1->Write(0, $dept_cd_text_8);
$pdf1->SetXY(40, 60);
$pdf1->Write(0, $course_title_text_8);
$pdf1->SetXY(90, 60);
$pdf1->Write(0, $unit_text_8);
$pdf1->SetXY(110, 60);
$pdf1->Write(0, $repeat_yes_8);
$pdf1->SetXY(115, 60);
$pdf1->Write(0, $repeat_no_8);
$pdf1->SetXY(120, 60);
$pdf1->Write(0, $pass_no_pass_no_8);
$pdf1->SetXY(125, 60);
$pdf1->Write(0, $pass_no_pass_yes_8);
$pdf1->SetXY(15, 65);
$pdf1->Write(0, $dept_cd_text_9);
$pdf1->SetXY(40, 65);
$pdf1->Write(0, $course_title_text_9);
$pdf1->SetXY(90, 65);
$pdf1->Write(0, $unit_text_9);
$pdf1->SetXY(110, 65);
$pdf1->Write(0, $repeat_yes_9);
$pdf1->SetXY(115, 65);
$pdf1->Write(0, $repeat_no_9);
$pdf1->SetXY(120, 65);
$pdf1->Write(0, $pass_no_pass_no_9);
$pdf1->SetXY(125, 65);
$pdf1->Write(0, $pass_no_pass_yes_9);
$pdf1->SetXY(15, 70);
$pdf1->Write(0, $dept_cd_text_10);
$pdf1->SetXY(40, 70);
$pdf1->Write(0, $course_title_text_10);
$pdf1->SetXY(90, 70);
$pdf1->Write(0, $unit_text_10);
$pdf1->SetXY(110, 70);
$pdf1->Write(0, $repeat_yes_10);
$pdf1->SetXY(115, 70);
$pdf1->Write(0, $repeat_no_10);
$pdf1->SetXY(120, 70);
$pdf1->Write(0, $pass_no_pass_no_10);
$pdf1->SetXY(125, 70);
$pdf1->Write(0, $pass_no_pass_yes_10);
$pdf1->SetXY(15, 75);
$pdf1->Write(0, $dept_cd_text_11);
$pdf1->SetXY(40, 75);
$pdf1->Write(0, $course_title_text_11);
$pdf1->SetXY(90, 75);
$pdf1->Write(0, $unit_text_11);
$pdf1->SetXY(110, 75);
$pdf1->Write(0, $repeat_yes_11);
$pdf1->SetXY(115, 75);
$pdf1->Write(0, $repeat_no_11);
$pdf1->SetXY(120, 75);
$pdf1->Write(0, $pass_no_pass_no_11);
$pdf1->SetXY(125, 75);
$pdf1->Write(0, $pass_no_pass_yes_11);
$pdf1->SetXY(15, 80);
$pdf1->Write(0, $dept_cd_text_12);
$pdf1->SetXY(40, 80);
$pdf1->Write(0, $course_title_text_12);
$pdf1->SetXY(90, 80);
$pdf1->Write(0, $unit_text_12);
$pdf1->SetXY(110, 80);
$pdf1->Write(0, $repeat_yes_12);
$pdf1->SetXY(115, 80);
$pdf1->Write(0, $repeat_no_12);
$pdf1->SetXY(120, 80);
$pdf1->Write(0, $pass_no_pass_no_12);
$pdf1->SetXY(125, 80);
$pdf1->Write(0, $pass_no_pass_yes_12);
$pdf1->SetXY(15, 85);
$pdf1->Write(0, $dept_cd_text_13);
$pdf1->SetXY(40, 85);
$pdf1->Write(0, $course_title_text_13);
$pdf1->SetXY(90, 85);
$pdf1->Write(0, $unit_text_13);
$pdf1->SetXY(110, 85);
$pdf1->Write(0, $repeat_yes_13);
$pdf1->SetXY(115, 85);
$pdf1->Write(0, $repeat_no_13);
$pdf1->SetXY(120, 85);
$pdf1->Write(0, $pass_no_pass_no_13);
$pdf1->SetXY(125, 85);
$pdf1->Write(0, $pass_no_pass_yes_13);
$pdf1->SetXY(15, 90);
$pdf1->Write(0, $dept_cd_text_14);
$pdf1->SetXY(40, 90);
$pdf1->Write(0, $course_title_text_14);
$pdf1->SetXY(90, 90);
$pdf1->Write(0, $unit_text_14);
$pdf1->SetXY(110, 90);
$pdf1->Write(0, $repeat_yes_14);
$pdf1->SetXY(115, 90);
$pdf1->Write(0, $repeat_no_14);
$pdf1->SetXY(120, 90);
$pdf1->Write(0, $pass_no_pass_no_14);
$pdf1->SetXY(125, 90);
$pdf1->Write(0, $pass_no_pass_yes_14);
$pdf1->SetXY(15, 95);
$pdf1->Write(0, $dept_cd_text_15);
$pdf1->SetXY(40, 95);
$pdf1->Write(0, $course_title_text_15);
$pdf1->SetXY(90, 95);
$pdf1->Write(0, $unit_text_15);
$pdf1->SetXY(110, 95);
$pdf1->Write(0, $repeat_yes_15);
$pdf1->SetXY(115, 95);
$pdf1->Write(0, $repeat_no_15);
$pdf1->SetXY(120, 95);
$pdf1->Write(0, $pass_no_pass_no_15);
$pdf1->SetXY(125, 95);
$pdf1->Write(0, $pass_no_pass_yes_15);
$pdf1->SetXY(15, 100);
$pdf1->Write(0, $dept_cd_text_16);
$pdf1->SetXY(40, 100);
$pdf1->Write(0, $course_title_text_16);
$pdf1->SetXY(90, 100);
$pdf1->Write(0, $unit_text_16);
$pdf1->SetXY(110, 100);
$pdf1->Write(0, $repeat_yes_16);
$pdf1->SetXY(115, 100);
$pdf1->Write(0, $repeat_no_16);
$pdf1->SetXY(120, 100);
$pdf1->Write(0, $pass_no_pass_no_16);
$pdf1->SetXY(125, 100);
$pdf1->Write(0, $pass_no_pass_yes_16);
$pdf1->SetXY(15, 105);
$pdf1->Write(0, $dept_cd_text_17);
$pdf1->SetXY(40, 105);
$pdf1->Write(0, $course_title_text_17);
$pdf1->SetXY(90, 105);
$pdf1->Write(0, $unit_text_17);
$pdf1->SetXY(110, 105);
$pdf1->Write(0, $repeat_yes_17);
$pdf1->SetXY(115, 105);
$pdf1->Write(0, $repeat_no_17);
$pdf1->SetXY(120, 105);
$pdf1->Write(0, $pass_no_pass_no_17);
$pdf1->SetXY(125, 105);
$pdf1->Write(0, $pass_no_pass_yes_17);
$pdf1->SetXY(15, 110);
$pdf1->Write(0, $dept_cd_text_18);
$pdf1->SetXY(40, 110);
$pdf1->Write(0, $course_title_text_18);
$pdf1->SetXY(90, 110);
$pdf1->Write(0, $unit_text_18);
$pdf1->SetXY(110, 110);
$pdf1->Write(0, $repeat_yes_18);
$pdf1->SetXY(115, 110);
$pdf1->Write(0, $repeat_no_18);
$pdf1->SetXY(120, 110);
$pdf1->Write(0, $pass_no_pass_no_18);
$pdf1->SetXY(125, 110);
$pdf1->Write(0, $pass_no_pass_yes_18);
$pdf1->SetXY(15, 115);
$pdf1->Write(0, $dept_cd_text_19);
$pdf1->SetXY(40, 115);
$pdf1->Write(0, $course_title_text_19);
$pdf1->SetXY(90, 115);
$pdf1->Write(0, $unit_text_19);
$pdf1->SetXY(110, 115);
$pdf1->Write(0, $repeat_yes_19);
$pdf1->SetXY(115, 115);
$pdf1->Write(0, $repeat_no_19);
$pdf1->SetXY(120, 115);
$pdf1->Write(0, $pass_no_pass_no_19);
$pdf1->SetXY(125, 115);
$pdf1->Write(0, $pass_no_pass_yes_19);
$pdf1->SetXY(15, 120);
$pdf1->Write(0, $dept_cd_text_20);
$pdf1->SetXY(40, 120);
$pdf1->Write(0, $course_title_text_20);
$pdf1->SetXY(90, 120);
$pdf1->Write(0, $unit_text_20);
$pdf1->SetXY(110, 120);
$pdf1->Write(0, $repeat_yes_20);
$pdf1->SetXY(115, 120);
$pdf1->Write(0, $repeat_no_20);
$pdf1->SetXY(120, 120);
$pdf1->Write(0, $pass_no_pass_no_20);
$pdf1->SetXY(125, 120);
$pdf1->Write(0, $pass_no_pass_yes_20);
$pdf1->SetXY(15, 125);
$pdf1->Write(0, $dept_cd_text_21);
$pdf1->SetXY(40, 125);
$pdf1->Write(0, $course_title_text_21);
$pdf1->SetXY(90, 125);
$pdf1->Write(0, $unit_text_21);
$pdf1->SetXY(110, 125);
$pdf1->Write(0, $repeat_yes_21);
$pdf1->SetXY(115, 125);
$pdf1->Write(0, $repeat_no_21);
$pdf1->SetXY(120, 125);
$pdf1->Write(0, $pass_no_pass_no_21);
$pdf1->SetXY(125, 125);
$pdf1->Write(0, $pass_no_pass_yes_21);
$pdf1->SetXY(15, 130);
$pdf1->Write(0, $dept_cd_text_22);
$pdf1->SetXY(40, 130);
$pdf1->Write(0, $course_title_text_22);
$pdf1->SetXY(90, 130);
$pdf1->Write(0, $unit_text_22);
$pdf1->SetXY(110, 130);
$pdf1->Write(0, $repeat_yes_22);
$pdf1->SetXY(115, 130);
$pdf1->Write(0, $repeat_no_22);
$pdf1->SetXY(120, 130);
$pdf1->Write(0, $pass_no_pass_no_22);
$pdf1->SetXY(125, 130);
$pdf1->Write(0, $pass_no_pass_yes_22);
$pdf1->SetXY(15, 135);
$pdf1->Write(0, $dept_cd_text_23);
$pdf1->SetXY(40, 135);
$pdf1->Write(0, $course_title_text_23);
$pdf1->SetXY(90, 135);
$pdf1->Write(0, $unit_text_23);
$pdf1->SetXY(110, 135);
$pdf1->Write(0, $repeat_yes_23);
$pdf1->SetXY(115, 135);
$pdf1->Write(0, $repeat_no_23);
$pdf1->SetXY(120, 135);
$pdf1->Write(0, $pass_no_pass_no_23);
$pdf1->SetXY(125, 135);
$pdf1->Write(0, $pass_no_pass_yes_23);
$pdf1->SetXY(15, 140);
$pdf1->Write(0, $dept_cd_text_24);
$pdf1->SetXY(40, 140);
$pdf1->Write(0, $course_title_text_24);
$pdf1->SetXY(90, 140);
$pdf1->Write(0, $unit_text_24);
$pdf1->SetXY(110, 140);
$pdf1->Write(0, $repeat_yes_24);
$pdf1->SetXY(115, 140);
$pdf1->Write(0, $repeat_no_24);
$pdf1->SetXY(120, 140);
$pdf1->Write(0, $pass_no_pass_no_24);
$pdf1->SetXY(125, 140);
$pdf1->Write(0, $pass_no_pass_yes_24);
$pdf1->SetXY(15, 145);
$pdf1->Write(0, $dept_cd_text_25);
$pdf1->SetXY(40, 145);
$pdf1->Write(0, $course_title_text_25);
$pdf1->SetXY(90, 145);
$pdf1->Write(0, $unit_text_25);
$pdf1->SetXY(110, 145);
$pdf1->Write(0, $repeat_yes_25);
$pdf1->SetXY(115, 145);
$pdf1->Write(0, $repeat_no_25);
$pdf1->SetXY(120, 145);
$pdf1->Write(0, $pass_no_pass_no_25);
$pdf1->SetXY(125, 145);
$pdf1->Write(0, $pass_no_pass_yes_25);
$pdf1->SetXY(15, 150);
$pdf1->Write(0, $dept_cd_text_26);
$pdf1->SetXY(40, 150);
$pdf1->Write(0, $course_title_text_26);
$pdf1->SetXY(90, 150);
$pdf1->Write(0, $unit_text_26);
$pdf1->SetXY(110, 150);
$pdf1->Write(0, $repeat_yes_26);
$pdf1->SetXY(115, 150);
$pdf1->Write(0, $repeat_no_26);
$pdf1->SetXY(120, 150);
$pdf1->Write(0, $pass_no_pass_no_26);
$pdf1->SetXY(125, 150);
$pdf1->Write(0, $pass_no_pass_yes_26);
$pdf1->SetXY(15, 155);
$pdf1->Write(0, $dept_cd_text_27);
$pdf1->SetXY(40, 155);
$pdf1->Write(0, $course_title_text_27);
$pdf1->SetXY(90, 155);
$pdf1->Write(0, $unit_text_27);
$pdf1->SetXY(110, 155);
$pdf1->Write(0, $repeat_yes_27);
$pdf1->SetXY(115, 155);
$pdf1->Write(0, $repeat_no_27);
$pdf1->SetXY(120, 155);
$pdf1->Write(0, $pass_no_pass_no_27);
$pdf1->SetXY(125, 155);
$pdf1->Write(0, $pass_no_pass_yes_27);
$pdf1->SetXY(15, 160);
$pdf1->Write(0, $dept_cd_text_28);
$pdf1->SetXY(40, 160);
$pdf1->Write(0, $course_title_text_28);
$pdf1->SetXY(90, 160);
$pdf1->Write(0, $unit_text_28);
$pdf1->SetXY(110, 160);
$pdf1->Write(0, $repeat_yes_28);
$pdf1->SetXY(115, 160);
$pdf1->Write(0, $repeat_no_28);
$pdf1->SetXY(120, 160);
$pdf1->Write(0, $pass_no_pass_no_28);
$pdf1->SetXY(125, 160);
$pdf1->Write(0, $pass_no_pass_yes_28);
$pdf1->SetXY(15, 165);
$pdf1->Write(0, $dept_cd_text_29);
$pdf1->SetXY(40, 165);
$pdf1->Write(0, $course_title_text_29);
$pdf1->SetXY(90, 165);
$pdf1->Write(0, $unit_text_29);
$pdf1->SetXY(110, 165);
$pdf1->Write(0, $repeat_yes_29);
$pdf1->SetXY(115, 165);
$pdf1->Write(0, $repeat_no_29);
$pdf1->SetXY(120, 165);
$pdf1->Write(0, $pass_no_pass_no_29);
$pdf1->SetXY(125, 165);
$pdf1->Write(0, $pass_no_pass_yes_29);
$pdf1->SetXY(15, 170);
$pdf1->Write(0, $dept_cd_text_30);
$pdf1->SetXY(40, 170);
$pdf1->Write(0, $course_title_text_30);
$pdf1->SetXY(90, 170);
$pdf1->Write(0, $unit_text_30);
$pdf1->SetXY(110, 170);
$pdf1->Write(0, $repeat_yes_30);
$pdf1->SetXY(115, 170);
$pdf1->Write(0, $repeat_no_30);
$pdf1->SetXY(120, 170);
$pdf1->Write(0, $pass_no_pass_no_30);
$pdf1->SetXY(125, 170);
$pdf1->Write(0, $pass_no_pass_yes_30);

$pdf1->SetXY(10, 250);
$pdf1->Write(0, "eTriever Unique ID:");
$pdf1->SetXY(48, 250);
$pdf1->Write(0, $rand);
$pdf1->SetXY(110, 250);
$pdf1->Write(0, "Date Timestamp: ".$timestamp);
$pdf1->SetXY(10, 255);
$pdf1->Write(0, "This PDF is for reference, keep it for your records, your data has already been submitted.");

$pdf1->Output('/var/www/etriever/html/pdf/24Intent_To_Grad_NEW_1.pdf', 'F');
class concat_pdf extends FPDI {
    var $files = array();
    function setFiles($files) {
        $this->files = $files;
    }
    function concat() {
        foreach($this->files AS $file) {
            $pagecount = $this->setSourceFile($file);
            for ($i = 1; $i <= $pagecount; $i++) {
                 $tplidx = $this->ImportPage($i);
                 $s = $this->getTemplatesize($tplidx);
                 $this->AddPage($s['w'] > $s['h'] ? 'L' : 'P', array($s['w'], $s['h']));
                 $this->useTemplate($tplidx);
            }
        }
    }
}
$pdf2 = new concat_pdf();
$pdf2->setFiles(array('/var/www/etriever/html/pdf/24Intent_To_Grad_NEW.pdf','/var/www/etriever/html/pdf/24Intent_To_Grad_NEW_1.pdf'));
$pdf2->concat();
$final_destination = "/var/www/etriever/html/pdf/24Intent_To_Grad_NEW_FINAL_".$student_id.".pdf";
$pdf2->Output($final_destination, 'F');
chmod($final_destination, 0777);

$file = $final_destination;



if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($file));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    ob_clean();
    flush();
    readfile($file);
    exit;
}

/*
calcentral team bernie 
spend time when the collaborator tool and new requirements
*/


/*
$buffer = "";
$handle = @fopen($final_destination, "r");
if ($handle) {
    while (($buffer = fgets($handle)) !== false) {
        //echo $buffer;
        $pdf_id = "PROOF OF INTENT TO GRADUATE V1";
        $query = "INSERT INTO `test`.`xpdf` (`student_id`, `pdf_id`, `pdf_blob`) VALUES (?,?,?)";
        if ($stmt = mysqli_prepare($conn, $query)); {
            mysqli_stmt_bind_param($stmt, "ssb", $student_id, $pdf_id, $buffer);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }
    if (!feof($handle)) {
        echo "Error: unexpected fgets() fail\n";
    }
    fclose($handle);
}
*/

//print_r($_SESSION);
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