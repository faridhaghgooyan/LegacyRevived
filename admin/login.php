
<?php


require_once '../app/view/admin/section/loginheader.php';
if (isset($_COOKIE['TF-Email'])){
    header('location:/admin/?c=index&a=index');
}
//var_dump($email=$_POST['email']);
//if (isset($_POST["login"])) {
////    header("location:login");
//    $email=$_POST['email'];
//    $password=sha1($_POST['password']);
//}
//?>
    <link rel="stylesheet" href="assets/css/login.css">
<style>
    body,html,main{
        background-color: white!important;
    }
</style>
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 login-section-wrapper">
                    <div class="brand-wrapper">
                        <img src="assets/images/tootfarangeeplus.png" alt="Tootfrangee Clinic logo" class="logo">
                    </div>
                    <div class="login-wrapper my-auto">
                        <h1 class="login-title">ورود</h1>
                        <form action="index.php?c=admin&a=login" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="email">ایمیل :</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="email@example.com">
                            </div>
                            <div class="form-group mb-4">
                                <label for="password">رمز عبور :</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="******">
                            </div>
                            <input name="login" id="login" class="btn btn-block login-btn" type="submit" value="ورود">
                        </form>
                        <a href="#!" class="forgot-password-link">فراموشی رمز عبور</a>

                    </div>
                </div>
                <div class="col-sm-6 px-0 d-none d-sm-block">
                    <img src="assets/images/login.jpg" alt="login image" class="login-img">
                </div>
            </div>
        </div>
    </main>
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>-->
<!---->
<!--<script>-->
<!--    let form = {-->
<!--        "order_id": 101,-->
<!--        "amount": 10000,-->
<!--        "name": "قاسم رادمان",-->
<!--        "phone": "09382198592",-->
<!--        "mail": "my@site.com",-->
<!--        "desc": "توضیحات پرداخت کننده",-->
<!--        "callback": "https://example.com/callback"-->
<!--    };-->
<!--    $.ajax({-->
<!--        url : 'https://api.idpay.ir/v1.1/payment',-->
<!--        method : 'post',-->
<!--        dataType : 'jsonp',-->
<!--        beforeSend: function(xhr){xhr.setRequestHeader('X-SANDBOX: 1');},-->
<!--        data : form,-->
<!--        success : function (result){-->
<!--            console.log(result);-->
<!---->
<!--        },-->
<!--        error : function (xhr){-->
<!--            console.log(xhr);-->
<!--        }-->
<!--    })-->
<!--</script>-->