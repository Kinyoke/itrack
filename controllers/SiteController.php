<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\ContactForm;
use app\libraries\GroupClass;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
    * @inheritdoc
    */
    public function beforeAction($action)
    {
        if ($action->id == 'success' || $action->id = 'failed') {
               $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }

    /**
     * Displays homepage
     * @return string
     */
    public function actionIndex()
    {
        //get top 3 fundraisers
        $model = new GroupClass();
        $args = ([
            "254722333867",
            true
        ]);
        $query = json_decode($model->fetchAllOpenGroups($args));

        if($query)
        {
            if($query->STATUS_CODE == 200)
            {
                $groups = $query->DATA->GROUPS;

                /* Get first three */
                $groups = array_slice($groups, 0, 3, true);
            }else{
                $groups = [];
            }
        }else{
            /* if fetchGroups() failed */
            $groups = [];
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
     * Displays and posts login form
     * @return string
     */
    public function actionLogin()
    {
        $model = new GroupClass();

        /* if route is loaded from a post request */
        $post = Yii::$app->request->post();
        if(isset($post['login-btn']))
        {
            if($post['phoneNumber'] != NULL)
            {
                /* Get User Phone Number */
                $phoneNumber = $this->formatMSISDN(htmlspecialchars(strip_tags($post['phoneNumber'])), "KE");

                /* Generate OTP PIN */
                $args = array("GENERATE", $phoneNumber);
                $query = $model->generateOtp($args);

                //return json_decode($query);

                if(!$query)
                {
                    /* If generateOtp() fails*/
                    $session = Yii::$app->session;
                    $session->setFlash('msg-error', "An connection error occurred while trying to log in.");
                    return $this->refresh();
                }else{
                    /* Check Status is 200 */
                    if(json_decode($query)->STATUS_CODE == 200)
                    {
                        return  $this->render('verify', [
                        'phoneNumber' => $phoneNumber
                        ]);
                    }else{
                        $session = Yii::$app->session;
                        $session->setFlash('msg-error', "An error occurred trying to log in. Please try again later.");
                        return $this->refresh();
                    }
                }
            }
        }
        return $this->render('login');
    }


    /**
     * Displays form and accepts PIN
     * @return string|Response
     */
    public function actionVerify()
    {
        $group = new GroupClass();
        $post = Yii::$app->request->post();
        $session = Yii::$app->session;

        /* If route receives post data */
        if (isset($post['verify-btn'])) {
            /* If PIN and Phone Number are posted */
            if ($post['m-code'] != NULL && $post['client_msisdn'] != NULL) {
                $otp_code = htmlspecialchars(strip_tags($post['m-code']));
                $phoneNumber = htmlspecialchars(strip_tags($post['client_msisdn']));

                /* Validate PIN */
                $args = array("VALIDATE", $phoneNumber, $otp_code);
                $query = json_decode($group->otpValidation($args));
                if($query)
                {
                    if($query->STATUS_CODE == 200)
                    {
                        //save login to session
                        if ($session->isActive) $session->destroy();
                        $session->set('phoneNumber', $phoneNumber);
                        $session->set('Admin', true);
                        return $this->redirect(['group/index']);

                    }else{
                        $session->setFlash('msg-error', "Incorrect PIN. Please try again");
                        return  $this->render('verify', [
                            'phoneNumber' => $phoneNumber
                        ]);
                    }
                }else{
                    $session->setFlash('msg-error', "An error occurred while trying to validate your PIN.");
                    return  $this->redirect(['login']);
                }

            }
        }

        if (isset($post['resendv-btn'])) {
            if($post['resendc-mnumber'] != NULL)
            {
                /* Get User Phone Number */
                $phoneNumber = $this->formatMSISDN(htmlspecialchars(strip_tags($post['resendc-mnumber'])), "KE");

                /* Generate OTP PIN */
                $args = array("GENERATE", $phoneNumber);
                $query = $group->generateOtp($args);
                if(!$query)
                {
                    /* If generateOtp() fails*/
                    $session = Yii::$app->session;
                    $session->setFlash('msg-error', "An connection error occurred while trying to log in.");
                    return $this->refresh();
                }
                return  $this->render('verify', ['phoneNumber' => $phoneNumber]);
            }
        }

        return $this->redirect(['login']);
    }


    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLog_out()
    {
        $session = Yii::$app->session;
        if (!$session->isActive) 
        {
            session_start();
        }

        // Unset all of the session variables.
        $_SESSION = array();

        // If it's desired to kill the session, also delete the session cookie.
        // Note: This will destroy the session, and not just the session data!
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Finally, destroy the session.
        session_destroy();
        return $this->redirect(['site/index']);
    }


    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }


    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }


    /**
     * Displays fundraisers to the public
     * @return string
     */
    public function actionDiscover(){
        
        $group = new GroupClass();
        $args = ([
            "254722333867",
            true
        ]);
        $query = json_decode($group->fetchAllOpenGroups($args));

        if($query)
        {
            if($query->STATUS_CODE == 200)
            {
                $groups = $query->DATA->GROUPS;
            }else{
                $groups = [];
            }
        }else{
            /* if fetchGroups() failed */
            $groups = [];
        }

        return $this->render('discover',[
            'groups' => $groups
        ]);

    }

    /**
     * Format Phone Numbers
     * @param $MSISDN
     * @param $countryCode
     * @return string
     */
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

    public function actionSuccess(){
        
        if(isset($_POST)){

            $json = $_POST;

            $postData = json_encode($json);

            //echo $postData ."<br/>";

            $data = json_decode($postData, true);
            
            $session = Yii::$app->session;

            if(!empty($data)){

                $requestStatusCode = isset($data['requestStatusCode']) ? $data['requestStatusCode'] : '';
                $accountNumber = isset($data['accountNumber']) ? $data['accountNumber'] : '';
                $currencyCode = isset($data['currencyCode']) ? $data['currencyCode'] : '';
                $checkoutRequestID = isset($data['checkoutRequestID']) ? $data['checkoutRequestID'] : '';
                $amountPaid = isset($data['amountPaid']) ? $data['amountPaid'] : '';
                $merchantTransactionID = isset($data['merchantTransactionID']) ? $data['merchantTransactionID'] : '';
                $serviceCode = isset($data['serviceCode']) ? $data['serviceCode'] : '';
                $requestDate = isset($data['requestDate']) ? $data['requestDate'] : '';
                $paymentStatusDescription = isset($data['paymentStatusDescription']) ? $data['paymentStatusDescription'] : '';
                $MSISDN = isset($data['MSISDN']) ? $data['MSISDN'] : '';

                $session->setFlash('msg-success', $paymentStatusDescription);
                
                return $this->redirect(['group/view']);

            } else {

                return $this->redirect(['group/view']);
            }
        }

    }

    public function actionFailed(){

        if(isset($_POST)){

            $json = $_POST;

            $postData = json_encode($json);

            //echo $postData ."<br/>";

            $data = json_decode($postData, true);
            
            $session = Yii::$app->session;

            if(!empty($data)){

                $requestStatusCode = isset($data['requestStatusCode']) ? $data['requestStatusCode'] : '';
                $accountNumber = isset($data['accountNumber']) ? $data['accountNumber'] : '';
                $currencyCode = isset($data['currencyCode']) ? $data['currencyCode'] : '';
                $checkoutRequestID = isset($data['checkoutRequestID']) ? $data['checkoutRequestID'] : '';
                $amountPaid = isset($data['amountPaid']) ? $data['amountPaid'] : '';
                $merchantTransactionID = isset($data['merchantTransactionID']) ? $data['merchantTransactionID'] : '';
                $serviceCode = isset($data['serviceCode']) ? $data['serviceCode'] : '';
                $requestDate = isset($data['requestDate']) ? $data['requestDate'] : '';
                $paymentStatusDescription = isset($data['paymentStatusDescription']) ? $data['paymentStatusDescription'] : '';
                $MSISDN = isset($data['MSISDN']) ? $data['MSISDN'] : '';

                $session->setFlash('msg-error', $paymentStatusDescription);
                
                return $this->redirect(['group/view']);

            } else {

                return $this->redirect(['group/view']);
            }
        }

    }
}
