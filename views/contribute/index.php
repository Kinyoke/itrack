<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Contribute */
/* @var $form ActiveForm */
$this->title = 'Make a Contribution';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="contribute-index">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'amount') ?>
        <?= $form->field($model, 'groupID') ?>
        <?= $form->field($model, 'payer') ?>
        <?= $form->field($model, 'contributor') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- contribute-index -->
