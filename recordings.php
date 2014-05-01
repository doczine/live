<?php
session_start();
$_SESSION['views'] = 1;
//echo $_SESSION['views'];
//echo $_SESSION['valid_user'];
require("db.php");
$conn = db_235();
if(isset($_POST['password'])){
	$user_post = strip_tags(stripslashes($_POST['username']));
	$password = strip_tags(stripslashes($_POST['password']));
	$query = "SELECT `user_name` FROM `opserv`.`user` WHERE `user`.`user_name` = '".$user_post."' AND `user`.`password` = '".$password."';";
	if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $user);
		while (mysqli_stmt_fetch($stmt)) {
			if($user == $user_post) {
				$_SESSION['valid_user'] = $user;
			}
		}
		mysqli_stmt_close($stmt);
	}
}
else
{
	//echo $_SESSION['valid_user'];
}
$table = "";
$form = "";
if($_SESSION['valid_user'] == "cti"){
$offset = 0;
$sort_by = 'start_time';
$sort_dir = 'desc';
$row_counter = 0;
$mysqltime = date("Y-m-d");
$timeline_subtract = "P3M";
$date = new DateTime($mysqltime);
$interval = new DateInterval($timeline_subtract);
$date->sub($interval);
$mysqltime_60 = $date->format('Y-m-d');
$first_date = strtotime($mysqltime);
$first_date = strtotime('+1 day', $first_date);
$second_date = strtotime('-1 day', $first_date);
$first_date = date('Y-m-d', $first_date);
$second_date = date('Y-m-d', $second_date);
if(isset($_GET['sort_by'])){
	strip_tags(stripslashes($_GET["sort_by"]));
}
if(isset($_GET['sort_dir'])){
	strip_tags(stripslashes($_GET["sort_dir"]));
}
if(isset($_GET['date_start'])){
	strip_tags(stripslashes($_GET["date_start"]));
}
if(isset($_GET['date_end'])){
	strip_tags(stripslashes($_GET["date_end"]));
}
if(isset($_GET['limit'])){
	$limit = strip_tags(stripslashes($_GET["limit"]));
}
else
{
	$limit = 100;
}
if(isset($_GET['offset'])){
	$offset = strip_tags(stripslashes($_GET["offset"]));
}
if(isset($_GET['ani'])){
	$ani_get = strip_tags(stripslashes($_GET["ani"]));
}
if(isset($_GET['destination'])){
	$destination_get = strip_tags(stripslashes($_GET["destination"]));
}
if(isset($_GET['assigned_agent'])){
	$assigned_agent_get = strip_tags(stripslashes($_GET["assigned_agent"]));
}
/*
	query = "select unique_id, brand, ani, destination, start_time, timediff(end_time, start_time), assigned_agent from redis_dump where"
if form.has_key('date_start'):
	query += " start_time >= '%s' and" % form['date_start']
if form.has_key('date_end'):
	query += " start_time <= '%s' and" % form['date_end']
if form.has_key('brand') and form['brand'] <> 'All':
	query += " brand = '%s' and" % form['brand']
query += " 1=1"
query += " order by %s" % sort_by
query += " %s" % sort_dir
query += " limit %d" % limit
query += " offset %d" % offset
*/
//search by ani 7029428560
//search by destination 7029428560
//filter by billing_type convert to text value 
//disposition
//login specific for kgb and one specific for centurylink and one for small world and one for admin and one for small world/international guy
//the link for the recordings for wave files
//gsm to wav conversion on the fly
//http://dialer.customteleconnect.com/oprecordings/AGENT-LIVE_54-1388165617.8784.wav
$query = "SELECT unique_id, brand, ani, destination, start_time, assigned_agent, disposition FROM `opserv`.`redis_dump` WHERE 1=1 ";
if(isset($_GET['brand']) && $_GET['brand'] != ""){
	$brand = strip_tags(stripslashes($_GET["brand"]));
	$query .= " AND brand = '".$brand."'";
}
if(isset($_GET['ani']) && $_GET['ani'] != ""){
	$ani = strip_tags(stripslashes($_GET["ani"]));
	$query .= " AND ani = '".$ani."'";
}
if(isset($_GET['assigned_agent']) && $_GET['assigned_agent'] != ""){
	$assigned_agent_get = strip_tags(stripslashes($_GET["assigned_agent"]));
	$query .= " AND assigned_agent = '".$assigned_agent_get."'";
}
if(isset($_GET['date_start']) && isset($_GET['date_end'])){
	$date_start = strip_tags(stripslashes($_GET["date_start"]));
	$date_end = strip_tags(stripslashes($_GET["date_end"]));
	$query .= " AND start_time >= '".$date_start." 00:00:00' AND start_time <= '".$date_end." 00:00:00' ";
}
else
{
	$date_start = $second_date;
	$date_end = $first_date;
	$query .= " AND start_time >= '".$date_start." 00:00:00' AND start_time <= '".$date_end." 00:00:00' ";
}
if(isset($_GET['destination']) && $_GET['destination'] != ""){
	$destination_get = strip_tags(stripslashes($_GET["destination"]));
	$query .= " AND destination = '".$destination_get."'";
}
if(isset($_GET['disposition']) && $_GET['disposition'] != ""){
	$disposition_get = strip_tags(stripslashes($_GET["disposition"]));
	$query .= " AND disposition = '".$disposition_get."'";
}
if(isset($_GET['billing_type']) && $_GET['billing_type'] != ""){
	$billing_type_get = strip_tags(stripslashes($_GET["billing_type"]));
	$query .= " AND billing_type = '".$billing_type_get."'";
}
$query .= " ORDER BY start_time DESC";
if(isset($_GET['limit']) && $_GET['limit'] != ""){
	$query .= " LIMIT ".$limit;
}
else
{
	$query .= " LIMIT ".$limit;
}
if(isset($_GET['offset']) && $_GET['offset'] != ""){
	$query .= " OFFSET ".$offset." ";
}
//echo $query;
if ($stmt = mysqli_prepare($conn, $query)) {
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $unique_id, $brand, $ani, $destination, $start_time, $assigned_agent, $disposition);
	while (mysqli_stmt_fetch($stmt)) {
		$table .= "<tr class='gradeC'>";
		$table .= "<td>".$brand."</td>";
		$table .= "<td>".$ani."</td>";
		$table .= "<td>".$destination."</td>";
		$table .= "<td>".$start_time."</td>";
		$table .= "<td>".$assigned_agent."</td>";
		$table .= "<td>".$disposition."</td>";
		$filename = "/var/www/live/recordings/AGENT-".$unique_id.".wav";
		if (file_exists($filename)) {
			$table .= "<td><a href='http://dialer.customteleconnect.com/oprecordings/AGENT-".$unique_id.".wav'>Listen&nbsp;to&nbsp;Call</a></td>";
		} else {
			$table .= "<td>No&nbsp;Recording</td>";
		}
		$table .= "</tr>";
	}
	mysqli_stmt_close($stmt);
}
$form .= "<form action='#' method='get'>";
$form .= "
<table>
<thead>
<tr>
	<th>Assigned&nbsp;Agent</th>
	<th>Billing&nbsp;Type</th>
	<th>Brand</th>
	<th>Disposition</th>
