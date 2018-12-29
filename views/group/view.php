<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'View My Groups';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="group-view">

<h3><?= $this->title ?></h3>
    <form action="../group/fetch" method="post" class="col-sm-6 mx-auto">

        <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
        <div class="form-group">
			<label for="phoneNumber">Your Phone Number:</label>
            <input type="text" name="phoneNumber" class="form-control" id="phoneNumber" >
        </div>
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    </form>

</div><!-- contribute-index -->
