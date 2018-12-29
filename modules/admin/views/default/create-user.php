<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Create User';
?>

    <div class="admin-default-requests">

        <div class="row py-3">
            <div class="mx-auto col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <p class="text-muted py-1"> Create user below</p>
                        <div class="col-lg-10 mx-auto">
                            <?php $form = ActiveForm::begin([
                                'id' => 'create-user-form',
                                'layout' => 'horizontal',
                                'fieldConfig' => [
                                    'template' => "{label}\n<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                                    'labelOptions' => ['class' => 'col-lg-3 control-label'],
                                ],
                            ]); ?>

                            <?= $form->field($model, 'firstName')->textInput(['autofocus' => true]) ?>

                            <?= $form->field($model, 'lastName')->textInput() ?>

                            <?= $form->field($model, 'email')->textInput() ?>

                            <?= $form->field($model, 'password')->passwordInput() ?>

                            <div class="form-group">
                                <div class="col-lg-offset-1 col-lg-11">
                                    <?= Html::submitButton('Create User', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                                </div>
                            </div>

                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $this->beginBlock('scripts'); ?>
    <script>

        $(document).ready(function() {

            /* Initialize Table */
            $('#users').DataTable( {
            } );

        } );
    </script>
<?php $this->endBlock();