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

<!doctype html>
<html lang="en">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>Login</title>

    <!-- Bootstrap 4 CDN -->
    <link rel="stylesheet" href="../../vendors/bootstrap4/css/bootstrap.min.css">

    <!-- FontAwesome Font -->
    <link rel="stylesheet" href="../../vendors/fontawesome-free-5.4.2-web/css/all.css">

    <!-- Theme -->
    <meta name="theme-color" content="#007AFF">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="../../images/favicon.ico">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../../css/admin.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,800" rel="stylesheet">

</head>

<body class="text-center bg-light">
<div class="container">
    <div class="col-lg-6 mx-auto">
        <div class="card card-border-blue" style="margin-top: 50px;">
            <div class="card-body">
                <form class="form-signin" method="post" action="/admin/default/login">
                    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
                    <img class="m-4" src="../../images/Mula_Logo.png" alt="" width="auto" height="50">
                    <h4 class="h4 mb-3 font-weight-normal text-muted">Please sign in</h4>
                    <label for="inputEmail" class="sr-only">Email address</label>
                    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                    <label for="inputPassword" class="sr-only">Password</label>
                    <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
<!--                    <div class="checkbox mb-3">-->
<!--                        <label>-->
<!--                            <input name="remember-me" type="checkbox" value="remember-me"> Remember me-->
<!--                        </label>-->
<!--                    </div>-->
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                    <p class="mt-5 mb-3 text-muted">&copy; Copyright <?php echo date("Y"); ?> Cellulant Corporation. All Rights Reserved</p>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