</tr>
</thead>
<tbody>";
$form .= "<tr><td>";
$form .= "<select name='assigned_agent' style='width:200px;'>";
$query = "SELECT distinct(assigned_agent) FROM `opserv`.`redis_dump` ORDER BY assigned_agent ASC;";
	if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $assigned_agent_val);
		while (mysqli_stmt_fetch($stmt)) {
		$form .= "<option>".$assigned_agent_val."</option>";
		}
		mysqli_stmt_close($stmt);
	}
$form .= "</select>";
$form .= "</td>";
$form .= "<td>";
$form .= "<select name='billing_type' style='width:200px;'>";
$query = "SELECT distinct(billing_type) FROM `opserv`.`redis_dump` ORDER BY billing_type ASC;";
	if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $billing_type_val);
		while (mysqli_stmt_fetch($stmt)) {
		$form .= "<option>".$billing_type_val."</option>";
		}
		mysqli_stmt_close($stmt);
	}
$form .= "</select>";
$form .= "</td>";
$form .= "<td>";
$form .= "<select name='brand' style='width:200px;'>";
$query = "SELECT distinct(brand) FROM `opserv`.`redis_dump` ORDER BY brand ASC;";
	if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $brand_val);
		while (mysqli_stmt_fetch($stmt)) {
		$form .= "<option>".$brand_val."</option>";
		}
		mysqli_stmt_close($stmt);
	}
$form .= "</select>";
$form .= "</td>";
$form .= "<td>";
$form .= "<select name='disposition' style='width:200px;'>";
$query = "SELECT distinct(disposition) FROM `opserv`.`redis_dump` ORDER BY disposition ASC;";
	if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $disposition_val);
		while (mysqli_stmt_fetch($stmt)) {
		$form .= "<option>".$disposition_val."</option>";
		}
		mysqli_stmt_close($stmt);
	}
$form .= "</select>";
$form .= "</td>";
$form .= "</tr>";
$form .= "</tbody>";
$form .= "</table>";
$form .= "
<table>
<thead>
<tr>
	<th style='width:150px;'>Offset:</th>
	<th style='width:150px;'>Rows:</th>
	<th style='width:150px;'>Date&nbsp;Start:</th>
	<th style='width:150px;'>Date&nbsp;End:</th>
	<th style='width:150px;'>Search&nbsp;ANI:&nbsp;</th>
	<th style='width:150px;'>Search&nbsp;Destination:&nbsp;</th>
