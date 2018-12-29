<?php

/*
*@Author: Faisal Burhan Abdu
*@Author: Davis Wambugu
*@Date: November 13 2018
*@Version: 1.0.0v
*@Copyright (C): Cellulant corporation
*/

use yii\helpers\Html;

?>

<?php 
    $this->beginPage()
 ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <!-- Bootstrap 4 CDN -->
    <link rel="stylesheet" href="../vendors/bootstrap4/css/bootstrap.min.css">

    <!-- FontAwesome Font -->
    <link rel="stylesheet" href="../vendors/fontawesome-free-5.4.2-web/css/all.css">

    <!-- Toastr Alerts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">

    <!-- Theme -->
    <meta name="theme-color" content="#007AFF">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico">

    <!-- Datepicker -->
    <link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/parallax.css">


    <!-- Custom responsive Css -->

    <link rel="stylesheet" type="text/css" href="../css/responsive.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,800" rel="stylesheet">
    

    <?php $this->head() ?>

    <style type="text/css">
        .form-group.required label:after { 
           content:" *";
           color:red;
        }
        .form-check-inline.required label:after { 
           content:" *";
           color:red;
        }

    </style>
    
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">

        <?= $content ?>
    
</div>

<?php $this->endBody() ?>

<!-- JQuery -->
<script src="../vendors/jquery/jquery-3.3.1.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="../vendors/jquery/jquery.form.js"></script>


<!--Bootstrap 4 -->
<script src="../vendors/bootstrap4/js/bootstrap.min.js"></script>

<!-- List.js -->
<script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>

<!-- custom js -->
<script src="../js/eventHandler.js"></script>

<!-- Datepicker -->
<script src="https://unpkg.com/gijgo@1.9.11/js/gijgo.min.js" type="text/javascript"></script>
<script>

    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap4',
        minDate: new Date(),
        format: 'mm/dd/yyyy'
    });
</script>


<?php 
if(Yii::$app->session->hasFlash('CreateGroup')){ ?>
    <script type="text/javascript">
        $(window).ready(function () {
         $('#actionSuccessAlert').modal('show');
        });
    </script>
    <?php } ?>

<script>
    function copyLink() {
      
        var htmlLink = window.location.href;

        var tempInput = document.createElement("input");

        tempInput.style = "position: absolute; left: -1000px; top: -1000px";

        tempInput.value = htmlLink;

        document.body.appendChild(tempInput);

        tempInput.select();

        /* Copy the text inside the text field */
        document.execCommand("copy");

        document.body.removeChild(tempInput);

    }

</script>


<!-- make contribution form -->
<script type="text/javascript">
    
        function onKeyChangeName() {
            var fullName = document.getElementById("fullname");
            if(fullName.value == ""){
            
                err_fullname.innerHTML = "Enter your fullname"; 
            
            }else{
            
                err_fullname.innerHTML = ""; 

            }
        }
    
        function onKeyChangePhone() {
            var phoneNumber = document.getElementById("phonenumber");
            
            if(phoneNumber.value == ""){
            
                err_phoneNumber.innerHTML = "Enter your phonenumber"; 
            
            }else{

                if(!phoneNumber.value.match('^(0|)[0-9]{9}$')){
                    
                    err_phoneNumber.innerHTML = "Enter a valid phone number"; 

                }else{
                    
                    err_phoneNumber.innerHTML = "";
                
                }

            }
        }
    
        function onKeyChangeAmount() {
            var countributionAmount = document.getElementById("contributionAmount");
            
            if(countributionAmount.value == ""){
            
                err_contributionAmount.innerHTML = "Enter contribution amount"; 
            
            }else{
                
                if(countributionAmount.value < 10){
                    err_contributionAmount.innerHTML = "Amount should be greater than 10";        
                }

                else if(countributionAmount.value > 100000){
                    err_contributionAmount.innerHTML = "Amount should be less than 100000";        
                }else{

                    err_contributionAmount.innerHTML = ""; 
                }


            }
        }


        //prevent Back Dating on date fileds

        var currentDate = new Date().toISOString().slice(0,10);
          
        if(document.getElementById("edit-timeline") != null){

            document.getElementById("edit-timeline").min = currentDate;

        }

        if(document.getElementById("timeline") != null){

            document.getElementById("timeline").min = currentDate;

        }

        function termsConditionsListener()
        {
          if (document.getElementById('terms-mark').checked) 
          {
              err_termsConditions.innerHTML = ""; 
          } else {
              err_termsConditions.innerHTML = "Please check the terms & conditions";
          }
        }

