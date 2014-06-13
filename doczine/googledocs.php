<?php

include("db.php");


function get_stats($table) {

$conn = db_connect();

$query = "SELECT COUNT(*) FROM `docunator`.`".$table."`;";

		if ($stmt = mysqli_prepare($conn, $query)) {
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $count);
			while (mysqli_stmt_fetch($stmt)) {
				echo "<tr>";
				echo "<td>";
					echo $table;
				echo "</td>";
				echo "<td>";
					echo $count;
				echo "</td>";
				echo "</tr>";			
			}
			mysqli_stmt_close($stmt);
		}
		mysqli_close($conn);
	}
	
function get_filetype_stats() {

$conn = db_connect();

//$query = "SELECT COUNT(*) FROM `docunator`.`file` WHERE `file_mime_type` = '".$type."';";

$query = "SELECT file_mime_type, COUNT(*) FROM `docunator`.`file` GROUP BY file_mime_type;";

		if ($stmt = mysqli_prepare($conn, $query)) {
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $type, $count);
			while (mysqli_stmt_fetch($stmt)) {
				echo "<tr>";
				echo "<td>";
					echo $type;
				echo "</td>";
				echo "<td>";
					echo $count;
				echo "</td>";
				echo "</tr>";			
			}
			mysqli_stmt_close($stmt);
		}
		mysqli_close($conn);
	}	


	
function get_date_stats() {

$conn = db_connect();

$query = "SELECT DATE_FORMAT(file_timestamp, '%b/%e/%Y') AS date_added_formatted, COUNT(*) FROM `docunator`.`file` GROUP BY date_added_formatted ORDER BY file_timestamp ASC;";

		if ($stmt = mysqli_prepare($conn, $query)) {
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $type, $count);
			while (mysqli_stmt_fetch($stmt)) {
				echo "<tr>";
				echo "<td>";
					echo $type;
				echo "</td>";
				echo "<td>";
					echo $count;
				echo "</td>";
				echo "</tr>";			
			}
			mysqli_stmt_close($stmt);
		}
		mysqli_close($conn);
	}	



echo "<table>";

			echo "<tr>";
			echo "<td>";
				echo "Table ID";
			echo "</td>";
			echo "<td>";
				echo "Record Count";
			echo "</td>";
			echo "</tr>";

get_stats("admin");
get_stats("file");
get_filetype_stats();
get_stats("file_comment");
get_stats("file_counter");
get_stats("file_hitcounter");
get_stats("file_link");
get_stats("file_location");
get_stats("file_metadata");
get_stats("file_permission");
get_stats("file_revision");
get_stats("file_seo");
get_stats("file_seo_terms");
get_stats("file_snippet");
get_stats("file_tag");
get_stats("file_taxonomy");
get_stats("file_title");
get_stats("file_transferred");
get_stats("file_url");
get_stats("password");
get_stats("reset_code");
get_stats("results");
get_stats("sessions");
get_stats("taxo_1");
get_stats("taxo_2");
get_stats("user");
get_stats("user_file");
get_stats("user_search_terms");
get_stats("user_sign_up");

echo "</table>";




echo "<table>";

			echo "<tr>";
			echo "<td>";
				echo "Upload Date";
			echo "</td>";
			echo "<td>";
				echo "Upload Count";
			echo "</td>";
			echo "</tr>";

get_date_stats();

echo "</table>";

?>