<?php
use app\models\supporter;
use app\models\users;
require '../app/models/supporter.php';
require '../app/models/users.php';
$supporter_obj = new supporter();
$users_obj = new users();

$task_id = $_GET['task'];
$nurse_id = $supporter_obj->findTask($task_id)['operator_id'];
$customer_id = $supporter_obj->findTask($task_id)['customer_id'];
$nurse = $users_obj->find($nurse_id);
$nurse_name = $nurse['firstName'] . ' ' . $nurse['lastName'];
$nurse_pic = $nurse['pic'];

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
                <h3>زیبا جوی گرامی؛ با درود فراوان</h3>
                <p>ضمن آرزوی بهروزی و سلامت برای شما! این برگه در جهت سنجش میزان خشنودی شما از خدمات پس از جراحی و همچنین در راستای افزایش کیفیت خدمات و حفظ رضایت خاطر شما تهیه گردیده است. لطفاً با پاسخ دهی صحیح ما را یاری نمایید.
                </p>
                <span class="text-danger">در حال ثبت نظر برای " <?php echo $nurse_name;?>" هستید...</span>
                <hr>
                <form action="submit.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="task_id" value="<?php echo $task_id;?>">
                    <input type="hidden" name="operator_id" value="<?php echo $nurse_id;?>">
                    <input type="hidden" name="customer_id" value="<?php echo $customer_id;?>">
                    <ol class="vote_list">
                        <li class="text-right" style="margin-bottom: 1rem" id="firstRow">
                            <span class="text-justify mb-2">
                                آیا بهورز شما در بدو مراجعه از پوشش مناسب و  تگ کلینیک برخوردار بود؟
                            </span>
                            <br>
                            <input type="radio" name="has_badge" value="1" required> بله
                            <input type="radio" name="has_badge" value="0" required> خیر
                        </li>
                        <li class="text-right" style="margin-bottom: 1rem">
                            <span class="text-justify mb-2">
                                آیا بهورز محترم با شما و دیگر اعضای حاضر, رفتار حرفه ای و شایسته دارد؟
                            </span>
                            <br>
                            <input type="radio" name="has_expert" value="1" required> بله
                            <input type="radio" name="has_expert" value="0" required> خیر
                        </li>
                        <li class="text-right" style="margin-bottom: 1rem">
                            <span class="text-justify mb-2">
                                آیا به درخواست ها و وضعیت شما رفتار مناسبی نشان می دهد؟
                            </span>
                            <br>
                            <input type="radio" name="has_good_action" value="1" required> بله
                            <input type="radio" name="has_good_action" value="0" required> خیر
                        </li>
                        <li class="text-right" style="margin-bottom: 1rem">
                            <span class="text-justify mb-2">
                                آیا کار شما بدون اتلاف وقت انجام شد؟
                            </span>
                            <br>
                            <input type="radio" name="has_fast" value="1" required> بله
                            <input type="radio" name="has_fast" value="0" required> خیر
                        </li>
                        <li class="text-right" style="margin-bottom: 1rem">
                            <span class="text-justify mb-2">
                                آیا پاسخ مناسب به سوالات شما داده شد؟
                            </span>
                            <br>
                            <input type="radio" name="hast_faq" value="1" required> بله
                            <input type="radio" name="hast_faq" value="0" required> خیر
                        </li>
                        <li class="text-right" style="margin-bottom: 1rem">
                            <span class="text-justify mb-2">
                                آیا در زمان تعیین شده به شما مراجعه شد؟
                            </span>
                            <br>
                            <input type="radio" name="has_ontime" value="1" required> بله
                            <input type="radio" name="has_ontime" value="0" required> خیر
                        </li>
                        <li class="text-right" style="margin-bottom: 1rem">
                            <span class="text-justify mb-2">
                               آیا بهورز محترم تجهیزات و امکانات کافی به همراه دارد؟
                            </span>
                            <br>
                            <input type="radio" name="has_eq" value="1" required> بله
                            <input type="radio" name="has_eq" value="0" required> خیر
                        </li>
                        <li class="text-right" style="margin-bottom: 1rem">
                            <span class="text-justify mb-2">
                               در صورتیکه توضیحات بیشتری دارید ذکر نمایید...
                            </span>
                            <br>
                            <textarea class="w-100 other" name="other" id="" cols="30" rows="10" placeholder="پیام شما"></textarea>
                        </li>
                    </ol>
                    <input type="submit" class="w-100 btn btn-success" value="ثبت نظر">
                </form>


                <hr>
                <br>
                <br>
                <hr>

            </div>
            <div class="col-sm-6 px-0 d-none d-sm-block bg-light shadow"
                 style="
                     background-image: url('/storage/femme-question-bleue-1.jpg');
                     background-position: center;
                     background-size: cover;

                        ">
                <img src="..<?php echo $nurse_pic;?>" class="circle" width="150" height="150">
                <h6><?php echo $nurse_name;?></h6>
            </div>
        </div>
    </div>
</main>
<script>
    $('input[type="radio"]').on('click',function (){
        let scrollTop = $('#voteBox').scrollTop();
        $('#voteBox').scrollTop(scrollTop + 70);
    })
</script>