<?php

namespace app\controllers;

use app\modules\admin\models\CashOuts;
use Yii;
use app\libraries\GroupClass;
use app\libraries\Encrypt;
use app\libraries\success;
use app\libraries\failed;
use app\libraries\payment_webhook;

class GroupController extends \yii\web\Controller
{
    /**
     * Displays groups that belong to a logged in user
     * @return string
     */
    public function actionIndex(){
        //get phoneNumber from Session
        $session = Yii::$app->session;
        $phoneNumber = $this->formatMSISDN(htmlspecialchars(strip_tags($session->get('phoneNumber'))), "KE");
        if (!($session->get("phoneNumber") != null || $session->get("groupAdmin_MSISDN") != null)) {
            return $this->redirect(["site/discover"]);
        }
        $query = new GroupClass();
        $groups = $query->GetGroups($phoneNumber);
        if(!$groups)
        {
            /*error status -- groups could not be fetched*/
            $groups = 1;
        }
        return $this->render('index',[
            'groups' => $groups
        ]);
    }


    /**
     * Displays forms to create fundraiser
     * @return bool|string|\yii\web\Response
     */
    public function actionCreate(){
        $post = Yii::$app->request->post();
        $session = Yii::$app->session;

        if ($post) {
            $model = new GroupClass();

            /* Check if POST data exists */
            if(isset($post['mnumber'])
                && isset($post['mname'])
                && isset($post['userid'])
                && isset($post['group-name'])
                && isset($post['group-desc'])
                && isset($post['amount-target'])
                && isset($post['timeline'])
                && isset($post['group-type']))
            {

                /* get post data */
                $phoneNumber = $this->formatMSISDN(htmlspecialchars(strip_tags($post['mnumber'])), "KE");
                $userName = htmlspecialchars(strip_tags($post['mname']));
                $userID = htmlspecialchars(strip_tags($post['userid']));
                $groupName = htmlspecialchars(strip_tags($post['group-name']));
                $groupDescription = htmlspecialchars(strip_tags($post['group-desc']));
                $groupAmount = htmlspecialchars(strip_tags($post['amount-target']));
                $groupDueDate = htmlspecialchars(strip_tags($post['timeline']));
                $groupType = htmlspecialchars(strip_tags($post['group-type']));

                if($groupType == "open")
                {
                    $groupType = true;
                }else{
                    $groupType = false;
                }

                /* Create Group */
                $args = ([
                    $phoneNumber,   //MSISDN
                    $userName,
                    $userID,
                    $groupName,   //GROUP_NAME
                    $groupDescription,   //GROUP_DESCRIPTION
                    "1",    //GROUP_TYPE_ID
                    "WEEKLY",   //GROUP_FREQUENCY
                    $groupAmount,  //AMOUNT
                    date('Y-m-d H:i:s', strtotime($groupDueDate)),  //GROUP_DUE_DATE
                    $groupType,
                    json_encode([
                        [
                            "MSISDN" => $phoneNumber
                        ]
                    ])
                ]);
                $query = $model->CreateGroup($args);

                if($query)
                {
                    //Fetch Group Information
                    $response = json_decode($query);
                    if($response->STATUS_CODE == 200)
                    {

                        $groupID =  $response->DATA->GROUP_DATA->DATA->GROUP_ID;
                        $num =  $response->DATA->GROUP_DATA->DATA->GROUP_ADMIN_MSISDN[0];   /* Pick first admin */

                        // Save login and group information to session
                        $session->set('groupID', $groupID);
                        $session->set('phoneNumber', $num);
                        $session->set('Admin', true);

                        /* Flag to trigger modal*/
                        $session->setFlash('CreateGroup', "Success");
                        return $this->redirect(['group/view']);
                    }else{
                        /* CreateGroup() returned an error */
                        $session->setFlash('msg-error', "An error occurred while creating your group.");
                        return $this->refresh();
                    }
                }else{
                    /* CreateGroup() failed */
                    $session->setFlash('msg-error', "An error occurred while creating your group. Please try again");
                    return $this->refresh();

                }
            }else{
                /* Fields missing */
                $session->setFlash('msg-error', "Required fields missing. Please try again");
                return $this->refresh();
            }
        }

        return $this->render('create');
    }

