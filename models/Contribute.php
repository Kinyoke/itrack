<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for object "contribute".
 *
 * @property int $amount
 * @property string $groupID
 * @property int $payer
 * @property int $contributor
 */
class Contribute extends Model
{
    public $amount;
    public $groupID;
    public $payer;
    public $contributor;
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['amount', 'groupID', 'contributor'], 'required'],
            [['amount'], 'integer'],
            [['payer','contributor'], 'string']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'amount' => 'Amount',
            'groupID' => 'Group ID',
            'payer' => 'Payer',
            'contributor' => 'Contributor'
        ];
    }
}
