<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property int $userID
 * @property string $firstName
 * @property string $lastName
 * @property string $email
 * @property string $password
 * @property string $rememberMe
 * @property string $active
 * @property string $dateCreated
 * @property string $dateUpdated
 * @property string $createdBy
 * @property string $updatedBy
 */
class Users extends ActiveRecord implements IdentityInterface
{
    public $UserID;
//    public $email;
//    public $password;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['firstName', 'email', 'password'], 'required'],
            [['dateCreated', 'dateUpdated'], 'safe'],
            [['firstName', 'lastName', 'email', 'createdBy', 'updatedBy'], 'string', 'max' => 30],
            [['password', 'rememberMe'], 'string', 'max' => 255],
            [['active'], 'string', 'max' => 3],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'userID' => 'User ID',
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'email' => 'Email',
            'password' => 'Password',
            'rememberMe' => 'Remember Me',
            'active' => 'Active',
            'dateCreated' => 'Date Created',
            'dateUpdated' => 'Date Updated',
            'createdBy' => 'Created By',
            'updatedBy' => 'Updated By',
        ];
    }

    /**
     * Finds an identity by the given ID.
     *
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @param string $type as null
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->UserID;
    }

    /**
     * @return string|void
     * @throws NotSupportedException
     */
    public function getAuthKey()
    {
        throw new NotSupportedException();
    }

    /**
     * @param string $authKey
     * @return bool|void
     * @throws NotSupportedException
     */
    public function validateAuthKey($authKey)
    {
        throw new NotSupportedException();
    }

    /**
     * @param $email
     * @return null|static
     */
    public static function findByEmail($email){
        return self::findOne(['email'=>$email]);
    }

    /**
     * Validates password
     * @param $password
     * @return bool
     */
    public function validatePassword($password){
        if (password_verify($password, $this->password))
        {
            return true;
        }
        return false;
    }
}
