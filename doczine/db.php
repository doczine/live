<?php

function db_connect_local()
{
   $result = new mysqli('localhost', 'docunator', 'X23n7dkpP42x7M4LH', 'docunator'); 
   if (!$result)
     throw new Exception('Could not connect to database server');
   else
     return $result;
}

function db_connect_scraper_97()
{
   $result = new mysqli('192.168.1.97', 'docunator', 'X23n7dkpP42x7M4LH', 'scraper', 3306); 
   if (!$result)
     throw new Exception('Could not connect to database server');
   else
     return $result;
}

function db_connect_scraper_100()
{
   $result = new mysqli('192.168.1.100', 'docunator', 'X23n7dkpP42x7M4LH', 'scraper', 3306); 
   if (!$result)
     throw new Exception('Could not connect to database server');
   else
     return $result;
}



//174.68.111.39
function db_connect_100()
{
   $result = new mysqli('192.168.1.100', 'docunator', 'X23n7dkpP42x7M4LH', 'docunator', 3306); 
   if (!$result) 
     throw new Exception('Could not connect to database server');
   else
     return $result;
}

function db_connect_110()
{
   $result = new mysqli('192.168.1.110', 'docunator', 'X23n7dkpP42x7M4LH', 'docunator'); 
   if (!$result) 
     throw new Exception('Could not connect to database server');
   else
     return $result;
}

function db_connect_120()
{
   $result = new mysqli('192.168.1.120', 'docunator', 'X23n7dkpP42x7M4LH', 'docunator', 3306); 
   if (!$result) 
     throw new Exception('Could not connect to database server');
   else
     return $result;
}

function db_connect_130()
{
   $result = new mysqli('192.168.1.130', 'docunator', 'X23n7dkpP42x7M4LH', 'docunator', 3306); 
   if (!$result) 
     throw new Exception('Could not connect to database server');
   else
     return $result;
}

function db_connect()
{
   $result = new mysqli('127.0.0.1', 'docunator', 'X23n7dkpP42x7M4LH', 'docunator', 3306); 
   if (!$result)
     throw new Exception('Could not connect to database server');
   else
     return $result;
}


function db_connect_replicate()
{
   $result = new mysqli('192.168.1.110', 'docunator', 'X23n7dkpP42x7M4LH', 'docunator', 3306); 
   if (!$result)
     throw new Exception('Could not connect to database server');
   else
     return $result;
}


function db_connect_scraper_local()
{
   $result = new mysqli('127.0.0.1', 'docunator', 'X23n7dkpP42x7M4LH', 'scraper', 3306); 
   if (!$result)
     throw new Exception('Could not connect to database server');
   else
     return $result;
}

function db_connect_ej()
{
   $result = new mysqli('98.176.233.48', 'docunator', 'Newport91915!@#', 'docunator', 3306); 
   if (!$result) 
     throw new Exception('Could not connect to database server');
   else
     return $result;
}

/*

<?php

function db_connect_local()
{
   $result = new mysqli('localhost', 'docunator', 'X23n7dkpP42x7M4LH', 'docunator'); 
   if (!$result)
     throw new Exception('Could not connect to database server');
   else
     return $result;
}

function db_connect_scraper()
{
   $result = new mysqli('localhost', 'docunator', 'X23n7dkpP42x7M4LH', 'scraper'); 
   if (!$result)
     throw new Exception('Could not connect to database server');
   else
     return $result;
}


//174.68.111.39
function db_connect_100()
{
   $result = new mysqli('localhost', 'docunator', 'X23n7dkpP42x7M4LH', 'docunator'); 
   if (!$result) 
     throw new Exception('Could not connect to database server');
   else
     return $result;
}

function db_connect()
{
   $result = new mysqli('localhost', 'docunator', 'X23n7dkpP42x7M4LH', 'docunator'); 
   if (!$result)
     throw new Exception('Could not connect to database server');
   else
     return $result;
}


function db_connect_replicate()
{
   $result = new mysqli('192.168.1.110', 'docunator', 'X23n7dkpP42x7M4LH', 'docunator', 3306); 
   if (!$result)
     throw new Exception('Could not connect to database server');
   else
     return $result;
}

?>


*/

?>
