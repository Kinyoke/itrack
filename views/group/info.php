<?php

use  yii\web\View;
use  yii\helpers\Url;

$this->title = $details->GROUP_NAME ;

?>



<style type="text/css">
    .listX-contrib, .listX-member, .listX-pledge{ display: none; transition: .2s;}
    .listX-contrib-active, .listX-member-active, .listX-pledge-active{ display: block; }
    .listX-pledge:hover{ cursor: pointer; opacity: 0.7; background-color: rgb(245, 245, 245);}
    .info-more-btn-contr, .info-more-btn-pledge, .info-more-btn-member{ background-color: rgb(235, 235, 235); height: 45px; line-height: 45px; margin: 0; padding: 0; left: 0; width: 100%; display: none; position: absolute; margin-top: -6px; }
    .info-more-btn-contr:hover, .info-more-btn-pledge:hover, .info-more-btn-member:hover{ cursor: pointer;  background-color: rgb(235, 235, 235);}
    #updt-cv-photo{ width: 35px; height: 35px; line-height: 45px; text-align: center; border-style: none; border-radius: 10px; background-color: transparent; opacity: 0.8; color: white; transition: .5s;}
    /*#updt-cv-photo:hover{ cursor: pointer; opacity: 0.4; }*/
    /*.my-round-btn{  }*/
    #resend-withdraw-vcode-btn{ text-decoration: none; color: #007AFF; }
    #resend-withdraw-vcode-btn:hover{ cursor: pointer; }
    .group-cover-btn{ float: left; }

</style>

<!--<div class="tuggle-nav"></div>-->

<?= $this->render('../layouts/sidenav'); ?>

<div id="image-banner" style="margin-top: 70px;">
  
  <!-- Display uploaded group img -->
  <div id="edit-back-alt" style="display: none; cursor: pointer;">
    
    <input id="cover-photo-upload" class="hidden" type="file" style="display:none" accept="image/*"/>
        
    <img id = "img-cover-photo">
    
    <!-- <div  class="col-lg-10 container" style="cursor: pointer; margin-top: 30px;">
        <div id="updt-cv-photo"><i class="fa fa-camera group-cover-btn"></i> <span id="upload-cv-text" style="margin-left: 10px; display: none;"></span></div>
    </div> -->
    <div  class="col-lg-10 container" style="cursor: pointer;">
        <div id="updt-cv-photo"><i class="fa fa-camera"></i> <span style="margin-left: 10px;" id="upload-cv-text"></span></div>
    </div>
  </div>

  <!-- Display add cover photo -->
  <div id="upload-cover-photo" style="width: 100%; height:100%; background: #007AFF; cursor: pointer;">  
    
    <div style="width: 100%; height:100%;margin-top: -13px;" align="center">

        <input id="cover-photo-upload" class="hidden" type="file" style="display:none" accept="image/*"/>
        <img src="../images/CAMERA.png" style="height:42px; width: 42px; margin-top: 22px">
        <p style="color:#FFFFFF; margin-top: 8px">Add a cover photo</p>

    </div>

  </div>

</div>