    /**
     * Displays and creates a pledge
     * @return string|\yii\web\Response
     */
    public function actionPledge(){
        $post = Yii::$app->request->post();
        $session = Yii::$app->session;

        if (!($session->get("groupID") != null || $session->get("groupAdmin_MSISDN") != null)) {
            // return $session->get("groupAdmin_MSISDN");
            return $this->redirect(['site/discover']);
        }

        if ($post) {
            if(isset($post['mnumber']) && isset($post['pledge-amount']) && isset($post['timeline']))
            {
                $model = new GroupClass();
                if($session->has('Admin'))  /* If User is logged in */
                {
                    $phoneNumber = $this->formatMSISDN(htmlspecialchars(strip_tags($session->get('phoneNumber'))), "KE");
                }else{
                    $phoneNumber = htmlspecialchars(strip_tags($post['mnumber']));
                }

                $groupID = htmlspecialchars(strip_tags($session->get('groupID')));
                $pledgePhoneNo = htmlspecialchars(strip_tags($post['mnumber']));
                $pledgeAmount = htmlspecialchars(strip_tags($post['pledge-amount']));
                $pledgeDueDate = htmlspecialchars(strip_tags($post['timeline']));

                $args = ([
                    $phoneNumber,
                    $pledgePhoneNo,
                    $groupID,
                    $pledgeAmount,
                    date('Y-m-d H:i:s', strtotime($pledgeDueDate)),
                ]);

                /* Make Pledge */
                $query = json_decode($model->makePledge($args));
                if($query)
                {
                    if($query->STATUS_CODE == 200)
                    {
                        $session->setFlash('msg-success', "Your pledge of ".number_format($pledgeAmount)."  was successfully created.");
                        return $this->redirect(['group/view']);
                    }else if($query->STATUS_CODE == 0){	
                        /* makePledge() returned an error */
                        $session->setFlash('msg-info', "Sorry this action can not be completed, you have a pending pledge.");
                        return $this->refresh();

                    }else{
                        /* makePledge() returned an error */
                        $session->setFlash('msg-error', "An error occurred while creating your pledge. Please try again.");
                        return $this->refresh();
                    }
                }else{
                    /* makePledge() did not execute successfully*/
                    $session->setFlash('msg-error', "An error occurred while creating your pledge. Please try again.");
                    return $this->refresh();
                }
            }else{
                /* Missing fields */
                $session->setFlash('msg-error', "Required fields missing. Please try again");
                return $this->refresh();
            }
        }
        return $this->render("pledge");
    }

    /**
     * Sets groupID to session
     * Redirects to view group dashboard
     * @param $id
     * @return \yii\web\Response
     */
    public function actionInfo($id){
        /* save group ID to session*/
        $session = Yii::$app->session;
        $session->set('groupID', $id);

        return $this->redirect(['group/view']);
    }


    /**
     * Displays view to edit group information
     * @return string
     */
    public function actionEdit(){
         //get Group ID from Session
         $session = Yii::$app->session;
         if (!($session->get("groupID") != null && $session->get("groupAdmin_MSISDN") != null && $session->get('phoneNumber') == $session->get('groupAdmin_MSISDN'))) {
             return $this->redirect(['group/view']);
         }
         $phoneNumber = $this->formatMSISDN(htmlspecialchars(strip_tags($session->get('phoneNumber'))), "KE");
         $groupID= htmlspecialchars(strip_tags($session->get('groupID')));


        //get Group Details
         $model = new GroupClass();
         $args = ([
             $phoneNumber,    //MSISDN
             $groupID     //GROUP_ID
            ]);
         $details = json_decode($model->fetchGroupData($args));
         if($details)
         {
             if($details->STATUS_CODE == 200)
             {
                 $details = $details->DATA;
                 return $this->render("edit",[
                     'details' => $details
                 ]);
             }else{
                 /* fetchGroupData returned an error  */
                 $session->setFlash('msg-error', "An error occurred while fetching group information");
                 return $this->redirect('[../group/view]');
             }
         }else{
             /* fetchGroupData failed to execute */
             $session->setFlash('msg-error', "An error occurred while fetching group information");
             return $this->redirect('[../group/view]');
         }

    }

    /**
     * Verifies User before withdrawal
     * @return \yii\web\Response
     */
    public function actionRequestWithdraw(){

        $post = Yii::$app->request->post();
        $session = Yii::$app->session;
        if(isset($post['request-withdraw-btn']))
        {
            /* Get Phone Number from Session */
            $phoneNumber = $this->formatMSISDN(htmlspecialchars(strip_tags($session->get('groupAdmin_MSISDN'))), "KE");

            /* Generate OTP PIN */
            $args = array("GENERATE", $phoneNumber);
            $group = new GroupClass();
            $query = $group->generateOtp($args);
//            return json_encode($phoneNumber);
            if($query)
            {
                $response = json_decode($query);
                if($response->STATUS_CODE == 200)
                {
                    $session->set("activate-vb", "true");
                    return  $this->redirect(['group/view']);
                }else{
                    /* generateOtp() returned an error  */
                    $session->setFlash('msg-error', "An error occurred during verification");
                    return $this->redirect(['group/view']);
                }
            }else{
                /* generateOtp() failed  */
                $session->setFlash('msg-error', "An error occurred during verification");
                return $this->redirect(['group/view']);
            }
        }
        return $this->redirect(['group/view']);
    }


