 <!--CSS FILES STARTS-->
<link rel="shortcut icon" type="image/gif" href="images/favicon.gif"/>
<link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen"/>
<link rel="stylesheet" id="skins-switcher" href="css/style.css" type="text/css" media="screen"/>
<!--CHOOSE WICH FONT YOU WANT TO USE AND DELETE THE REST FOR FASTER LOADING-->
<link href='http://fonts.googleapis.com/css?family=Coustard|Questrial|Gloria+Hallelujah|Rochester|Abel|Rationale|Bowlby+One+SC|Snippet|Leckerli+One|Redressed|Aubrey|Open+Sans+Condensed:300|Paytone+One|Brawler|Tienne|Hammersmith+One|Rokkitt|Varela|Kreon|Oswald|Sunshiney|PT+Sans+Narrow|Istok+Web|Amaranth|Josefin+Sans|Nova+Script|Muli|Nova+Mono|Pompiere|News+Cycle|Old+Standard+TT|Cedarville+Cursive|Dancing+Script|Droid+Sans|Architects+Daughter|Smythe|Caudex|IM+Fell+Double+Pica|Zeyada|Buda:300|IM+Fell+French+Canon+SC|Josefin+Slab|Syncopate|Jura|Arimo|Coming+Soon|Quattrocento|Gruppo|IM+Fell+English+SC|Nova+Slim|Cuprum|Rock+Salt|Droid+Serif|Geostar+Fill|Geostar|Alice|Andika|Comfortaa|Delius+Swash+Caps|Actor|Marvel|Tulpen+One|Smokum|Carme|Delius|Black+Ops+One|Federo|Gentium+Basic|Yellowtail|The+Girl+Next+Door|Rosario|Swanky+and+Moo+Moo|Annie+Use+Your+Telescope|Play|Kameron|Lobster+Two|Anton|Just+Me+Again+Down+Here|Bangers|Coda:800|Open+Sans|Bigshot+One|UnifrakturCook:700|Shanti|IM+Fell+French+Canon|IM+Fell+Double+Pica+SC|Love+Ya+Like+A+Sister|Expletus+Sans|Merriweather|Kranky|IM+Fell+DW+Pica+SC|Ovo|PT+Serif|Copse|VT323|Coda+Caption:800|Allerta+Stencil|Lato|Meddon|Stardos+Stencil|Nobile' rel='stylesheet' type='text/css'>
<!--GOOGLE FONTS-->
 
</head>
<body>
<div id="wrapper">
	<div class="center">
		<p class="header-text-left">
		<strong>Docunator.com | The Doc Bot</strong>
		</p>
	<ul id="header-icons">

	</ul>
		<div id="container">
			<!--WRAPPER-->
			<div id="header">
				<!-- HEADER  -->


				<div id="main_navigation" class="main-menu ">
					<!--  MAIN  NAVIGATION-->
					<ul>
<h6>
						<li><a href="home.php">Home</a></li>
						<li><a href="upload_form.php">Upload</a></li>
						<li><a href="category_list.php">Browse</a></li>
						<li><a href="user_form.php">Sign Up</a></li>
						<li><a href="login_form.php">Log In</a></li>
						<li><a href="file_list.php?user=joe">Your File List</a></li>
										<!-- LOGO -->
</h6>
						
					</ul>
				</div>
				<!-- MAIN NAVIGATION ENDS-->
			</div>
			<!-- HEADER ENDS-->
			<!-- MAIN CONTAINER -->
			<div id="content">
				<div class="one">
					<!-- COLUMNS CONTAINER STARTS-->
					<div id="headline_container">
					<div class="headline"> 
						<div class="headline_inner_center"> 
							<h3>Search <span class="colored">DOCUNATOR</span></h4>
							
		
							<form accept-charset="utf-8" method="get" action="http://doczine.com/analytics/search">
							<input id="query" name="query" size="50" maxlength="255" style="height: 26px; width: 300px; font-size: 12px;" value="" type="text">
							<input name="searchsubmit" value="SEARCH" type="submit" style="height: 28px; width: 80px">
							</form>
							<br>

							
						</div> 
				
					</div> 
				</div> 
					<!-- INTRO ENDS-->
				</div>
				<!-- COLUMNS CONTAINER ENDS-->
				<div class="one">
					<div class="one-fourth">
						<ul class="simple-nav">
				
						</ul>
					</div>

<?php

// make sure browsers see this page as utf-8 encoded HTML
header('Content-Type: text/html; charset=utf-8');

include('db.php');
include('html_output.php');
include('footer.php');
do_html_upper();

$limit = 500;
$query = isset($_REQUEST['q']) ? $_REQUEST['q'] : false;
$results = false;

if ($query)
{
  // The Apache Solr Client library should be on the include path
  // which is usually most easily accomplished by placing in the
  // same directory as this script ( . or current directory is a default
  // php include path entry in the php.ini)
  require_once('/var/www/mod/apache-solr-3.3.0/SolrPhpClient/Apache/Solr/Service.php');

  // create a new solr service instance - host, port, and webapp
  // path (all defaults in this example)
  $solr = new Apache_Solr_Service('192.168.1.120', 8983, '/solr');

  // if magic quotes is enabled then stripslashes will be needed
  if (get_magic_quotes_gpc() == 1)
  {
    $query = strip_tags(stripslashes($query));
  }

  // in production code you'll always want to use a try /catch for any
  // possible exceptions emitted  by searching (i.e. connection
  // problems or a query parsing error)
  try
  {

$start = 0;
$rows = 500;

$additionalParameters = array(
);

$results = $solr->search($query, $start, $rows, $additionalParameters);

        
  }
  catch (Exception $e)
  {
    // in production you'd probably log or email this error to an admin
        // and then show a special message to the user but for this example
        // we're going to show the full exception
        die("<html><head><title>SEARCH EXCEPTION</title><body><pre>{$e->__toString()}</pre></body></html>");
  }
}

