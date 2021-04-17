<?php
/* Project Name: yellow cab Mobile App 
 * @Author: funki developer 
 * Company : Funki Orange software solution PVT. LTD
 * Email:hi@funkitechnologies.com
 * File Name: services
 */
 error_reporting(0);
 header('Access-Control-Allow-Origin: *');
//header('Content-Type: application/json; Charset=UTF-8');
include "services.php";

$services_object = new Services(DB_HOST, DB_USER, DB_PASS, DB_NAME);

/*
 * {"action":"search vendors","category":"LogIn"}
 */

//error_reporting("E_ALL & ~E_NOTICE | ~E_DEPRECATED");

switch ($_REQUESTSTR["task"]) {
	
	case "user_signin":
		$user_information = $_REQUESTSTR;
		$response_arr["response"] = $services_object->user_signin($user_information);
		break;
	case "user_forgot_password":
		$forgot_password = $_REQUESTSTR;
		$response_arr["response"] = $services_object->user_forgot_password($forgot_password);
		break;
		 default:
		$response_arr["error"] = "No task found";
		break;
	case "get_all_user":
	 //echo "pankaj"; die;
		$userdata = $_REQUESTSTR;
		$response_arr["response"] = $services_object->get_all_user($userdata);
		break;
		
		default:
		$response_arr["error"] = "No task found";
		break;
}
if ($response_arr["task"] == "") {
	unset($response_arr["task"]);
}

//print_r($response_arr);
$raw_json = json_encode($response_arr);

echo $raw_json;
