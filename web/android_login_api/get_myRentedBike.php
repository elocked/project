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
if(isset($_POST['tag']) && $_POST['tag']!='' && $_POST['uid'] && $_POST['uid']!='')
{
	$tag = $_POST['tag'];
	$uid = $_POST['uid'];
	
	
	// include db handler
	require_once 'include/DB_Functions.php';
    $db = new DB_Functions();
	
	// response Array
    $response = array("tag" => $tag, "success" => 0);
	
	$date = date("Y-m-d H:i:s");

    // check for tag type
    if ($tag == 'coming') {
		//Si l'utilisateur a des prêts à venir...
		if($db->locToCome($uid)){
			$query = mysql_query("SELECT *FROM emprunt WHERE idPersonne='$uid' AND DebutEmprunt > '$date'")or die(mysql_error());
			
			$response["mBike"] = array();
			
			while($row = mysql_fetch_array ($query)){
				
				$bike = array();
				$bike["cid"]=$row["idCadenas"];
				$bike["start"] = $row["DebutEmprunt"];
				$bike["end"] = $row["FinEmprunt"];
				
				// push single product into final response array
				array_push($response["mBike"], $bike);
			}
			$response["success"] = 1;
			echo json_encode($response);
		}
		//else -> on lui affiche un message pour l'informer qu'il n'a pas de location à venir
		else{
			$response["success"] = 0;
			$response["error_msg"] = "Aucune location a venir";
			echo json_encode($response);
		}
	}
	else if($tag == 'past'){
		//Si l'utilisateur à effectué des prêts
		if($db->locPast($uid)){
			$query = mysql_query("SELECT *FROM emprunt WHERE idPersonne='$uid' AND FinEmprunt < '$date'");
			$response["mBike"]= array();
			while($row=mysql_fetch_array($query)){
				$bike = array();
				$bike["cid"]=$row["idCadenas"];
				$bike["start"] = $row["DebutEmprunt"];
				$bike["end"] = $row["FinEmprunt"];
				
				// push single product into final response array
				array_push($response["mBike"], $bike);
			}
			$response["success"] = 1;
			echo json_encode($response);	
		}
		// else -> il n'a jamais effectué de prêt
		else{
			$response["success"]=0;
			$response["error_msg"]="You have never rented a bike";
			echo json_encode($response);
		}
	}
	else if($tag == 'now'){
		// Si l'utilisateur à des prêts en cours
		if($db->loc($uid)){
			$query = mysql_query("SELECT *FROM emprunt WHERE idPersonne='$uid' AND DebutEmprunt < '$date' AND FinEmprunt > '$date'");
			$response["mBike"]= array();
			while($row=mysql_fetch_array($query)){
				$bike = array();
				$bike["cid"]=$row["idCadenas"];
				$bike["start"] = $row["DebutEmprunt"];
				$bike["end"] = $row["FinEmprunt"];
				
				// push single product into final response array
				array_push($response["mBike"], $bike);
				
			}
			$response["success"] = 1;
			echo json_encode($response);	
		}
		// Else -> il n'a pas de prêt en courrs
		else {
			$response["success"]=0;
			$response["error_msg"]="No bike to ride today";
			echo json_encode($response);
		}
	}
	else{
		// user failed to store
        $response["success"] = 0;
        $response["error_msg"] = "Unknow 'tag' value.";
        echo json_encode($response);
	}
}
else{
	$response["success"] = 0;
    $response["error_msg"] = "Required parameter 'tag' is missing!";
    echo json_encode($response);
}
?>