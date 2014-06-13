<?php 
class SessionManager {

		function db_connect()
		{
		   $result = new mysqli('localhost', 'docunator', 'X23n7dkpP42x7M4LH', 'docunator'); 
		   if (!$result)
			 throw new Exception('Could not connect to database server');
		   else
			 return $result;
		}

   var $life_time;
   function SessionManager() {
      // Read the maxlifetime setting from PHP
       $this->life_time = get_cfg_var("session.gc_maxlifetime");
      // Register this object as the session handler
       session_set_save_handler( 
         array( &$this, "open" ), 
         array( &$this, "close" ),
         array( &$this, "read" ),
         array( &$this, "write"),
         array( &$this, "destroy"),
         array( &$this, "gc" )
        );
   }

   function open( $save_path, $session_name ) {
      global $sess_save_path;
      $sess_save_path = $save_path;      // Don't need to do anything. Just return TRUE.
      return true;
   }

   function close() {
      return true;
   }    
   
   function read($id) {
   $conn = db_connect();
      // Set empty result
	$data = '';
      // Fetch session data from the selected database
	$time = time();
	$newid = $id;
      
	$query = "SELECT `session_data` FROM `docunator`.`sessions` WHERE `session_id` = '".$newid."' AND `expires` > ".$time.";";

	if ($stmt = mysqli_prepare($conn, $query)) {
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $session_data);
		while (mysqli_stmt_fetch($stmt)) {
			$data = $session_data;
		}
		return $data;
		mysqli_stmt_close($stmt);
	}
	mysqli_close($conn);
}

   function write($id, $data) {
   $conn = db_connect();
      // Build query                
      $time = time() + $this->life_time;       
      $newid = $id;
      $newdata = $data;
      	if ($stmt = mysqli_prepare($conn, "REPLACE `docunator`.`sessions` (`session_id`,`session_data`,`expires`) VALUES (?,?,?)")); {
			mysqli_stmt_bind_param($stmt, "sss", $newid, $newdata, $time);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		mysqli_close($conn);
		return TRUE;
   }

   function destroy($id) {
      // Build query
      $conn = db_connect();
      $newid = $id;
      $query = "DELETE FROM `docunator`.`sessions` WHERE `sessions`.`session_id` = '".$newid."';";
           
        if ($stmt = mysqli_prepare($conn, $query)); {
			mysqli_stmt_bind_param($stmt, "s", $newid);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		mysqli_close($conn);
      return TRUE;
   }
   
   function gc() {
   $conn = db_connect();
      // Garbage Collection
     // Build DELETE query.  Delete all records who have passed
     //  the expiration time  
      $query = 'DELETE FROM `docunator`.`sessions` WHERE `expires` < UNIX_TIMESTAMP();';
           
        if ($stmt = mysqli_prepare($conn, $query)); {
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		mysqli_close($conn);
       return true;
    }
}


?>
