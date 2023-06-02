
<?php
require_once 'section/header.php';
if (isset($_COOKIE['TF-Mobile'])){
    echo '<script>  window.location.replace("/user/index.php?c=index&a=index"); </script>';
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
                    <form action="index.php?c=users&a=login" method="post" enctype="multipart/form-data" class="w-100">
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
                    <a href="/user/forget_password.php" class="forgot-password-link">فراموشی رمز عبور</a>
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