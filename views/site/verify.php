<?php

use yii\helpers\Html;

$this->title = 'Verify';
?>

<!--Hide Navbar -->
<?php $this->beginBlock('navbar'); ?>
d-none
<?php $this->endBlock(); ?>

<!-- Content Sectio -->
<section class="section site-login container">

  <div class="mt-4 pt-lg-4">
    <div class="logo row m-4">
        <img src="../images/Mula_Logo.png" class="mx-auto" width="195" height="60" alt="">
    </div>

    <div class="row my-4">
        <div class="p-3 col-lg-9 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <h4>Verify</h4>
                        <hr class="my-4">
                        <p class="lead text-muted p-0">Please enter the 4 digit code sent to <?= $phoneNumber ?>.</p>
                       <!--  <input type="hidden" name="client_msisdn" id="client_msisdn" value="<?= $phoneNumber ?>"> -->
                        <form id="verify-form" method="post" action="../site/verify" class="form"></form>
                            <input form="verify-form" type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>"/>
                            <input type="hidden" name="client_msisdn" form="verify-form" value="<?=$phoneNumber?>">
                            <div class="form-group">
                                <label for="pin">Enter code</label>
                                <input type="text" name="m-code" id="m-code" class="form-control v-form-input" placeholder="Enter PIN" form="verify-form">
                                  <span class="error text-danger" id="v-code-err"></span>
                            </div>
                            <div class="form-group">
                                <form id="resend-code-form" action="../site/verify" method="post"></form>
                                <input form="resend-code-form" type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>"/>
                                <input type="hidden" name="resendc-mnumber" id="resendc-mnumber" form="resend-code-form">
                                <button name="resendv-btn" form="resend-code-form" id="v-resend-code">Click here to resend</button>
                                <button class="btn btn-primary btn-md blue-btn next-btn my-4" id="verify-btn">Continue</button>
                            </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
  </div>

</section>
