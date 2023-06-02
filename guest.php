<?php
require_once "user/section/header.php";
require_once "app/models/users.php";

?>
<?php
if (isset($_GET['link']) && !empty($_GET['link'])){
    $user_obj = new users();
    $user = $user_obj->user_info($_GET['link']);
    if ($user){
        setcookie("TF-Mobile", $user['mobile'], time()+(86400 * 30));
        header('location:/user?c=index&a=index');
    }
}


//$mobile = $_POST['mobile'];
//$pass = sha1($_POST['password']);
//$user = $users_obj->login($mobile);
//if ($user['mobile'] == $mobile && $user['password'] == $pass){
//    setcookie("TF-Mobile", $mobile, time()+(86400 * 30));
//    header('location:/user?c=index&a=index');
//} else {
//    header('location:/');
//}
?>
<?php

$chat_code = 0;
if (isset($_COOKIE['guest_code'])){
    $chat_code =  $_COOKIE['guest_code'];
} else {
    $chat_code = rand(111111,999999);
    setcookie('guest_code',$chat_code,time() + (86400 * 1) , '/');
}
?>
<!--=================== Page Styles ==========================-->
<link rel="stylesheet" href="../user/assets/css/dashboard.css">
<link rel="stylesheet" href="../user/assets/css/first.css">
<link rel="stylesheet" href="../user/assets/css/chat_box.css">
<style>
    #servicesTypes a {
        color: white!important;

    }
    #invoices_row{

    }
</style>
<!--=================== Chat Data ==========================-->
<input id="user_id" type="hidden" name="user_id" value="0">
<input id="target_user" type="hidden" name="target_user" value="admin">
<input id="roll_title" type="hidden" name="roll_title" value="user">
<input id="code" type="hidden" name="code" value="<?php echo $chat_code?>">
<!--=================== Ask For Change Password ==========================-->
<?php if (!empty($user_info->token)) : ?>
    <div class="alert alert-primary text-right" role="alert" style="font-size:0.8rem">
        پیشنهاد میشود جهت امنیت بیشتر یک رمز عبور ثابت برای خود مشخص کنید.
        <a href="?c=users&a=editPassword" class="alert-link">اینجا کلیک کنید...</a>.
    </div>
<?php endif; ?>
<!--=================== Chat Box Elements ==========================-->
<div class="container">
    <div class="row">
        <div class="col-12 ">
            <div id="" class="admin-chat">
                زیباجوی عزیز ، با درود
                چطور میتونم کمکتون کنم ؟
            </div>
            <!--Main Chat Area-->
            <div id="chatWrapper">
                <div id="welcome_message" class="admin-chat">
                    زیباجوی عزیز ، با درود
                    چطور میتونم کمکتون کنم ؟
                </div>
            </div>
            <!--Send Text Message-->
            <div class="row justify-content-between justify-content-md-center position-relative bg-white border rounded">
                <form id="chatForm" enctype="multipart/form-data" class="w-75 ">
                    <input id="message" type="text" name="message" placeholder="پیام شما" class="form-control border-0">
                    <input id="user_type" type="hidden" name="user_type" value="user">
                    <input id="message_type" type="hidden" name="message_type" value="text">
                </form>

                <div class="row justify-content-between align-items-center">

                    <!--Send Image Message-->
                    <button class="chat-send-photo">
                        <i class="fas fa-camera"></i>
                        <input type="file" name="file" onchange="send_image()">
                    </button>
                    <!--Send Voice Message-->
                    <div id="controls">
                        <button id="recordButton">
                            <i class="fas fa-microphone"></i>
                        </button>
                        <button id="pauseButton" disabled>
                            <i class="fas fa-pause"></i>
                        </button>
                        <button id="stopButton" disabled>
                            <i class="fas fa-stop"></i>
                        </button>
                    </div>
                    <!--Send Voice Message-->
                    <button onclick="send_message()" class="btn " >
                        <i class="fas fa-paper-plane bg-danger text-white  p-2 rounded-circle"></i>
                    </button>
                </div>

            </div>


        </div>
        <a href="/" class="btn secondary">ورود به حساب کاربری</a>

</div st>

<!--=================== Page Scripts ==========================-->
<script src="../global_assets/js/users/modals.js"></script>
<script src="../global_assets/js/chat/recorder.js"></script>
<script src="../global_assets/js/chat/app.js"></script>
<script src="../global_assets/js/chat/main.js"></script>
<script src="../global_assets/js/chat/chat.js"></script>
<!--./Page Custom Scripts-->
<?php require_once "user/section/footer.php"?>