    /**
     * Validates user OTP PIN before withdrawal
     * @return \yii\web\Response
     */
    public function actionVerifyWithdraw(){
        $session = Yii::$app->session;
        $post = Yii::$app->request->post();

        if (isset($post['verify-withdraw-btn'])) {
            if(isset($post['vcode-w']))
            {
                $otp_code = htmlspecialchars(strip_tags($post['vcode-w']));

                /* Get Phone Number from session */
                $phoneNumber = $this->formatMSISDN(htmlspecialchars(strip_tags($session->get('groupAdmin_MSISDN'))), "KE");

                /* Validate PIN */
                $group = new GroupClass();
                $args = array("VALIDATE", $phoneNumber, $otp_code);
                $query = $group->otpValidation($args);
                if($query)
                {
//                    return $query.','.$otp_code;
                    $response = json_decode($query);
                    if($response->STATUS_CODE == 200)
                    {
                        $session->set("activate-vb", "");
                        $session->set("isVerified", "true");
                        return $this->redirect(['group/withdraw']);
                    }else{
                        /* otpValidation() returned an error  */
                        $session->setFlash('msg-error', "Incorrect PIN");
                        $session->set("activate-vb", "false");
                        $session->set("withdraw-vstatus-msg", "failed");
                        return $this->redirect(['group/view']);
                    }

                }else{
                    /* otpValidation() failed */
                    $session->setFlash('msg-error', "An error occurred during verification");
                    return $this->redirect('[group/view]');
                }
            }
        }

    }


    /**
     * Updates Group Information
     * @return \yii\web\Response
     */
    public function actionUpdate(){
        
        $post = Yii::$app->request->post();

        /* If route receives post data */
        if($post)
        {
            $group = new GroupClass();
            $session = Yii::$app->session;

            /* Get phone number from session */
            $phoneNumber = $this->formatMSISDN(htmlspecialchars(strip_tags($session->get('groupAdmin_MSISDN'))), "KE");

            /* if required fields were posted */
            if(isset($post['edit-name']) && isset($post['edit-desc']) && isset($post['groupID']) && isset($post['edit-amount']) && isset($post['edit-amount']))
            {
                $groupName = htmlspecialchars(strip_tags($post['edit-name']));
                $groupDescription = htmlspecialchars(strip_tags($post['edit-desc']));
                $groupID = htmlspecialchars(strip_tags($post['groupID']));
                $groupAmount = htmlspecialchars(strip_tags($post['edit-amount']));
                $groupDueDate = htmlspecialchars(strip_tags($post['edit-timeline']));
                $groupType = htmlspecialchars(strip_tags($post['optradio']));

                if($groupType == "open")
                {
                    $groupType = true;
                }else{
                    $groupType = false;
                }

                /* Update Group Information */
                $args = ([
                    $phoneNumber,
                    $groupName,
                    $groupDescription,
                    $groupID,
                    'NONE',
                    $groupAmount,
                    date('Y-m-d H:i:s',strtotime($groupDueDate)),
                    $groupType
                ]);

                $query = $group->updateGroupInformation($args);
                if($query)
                {
                    $update = json_decode($query);
                    if($update->STATUS_CODE == 200)
                    {
                        $session->setFlash('msg-success', "Your Fundraiser details were successfully updated.");
                        return $this->redirect(['group/view']);
                    }else{
                        /* updateGroupInformation returned an error */
                        $session->setFlash('msg-error', "An error occurred while trying to update your fundraiser details.");
                        return $this->redirect(['group/view']);
                    }
                }else{
                    /* updateGroupInformation() failed */
                    $session->setFlash('msg-error', "An error occurred while trying to update your fundraiser details. Please try again later");
                    return $this->redirect(['group/view']);
                }
            }else{
                /* Missing fields */
                $session->setFlash('msg-error', "Some required fields are missing.");
                return $this->redirect(['group/view']);
            }
        }
        return $this->redirect(['group/view']);
    }


    /**
     * Deletes Group
     * @return \yii\web\Response
     */
    public function actionDelete(){
        $post = Yii::$app->request->post();
        $session = Yii::$app->session;

        /* If routes receives post data */
        if (isset($post['delete-group-btn'])) {
            /* Get phone number and groupID from session */
            $phoneNumber = $this->formatMSISDN(htmlspecialchars(strip_tags($session->get('groupAdmin_MSISDN'))), "KE");
            $groupID = htmlspecialchars(strip_tags($session->get('groupID')));

            /* Delete Group */
            $group = new GroupClass();
            $args = ([
                $phoneNumber,
                $groupID,
            ]);
            $query = $group->deleteGroup($args);
            if($query)
            {
                $delete = json_decode($query);
                if($delete->STATUS_CODE == 200) {
                    $session->setFlash('msg-success', "Your group was successfully deleted.");
                    return $this->redirect(['group/index']);
                }else{
                    /* updateGroupInformation() returned an error */
                    $session->setFlash('msg-error', "An error occurred while trying to delete your group.");
                    return $this->redirect(['group/view']);
                }
            }else{
                /* deleteGroup failed */
                $session->setFlash('msg-error', "An error occurred while trying to delete your group. Please try again later");
                return $this->redirect(['group/view']);
            }
        }
            return $this->redirect(['group/view']);
    }

    public function actionContribute(){
        
        $fp = fopen('php://input', 'r'); 
        $rawData = stream_get_contents($fp);
        $payload=json_decode($rawData,true);
        $encriptParams = new Encrypt();

        $encryptedParams = $encriptParams -> encryptData($payload);

        echo json_encode(array('params' => $encryptedParams,
                'accessKey' => '$2a$08$mUzstyugC2iF3ZISWzuyx.GUYgkyh3R9nnIzK2pIs1QoBf.znmubq',
                'countryCode' => 'KE'));
        
    }
    
    public function actionSuccess(){
         $success = new success();
    }
    
