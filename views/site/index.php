<?php

$this->title = 'Mula Fundraising';
?>

<style type="text/css">
    #parent {
      position: relative;
      top: 0;
      left: 0;
    }
    #image1 {
        position: relative;
        top: 0;
        left: 0;
    }
    #image2 {
        position: absolute;
        top: 30px;
        left: -10px;
        max-width: 100% !important;
        height: auto;
        width: auto;
    }
</style>

<?= $this->render('../layouts/nav'); ?>

<header class="site-index" style="display: block; margin-top: 60px;">

<!--    <div class="col-lg-6 p-0 pb-4 inline-item mobile-cover" id="parent">-->
<!--        <img id = "image1" src="../images/back.png" alt="" style="width: 100%; margin-top: 50px;">-->
<!--        <img id = "image2" src="../images/ARTWORK.png" alt="" style="width: 100%; margin-top: 50px;">-->
<!--    </div>-->

    <div class="container">
        <div class="col-lg-6 inline-item">
            <div class="jumbotron jumbotron-fluid my-auto">
                <div class="welcome-text pt-lg-5">
                    <p class="big-text font-light">Mula fundraising: Fundraising that actually works.</p>
                    <p class="text-muted">Are you looking to raise funds for investment, charity, education, medical bill or the next trip with family and friends?
                        <br><br>Sign up on Mula groups. The process is easy and secure.
                        </p>
                    <p class="lead py-2">
                        <a class="btn btn-primary btn-md blue-btn" href="../group/create" role="button">Get Started</a>
                        <a class="btn btn-outline-primary btn-md blue-btn ml-3" href="#" role="button">Contact Us</a>
                    </p>
                </div>
            </div>
        </div>
    
    </div>

    <div class="col-lg-6 p-0 pb-4 inline-item" id="parent">
        <img id = "image1" src="../images/back.png" alt="" style="width: 100%; margin-top: 50px;">
        <img id = "image2" src="../images/ARTWORK.png" alt="" style="width: 100%; margin-top: 50px;">
    </div>



</header>
<!---->
<!--<div class="parallax">-->
<!--    <div class="parallax__layer parallax__layer--back">-->
<!--        <div class="title">This is the background</div>-->
<!--    </div>-->
<!--    <div class="parallax__layer parallax__layer--base">-->
<!--        <div class="title">This is the foreground</div>-->
<!--    </div>-->
<!--</div>-->