<section class="group-info bg-gray section mt-0" style="margin-top: 100px;">

    <div class="dashboar-nav">
        <div class="card cardX">
            <div class="card-body container">
                <div class="row">
                    <div class="col-lg-6 xs-center">
                        <h5 class="font-weight-normal my-2"><?= $details->GROUP_NAME ?></h5>
                        <input id="groupID" class="hidden" type="text" style="display:none" value="<?= $details->GROUP_ID;?>" />
                        <input id="phoneNumber" class="hidden" type="text" style="display:none" value="<?= $details->GROUP_ADMIN_MSISDN[0];?>" />
                        <input id="groupAmount" class="hidden" type="text" style="display:none" value="<?= $details->AMOUNT;?>" />
                        <div class="progress my-3" style="height: 7px;">
                            <div id="set-progress" class="progress-bar" role="progressbar"  aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p style="font-size:small;">
                            <span class="font-bold" id="set-balance">
                                  KES <i class='fa fa-circle-notch fa-spin text-muted' id="spinner"></i>
                            </span>
                            <span class="font-light text-muted">of KES <?= $details->AMOUNT ?> Goal</span>
                        </p>
                    </div>

                    <div class="col-lg-6 text-center">
                        <div class="d-flex justify-content-center justify-content-lg-end mt-2 menu-btns">
                            <div class="mx-2">                        
                                <button type="button" data-toggle="modal" data-target="#actionAdd" class="btn btn-outline-secondary btn-circle "><i class="fa fa-plus"></i></button>
                                <p class="text-muted my-2">Add</p>
                            </div>
                            <div class="mx-2">                        
                                <button type="button" data-toggle="modal" data-target="#actionContributeForm" class="btn btn-outline-secondary btn-circle "><i class="fa fa-dollar-sign"></i></button>
                                <p class="text-muted my-2">Contribute</p>
                            </div>
                            <div class="mx-2">                        
                                <a href="../group/edit" class="btn btn-outline-secondary btn-circle" id="edit-group-btn"><i class="fa fa-pen"></i></a>
                                <p class="text-muted my-2">Edit</p>
                            </div>
                            <div class="mx-2">                        
                                <button type="button" data-toggle="modal" data-target="#actionShare" class="btn btn-outline-secondary btn-circle"><i class="fa fa-share-alt"></i></button>
                                <p class="text-muted my-2">Share</p>
                            </div>
                            <div class="mx-2">                        
                                <button type="button" data-toggle="modal" data-target="#actionVerification-a" class="btn btn-outline-secondary btn-circle" id="Withdraw-group-btn"><i class="fa fa-university"></i></button>
                                <p class="text-muted my-2">Withdraw</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="container body-main">
        <div class="row mt-4">
            <div class="col-lg-8">

                <?php
                if($details->GROUP_STATUS != "1")
                { ?>

                <div style="">

                    <!DOCTYPE html>
                    <html>
                    <head>

                        <style>
                            .flash-card{ margin: 0; padding: 0; width: 100%; overflow-x: hidden; overflow-y: hidden;}
                            .flash-card-pane{ margin: 0; height: 100%; width: 800px;}

                            .data-card{width: 350px; }
                            .data-card:nth-child(2){ margin-left: 30px; }
                              ::-webkit-scrollbar {
                                display: none;
                            }

                            /* Small devices (phones, 600px and down) */
                            @media only screen and (max-width: 690px) {
                                .flash-card{ overflow-x: scroll; overflow-y: hidden;}
                            }
                        </style>
                        
                    </head>
                    <body style="padding: 0; margin: 0; left: 0; top: 0;">
                        <div class="flash-card col-lg-12">
                            <div class="flash-card-pane col-lg-12">
                                

                                 <div class="card-desktop">

                       <div class="row">
                            <div class="data-card">
                                <a class="card-link" href="#actionContributeForm" data-toggle="modal"  data-target="#actionContributeForm">
                                    <div class="card p-2 my-2  card-border-orange">
                                    <div class="card-body py-1">
                                        <h5 class="card-title">Activate Group</h5>
                                        <p class="card-text font-light text-muted">Your fundraiser is not active. To activate it, please top up any amount into the group account</p>
                                        <div class="">
                                            <p class="inline-item blueesh">Activate Now</p>
                                            <i class="fa fa-arrow-right inline-item float-right"></i>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>
                            <div class="data-card">
                                <a class="card-link" href="#actionShare" data-toggle="modal" data-target="#actionShare">
                                    <div class="card p-2 my-2  card-border-purple">
                                        <div class="card-body py-1">
                                            <h5 class="card-title">Spread the word</h5>
                                            <p class="card-text font-light text-muted">Your fundraiser is not active. To activate it, please top up any amount into the group account</p>
                                            <div class="">
                                                <p class="inline-item bluesh">Share Fundraiser</p>
                                                <i class="fa fa-arrow-right inline-item float-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>


                            </div>
                        </div>
                    </body>
                    </html>
                </div>

                <?php
                }else{
                    ?>
                    <div class="card text-center mb-4" id="wrapper">
                        <div class="card-body row" id="wrapper2">
                            <div class="col-lg-3 col-md-6 col-sm-6 col-6 widget">
                                <p>No. of Contributions</p>
                                <h3 class="font-semibold"><?= $contributions ?></h3>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-6 widget">
                                <p>Avg. Contribution</p>
                                <h3 class="font-semibold"><?= $avg_contributions ?></h3>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-6 widget">
                                <p>No. of Pledges</p>
                                <h3 class="font-semibold"><?= count($pledges) ?></h3>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-6 widget">
                                <p>Account Balance</p>
                                <h3 class="font-semibold" id="set-balance2">
                                    <i class='fa fa-circle-notch blue fa-spin text-muted' id="spinner"></i>
                                </h3>
                            </div>
                        </div>
                    </div>
                <?php
                    }
                    ?> 

                <div class="card text-center my-4">
                    <div class="card-body">
                        <ul class="nav row d-flex border-bottom" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" role="tab" href="#contributions" aria-controls="contributions" aria-selected="true">Contributions</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" role="tab" href="#pledges" aria-controls="pledges" aria-selected="true">Pledges</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" role="tab" href="#members" aria-controls="members" aria-selected="true">Members</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" role="tabpanel" id="contributions">
                                <div class="">
                                    <ul class="p-0 listX-contrib-list">
                                        <?php
                                        $index = 0; 
                                        $y = 0;
                                        foreach($report as $action){
                                            
                                            if( $action->TRANSACTION_TYPE === "CONTRIBUTION")
                                            {
                                                $index+=1;
                                        ?>
                                            <li class="<?php if($index < 5) echo 'listX-contrib p-2 mt-1 listX-contrib-active'; else echo 'listX-contrib p-2 mt-1'; ?> row">

                                                <div class= "acronym xs-hidden list-row float-left"><p class="mb-0"> 
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
                                                <div class="my-auto mx-auto">
                                                    <h5 class="card-title">You have no contributions yet.</h5>
                                                    <p class="card-text text-muted">Contributions will show up here. Start by sharing your campaign with friends and family.</p>
                                                    <a href="#" data-toggle="modal" data-target="#actionShare" class="btn btn-outline-primary blue-btn">Share Fundraiser</a>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>

                                    </ul>
                                                                           
                                </div>
                                
                                <div style="height: 10px; width: 100%; background-color: white; padding: 0; margin: 0; left: 0;">
                                    <div class="info-more-btn-contr row">
                                        <i class="fa fa-chevron-down indicator-contr"></i>
                                        <span id="info-more-contr-btn-label" style="padding-left: 20px;"></span>
                                        <span id="more-contr-less-label">more</span>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade" role="tabpanel" id="pledges">
                            <div class="">
                                    <ul class="p-0 listX-pledge-list">
                                        <?php 
                                        $i = 0;
                                        $indexPl = 0;
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
                                        if($i === 0)
                                        { ?>
                                            <div class="d-flex" style="height:250px">
                                                <div class="my-auto mx-auto">
                                                    <h5 class="card-title">You have no pledges yet.</h5>
                                                    <p class="card-text text-muted">Pledges will show up here. Start by sharing your campaign with friends and family.</p>
                                                    <a href="#" data-toggle="modal" data-target="#actionShare" class="btn btn-outline-primary blue-btn">Share Fundraiser</a>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </div>

                                <div style="height: 10px; width: 100%; background-color: white; padding: 0; margin: 0; left: 0;">
                                    <div class="info-more-btn-pledge row">
                                        <i class="fa fa-chevron-down indicator-pledge"></i>
                                        <span id="info-more-pledge-btn-label" style="padding-left: 20px;"></span>
                                        <span id="more-pledge-less-label">more</span>
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane fade" role="tabpanel" id="members">
                                <div class="">
                                    <ul class="p-0 listX-member-list">
                                        <?php 
                                        $indexMemb = 0;
                                        foreach($details->GROUP_MEMBERS as $member){
                                            $indexMemb++;
                                        ?>                                            
                                            <li class="listX-member <?php if($indexMemb < 5) echo 'listX-member-active'?> p-2 mt-1 row">
                                                
                                            <div class= "acronym xs-hidden list-row float-left"><p class="mb-0">
                                                <?php
                                                if($member->GROUP_MEMBER_NAME != "")
                                                {
                                                    $words = explode(" ", $member->GROUP_MEMBER_NAME);
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
                                                <p class="phone text-muted float-right"><?= $member->GROUP_MEMBER_TYPE ?></p>
                                                <p class="name my-2"><?= $member->GROUP_MEMBER_NAME ?></p>
                                                <p class="phone m-0 text-muted"><?= $member->GROUP_MEMBER_MSISDN ?></p>
                                            </div>

                                            </li>
                                        <?php
                                        }
                                        ?>

                                         

                                    </ul>
                                </div>
                                
                                <div style="height: 10px; width: 100%; background-color: white; padding: 0; margin: 0; left: 0;">
                                    <div class="info-more-btn-member row">
                                        <i class="fa fa-chevron-down indicator-member"></i>
                                        <span id="info-more-member-btn-label" style="padding-left: 20px;"></span>
                                        <span id="more-member-less-label">more</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div> 

            </div>
            <div class="col-lg-4">
                <div class="card" >
                    
                    <div style="background: #f5f5f5; height: 235px">

                        <div class = "sliderImageClass" id = "sliderImageClass" style="width: 100%; height: 100%; ">
                            
                            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel" style="width: 100%; height: 100%">
                                
                                <!-- Indicators -->
                                <ul class="carousel-indicators">
                                    <li data-target="#demo" data-slide-to="0" class="active"></li>
                                    <li data-target="#demo" data-slide-to="1"></li>
                                    <li data-target="#demo" data-slide-to="2"></li>
                                </ul>

                                <div class="carousel-inner" id="mainSlider">
                                </div>

                            </div>

                            <div class="float-right" id="floatCameraButton" style="cursor: pointer;">
                                <!-- <i class="fa fa-camera" ></i> -->
                                <input id="profile-image-upload" class="hidden" type="file" style="display:none" accept="image/*"/> 
                                <input id="profile-group-id" class="hidden" type="text" style="display:none" value="<?= $details->GROUP_ID;?>" /> 
                                <img src="../images/ic_camera_white.png" style="height:42px; width: 42px; margin-top: 10px;">
                            </div>

                        </div>

                        <div align="center" id="cameraAlighnCeter" style="cursor: pointer">

                            <input id="profile-image-upload" class="hidden" type="file" style="display:none" accept="image/*"/>
                            <img src="../images/CAMERA.png" style="height:80px; width: 80px">
                            <p style="color:#FFFFFF; margin-top: 16px">Add Photo</p>
                        
                        </div>

                    </div>

                <div class="card-body">
                    <h5 class="card-title font-semibold" style="margin-top: 10px;"><?= $details->GROUP_NAME ?></h5>
                    <p class="card-text text-muted" style="font-size: 12px; margin-top: 20px; margin-bottom: 30px;"><?= $details->GROUP_DESCRIPTION ?></p>
                    <hr>
                    <div>
                        <h6 class="card-text" style="font-size: 14px; color: black; margin-top: 50px;">Group Signatories</h6>
                        <div class="row my-3" style="margin-bottom: 50px;">
                            
                            <?php 
                                foreach($details->GROUP_MEMBERS as $member){
                                    if($member->GROUP_MEMBER_TYPE === "APPROVER"){
                            ?> 

                            <div class="col-lg-4 text-center">
                                <div class= "acronym mx-auto">
                                    <p class="my-round-btn"> 
                                    <?php
                                        $words = explode(" ", $member->GROUP_MEMBER_NAME);
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
                                    </p>

                                </div>
                                <p class="text-center text-muted my-2" style="font-size:11px;"><?= $member->GROUP_MEMBER_NAME ?></p> 
                            </div>

                            <?php
                                }
                            }
                            ?>



                        <div class="col-lg-4 text-center">
                            <div class= "mx-auto">
                                <button type="button" data-toggle="modal" data-target="#actionAddSignatory" class="btn btn-outline-secondary btn-circle "><i class="fa fa-plus"></i></button>
                            </div>
                            <p class="text-center text-muted my-2" style="font-size:11px;">Add signatory</p> 
                        </div>


                        </div>  
                    </div>
                </div>
                </div>
            </div>
        </div>

    </div>

</section>

<!-- <button style="display: block;" type="button" data-toggle="modal" data-target="#actionSuccessAlert" class="btn btn-info">click profile</button>-->

<!-- The Modal -->
<div class="modal hide" id="actionSuccessAlert">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <!-- <h4 class="modal-title">Add</h4> -->
        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="row text-center">
            <i class="fa fa-check-circle"></i>
        </div>
        <div class="success-text">
            <h2>Fundraiser created!</h2>
            <p class="text-muted">Your fundraiser has been created successfully</p>
            <p>Would you like to add group signatories?</p>
        </div>
        <div class="row d-flex justify-content-center pb-5">
           <div class="p-1">
               <button class="btn btn-outline-primary btn-md blue-btn" data-dismiss="modal">Skip for now</button>
           </div>
            <div class="p-1">
                <button class="btn btn-primary btn-md blue-btn" data-dismiss="modal" data-toggle="modal" data-target="#actionAddSignatory">Add signatories</button>
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



<button type="button" data-toggle="modal" data-target="#actionPledgeReminder" class="btn btn-info" id="actPledgeRem" style="display: none;"></button>

<!-- The Modal -->
<div class="modal" id="actionPledgeReminder">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header" style="border-color: transparent;">
        <div class="modal-title"></div>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

        <form action="../group/reminder" method="post">
            <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
          <!-- Modal body -->
          <div class="modal-body">
            <div id="pledge-intro" class="col-lg-12">
                <div class="row">
                    <div id="profile-initials"><span class="text-muted" id="initials">LS</span></div>
                </div>
                <div class="row">
                    <h4 class="" id="pledger-alias">Laura Silva</h4>
                    <input type="hidden" name="pledger-name" id="pledger-name">
                </div>
                <div class="row">
                    <p class="text-muted" id="pledger-mno">0767123456</p>
                </div>
            </div>
            <div class="share-group-list">
                <ul class="col-lg-10" style="margin: auto;">
                     <li>
                        <div class="deatil-container">
                            <p class="text-muted">Pledge</p>
                            <p class="amount" id="p-amount">KES 2,500.00</p>
                        </div>
                    </li>

                     <li>
                        <div class="deatil-container">
                            <p class="text-muted">Due On</p>
                            <p class="due-date" id="p-due-date-r">22 Nov 2019</p>
                        </div>
                    </li>

                </ul>
            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="submit" id="send-reminder-btn" name="send-reminder-btn" class="btn btn-primary col-lg-10" style="margin: auto; height: 50px; font-size: 15px; margin-bottom: 30px;">Send a reminder</button>
          </div>
        </form>

    </div>
  </div>
</div>






<!-- The Modal -->
<div class="modal" id="actionAdd">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
       <h4 class="modal-title col-lg-12" style="margin-top: 5px;">Add</h4>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="form-group">
            <div class="row">
                <button class="btn btn-info" id="make-plage-btn-rd">A Pledge</button>
            </div>
            <div class="row">
                <button class="btn btn-info action-add-active" data-toggle="modal" data-dismiss="modal"  data-target="#actionContributeForm">A Contribution</button>
            </div>
              <div class="row">
                <button class="btn btn-info action-add-active" data-toggle="modal" data-dismiss="modal"  data-target="#actionPayWithCash">Cash Payment</button>
            </div>
            <div class="row">
                <button class="btn btn-info" data-toggle="modal" data-dismiss="modal"  data-target="#actionAddMember-nav" style="margin-bottom: 30px;">A Member</button>
            </div>
            <input style="visibility: hidden;" value="<?= $details->GROUP_ACCOUNT ?>" id = "groupAccount">
        </div>
      </div>

      <!-- Modal footer -->
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div> -->

    </div>
  </div>
</div>








    <!-- PayWithCash Modal -->
    <div class="modal" id="actionPayWithCash" style="margin-top: 100px;">
        <div class="modal-dialog model-sm">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <h4 class="modal-title text-muted">Pay With Cash</h4>
                <!-- Modal body -->
                <div class="modal-body">
                    <form method="post" action="../group/pay-with-cash">
                        <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
                        <input type="hidden" name="groupID" value="<?= $details->GROUP_ID ?>"/>
                        <div class="form-group">
                            <div class="row">
                                <div class="form-group required col-lg-10" style="margin: auto;">
                                    <label for="mnumber" style="margin-top: 20px;">Enter member phone number:</label>
                                    <input type="number" name="mnumber" id="mnumber" maxlength = "12" class="form-control" placeholder="Enter mobile number" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group required col-lg-10" style="margin: auto;">
                                    <label for="amount" style="margin-top: 20px;">Enter Amount Paid:</label>
                                    <input type="number" name="amount" id="amount" maxlength = "6" class="form-control" placeholder="Enter amount" required>
                                </div>
                            </div>
                            <div class="row">
                                 <!-- <div class="form-group mx-auto mt-3"> -->
                                <button class="btn btn-primary" id="pay-with-cash-btn">Pay With Cash</button>
                                 <!-- </div> -->
                            </div>

                        </div>
                    </form>
                </div>

                <!-- Modal footer -->
                <!-- <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div> -->

            </div>
        </div>
    </div>


<!-- The Modal -->
<div class="modal" id="actionAddMember-nav" style="margin-top: 100px;">
  <div class="modal-dialog model-sm">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <h4 class="modal-title text-muted" style="margin-top: 5px;">Add a group member</h4>
      <!-- Modal body -->
      <div class="modal-body">
        <form method="post" action="../group/add-member">
        <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
        <input type="hidden" name="groupID" value="<?= $details->GROUP_ID ?>"/>
            <div class="form-group">
                <div class="row">
                    <div class="form-group required col-lg-10" style="margin: auto;">
                        <label for="phonenumber" style="margin-top: 20px;">Enter member phone number:</label>
                        <input type="number" name="mnumber" id="mnumber" maxlength = "12" class="form-control" placeholder="Enter mobile number" required>
                    </div>
                </div>

<!--                <div class="row">-->
<!--                    <div class="form-group col-lg-10" style="margin: auto;">-->
<!--                        <label for="member-role" style="margin-top: 20px;">Please select member's role:</label>-->
<!--                        <select class="form-control" id="member-role" name="member-role">-->
<!--                            <option>Select member role</option>-->
<!--                            <option>Signatory</option>-->
<!--                            <option>Member</option>-->
<!--                        </select>-->
<!--                    </div>-->
<!--                </div>-->

                <div class="row">
                    <!-- <div class="form-group col-lg-10" style="margin: auto; margin-top: 20px;"> -->
                        <button class="btn btn-primary" id="invite-member">Send Invite</button>
                    <!-- </div> -->
                </div>

            </div>
        </form>
      </div>

      <!-- Modal footer -->
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div> -->

    </div>
  </div>
</div>

<!-- The add signatory Modal -->
<div class="modal" id="actionAddSignatory" style="margin-top: 100px;">
  <div class="modal-dialog model-sm">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <h4 class="modal-title text-muted text-center col-lg-12" style="margin-top: 5px;">Add Signatory</h4>

      <!-- Modal body -->
      <div class="modal-body">
        <form method="post" action="../group/add-signatory">
        <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
        <input type="hidden" name="groupID" value="<?= $details->GROUP_ID ?>"/>
            <div class="form-group">
                <div class="row">
                    <div class="form-group required col-lg-10" style="margin: auto;">
                        <label for="phonenumber" style="margin-top: 20px;">Enter member phone number:</label>
                        <input type="number" name="mnumber" id="s-mnumber" class="form-control" placeholder="Enter mobile number" maxlength="12" required>
                    </div>
                </div>

                <div class="row"> 
                    <button class="btn btn-primary" id="add-signatory-btn">Send Invite</button>
                </div>

            </div>
        </form>
      </div>

      <!-- Modal footer -->
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div> -->

    </div>
  </div>
</div>



<!-- The add signatory Modal -->
<div class="modal" id="actionVerification-a" style="margin-top: 10px;">
  <div class="modal-dialog model-sm">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
       <h4 class="modal-title text-muted text-center col-lg-12">Verification Required</h4>

      <!-- Modal body -->
      <div class="modal-body">
         <p class="container text-muted" style="text-align: center;">For extra security, enter your phone and ID number,<br> Before allowing access to group wallet information, we<br> will send a unique code to this phone to verify your<br> identity.</p>
        <form id="request-withdraw-form" method="post" action="../group/request-withdraw"></form>
        <input form="request-withdraw-form" type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
        <input type="hidden" name="groupID" value="<?= $details->GROUP_ID ?>"/>
            <div class="form-group">
                <div class="row">
                    <div class="form-group col-lg-11" style="margin: auto;">
                        <label for="phonenumber" style="margin-top: 20px;">What's your mobile number?</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text" style="background: white;">+254</span>
                            </div>
                            <input type="text" name="mnumber-w" id="mnumber-w" class="form-control" value="<?= substr($_SESSION['phoneNumber'], -9) ?>" readonly required style="background: white;">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group required col-lg-11" style="margin: auto;">
                        <label for="phonenumber" style="margin-top: 20px;">ID/Passport number</label>
                        <input type="text" name="userid-w" id="userid-w" class="form-control" placeholder="Enter your ID/Passport number" maxlength ="12" required>
                    </div>
                </div>

                <div class="row"> 
                    <button form="request-withdraw-form" name="request-withdraw-btn" class="btn btn-primary" id="Withdraw-v1">Send code</button>

                     <button style="display: none;" data-toggle="modal" data-target="#actionVerification-b" id="activateActionVerification-b" class="<?php if(Yii::$app->session->get('activate-vb') == 'true') echo 'isActivated'; if(Yii::$app->session->get('activate-vb') == 'false') echo 'isInactive';?>"></button>

                </div>

            </div>
        <!-- </form> -->
      </div>

      <!-- Modal footer -->
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div> -->

    </div>
  </div>
</div>


<!-- The add signatory Modal -->
<div class="modal" id="actionVerification-b" style="margin-top: 10px;">
  <div class="modal-dialog model-sm">
    <div class="modal-content">


     <form id="verify-withdraw-form" method="post" action="../group/verify-withdraw"></form>
        <input form="verify-withdraw-form" type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>"/>
      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <h4 class="modal-title text-muted text-center">Check Your Phone</h4>

      <!-- Modal body -->
      <div class="modal-body">
         <p class="container text-muted" style="text-align: center;">A unique code has been sent to your phone number<br>ending with <?= substr($_SESSION['phoneNumber'], -4) ?>.</p>
         <p class="text-center container" style="margin-top: 50px;"><a href="#" data-toggle="modal" data-target="#actionVerification-a" data-dismiss="modal" id="change-no-btn" style="text-decoration: none;">Need to change the ID number?</a></p>
        <!-- <form method="post" action="../group/add-member"> -->
        <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
        <input type="hidden" name="groupID" value="<?= $details->GROUP_ID ?>"/>
            <div class="form-group">
                <div class="row">
                    <div class="form-group required col-lg-11" style="margin: auto;">
                        <label for="phonenumber" style="margin-top: 20px;">Enter verification code</label>
                        <input form="verify-withdraw-form" type="text" name="vcode-w" id="vcode-w" class="form-control" placeholder="Verification code" required>
                    </div>
                </div>

                <div class="container">
                    <p style="margin-top: 30px; padding-left: 5px;">Didn't receive a code? <span id="resend-withdraw-vcode-btn">Click here to resend</span></p>
                </div>

                <div class="row"> 
                    <button form="verify-withdraw-form" name="verify-withdraw-btn" class="btn btn-primary verify-btn" style="margin: auto; margin-top: 20px; height: 50px; width: 85%; margin-bottom: 30px;" id="Withdraw-vf2">Verify</button>
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
<script src="../js/watchDog.js"></script>


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
                    $('#set-balance2').text(data);

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