    public function actionFailed(){
         $failed = new failed();
    }

    public function actionPaymentwebhook(){
         $payment = new payment_webhook();
    }

    /**
     * Add Member
     * @return \yii\web\Response
     */
    public function actionAddMember(){
        $post = Yii::$app->request->post();
        /* If route receives post data */
        if($post)
        {
            //get PhoneNumber from Session
            $session = Yii::$app->session;
            $phoneNumber = $this->formatMSISDN(htmlspecialchars(strip_tags($session->get('phoneNumber'))), "KE");

            /*Ensure required fields*/
            if(isset($post['groupID']) && isset($post['mnumber']))
            {
                $groupID = htmlspecialchars(strip_tags($post['groupID']));
                $member = htmlspecialchars(strip_tags($post['mnumber']));

                /* Add Member */
                $args = ([
                    $phoneNumber,
                    $groupID,
                    json_encode([
                        [
                            "MSISDN" => $member
                        ]
                    ])
                ]);
                $group = new GroupClass();
                $query = $group->addMembers($args);
                if($query)
                {
                    $new_member = json_decode($query);
                    if($new_member->STATUS_CODE == 200)
                    {
                        $session->setFlash('msg-success', "A new member - ".$member." was successfully added.");
                        return $this->redirect(['group/view']);
                    }else{
                        /* addMembers() returned an error */
                        $session->setFlash('msg-error', "An error occurred while trying to add a member.");
                        return $this->redirect(['group/view']);
                    }
                }else{
                    /* addMembers() failed */
                    $session->setFlash('msg-error', "An error occurred while trying to add a member. Please try again ");
                    return $this->redirect(['group/view']);
                }
            }else{
                /* Missing fields */
                $session->setFlash('msg-error', "Some required fields are missing.");
                return $this->redirect(['group/view']);
            }
        }
        return $this->redirect(['group/view']);
    }


    /**
     * Add Signatory
     * @return \yii\web\Response
     */
    public function actionAddSignatory(){
        $post = Yii::$app->request->post();
        /* If route receives post data */
        if($post)
        {
            //get PhoneNumber from Session
            $session = Yii::$app->session;
            $phoneNumber = $this->formatMSISDN(htmlspecialchars(strip_tags($session->get('phoneNumber'))), "KE");

            /*Ensure required fields*/
            if(isset($post['groupID']) && isset($post['mnumber']))
            {
                $groupID = htmlspecialchars(strip_tags($post['groupID']));
                $signatory = htmlspecialchars(strip_tags($post['mnumber']));

                /* Add Signatory */
                $args = ([
                    $phoneNumber,
                    $groupID,
                    json_encode([
                        [
                            "MSISDN" => $signatory
                        ]
                    ])
                ]);
                $group = new GroupClass();
                $query = $group->createSignatory($args);
                if($query)
                {
                    $new_signatory = json_decode($query);
                    if($new_signatory->STATUS_CODE == 200)
                    {
                        $session->setFlash('msg-success', "A new member - ".$signatory." was successfully added.");
                        return $this->redirect(['group/view']);
                    }else{
                        /* addMembers() returned an error */
                        $session->setFlash('msg-error', "An error occurred while trying to add a signatory.");
                        return $this->redirect(['group/view']);
                    }
                }else{
                    /* addMembers() failed */
                    $session->setFlash('msg-error', "An error occurred while trying to add a signatory. Please try again ");
                    return $this->redirect(['group/view']);
                }
            }else{
                /* Missing fields */
                $session->setFlash('msg-error', "Some required fields are missing.");
                return $this->redirect(['group/view']);
            }
        }
        return $this->redirect(['group/view']);
    }

    /**
     * Displays Groups Information for non-logged in users
     * @param $id
     * @return string
     */
    public function actionProfile($id,$num){

        /* save group ID to session*/
        $session = Yii::$app->session;
        $session->set('groupID', $id);

        $group = new GroupClass();
        $args = ([
            $num,    //MSISDN
            $id    //GROUP_ID
        ]);

        /* Get group information */
        $query = $group->fetchGroupData($args);
        if($query)
        {
            $details = json_decode($query);
            if($details->STATUS_CODE == 200)
            {
                $details = $details->DATA;
            }else{
                /* fetchGroupData returned an error */
                $session->setFlash('msg-error', "An error occurred fetching your fundraiser details.");
                return $this->redirect(['site/discover']);
            }
        }else{
            /* fetchGroupData failed */
            $session->setFlash('msg-error', "An error occurred fetching your fundraiser details.");
            return $this->redirect(['site/discover']);
        }

        /* get Group Report -- Contributions */
        $query2 = $group->fetchGroupReport($args);
        if($query2)
        {
            $report = json_decode($query2);
            if($report->STATUS_CODE == 200)
            {
                $report = $report->DATA->GROUP_REPORT;
            }else{
                /* fetchGroupReport returned an error */
                $session->setFlash('msg-error', "An error occurred fetching your fundraiser details.");
                return $this->redirect(['site/discover']);
            }
        }else{
            /* fetchGroupReport failed */
            $session->setFlash('msg-error', "An error occurred fetching your fundraiser details.");
            return $this->redirect(['site/discover']);
        }

        /* Get Pledges */
        $pledges = $group->GetOrderedPledges2($num);
        // return json_encode($pledges);
        // if(!$pledges)
        // {
        //     /* GetOrderedPledges failed */
        //     $session->setFlash('msg-error', "An error occurred fetching your fundraiser details.5");
        //     return $this->redirect(['site/discover']);
        // }

        //Get Number of Contributions
        $i = 0;
        $total = 0;
        foreach($report as $contribution)
        {
            if($contribution->TRANSACTION_TYPE === "CONTRIBUTION")
            {
                $i++;
                $total = $total + $contribution->AMOUNT;
            }
        }

        //Average Contributions
        if($i != 0)
        {
            $avg_contributions = round($total/$i);
        }else{
            $avg_contributions = 0;
        }

        //Get Number of days remaining
        $earlier = new \DateTime();
        $later = new \DateTime($details->GROUP_DUE_DATE);
        $diff = $later->diff($earlier)->format("%a");

        return $this->render('member',[
            'details' => $details,
            'report' => $report,
            'contributions' => $i,
            'avg_contributions' => $avg_contributions,
            'pledges' =>  $pledges,
            'days' => $diff
        ]);
    }

