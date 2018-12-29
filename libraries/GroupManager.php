<?php
	
/*
*@Author: Faisal Burhan Abdu
*@Author: Davis Wambugu
*@Date: November 9 2018
*@Version: 1.0.0v
*@Copyright (C): Cellulant corporation
*/


/*
*The GroupManager, is a comprehensive data object model class that manages all the Mula Group Web 
*functionalities/activities from group creation to management aspects of the group.
*This class plays a mojor role in managing data between the client side and server side by
*establishing an interface between the client and an API service that the site relies on.
*/

namespace app\libraries;


class GroupManager
{	
	public static $PID = 0;

	private $_ACTION = array
	(
		"ACTION_FETCH_GROUP_DATA" => "FETCH_GROUP_DATA",
        "ACTION_ACCEPT_REQUEST" => "ACCEPT_REQUEST",
		"ACTION_REJECT_REQUEST" => "REJECT_REQUEST",
        "ACTION_ACCEPT_INVITE" => "ACCEPT_INVITE",
		"ACTION_CREATE_ADMIN" => "CREATE_ADMIN",
        "ACTION_CREATE_SIGNATORY" => "CREATE_SIGNATORY",
		"ACTION_REJECT_INVITE" => "REJECT_INVITE",
        "ACTION_FETCH_GROUP_TYPES" => "FETCH_GROUP_TYPES",
		"ACTION_ADD_MEMBERS" => "ADD_MEMBERS",
        "ACTION_CREATE_GROUP" => "CREATE_GROUP",
		"ACTION_EXIT_MEMBER" => "EXIT_MEMBER",
        "ACTION_ADMIN_EXIT_MEMBERS" => "ADMIN_EXIT_MEMBERS",
		"ACTION_UPDATE_GROUP" => "UPDATE_GROUP",
        "ACTION_CASH_OUT_REQUEST" => "CASH_OUT_REQUEST",
		"ACTION_CASH_OUT_APPROVAL" => "CASH_OUT_APPROVAL",
        "ACTION_REVOKE_SIGNATORY" => "REVOKE_SIGNATORY",
		"ACTION_REVOKE_ADMIN" => "REVOKE_ADMIN",
        "ACTION_DELETE_GROUP" => "DELETE_GROUP",
		"ACTION_RESEND_INVITE" => "RESEND_INVITE",
        "ACTION_GROUP_PAYMENT_REMINDER" => "GROUP_PAYMENT_REMINDER",
		"ACTION_CASH_PAYMENT" => "CASH_PAYMENT",
        "ACTION_GROUP_BALANCE_ENQUIRY" => "GROUP_BALANCE_ENQUIRY",
		"ACTION_CANCEL_REQUEST" => "CANCEL_REQUEST",
        "ACTION_FETCH_GROUPS" => "FETCH_GROUPS",
        "ACTION_FETCH_ALL_OPEN_GROUPS" => "FETCH_ALL_OPEN_GROUPS",
		"ACTION_FETCH_GROUP_REPORT" => "FETCH_GROUP_REPORT",
        "ACTION_FETCH_GROUP_INVITES" => "FETCH_GROUP_INVITES",
        "ACTION_FETCH_GROUP_BILLS" => "FETCH_GROUP_BILLS",
		"ACTION_CREATE_PLEDGE" => "CREATE_PLEDGE",
        "ACTION_EDIT_PLEDGE" => "EDIT_PLEDGE",
		"ACTION_DELETE_PLEDGE" => "DELETE_PLEDGE",
        "ACTION_FETCH_PLEDGE" => "FETCH_PLEDGE",
		"ACTION_OTP_GENERATE" => "MANAGE_OTP",
        "ACTION_OTP_VALIDATION" => "MANAGE_OTP_V",
		"ACTION_CASHOUT_TPLUS_1" => "CASHOUT_TPLUS_1",
		"ACTION_MANUAL_REMINDER" => "MANUAL_REMINDER",
		"ACTION_LOG_REQUEST" => "LOG_REQUEST",
        "ACTION_SAVE_BANK_TRANSACTION" => "SAVE_BANK_TRANSACTION"
	); 

