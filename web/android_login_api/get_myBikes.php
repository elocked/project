<?php
 
/*
 * Following code will list all the bikes the use own
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . 'include/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();

// check for post data
if(isset($_GET["uid"]))
{
	//get user ID
	$uid = $_GET["uid"];
	
	// include db handler
	require_once 'include/DB_Functions.php';
    $db = new DB_Functions();
	
	if(verifProprio($uid)){
		// get all products from products table
		$result = mysql_query("SELECT *FROM cadenas") or die(mysql_error());
 
		// check for empty result
		if (mysql_num_rows($result) > 0)
		{
			// looping through all results
			// products node
			$response["myBikes"] = array();
		 
			while ($row = mysql_fetch_array($result))
			{
				// temp user array
				$bikes = array();
				$bikes["idCadenas"] = $row["idCadenas"];
				$bikes["idProprio"] = $row["idProprio"];
				$bikes["cleNFC"] = $row["cleNFC"];
		 
				// push single product into final response array
				array_push($response["myBikes"], $result);
			}
			// success
			$response["success"] = 1;
		 
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
	else
	{
			// the user is not a proprio
			$response["sucess"] = 0;
			$response["message"] = "You are not a owner";
	}
}
else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>