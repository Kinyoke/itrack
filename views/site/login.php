<?php

use yii\helpers\Html;

$this->title = 'itrack | Log In';
?>

<!--Hide Navbar -->
<?php $this->beginBlock('navbar'); ?>
d-none
<?php $this->endBlock(); ?>

<style type="text/css">
    body{
        background-color: rgb( 40, 40 , 40);
    }

    #line-left-l{ width: 8%; height: 1px; background-color: gray; display: inline; float: left; margin-top: 13px;}

    #line-right-l{ width: 70%; height: 1px; background-color: gray; display: inline; float: right; margin-top: 13px; }


   /* .progress{
    width: 150px;
    height: 150px;
    line-height: 150px;
    background: none;
    margin: 0 auto;
    box-shadow: none;
    position: relative;
}
.progress:after{
    content: "";
    width: 100%;
    height: 100%;
    border-radius: 50%;
    border: 12px solid #fff;
    position: absolute;
    top: 0;
    left: 0;
}
.progress > span{
    width: 50%;
    height: 100%;
    overflow: hidden;
    position: absolute;
    top: 0;
    z-index: 1;
}
.progress .progress-left{
    left: 0;
}
.progress .progress-bar{
    width: 100%;
    height: 100%;
    background: none;
    border-width: 12px;
    border-style: solid;
    position: absolute;
    top: 0;
}
.progress .progress-left .progress-bar{
    left: 100%;
    border-top-right-radius: 80px;
    border-bottom-right-radius: 80px;
    border-left: 0;
    -webkit-transform-origin: center left;
    transform-origin: center left;
}
.progress .progress-right{
    right: 0;
}
.progress .progress-right .progress-bar{
    left: -100%;
    border-top-left-radius: 80px;
    border-bottom-left-radius: 80px;
    border-right: 0;
    -webkit-transform-origin: center right;
    transform-origin: center right;
    animation: loading-1 1.8s linear forwards;
}
.progress .progress-value{
    width: 90%;
    height: 90%;
    border-radius: 50%;
    background: #44484b;
    font-size: 24px;
    color: #fff;
    line-height: 135px;
    text-align: center;
    position: absolute;
    top: 5%;
    left: 5%;
}
.progress.blue .progress-bar{
    border-color: #049dff;
}
.progress.blue .progress-left .progress-bar{
    animation: loading-2 1.5s linear forwards 1.8s;
}
.progress.yellow .progress-bar{
    border-color: #fdba04;
}
.progress.yellow .progress-left .progress-bar{
    animation: loading-1 1s linear forwards 1.8s;
}
.progress.pink .progress-bar{
    border-color: #ed687c;
}
.progress.pink .progress-left .progress-bar{
    animation: loading-4 0.4s linear forwards 1.8s;
}
.progress.green .progress-bar{
    border-color: #1abc9c;
}
.progress.green .progress-left .progress-bar{
    animation: loading-5 1.2s linear forwards 1.8s;
}
@keyframes loading-1{
    0%{
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100%{
        -webkit-transform: rotate(180deg);
        transform: rotate(180deg);
    }
}
@keyframes loading-2{
    0%{
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100%{
        -webkit-transform: rotate(144deg);
        transform: rotate(144deg);
    }
}
@keyframes loading-3{
    0%{
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100%{
        -webkit-transform: rotate(90deg);
        transform: rotate(90deg);
    }
}
@keyframes loading-4{
    0%{
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100%{
        -webkit-transform: rotate(36deg);
        transform: rotate(36deg);
    }
}
@keyframes loading-5{
    0%{
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100%{
        -webkit-transform: rotate(126deg);
        transform: rotate(126deg);
    }
}
@media only screen and (max-width: 990px){
    .progress{ margin-bottom: 20px; }
}
*/

</style>

<!-- Content Section -->
<!-- <section class="section site-login container" style="margin-top: 100px;"> -->


    <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<!-- <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
<!------ Include the above in your HEAD tag ---------->

<!-- <div class="container">
    <div class="row">
        <div class="col-md-3 col-sm-6">
            <div class="progress blue">
                <span class="progress-left">
                    <span class="progress-bar"></span>
                </span>
                <span class="progress-right">
                    <span class="progress-bar"></span>
                </span>
                <div class="progress-value">90%</div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="progress yellow">
                <span class="progress-left">
                    <span class="progress-bar"></span>
                </span>
                <span class="progress-right">
                    <span class="progress-bar"></span>
                </span>
                <div class="progress-value">75%</div>
            </div>
        </div>
    </div>
</div>
 -->


    <div class="" style="margin-top: 150px;">

        <div class="container col-lg-5">

            <div style="padding-bottom: 10px;">
                            
                <div id="line-left-l"></div>
                <h4 style="color: gray; margin-left: 4%; display: inline; float: left;">i track</h4>
                <div id="line-right-l"></div>

            </div>
                        
            <hr class="my-4">
            <!-- <p class="lead text-muted p-0">Please enter your phone number to log in (required).</p> -->
            <form id="form-login" method="post" action="../site/login"></form>
            <input form="form-login" type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />

            <div class="form-group">
                
                <label for="mnumber" style="color: gray;">User name:</label>
                                
                <div class="input-group">
                                    
                    <div class="input-group-prepend">
                            
                        <span class="input-group-text" style="border-color: rgb(60, 60, 60); background: rgb(60, 60, 60);"><i class="fa fa-user" style="color: gray;"></i></span>
                    </div>
                        
                    <input type="text" name="phoneNumber" id="mnumber" class="form-control l-form-input" form="form-login" autocomplete="off" style="background-color: rgb(60, 60, 60); border-color: rgb(60, 60, 60); color: lightgray;">
                
                </div>
                            
            </div>
                    

            <div class="form-group">
                                
                <label for="mnumber" style="color: gray;">Password:</label>
                                
                <div class="input-group">
                                    
                    <div class="input-group-prepend">
                                      
                        <span class="input-group-text" style="background: rgb(60, 60, 60); border-color: rgb(60, 60, 60);"><i class="fa fa-eye-slash" style="color: gray;"></i></span>
                    
                    </div>
                    
                    <input type="password" name="phoneNumber" id="mnumber" class="form-control l-form-input" form="form-login" autocomplete="off" style="background-color: rgb(60, 60, 60); border-color: rgb(60, 60, 60); color: lightgray;">
                
                </div>
                            
            </div>

            
            <div class="form-check-inline">
                
                <label class="form-check-label" for="public-group">
                
                    <input type="checkbox" name="group-type" id="public-group" class="form-check-input" value="open" form="create-group-form" required>
                                    Remember me!
                </label>
                            
            </div>

            
            <div class="form-group">
                
                <button class="btn btn-primary btn-md blue-btn next-btn my-4" id="login-btn">Continue</button>
            
            </div>
                    
        </div>
    
    </div>
            
<!-- </section> -->


<?php $this->beginBlock('scripts'); ?>

<?php $this->endBlock();