	//create a class constructor and initializes file headers
	public function __construct(){
		// required headers
		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json; charset=UTF-8");
		header("Access-Control-Allow-Methods: POST");
		header("Access-Control-Max-Age: 3600");
		header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
		header("Content-type: application/json"); 
		global $PID; $PID+=1; 
	}

	//get application instance id
	public static function getPID(){ global $PID; return $PID; }

	/*
	*Create group
	*@param $args: takes
	*@return:
	*/
	public function createGroup($args){ global $_ACTION; return $this->getResponse($this->_ACTION["ACTION_CREATE_GROUP"], $args); }

	// Fetch groups
	public function fetchGroups($args){ global $_ACTION; return $this->getResponse($this->_ACTION["ACTION_FETCH_GROUPS"], $args); }

    // Fetch groups
    public function fetchAllOpenGroups($args){ global $_ACTION; return $this->getResponse($this->_ACTION["ACTION_FETCH_ALL_OPEN_GROUPS"], $args); }

	// View group reports
	public function fetchGroupReport($args){ global $_ACTION; return $this->getResponse($this->_ACTION["ACTION_FETCH_GROUP_REPORT"], $args); }

	// View group invites
	public function fetchGroupInvites($args){ global $_ACTION; return $this->getResponse($this->_ACTION["ACTION_FETCH_GROUP_INVITES"], $args); }

	// View group bills
	public function fetchGroupBills($args){ global $_ACTION; return $this->getResponse($this->_ACTION["ACTION_FETCH_GROUP_BILLS"], $args); }

	// Update group Information
	public function updateGroupInformation($args){ global $_ACTION; return $this->getResponse($this->_ACTION["ACTION_UPDATE_GROUP"], $args); }
		
	//group payment reminder
	public function groupPaymentReminder($args){ global $_ACTION; return $this->getResponse($this->_ACTION["ACTION_GROUP_PAYMENT_REMINDER"], $args); }
 
	//delete grouup
	public function deleteGroup($args){ global $_ACTION; return $this->getResponse($this->_ACTION["ACTION_DELETE_GROUP"], $args); }

	//group payment reminder
	public function groupBalanceEnquiry($args){ global $_ACTION; return $this->getResponse($this->_ACTION["ACTION_GROUP_BALANCE_ENQUIRY"], $args); }

	//fetch group type
	public function fetchGroupType($args){ global $_ACTION; return $this->getResponse($this->_ACTION["ACTION_FETCH_GROUP_TYPES"], $args); }
	
	//fetch group data
	public function fetchGroupData($args){ global $_ACTION; return $this->getResponse($this->_ACTION["ACTION_FETCH_GROUP_DATA"], $args); }

	// make a pledge
	public function makePledge($args){ global $_ACTION; return $this->getResponse($this->_ACTION["ACTION_CREATE_PLEDGE"], $args); }

	// Edit a pledge
	public function editPledge($args){ global $_ACTION; return $this->getResponse($this->_ACTION["ACTION_EDIT_PLEDGE"], $args); }

	// delete a pledge
	public function deletePladge($args){ global $_ACTION; return $this->getResponse($this->_ACTION["ACTION_DELETE_PLEDGE"], $args); }

	// View Pledges
	public function fetchPledge($args){ global $_ACTION; return $this->getResponse($this->_ACTION["ACTION_FETCH_PLEDGE"], $args); }
 
	//cash out request
	public function cashoutRequest($args){ global $_ACTION; return $this->getResponse($this->_ACTION["ACTION_CASH_OUT_REQUEST"], $args); }

	//cashout approval
	public function cashoutApproval($args){ global $_ACTION; return $this->getResponse($this->_ACTION["ACTION_CASH_OUT_APPROVAL"], $args); }
 
	//revoke signatory
	public function revokeSignatory($args){ global $_ACTION; return $this->getResponse($this->_ACTION["ACTION_REVOKE_SIGNATORY"], $args); }
 
	//revoke admin
	public function revokeAdmin($args){ global $_ACTION; return $this->getResponse($this->_ACTION["ACTION_REVOKE_ADMIN"], $args); }
 
	//resend invite
	public function resendInvite($args){ global $_ACTION; return $this->getResponse($this->_ACTION["ACTION_RESEND_INVITE"], $args); }
 
