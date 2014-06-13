<?php
//http://192.168.1.150:8983/solr/select?q=php&fq=id:1371099909_139ca3f8a4

include('db.php');
include('search_output.php');
include('search_functions.php');
require('/usr/local/www/apache22/data/mod/apache-solr-3.3.0/SolrPhpClient/Apache/Solr/Service.php');


$limit = 500;
$query = isset($_REQUEST['q']) ? $_REQUEST['q'] : false;
$start = isset($_REQUEST['start']) ? $_REQUEST['start'] : false;
$results = false;
$search = $query;

$conn1 = db_connect();

$i = 0;
do {
    $i++;

    $query = "SELECT `resume_seo_term` FROM `docunator`.`resume_seo_term` WHERE `resume_index` IS NULL LIMIT 1;";

    if ($stmt = mysqli_prepare($conn1, $query)) {
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $resume_seo_term);
        while (mysqli_stmt_fetch($stmt)) {
            echo $resume_seo_term;
        }
        mysqli_stmt_close($stmt);
    }

    $query = "UPDATE `docunator`.`resume_seo_term` SET `resume_index` = 'Y' WHERE `resume_seo_term`.`resume_seo_term` = '".$resume_seo_term."';";

    if ($stmt = mysqli_prepare($conn1, $query)) {
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }


if ($resume_seo_term) {

$solr = new Apache_Solr_Service('192.168.1.150', 8983, '/solr');
$query = strip_tags(stripslashes($resume_seo_term));

$header = "Search Results: ".$query;
$description1 = "Doczine.com search results for: ".$query;
$meta = "Doczine search, ".$query;
$description2 = "Doczine File Search Results";
$author = "BorgEye.com";

//do_html_upper($query, $description1, $meta, $description2, $author);
do_html_search($query, $description1, $meta, $description2, $author, $header);

  try
  {


$rows = 20;

$additionalParameters = array();

//works
//$additionalParameters = array('fq'=>array('attr_stream_source_info:myfile','content_type:application/pdf'));

//adding wild cards:
//$additionalParameters = array('fq'=>array('title1:*jesus christ*','content_type:application/pdf'));

//$additionalParameters['fq'] = 'attr_stream_source_info:myfile';


$additionalParameters = array(
    'fq' => 'id:1371137958_c66058621b'
);


$results = $solr->search($query, $start, $rows, $additionalParameters);
        
  }
  catch (Exception $e)
  {
        die("<html><head><title>SEARCH EXCEPTION</title><body><pre>{$e->__toString()}</pre></body></html>");
  }
}

$i = 0;
if ($results)
{

  $total = (int) $results->response->numFound;
  $start = min($start, $total);
  $end = min($limit, $total);

echo "<div>Search Term: "; 
echo $search;
echo "<br>";
echo "Results: ";
echo $start; 
echo " - ";
echo $end;
echo " of ";
echo $total;
echo "</div><br>";

  // iterate result documents
  foreach ($results->response->docs as $doc)
  {

    // iterate document fields / values
    foreach ($doc as $field => $value)
    {

if($field != "") {

switch ($field) {
case "id":
$id = $value;
break;
case "snip":
$snip = $value;
break;
case "attr_body":
$body = $value;
//echo "<textarea style='width:800px;'>";
//echo $field;
//echo ": ";
//echo $value;
//echo "</textarea>";
//echo "<br>";
//break;
default: 
//echo $field;
//echo ": ";
//echo $value;
//echo "<br>";

		}
	
	}

}
echo "<br>";


	$i = $i + 1;
	//echo $content_type;
		display_search_results($id, $i, $search, $snip, $body);
	}   
}



} while ($i < 100);

?>