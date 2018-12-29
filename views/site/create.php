<?php

$this->title = 'itrack | create account';
?>

<style type="text/css">
    body{
        background-color: rgb( 40, 40 , 40);
    }
    /*body{ overflow: hidden; }*/
    /*.navbar{ z-index: 30; background-color: transparent; }*/
    .progress-tracker{ margin-top: 20px; }
    #progress-line-pane{ height: 11px; width: 90%; background-color: rgb(80,80, 80); border-radius: 10px; margin-top: 45px; position: absolute; margin-left: 2.5%; z-index: -5; }
    #progress-line-prog{ height: 5px; width: 0%; margin-top: 1px; border-radius: 10px; background-color: #007AFF; transition: 1.8s; }
    #progress-item-pane{
        height: 100px; width: 100%; line-height: 100px;
    }

    /*.circle{ height: 60px; width: 60px; border-radius: 100%; background-color: rgb(40, 40, 40); border: 6px solid rgb(80, 80, 80); float: left; display: inline-block; text-align: center; color: gray; line-height: 50px; font-size: 25px; z-index: 10; margin-top: 20px;}
*/
    #c2{ margin-left: 33%; }
    #c3{ float: right; }

    .step-pane{ display: none; }

    #step-pane-active{ display: block; }



    .progress{
    width: 60px;
    height: 60px;
    line-height: 50px;
    background: none;
    margin: 0 auto;
    box-shadow: none;
    position: relative;

    float: left; display: inline-block; text-align: center; color: gray; line-height: 50px; font-size: 25px; z-index: 10; margin-top: 20px;
    transform: rotate(-85deg);
}
.progress:after{
    content: "";
    width: 100%;
    height: 100%;
    border-radius: 50%;
    border: 6px solid rgb(80, 80, 80);
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
    border-width: 6px;
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

.progress.blue-1 .progress-right .progress-bar{
    left: -100%;
    border-top-left-radius: 80px;
    border-bottom-left-radius: 80px;
    border-right: 0;
    -webkit-transform-origin: center right;
    transform-origin: center right;
    animation: loading-1 1.8s linear forwards;
}


.progress.blue-2 .progress-right .progress-bar{
    left: -100%;
    border-top-left-radius: 80px;
    border-bottom-left-radius: 80px;
    border-right: 0;
    -webkit-transform-origin: center right;
    transform-origin: center right;
    animation: loading-0 1.8s linear forwards;
}


.progress.blue-3 .progress-right .progress-bar{
    left: -100%;
    border-top-left-radius: 80px;
    border-bottom-left-radius: 80px;
    border-right: 0;
    -webkit-transform-origin: center right;
    transform-origin: center right;
    animation: loading-0 1.8s linear forwards;
}

.progress .progress-value{
    width: 90%;
    height: 90%;
    border-radius: 50%;
    background: rgb(40, 40, 40);
    font-size: 25px;
    color: gray;
    line-height: 50px;
    text-align: center;
    position: absolute;
    top: 5%;
    left: 5%;
    transform: rotate(85deg);
}

.progress.blue-1 .progress-bar{
    border-color: #007AFF;
}
.progress.blue-1 .progress-left .progress-bar{
    animation: loading-1 1.5s linear forwards 1.8s;
}


.progress.blue-2 .progress-bar{
    border-color: #007AFF;
}
.progress.blue-2 .progress-left .progress-bar{
    animation: loading-0 1.5s linear forwards 1.8s;
}


.progress.blue-3 .progress-bar{
    border-color: #007AFF;
}
.progress.blue-3 .progress-left .progress-bar{
    animation: loading-0 1.5s linear forwards 1.8s;
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

</style>



<form method="POST" action="../group/create" id="create-group-form" novalidate></form>
<input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>"  form="create-group-form"/>

<!-- tanzania, +255
kenya, +254
rwanda, +250 
burundi, +257
Uganda, +256
ehtiopia, +251
zambia, +260

 -->

<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

<div class="">
    <div class="container col-lg-5">
        
        <div class="progress-tracker">
            <div id="progress-item-pane">
                <div id="progress-line-pane">
                    <div id="progress-line-prog"></div>
                </div>

                <!-- <div class="col-md-3 col-sm-6"> -->
                    <div class="progress blue blue-1" id="c1">
                        <span class="progress-left">
                            <span class="progress-bar"></span>
                        </span>
                        <span class="progress-right">
                            <span class="progress-bar"></span>
                        </span>
                        <div class="progress-value">1</div>
                    </div>
                <!-- </div> -->

                <div class="progress blue blue-2" id="c2">
                        <span class="progress-left">
                            <span class="progress-bar"></span>
                        </span>
                        <span class="progress-right">
                            <span class="progress-bar"></span>
                        </span>
                        <div class="progress-value">2</div>
                    </div>

                    <div class="progress blue blue-3" id="c3">
                        <span class="progress-left">
                            <span class="progress-bar"></span>
                        </span>
                        <span class="progress-right">
                            <span class="progress-bar"></span>
                        </span>
                        <div class="progress-value">3</div>
                    </div>

            </div>
        </div>

        <form id="form-login" method="post" action="../site/login"></form>
        <input form="form-login" type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />

        <div class="row step-pane" id="step-pane-active">

            <div class="container col-lg-12">
                
                <h3 style="color: gray; text-align: center; padding: 20px 20px;">Personal info</h3>
                
                <div class="form-group">
                    <label for="mnumber" style="color: gray;">Enter full name:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="border-color: rgb(60, 60, 60); background: rgb(60, 60, 60);"><i class="fa fa-user" style="color: gray;"></i></span>
                        </div>
                        <input type="text" name="phoneNumber" id="mnumber" class="form-control l-form-input" form="form-login" autocomplete="off" style="background-color: rgb(60, 60, 60); border-color: rgb(60, 60, 60); color: lightgray;">
                    </div>
                </div>
                

                <div class="form-group">
                    <label for="mnumber" style="color: gray;">Enter email address:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="border-color: rgb(60, 60, 60); background: rgb(60, 60, 60);"><i class="fa fa-envelope" style="color: gray;"></i></span>
                        </div>
                        <input type="text" name="phoneNumber" id="mnumber" class="form-control l-form-input" form="form-login" autocomplete="off" style="background-color: rgb(60, 60, 60); border-color: rgb(60, 60, 60); color: lightgray;">
                    </div>
                </div>

                <div class="form-group">
                    <label for="mnumber" style="color: gray;">Enter mobile number:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="border-color: rgb(60, 60, 60); background: rgb(60, 60, 60);"><i class="fa fa-phone" style="color: gray;"></i></span>
                        </div>
                        <input type="text" name="phoneNumber" id="mnumber" class="form-control l-form-input" form="form-login" autocomplete="off" style="background-color: rgb(60, 60, 60); border-color: rgb(60, 60, 60); color: lightgray;">
                    </div>
                </div>
                

                <div class="form-group">
                    <button class="btn btn-primary btn-md blue-btn next-btn my-4" id="login-btn">Next step</button>
                </div>
                    

            </div>
        
        </div>


         <div class="row step-pane">

            <div class="container col-lg-12">
                
                <h3 style="color: gray; text-align: center; padding: 20px 20px;">Company details</h3>

                <div class="form-group">
                    <label for="mnumber" style="color: gray;">Enter company name:</label>
                    <!-- <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="border-color: rgb(60, 60, 60); background: rgb(60, 60, 60);"><i class="fa fa-user" style="color: gray;"></i></span>
                        </div> -->
                        <input type="text" name="phoneNumber" id="mnumber" class="form-control l-form-input" form="form-login" autocomplete="off" style="background-color: rgb(60, 60, 60); border-color: rgb(60, 60, 60); color: lightgray;">
                    <!-- </div> -->
                </div>
                

                <div class="form-group">
                    <label for="mnumber" style="color: gray;">Select category or industry:</label>
                    <!-- <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="border-color: rgb(60, 60, 60); background: rgb(60, 60, 60);"><i class="fa fa-envelope" style="color: gray;"></i></span>
                        </div> -->
                       <!--  <input type="text" name="phoneNumber" id="mnumber" class="form-control l-form-input" form="form-login" autocomplete="off" style="background-color: rgb(60, 60, 60); border-color: rgb(60, 60, 60); color: lightgray;"> -->
                        <select class="form-control l-form-input" style="background-color: rgb(60, 60, 60); border-color: rgb(60, 60, 60); color: lightgray;">
                            <option>Manufacturing & processing</option>
                            <option>Logistic & Transportation</option>
                            <option>IT & Telecomunication</option>
                            <option>Agriculture</option>
                        </select>
                    <!-- </div> -->
                </div>

                <div class="form-group">
                    <label for="mnumber" style="color: gray;">Select country:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="border-color: rgb(60, 60, 60); background: rgb(60, 60, 60);"><img src="../../web/images/tanzania-s-flag.gif"></span>
                        </div>
                        <select name="phoneNumber" id="mnumber" class="form-control l-form-input" form="form-login" autocomplete="off" style="background-color: rgb(60, 60, 60); border-color: rgb(60, 60, 60); color: lightgray;">
                            <option>Tanzania</option>
                            <option>Kenya</option>
                            <option>Uganda</option>
                            <option>Rwanda</option>
                            <option>Burundi</option>
                            <option>Zambia</option>
                            <option>Ethiopia</option>
                        </select>
                    </div>
                </div>
                

                <div class="form-group">
                    <button class="btn btn-primary btn-md blue-btn next-btn my-4" id="login-btn">Next step</button>
                </div>
                    

            </div>
        
        </div>


         <div class="row step-pane">

            <div class="container col-lg-12">
                
                <h3>Verify account:</h3>

                <div class="form-group">
                    <label for="mnumber" style="color: gray;">Enter a code sent to your email:</label>
                    <!-- <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="border-color: rgb(60, 60, 60); background: rgb(60, 60, 60);"><i class="fa fa-user" style="color: gray;"></i></span>
                        </div> -->
                        <input type="text" name="phoneNumber" id="mnumber" class="form-control l-form-input" form="form-login" autocomplete="off" placeholder="IT-9343" style="background-color: rgb(60, 60, 60); border-color: rgb(60, 60, 60); color: lightgray;">
                    <!-- </div> -->
                </div>

                <p style="color: gray;">Did't receive anything? <span style="color: blue;">resend code</span></p>
               

                <div class="form-group">
                    <button class="btn btn-success my-4 Verify-btn" id="Verify-btn">Verify Account</button>
                </div>

            </div>
        
        </div>

    </div>
</div>



<script src="../../web/js/eventHandler.js"></script>