    /**
     * Display group information
     * @return string
     */
    public function actionView(){
        //Get parameters from session
        $session = Yii::$app->session;
        $session->set("isVerified", "false");
        $groupID = $session->get('groupID');

        if(($session->get("phoneNumber") != null || $session->get("groupAdmin_MSISDN") != null) && $groupID != null )
        {
            $phoneNumber = $this->formatMSISDN(htmlspecialchars(strip_tags($session->get('phoneNumber'))), "KE");
        }else{
            return $this->redirect(["group/index"]);
        }


        $group = new GroupClass();
        $args = ([
            $phoneNumber,    //MSISDN
            $groupID     //GROUP_ID
        ]);

        /* Get group information */
        $query = $group->fetchGroupData($args);
        if($query)
        {
            $details = json_decode($query);
            if($details->STATUS_CODE == 200)
            {
                $details = $details->DATA;
                $session->set("groupAdmin_MSISDN",$details->GROUP_ADMIN_MSISDN[0]);
            }else{
                /* fetchGroupData returned an error */
                $session->setFlash('msg-error', "An error occurred fetching your fundraiser details.");
                return $this->redirect(['group/index']);
            }
        }else{
            /* fetchGroupData failed */
            $session->setFlash('msg-error', "An error occurred fetching your fundraiser details.");
            return $this->redirect(['group/index']);
        }

        /* get Group Report -- Contributions */
        $query2 = $group->fetchGroupReport($args);
        if($query2)
        {
            $report = json_decode($query2);
            if($report->STATUS_CODE == 200)
            {
                $report = $report->DATA->GROUP_REPORT;
            }else{
                /* fetchGroupReport returned an error */
                $session->setFlash('msg-error', "An error occurred fetching your fundraiser details.");
                return $this->redirect(['group/index']);
            }
        }else{
            /* fetchGroupReport failed */
            $session->setFlash('msg-error', "An error occurred fetching your fundraiser details.");
            return $this->redirect(['group/index']);
        }

        /* Get Pledges */
        $pledges = $group->GetOrderedPledges();
//        if(!$pledges == false)
//        {
//            /* GetOrderedPledges failed */
//            $session->setFlash('msg-error', "An error occurred fetching your fundraiser details.3");
//            return $this->redirect(['group/index']);
//        }

        //Get Number of Contributions
        $i = 0;
        $total = 0;
        foreach($report as $contribution)
        {
            if($contribution->TRANSACTION_TYPE === "CONTRIBUTION")
            {
                $i++;
                $total = $total + $contribution->AMOUNT;
            }
        }

        //Average Contributions
        if($i != 0)
        {
            $avg_contributions = round($total/$i);
        }else{
            $avg_contributions = 0;
        }

        //Get Number of days remaining
        $earlier = new \DateTime();
        $later = new \DateTime($details->GROUP_DUE_DATE);
        $diff = $later->diff($earlier)->format("%a");

        //check if user is logged in
        if($session->has('Admin'))
        {
            //check if logged in in user is admin
            if($phoneNumber === $details->GROUP_ADMIN_MSISDN[0])
            {
                // display admin page
                return $this->render('info',[
                    'details' => $details,
                    'report' => $report,
                    'contributions' => $i,
                    'avg_contributions' => $avg_contributions,
                    'pledges' =>  $pledges
                ]);
            }else {
                //display public group page
                return $this->render('member',[
                    'details' => $details,
                    'report' => $report,
                    'contributions' => $i,
                    'avg_contributions' => $avg_contributions,
                    'pledges' =>  $pledges,
                    'days' => $diff
                ]);
            }
        }else{
            //display public group page
            return $this->render('member',[
                'details' => $details,
                'report' => $report,
                'contributions' => $i,
                'avg_contributions' => $avg_contributions,
                'pledges' =>  $pledges,
                'days' => $diff
            ]);
        }

    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionWithdraw(){
        //Get parameters fom session
        $session = Yii::$app->session;

        if ($session->get("groupAdmin_MSISDN") != null && $session->get("isVerified") == "true") {
            /* Get phoneNumber and groupID from session */
            $phoneNumber = $this->formatMSISDN(htmlspecialchars(strip_tags($session->get('phoneNumber'))), "KE");
            $groupID = htmlspecialchars(strip_tags($session->get('groupID')));

            $group = new GroupClass();
            $args = ([
                $phoneNumber,    //MSISDN
                $groupID     //GROUP_ID
            ]);
            //* Get group information */
            $query = $group->fetchGroupData($args);
            if($query)
            {
                $details = json_decode($query);
                if($details->STATUS_CODE == 200)
                {
                    $details = $details->DATA;
                }else{
                    /* fetchGroupData returned an error */
                    $session->setFlash('msg-error', "An error occurred fetching your fundraiser details.");
                    return $this->redirect(['group/view']);
                }
            }else{
                /* fetchGroupData failed */
                $session->setFlash('msg-error', "An error occurred fetching your fundraiser details.");
                return $this->redirect(['group/view']);
            }

            return $this->render("withdraw",[
                'details' => $details
            ]);

        }

        if ($session->get("groupAdmin_MSISDN") != null || $session->get("phoneNumber") != null && $session->get("groupID") != null) {
            return $this->redirect(['group/view']);
        }else{
            if ($session->get("phoneNumber") != null) {
                return $this->redirect(['group/index']);
            }
            return $this->redirect(['site/index']);
        }

    }

    /**
     * Send Reminder
     * @return \yii\web\Response
     */
    public function actionReminder(){
        /* Get Group ID from session */
        $session = Yii::$app->session;
        $group = new GroupClass();
        $pledges = $group -> GetOrderedPledges();

        $groupID = htmlspecialchars(strip_tags($session->get('groupID')));    /* GROUP_ID */
        $groupAdmin_MSISDN = $this->formatMSISDN(htmlspecialchars(strip_tags($session->get('phoneNumber'))), "KE");    /* GROUP_ID */
        $member_msisdn = "";
        $pledge_amount = 0;

        $post = Yii::$app->request->post();


        if($post){

            if (isset($post['send-reminder-btn'])) {

                $pledgerName = trim($post['pledger-name']);

                foreach ($pledges as $value) {
                    // return trim($post['pledger-name'])."  ".trim($value->MEMBER_NAMES)." ".json_encode($pledges);
                    if ($pledgerName == $value->MEMBER_NAMES) {

                        $member_msisdn = $value->MSISDN;
                        $pledge_amount = $value->AMOUNT;
                        break;
                    }
                }
                /* Pledge Details */
                $args = ([
                    $groupAdmin_MSISDN,
                    $groupID,     //GROUP_ID
                    $member_msisdn,    //MEMBER_MSISDN
                    $pledge_amount,    //AMOUNT
                ]);


                // API Request
                $query = $group->groupPaymentReminder($args);
                if($query)
                {
                    $reminder = json_decode($query);
                    if($reminder->STATUS_CODE == 200)
                {
                    $session->setFlash('msg-success', "Reminder was successfully sent.");
                    return $this->redirect(['group/view']);
                }else{
                    /* groupPaymentReminder returned an error */
                    $session->setFlash('msg-error', "An error occurred while sending a reminder.");
                    return $this->redirect(['group/view']);
                }

            }else{
                /* groupPaymentReminder failed */
                $session->setFlash('msg-error', "An error occurred while sending a reminder.");
                return $this->redirect(['group/view']);
            }

            }


        }


        return $this->redirect(['group/view']);
    }


    /**
     * @return \yii\web\Response
     */
    public function actionEditPledge(){
        /* Get Group ID from session */
        $session = Yii::$app->session;
        $groupID = htmlspecialchars(strip_tags($session->get('groupID')));    /* GROUP_ID */
        $phoneNumber = htmlspecialchars(strip_tags($session->get('phoneNumber')));    /* GROUP_ID */
        $groupAdminNumber = htmlspecialchars(strip_tags($session->get('phoneNumber')));
        $post = Yii::$app->request->post();

        /* Pledge Details */
        $group = new GroupClass();

        if(isset($post['editPledge-btn'])){
            $member_msisdn = $phoneNumber;
            $amount = htmlspecialchars(strip_tags($post['in-p-amount']));
            $due_date = htmlspecialchars(strip_tags($post['p-due-date-e']));

            $args = array(
                $groupAdminNumber, //group_account_MSISDN
                $member_msisdn,    //MEMBER_MSISDN
                $groupID,     //GROUP_ID
                $amount,    //AMOUNT
                $due_date,
                date('Y-m-d H:i:s',strtotime($due_date))
            );

//            return json_encode($args);
            // API Request
            $query = $group->editPledge($args);
            if($query)
            {
                $update = json_decode($query);
                if($update->STATUS_CODE == 200)
                {
                    $session->setFlash('msg-success', "Your pledge was successfully updated.");
                    return $this->redirect(['group/view']);
                }else{
                    /* editPledge() returned an error */
                    $session->setFlash('msg-error', "An error occurred while editing your pledge.");
                    return $this->redirect(['group/view']);
                }
            }else{
                /* editPledge() failed */
                $session->setFlash('msg-error', "An error occurred while editing your pledge.");
                return $this->redirect(['group/view']);
            }
        }

        if (isset($post['deletePledge-btn'])) {
            $args = array($groupAdminNumber, $phoneNumber, $groupID);
            $query = $group->deletePladge($args);
            if($query)
            {
                $delete = json_decode($query);
                if($delete->STATUS_CODE == 200)
                {
                    $session->setFlash('msg-success', "Your pledge was successfully deleted.");
                    $session->remove('groupID');
                    return $this->redirect(['group/view']);
                }else{
                    /* deletePledge() returned an error */
                    $session->setFlash('msg-error', "An error occurred while deleting your pledge.");
                    return $this->redirect(['group/view']);
                }
            }else{
                /* deletePledge() failed */
                $session->setFlash('msg-error', "An error occurred while deleting your pledge.");
                return $this->redirect(['group/view']);
            }
        }
        return $this->redirect(['group/view']);
    }

    public function actionWalletBalance(){
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->get();

            //get parameters for group wallet balance
            $groupID = explode(":", htmlspecialchars(strip_tags($data['groupID'])));
            $adminNo = explode(":", htmlspecialchars(strip_tags($data['adminNo'])));
            $groupID = $groupID[0];
            $adminNo = $adminNo[0];

            $group = new GroupClass();
            $balance = $group->GetWalletBalance($groupID,$adminNo);
//            if($balance == false)
//            {
//                return "_";
//            }

            return json_encode($balance);
        }
    }

