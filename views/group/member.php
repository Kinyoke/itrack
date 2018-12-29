<?php

use  yii\web\View;
use  yii\helpers\Url;

$this->title = $details->GROUP_NAME ;

/*redirect("../group/profile?id=544");
function redirect($url) {
    ob_start();
    header('Location: '.$url);
    ob_end_flush();
    die();
}*/

?>


<?= $this->render('../layouts/nav'); ?>

<script src="../js/shareOptions.js"></script>

<style>
    #carouselExampleIndicators.carousel.slide {
        /*width: 100%;*/
        /*max-height: 300px; !important*/
    }
    @media only screen and (min-width: 800px) {
        .carousel-inner{
            height: 315px;
        }
    }
    .btn-outline-blue{
        width: 80%;
        height: 50px;
        margin: auto;
        margin-top: 15px;
        background-color: #FFFFFF;
        border: 1px solid #007AFF;
        color: #007AFF;
    }
</style>


<div class="row py-2 col-lg-12" style="margin-top: 90px;">


    <div class="container">

        <div class="container">
            <div class="col-lg-2 pl-lg-0">
                <?php
                foreach ($details->GROUP_MEMBERS as $GROUP_MEMBER) {
                    if ($GROUP_MEMBER->GROUP_MEMBER_TYPE === 'ADMIN')
                    {
                        ?>
                        <div class="same-name">
                            <div id="same-name-left prof-init">
                                <div class="inits">
                                    <?php
                                    $words = explode(" ", $GROUP_MEMBER->GROUP_MEMBER_NAME);
                                    $acronym = "";
                                    $letters = 0;
                                    foreach ($words as $w) {
                                        if($letters < 2)
                                        {
                                            $acronym .= $w[0];
                                        }else{
                                            break;
                                        }
                                        $letters = $letters + 1;
                                    }
                                    echo $acronym;
                                    ?>
                                </div>
                            </div>
                            <div id="same-name-left owner-desc">
                                <p>By <a href="#" id="owner-name"><?= $GROUP_MEMBER->GROUP_MEMBER_NAME?></a><p>
                                    Created  <?= date("d M Y", strtotime($details->GROUP_DATE_CREATED)) ?></p>
                                </p>
                            </div>
                        </div>
                        <?php
                        break;
                    }
                }
                ?>
            </div>

            <!-- Hidden fields for ajax requests -->
            <input id="groupID" class="hidden" type="text" style="display:none" value="<?= $details->GROUP_ID;?>" />
            <input id="phoneNumber" class="hidden" type="text" style="display:none" value="<?= $details->GROUP_ADMIN_MSISDN[0];?>" />
            <input id="groupAmount" class="hidden" type="text" style="display:none" value="<?= $details->AMOUNT;?>" />

            <div class="same-name col-lg-8">
                <div id="">
                    <h4 id="group-name"><?= $details->GROUP_NAME ?></h4>
                </div>
                <div id="">
                    <p id="group-desc" class="text-muted"> <?= $details->GROUP_DESCRIPTION ?>
                    </p>
                </div>
            </div>
        </div>

    </div>
    
</div>