	//delete grouup
	public function cancelRequest($args){ global $_ACTION; return $this->getResponse($this->_ACTION["ACTION_CANCEL_REQUEST"], $args); }

	//exit member
	public function exitMember($args){ global $_ACTION; return $this->getResponse($this->_ACTION["ACTION_EXIT_MEMBER"], $args); }

	//admin exit member
	public function adminExitMember($args){ global $_ACTION; return $this->getResponse($this->_ACTION["ACTION_ADMIN_EXIT_MEMBERS"], $args); }

	//accept request
	public function acceptRequest($args){ global $_ACTION; return $this->getResponse($this->_ACTION["ACTION_ACCEPT_REQUEST"], $args); }

	//reject request
	public function rejectRequest($args){ global $_ACTION; return $this->getResponse($this->_ACTION["ACTION_REJECT_REQUEST"], $args); }

	//accept invite
	public function acceptInvite($args){ global $_ACTION; return $this->getResponse($this->_ACTION["ACTION_ACCEPT_INVITE"], $args); }

	//craate admin
	public function createAdmin($args){ global $_ACTION; return $this->getResponse($this->_ACTION["ACTION_CREATE_ADMIN"], $args); }

	//create signatory
	public function createSignatory($args){ global $_ACTION; return $this->getResponse($this->_ACTION["ACTION_CREATE_SIGNATORY"], $args); }

	//reject invite
	public function rejectInvite($args){ global $_ACTION; return $this->getResponse($this->_ACTION["ACTION_REJECT_INVITE"], $args); }

	//add member
	public function addMembers($args){ global $_ACTION; return $this->getResponse($this->_ACTION["ACTION_ADD_MEMBERS"], $args); }

	// Cashout flow for T+1
	public function cashoutTplusOne($args){ global $_ACTION; return $this->getResponse($this->_ACTION["ACTION_CASHOUT_TPLUS_1"], $args); }

	// OTP Validation
	public function otpValidation($args){ global $_ACTION; return $this->getResponse($this->_ACTION["ACTION_OTP_VALIDATION"], $args); }

	// OTP Generation 
	public function generateOtp($args){ global $_ACTION; return $this->getResponse($this->_ACTION["ACTION_OTP_GENERATE"], $args);}

	// Pain in Cash records
	public function payWithCash($args){ global $_ACTION; return $this->getResponse($this->_ACTION["ACTION_CASH_PAYMENT"], $args); }
	
	// log Request for merchant Trasaction ID
	public function logRequestAction($args){ global $_ACTION; return $this->getResponse($this->_ACTION["ACTION_LOG_REQUEST"], $args); }

	public function saveBankTransaction($args){ global $_ACTION; return $this->getResponse($this->_ACTION["ACTION_SAVE_BANK_TRANSACTION"], $args); }


	// // View group collection(Wallet balance)
	// public function viewGroupCollection($args){ global $_ACTION; return $this->getResponse($this->_ACTION["viewGroupCollection"], $args); }

	// // Adding of approvers(Treasurer)
	// public function addApprover($args){ global $_ACTION; return $this->getResponse($this->_ACTION["addApprover"], $args); }

	// // Cashout flow for MPESA
	// public function cashoutMobileMoney($args){ global $_ACTION; return $this->getResponse($this->_ACTION["cashoutMobileMoney"], $args); }

	// // Group Contribution
	// public function groupContribution($args){ global $_ACTION; return $this->getResponse($this->_ACTION["groupContribution"], $args); }

	
 

	//connect and query the API
	/*private function requestService($arg)
	{

		$data = $arg;
		// use key 'http' even if you send the request to https://...
		$options = array(
		    'http' => array(
		        'header'  => "Content-Type: application/json; charset=UTF-8\r\n",
		        'method'  => 'POST',
		        'content' => json_encode($data)
		)
		);

		$context  = stream_context_create($options);
		$res = $this->curlPost("http://ca1-ke.dc1.cellulant.com:9001/hub/mula/beta_api/mula_ke_api/index.php", $arg);
		//$res = @file_get_contents("http://ca1-ke.dc1.cellulant.com:9001/hub/mula/beta_api/mula_ke_api/index.php",true, $context);

		return $res;
	}*/