?>

    
<?php

// display results
if ($results)
{
  $total = (int) $results->response->numFound;
  $start = min(1, $total);
  $end = min($limit, $total);
?>
    <div>Results <?php echo $start; ?> - <?php echo $end;?> of <?php echo $total; ?>:</div><br>
<?php
  // iterate result documents
  foreach ($results->response->docs as $doc)
  {
?>


<?php


    // iterate document fields / values
    foreach ($doc as $field => $value)
    {
$thumbnail = get_file_title($docs);


/*
   <field name="title" type="text" indexed="true" stored="true" multiValued="true"/>
   <field name="subject" type="text" indexed="true" stored="true"/>
   <field name="description" type="text" indexed="true" stored="true"/>
   <field name="comments" type="text" indexed="true" stored="true"/>
   <field name="author" type="textgen" indexed="true" stored="true"/>
   <field name="keywords" type="textgen" indexed="true" stored="true"/>
   <field name="category" type="textgen" indexed="true" stored="true"/>
   <field name="content_type" type="string" indexed="true" stored="true" multiValued="true"/>
   <field name="last_modified" type="date" indexed="true" stored="true"/>
   <field name="links" type="string" indexed="true" stored="true" multiValued="true"/>
  <field name="body" type="text" indexed="true" stored="true" multiValued="true"/>

*/
if($field != "") {

switch ($field) {

case "last_modified":
$last_modified = $value;
break;
case "content_type":
$content_type = $value;
break;
case "id":
$id = $value;
break;
default:
	}
	
	}

}
    
echo "<div class=\"mosaic-block fade\">";
echo "<a href=\"viewer.php?doc=".$id."\" class=\"mosaic-overlay\">";
echo "<div class=\"details\">";
echo "<h4>";
echo get_file_titlename($id);
echo "<br>";
echo get_file_taxo1($id);
echo "<br>";
echo $key;
echo "<br>";
echo "</h4>";
echo "<p>";
echo "Date Created: ";
echo $last_modified;
echo "<br>";
echo "Date Uploaded: ";
echo get_file_upload($id);
echo "<br>";
echo "Original File: ";
echo get_file_name($id);
echo "</p>";
echo "</div></a>";
echo "<div class=\"mosaic-backdrop\">";
echo "<img src='/bigdata/".$id."/".get_file_title($id)."jpg' align='left' alt='thumb'>";
echo "<img src='/bigdata/".$id."/".get_file_title($id)."-1.jpg' align='left' alt='thumb'>";
echo "</div>";
echo "<div class=\"clearfix\">";
echo "</div>";
echo "</div>";
  }
  

   
}

function get_file_title($docs)
{
$conn = db_connect();
$query = "SELECT short_name FROM `docunator`.`user_file` WHERE `user_file`.`system_file_name` = '".$docs."';";


if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $short_name);
    while (mysqli_stmt_fetch($stmt)) {
        return $short_name;
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

function get_file_titlename($docs)
{
$conn = db_connect();
$query = "SELECT file_title FROM `docunator`.`file_title` WHERE `file_title`.`system_file_name` = '".$docs."';";


if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $short_name);
    while (mysqli_stmt_fetch($stmt)) {
       	$file_title = str_replace("_", " ", $short_name);
        return $file_title;
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}



function get_file_taxo1($docs)
{
$conn = db_connect();
$query = "SELECT taxo_1, taxo_2 FROM `docunator`.`file_taxonomy` WHERE `file_taxonomy`.`system_file_name` = '".$docs."';";


if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $taxo1, $taxo2);
    while (mysqli_stmt_fetch($stmt)) {
        echo $taxo1;
        echo " / ";
        echo $taxo2;
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

function get_file_upload($docs)
{

$conn = db_connect();

$query = "SELECT `file_timestamp` FROM `docunator`.`file` WHERE `file`.`system_file_name` = '".$docs."';";

if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $file_timestamp);
		while (mysqli_stmt_fetch($stmt)) {
				return $file_timestamp;
		}
	 mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

function get_file_name($docs)
{

$conn = db_connect();

$query = "SELECT `user_file_name` FROM `docunator`.`user_file` WHERE `user_file`.`system_file_name` = '".$docs."';";

if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $file_timestamp);
		while (mysqli_stmt_fetch($stmt)) {
				return $file_timestamp;
		}
	 mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

do_html_lower();
do_html_footer();
?>

 <form  accept-charset="utf-8" method="get">
      <input id="q" name="q" type="text"  size="0" maxlength="0" style="height:0px;font-size:0px" value="<?php echo htmlspecialchars($query, ENT_QUOTES, 'utf-8'); ?>"/>
      <input type="submit" name="searchsubmit" value="SEARCH" style="height: 0px; width: 0px/>
    </form>
