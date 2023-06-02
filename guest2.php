<?php
require_once "app/models/users.php";
$user_obj = new users();
if (!isset($_COOKIE['guest_code'])){
    setcookie('guest_code',rand(),time()+(86400 * 1));
    header('location:guest.php');
}
if (isset($_COOKIE['user_code'])){
    header('location:/user/index.php?c=index&a=index');
}
if (isset($_GET['link'])){
    $code = $_GET['link'];
    $check = $user_obj->check_link($code);
    if ($check){
        header("location:/user/index.php?c=users&a=loginByCode&code=$code");
    } else {
        echo "<script>alert('همچین کاربری یافت نشد!')</script>";
    }
}



require_once "user/section/header.php";
?>
<link rel="stylesheet" href="user/assets/css/dashboard.css">
<link rel="stylesheet" href="user/assets/css/guest.css">
<style>
    body{
        background-image: url("https://clog.tootfarangee.com/storage/chatbackground.jpg");
        background-size: 500px;
    }
    @media all and (max-width : 600px) {
        .content-wrapper{
            padding: 0!important;
        }
        #chatMainBox{
            display: block!important;
            position: fixed!important;
            margin: 0;
            top: 0!important;
            width: 100% !important;
            border-radius: 0;
        }
        #messageBar{
            display: block!important;
            position: fixed!important;
            margin: 0 auto!important;
            bottom: 10px;
            width: 100%;
        }
        #userChatForm input[type=text] {
            display: block!important;
            width: 100% !important;
        }
        #userChatForm #recordBtns {
            display: block!important;
            width: 100% !important;
        }
    }
    .fa_time{
        display: block;
        position: relative;
        width: 100px!important;
        text-align: center;
        font-size: 0.8rem;
        top: -30px;
        z-index: 11111111;
        background-color: rgba(0, 0, 0,0.8);
        color: white;
        border-radius: 10px;
        right: 5px;
        text-decoration: none;
    }
</style>

<div class="container-fluid p-0 m-0">
    <div class="row col-sm-12 col-lg-6 mb-5 text-center p-0 m-0" style="margin: 0 auto!important;padding: 0!important;">
        <div class="col-12 p-0 m-0">
            <div class="row   text-center m-0">
                <div id="chatMainBox"  class="scrollbar w-100 bg-whatsapp " style="max-height: 350px;overflow: auto;background-color: lightgrey">
                    <div  class="p-4" >
                        <div class="text-left">
                            <p class=" admin-chat-box d-inline-block">
                                جناب آقای / سرکار خانم
                                <b>
                                </b>
                                سلام،
                                <br>
                                به چه خدمتی نیاز دارید ؟
                            </p>
                        </div>
                        <div class="text-left">
                            <img src="/storage/strawberry-celebration.gif" alt="" class="user-chat-img shadow d-inline-block" width="200" >
                        </div>
                    </div>
                </div>
                <form id="chatForm" class="w-100" method="post" enctype="multipart/form-data">
                    <!-- Required Variables -->
                    <input id="user_type" type="hidden" name="user_type" class="w-100" value="guest">
                    <input id="code" type="hidden" name="code" class="w-100" value="<?php echo $_COOKIE['guest_code'];?>">
                    <input id="message_type" type="hidden" name="message_type" class="w-100" value="text">
                    <input id="user_id" type="hidden" name="user_id" class="w-100" value="<?php if (isset($loggedUser_id)){echo $loggedUser_id;} ?>">
                    <!-- ./ Required Variables -->

                    <div id="messageBar" class="d-flex justify-content-between align-items-center bg-white p-2 shadow">
                        <input id="userMessage" type="text" name="message" class="w-75 d-inline messageInput"
                               placeholder="پیام شما...">
                        <div id="recordBtns" class="w-25">
                            <div id="controls" class="d-inline" style="display: none!important;">
                                <button id="stopButton" disabled onclick="run()">
                                    <i class="fas fa-stop blink_me"></i>
                                </button>
                                <button id="pauseButton" disabled>
                                    <i class="fas fa-pause"></i>
                                </button>
                                <button id="recordButton">
                                    <i class="fas fa-microphone-alt"></i>
                                </button>

                            </div>
                            <div class="upload-btn-wrapper d-inline ">
                                <abbr title="آپلود فایل تصویر" >
                                    <input type="file" id="chatfile" name="chatfile" onchange="send_file()"/>
                                </abbr>
                                <i class="fas fa-images"></i>
                            </div>
                            <a href="#" id="userSubmit" class="btn bg-tootfarangee d-inline messageBtn">ارسال</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <div class="mt-5">
        <?php require_once "user/section/scripts.php"; ?>
        <?php require_once "user/section/footer.php"; ?>
    </div>
</div>

<script src="/global_assets/js/chats/prepare.js"></script>
<script src="/global_assets/js/chats/send.js"></script>
<script src="/global_assets/js/chats/receive.js"></script>
<script src="/global_assets/js/chats/user_update.js"></script>