	private function requestService($arg)
	{

		$data = $arg;
		// use key 'http' even if you send the request to https://...
		$options = array(
    		'http' => array(
        	'header'  => "Content-Type: application/json; charset=UTF-8\r\n",
        	'method'  => 'POST',
        	'content' => json_encode($data))
    	);

		$context  = stream_context_create($options);

		return  @file_get_contents("https://mula.co.ke/mula_ke/api/v1/",true, $context);
	}


	private function curlPost($url, $data, $headers = array()) {
		
		$ch = curl_init();
		
		try {
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, count($data));
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

			if (isset($headers)) {
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			}


			$response = curl_exec($ch);

		} catch (Exception $ex) {
			print_r($ex);
		}

		curl_close($ch);
		
		return $response;
	}

	//default values 
	private function initializeDefaults($action){

		//returns dummy data for testing, algorithmic to generate dynamic data per request will be implemented 
		//soon!
		return array(
   				"ORIGIN"=>"MULA_WEB",
   				"APP_VERSION"=>"3.0.10",
   				"UUID"=>"1234",
  				"SERVICE"=>"GMGT",
  				"ACTION"=> $action,
  				"CLIENT_ID"=>"105",
  			);

	}
	
	private function dataMapper($data, $uniqueKeys, $action){
		$temp = array();
		$temp = $this->initializeDefaults($action);
		for ($j = 0; $j < sizeof($data); $j++) { 
			$temp[$uniqueKeys[$j]] = $data[$j];
		}

		return $temp;
	}

	// process request
	private function getResponse($action, $userData)
	{

		$response;
		global $_ACTION;

		switch ($action) {

			case $this->_ACTION["ACTION_OTP_GENERATE"]:
				$uniqueKeys = array("ITEM_ACTION","MSISDN");
				$tempData = $this->dataMapper($userData, $uniqueKeys, $this->_ACTION["ACTION_OTP_GENERATE"]);
				$response = $this->requestService($tempData);
			break;

			case $this->_ACTION["ACTION_OTP_VALIDATION"]:
				$uniqueKeys = array("ITEM_ACTION", "MSISDN", "ACTIVATION_CODE");
				$tempData = $this->dataMapper($userData, $uniqueKeys, "MANAGE_OTP");
				$response = $this->requestService($tempData);
			break;	

			case $this->_ACTION["ACTION_CASHOUT_TPLUS_1"]:
				$uniqueKeys = array();
				$tempData = $this->dataMapper($userData, $uniqueKeys, $this->_ACTION["ACTION_CASHOUT_TPLUS_1"]);
				$response = $this->requestService($tempData);
			break;

			case $this->_ACTION["ACTION_FETCH_GROUPS"]:
				$uniqueKeys = array("MSISDN");
				$tempData = $this->dataMapper($userData, $uniqueKeys, $this->_ACTION["ACTION_FETCH_GROUPS"]);
				$response = $this->requestService($tempData);
			break;

            case $this->_ACTION["ACTION_FETCH_ALL_OPEN_GROUPS"]:
                $uniqueKeys = array("MSISDN","FETCH_ALL_OPEN_GROUPS");
                $tempData = $this->dataMapper($userData, $uniqueKeys, $this->_ACTION["ACTION_FETCH_GROUPS"]);
                $response = $this->requestService($tempData);
                break;

 			case $this->_ACTION["ACTION_FETCH_GROUP_DATA"]:
				$uniqueKeys = array("MSISDN", "GROUP_ID");
				$tempData = $this->dataMapper($userData, $uniqueKeys, $this->_ACTION["ACTION_FETCH_GROUP_DATA"]);
				$response = $this->requestService($tempData);
			break;

  			case $this->_ACTION["ACTION_ACCEPT_REQUEST"]:
				$uniqueKeys = array("MSISDN", "GROUP_ID", "ITEM_ACTION", "REQUEST_ID");
				$tempData = $this->dataMapper($userData, $uniqueKeys, $this->_ACTION["ACTION_ACCEPT_REQUEST"]);
				$response = $this->requestService($tempData);
			break;
 
  			case $this->_ACTION["ACTION_REJECT_REQUEST"]:
				$uniqueKeys = array("MSISDN", "GROUP_ID", "ITEM_ACTION", "REQUEST_ID");
				$tempData = $this->dataMapper($userData, $uniqueKeys, $this->_ACTION["ACTION_REJECT_REQUEST"]);
				$response = $this->requestService($tempData);
			break;
 
 			case $this->_ACTION["ACTION_ACCEPT_INVITE"]:
				$uniqueKeys = array("MSISDN", "GROUP_ID");
				$tempData = $this->dataMapper($userData, $uniqueKeys, $this->_ACTION["ACTION_ACCEPT_INVITE"]);
				$response = $this->requestService($tempData);
			break;

  			case $this->_ACTION["ACTION_CREATE_ADMIN"]:
				$uniqueKeys = array("MSISDN", "GROUP_ID", "MEMBER_MSISDN");
				$tempData = $this->dataMapper($userData, $uniqueKeys, $this->_ACTION["ACTION_CREATE_ADMIN"]);
				$response = $this->requestService($tempData);
			break;

 			case $this->_ACTION["ACTION_CREATE_SIGNATORY"]:
				$uniqueKeys = array("MSISDN",	"GROUP_ID", "MEMBER_MSISDN");
				$tempData = $this->dataMapper($userData, $uniqueKeys, $this->_ACTION["ACTION_CREATE_SIGNATORY"]);
				$response = $this->requestService($tempData);
			break;

  			case $this->_ACTION["ACTION_REJECT_INVITE"]:
				$uniqueKeys = array("MSISDN", "GROUP_ID");
				$tempData = $this->dataMapper($userData, $uniqueKeys, $this->_ACTION["ACTION_REJECT_INVITE"]);
				$response = $this->requestService($tempData);
			break;

  			case $this->_ACTION["ACTION_FETCH_GROUP_TYPES"]:
				$uniqueKeys = array("MSISDN");
				$tempData = $this->dataMapper($userData, $uniqueKeys, $this->_ACTION["ACTION_FETCH_GROUP_TYPES"]);
				$response = $this->requestService($tempData);
			break;

  			case $this->_ACTION["ACTION_ADD_MEMBERS"]:
				$uniqueKeys = array("MSISDN", "GROUP_ID", "GROUP_MEMBERS");
				$tempData = $this->dataMapper($userData, $uniqueKeys, $this->_ACTION["ACTION_ADD_MEMBERS"]);
				$response = $this->requestService($tempData);
			break;
 
  			case $this->_ACTION["ACTION_CREATE_GROUP"]:
				$uniqueKeys = array("MSISDN", "NAMES", "ID_NUMBER", "GROUP_NAME", "GROUP_DESCRIPTION", "GROUP_TYPE_ID", "GROUP_FREQUENCY", "AMOUNT", "GROUP_DUE_DATE", "IS_OPEN_GROUP", "GROUP_MEMBERS");
				$tempData = $this->dataMapper($userData, $uniqueKeys, $this->_ACTION["ACTION_CREATE_GROUP"]);
				$response = $this->requestService($tempData);
			break;

  			case $this->_ACTION["ACTION_EXIT_MEMBER"]:
				$uniqueKeys = array("MSISDN", "GROUP_ID");
				$tempData = $this->dataMapper($userData, $uniqueKeys, $this->_ACTION["ACTION_EXIT_MEMBER"]);
				$response = $this->requestService($tempData);
			break;

  			case $this->_ACTION["ACTION_ADMIN_EXIT_MEMBERS"]:
				$uniqueKeys = array("MSISDN", "GROUP_ID", "GROUP_MEMBERS");
				$tempData = $this->dataMapper($userData, $uniqueKeys, $this->_ACTION["ACTION_ADMIN_EXIT_MEMBERS"]);
				$response = $this->requestService($tempData);
			break;

  			case $this->_ACTION["ACTION_UPDATE_GROUP"]:
				$uniqueKeys = array("MSISDN", "GROUP_NAME", "GROUP_DESCRIPTION", "GROUP_ID", "GROUP_FREQUENCY", "AMOUNT", "DUE_DATE", "IS_OPEN_GROUP");
				$tempData = $this->dataMapper($userData, $uniqueKeys, $this->_ACTION["ACTION_UPDATE_GROUP"]);
				$response = $this->requestService($tempData);
			break;


  			case $this->_ACTION["ACTION_CASH_OUT_REQUEST"]:
				$uniqueKeys = array("MSISDN", "GROUP_ID", "AMOUNT", "RECIPIENT_MSISDN", "PAYER_CLIENT_ID");
				$tempData = $this->dataMapper($userData, $uniqueKeys, $this->_ACTION["ACTION_CASH_OUT_REQUEST"]);
				$response = $this->requestService($tempData);
			break;

  			case $this->_ACTION["ACTION_CASH_OUT_APPROVAL"]:
				$uniqueKeys = array("MSISDN", "GROUP_ID", "REQUEST_ID", "ITEM_ACTION");
				$tempData = $this->dataMapper($userData, $uniqueKeys, $this->_ACTION["ACTION_CASH_OUT_APPROVAL"]);
				$response = $this->requestService($tempData);
			break;

  			case $this->_ACTION["ACTION_REVOKE_SIGNATORY"]:
				$uniqueKeys = array("MSISDN", "MEMBER_MSISDN", "GROUP_ID");
				$tempData = $this->dataMapper($userData, $uniqueKeys, $this->_ACTION["ACTION_REVOKE_SIGNATORY"]);
				$response = $this->requestService($tempData);
			break;

  			case $this->_ACTION["ACTION_REVOKE_ADMIN"]:
				$uniqueKeys = array("MSISDN", "MEMBER_MSISDN", "GROUP_ID");
				$tempData = $this->dataMapper($userData, $uniqueKeys, $this->_ACTION["ACTION_REVOKE_ADMIN"]);
				$response = $this->requestService($tempData);
			break;
 
 			case $this->_ACTION["ACTION_DELETE_GROUP"]:
				$uniqueKeys = array("MSISDN", "GROUP_ID");
				$tempData = $this->dataMapper($userData, $uniqueKeys, $this->_ACTION["ACTION_DELETE_GROUP"]);
				$response = $this->requestService($tempData);
			break;

  			case $this->_ACTION["ACTION_RESEND_INVITE"]:
				$uniqueKeys = array("GROUP_ID", "MEMBER_MSISDN");
				$tempData = $this->dataMapper($userData, $uniqueKeys, $this->_ACTION["ACTION_RESEND_INVITE"]);
				$response = $this->requestService($tempData);
			break;

  			case $this->_ACTION["ACTION_GROUP_PAYMENT_REMINDER"]:
				$uniqueKeys = array("MSISDN","GROUP_ID", "MEMBER_MSISDN", "AMOUNT");
				$tempData = $this->dataMapper($userData, $uniqueKeys, $this->_ACTION["ACTION_GROUP_PAYMENT_REMINDER"]);
				$response = $this->requestService($tempData);
			break;

  			case $this->_ACTION["ACTION_CASH_PAYMENT"]:
				$uniqueKeys = array("GROUP_ID", "MSISDN", "MEMBER_MSISDN", "AMOUNT");
				$tempData = $this->dataMapper($userData, $uniqueKeys, $this->_ACTION["ACTION_CASH_PAYMENT"]);
				$response = $this->requestService($tempData);
			break;

 			case $this->_ACTION["ACTION_GROUP_BALANCE_ENQUIRY"]:
				$uniqueKeys = array("MSISDN", "GROUP_ID");
				$tempData = $this->dataMapper($userData, $uniqueKeys, $this->_ACTION["ACTION_GROUP_BALANCE_ENQUIRY"]);
				$response = $this->requestService($tempData);
			break;

  			case $this->_ACTION["ACTION_CANCEL_REQUEST"]:
				$uniqueKeys = array("ITEM_ACTION", "GROUP_ID", "REQUEST_ID");
				$tempData = $this->dataMapper($userData, $uniqueKeys, $this->_ACTION["ACTION_CANCEL_REQUEST"]);
				$response = $this->requestService($tempData);
			break;


  			case $this->_ACTION["ACTION_FETCH_GROUP_REPORT"]:
				$uniqueKeys = array("MSISDN", "GROUP_ID");
				$tempData = $this->dataMapper($userData, $uniqueKeys, $this->_ACTION["ACTION_FETCH_GROUP_REPORT"]);
				$response = $this->requestService($tempData);
			break;

  			case $this->_ACTION["ACTION_FETCH_GROUP_INVITES"]:
				$uniqueKeys = array("MSISDN");
				$tempData = $this->dataMapper($userData, $uniqueKeys, $this->_ACTION["ACTION_FETCH_GROUP_INVITES"]);
				$response = $this->requestService($tempData);
			break;

  			case $this->_ACTION["ACTION_FETCH_GROUP_BILLS"]:
				$uniqueKeys = array("MSISDN", "GROUP_ID");
				$tempData = $this->dataMapper($userData, $uniqueKeys, $this->_ACTION["ACTION_FETCH_GROUP_BILLS"]);
				$response = $this->requestService($tempData);
			break;
  
 			case $this->_ACTION["ACTION_CREATE_PLEDGE"]:
				$uniqueKeys = array("MSISDN", "MEMBER_MSISDN", "GROUP_ID", "AMOUNT", "DUE_DATE");
				$tempData = $this->dataMapper($userData, $uniqueKeys, $this->_ACTION["ACTION_CREATE_PLEDGE"]);
				$response = $this->requestService($tempData);
			break;	

  			case $this->_ACTION["ACTION_EDIT_PLEDGE"]:
				$uniqueKeys = array("MSISDN", "MEMBER_MSISDN", "GROUP_ID", "AMOUNT", "DUE_DATE");
				$tempData = $this->dataMapper($userData, $uniqueKeys, $this->_ACTION["ACTION_EDIT_PLEDGE"]);
				$response = $this->requestService($tempData);
			break;

  			case $this->_ACTION["ACTION_DELETE_PLEDGE"]:
				$uniqueKeys = array("MSISDN", "MEMBER_MSISDN", "GROUP_ID");
				$tempData = $this->dataMapper($userData, $uniqueKeys, $this->_ACTION["ACTION_DELETE_PLEDGE"]);
				$response = $this->requestService($tempData);
			break;

			case $this->_ACTION["ACTION_FETCH_PLEDGE"]:
				$uniqueKeys = array("MSISDN", "GROUP_ID");
				$tempData = $this->dataMapper($userData, $uniqueKeys, $this->_ACTION["ACTION_FETCH_PLEDGE"]);
				$response = $this->requestService($tempData);
			break;

            case $this->_ACTION["ACTION_SAVE_BANK_TRANSACTION"]:
                $uniqueKeys = array("MSISDN", "BANK_ID", "BANK_NAME", "BANK_ACCOUNT_NUMBER", "AMOUNT", "GROUP_ID");
                $tempData = $this->dataMapper($userData, $uniqueKeys, $this->_ACTION["ACTION_SAVE_BANK_TRANSACTION"]);
                $response = $this->requestService($tempData);
                break;

			case $this->_ACTION["ACTION_LOG_REQUEST"]:
				$uniqueKeys = array("MSISDN", "EXTRA_DATA");
				$tempData = $this->dataMapper($userData, $uniqueKeys, $this->_ACTION["ACTION_LOG_REQUEST"]);
				$response = $this->requestService($tempData);
			break;


			default:
				return json_encode("{'status:'response Error'}");
				break;
			}
			return $response;
		}


	}


//	$gmg = new GroupManager();

//	$myReq = array("254722333867", "[isAno: yes]");

//	echo "generate OTP \n".$gmg->logRequestAction($myReq)."\n\n";

	// $myReq = array("VALIDATE", "254758009135", "5689");

	// $res = json_decode($gmg->otpValidation($myReq));

	// echo "validate OTP \n".$res->STATUS_MESSAGE."\n\n";	

	// $myReq = array("254725153678", "254758009135", "583", "300","2018-11-29 00:00:00");

	// echo "EditPledge \n".$gmg->editPledge($myReq)."\n\n";

	// $myReq = array("254717124841", "553");

	// echo "viewPladge \n".$gmg->fetchPledge($myReq)."\n\n";

?>