    public function actionCashOut(){
         /* Get Group ID from session */
        $session = Yii::$app->session;
        $groupID = htmlspecialchars(strip_tags($session->get('groupID')));    /* GROUP_ID */
        $phoneNumber = htmlspecialchars(strip_tags($session->get('phoneNumber')));    /* GROUP_ID */
        $groupAdminNumber = htmlspecialchars(strip_tags($session->get('groupAdmin_MSISDN')));

        $post = Yii::$app->request->post();
        $group = new GroupClass();

        if (isset($post['act-withdraw-btn'])) {
            $withdraw_amount = htmlspecialchars(strip_tags($post['w-amount']));
            $recipient_msisdn = $this->formatMSISDN(htmlspecialchars(strip_tags($post['w-msisdn'])), "KE");
            $payer_client_id = htmlspecialchars(strip_tags($post['payer_client']));
            $walletBalance = $group->GetWalletBalance($groupID,$groupAdminNumber);

            if ($withdraw_amount <= $walletBalance) {
                $myReq = array($groupAdminNumber, $groupID, $withdraw_amount, $recipient_msisdn, $payer_client_id);
                $response = $group->cashoutRequest($myReq);
                $session->set("activate-vb", "");
                $session->setFlash('msg-success',"Cash out request was successfully sent to approvers");
                return $this->redirect(['group/view']);

                //save withdraw request
//                $cashOut = new CashOuts();
//                $cashOut->cashOutType = "MOBILE MONEY";
//                $cashOut->cashOutTypeID = $post['payer_client'];
//                $cashOut->withdrawAmount = $post['w-amount'];
//                $cashOut->destinationAccountName = "Customer Customer";
//                $cashOut->destinationAccountNumber = $recipient_msisdn;
//                $cashOut->groupID = $groupID;
//                $cashOut->groupAdminMSISDN = $groupAdminNumber;
//                $cashOut->cashOutStatus = 0;
//                if($cashOut->save()){
//                    $session->set("activate-vb", "");
//                    return $this->redirect(['group/view']);
//                }else{
//                    return json_encode("error");
//                }
            }else{
                //do this
                $session->setFlash('msg-error',"Cash out request failed. Please try again.");
                return $this->redirect(['group/view']);
            }
        }

        /* Banks */
        if (isset($post['act-withdraw-btn-bank'])) {
            /* Save Bank transaction */

            $uniqueKeys = array("MSISDN", "BANK_ID", "BANK_NAME", "BANK_ACCOUNT_NUMBER", "AMOUNT", "GROUP_ID");
            $withdraw_amount = htmlspecialchars(strip_tags($post['w-amount']));
            $accountName = htmlspecialchars(strip_tags($post['w-acc-nm']));
            $accountNumber = htmlspecialchars(strip_tags($post['w-acc-no']));
            $payer_client_id = htmlspecialchars(strip_tags($post['payer_client']));

            $args = array(
                $phoneNumber,
                $payer_client_id,
                $accountName,
                $accountNumber,
                $withdraw_amount,
                $groupID
            );

            $model = new GroupClass();
            $query = $model->payWithCash($args);
            if($query)
            {
                $pay = json_decode($query);
                if($pay->STATUS_CODE == 200)
                {
                    $session->set("activate-vb", "false");
                    $session->setFlash('msg-success',"Cash out request was successfully sent to group signatories");
                    return $this->redirect(['group/view']);
                }else{
                    $session->set("activate-vb", "");
                    $session->setFlash('msg-error',"Something went wrong processing your cash out request");
                    return $this->redirect(['group/view']);
                }
            }else{
                $session->set("activate-vb", "");
                $session->setFlash('msg-error',"Something went wrong processing your cash out request");
                return $this->redirect(['group/view']);
            }

        }

        $session->set("activate-vb", "");
        return $this->redirect(['group/view']);

    }

