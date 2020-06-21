<?php
class DBConnection{
	
	function __construct($servername, $username, $password, $dbname){
		// Create connection
		$this->conn = new mysqli($servername, $username, $password, $dbname);

		// Check connection
		if ($this->conn->connect_error) {
			die("Connection failed: " . $this->conn->connect_error);
		}
	}
	
	public function getConnection(){
		return $this->conn;
	}
	public function closeConnection(){
		$this->conn->close();
	}
}