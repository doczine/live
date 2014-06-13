<?php

include('user_functions.php');

function display_projects($term) {
$conn = db_connect_local();
$query = "SELECT `PROJECT_KEY`, `PROJECT_TYPE`, `PROJECT_NAME`, `PROJECT_DESCRIPTION`, `PARCEL`, `ADDRESS`, `CITY`, `ZIP`, `PROJECT_LOCATION`, `PROJECTADDDTTM`, `PROJECT_ISSDTTM`, `PROJECT_EXPDTTM`, `APPLICANT` FROM `citydata`.`api` WHERE `api`.`PROJECT_TYPE` = '".$term."';";

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

if(isset($_GET['term_1'])){

$term = strip_tags(stripslashes($_GET['user']));
display_projects($term);

}


?>