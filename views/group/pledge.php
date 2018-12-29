<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Make a pledge';
?>


<form method="POST" action="../group/pledge" id="pledge-form" name="pledge-form"></form>
<input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>"  form="pledge-form"/>

<div class="tuggle-nav" style="display: none;"></div>


<div class="col-lg-6 pledge-pane pledge-pane-mobile">
    <div class="pladge-group-profile img-bg2">
        <div class="img-holder d-flex">
<!--            <div class="mx-2 container" style="margin-top: 20px;">-->
<!--            <button type="button" class="btn btn-outline-secondary btn-circle" onclick="location.href = '../group/view'"><i class="fa fa-arrow-left"></i>-->
<!--                </button>-->
<!--            </div>-->
            <img class="my-auto pledge-mobile-imgcover" src="../images/ARTWORK.png" style="width: 100%;">
        </div>
    </div>
</div>

<div class="my-4 mx-2 container pledge-pane-mobile" style="position:absolute;">
    <button type="button" class="btn btn-outline-secondary btn-circle" onclick="location.href = '../group/view'" style="color : white;"><i class="fa fa-arrow-left"></i>
    </button>
</div>

<div class="container pledge-container-main">

    <div class="col-lg-6 pledge-pane">

        <div class="mx-2 container" style="margin-top: 20px;">
            <button type="button" class="btn btn-outline-secondary btn-circle back-pledge-lg" onclick="location.href = '../group/view'"><i class="fa fa-arrow-left"></i>
                </button>
        </div>

        <div class="pledge-left-tab p-3">

            <div class="form-group">
                <h4 class="font-semibold">Make a pledge</h4>
                <p>Please enter the details below to make a pledge</p>
            </div>


            <div class="form-group required">
                <label for="mname">Please tell us your name</label>
                <input type="text" name="mname" id="mname" class="form-control pledge-form-input" placeholder="Enter first and last name" form="pledge-form" maxlength="30" required>
                <span id="mname-err" style="color: red;"></span>
            </div>

            <div class="form-group required">
                <label for="mnumber">What's your mobile number?</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" style="background: white;">+254</span>
                    </div>
                    <input type="text" name="mnumber" id="mnumber" class="form-control pledge-form-input" placeholder="Enter mobile number" form="pledge-form" maxlength="12" required>
                </div>
                <span id="mnumber-err" style="color: red;"></span>
            </div>

            <div class="form-group required">
                <label for="pledge-amount">How much would you like to pledge?</label>
                <input type="text" class="form-control pledge-form-input" id="pledge-amount" name="pledge-amount" form="pledge-form" value="1000" maxlength="12" required>
                <span id="pledge-amount-err" style="color: red;"></span>
            </div>

            <div class="form-group text-center" style="margin-bottom: 70px;">
                <button id="amount-f" name="amount-selected" class="btn btn-outline-primary amount-selected" value="500">KES 500</button>
                <button id="active-amount" name="amount-selected" class="btn btn-outline-primary amount-selected" value="1000">KES 1,000</button>
                <button id="amount-t" name="amount-selected" class="btn btn-outline-primary amount-selected" value="2000">KES 2,000</button>
            </div>

            <div class="form-group required">
                <label for="timeline">When would you like to pay your pledge?</label>
                <input name="timeline" id="datepicker" form="pledge-form" class="form-control pledge-form-input" required>
                <span class="error text-danger" id="timeline-err"></span>
            </div>

            <div class="form-group">
                <label for="pledge-reminder" id="">When would you like us to remind you?</label>
                <select class="form-control" id="pledge-reminder" name="pledge-reminder" form="pledge-form">
                    <option>An hour before before group due date</option>
                    <option>A day before group due date</option>
                    <option>A week before end of timeline</option>
                    <option>Anytime before group due date</option>
                </select>
            </div>

            <div class="form-group">
                <button class="btn btn-primary next_page_btn" id="make_pledge_btn">Continue</button>
            </div>

        </div>


        </div>

</div>

<div class="col-lg-6 pledge-pane pledge-pane-lg">
    <div class="pladge-group-profile img-bg2">
        <div class="img-holder d-flex">
            <img class="my-auto" src="../images/ARTWORK.png" style="width: 100%;">
        </div>
    </div>
</div>

