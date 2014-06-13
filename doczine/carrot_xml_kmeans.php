<?php
require_once("db.php");

session_start();

$conn = db_connect();
 
$_SESSION['variable'] = "";

function show_keys($ar){
$conn = db_connect();
   echo "<table width='100%' border='1' bordercolor='#6699CC' cellspacing='0' cellpadding='5'><tr valign='top'>";
      foreach ($ar as $k => $v ) {
         echo "<td align='center' bgcolor='#EEEEEE'>
           <table border='2' cellpadding='3'><tr><td bgcolor='#FFFFFF'><font face='verdana' size='1'>
              " . $k . "
           </font></td></tr></table>";
           //echo $k;
           //echo $v;
           
           if(isset($ar['phrase'])){
           		$_SESSION['variable'] = $ar['phrase'];
           }
           
           
           if(isset($ar['refid'])){
           		
           		$refid = $ar['refid'];        		
	           $seoterm = $_SESSION['variable'];
	           
					if ($stmt = mysqli_prepare($conn, "INSERT INTO `docunator`.`file_seo_kmeans` (`system_file_name`, `kmeans_seo_term`) VALUES (?,?)")); {
					mysqli_stmt_bind_param($stmt, "ss", $refid, $seoterm);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_close($stmt);
					}
	        	
           }

           if (is_array($ar[$k])) {
              show_keys ($ar[$k]);
	         }
         echo "</td>";
      }
   echo "</tr></table>";
}


function multiarray_keys($ar) {
           
    foreach($ar as $k => $v) {
        $keys[] = $k;
        if (is_array($ar[$k]))
            $keys = array_merge($keys, multiarray_keys($ar[$k]));
    }
    return $keys;
} 

function objectsIntoArray($arrObjData, $arrSkipIndices = array())
{
    $arrData = array();
   
    // if input is object, convert into array
    if (is_object($arrObjData)) {
        $arrObjData = get_object_vars($arrObjData);
    }
   
    if (is_array($arrObjData)) {
        foreach ($arrObjData as $index => $value) {
            if (is_object($value) || is_array($value)) {
                $value = objectsIntoArray($value, $arrSkipIndices); // recursive call
            }
            if (in_array($index, $arrSkipIndices)) {
                continue;
            }
            $arrData[$index] = $value;
        }
    }
    return $arrData;
}

$xmlUrl = "/root/carrot/output/2.xml";
$xmlStr = file_get_contents($xmlUrl);
$xmlObj = simplexml_load_string($xmlStr);
$arrXml = objectsIntoArray($xmlObj);
//print_r($arrXml);
//var_dump($arrXml);
//$whyuknow = multiarray_keys($arrXml);
//print_r($whyuknow);

$whyuno = show_keys($arrXml);
echo $whyuno;

foreach ($arrXml as $i => $row)
{


  //echo array_shift(array_keys($i));

/*
    $title = $row['refid'];
    echo $title;
    $trim = $row['phrase'];
    echo $trim;
    $host = $row['score'];
    echo $host;
    $trimmed = $row['title'];
    echo $trimmed;
    $trimmed1 = $row['phrase'];
    echo $trimmed1;
    $titleasdf = $row[$i];
    echo $titleasdf;
    
    var_dump($row);
*/

}
    
    
    
/*
foreach ($arrXml as $inner_array) {
    echo reset($inner_array); //apple, orange, pear
    echo end($inner_array); //My Apple, View All Oranges, A Pear
}
*/


/*
$last = count($arrXml) - 1;

foreach ($arrXml as $i => $row)
{
    $isFirst = ($i == 0);
    $isLast = ($i == $last);

    echo $row[0][0];
    echo $row[0][1];
}
*/


/*
foreach ($arrXml as $key => $val) {
    print "$key = $val\n";
}
*/


/*
foreach($arrXml as $key=>$value)
{
    unset($arrXml[$key + 1]);
    echo $key;
    echo $value;
} 
*/
?> 