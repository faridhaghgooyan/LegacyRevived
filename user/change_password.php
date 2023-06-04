<?php
use App\Model\user;
require '../app/Model/users.php';

$users_obj = new user();
$uniqueCode = $_POST['uniqidCode'];
$uniqueCodeHash = md5($_POST['uniqidCode']);

$mobile = $users_obj->findByPasswordToken($uniqueCodeHash)['mobile'];
$pass = sha1($_POST['password']);

if (!empty($_POST['uniqidCode']) && $_POST['password'] === $_POST['repeat_password'] && $mobile){
    require_once 'section/header.php';



    $user_id = $users_obj->findByMobile($mobile)['id'];

    $users_obj->changePass($pass,$user_id);
    header('location:/user/login.php');
} else {
    header('location:/user/login.php');
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
                    <form id="loginForm" action="index.php?c=users&a=login" method="post" enctype="multipart/form-data" class="w-100">
                        <div class="form-group">
                            <label for="mobile">شماره همراه :</label>
                            <input type="mobile" name="mobile" id="email" class="form-control" placeholder="0912XXXXXXXX">
                        </div>
                        <div class="form-group mb-4">
                            <label for="password">رمز عبور :</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="******">
                        </div>
                        <input name="login" id="login" class="btn btn-block login-btn" type="submit" value="ورود">
                    </form>
                    <form id="forgetPasswordForm" action="/user/reset_password.php" method="post" enctype="multipart/form-data" class="w-100">
                        <div class="form-group">
                            <label for="mobile">شماره همراه :</label>
                            <input type="mobile" name="mobile" id="email" class="form-control" placeholder="0912XXXXXXXX" min="11" max="11">
                        </div>

                        <input  class="btn btn-block login-btn" type="submit" value="ارسال کد فراموشی">
                    </form>
                    <a href="#!" onclick="forget_password()" class="forgot-password-link">فراموشی رمز عبور</a>
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
<!--<script src="/global_assets/js/userController.js"></script>-->
