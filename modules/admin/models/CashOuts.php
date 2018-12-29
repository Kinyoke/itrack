<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "cashOuts".
 *
 * @property int $cashOutID
 * @property string $cashOutType
 * @property int $cashOutTypeID
 * @property int $withdrawAmount
 * @property string $destinationAccountName
 * @property string $destinationAccountNumber
 * @property int $groupID
 * @property string $groupAdminMSISDN
 * @property int $cashOutStatus
 * @property int $active
 * @property string $dateCreated
 * @property string $dateUpdated
 * @property string $createdBy
 * @property string $updatedBy
 */
class CashOuts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cashOuts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                ['cashOutType', 'cashOutTypeID', 'withdrawAmount', 'destinationAccountName', 'destinationAccountNumber', 'groupID', 'groupAdminMSISDN', 'cashOutStatus'],
                'required',
                'message' => 'Please enter a value for {attribute}'
            ],
            [
                ['cashOutTypeID', 'withdrawAmount', 'groupID', 'cashOutStatus', 'active'],
                'integer',
                'message' => "{attribute} should be an integer"
            ],
            [
                ['dateCreated', 'dateUpdated'],
                'safe',
                'message' => "{attribute} has failed validation"
            ],
            [
                ['cashOutType', 'destinationAccountNumber', 'groupAdminMSISDN', 'createdBy', 'updatedBy'],
                'string',
                'max' => 30,
                'message' => "{attribute} has failed validation"
            ],
            [
                ['destinationAccountName'],
                'string',
                'max' => 50,
                'message' => "{attribute} should be an integer"
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cashOutID' => 'Cash Out ID',
            'cashOutType' => 'Cash Out Type',
            'cashOutTypeID' => 'Cash Out Type ID',
            'withdrawAmount' => 'Withdraw Amount',
            'destinationAccountName' => 'Destination Account Name',
            'destinationAccountNumber' => 'Destination Account Number',
            'groupID' => 'Group ID',
            'groupAdminMSISDN' => 'Group Admin MSISDN',
            'cashOutStatus' => 'Cash Out Status',
            'active' => 'Active',
            'dateCreated' => 'Date Created',
            'dateUpdated' => 'Date Updated',
            'createdBy' => 'Created By',
            'updatedBy' => 'Updated By',
        ];
    }
}