</script>

<!-- The Modal -->
<div class="modal" id="actionContributeForm" style="margin-top: 0px;">

<form method="POST" id="contrubution-group-form"></form>

  <div class="modal-dialog model-sm">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <h4 class="modal-title text-muted">Make a contribution</h4>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="form-group">
            <div class="row">
                <div class="form-group required col-lg-10" style="margin: auto;">
                    <label for="fullName">Enter your full name:</label>
                    <input type="text" name="fullname" id="fullname" class="form-control" placeholder="Enter your first and last name" form="contrubution-group-form" required onkeyup="onKeyChangeName()">
                    <span class="error text-danger" id="err_fullname" form="contrubution-group-form"></span>
                </div>
            </div>
            <div class="row">
                <div class="form-group required col-lg-10" style="margin: auto;">
                    <label for="phonenumber">Enter your phone number:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text" style="background: white">+254</span>
                        </div>
                        <input type="text" name="phonenumber" id="phonenumber" class="form-control" placeholder="Enter your phone number" form="contrubution-group-form" required onkeyup="onKeyChangePhone()">
                    </div>
                    <span class="error text-danger" id="err_phoneNumber" form="contrubution-group-form"></span>
                </div>
            </div>

            <div class="row">
                <div class="form-group required col-lg-10" style="margin: auto;">
                    <label for="fullName">How much would you like to contribute?</label>
                    <input type="number" name="contributionAmount" id="contributionAmount" class="form-control" placeholder="Enter amount" form="contrubution-group-form" required onkeyup="onKeyChangeAmount()">
                    <span class="error text-danger" id="err_contributionAmount" form="contrubution-group-form"></span>
                </div>
            </div>

            <div class="row">
                 <div class="form-group col-lg-9 anonymous" style="margin: auto; margin-bottom: 8px;">
                    <label class="form-check-label" for="anonymous">
                    <input type="checkbox" name="anonymous" id="anonymous" class="form-check-input" value="public" form="contrubution-group-form"> I would like to be anonymous?
                    </label>
                </div>
            </div>

            <div class="row">
                 <div class="form-group col-lg-9 terms-mark" style="margin: auto; margin-bottom: 16px;">
                    <label class="form-check-label" for="terms-mark">
                        <input type="checkbox" name="terms-mark" id="terms-mark" class="form-check-input" value="true" form="create-group-form" required onchange="termsConditionsListener()"> Yes, I agree to Mula Fundraiser <a href="https://mula.co.ke/terms-of-service.php" target="_blank">Terms</a> and <a href="https://mula.co.ke/terms-of-service.php" target="_blank">Privacy Policy</a>
                    </label>


                    <span class="error text-danger" id="err_termsConditions" form="contrubution-group-form"></span>
                </div>
            </div>

            <div class="row">
                <div class="checkout-button col-lg-10" style="margin: auto;" id="contributeButton"></div>
            </div>

        </div>
      </div>

      <!-- Modal footer -->
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div> -->

    </div>
  </div>
</div>

<!-- The share Modal -->
<div class="modal" id="actionShare">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header modal-header-share">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <h4 class="modal-title modal-title-share text-muted">Share</h4>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="share-group-list">
            <ul class="col-lg-11">
                
                <li>
                    <a href="" target="_blank" id = "shareViaFacebook">
                        <p class="share-list-item"><img src="../images/if_Popular_Social_Media-04_2329258(1).svg" style="width: 15%;"> Facebook</p>
                    </a>
                </li>


                <li>
                    <a href="" target="_blank" id = "shareViaTwitter"><img src="../images/if_Popular_Social_Media-13_2329255(1).svg" style="width: 15%;"> Twitter</p>
                    </a>
                </li>


                <li>
                    <a href="" target="_blank" id = "shareViaLinkedin">
                        <p class="share-list-item"><img src="../images/if_Popular_Social_Media-22_2329259.svg" style="width: 15%;"> LinkedIn</p>
                    </a>
                </li>

                 <li>
                    <a href="" target="_blank" id = "shareViaMail">
                        <p class="share-list-item"><i class="fa fa-envelope"></i>
                            <span class="styless">Email</span>
                        </p>
                    </a>
                </li>

                 <li>

                    <p onclick="copyLink()" class="share-list-item"><i class="fa fa-link" style="width: 15%; padding-left: 15px; font-size: 30px; padding-top: 10px; padding-bottom: 10px;"></i> 
                        <span class="styless">Copy link</span>
                    </p>

                </li>

            </ul>
        </div>
      </div>

      <!-- Modal footer -->
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div> -->

    </div>
  </div>
