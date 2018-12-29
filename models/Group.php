<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for object "group".
 *
 * @property string $name
 * @property string $description
 * @property int $target
 * @property string $type
 * @property date $dateDue
 * @property int $phoneNumber
 * @property string $frequency
 */

class Group extends Model
{
    public $name;
    public $description;
    public $target;
    public $type;
    public $dateDue;
    public $phoneNumber;
    public $frequency;
    
    public function rules()
    {
        return [
            [['name', 'description', 'target', 'dateDue','phoneNumber', 'frequency'], 'required'],
            [['target', 'phoneNumber'], 'integer'],
            [['name','description', 'type'], 'string'],
          //  ['dateDue', 'date', 'format' => 'php:Y-m-d']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' =>  'Group Name',
            'description' => 'Group Description',
            'target' => 'Amount Target',
            'type' => 'Group Type',
            'dateDue' => 'Date due',
            'phoneNumber' => 'Phone Number',
            'frequency' => 'Frequency'
        ];
    }
}