    public function formatMSISDN($MSISDN, $countryCode){
        $internationalMode = true;

        // default the country-dial code
        if($countryCode == "KE"){

            $countryDialCode = 254;

        } else if ($countryCode == "RW"){

            $countryDialCode = 250;

        } else if ($countryCode == "UG"){

            $countryDialCode = 256;

        } else if ($countryCode == "TZ"){

            $countryDialCode = 255;

        }

        try {
            
            //Remove + if contained in MSISDN
            if (substr($MSISDN, 0, 1) == '+') {
                $MSISDN = substr($MSISDN, 1);
            }
            //Sanitize the MSISDN
            $sanitizeMSISDN = preg_replace("/[^0-9\s]/", "", $MSISDN);
            $formattedMSISDN = str_replace(' ', '', $sanitizeMSISDN);
            
            //Get rid of the leading 0
            if ((substr($formattedMSISDN, 0, 1) == "0") && (strlen($formattedMSISDN) == 10)) {
                $formattedMSISDN = substr_replace($formattedMSISDN, "", 0, 1);
            }
            
            // If the # is less than the countries #
            if (strlen($formattedMSISDN) <= 9 && strlen($formattedMSISDN) > 0) {
                $formattedMSISDN = $countryDialCode . $formattedMSISDN;
                // If it is in international mode we apppend a  +
                if ($internationalMode) {
                    $formattedMSISDN = $formattedMSISDN;
                }
            }
        } catch (Exception $exc) {
//            $flogParams = array('MSISDN' => $formattedMSISDN);
        }
        
        return trim($formattedMSISDN);
    }

