<?php

// use yii\helpers\Html;
use  yii\web\View;
use app\models\Group;
use app\components\Wallet;

$this->title = "My Fundraisers" ;

?>

<?= $this->render('../layouts/sidenav'); ?>

<section class="group-info bg-gray" style="margin-top: 50px;">

    <div class="">
        <div class="card cardX">
            <div class="card-body container">
                <div class="row mt-5">
                    <h3 class=" font-weight-normal my-2 container">My Fundraisers</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row my-5">
            <?php
            $i = 0;
            if($groups != 1)
            {
                foreach ($groups as $group) {
                        $i = $i+1;
                        ?>
                        <div class="col-lg-4 my-3 group">
                            <a class="card-link" href="../group/info?id=<?= $group->GROUP_ID?>">
                                <div class="card cardH">

                                    <input type="hidden" name="groupID" class="groupID" id = "discoveryPageGroupID" value="<?= $group->GROUP_ID ?>">
                                    <?php
                                    foreach($group->GROUP_ADMIN_MSISDN as $admin)
                                    {?>
                                        <input type="hidden" name="adminNo" class="adminNo" id = "discoveryPageAdminNumber" value="<?= $admin ?>">
                                   <?php
                                    break;
                                    }
                                        ?>
                                    <input type="hidden" name="groupAmount" class="groupAmount" id = "groupTargetAmount" value="<?= $group->AMOUNT ?>">

                                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel" style="width: 100%; height: 235px; display: none;">

                                        <div class="carousel-inner" id="mainSlider">
                                        </div>

                                    </div>

                                    <div align="center" style="background: #f5f5f5; width: 100%; height: 235px" id= "defaultImage">

                                <input id="profile-image-upload" class="hidden" type="file" style="display:none" accept="image/*"/>
                                <img class="card-img-top" src="../images/Placeholder.png" style="height:100px; width: 100px; margin-top: 20%">

                                    </div>

                                    <div class="card-body" style="height: 110px;">
                                        <h5 class="card-title font-semibold">
                                            <?=  substr($group->GROUP_NAME, 0, 40) ?>
                                        </h5>
                                        <p class="card-text text-muted">
                                            <?php
                                            if(strlen($group->GROUP_DESCRIPTION) > 70) {
                                                echo substr($group->GROUP_DESCRIPTION, 0, 70).'...';
                                            }else{
                                                echo $group->GROUP_DESCRIPTION;
                                            }
                                            ?>
                                        </p>
                                    </div>
                                    <div class="card-body py-0">
                                        <div class="progress my-1" style="height: 7px;">
                                            <div class="progress-bar" id = "group-progress-bar" role="progressbar" style="transition: 5s;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <p style="font-size:small;">
                                        <span class="font-semibold wallet-balance" id = "group-wallet-balance">
                                            <!-- Populated with ajax -->
                                            KES <i class='fa fa-circle-notch fa-spin text-muted' id="spinner"></i>
                                        </span>
                                            <span class="text-muted font-thin"> of KES <?= $group->AMOUNT ?> Goal</span>
                                        </p>
                                    </div>
                                    <div class="card-footer" style="display: block">
                                        <p class="card-text inline-item"><small class="text-muted">
                                                <?php
                                                $earlier = new \DateTime();
                                                $later = new \DateTime($group->GROUP_DATE_CREATED);
                                                $diff = $later->diff($earlier)->format("%a");
                                                echo $diff;
                                                ?>
                                                days ago
                                            </small></p>
                                        <i class="fa fa-arrow-right inline-item float-right p-2"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
            }else{
                ?>
                <div class="jumbotron jumbotron-fluid text-center mx-auto" style="height: 200px;">
                    <div class="py-5">
                        <h2 class="lead" style="color: #dc3545">A problem occurred trying to fetch your fundraisers</h2>
                    </div>
                </div>
                <?php
            }
            ?>
            <div class="col-lg-4 my-3">
                <div class="card" id="copy">
                    <div class="card-body dotted-border d-flex  text-center">
                        <div class="mx-auto my-auto">
                            <a href="../group/create" class="linkX">
                            <button type="button" class="btn btn-outline-primary btn-circle blue-btn"><i class="fa fa-plus"></i></button>
                            </a>
                            <h4 class="my-2">Start a Fundraiser</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= $this->render('../layouts/footer') ?>
</section>

<!-- Add extra scripts -->
<?php $this->beginBlock('scripts'); ?>
<script>
    $(document).ready(function() {
        if( $('.cardH').length)
        {
            var x = $('.cardH').height();
            $('#copy').css('height', x);
        }else{
            $('#copy').css('height', '450px');
        }

    });
</script>
<?php $this->endBlock(); ?>
