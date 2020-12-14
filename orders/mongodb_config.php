<?php

class DbManager {

	//Database configuration
	private $dbhost = '3.18.2.184';
	private $dbport = '27017';
	private $conn;
	
	function __construct(){
        //Connecting to MongoDB
        try {
			//Establish database connection
            $this->conn = new MongoDB\Driver\Manager('mongodb+srv://HMI_AdminDBUser:cyrb7KSRiWbgCJ7@cluster0.g2ggn.mongodb.net/HMI_DevDB?retryWrites=true&w=majority');
        } catch (MongoDBDriverExceptionException $e) {
            echo $e->getMessage();
			echo nl2br("n");
        }
    }

	function getConnection() {
		return $this->conn;
	}

}

?>