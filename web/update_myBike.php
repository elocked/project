<?php
/*
 * Following code will list all the bikes the use own
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once 'include/db_connect.php';

 
// connecting to db
$db = new DB_CONNECT();

// check for post data
if(isset($_POST["cid"]))
{
	//get user ID
	$cid = $_POST["cid"];
	
	// include db handler
	require_once 'include/DB_Functions.php';
    $db = new DB_Functions();
	
	if($db->changeState($cid))
	{
		$response["success"] = 1;
		$response["message"] = "State successfully changed !";
	 
		// echoing JSON response
		echo json_encode($response);
	} 
	else
	{
	// no lockers found
	$response["success"] = 0;
	$response["message"] = "Try again, an error occured !";
		 
	// echo no users JSON
	echo json_encode($response);
	}
}
?>