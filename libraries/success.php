<?php 
	
	namespace app\libraries;

	header("Access-Control-Allow-Origin: *");
 	header("Access-Control-Allow-Methods: PUT, GET, POST");
	header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

	class success{

		public function successCallBack(){

		}

	}

	$successParams = new success();

	$successParams -> successCallBack();

?>