<section class="section site-index container">
    <div class="text-center titleX">
        <p class="blue">SEE OUR</p>
        <h2 class="font-light">Top Fundraisers</h2>
    </div>

    <div class="container mt-3">
            <div class="row" id="groups">
                <?php
                if(!empty($groups)) {
                    foreach ($groups as $group) {
                        ?>
                        <div class="col-lg-4 my-3 group">
                            <a class="card-link" href="../group/profile?id=<?= $group->GROUP_ID ?>&&num=<?php
                            foreach($group->GROUP_ADMIN_MSISDN as $admin)
                            {
                                echo $admin;
                                break;
                            }
                            ?>">
                                <div class="card">

                                    <input type="hidden" name="groupID" class="groupID" id="discoveryPageGroupID" value="<?= $group->GROUP_ID ?>">
                                    <?php
                                    foreach($group->GROUP_ADMIN_MSISDN as $admin)
                                    {?>
                                        <input type="hidden" name="adminNo" class="adminNo" id = "discoveryPageAdminNumber" value="<?= $admin ?>">
                                        <?php
                                        break;
                                    }
                                    ?>
                                    <input type="hidden" name="groupAmount" class="groupAmount" id="groupTargetAmount" value="<?= $group->AMOUNT ?>">

                                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel"
                                         style="width: 100%; height: 235px; display: none;">

                                        <div class="carousel-inner" id="mainSlider">
                                        </div>

                                    </div>

                                    <div align="center" style="background: #f5f5f5; width: 100%; height: 235px"
                                         id="defaultImage">

                                        <input id="profile-image-upload" class="hidden" type="file" style="display:none"
                                               accept="image/*"/>
                                        <img class="card-img-top" src="../images/Placeholder.png"
                                             style="height:100px; width: 100px; margin-top: 20%">

                                    </div>

                                    <div class="card-body" style="height: 110px;">
                                        <h5 class="card-title font-semibold">
                                            <?= substr($group->GROUP_NAME, 0, 40) ?>
                                        </h5>
                                        <p class="card-text text-muted">
                                            <?php
                                            if (strlen($group->GROUP_DESCRIPTION) > 70) {
                                                echo substr($group->GROUP_DESCRIPTION, 0, 70) . '...';
                                            } else {
                                                echo $group->GROUP_DESCRIPTION;
                                            }
                                            ?>
                                        </p>
                                    </div>
                                    <div class="card-body py-0">
                                        <div class="progress my-1" style="height: 7px;">
                                            <div class="progress-bar" id="group-progress-bar" role="progressbar"
                                                 style="transition: 5s;" aria-valuenow="50" aria-valuemin="0"
                                                 aria-valuemax="100"></div>
                                        </div>
                                        <p style="font-size:small;">
                                        <span class="font-semibold wallet-balance" id="group-wallet-balance">
                                            <!-- Populated with ajax -->
                                            KES <i class='fa fa-circle-notch fa-spin text-muted' id="spinner"></i>
                                        </span>
                                            <span class="text-muted font-thin"> of KES <?= $group->AMOUNT ?> Goal</span>
                                        </p>
                                    </div>
                                    <div class="card-footer" style="display: block">
                                        <p class="card-text inline-item">
                                            <small class="text-muted">
                                                <?php
                                                $earlier = new \DateTime();
                                                $later = new \DateTime($group->GROUP_DATE_CREATED);
                                                $diff = $later->diff($earlier)->format("%a");
                                                echo $diff;
                                                ?>
                                                days ago
                                            </small>
                                        </p>
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
                            <h2 class="lead" style="color: #dc3545"><b>Well, it seems like you have no groups available to you!</b></h2>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>

        <div class="text-center">
            <a class="btn btn-outline-primary btn-md blue-btn my-4" href="../site/discover" role="button">View more</a>
        </div>
    </div>


</section>

<section class="section site-index container">
    <div class="container mt-3">
        <div class="card-deck my-auto">

            <div class="card cardY">
                <div class="card-body text-center my-5">
                    <div class="col-lg-10 mx-auto">
                        <span class="iconY blue my-5"><img src="../images/LAUNCH.png" class="my-3" alt="" height="100"></span>
                        <h2 class="card-title my-2">Launch your next Fundraiser in minutes</h2>
                        <p class="card-text text-muted my-4">Are you looking to raise funds for investment, charity, education, medical bill or the next trip with family and friends?
                            <br><br>Sign up on Mula groups. The process is easy and secure.
                        </p>
                        <a class="btn btn-outline-primary btn-md blue-btn my-3" href="../group/create" role="button">Get Started</a>
                    </div>
                </div>
            </div>

            <div class="card cardY bg-gray">
                <div class="card-body text-center my-5">
                    <div class="col-lg-10 mx-auto">
                        <span class="iconY blue my-5"><img src="../images/CONTACT.png" class="my-3" alt="" height="100"></span>
                        <h2 class="card-title my-2">Get in touch with our experts today</h2>
                        <p class="card-text text-muted my-4">Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                             Aut nam reiciendis beatae harum dignissimos, 
                             animi perspiciatis enim obcaecati, totam ducimus natus 
                             velit dolorum explicabo et corrupti at! Minima, veniam obcaecati!</p>
                        <a class="btn btn-outline-primary btn-md blue-btn my-3" href="#" role="button">Request a Call back</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!--footer-->
<?= $this->render('../layouts/footer'); ?>