</div>


<script type="text/javascript">
    
    function copyShareLink() {
      /* Get the text field */
      var copyText = document.getElementById("myInput");

      /* Select the text field */
      copyText.select();

      /* Copy the text inside the text field */
      document.execCommand("copy");

      /* Alert the copied text */
      alert("Copied the text: " + copyText.value);
    }

    if(document.getElementById('shareViaFacebook') != null
        || 
       document.getElementById('shareViaTwitter') != null
        || 
       document.getElementById('shareViaLinkedin') != null
        || 
       document.getElementById('shareViaMail') != null ){


        var shareViaFacebook = document.getElementById('shareViaFacebook'); //or grab it by tagname etc
        //shareViaFacebook.href = "http://www.facebook.com/sharer.php?u=https://shops.mula.africa/";
        shareViaFacebook.href = "https://www.facebook.com/sharer.php?u="+escape(window.location.href);
            
        var shareViaTwitter = document.getElementById('shareViaTwitter'); //or grab it by tagname etc
        // shareViaTwitter.href = "https://twitter.com/share?url=https://shops.mula.africa/&amp;text=Simple%20Share%20Buttons&amp;hashtags=simplesharebuttons";
        shareViaTwitter.href = "https://twitter.com/share?url="+escape(window.location.href)+"&amp;text="+document.title+"&amp;hashtags=simplesharebuttons";

        var shareViaLinkedin = document.getElementById('shareViaLinkedin'); //or grab it by tagname etc
        // shareViaLinkedin.href = "http://www.linkedin.com/shareArticle?mini=true&amp;url=https://shops.mula.africa/";
        shareViaLinkedin.href = "https://www.linkedin.com/shareArticle?mini=true&amp;url="+escape(window.location.href);
            
        var shareViaMail = document.getElementById('shareViaMail'); //or grab it by tagname etc
        // shareViaMail.href = "mailto:?Subject=Simple Share Buttons&amp;Body=I%20saw%20this%20and%20thought%20of%20you!%20 https://shops.mula.africa/";
        shareViaMail.href = "mailto:?Subject="+document.title+"&amp;Body= "+escape(window.location.href);

    }
</script>


<!-- Include the mula Express checkout library -->
<script id="mula-checkout-library" type="text/javascript" src="https://mula.africa/v2/mula-checkout.js" charset="utf-8"></script>

<script type="text/javascript" src="../js/mulaContribution.js"></script>
<!-- Initialize the "Pay with mula" button -->


<script src="https://www.gstatic.com/firebasejs/5.5.8/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.5.8/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.5.8/firebase-storage.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.5.8/firebase-database.js"></script>
<script src="../js/firebase.js"></script>


<!-- Toastr Alerts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<!--<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>-->
<script>
    /* Toast Options*/
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-left",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "500",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    /* Show error messages */
    var error_message = '<?php
        $session = Yii::$app->session;
        if($session->has('msg-error'))
        {
            echo $session->getFlash('msg-error');
        }
        ?>';

    if(error_message != '')
    {
        toastr["error"](error_message);
    }

    /* Show warning messages */
    var warning_message = '<?php
        $session = Yii::$app->session;
        if($session->has('msg-warning'))
        {
            echo $session->getFlash('msg-warning');
        }
        ?>';

    if(warning_message != '')
    {
        toastr["warning"](warning_message);
    }

    /* Show info messages */
    var info_message = '<?php
        $session = Yii::$app->session;
        if($session->has('msg-info'))
        {
            echo $session->getFlash('msg-info');
        }
        ?>';

    if(info_message != '')
    {
        toastr["info"](info_message);
    }

    /* Show success messages */
    var success_message = '<?php
        $session = Yii::$app->session;
        if($session->has('msg-success'))
        {
            echo $session->getFlash('msg-success');
        }
        ?>';

    if(success_message != '')
    {
        toastr["success"](success_message);
    }

</script>


<?php if (isset($this->blocks['scripts'])):?>
    <?= $this->blocks['scripts'] ?>
<?php endif; ?>
</body>
</html> 
<?php $this->endPage() ?>
