<?php

/* Project Name: klippat Mobile App 
 * @Author: funki developer 
 * Company : Funki Orange software solution PVT. LTD
 * Email:hi@funkitechnologies.com
 * File Name: services
 */

@session_start();
define("__HOST", $_SERVER['HTTP_HOST']);
define("__ROOT", rtrim($_SERVER['DOCUMENT_ROOT'], "/"));
define("__REGARDS_FROM", "");
define("__SUPPORT_EMAIL", "DataStock  Support <Datastock@email.com>");
ini_set("post_max_size", "30M");
ini_set("upload_max_filesize", "30M");
ini_set("memory_limit", -1);

//ini_set("log_errors", "On");
//ini_set("error_log", __ROOT_DIR . "error.log");

ini_set('date.timezone', 'Asia/Kolkata');

//ini_set("max_execution_time", 1800);
set_time_limit(7200);
//ini_set("error_reporting", "E_ALL & ~E_NOTICE | ~E_DEPRECATED");

if (__HOST == "localhost") {

	//http://localhost/health-advice
	//ini_set("display_errors", 0);

	define("DB_HOST", "localhost");
	define("DB_USER", "root");
	define("DB_PASS", "");
	define("DB_NAME", "demodatabase");
	define("FOLDER_NAME", "wenjsone");
	define("FOLDER_URL", "http://" . __HOST . "/" . FOLDER_NAME . "/");
	define("__ROOT_DIR", __ROOT . "/" . FOLDER_NAME . "/");


	define("__MODE", "testing");
} else {

	//ini_set("display_errors", 0);

	define("DB_HOST", "localhost");
	define("DB_USER", "datasto9_datast");
	define("DB_PASS", "datasto9_datast");
	define("DB_NAME", "datasto9_testing_datastock");
	define("FOLDER_NAME", "api-datastock");
	define("FOLDER_URL", "http://" . __HOST . "/" . FOLDER_NAME . "/");
	define("__ROOT_DIR", __ROOT . "/" . FOLDER_NAME . "/");
	define("__MODE", "testing");


}
$_POST['requestStr'] = $_REQUEST;

$_POST['requestStr'] = stripslashes(json_encode($_POST['requestStr']));
$_REQUESTSTR = json_decode($_POST['requestStr'], TRUE);

/* echo "POST DATA : \n----------------------------------\n";
  print_r($_REQUEST);
  echo "\n----------------------------------\n";

  die; */

require_once "class/class.db.php";

class Services extends DB {

	function construct() {
		parent::__construct();
	}
       function datastock_active_deals($active_deals) {
			
			$res['success'] = "false";
			if ($active_deals['datastock_id'] == ""){
			$res["error"] = "Please provide me datastock_id";
			}
			else{
				
				$activeDealsArray = array();
				$active_deal = "SELECT * FROM deal_datastocks WHERE data_stock_id = '".$active_deals['datastock_id']."'";
				$execute_query = $this->query($active_deal);
				foreach($execute_query as $key=>$files_index){              
					$id  = $files_index->id ;
					$deal_id = $files_index->deal_id ;
					$data['bid_price'] = $files_index->market_price ;
					$data['ask_price'] = "$3.45" ;
					
					$select_deal = "SELECT * FROM data_deals WHERE id = '$deal_id' AND deal_status = '1'";
					$execute_query1 = $this->query($select_deal);
					foreach($execute_query1 as $key=>$files_index){              
						$id  = $files_index->id ;
						$data['deal_icon'] = $files_index->logo;
						$data['deal_name'] = $files_index->deal_name;
						$data['deal_number'] = $files_index->deal_number;						
						
						
						array_push($activeDealsArray,$data);
					
					}
					
					$res['active_deals']=$activeDealsArray;
					$res["success"] = "true";
				}
		
			}
			return $res;
		}
		
		function get_all_user($userdata){

			if ($userdata['id'] == "" ){
				$res["message"] = "Please enter your user id";
				   $res["success"] = "false"; 
			   }else {
					$active_deal = "SELECT * FROM user WHERE id = '".$userdata['id']."'";
					$execute_query = $this->query($active_deal);
					$res['active_deals']=$execute_query;
					$res["success"] = "true";
		  }

	     return $res;
  	    }
    }