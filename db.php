<?php

function db_235()
{
   $result = new mysqli('10.5.1.235', '', '', 'opserv', 3306); 
   if (!$result)
     throw new Exception('Could not connect to database server');
   else
     return $result;
}


?>
