<?php

namespace app\modules\admin\controllers;

use app\libraries\GroupClass;
use app\modules\admin\models\CashOuts;
use app\modules\admin\models\LoginForm;
use app\modules\admin\models\Users;
use yii\web\Controller;
use Yii;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Display cash out requests
     * @return string
     */
    public function actionRequests(){

        //get all cash out requests
        $cashOuts = CashOuts::find()
//            ->asArray()
            ->all();


        return $this->render('requests', [
            'cashOuts' => $cashOuts
        ]);
    }

    /**
     * Display a single cash out details
     * @param $id
     * @return string
     */
    public function actionView($id){

        //get cashOut matching $id
        $cashOut = CashOuts::findOne(['cashOutID' => Yii::$app->request->get('id')]);

        //get group details
        $group = new GroupClass();
        $args = ([
            $cashOut->groupAdminMSISDN,    //MSISDN
            $cashOut->groupID     //GROUP_ID
        ]);
        $details = json_decode($group->fetchGroupData($args));
        $details = $details->DATA;

        //get Wallet Balance
        $balance = json_decode($group->GetWalletBalance($cashOut->groupID,$cashOut->groupAdminMSISDN));

        return $this->render('view', [
            'cashOut' => $cashOut,
            'details' => $details,
            'balance' => $balance
        ]);
    }

    public function actionLogin(){
        $this->layout = false;

        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['index']);
        }

        $model = new LoginForm();
        $post = Yii::$app->request->post();
        if ($post){
            $model->email = $post['email'];
            $model->password = $post['password'];

            if($model->login())
            {
                return $this->redirect(['index']);
            }else{
                return $this->redirect(['login']);
            }
        }

        $model->password = '';
        return $this->render('login');

    }

    public function actionCreateUser(){


        $model = new Users();
        $post = Yii::$app->request->post();
        if($post)
        {
            $model->firstName = $post['Users']['firstName'];
            $model->lastName = $post['Users']['lastName'];
            $model->email = $post['Users']['email'];
            $model->password = password_hash($post['Users']['password'], PASSWORD_BCRYPT);
            if($model->save())
            {
                return $this->redirect('users');
            }else{
                return $this->redirect('users');
            }
        }

        return $this->render('create-user',[
            'model' =>  $model
        ]);
    }

    public function actionUsers(){

        $users = Users::find()
        ->all();

        return $this->render('users',[
            'users' => $users
        ]);
    }
}
