<?php 
//this is what creates the drop down ajax menus on the upload screen
//each drop down menu checks if the get variable is set isset($_GET['ch'])
//and then queries the values that are return to the drop down menu

include('db.php');

//$_GET['ch'] is passed by the javascript ajax request
if(isset($_GET['ch']))
{
$category = $_GET['ch'];

//this creates the second drop down menu's header

echo "<select name='secondOption' style='width: 450px;' onchange='htmlData1('ajaxOption.php', 'ch1='+this.value)'>";
echo "<option value='#'></option>";

$conn = db_connect();
$query = "SELECT taxo_2 FROM `docunator`.`taxo_2` WHERE `taxo_2`.`taxo_1` = '".$category."';";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $taxo_2);
    while (mysqli_stmt_fetch($stmt)) {
        echo "<option value='";
        printf ("%s", $taxo_2);
		echo "'>";
		printf ("%s", $taxo_2);
		echo "</option>";
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
echo "</select>";
}


?>
