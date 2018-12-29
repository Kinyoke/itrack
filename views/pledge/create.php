<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pledge */
/* @var $form ActiveForm */
?>
<div class="pledge-create">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'amount') ?>
        <?= $form->field($model, 'phoneNumber') ?>
        <?= $form->field($model, 'groupId') ?>
        <?= $form->field($model, 'dueDate') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- pledge-create -->
