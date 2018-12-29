<?php

namespace app\components;

use Yii;
use app\libraries\GroupClass;

class Wallet{

    public static function getWalletBalance($groupID){
        //Get Phone Number from session
        $session = Yii::$app->session;
        if ($session->isActive){
            $phoneNumber = $session->get('phoneNumber');
        }

        //Parameters sent to API
        $args = ([
            $phoneNumber,    //MSISDN
            $groupID     //GROUP_ID
        ]);

        $group = new GroupClass();
        $balance = json_decode($group->groupBalanceEnquiry($args));
        $balance = $balance->DATA->ACCOUNT_BALANCE;

        return round($balance);
    }
}
?>