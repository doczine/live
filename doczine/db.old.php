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

function db_connect()
{
   $result = new mysqli('192.168.1.100', 'docunator', 'X23n7dkpP42x7M4LH', 'docunator', 3306); 
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
