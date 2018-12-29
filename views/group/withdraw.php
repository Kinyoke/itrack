<?php

use  yii\web\View;
use  yii\helpers\Url;

$this->title = "Withdraw";

?>


<style type="text/css">
	body{ background-color: rgba(230, 230, 230, 0.2); }
	.withdraw-pane-tab{ display: inline; float: left; }
	.withdraw-pane{ width: 80%; margin: auto; height: 400px; margin-top: 40px; }
	.card{ float: left; }
	.card-right{ float: right; }
	.pay-opts{ width: 100%; height: 70px; }
	.pay-opts-item{ float: left; text-align: center; display: inline; height: 70px; width: 110px; border-radius: 7px; margin-left: 20px; border: 2px solid rgba(220, 220, 220, 0.6); transition: 1s; }
    .pay-opts-pad{ display: none; }
    .pay-opts-item img{ filter: grayscale(1); }
    #activepad{ display: block; }
	.pay-opts-item:hover{ cursor: pointer; border: 2px solid #007AFF; }
    .pay-opts-item img{ width: 60%; }
    .pay-opts-item:first-child{ margin-left: 0px; }
	.pay-opts-pane{ margin-top: 15px; }
	#w-acc-no, #w-acc-nm{ margin-top: 10px; }
    /*.w-msisdn-container, .w-tplus-container{ display: none; }*/
    .pay-opts-container{ display: inline; float: left; margin-bottom: 20px; }
    .pay-opts-container:first-child{ margin-top: 6px; padding-right: 20px; }
    .pay-opts-container:last-child{ margin-left: 20px; margin-top: 6px; }
    .pay-opts-container:last-child:hover, .pay-opts-container:first-child:hover{ opacity: 0.6; cursor: pointer;}
    #w-acc-no{ margin-top: 20px; }
    .pay-opts-item-less{ display: none; }
    .w-msisdn-cd{ display: none; }

</style>

<!--<div class="tuggle-nav"></div>-->
<?= $this->render('../layouts/sidenav'); ?>



<div class="withdraw-pane" style="margin-top: 70px;">

        <!-- mobile top -->
        <div class="card col-lg-4 card-top">
            <div class="card-header">
                <h5 class="card-title text-muted">Group account</h5>
            </div>
            <div class="card-body">
                <p class="card-text text-muted">Total amount raised</p>
                <p class="card-text font-semibold" id="set-balance" style="font-size: 25px; margin-top: -10px; margin-bottom: 40px; display: block;">
                    KES <i class='fa fa-circle-notch fa-spin text-muted' id="spinner"></i>
                </p>
                <p class="card-text text-muted">Target amount</p>
                <p class="card-text font-semibold" style="font-size: 25px; margin-top: -10px;">KES <?= $details->AMOUNT ?></p>

                <!-- Hidden inputs for ajax request -->
                <input id="phoneNumber" class="hidden" type="text" style="display:none" value="<?= $details->GROUP_ADMIN_MSISDN[0];?>" />
                <input id="groupID" class="hidden" type="text" style="display:none" value="<?= $details->GROUP_ID;?>" />
                <input id="groupAmount" class="hidden" type="text" style="display:none" value="<?= $details->AMOUNT;?>" />
            </div>
        </div>

	<!-- <div class="withdraw-pane-tab withdraw-pane-left"> -->

        <form id="withdraw-form" action="../group/cash-out" method="post"></form>
        <input type="hidden" form="withdraw-form" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />

		
		<div class="card withdraw-card-main">
  			<div class="card-body col-lg-11 container">
                
                <div class="row container">
                    <a class="back" href="../group/view" id="back-link"><i class="fa fa-chevron-left"></i> Back</a>
                </div>

    			<h3>Withdraw</h3>
    			<p>Please note that a request will be sent to the group<br>signatories to confirm your withdraw!</p>

                <div class="form-group required">
                    <label for="w-amount">How much would you like to withdraw?</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text w-amount-code" style="background-color: rgb(255, 255, 255);">KES</span>
                        </div>
                        <input type="text" name="w-amount" id="w-amount" class="form-control w-form-inputs" placeholder="2000" form="withdraw-form" required>
                    </div>
                    <span class="error text-danger" id="w-amount-err"></span>
                </div>

                <label for="pay-opts" style="margin-top: 25px;">Withdraw money to?</label>

    			<div class="form-group pay-opts-pane row d-flex justify-content-center">


                    <!DOCTYPE html>
                    <html>
                    <head>
                        <style>
                        .payment-opts{ width: 100%; height: 70px;  overflow-x: scroll; overflow-y: hidden; }
                        .payment-opts-container{ width: 1000px; position: absolute;}
                            ::-webkit-scrollbar {
                                display: none;
                            }

                            /* Small devices (phones, 600px and down) */
                            @media only screen and (max-width: 690px) {
                                .pay-opts-pad{ display: block; display: inline-block; float: left; margin-left: 20px;}
                                 .payment-opts-container{ position: relative; width: 2240px; background-color: red;}
                                 .pay-opts-item{ display: block; }
                                
                                .pay-opts-item-less{ display: none; }
                                .pay-opts-item-more{ display: none; }
                            }

                        </style>

                    </head>
                    <body>
                        <div class="payment-opts col-lg-12">

                            <div class="payment-opts-container">

                                <div class="pay-opts-container">
                                <div class="pay-opts-item-less">
                                    <i class="fa fa-chevron-left" style="font-size: 50px; color: lightgray;"></i>
                                </div>
                            </div>

                            <div class="pay-opts-container">
                                <div class="pay-opts"></div>
                            </div>

                            <div class="pay-opts-container">
                                <div class="pay-opts-item-more">
                                    <i class="fa fa-chevron-right" style="font-size: 50px; color: lightgray;"></i>
                                </div>
                            </div>

                            </div>

                        </div>

                    </body>
                    </html>
            
    			</div>

                <div class="form-group w-msisdn-container">
                    <div class="input-group" id="w-msisdn-pane">
                        <div class="input-group-prepend">
                            <span class="input-group-text w-msisdn-cd" style="background-color: rgb(255, 255, 255);">254</span>
                        </div>
                        <input type="hidden" name="w-msisdn" id="w-msisdn" form="withdraw-form" class="form-control withdraw-msisdn w-form-inputs" placeholder="Enter mobile number">
                    </div>
                    <span class="error text-danger" id="w-msisdn-err"></span>
                </div>

    			<div class="form-group w-tplus-container">
                    <div class="form-group">
                        <input type="text" name="w-acc-nm" id="w-acc-nm" form="withdraw-form" class="form-control withdraw-acc-name w-form-inputs" placeholder="Enter account name">
                    </div>
                    <span class="error text-danger" id="w-acc-nm-err"></span>         
                </div>

                <div class="form-group w-tplus-container">
                    <div class="form-group">
                        <input type="text" name="w-acc-no" id="w-acc-no" form="withdraw-form" class="form-control withdraw-acc-name w-form-inputs" placeholder="Enter account number">
                    </div>
                    <span class="error text-danger" id="w-acc-no-err"></span>         
                </div>

                <input type="hidden" name="payer_client" id="payer_client" value="7" form="withdraw-form">
    			<button class="btn btn-primary btn-block" id="act-withdraw-btn" style="height: 50px; margin-top: 40px; margin-bottom: 30px;">Send request</button>
  			</div>
		</div>

	<!-- </div> -->

	<!-- <div class="withdraw-pane-tab withdraw-pane-right"> -->
		
		<div class="card col-lg-4 card-right">
			<div class="card-header">
				<h5 class="card-title text-muted">Group account</h5>
			</div>
  			<div class="card-body">
    			<p class="card-text text-muted">Total amount raised</p>
    			<p class="card-text font-semibold" id="set-balance2" style="font-size: 25px; margin-top: -10px; margin-bottom: 40px; display: block;">
                    KES <i class='fa fa-circle-notch fa-spin text-muted' id="spinner"></i>
                </p>
    			<p class="card-text text-muted">Target amount</p>
    			<p class="card-text font-semibold" style="font-size: 25px; margin-top: -10px;">KES <?= $details->AMOUNT ?></p>

                <!-- Hidden inputs for ajax request -->
                <input id="phoneNumber" class="hidden" type="text" style="display:none" value="<?= $details->GROUP_ADMIN_MSISDN[0];?>" />
                <input id="groupID" class="hidden" type="text" style="display:none" value="<?= $details->GROUP_ID;?>" />
                <input id="groupAmount" class="hidden" type="text" style="display:none" value="<?= $details->AMOUNT;?>" />
  			</div>
		</div>

	<!-- </div> -->

</div>


<?php $this->beginBlock('scripts'); ?>
    <script>
        $(window).on('load', function() {
            //get wallet ID and Admin phone number
            var groupID = document.getElementById("groupID");
            var phoneNumber = document.getElementById("phoneNumber");
            groupID = $(groupID).val();
            phoneNumber = $(phoneNumber).val();

            //console.log("groupID: "+groupID);
            //console.log("adminPhone: "+phoneNumber);

            //get wallet balance using groupID and phoneNumber
            $.ajax({
                type: 'GET',
                url: '<?php echo \Yii::$app->getUrlManager()->createUrl('group/wallet-balance') ?>',
                data: {
                    groupID : groupID,
                    adminNo : phoneNumber
                },
                success: function(data){
                    console.log(data);
                    $('#set-balance').text('KES ' + data);
                    $('#set-balance2').text('KES ' + data);
                }
            });
        });
    </script>
<?php $this->endBlock();