</tr>
</thead>
<tbody>";
$form .= "<td>";
$form .= "<input type='text' size='18' value='".$offset."' name='offset'>";
$form .= "</td>";
$form .= "<td>";
$form .= "<input type='text' size='18' value='".$limit."' name='limit'>";
$form .= "</td>";
if(isset($_GET['key_api'])){
	$key_api = strip_tags(stripslashes($_GET["key_api"]));
}
$form .= "<td>";
$form .= "<input type='text' size='18' value='".$date_start."' name='date_start'>";
$form .= "</td>";
$form .= "<td>";
$form .= "<input type='text' size='18' value='".$date_end."' name='date_end'>&nbsp;";
$form .= "</td>";
$form .= "<td>";
$form .= "<input type='text' size='18' value='".$ani_get."' name='ani'>&nbsp;";
$form .= "</td>";
$form .= "<td>";
$form .= "<input type='text' size='18' value='".$destination_get."' name='destination'>";
$form .= "</td>";
$form .= "</tr>";
$form .= "</tbody>";
$form .= "</table>";
$form .= "<br>";
$form .= "<input type='submit' value='Search Filter' style='width:815px; height:30px;'>";
$form .= "</form>";
}
$form .= "You are logged in as: ".$_SESSION['valid_user'];
//echo $table;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link rel="shortcut icon" type="image/ico" href="" />
		<title>CTI Recordings Warehouse</title>
		<style type="text/css" title="currentStyle">
			@import "media/css/demo_page.css";
			@import "media/css/demo_table_jui.css";
			@import "examples_support/themes/smoothness/jquery-ui-1.8.4.custom.css";
		</style>
		<script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="media/js/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				oTable = $('#example').dataTable({
					"bJQueryUI": true,
					"sPaginationType": "full_numbers",
					"bPaginate": false
				});
			} );
		</script>
	</head>
	<body id="dt_example">
		<div id="container">
			<h1>CTI Recordings</h1>
			<?php echo $form; ?>
			<div class="demo_jui">
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr>
						<th>Brand</th>
						<th>Ani</th>
						<th>Destination</th>
						<th>Start&nbsp;Time</th>
						<th>Assigned&nbsp;Agent</th>
						<th>Disposition</th>
						<th>Unique&nbsp;ID</th>
					</tr>
				</thead>
				<tbody>
				<?php echo $table; ?>
				</tbody>
			</table>
			</div>
			<div class="spacer"></div>
		</div>
	</body>
</html>



<!--
select unique_id, brand, ani, destination, start_time, timediff(end_time, start_time), assigned_agent from redis_dump where 1=1 order by start_time desc limit 40 offset 0

<%
username = None
if session.has_key('rec_auth'):
    session_id = session['rec_auth']
    username = r.get('RECSESSION:%s:username' % session_id)
    if username:
        r.expire('RECSESSION:%s:username' % session_id, 60*20)
if not username:
    psp.redirect('recordings_login.psp')
#done    
%>
<%


def get_row_class():
	global row_counter
	row_counter += 1
	if row_counter%2:
		return ' class="striped"'
	else:
		return ''

def recording_link(uid):
	fname = "oprecordings/AGENT-%s.wav" % str(uid)
	if os.path.exists('/var/www/%s' % fname):
		return '<a target="_NEW" href="%s">listen<a>' % fname
	else:
		return 'NR'

if username == 'smallworld':
	query = "select unique_id, company_name, redis_dump.ani, destination, start_time, timediff(end_time, start_time), assigned_agent from redis_dump,osdata3_copy where redis_dump.ani = osdata3_copy.ani and company_name = 'Smallworld' and brand like 'Inter%' and"
else:
	query = "select unique_id, brand, ani, destination, start_time, timediff(end_time, start_time), assigned_agent from redis_dump where"
if form.has_key('date_start'):
	query += " start_time >= '%s' and" % form['date_start']
if form.has_key('date_end'):
	query += " start_time <= '%s' and" % form['date_end']
if form.has_key('brand') and form['brand'] <> 'All':
	query += " brand = '%s' and" % form['brand']
query += " 1=1"
query += " order by %s" % sort_by
query += " %s" % sort_dir
query += " limit %d" % limit
query += " offset %d" % offset


con = MySQLdb.connect(host="10.5.1.235", db="opserv", user="cti", passwd="E70fb")
cur = con.cursor()
%>
<body>
<h1>CTI Recordings</h1>
logged in as: <%=username%> <a href="recordings_login.psp">logout</a>
<form action="#">

rows:<input type="text" size="3" value="<%=limit%>" name="limit">
|
offset:<input type="text" size="4" value="<%=offset%>" name="offset">
<input type="submit" value="filter">
</form>
<table>
<tr><th>Company</th><th>ANI</th><th>DEST</th><th>Start</th><th>Duration</th><th>Agent</th><th>Recording</th></tr>

<%
cur.execute(query)
recs = cur.fetchall()
for rec in recs:
 %>
<tr<%=get_row_class()%>>
  <td><abbr title="<%=rec[0]%>"> <%=rec[1]%> </abbr></td>
  <td> <%=rec[2]%> </td>
  <td> <%=rec[3]%> </td>
  <td> <%=rec[4]%> </td>
  <td> <%=rec[5]%> </td>
  <td> <%=rec[6]%> </td>
  <td> <%=recording_link(rec[0])%> </td></tr>
<%
#done
%>

</table>

</body>
</html>

*/