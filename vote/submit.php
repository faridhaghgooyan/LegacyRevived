<?php
use App\Model\supporter;
use App\Model\user;
use App\Model\task;
use App\Model\kavehSms;
require '../app/Model/supporter.php';
require '../app/Model/users.php';
require '../app/Model/tasks.php';
require '../app/Model/kavehSms.php';
$supporter_obj = new supporter();
$users_obj = new user();
$task_obj= new task();
$sms_obj= new kavehSms();

$task_obj->task_vote($_POST);
$nurse_name = $users_obj->get_user_name($_POST['operator_id']);
$customer_name = $users_obj->find($_POST['customer_id'])['firstName'].' '.$users_obj->find($_POST['customer_id'])['lastName'];
$customer_mobile = $users_obj->find($_POST['customer_id'])['mobile'];
$task_id = $_POST['task_id'];

?>

<?php
require_once '../user/section/header.php';

?>
<link rel="stylesheet" href="../admin/assets/css/login.css">
<style>
    @font-face {
        font-family: IRANSans;
        src: url("../global_assets/fonts/IRANSansWeb(FaNum).woff2");
    }
    body,html,main{
        background-color: white!important;

    }
    * {
        font-family: IRANSans!important;
    }
    .vote_list{
        border-radius: 15px;
        border: 1px dashed lightgrey;
        width: 100%;
        padding: 20px;
    }
    .text-justify {
        text-align: justify;
    }
    .mb-2 {
        margin-bottom: 2rem!important;
    }
    .other{
        border-radius: 10px;
        margin-top: 10px;
        border: 1px solid lightgrey;
        padding: 10px;
        background-color: #f3f3f3;
    }
</style>
<main>
    <div class="container-fluid text-center shadow">
        <div class="row shadow">
            <div id="voteBox" class="col-sm-6 login-section-wrapper bg-white shadow iransans" style="max-height: 550px;overflow: auto">
                <div class="brand-wrapper">
                    <img src="/storage/tootfarangeeplus.png" alt="Tootfrangee Clinic logo" class="logo" >
                </div>
                <h5>نظر سنجی</h5>
                <h3><?php echo $customer_name;?> عزیز ، ممنون از نظر شما</h3>
                <p>
                   تمام تلاشمان را میکنیم تا خدماتی که شایسته شما است را به بهترین کیفیت ممکن ارائه کنیم.
                </p>
                <a href="../user/login.php" class="btn bg-tootfarangee">ورود به حساب کاربری</a>

            </div>
            <div class="col-sm-6 px-0 d-none d-sm-block bg-light shadow"
                 style="
                     background-image: url('/storage/femme-question-bleue-1.jpg');
                     background-position: center;
                     background-size: cover;

                        ">
<!--                <img src="..--><?php //echo $nurse_pic;?><!--" class="circle" width="150" height="150">-->
<!--                <h6>--><?php //echo $nurse_name;?><!--</h6>-->
            </div>
        </div>
    </div>
</main>