<div class="container">
    
    <div class="row">

        <div class="col-lg-8">
            
            <div class="card mb-4">
                <div class="">
                    <input type="hidden" name="groupID" id = "memberPageGroupID" value="<?= $details->GROUP_ID ?>">  
                    
                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel" style="width: 100%; height: 395px; display: none;">

                        <div class="carousel-inner" id="mainSlider" style="width: 100%; height: 100%; ">
                        </div>

                    </div>
                    
                    <div align="center" style="background: #f5f5f5; width: 100%; height: 395px" id= "defaultImage">

                        <input id="profile-image-upload" class="hidden" type="file" style="display:none" accept="image/*"/>
                        <img class="card-img-top" src="../images/Placeholder.png" style="height:100px; width: 100px; margin-top: 15%">

                    </div>

                </div>


                <div id="stats-mobile-container">
                    
                    <div class="progress" style="height: 7px; margin-bottom: 20px;">
                        <div class="progress-bar" id = "set-progress" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                    <h4 class="font-semibold mb-0" id="set-balance">KES 0</h4>
                    <p class="font-thin text-muted">raised of KES <?= $details->AMOUNT ?> Goal</p>

                    <h4 class="font-semibold mb-0"><?= $contributions ?></h4>
                    <p class="font-thin text-muted"><?php if($contributions == 1){ echo "Contribution"; }else{ echo "Contributions"; }?></>

                    <h4 class="font-semibold mb-0"><?= $days ?></h4>
                    <p class="font-thin text-muted">Days left</p>


                    <div>
                        
                        <input style="visibility: hidden;" value="<?= $details->GROUP_ACCOUNT ?>" id = "groupAccount">

                        <button class="btn btn-primary" style="width:100%; height: 50px" data-toggle="modal" data-target="#actionContributeForm">Contribute</button>
                        <button class="btn btn-primary btn-outline-blue" style="width:100%" onclick="location.href = '../group/pledge';">Pledge</button>
                    </div>

                </div>


                <div class="card-body text-center pt-1">
                    <ul class="nav row d-flex border-bottom" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" role="tab" href="#contributions" aria-controls="contributions" aria-selected="true">Contributions</a>
                        </li>
                        <?php
                        if(isset($_SESSION['phoneNumber'])){
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" role="tab" href="#pledges" aria-controls="pledges" aria-selected="true">Pledges</a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" role="tabpanel" id="contributions">
                            <div class="">
                                <ul class="p-0">
                                    <?php
                                    $index = 0;
                                    $y = 0;
                                    foreach($report as $action){

                                        if( $action->TRANSACTION_TYPE === "CONTRIBUTION")
                                        {
                                            $index+=1;
                                            ?>
                                            <li class="<?php if($index < 5) echo 'listX-contrib p-2 mt-1 listX-contrib-active'; else echo 'listX-contrib p-2 mt-1'; ?> row">

                                                <div class= "acronym xs-hidden list-row float-left">
                                                    <p class="mb-0">
                                                        <?php
                                                        if($action->MEMBER_NAMES != "") {
                                                            $words = explode(" ", $action->MEMBER_NAMES);
                                                            $acronym = "";
                                                            $letters = 0;
                                                            foreach ($words as $w) {
                                                                if($letters < 2)
                                                                {
                                                                    $acronym .= $w[0];
                                                                }else{
                                                                    break;
                                                                }
                                                                $letters = $letters + 1;
                                                            }
                                                            echo $acronym;
                                                        }
                                                        ?>
                                                    </p>
                                                </div>
                                                <div class="col-lg-10 list-row">
                                                    <p class="font-semibold my-2 float-right"><?= $action->CURRENCY ?> <?= $action->AMOUNT ?></p>
                                                    <p class="name my-2"><?= $action->MEMBER_NAMES ?></p>
                                                    <p class="phone m-0 text-muted" style="display: none"><?= $action->MSISDN ?></p>
                                                    <p class="phone m-0 text-muted float-left">
                                                        <?php
                                                        $earlier = new \DateTime();
                                                        $later = new \DateTime($action->TRANSACTION_DATE);
                                                        $diff = $later->diff($earlier)->format("%a");
                                                        if($diff < 1)
                                                        {
                                                            $time = 'Today';
                                                        }else{
                                                            $time = $diff.' days ago';
                                                        }
                                                        echo $time;
                                                        ?></p>
                                                        <p class="m-0 text-muted float-right"> <?php if($action->TRANSACTION_STATUS == 1) echo "<p class = 'm-0 text-muted float-right' style='color:green !important'>success</p>";else echo "<p class = 'm-0 text-muted float-right' style='color:red !important'>Failed</p>"; ?></p>
                                                </div>
                                            </li>
                                            <?php
                                            $y = $y +1;
                                        }
                                    }
                                    if($y === 0)
                                    { ?>
                                        <div class="d-flex" style="height:250px">
                                            <div class="my-auto">
                                                <h5 class="card-title">You have no contributions yet.</h5>
                                                <p class="card-text text-muted">Contributions will show up here. Start by sharing your campaign with friends and family.</p>
                                                <a href="#" data-toggle="modal" data-target="#actionShare" class="btn btn-outline-primary blue-btn">Share Fundraiser</a>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                    <div class="info-more-btn-contr">
                                        <i class="fa fa-chevron-down indicator-contr"></i>
                                        <span id="info-more-contr-btn-label" style="padding-left: 20px;"></span>
                                        <span id="more-contr-less-label">more</span>
                                    </div>

                                </ul>

                            </div>
                        </div>

                        <?php
                            if(isset($_SESSION['phoneNumber'])){
                                ?>
                                <div class="tab-pane fade" role="tabpanel" id="pledges">
                                    <div class="">
                                        <ul class="p-0">
                                            <?php
                                            $i = 0;
                                            $indexPl = 0;
                                            //echo count($pledges);
                                            // return count($pledges);
                                            if(count($pledges) > 0){

                                                foreach($pledges as $action){
                                                    $indexPl++;
                                                    ?>

                                                    
                                                    <li class="listX-pledge <?php if($indexPl < 5) echo 'listX-pledge-active';?> p-2 mt-1 row">

                                                <div class= "acronym xs-hidden list-row float-left"><p class="mb-0 acronym-pledge"> 
                                                    <?php
                                                        if($action->MEMBER_NAMES != "")
                                                        {
                                                            $words = explode(" ", $action->MEMBER_NAMES);
                                                            $acronym = "";
                                                            $letters = 0;
                                                            foreach ($words as $w) {
                                                                if($letters < 2)
                                                                {
                                                                    $acronym .= $w[0];
                                                                }else{
                                                                    break;
                                                                }
                                                                $letters = $letters + 1;
                                                            }
                                                            echo $acronym;
                                                        }
                                                    ?>
                                                    </p>
                                                </div>
                                                <div class="col-lg-10 list-row list-row-pledge">
                                                    <p class="amount-pledge my-2 font-semibold float-right">KES <?= $action->AMOUNT ?></p>
                                                    <p class="name my-2 name-pledge"> <?= $action->MEMBER_NAMES ?></p>

                                                    <p class="phone-pledge phone m-0 text-muted" id="<?php if(Yii::$app->session->get('phoneNumber') == $action->MSISDN) echo '76HJGGFAhg347hjgff'; ?>">
                                                        <?php
                                                        $earlier = new \DateTime();
                                                        $later = new \DateTime($action->DUE_DATE);
                                                        $diff = $later->diff($earlier)->format("%a");
                                                        if($diff < 1)
                                                        {
                                                            $time = 'Today';
                                                        }else{
                                                            $time = $diff.' days ago';
                                                        }
                                                        echo $time;
                                                        ?></p>

                                                    <p class="pladge-due-date m-0 text-muted" style="display:none;"><?= $action->DUE_DATE ?></p>
                                                </div>
                                                </li>
                                                    <?php
                                                    $i = $i +1;
                                                }
                                            }
                                            if($i === 0)
                                            { ?>
                                                <div class="d-flex" style="height:250px">
                                                    <div class="my-auto">
                                                        <h5 class="card-title">You have no pledges yet.</h5>
                                                        <p class="card-text text-muted">Pledges will show up here. Start by sharing your campaign with friends and family.</p>
                                                        <a href="#" data-toggle="modal" data-target="#actionShare" class="btn btn-outline-primary blue-btn">Share Fundraiser</a>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?>

                                            <div class="info-more-btn-pledge">
                                                <i class="fa fa-chevron-down indicator-pledge"></i>
                                                <span id="info-more-pledge-btn-label" style="padding-left: 20px;"></span>
                                                <span id="more-pledge-less-label">more</span>
                                            </div>
                                        </ul>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 px-4 p-xs-4">

            <div id="stats-desktop-container">
                

                <div class="progress" style="height: 7px; margin-bottom: 20px;">
                    <div class="progress-bar" id = "set-progress" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                </div>

                <h4 class="font-semibold mb-0" id="set-balance">KES 0</h4>
                <p class="font-thin text-muted">raised of KES <?= $details->AMOUNT ?> Goal</p>

                <h4 class="font-semibold mb-0"><?= $contributions ?></h4>
                <p class="font-thin text-muted"><?php if($contributions == 1){ echo "Contribution"; }else{ echo "Contributions"; }?></>

                <h4 class="font-semibold mb-0"><?= $days ?></h4>
                <p class="font-thin text-muted">Days left</p>


                <div>
                    
                    <input style="visibility: hidden;" value="<?= $details->GROUP_ACCOUNT ?>" id = "groupAccount">

                    <button class="btn btn-primary" style="width:100%; height: 50px" data-toggle="modal" data-target="#actionContributeForm">Contribute</button>
                    <button class="btn btn-primary btn-outline-blue" style="width:100%" onclick="location.href = '../group/pledge';">Pledge</button>
                </div>
                

            </div>


            <div class="mt-4 text-center">
                <p class="text-muted font-semibold">Spread the word</p>
                <div class="d-flex justify-content-center">
                    <div class="social-link">
                        <!-- Facebook -->
                        <a href="" id = "shareViaFacebook" target="_blank">
                            <img src="../images/if_Popular_Social_Media-04_2329258(1).svg" width="40" height="40">
                        </a>
                    </div>
                    <div class="social-link">
                        <!-- <a href="https://twitter.com/home?status=Mula%20fundraising%3A%20Fundraising%20that%20actually%20works" target="_blank"> -->
                        <!-- Twitter -->
                        <a href="" id="shareViaTwitter" target="_blank">
                            <img src="../images/if_Popular_Social_Media-13_2329255(1).svg" width="40" height="40">
                        </a>
                    </div>
                    <div class="social-link">
                        
                        <!-- LinkedIn -->
                        <a href="" id="shareViaLinkedin" target="_blank">
                            <img src="../images/if_Popular_Social_Media-22_2329259.svg" width="40" height="40">
                        </a>
                    </div>
                    <div class="social-link">
                        <!-- Email -->
                        <a href="" id="shareViaMail">
                            <i class="fa fa-envelope px-2" style="font-size: 25px; line-height: 40px;"></i>
                        </a>
                    </div>
                    <div class="social-link">
                        <span style="cursor: url();" onclick="copyLink()" id="copySharedLink">
                            <i class="fa fa-link px-2" style="font-size: 20px; line-height: 40px;"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>        
    
    </div>

</div>

<?= $this->render('../layouts/footer'); ?>



<!-- The share Modal -->
<div class="modal" id="actionShare">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title col-lg-12">Share</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="share-group-list">
            <ul class="col-lg-11">
                
                <li>
                    <a href="javascript:facebookCurrentPage()" target="_blank">
                        <p class="share-list-item"><img src="../images/if_Popular_Social_Media-04_2329258(1).svg" style="width: 15%;"> Facebook</p>
                    </a>
                </li>


                <li>
                    <a href="javascript:tweetCurrentPage()" target="_blank">
                        <p class="share-list-item"><img src="../images/if_Popular_Social_Media-13_2329255(1).svg" style="width: 15%;"> Twitter</p>
                    </a>
                </li>


                <li>
                    <a href="javascript:linkedInCurrentPage()">
                        <p class="share-list-item"><img src="../images/if_Popular_Social_Media-22_2329259.svg" style="width: 15%;"> LinkedIn</p>
                    </a>
                </li>

                 <li>
                    <a href="#">
                        <p class="share-list-item"><i class="fa fa-envelope" style=" color: #007AFF; width: 15%; padding-left: 15px; font-size: 30px; padding-top: 10px; padding-bottom: 10px;"></i>
                            <span class="styless">Email</span>
                        </p>
                    </a>
                </li>

                 <li>
                    <a href="#">
                        <p class="share-list-item"><i class="fa fa-link" style="color: #007AFF; width: 15%; padding-left: 15px; font-size: 30px; padding-top: 10px; padding-bottom: 10px;"></i> 
                            <span class="styless">Copy link</span>
                        </p>
                    </a>
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

<button type="button" data-toggle="modal" data-target="#actionPledgeEdit" class="btn btn-info" id="actPledgeEd" style="display: none;">Edit pledge</button>

<!-- The Modal -->
<div class="modal" id="actionPledgeEdit">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header" style="border-color: transparent;">
        <div class="modal-title"></div>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

        <form action="../group/edit-pledge" method="post" id="editPledge-form">
            <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
          <!-- Modal body -->
          <div class="modal-body">
            <div id="pledge-intro" class="col-lg-12">
                <div class="row">
                    <div id="profile-initials-e"><span class="text-muted" id="initials-e">LS</span></div>
                </div>
                <div class="row">
                    <h4 class="" id="pledger-alias-e">Laura Silva</h4>
                </div>
                <div class="row">
                    <p class="text-muted" id="pledger-mno-e">0767123456</p>
                </div>
            </div>
            <div class="share-group-list">
                <ul class="col-lg-12" style="margin: auto;">
                     <li>
                        <div class="deatil-container">
                            <p class="text-muted">Pledge</p>
                             <div class="form-group"> 
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">KES</span>
                                    </div>
                                    <input type="text" name="in-p-amount" id="in-p-amount" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </li>

                     <li>
                        <div class="deatil-container">
                            <p class="text-muted">Due On</p>
                            <!-- <p class="">22 Nov 2019</p> -->
                              <input type="text" name="p-due-date-e" id="datepicker" class="form-control" required>
                        </div>
                    </li>

                </ul>
            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <div class="container" style="height: 120px; width: 100%; margin: auto;">
                <button type="submit" class="btn btn-primary col-lg-12" name="editPledge-btn" id="editPledge-btn" style="margin: auto; height: 50px; font-size: 15px; margin-bottom: 10px;">Edit pledge</button>
             <button type="submit" class="btn btn-danger col-lg-12" name="deletePledge-btn" id="deletePledge-btn" style="margin: auto; height: 50px; font-size: 15px;">Delete pledge</button>
            </div>
          </div>
        </form>

    </div>
  </div>
</div>


<!-- The "Pay with mula" button needs to have the "mula-checkout-button" class -->
<!-- <a class="checkout-button"></a> -->

<!-- Include a polyfil for to support the old browsers -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcomponentsjs/1.0.17/webcomponents-loader.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- <script src="../js/watchDog.js"></script> -->


<?php $this->beginBlock('scripts'); ?>

<script>
(function($) {
    var $window = $(window),
        $widget = $('.widget');
        $wrapper= $('#wrapper');

    function resize() {
        if ($window.width() < 514) {
            $widget.addClass('card');
            return $wrapper.removeClass('card');
        }
        
        $widget.removeClass('card');
        $wrapper.addClass('card');
    }

    $window
        .resize(resize)
        .trigger('resize');
})(jQuery);
</script>

<?php $this->endBlock(); ?>


<?php $this->beginBlock('scripts'); ?>
    <script>
        $(window).on('load', function() {
            //get wallet ID and Admin phone number
            var groupID = document.getElementById("groupID");
            var phoneNumber = document.getElementById("phoneNumber");
            groupID = $(groupID).val();
            phoneNumber = $(phoneNumber).val();

            //get wallet balance using groupID and phoneNumber
            $.ajax({
                type: 'GET',
                url: '<?php echo \Yii::$app->getUrlManager()->createUrl('group/wallet-balance') ?>',
                data: {
                    groupID : groupID,
                    adminNo : phoneNumber
                },
                success: function(data){
                    // console.log(data);
                    $('#set-balance').text('KES ' + data);

                    //calculate progress
                    var groupAmount = document.getElementById("groupAmount");
                    groupAmount = $(groupAmount).val();
                    var progress = (data*100)/groupAmount;
                    // $('#set-progress').css({"width": ""+ progress+"%"})
                    $('#set-progress').animate({
                        width: progress + "%"
                    }, 2500);
                }
            });
        });
    </script>
<?php $this->endBlock();