<?php

	header("Access-Control-Allow-Origin: *");
 	header("Access-Control-Allow-Methods: PUT, GET, POST");
	header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

	class EncriptParams{
		/**
		* Encrypt the string of customer details with the IV and secret key.
		*
		* @param $payload Pass in the array of parameters to be pass to
		express checkout.
		* @return string
		*/
		public function encryptData ( $payload = []) {
			
			//The encryption method to be used
			$encrypt_method = "AES-256-CBC" ;
			
			// Hash the secret key
			$key = hash ( 'sha256' , "jhXLMrgyHTGF2DcP" );
			
			// Hash the iv - encrypt method AES-256-CBC expects 16 bytes
			$iv = substr ( hash ( 'sha256' , "fbjdcNwrVHMJk93Z" ), 0 , 16 );
			
			$encrypted = openssl_encrypt (json_encode ( $payload , true ), $encrypt_method , $key ,0 ,$iv);

			//Base 64 Encode the encrypted payload
			$encrypted = base64_encode ( $encrypted );
			return $encrypted ;
		}

	}

	$fp = fopen('php://input', 'r'); 
	$rawData = stream_get_contents($fp);
	$payload=json_decode($rawData,true);
	$encriptParams = new EncriptParams();

	$encryptedParams = $encriptParams -> encryptData($payload);

	$result = [
            
        ];


	echo json_encode(array('params' => $encryptedParams,
            'accessKey' => '$2a$08$mUzstyugC2iF3ZISWzuyx.GUYgkyh3R9nnIzK2pIs1QoBf.znmubq',
            'countryCode' => "KE")); 
?>