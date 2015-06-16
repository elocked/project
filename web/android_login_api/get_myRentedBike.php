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
if(isset($_POST["uid"]))
{
	//get user ID
	$uid = $_POST["uid"];
	
	// include db handler
	require_once 'include/DB_Functions.php';
    $db = new DB_Functions();
	
	if($db->verifProprio($uid)){
		// get all products from products table
		$result =mysql_query("SELECT *FROM cadenas WHERE idProprio='$uid'") or die(mysql_error());
 
		// check for empty result
		if (mysql_num_rows($result) > 0)
		{
			
			// looping through all results
			// products node
			$response["myBikes"] = array();
		 
			while ($row = mysql_fetch_array($result))
			{
				// request gps
				$idCadenas = $row['idCadenas'];
				$query = mysql_query("SELECT *FROM etatcadenas WHERE idCadenas ='$idCadenas'")or die(mysql_error());
				$query = mysql_fetch_array($query);
				// temp user array
				$bike = array();
				$bike["cid"] = $row["idCadenas"];
				$bike["idProprio"] = $row["idProprio"];
				$bike["longitude"] = $query["Longitude"];
				$bike["latitude"] = $query["Latitude"];
				$bike["available"] = $query["Dispo"];
				$bike["cleNFC"] = $row["cleNFC"];
		 
				// push single product into final response array
				array_push($response["myBikes"], $bike);
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
			echo json_encode($response);
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