<?php

namespace app\libraries;

use app\libraries\Mula;

class ContributeClass extends Mula{
	
	public function PayForSelf($amount,$phone,$groupID){
        /* 
            user makes contribution for their own class
        */
        return $this->MulaPay($phone,$amount,$groupID);
    }

	public function PayForOther($amount,$phone,$groupID){
        /*
            user make contribution for another user
        */
        return $this->MulaPay($amount,$phone,$groupID);
    }
	
}
?>