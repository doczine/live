<?php

	$f = '/var/www/bigdata/1';
	$io = popen ( '/usr/bin/du -sk ' . $f, 'r' );
	$size = fgets ( $io, 4096);
	$size = substr ( $size, 0, strpos ( $size, ' ' ) );
	pclose ( $io );
	echo 'Directory: ' . $f . ' => Size: ' . $size;

?>