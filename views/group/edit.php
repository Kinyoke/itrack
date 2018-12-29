<?php

use  yii\web\View;
use  yii\helpers\Url;

$this->title = "Edit ".$details->GROUP_NAME;

?>

<style type="text/css">
  body{ background-color: rgb(250,250,250); }
  .edit-pane{ display: inline; }
  .edit-pane label{ margin-top: 20px; }
  .radi0{ display: inline; clear: both; }

#image-banner{ width: 100%; height: 110px;  }

#image-banner #edit-back-alt img {
  position: absolute;
  /*content: '';*/
  z-index: -1;
  width: 100%;
  margin-top: -390px;
  /*margin-left: -100px;*/
  /*height: 150px;*/
  /*background-image: url('../images/2.jpg');*/
  /*background-repeat: no-repeat;*/
  /*background-size: contain;*/
}


.edit-content-pane{ background-color: #FFFFFF; width: 100%; padding: 0; margin: 0; }
/*.card-title{ margin-left: 3%; }*/
/*.card-text{ margin-left: 4%; }*/
.edit-delete-btn{ height: 50px; width: 50px; background-color: #E80033; border-radius: 100%; line-height: 50px; text-align: center; color: white; box-shadow: 0px 2px 2px 0px #E80033; right: 0; top: 0; position: absolute; margin-top: -75px; margin-right: 10px; opacity: 0.7;}
.edit-delete-btn:hover{ cursor: pointer; }
/*.edit-delete-btn-mobile{ display: none; }*/
#edit-back-alt{ left: 0; margin-top: 20px;}
#edit-back-alt .fa-camera, .fa-chevron-left{ color: white; font-size: 25px; }
#edit-back-alt p{ color: white; margin-top: 45px;}
#edit-back-alt .fa-camera:hover, p:hover{ cursor: pointer; }
#updt-cv-photo{ width: 35px; height: 35px; line-height: 45px; text-align: center; border-style: none; border-radius: 10px; background-color: transparent; opacity: 0.8; color: white; transition: .5s;}

</style>

<?= $this->render('../layouts/sidenav'); ?>

<!--<div class="tuggle-nav"></div>-->


<div id="image-banner" style="margin-top: 70px;">
  
  <!-- Display uploaded group img -->
  <div id="edit-back-alt" style="display: none; cursor: pointer;">
    
    <input id="cover-photo-upload" class="hidden" type="file" style="display:none" accept="image/*"/>
        
    <img id = "img-cover-photo">
    
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


<div class="edit-content-pane section">

  <!-- <div class="container"> -->
  
  <div class="card text-center">

  <div class="card-body container">
    <div class="row container">
      <h3 class="card-title font-semibold">Edit fundraiser</h3>
    </div>
    <div class="row container">
      <p class="card-text text-muted"><?= $details->GROUP_NAME ?></p>
    </div>
  </div>

  <div class="card-header container">
    <ul class="nav nav-tabs card-header-tabs">
      <!-- <li class="nav-item">
        <a class="nav-link" href="#" style="width: 110px;"></a>
      </li> -->
      <li class="nav-item edit-overview">
        <a class="nav-link" href="#" style="border-style: none; border-bottom: 3PX solid #00B3FF;">Overview</a>
      </li>
    </ul>
  </div>


</div>

<!-- </div> -->




<div class="container edit-group-form" style="margin-top: 60px; margin-bottom: 100px;">
  <div class="row">
    <div class="col-lg-12">
      <div class="card col-lg-12">

          <!-- <img class="card-img-top" src=".../100px180/" alt="Card image cap"> -->
          <div class="card-body" style="margin-top: 30px;">

            <form action="../group/update" method="post">
            <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
            <input type="hidden" name="groupID" id="profile-group-id" value="<?=$details->GROUP_ID?>"/>
            <div class="row">
              

              <div class="col-lg-6 edit-pane">

                <div class="edit-delete-btn edit-delete-btn-mobile" data-toggle="model" data-target="#actionDelGrp">
                  <i class="fa fa-trash-alt"></i>
                </div>


              <div class="form-group required">
                <label for="group-name-edit">Fundraiser name</label>
                <input type="text" name="edit-name" class="form-control" id="edit-name" value="<?= $details->GROUP_NAME ?>" maxlength = "30" required>
              </div>
              <div class="form-group">
                <label for="edit-desc">Fundraiser description</label>
                <textarea class="form-control" rows="5" name="edit-desc" id="edit-desc" maxlength = "1000" style="resize: none;" ><?= $details->GROUP_DESCRIPTION ?></textarea>
              </div>
            </div>

            <div class="col-lg-6 edit-pane">
                
                <div class="edit-delete-btn" data-toggle="modal" data-target="#actionDelGrp">
                  <i class="fa fa-trash-alt"></i>
                </div>
                <div class="form-group required">
                  <label for="edit-amount">Enter target amount</label>
                  <input type="number" name="edit-amount" id="edit-amount" class="form-control" value="<?= $details->AMOUNT ?>" maxlength = "12" required>
                </div>
            
            
                <div class="form-group">
                  <label for="edit-timeline">End date</label>
                    <input type="text" name="edit-timeline" id="datepicker" class="form-control" value="<?= date('m/d/Y',strtotime($details->GROUP_DUE_DATE)) ?>">
                </div>
              
              
                <label>Group type</label>

                <div style="height: 40px;">
                  <!-- <div class="radi0"> -->
                  <label class="edit-g-type edit-g-type-left"><input type="radio" name="optradio" id="optradio" value="invite">  Invite only</label>
              <!-- </div> -->
      
              <!-- <div class="radio"> -->
                  <label class="edit-g-type edit-g-type-right"><input type="radio" name="optradio" id="optradio" value="open" checked> Open to all</label>
              <!-- </div> -->

                </div>
            </div>


            </div>

            
            
            <div class="row" style="margin-top: 20px; margin-bottom: 30px;">
              <!-- <div class="col-lg-3"> -->
                <!-- <div class="form-group"> -->
                  <button class="btn btn-primary edit-save-btn">Save changes</button>
                <!-- </div> -->
              <!-- </div> -->
              <!-- <div class="col-lg-6"> -->
                <a href="../group/view" class="btn btn-primary edit-cancel-btn">Cancel</a>
              <!-- </div> -->

            </div>
            </form>
          </div>
      </div>    
    </div>
  </div>
</div>


</div>


<!-- The share Modal -->
<div class="modal" id="actionDelGrp">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="delete-group-form" action="../group/delete" method="post"></form>
      <input form="delete-group-form" type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken;?>"/>
      <!-- Modal Header -->
      <div class="modal-header" style="border-style: none;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <h4 class="modal-title col-lg-12" style="text-align: center; padding-bottom: 25px; border-bottom: 1px solid lightgray;">Delete <?= $details->GROUP_NAME; ?> group! </h4>

      <!-- Modal body -->
      <div class="modal-body text-center">
        <div class="share-group-list">
            <p>Are you sure you want to delete this group?</p>
            <p><span class="text-muted">Note:</span><br>By doing so, all information related to this group will be permenently deleted.</p>
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button class="btn btn-danger btn-block" name="delete-group-btn" id="delete-group-btn" form="delete-group-form">Continue</button>
      </div>

    </div>
  </div>
</div>