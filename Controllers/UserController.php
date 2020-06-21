<?php
require_once("./Models/DBConnection.php");

class UserController{
	
	function __construct($db){
		$this->conn = $db->getConnection();
		$this->schema_name = "learnerdetails";
		$this->primary_key = "learner_id";
	}

	public function findAll(){
		$sql = "SELECT * FROM $this->schema_name";
		$result = $this->conn->query($sql);

		if ($result->num_rows > 0) {
			$data = $result->fetch_all(MYSQLI_ASSOC);
		} else {
			$data = [];
		}
		
		http_response_code(200);
		return array(
			"status" => 200,
			"massage" => "",
			"data" => $data,
			"total_records" => $result->num_rows,
		);
	}

	/*
	Params : id
	*/
	public function find(){
		$id = $_REQUEST['id'];
		if(empty($id)){
			http_response_code(400);
			return array(
				"status" => 400,
				"massage" => "Invalid request parameters",
			);
		}
		$sql = "SELECT * FROM $this->schema_name where $this->primary_key = $id";
		$result = $this->conn->query($sql);

		if ($result->num_rows > 0) {
			$data = $result->fetch_all(MYSQLI_ASSOC);
		} else {
			$data = [];
		}
		
		http_response_code(200);
		return array(
			"status" => 200,
			"massage" => "",
			"data" => $data,
			"total_records" => $result->num_rows,
		);
	}
	
	/*
	Params : name, email, course_id
	*/
	public function store(){
		$name = $_REQUEST['name'];
		$email = $_REQUEST['email'];
		$course_id = $_REQUEST['course_id'];
		if(!(!empty($name) && !empty($email) && !empty($course_id) )){
			http_response_code(400);
			return array(
				"status" => 400,
				"massage" => "Invalid request parameters",
			);
		}
		$sql = "INSERT INTO `learnerdetails`(`learner_name`, `learner_email`, `course_Id`) VALUES ('$name', '$email', $course_id)";
		$result = $this->conn->query($sql);

		if ($result === TRUE && $this->conn->affected_rows == 1) {
			$massage = "Successfull store.";
			$status_code = 200;
		} else {
			$massage = "Failed";
			$status_code = 400;
		}
		
		http_response_code($status_code);
		return array(
			"status" => $status_code,
			"massage" => "$massage",
			"id" => $this->conn->insert_id,
			"total_records" => $this->conn->affected_rows,
		);
	}
	
	/*
	Params : id, name, email, course_id
	*/
	public function edit(){
		$id = $_REQUEST['id'];
		$name = $_REQUEST['name'];
		$email = $_REQUEST['email'];
		$course_id = $_REQUEST['course_id'];
		if(!(!empty($id) && !empty($name) && !empty($email) && !empty($course_id) )){
			http_response_code(400);
			return array(
				"status" => 400,
				"massage" => "Invalid request parameters",
			);
		}
		$sql = "UPDATE `learnerdetails` SET `learner_name`='$name',`learner_email`='$email',`course_Id`=$course_id WHERE `$this->primary_key`=$id";
		$result = $this->conn->query($sql);

		if ($result === TRUE && $this->conn->affected_rows > 0) {
			$massage = "Successfull update.";
			$status_code = 200;
		} else {
			$massage = "Failed";
			$status_code = 400;
		}
		
		http_response_code($status_code);
		return array(
			"status" => $status_code,
			"massage" => "$massage",
			"total_records" => $this->conn->affected_rows,
		);
	}
	
	public function delete(){
		$id = $_REQUEST['id'];
		if(empty($id)){
			http_response_code(400);
			return array(
				"status" => 400,
				"massage" => "Invalid request parameters",
			);
		}
		$sql = "UPDATE `learnerdetails` SET `learner_name`='$name',`learner_email`='$email',`course_Id`=$course_id WHERE `$this->primary_key`=$id";
		$result = $this->conn->query($sql);

		if ($result === TRUE && $this->conn->affected_rows > 0) {
			$massage = "Successfull update.";
			$status_code = 200;
		} else {
			$massage = "Failed";
			$status_code = 400;
		}
		
		http_response_code($status_code);
		return array(
			"status" => $status_code,
			"massage" => "$massage",
			"total_records" => $this->conn->affected_rows,
		);
	}
}