<?php
@set_time_limit(0);
// Report all PHP errors (see changelog)
error_reporting(E_ALL);

include("db.php");
include('search_output.php');
include('search_functions.php');
require_once('/usr/local/www/apache22/data/mod/apache-solr-3.3.0/SolrPhpClient/Apache/Solr/Service.php');
$solr = new Apache_Solr_Service('192.168.1.150', 8983, '/solr');
$query = "";

$urlindex = "";
$limit = 1000;
$rows = 1000;
$results = false;
$search = $query;

$conn = db_connect();


$i = 0;
do {
    $i++;

    $query = "SELECT `tag_term` FROM `docunator`.`file_tag_terms` WHERE `file_tag_terms`.`tag_indexed` IS NULL LIMIT 1;";

    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $tag_term);
        while (mysqli_stmt_fetch($stmt)) {
            $tag_term1 = $tag_term;
            $query1 = $tag_term;

        }
        mysqli_stmt_close($stmt);
    }

$query = str_replace("'", "", $query1);
echo $query;
$tag_term = str_replace("'", "", $tag_term1);
echo $tag_term;

    $query = "UPDATE `docunator`.`file_tag_terms` SET `tag_indexed` = 'Y' WHERE `file_tag_terms`.`tag_term` = '".$tag_term."';";

    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    $query = $tag_term;

    $query = "\"".$query."\"";

    if ($query) {
        try {
            $additionalParameters = array();
            $results = $solr->search($query, $start, $rows, $additionalParameters);
        }
        catch (Exception $e)
        {
            die("<html><head><title>SEARCH EXCEPTION</title><body><pre>{$e->__toString()}</pre></body></html>");
        }
    }

    if ($results) {
        $total = (int) $results->response->numFound;
        $start = min($start, $total);
        $end = min($limit, $total);

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
							echo $id;
							echo $tag_term;
							
                                if ($stmt = mysqli_prepare($conn, "INSERT INTO `docunator`.`file_seo` (`system_file_name`, `carrot_seo_term`) VALUES (?,?)")); {
                                    mysqli_stmt_bind_param($stmt, "ss", $id, $tag_term);
                                    mysqli_stmt_execute($stmt);
                                    mysqli_stmt_close($stmt);
                                }

                            break;
                        default:


                    }

                }

            }
            //$i = $i + 1;
            //display_search_results($id, $i, $search, $snip, $body);
            //
        }
    }


} while ($i < 10000);

mysqli_close($conn);
?>



