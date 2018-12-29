<?php

namespace app\libraries;

use Yii;

class GroupClass extends GroupManager{

    /**
     * Get Groups under a phone number
     * @param $phoneNumber
     * @return bool
     */
    public function GetGroups($phoneNumber){

        $args = ([$phoneNumber]);
        $query = json_decode($this->fetchGroups($args));
        if($query)
        {
            if($query->STATUS_CODE == 200)
            {
                $groups = $query->DATA->GROUPS;
                return $groups;
            }else{
                return false;
            }
        }else{
            /* if fetchGroups() failed */
            return false;
        }

    }

    /**
     *  Get Wallet Balance per Group
     *  @param $groupID
     *  @return float
     */
    public function GetWalletBalance($groupID,$adminNO){
        /*
         * Function to Fetch Wallet Balance of provided Group ID
         */

        //Parameters sent to API
        $args = ([
            $adminNO,    //MSISDN
            $groupID     //GROUP_ID
        ]);

        $query = $this->groupBalanceEnquiry($args);
        $balance = json_decode($query);
        $balance = $balance->DATA->ACCOUNT_BALANCE;
        return round($balance);

//        if($query)
//        {
//            $balance = json_decode($query);
//            if($balance->STATUS_CODE == 200)
//            {
//                $balance = $balance->DATA->ACCOUNT_BALANCE;
//                return round($balance);
//            }else{
//                /* groupBalanceEnquiry returned an error */
//                return false;
//            }
//        }else{
//            /* groupBalanceEnquiry() failed */
//            return false;
//        }
    }


    /**
     *  Get Pledges with Admin's as first item
     *  @return array|Boolean
     */
    public function GetOrderedPledges(){
        //get parameters from Session if User is logged in
        $session = Yii::$app->session;
        if ($session->has('Admin')){
            $phoneNumber = $session->get('phoneNumber');
            $groupID = $session->get('groupID');

            //Parameters sent to API
            $args = ([
                $phoneNumber,    //MSISDN
                $groupID     //GROUP_ID
            ]);

// return json_encode($args);
            //Get Pledges
            $query = $this->fetchPledge($args);
            if($query)
            {
                $pledges = json_decode($query);
                if($pledges->STATUS_CODE == 200)
                {
                    $pledges = $pledges->DATA->PLEDGES;

                    //order the pledges
                    foreach($pledges as $key=>$pledge)
                    {
                        if($pledge->MSISDN === $phoneNumber)
                        {
                            $temp = array($pledges[$key]);
                            unset($pledges[$key]);
                            $pledges = array_merge($temp,$pledges);
                            break;
                        }
                    }
                }else{
                    /* fetchPledge returned an error */
                    $pledges = [];
                }
            }else{
                /* fetchPledge failed */
                $pledges = [];
            }
        }else{
            $pledges = [];
        }

        return $pledges;
    }

/**
     *  Get Pledges with Admin's as first item
     *  @return array|Boolean
     */
    public function GetOrderedPledges2($num){
        //get parameters from Session if User is logged in
        $session = Yii::$app->session;
        if ($session->has('Admin')){
            $phoneNumber = $num;
            $groupID = $session->get('groupID');

            //Parameters sent to API
            $args = ([
                $phoneNumber,    //MSISDN
                $groupID     //GROUP_ID
            ]);

// return json_encode($args);
            //Get Pledges
            $query = $this->fetchPledge($args);
            if($query)
            {
                $pledges = json_decode($query);
                if($pledges->STATUS_CODE == 200)
                {
                    $pledges = $pledges->DATA->PLEDGES;

                    //order the pledges
                    foreach($pledges as $key=>$pledge)
                    {
                        if($pledge->MSISDN === $phoneNumber)
                        {
                            $temp = array($pledges[$key]);
                            unset($pledges[$key]);
                            $pledges = array_merge($temp,$pledges);
                            break;
                        }
                    }
                }else{
                    /* fetchPledge returned an error */
                    return false;
                }
            }else{
                /* fetchPledge failed */
                return false;
            }
        }else{
            $pledges = [];
        }

        return $pledges;
    }



    /**
     *  Get Wallet Balance per Group
     *  @param $groupID
     *  @return float
     */
    public function GetLogRequestData($userMSISDN,$userExtraData){
        /*
         * Function to Fetch Wallet Balance of provided Group ID
         */

        //Parameters sent to API
        $args = ([
            $userMSISDN,    //MSISDN
            $userExtraData     //EXTRA DATA
        ]);

        $lo = json_decode($this->logRequestAction($args));
        
        $requestLogData = $lo->DATA->REQUEST_LOG_ID;

        return $requestLogData;
    }
}