<?php
$tika = "/usr/local/bin/java -jar /usr/local/www/apache22/data/mod/tika-app-1.3.jar -j ".$file_new.".pdf";
		echo $tika;
		//system($tika, $fuck);
?>