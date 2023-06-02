
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
            <div class="col-sm-6 login-section-wrapper bg-white shadow iransans">
                <div class="brand-wrapper">
                    <img src="/storage/tootfarangeeplus.png" alt="Tootfrangee Clinic logo" class="logo" >
                </div>
                <h5>نظر سنجی</h5>
                <span>زیبا جوی گرامی؛ با درود فراوان</span>
                <p>ضمن آرزوی بهروزی و سلامت برای شما! این برگه در جهت سنجش میزان خشنودی شما از خدمات پس از جراحی و همچنین در راستای افزایش کیفیت خدمات و حفظ رضایت خاطر شما تهیه گردیده است. لطفاً با پاسخ دهی صحیح ما را یاری نمایید.
                </p>
                <hr>
                <span class="text-danger">در حال ثبت نظر برای " منا نگارپور" هستید...</span>
                <hr>
                <span class="text-right">
                    <p>آیا بهورز شما در بدو مراجعه از پوشش مناسب و  تگ کلینیک برخوردار بود؟</p>
                    <input type="radio" id="html" name="fav_language" value="HTML">
                    <label for="html">بله</label>
                    <input type="radio" id="html" name="fav_language" value="HTML">
                    <label for="html">خیر</label>
                </span>
                <span class="text-right">
                    <p>
                        ⦁	آیا بهورز محترم با شما و دیگر اعضای حاضر, رفتار حرفه ای و شایسته دارد؟

                    </p>
                    <input type="radio" id="html" name="fav_language" value="HTML">
                    <label for="html">بله</label>
                    <input type="radio" id="html" name="fav_language" value="HTML">
                    <label for="html">خیر</label>
                </span>
                <span class="text-right">
                    <p>
⦁	آیا به درخواست ها و وضعیت شما رفتار مناسبی نشان می دهد؟

                    </p>
                    <input type="radio" id="html" name="fav_language" value="HTML">
                    <label for="html">بله</label>
                    <input type="radio" id="html" name="fav_language" value="HTML">
                    <label for="html">خیر</label>
                </span>
                <span class="text-right">
                    <p>
⦁	آیا کار شما بدون اتلاف وقت انجام شد؟

                    </p>
                    <input type="radio" id="html" name="fav_language" value="HTML">
                    <label for="html">بله</label>
                    <input type="radio" id="html" name="fav_language" value="HTML">
                    <label for="html">خیر</label>
                </span>
                <span class="text-right">
                    <p>
⦁	آیا پاسخ مناسب به سوالات شما داده شد؟

                    </p>
                    <input type="radio" id="html" name="fav_language" value="HTML">
                    <label for="html">بله</label>
                    <input type="radio" id="html" name="fav_language" value="HTML">
                    <label for="html">خیر</label>
                </span>
                <span class="text-right">
                    <p>
⦁	آیا در زمان تعیین شده به شما مراجعه شد؟

                    </p>
                    <input type="radio" id="html" name="fav_language" value="HTML">
                    <label for="html">بله</label>
                    <input type="radio" id="html" name="fav_language" value="HTML">
                    <label for="html">خیر</label>
                </span>
                <span class="text-right">
                    <p>
⦁	آیا بهورز محترم تجهیزات و امکانات کافی به همراه دارد؟

                    </p>
                    <input type="radio" id="html" name="fav_language" value="HTML">
                    <label for="html">بله</label>
                    <input type="radio" id="html" name="fav_language" value="HTML">
                    <label for="html">خیر</label>
                </span>
                <span class="text-right">
                    <p>
⦁	در صورتیکه توضیحات بیشتری دارید ذکر نمایید.
                    </p>
                    <textarea class="w-100" name="" id="" cols="30" rows="10" placeholder="پیام شما"></textarea>
                </span>
                <br>
                <br>
                <hr>
                <button class="btn btn-success">ثبت نظر</button>

            </div>
            <div class="col-sm-6 px-0 d-none d-sm-block bg-light shadow"
                 style="
                     background-image: url('/storage/femme-question-bleue-1.jpg');
                     background-position: center;
                     background-size: cover;

                        ">

            </div>
        </div>
    </div>
</main>