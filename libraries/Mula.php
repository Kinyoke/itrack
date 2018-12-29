<?php
	
	/*
	*@Author: Faisal Burhan Abdu
	*@Author: Davis Wambugu
	*@Date: November 9 2018
	*@Version: 1.0.0v
	*@Copyright (C): Cellulant corporation
	*/


	/*
	*The GroupManager Class, is a comprehensive data object model class that manages all the Mula Group Web 
	*functionalities/activities from group creation to management aspects of the group.
	*This class plays a mojor role in data managing data between the client side and server side by
	*establishing an interface between the client side and a service API link that the site relies on in order  to deliver 
	*/
	namespace app\libraries;
	use GuzzleHttp\Client;
	use GuzzleHttp\RequestOptions;


	class Mula
	{
		//private static const $programCounter;

		//send request and get response from mula group payments api
		private function getReponse($json){
			$client = new Client();
			$url = "https://mula.co.ke/mula_ke/api/v1/";
					
			$response = $client->post($url, [
				RequestOptions::JSON => $json,
			]);
	
			$result = $response->getBody();
			return $result;
		}

		/**
		 * ----------  API FUNCTIONS  -----
		 */

		// Accept an Admin Request
		public function acceptAdmin(){

			$json = ([
				"EXTRA_DATA" => "",
				"SERVICE_CODE" => "",
				"BILLS" => "",
				"ORIGIN" => "MULA_APP",
				"DEVICE_NAME" => "Xiaomi Mi A1",
				"APP_VERSION" => "3.0.10",
				"API_LEVEL" => "26",
				"ENCRYPTION_KEY" => "10387168104116",
				"IS_MULTIPLE" => "1",
				"OS_VERSION" => "8.0.0",
				"PARSE_INSTALLATION_ID" => "cSwASLU1vDk:APA91bFPRyop7KlqdKmskVI3-SweN3neUjcJx2t46QuPB9nDTTjT_mVHi9QEM5k6uxd-_USd2DPsqn8gsOcglRfhmYcJWnyQj6q5nk2FGErLka7UnauTG1SBf55W22tFsTSpV1Uf84PPIpXVUfGz_Be6bRyfU92KMA",
				"UUID" => "867559035615761",
				"ACCOUNT_NUMBER" => "254711578070",
				"SESSION_ID" => "55sojm048qtqr72rnqrj3p81g3",
				"SERVICE" => "GMGT",
				"ACTION"  => "ACCEPT_REQUEST", 
				"CLIENT_ID"  => "105",
				"MSISDN" => "254717124841",
				"GROUP_ID"  => 475,
				"ITEM_ACTION"  => "MAKE_ADMIN",
				"REQUEST_ID"  => 14582
			]);

			return $this->getResponse($json);
		}

		// Accept a Member Invite
		public function acceptInvite(){

			$json = ([
				"EXTRA_DATA" => "",
				"SERVICE_CODE" => "",
				"BILLS" => "",
				"ORIGIN" => "MULA_APP",
				"DEVICE_NAME" => "Xiaomi Mi A1",
				"APP_VERSION" => "3.0.10",
				"API_LEVEL" => "26",
				"ENCRYPTION_KEY" => "10387168104116",
				"IS_MULTIPLE" => "1",
				"OS_VERSION" => "8.0.0",
				"PARSE_INSTALLATION_ID" => "cSwASLU1vDk:APA91bFPRyop7KlqdKmskVI3-SweN3neUjcJx2t46QuPB9nDTTjT_mVHi9QEM5k6uxd-_USd2DPsqn8gsOcglRfhmYcJWnyQj6q5nk2FGErLka7UnauTG1SBf55W22tFsTSpV1Uf84PPIpXVUfGz_Be6bRyfU92KMA",
				"UUID" => "867559035615761",
				"ACCOUNT_NUMBER" => "254711578070",
				"SESSION_ID" => "55sojm048qtqr72rnqrj3p81g3",
				 "SERVICE" => "GMGT",
				 "ACTION" => "ACCEPT_INVITE",
				 "CLIENT_ID" => "105",
				 "MSISDN" => "0732788447",
				 "GROUP_ID" => 553
			]);

			return $this->getReponse($json);

		}

		// Accept a Signatory Request
		public function acceptSignatory(){
			$json = ([
				"EXTRA_DATA" => "",
				"SERVICE_CODE" => "",
				"BILLS" => "",
				"ORIGIN" => "MULA_APP",
				"DEVICE_NAME" => "Xiaomi Mi A1",
				"APP_VERSION" => "3.0.10",
				"API_LEVEL" => "26",
				"ENCRYPTION_KEY" => "10387168104116",
				"IS_MULTIPLE" => "1",
				"OS_VERSION" => "8.0.0",
				"PARSE_INSTALLATION_ID" => "cSwASLU1vDk:APA91bFPRyop7KlqdKmskVI3-SweN3neUjcJx2t46QuPB9nDTTjT_mVHi9QEM5k6uxd-_USd2DPsqn8gsOcglRfhmYcJWnyQj6q5nk2FGErLka7UnauTG1SBf55W22tFsTSpV1Uf84PPIpXVUfGz_Be6bRyfU92KMA",
				"UUID" => "867559035615761",
				"ACCOUNT_NUMBER" => "254711578070",
				"SESSION_ID" => "55sojm048qtqr72rnqrj3p81g3",
				"SERVICE" => "GMGT",
				"ACTION"  => "ACCEPT_REQUEST", 
				"CLIENT_ID"  => "105",
				"MSISDN" => "254717124841",
				"GROUP_ID"  => 475,
				"ITEM_ACTION"  => "MAKE_SIGNATORY",
				"REQUEST_ID"  => 14610
			]);

			return $this->getReponse($json);
		}

		// Add members
		public function addMembers(){

			$json = ([
				"EXTRA_DATA" => "",
				"SERVICE_CODE" => "",
				"BILLS" => "",
				"ORIGIN" => "MULA_APP",
				"DEVICE_NAME" => "Xiaomi Mi A1",
				"APP_VERSION" => "3.0.10",
				"API_LEVEL" => "26",
				"ENCRYPTION_KEY" => "10387168104116",
				"IS_MULTIPLE" => "1",
				"OS_VERSION" => "8.0.0",
				"PARSE_INSTALLATION_ID" => "cSwASLU1vDk:APA91bFPRyop7KlqdKmskVI3-SweN3neUjcJx2t46QuPB9nDTTjT_mVHi9QEM5k6uxd-_USd2DPsqn8gsOcglRfhmYcJWnyQj6q5nk2FGErLka7UnauTG1SBf55W22tFsTSpV1Uf84PPIpXVUfGz_Be6bRyfU92KMA",
				"UUID" => "867559035615761",
				"ACCOUNT_NUMBER" => "254711578070",
				"SESSION_ID" => "55sojm048qtqr72rnqrj3p81g3",
			   	"SERVICE" => "GMGT",
				"ACTION" => "ADD_MEMBERS",
				"CLIENT_ID" => "105",
				"MSISDN" => "0732788447",
				"GROUP_ID" => "475",
				"GROUP_MEMBERS" => "[ {\"MSISDN\":\"0717124841\"}]"
			]);

			return $this->getResponse($json);
		}

		// Approve CashOut request
		public function approveCashOut(){
			$json = ([
				"EXTRA_DATA" => "",
				"SERVICE_CODE" => "",
				"BILLS" => "",
				"ORIGIN" => "MULA_APP",
				"DEVICE_NAME" => "Xiaomi Mi A1",
				"APP_VERSION" => "3.0.10",
				"API_LEVEL" => "26",
				"ENCRYPTION_KEY" => "10387168104116",
				"IS_MULTIPLE" => "1",
				"OS_VERSION" => "8.0.0",
				"PARSE_INSTALLATION_ID" => "cSwASLU1vDk:APA91bFPRyop7KlqdKmskVI3-SweN3neUjcJx2t46QuPB9nDTTjT_mVHi9QEM5k6uxd-_USd2DPsqn8gsOcglRfhmYcJWnyQj6q5nk2FGErLka7UnauTG1SBf55W22tFsTSpV1Uf84PPIpXVUfGz_Be6bRyfU92KMA",
				"UUID" => "867559035615761",
				"ACCOUNT_NUMBER" => "254711578070",
				"SESSION_ID" => "55sojm048qtqr72rnqrj3p81g3",
			 	"SERVICE" => "GMGT",
				"ACTION" => "CASH_OUT_APPROVAL",
				"CLIENT_ID" => "105",
				"MSISDN" => "254721576842",
				"GROUP_ID" => "341",
				"REQUEST_ID" => 9478,
				"ITEM_ACTION" => "APPROVE"
			]);

			return $this->getResponse($json);
		}

		// Create Group
		public function createGroup($groupName,$groupDescription,$amount,$phoneNumber){

			$json = ([
				"EXTRA_DATA" => "",
				"SERVICE_CODE" => "",
				"BILLS" => "",
				"DEVICE_NAME" => "Xiaomi Mi A1",
				"APP_VERSION" => "3.0.10",
				"API_LEVEL" => "26",
				"ENCRYPTION_KEY" => "10387168104116",
				"IS_MULTIPLE" => "1",
				"OS_VERSION" => "8.0.0",
				"PARSE_INSTALLATION_ID" => "cSwASLU1vDk:APA91bFPRyop7KlqdKmskVI3-SweN3neUjcJx2t46QuPB9nDTTjT_mVHi9QEM5k6uxd-_USd2DPsqn8gsOcglRfhmYcJWnyQj6q5nk2FGErLka7UnauTG1SBf55W22tFsTSpV1Uf84PPIpXVUfGz_Be6bRyfU92KMA",
				"UUID" => "867559035615761",
				"ACCOUNT_NUMBER" => "254711578070",
				"SESSION_ID" => "55sojm048qtqr72rnqrj3p81g3",
				"SERVICE" => "GMGT",
				"ACTION" => "CREATE_GROUP",
				"CLIENT_ID" => "105",
				"MSISDN" => "0717124841",
				"ORIGIN" => "MULA_APP",
				"GROUP_NAME" => $groupName,
				"GROUP_TYPE_ID" => "1",
				"GROUP_FREQUENCY" => "WEEKLY",
				"AMOUNT" => $amount,
				"GROUP_DUE_DATE" => "2018-04-20 13:06:00",
				"GROUP_MEMBERS" => "[{\"MSISDN\":\"0717124841\", \"NAMES\":\"Max N\"}, {\"MSISDN\":\"0797784827\"}]"
			]);

			//return $this->getReponse($json);
		}

		// Delete Group
		public function deleteGroup(){
			$json = ([
				"EXTRA_DATA" => "",
				"SERVICE_CODE" => "",
				"BILLS" => "",
				"ORIGIN" => "MULA_APP",
				"DEVICE_NAME" => "Xiaomi Mi A1",
				"APP_VERSION" => "3.0.10",
				"API_LEVEL" => "26",
				"ENCRYPTION_KEY" => "10387168104116",
				"IS_MULTIPLE" => "1",
				"OS_VERSION" => "8.0.0",
				"PARSE_INSTALLATION_ID" => "cSwASLU1vDk:APA91bFPRyop7KlqdKmskVI3-SweN3neUjcJx2t46QuPB9nDTTjT_mVHi9QEM5k6uxd-_USd2DPsqn8gsOcglRfhmYcJWnyQj6q5nk2FGErLka7UnauTG1SBf55W22tFsTSpV1Uf84PPIpXVUfGz_Be6bRyfU92KMA",
				"UUID" => "867559035615761",
				"ACCOUNT_NUMBER" => "254711578070",
				"SESSION_ID" => "55sojm048qtqr72rnqrj3p81g3",
				"SERVICE" => "GMGT",
				"ACTION" => "DELETE_GROUP",
				"CLIENT_ID" => "105",
				"MSISDN" => "254717124841",
				"GROUP_ID" => 461
			]);

			return $this->getResponse($json);
		}

		// Fetch Groups by MSISDN
		public function fetchGroups($phoneNumber){
			
			$json = ([
				"EXTRA_DATA" => "",
				"SERVICE_CODE" => "",
				"BILLS" => "",
				"ORIGIN" => "USSD",
				"DEVICE_NAME" => "Xiaomi Mi A1",
				"APP_VERSION" => "3.0.10",
				"API_LEVEL" => "26",
				"ENCRYPTION_KEY" => "10387168104116",
				"IS_MULTIPLE" => "1",
				"OS_VERSION" => "8.0.0",
				"PARSE_INSTALLATION_ID" => "cSwASLU1vDk:APA91bFPRyop7KlqdKmskVI3-SweN3neUjcJx2t46QuPB9nDTTjT_mVHi9QEM5k6uxd-_USd2DPsqn8gsOcglRfhmYcJWnyQj6q5nk2FGErLka7UnauTG1SBf55W22tFsTSpV1Uf84PPIpXVUfGz_Be6bRyfU92KMA",
				"UUID" => "867559035615761",
				"ACCOUNT_NUMBER" => "254711578070",
				"SESSION_ID" => "55sojm048qtqr72rnqrj3p81g3",
			   "SERVICE" => "GMGT",
			   "ACTION" => "FETCH_GROUPS",
			   "CLIENT_ID" => "105",
			   "MSISDN" => "254732788447"
			]);
			
			return $this->getReponse($json);
		}

		// View Group Information
		public function fetchGroupInformation($groupId){
			$json = ([
				"EXTRA_DATA" => "",
				"SERVICE_CODE" => "",
				"BILLS" => "",
				"ORIGIN" => "USSD",
				"DEVICE_NAME" => "Xiaomi Mi A1",
				"APP_VERSION" => "3.0.10",
				"API_LEVEL" => "26",
				"ENCRYPTION_KEY" => "10387168104116",
				"IS_MULTIPLE" => "1",
				"OS_VERSION" => "8.0.0",
				"PARSE_INSTALLATION_ID" => "cSwASLU1vDk:APA91bFPRyop7KlqdKmskVI3-SweN3neUjcJx2t46QuPB9nDTTjT_mVHi9QEM5k6uxd-_USd2DPsqn8gsOcglRfhmYcJWnyQj6q5nk2FGErLka7UnauTG1SBf55W22tFsTSpV1Uf84PPIpXVUfGz_Be6bRyfU92KMA",
				"UUID" => "867559035615761",
				"ACCOUNT_NUMBER" => "254711578070",
				"SESSION_ID" => "55sojm048qtqr72rnqrj3p81g3",
				"SERVICE" => "GMGT",
				"ACTION" => "FETCH_GROUP_DATA",
				"MSISDN" =>  "254717124841", 
				"CLIENT_ID" => "105",
				"GROUP_ID" => $groupId
			]);
	
			return $this->getReponse($json);
		}

		//Fetch Group Types
		public function fetchGroupTypes(){
			$json = ([
				"EXTRA_DATA" => "",
				"SERVICE_CODE" => "",
				"BILLS" => "",
				"ORIGIN" => "MULA_APP",
				"DEVICE_NAME" => "Xiaomi Mi A1",
				"APP_VERSION" => "3.0.10",
				"API_LEVEL" => "26",
				"ENCRYPTION_KEY" => "10387168104116",
				"IS_MULTIPLE" => "1",
				"OS_VERSION" => "8.0.0",
				"PARSE_INSTALLATION_ID" => "cSwASLU1vDk:APA91bFPRyop7KlqdKmskVI3-SweN3neUjcJx2t46QuPB9nDTTjT_mVHi9QEM5k6uxd-_USd2DPsqn8gsOcglRfhmYcJWnyQj6q5nk2FGErLka7UnauTG1SBf55W22tFsTSpV1Uf84PPIpXVUfGz_Be6bRyfU92KMA",
				"UUID" => "867559035615761",
				"ACCOUNT_NUMBER" => "254711578070",
				"SESSION_ID" => "55sojm048qtqr72rnqrj3p81g3",
				"CLIENT_ID" => "105",
				"SERVICE" => "GMGT",
				"ACTION" => "FETCH_GROUP_TYPES",
				"MSISDN" => "254717124841"
			]);
			return $this->getResponse($json);
		}

		// Fetch user's Pledges
		public function fetchPledges($phoneNumber){

			$json = ([
				"EXTRA_DATA" => "",
				"SERVICE_CODE" => "",
				"BILLS" => "",
				"DEVICE_NAME" => "Xiaomi Mi A1",
				"APP_VERSION" => "3.0.10",
				"API_LEVEL" => "26",
				"ENCRYPTION_KEY" => "10387168104116",
				"IS_MULTIPLE" => "1",
				"OS_VERSION" => "8.0.0",
				"PARSE_INSTALLATION_ID" => "cSwASLU1vDk:APA91bFPRyop7KlqdKmskVI3-SweN3neUjcJx2t46QuPB9nDTTjT_mVHi9QEM5k6uxd-_USd2DPsqn8gsOcglRfhmYcJWnyQj6q5nk2FGErLka7UnauTG1SBf55W22tFsTSpV1Uf84PPIpXVUfGz_Be6bRyfU92KMA",
				"UUID" => "867559035615761",
				"ACCOUNT_NUMBER" => "254711578070",
				"SESSION_ID" => "55sojm048qtqr72rnqrj3p81g3",
				"SERVICE" => "GMGT",
				"ACTION" => "FETCH_PLEDGE",
				"ORIGIN" => "MULA_APP",
				"MSISDN" => "254717124841",
				"CLIENT_ID" => "105",
				"GROUP_ID" => 553
			]);
	
			return $this->getReponse($json);
		}

		// Group Balance Enquiry
		public function groupBalance($id){

			$json = ([
				"EXTRA_DATA" => "",
				"SERVICE_CODE" => "",
				"BILLS" => "",
				"DEVICE_NAME" => "Xiaomi Mi A1",
				"APP_VERSION" => "3.0.10",
				"API_LEVEL" => "26",
				"ENCRYPTION_KEY" => "10387168104116",
				"IS_MULTIPLE" => "1",
				"OS_VERSION" => "8.0.0",
				"PARSE_INSTALLATION_ID" => "cSwASLU1vDk:APA91bFPRyop7KlqdKmskVI3-SweN3neUjcJx2t46QuPB9nDTTjT_mVHi9QEM5k6uxd-_USd2DPsqn8gsOcglRfhmYcJWnyQj6q5nk2FGErLka7UnauTG1SBf55W22tFsTSpV1Uf84PPIpXVUfGz_Be6bRyfU92KMA",
				"UUID" => "867559035615761",
				"ACCOUNT_NUMBER" => "254711578070",
				"SESSION_ID" => "55sojm048qtqr72rnqrj3p81g3",
				"SERVICE" => "GMGT",
				"CLIENT_ID" => "105",
				"MSISDN" => "254717124841",
				"ORIGIN" => "MULA_APP",
				"ACTION" => "GROUP_BALANCE_ENQUIRY",
				"GROUP_ID" => "553"
			]);
	
			return $this->getReponse($json);
		}

		// Group Payment Reminder
		public function groupPaymentReminder(){
			$json = ([
				"EXTRA_DATA" => "",
				"SERVICE_CODE" => "",
				"BILLS" => "",
				"ORIGIN" => "MULA_APP",
				"DEVICE_NAME" => "Xiaomi Mi A1",
				"APP_VERSION" => "3.0.10",
				"API_LEVEL" => "26",
				"ENCRYPTION_KEY" => "10387168104116",
				"IS_MULTIPLE" => "1",
				"OS_VERSION" => "8.0.0",
				"PARSE_INSTALLATION_ID" => "cSwASLU1vDk:APA91bFPRyop7KlqdKmskVI3-SweN3neUjcJx2t46QuPB9nDTTjT_mVHi9QEM5k6uxd-_USd2DPsqn8gsOcglRfhmYcJWnyQj6q5nk2FGErLka7UnauTG1SBf55W22tFsTSpV1Uf84PPIpXVUfGz_Be6bRyfU92KMA",
				"UUID" => "867559035615761",
				"ACCOUNT_NUMBER" => "254711578070",
				"SESSION_ID" => "55sojm048qtqr72rnqrj3p81g3",
				"SERVICE" => "GMGT",
				"CLIENT_ID" =>"105",
				"MSISDN" => "254717124841",
				"ACTION" => "GROUP_PAYMENT_REMINDER",
				"GROUP_ID" => "390",
				"MEMBER_MSISDN" => "254732788447",
				"AMOUNT" => "100"
			]);

			return $this->getResponse($json);
		}

		// Group Cash Payment
		public function groupCashPayment(){
			$json = ([
				"EXTRA_DATA" => "",
				"SERVICE_CODE" => "",
				"BILLS" => "",
				"ORIGIN" => "MULA_APP",
				"DEVICE_NAME" => "Xiaomi Mi A1",
				"APP_VERSION" => "3.0.10",
				"API_LEVEL" => "26",
				"ENCRYPTION_KEY" => "10387168104116",
				"IS_MULTIPLE" => "1",
				"OS_VERSION" => "8.0.0",
				"PARSE_INSTALLATION_ID" => "cSwASLU1vDk:APA91bFPRyop7KlqdKmskVI3-SweN3neUjcJx2t46QuPB9nDTTjT_mVHi9QEM5k6uxd-_USd2DPsqn8gsOcglRfhmYcJWnyQj6q5nk2FGErLka7UnauTG1SBf55W22tFsTSpV1Uf84PPIpXVUfGz_Be6bRyfU92KMA",
				"UUID" => "867559035615761",
				"ACCOUNT_NUMBER" => "254711578070",
				"SESSION_ID" => "55sojm048qtqr72rnqrj3p81g3",
				"SERVICE" => "GMGT",
				"CLIENT_ID" =>"105",
				"MSISDN" => "254717124841",
				"ACTION" => "CASH_PAYMENT",
				"GROUP_ID" => "553",
				"MEMBER_MSISDN" => "254732788447",
				"AMOUNT" => "10"
			]);

			return $this->getResponse($json);
		}

		// Make a member an Admin
		public function makeMemberAdmin(){

			$json=([
				"EXTRA_DATA" => "",
				"SERVICE_CODE" => "",
				"BILLS" => "",
				"ORIGIN" => "MULA_APP",
				"DEVICE_NAME" => "Xiaomi Mi A1",
				"APP_VERSION" => "3.0.10",
				"API_LEVEL" => "26",
				"ENCRYPTION_KEY" => "10387168104116",
				"IS_MULTIPLE" => "1",
				"OS_VERSION" => "8.0.0",
				"PARSE_INSTALLATION_ID" => "cSwASLU1vDk:APA91bFPRyop7KlqdKmskVI3-SweN3neUjcJx2t46QuPB9nDTTjT_mVHi9QEM5k6uxd-_USd2DPsqn8gsOcglRfhmYcJWnyQj6q5nk2FGErLka7UnauTG1SBf55W22tFsTSpV1Uf84PPIpXVUfGz_Be6bRyfU92KMA",
				"UUID" => "867559035615761",
				"ACCOUNT_NUMBER" => "254711578070",
				"SESSION_ID" => "55sojm048qtqr72rnqrj3p81g3",
				 "SERVICE" => "GMGT",
				 "ACTION" => "CREATE_ADMIN",
				 "CLIENT_ID" => "105",
				 "MSISDN" => "254732788447",
				 "GROUP_ID" => "475",
				 "MEMBER_MSISDN" => "254717124841"
			]);

			return $this->getResponse($json);
		}

		// Make a member a Signatory
		public function makeMemberSignatory(){

			$json=([
				"EXTRA_DATA" => "",
				"SERVICE_CODE" => "",
				"BILLS" => "",
				"ORIGIN" => "MULA_APP",
				"DEVICE_NAME" => "Xiaomi Mi A1",
				"APP_VERSION" => "3.0.10",
				"API_LEVEL" => "26",
				"ENCRYPTION_KEY" => "10387168104116",
				"IS_MULTIPLE" => "1",
				"OS_VERSION" => "8.0.0",
				"PARSE_INSTALLATION_ID" => "cSwASLU1vDk:APA91bFPRyop7KlqdKmskVI3-SweN3neUjcJx2t46QuPB9nDTTjT_mVHi9QEM5k6uxd-_USd2DPsqn8gsOcglRfhmYcJWnyQj6q5nk2FGErLka7UnauTG1SBf55W22tFsTSpV1Uf84PPIpXVUfGz_Be6bRyfU92KMA",
				"UUID" => "867559035615761",
				"ACCOUNT_NUMBER" => "254711578070",
				"SESSION_ID" => "55sojm048qtqr72rnqrj3p81g3",
				 "SERVICE" => "GMGT",
				 "ACTION" => "CREATE_SIGNATORY",
				 "CLIENT_ID" => "105",
				 "MSISDN" => "254732788447",
				 "GROUP_ID" => "475",
				 "MEMBER_MSISDN" => "254717124841"
			]);

			return $this->getResponse($json);
		}

		// Reject an Admin Request
		public function rejectAdmin(){

			$json = ([
				"EXTRA_DATA" => "",
				"SERVICE_CODE" => "",
				"BILLS" => "",
				"ORIGIN" => "MULA_APP",
				"DEVICE_NAME" => "Xiaomi Mi A1",
				"APP_VERSION" => "3.0.10",
				"API_LEVEL" => "26",
				"ENCRYPTION_KEY" => "10387168104116",
				"IS_MULTIPLE" => "1",
				"OS_VERSION" => "8.0.0",
				"PARSE_INSTALLATION_ID" => "cSwASLU1vDk:APA91bFPRyop7KlqdKmskVI3-SweN3neUjcJx2t46QuPB9nDTTjT_mVHi9QEM5k6uxd-_USd2DPsqn8gsOcglRfhmYcJWnyQj6q5nk2FGErLka7UnauTG1SBf55W22tFsTSpV1Uf84PPIpXVUfGz_Be6bRyfU92KMA",
				"UUID" => "867559035615761",
				"ACCOUNT_NUMBER" => "254711578070",
				"SESSION_ID" => "55sojm048qtqr72rnqrj3p81g3",
				 "SERVICE" => "GMGT",
				 "ACTION" => "REJECT_REQUEST",
				 "CLIENT_ID" => "105",
				 "MSISDN" => "254732788447",
				 "GROUP_ID" => 294,
				 "ITEM_ACTION" => "MAKE_ADMIN",
				 "REQUEST_ID" =>  13736
			]);

			return $this->getResponse($json);
		}

		// Reject Member Invite
		public function rejectInvite(){

			$json = ([
				"EXTRA_DATA" => "",
				"SERVICE_CODE" => "",
				"BILLS" => "",
				"ORIGIN" => "MULA_APP",
				"DEVICE_NAME" => "Xiaomi Mi A1",
				"APP_VERSION" => "3.0.10",
				"API_LEVEL" => "26",
				"ENCRYPTION_KEY" => "10387168104116",
				"IS_MULTIPLE" => "1",
				"OS_VERSION" => "8.0.0",
				"PARSE_INSTALLATION_ID" => "cSwASLU1vDk:APA91bFPRyop7KlqdKmskVI3-SweN3neUjcJx2t46QuPB9nDTTjT_mVHi9QEM5k6uxd-_USd2DPsqn8gsOcglRfhmYcJWnyQj6q5nk2FGErLka7UnauTG1SBf55W22tFsTSpV1Uf84PPIpXVUfGz_Be6bRyfU92KMA",
				"UUID" => "867559035615761",
				"ACCOUNT_NUMBER" => "254711578070",
				"SESSION_ID" => "55sojm048qtqr72rnqrj3p81g3",
				 "SERVICE" => "GMGT",
				 "ACTION" => "REJECT_INVITE",
				 "CLIENT_ID" => "105",
				 "MSISDN" => "254732788447",
				 "GROUP_ID" => 294
			]);

			return $this->getResponse($json);
		}

		// Reject a Signatory Request
		public function rejectSignatory(){

			$json = ([
				"EXTRA_DATA" => "",
				"SERVICE_CODE" => "",
				"BILLS" => "",
				"ORIGIN" => "MULA_APP",
				"DEVICE_NAME" => "Xiaomi Mi A1",
				"APP_VERSION" => "3.0.10",
				"API_LEVEL" => "26",
				"ENCRYPTION_KEY" => "10387168104116",
				"IS_MULTIPLE" => "1",
				"OS_VERSION" => "8.0.0",
				"PARSE_INSTALLATION_ID" => "cSwASLU1vDk:APA91bFPRyop7KlqdKmskVI3-SweN3neUjcJx2t46QuPB9nDTTjT_mVHi9QEM5k6uxd-_USd2DPsqn8gsOcglRfhmYcJWnyQj6q5nk2FGErLka7UnauTG1SBf55W22tFsTSpV1Uf84PPIpXVUfGz_Be6bRyfU92KMA",
				"UUID" => "867559035615761",
				"ACCOUNT_NUMBER" => "254711578070",
				"SESSION_ID" => "55sojm048qtqr72rnqrj3p81g3",
				 "SERVICE" => "GMGT",
				 "ACTION" => "REJECT_REQUEST",
				 "CLIENT_ID" => "105",
				 "MSISDN" => "254732788447",
				 "GROUP_ID" => 390,
				"ITEM_ACTION" => "MAKE_SIGNATORY",
				"REQUEST_ID" => 9757
			]);

			return $this->getResponse($json);
		}

		// Resend Invite
		public function resendInvite(){
			
			$json = ([
				"EXTRA_DATA" => "",
				"SERVICE_CODE" => "",
				"BILLS" => "",
				"DEVICE_NAME" => "Xiaomi Mi A1",
				"APP_VERSION" => "3.0.10",
				"API_LEVEL" => "26",
				"ENCRYPTION_KEY" => "10387168104116",
				"IS_MULTIPLE" => "1",
				"OS_VERSION" => "8.0.0",
				"PARSE_INSTALLATION_ID" => "cSwASLU1vDk:APA91bFPRyop7KlqdKmskVI3-SweN3neUjcJx2t46QuPB9nDTTjT_mVHi9QEM5k6uxd-_USd2DPsqn8gsOcglRfhmYcJWnyQj6q5nk2FGErLka7UnauTG1SBf55W22tFsTSpV1Uf84PPIpXVUfGz_Be6bRyfU92KMA",
				"UUID" => "867559035615761",
				"ACCOUNT_NUMBER" => "254711578070",
				"SESSION_ID" => "55sojm048qtqr72rnqrj3p81g3",
			   "SERVICE" => "GMGT",
			   "CLIENT_ID" => "105",
			   "ORIGIN" => "MULA_APP",
			   "MSISDN" => "254717124841",
			   "ACTION" => "RESEND_INVITE",
			   "GROUP_ID" => "390",
			   "MEMBER_MSISDN" => "254732788447"
			]);

			return $this->getResponse();
		}		

		// Make a cashout request
		public function requestCashOut(){
			$json = ([
				"EXTRA_DATA" => "",
				"SERVICE_CODE" => "",
				"BILLS" => "",
				"ORIGIN" => "MULA_APP",
				"DEVICE_NAME" => "Xiaomi Mi A1",
				"APP_VERSION" => "3.0.10",
				"API_LEVEL" => "26",
				"ENCRYPTION_KEY" => "10387168104116",
				"IS_MULTIPLE" => "1",
				"OS_VERSION" => "8.0.0",
				"PARSE_INSTALLATION_ID" => "cSwASLU1vDk:APA91bFPRyop7KlqdKmskVI3-SweN3neUjcJx2t46QuPB9nDTTjT_mVHi9QEM5k6uxd-_USd2DPsqn8gsOcglRfhmYcJWnyQj6q5nk2FGErLka7UnauTG1SBf55W22tFsTSpV1Uf84PPIpXVUfGz_Be6bRyfU92KMA",
				"UUID" => "867559035615761",
				"ACCOUNT_NUMBER" => "254711578070",
				"SESSION_ID" => "55sojm048qtqr72rnqrj3p81g3",
			   "SERVICE" => "GMGT",
			   "ACTION" => "CASH_OUT_REQUEST",
			   "CLIENT_ID" => "105",
			   "MSISDN" => "254732788447",
			   "GROUP_ID" => "475",
			   "AMOUNT" => "100",
			   "RECIPIENT_MSISDN" => "254721263140",
			   "PAYER_CLIENT_ID" => 9
			]);

			return $this->getResponse($json);
		}

		// Revoke Admin
		public function revokeAdmin(){
			$json = ([
				"EXTRA_DATA" => "",
				"SERVICE_CODE" => "",
				"BILLS" => "",
				"ORIGIN" => "MULA_APP",
				"DEVICE_NAME" => "Xiaomi Mi A1",
				"APP_VERSION" => "3.0.10",
				"API_LEVEL" => "26",
				"ENCRYPTION_KEY" => "10387168104116",
				"IS_MULTIPLE" => "1",
				"OS_VERSION" => "8.0.0",
				"PARSE_INSTALLATION_ID" => "cSwASLU1vDk:APA91bFPRyop7KlqdKmskVI3-SweN3neUjcJx2t46QuPB9nDTTjT_mVHi9QEM5k6uxd-_USd2DPsqn8gsOcglRfhmYcJWnyQj6q5nk2FGErLka7UnauTG1SBf55W22tFsTSpV1Uf84PPIpXVUfGz_Be6bRyfU92KMA",
				"UUID" => "867559035615761",
				"ACCOUNT_NUMBER" => "254711578070",
				"SESSION_ID" => "55sojm048qtqr72rnqrj3p81g3",
				"SERVICE" => "GMGT",
				"ACTION" => "REVOKE_ADMIN", 
				"CLIENT_ID" => "105",
				"MSISDN" => "254732788447",
				"MEMBER_MSISDN" => "254717124841",
				"GROUP_ID" => 475
			]);

			return $this->getResponse($json);
		}

		// Revoke Signatory 
		public function revokeSignatory(){
			$json = ([
				"EXTRA_DATA" => "",
				"SERVICE_CODE" => "",
				"BILLS" => "",
				"ORIGIN" => "MULA_APP",
				"DEVICE_NAME" => "Xiaomi Mi A1",
				"APP_VERSION" => "3.0.10",
				"API_LEVEL" => "26",
				"ENCRYPTION_KEY" => "10387168104116",
				"IS_MULTIPLE" => "1",
				"OS_VERSION" => "8.0.0",
				"PARSE_INSTALLATION_ID" => "cSwASLU1vDk:APA91bFPRyop7KlqdKmskVI3-SweN3neUjcJx2t46QuPB9nDTTjT_mVHi9QEM5k6uxd-_USd2DPsqn8gsOcglRfhmYcJWnyQj6q5nk2FGErLka7UnauTG1SBf55W22tFsTSpV1Uf84PPIpXVUfGz_Be6bRyfU92KMA",
				"UUID" => "867559035615761",
				"ACCOUNT_NUMBER" => "254711578070",
				"SESSION_ID" => "55sojm048qtqr72rnqrj3p81g3",
				"SERVICE" => "GMGT",
				"ACTION" => "REVOKE_SIGNATORY", 
				"CLIENT_ID" => "105",
				"MSISDN" => "254732788447",
				"MEMBER_MSISDN" => "254717124841",
				"GROUP_ID" => 475
			]);

			return $this->getResponse($json);
		}

		// Update group Information
		public function updateGroupInformation(){
			$json =([
				"EXTRA_DATA" => "",
				"SERVICE_CODE" => "",
				"BILLS" => "",
				"DEVICE_NAME" => "Xiaomi Mi A1",
				"APP_VERSION" => "3.0.10",
				"API_LEVEL" => "26",
				"ENCRYPTION_KEY" => "10387168104116",
				"IS_MULTIPLE" => "1",
				"OS_VERSION" => "8.0.0",
				"PARSE_INSTALLATION_ID" => "cSwASLU1vDk:APA91bFPRyop7KlqdKmskVI3-SweN3neUjcJx2t46QuPB9nDTTjT_mVHi9QEM5k6uxd-_USd2DPsqn8gsOcglRfhmYcJWnyQj6q5nk2FGErLka7UnauTG1SBf55W22tFsTSpV1Uf84PPIpXVUfGz_Be6bRyfU92KMA",
				"UUID" => "867559035615761",
				"ACCOUNT_NUMBER" => "254711578070",
				"SESSION_ID" => "55sojm048qtqr72rnqrj3p81g3",
				"ORIGIN" => "MULA_APP",
				"SERVICE" => "GMGT",
				"ACTION" => "UPDATE_GROUP",
				"CLIENT_ID" => "105",
				"MSISDN" => "254717124841",
				"GROUP_NAME" => "Group name changed",
				"GROUP_DESCRIPTION" => "Group desc changed",
				"GROUP_ID" => "294",
				"GROUP_FREQUENCY" => "DAILY",
				"AMOUNT" => "150"
			]);

			return $this->getReponse($json);
		}
		
		// View group tranactions
		public function fetchGroupReport(){

			$json = ([
				"EXTRA_DATA" => "",
				"SERVICE_CODE"  => "",
				"BILLS"  => "",
				"DEVICE_NAME"  => "Xiaomi Mi A1",
				"APP_VERSION" => "3.0.10",
				"API_LEVEL" => "26",
				"ENCRYPTION_KEY" => "10387168104116",
				"IS_MULTIPLE" => "1",
				"OS_VERSION" => "8.0.0",
				"PARSE_INSTALLATION_ID" => "cSwASLU1vDk:APA91bFPRyop7KlqdKmskVI3-SweN3neUjcJx2t46QuPB9nDTTjT_mVHi9QEM5k6uxd-_USd2DPsqn8gsOcglRfhmYcJWnyQj6q5nk2FGErLka7UnauTG1SBf55W22tFsTSpV1Uf84PPIpXVUfGz_Be6bRyfU92KMA",
				"UUID" => "867559035615761",
				"ACCOUNT_NUMBER" => "254711578070",
				"SESSION_ID" => "55sojm048qtqr72rnqrj3p81g3",
				 "SERVICE" => "GMGT",
				 "ACTION" => "FETCH_GROUP_REPORT",
				 "ORIGIN" => "MULA_APP",
				 "MSISDN" => "254717124841", 
				 "CLIENT_ID" => "105",
				 "GROUP_ID" => 553				
			]);

			return $this->getReponse($json);
		}
		

	}
?>