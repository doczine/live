<?php

$i = 0;
do {
    $i++;
    $index = "curl http://localhost/scraper.php";
	system($index, $retval);
	sleep(20);
} while ($i < 100000);


?>
