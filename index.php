<?php
/*
Params : option, task
*/

/*
error_reporting(-1);
ini_set('error_reporting', E_ALL);
*/
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'learners';

header('Content-type: application/json'); // Set response type application/json
http_response_code(200); // Set response code 400

/*
Check option, and task exists in request
If not, returns Invalid request.
*/
if(empty($_REQUEST['option']) || empty($_REQUEST['task'])){
	echo json_encode(array(
		"massage" => "Invalid request",
	));
	exit;
}
$controller_name = ucwords($_REQUEST['option']).'Controller';
/*
Check controller exists or not for given option
If not, returns Invalid request.
*/
if(!file_exists("./Controllers/$controller_name.php")){
	echo json_encode(array(
		"massage" => "Invalid request, given option not allowed.",
	));
	exit;
}
require_once("./Controllers/$controller_name.php");
require_once("./Models/DBConnection.php");
$db = new DBConnection($db_host, $db_username, $db_password, $db_name); //create database connection
$obj = new $controller_name($db); // calls classname::__construct

if(method_exists($obj,$_REQUEST['task'])){
	$result = $obj->$_REQUEST['task'](); // calls function for action
	echo json_encode($result);
}else{
	echo json_encode(array(
		"massage" => "Invalid request, given task not allowed.",
	));
}
$db->closeConnection();
exit;
