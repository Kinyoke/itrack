<?php

use yii\helpers\Html;

$this->title = 'My Pledges';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="group-list">
    <div class="pull-right">
        <a href="#" class="btn btn-success">Make a Pledge</a> 
    </div>

    <div class="row">
         <h4>My Pledges</h4>  
         <div class="list-group">
            <?php
            if($pledges != null)
            {
                foreach ($details->GROUP_MEMBERS as $member) {
                        if($member->GROUP_MEMBER_TYPE == 'APPROVER')
                        {
                        ?>

                        <a href="#" class=list-group-item>
                            <h4 class="list-group-item-heading">
                                <?= $member->GROUP_MEMBER_NAME ?>
                            </h4>
                            <p class="list-group-item-text">
                                <?= $member->GROUP_MEMBER_MSISDN ?>
                            </p>
                        </a>

                    <?php
                        }
                }
            }else{
                ?>

                <div class="alert alert-warning" role="alert">
                You have made no pledges
                </div>

                <?php
            }    
            
            ?>
            </div> 
    </div>
</div><!-- group-list -->
