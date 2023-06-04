<?php

use App\Model\user;
use App\Model\kavehSms;

if (!empty($_POST['mobile'])){
    require '../app/Model/users.php';
    require '../app/Model/kavehSms.php';

    $users_obj = new user();
    $sms_obj = new kavehSms();
    $mobile = $_POST['mobile'];
    $sms_obj->reset_password($mobile);
//    echo '<br>'.$uniqCode;
//    echo  strlen($mobile);
    $find = $users_obj->findByMobile($mobile);
//    var_dump($find);
}
?>

<?php
require_once 'section/header.php';
if (isset($_COOKIE['TF-Mobile'])){
    echo '<script>  window.location.replace("/user/index.php?c=index&a=index"); </script>';
}
if (isset($_POST['forgetPassword_btn'])){
    echo 'hi';
}
?>
<link rel="stylesheet" href="../admin/assets/css/login.css">
<style>
    body,html,main{
        background-color: white!important;
    }
</style>
<main>
    <div class="container-fluid text-center shadow">
        <div class="row shadow">
            <div class="col-sm-6 login-section-wrapper bg-white shadow">
                <div class="brand-wrapper">
                    <img src="/storage/tootfarangeeplus.png" alt="Tootfrangee Clinic logo" class="logo" >
                </div>
                <div class="login-wrapper my-auto">
                    <!--                        <h1 class="login-title">ورود</h1>-->
                    <form id="restPasswordForm" action="/user/change_password.php" method="post" enctype="multipart/form-data" class="w-100">
                        <div class="form-group">
                            <label for="mobile">کد فعالسازی 6 رقمی:</label>
                            <input oninput="checkUniqueCode()" type="text" name="uniqidCode" id="uniqidCode" class="form-control" placeholder="X-X-X-X-X-X">
                        </div>
                        <div class="form-group mb-4">
                            <label for="password">رمز عبور جدید :</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="******">
                        </div>
                        <div class="form-group mb-4">
                            <label for="password">تکرار رمز عبور جدید :</label>
                            <input type="password" name="repeat_password" id="password" class="form-control" placeholder="******">
                        </div>
                        <input name="login" id="login" class="btn btn-block login-btn" type="submit" value="تغییر رمز عبور">
                    </form>
                    <a href="/user/login.php"  class="forgot-password-link">ورود</a>
                    <br>
                    <a href="signup.php" class="forgot-password-link">عضویت</a>

                </div>
            </div>
            <div class="col-sm-6 px-0 d-none d-sm-block bg-light shadow"
                 style="
                     background-image: url('/storage/usermes2.jpg');
                     background-position: center;
                     background-size: cover;

                        ">

            </div>
        </div>
    </div>
</main>
<script src="/global_assets/js/userController.js"></script>
