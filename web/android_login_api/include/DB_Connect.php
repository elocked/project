<?php
class DB_Connect{
	// Constructeur
	function __construct(){
		
	}
	
	// Destructor
	function __destruct(){
		// $this->close();
	}
	
	// Connecting to database
	public function connect(){
		require_once 'include/Config.php';
		//Connecting to mysql
		$con = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die(mysql_error());
		mysql_select_db(DB_DATABASE) or die(mysql_error());
		//return database handler
		return $con;
	}
	//Closing database connection
	public function close(){
		mysql_close;
	}
}
?>