<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for object "pledge".
 *
 * @property string $name
 * @property string $description
 * @property int $target
 * @property string $type
 */
class Pledge extends Model
{
    public $amount;
    public $phoneNumber;
    public $groupId;
    public $dueDate;
    
    public function rules()
    {
        return [
            [['amount', 'phoneNumber', 'groupId', 'dueDate'], 'required'],
            [['amount'], 'integer'],
            [['dueDate'], 'date'],
            [['phoneNumber'], 'string']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() 
    {
        return [
            'amount' => 'Pledge Amount',
            'phoneNumber' => 'Phone Number',
            'dueDate' => 'Date due'
        ]; 
    }
}