    public function actionLogRequest(){

        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            //print_r($data);
            //get parameters for group wallet balance
            $userMSISDN = explode(":", htmlspecialchars(strip_tags($data['userMSISDN'])));
            $userExtraData = explode(":", htmlspecialchars(strip_tags($data['userExtraData'])));

            $userMSISDN = $userMSISDN[0];
            $userExtraData = $userExtraData[0];

            $group = new GroupClass();
            $requestLogData = $group->GetLogRequestData($userMSISDN,$userExtraData);

            return $requestLogData;
        }else{
            return "";
        }
    }

    public function actionProxyServer(){
        $request = Yii::$app->request;
        $session = Yii::$app->session;
        $group = new GroupClass();
    
        $phoneNumber = $session->get('phoneNumber');
        $groupID = $session->get("groupID");
        $args = ([
                $phoneNumber,    //MSISDN
                $groupID     //GROUP_ID
        ]);
    
        if($request->isAjax){

            // return true;
            $data = Yii::$app->request->post();
            $response = Yii::$app->response;
            $response->format = \yii\web\Response::FORMAT_JSON;
        
            if ($data['request_service'] != null && $data['request_service'] == "PLEDGES") {
                $retVal = $group -> GetOrderedPledges();
                $response->data = json_encode($retVal);
                return $response;
            }
        
            if ($data['request_service'] != null && $data['request_service'] == "CONTRIBUTION") {
                $retVal = $group->fetchGroupReport($args);
                $response->data = $retVal;
                return $response;
            }

            if ($data['request_service'] != null && $data['request_service'] == "GROUP_DATA") {
                $retVal = $group->fetchGroupData($args);
                $response->data = $retVal;
                return $response;
            }
            $test = ["message"=>"Ajax Worked!"];
        }else{
            $test = ["message"=>"Ajax failed!"];
            return json_encode($test);
        }
    }

    public function actionTest(){
        $array = [];
        if($array != false)
        {
            return "true";
        }else{
            return "false";
        }
    }

    public function actionPayWithCash(){
        $session = Yii::$app->session;
        $post = Yii::$app->request->post();
        if($post)
        {
            if(isset($post['mnumber']) && $post['amount'])
            {
                $groupID = htmlspecialchars(strip_tags($post['groupID']));
                $member = htmlspecialchars(strip_tags($post['mnumber']));
                $phoneNumber = htmlspecialchars(strip_tags($session->get('phoneNumber')));
                $amount = htmlspecialchars(strip_tags($post['amount']));

                $model = new GroupClass();
                $args = array(
                    $groupID,
                    $phoneNumber,
                    $member,
                    $amount
                );
                $query = $model->payWithCash($args);
                if($query)
                {
                    $pay = json_decode($query);
                    if($pay->STATUS_CODE == 200)
                    {
                        $session->setFlash('msg-success',"Cash payment successfully added.");
                        return $this->redirect(['group/view']);
                    }else{
                        $session->setFlash('msg-error',"An error occurred while adding the cash payment");
                        return $this->redirect(['group/view']);
                    }

                }else{
                    $session->setFlash('msg-error',"An error occurred while adding the cash payment");
                    return $this->redirect(['group/view']);
                }
            }else{
                $session->setFlash('msg-error',"Some required fields are missing");
                return $this->redirect(['group/view']);
            }
        }

        return $this->redirect(['group/view']);
    }
}