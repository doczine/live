<?php

$i = 0;
do {
    $i++;
    $index = "curl http://localhost/filedownload.php";
	system($index, $retval);

    $index = "curl http://localhost/filedownload.php";
	system($index, $retval);

    $index = "curl http://localhost/filedownload.php";
	system($index, $retval);	

} while ($i < 100000);
//test
 
?>
