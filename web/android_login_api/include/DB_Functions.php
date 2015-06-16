<?php

class DB_Functions {

    private $db;

    //put your code here
    // constructor
    function __construct() {
        require_once 'DB_Connect.php';
        // connecting to database
        $this->db = new DB_Connect();
        $this->db->connect();
    }

    // destructor
    function __destruct() {
        
    }

    /**
     * Storing new user
     * returns user details
     */
    public function storeUser($firstName, $lastName, $email, $phoneNumber, $password, $creditCardNumber) {
        $encrypted_password = password_hash($password,PASSWORD_BCRYPT); // encrypted password
		$encrypted_creditCardNumber = password_hash($creditCardNumber,PASSWORD_BCRYPT); // encryted creditCardNumber
        $result = mysql_query("INSERT INTO personne(nom, prenom, mail, numtel, note, mdp, numCB, DateCrea) VALUES('$lastName','$firstName', '$email', '$phoneNumber', NULL, '$encrypted_password', '$encrypted_creditCardNumber', NOW())");
        // check for successful store
        if ($result) {
            // get user details 
            $result = mysql_query("SELECT * FROM personne WHERE mail = '$email'");
            // return user details
            return mysql_fetch_array($result);
        } else {
            return false;
        }
    }

    /**
     * Get user by email and password
     */
    public function getUserByEmailAndPassword($email, $password) {
        $result = mysql_query("SELECT * FROM personne WHERE mail = '$email'") or die(mysql_error());
        // check for result 
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
            $result = mysql_fetch_array($result);
            $encrypted_password = $result['mdp'];
            // check for password equality
            if (password_verify($password, $encrypted_password)){
                // user authentication details are correct
                return $result;
            }
        } else {
            // user not found
            return false;
        }
    }
    /**
     * Check user is existed or not
     */
    public function isUserExisted($email) {
        $result = mysql_query("SELECT mail from personne WHERE mail = '$email'");
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
            // user existed 
            return true;
        } else {
            // user not existed
            return false;
        }
    }
	function verifProprio($idPersonne){
		$result=mysql_query("SELECT idProprio FROM proprietaire WHERE idProprio='$idPersonne'");
		//vérifie si la personne fait partie de la base proprio et creer le cadenas dans la bdd
     	if(mysql_fetch_object($result)){
			// User is a owner
			return true;
		} else {
			// User is not a owner
			return false;
		}
	}
	function changeState($idCadenas){
		$dispo=mysql_query("SELECT Dispo FROM etatcadenas WHERE idCadenas='$idCadenas'");
		$row = mysql_fetch_array($dispo) ;
		if($row){
			if($row['Dispo']=='1'){
				$result = mysql_query("UPDATE etatcadenas SET Dispo = '0' WHERE idCadenas = '$idCadenas'");
				if($result){
					return true;
				} else {
					return false;
				}
			}
			else {
				$result = mysql_query("UPDATE etatcadenas SET Dispo = '1' WHERE idCadenas = '$idCadenas'");
				if($result){
					return true;
				} else {
					return false;
				}
			}
		}
		else {
			return false;
		}
	}
}

?>
