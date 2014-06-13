<?php

// make sure browsers see this page as utf-8 encoded HTML
header('Content-Type: text/html; charset=utf-8');

include('db.php');
include('search_output.php');
include('search_functions.php');

$limit = 500;
$query = isset($_REQUEST['q']) ? $_REQUEST['q'] : false;
$results = false;
$search = $query;

if ($query) {

require_once('/var/www/mod/apache-solr-3.3.0/SolrPhpClient/Apache/Solr/Service.php');

$solr = new Apache_Solr_Service('localhost', 8983, '/solr');
$query = strip_tags(stripslashes($query));

$description1 = "Doczine search results for: ".$query;
$meta = "Doczine search, ".$query;
$description2 = "Doczine File Search Results";
$author = "Borg Eye";

//do_html_upper($query, $description1, $meta, $description2, $author);
do_html_search();

  try
  {
 
$start = 0;
$rows = 100;

$additionalParameters = array();

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
  $start = min(1, $total);
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



	$i = $i + 1;
	//echo $content_type;
		display_search_results($id, $i, $search);
	}   
}


?>
