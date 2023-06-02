<!-- Content Wrapper. Contains page content -->
<link rel="stylesheet" href="../global_assets/css/chat.css">
<style>
    .text-center{
        text-align: center;
    }
    .user-public-info{
        background-color: #f1f0f0;
        border-radius: 10px;
        padding: 10px;
    }
    .user-profile-pic{
        border-radius: 50%;
    }
    .bg-whatsapp{
        min-height: 250px;
        max-height: 60vh;
        overflow: auto;
        background-image: url("../storage/chatbackground.jpg");
        background-repeat: repeat;
        background-size: 210px;
        border-radius: 10px;
        padding: 10px;
    }
    .d-block{
        display: block;
    }
    .text-center {
        text-align: center;
    }
    .margin-auto{
        margin: 0 auto;
    }
    .gallery{
        background-color: white;
        padding: 10px;
        border: 1px solid lightgrey;
        border-radius: 10px;
        width: 150px;
    }
    .gallery:hover{
        border: 1px solid #f33232;

    }
</style>
<link rel="stylesheet" href="dist/css/users.css">
<div class="content-wrapper">
    <hr>
    <div class="page-content">


        <!-- Main content -->
        <section class="content">
            <div class="row">
                <i class="fas fa-user-md font-1-rem d-inline"></i>
                <span class="iransans font-1-rem d-inline">
                    پرونده زیباجو
                    <strong><?php echo $chats[0]['firstName'].' '.$chats[0]['lastName']?></strong>
                    <a onclick="goBack()" class="btn bg-tootfarangee">برگشت به صفحه قبل</a>
                </span>
                <hr>
                <?php if ($chats[0]['id']) : ?>
                    <div class="col-md-8">
                        <table class="table table-striped">
                            <tr>
                                <th>نام پدر</th>
                                <td><?php echo $chats[0]['father_name'];?></td>
                            </tr>
                            <tr>
                                <th>شغل</th>
                                <td><?php echo $chats[0]['job']?></td>

                            </tr>
                            <tr>
                                <th>وضعیت تاهل</th>
                                <td><?php echo $chats[0]['has_married']?></td>

                            </tr>
                            <?php if ($chats[0]['gendre'] === 'خانم') : ?>
                            <tr>
                                <th>تعداد بارداری</th>
                                <td><?php echo $chats[0]['pregnant_number']?></td>
                            </tr>
                            <tr>
                                <th>تعداد زایمان</th>
                                <td><?php echo $chats[0]['childbirth_number']?></td>
                            </tr>
                            <tr>
                                <th>تاریخ آخرین زایمان</th>
                                <td><?php echo  $dateConvertor_obj->dateConvert($chats[0]['last_childbirth'])[0]['date'] ?></td>
                            </tr>
                            <?php endif; ?>
                            <tr>
                                <th>سابقه بیماری</th>
                                <td><?php
                                    $diseases = explode(',', $chats[0]['diseases']);
                                    foreach ($diseases as $dis){
                                        echo $user_obj->find_diseases($dis)['title'].' , ';
                                    }
                                    ?>
                                </td>

                            </tr>
                            <tr>
                                <th>سایر بیماری ها</th>
                                <td><?php echo $chats[0]['other_diseases']?></td>
                            </tr>
                            <tr>
                                <th>سابقه مصرف دارو ؟ چه دارویی ؟ چه دوزی ؟</th>
                                <td><?php echo $chats[0]['has_drug']?></td>
                            </tr>
                            <tr>
                                <th>سابقه بستری یا جراحی ؟ به چه دلیلی ؟ چه زمانی ؟</th>
                                <td><?php echo $chats[0]['has_surgery']?></td>
                            </tr>
                            <tr>
                                <th>سایر بیماری خاص در پدر ، مادر ، خواهر و برادر ؟ چه بیماری ای ؟</th>
                                <td><?php echo $chats[0]['has_family_surgery']?></td>
                            </tr>
                        </table>
                        <hr>
                        <div>
                            <h6>گالری تصاویر</h6>
                            <div class="d-flex">

                                <?php foreach ($chats as $chat): ?>
                                    <?php if ($chat['message_type'] == 'image'): ?>
                                        <a href="<?php echo $chat['path'];?>" target="_blank" >
                                            <img src="<?php echo $chat['path'];?>"  class="gallery">
                                        </a>
                                    <?php endif; ?>
                                <?php endforeach; ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 user-public-info text-center">
                        <img src="<?php echo $chats[0]['pic'];?>" class="user-profile-pic" width="120" height="120">
                        <br>
                        <table class="table table-striped">
                            <tr>
                                <th>نام و نام خانوادگی</th>
                                <td><?php echo $chats[0]['firstName'].' '.$chats[0]['lastName']?></td>
                            </tr>
                            <tr>
                                <th>کد ملی</th>
                                <td><?php echo $chats[0]['national_code']?></td>
                            </tr>
                            <tr>
                                <th>تاریخ تولد</th>
                                <td><?php echo $dateConvertor_obj->dateConvert($chats[0]['birthday'])[0]['date'];?></td>
                            </tr>
                            <tr>
                                <th>قد و وزن</th>
                                <td>
                                    <?php echo $chats[0]['height'];?> سانتیمتر
                                    /
                                    <?php echo $chats[0]['weight'];?> کیلوگرم
                                </td>
                            </tr>
                            <?php if ($admin_obj->find($admin_info->id)["roll_id"] !== '3'): ?>
                            <tr>
                                <th>شماره همراه</th>
                                <td><?php echo $chats[0][5]?></td>
                            </tr>
                            <tr>
                                <th>شماره ثابت</th>
                                <td><?php echo $chats[0]['home_phone']?></td>
                            </tr>
                                <tr>
                                    <th>استان و شهر</th>
                                    <td>
                                        <?php
                                        echo $user_obj->get_province_name($chats[0]['province_id'])['name'] . ' / ' .
                                            $user_obj->get_city_name($chats[0]['city_id'])['name'];
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>آدرس کامل</th>
                                    <td><?php echo $chats[0]['full_address']?></td>
                                </tr>
                                <tr>
                                    <th><i class="fa fa-instagram" style="font-size: 2.1rem"></i> </th>

                                    <td><?php echo $chats[0]['instagram_id']?></td>
                                </tr>
                            <?php endif; ?>
                        </table>

            </div>
                <?php else:?>
                <i class="fa fa-cry"></i>
                        <h5>هیچ سابقه ای برای این زیبا جو وارد نشده است!</h5>
                <?php endif; ?>

            </div>
            <hr>
            <div class="row">
                <?php if ($chats && $admin_info->roll_title != 'doctor' ) : ?>

                    <i class="fas fa-user-md font-1-rem d-inline"></i>
                <span class="iransans font-1-rem d-inline">
                        سوابق چت زیباجو
                    </span>

                <hr>
                    <div class="col-md-8 bg-whatsapp  text-center">
                        <?php
                            foreach ($chats as $chat){
                                $last_date = $chat['created_at'];
                                $date =  $dateConvertor_obj->date_convert($chat['created_at'],'jalali')[0]['date'];
                                echo "<span class='btn bg-dark d-block text-white' style='color: white'>$date</span>";

                                switch ($chat['message_type']){
                                    case 'text':
                                        $message = $chat['message'];

                                        switch ($chat['user_type']){
                                            case 'user':
                                                echo "
                                                <div class='text-left'><p class='user-chat-box d-inline-block'>
                                                $message
                                                </p></div>
                                                ";
                                                break;
                                            case 'admin':
                                            case 'consultant':
                                                echo "
                                                <div class='text-left'><p class='admin-chat-box d-inline-block'>$message</p></div>
                                                ";
                                                break;
                                        }
                                        break;
                                    case 'image':
                                        $image = $chat['path'];
                                        echo "
                                        <div class='text-left'><a href='' target='_blank'>
                                        <img src='$image'
                                        class='user-chat-img shadow d-inline-block' width='200'></a></div>
                                        ";
                                        break;
                                }
                            }

                        ?>



                    </div>
                    <div class="col-md-4 user-public-info text-center">
                        <img src="<?php echo $chats[0]['pic'];?>" class="user-profile-pic" width="120" height="120">
                        <br>
                        <table class="table table-striped">
                            <tr>
                                <th>تعداد  چت</th>
                                <td><?php echo count($chats)?></td>
                            </tr>


                        </table>

                    </div>
                <?php else:?>
                    <i class="fa fa-cry"></i>
                    <h5>هیچ سابقه چتی برای این زیبا جو ثبت نشده است!</h5>
                <?php endif; ?>


            <!-- /.content -->
        </div>


        </section>
    </div>
<!-- /.content-wrapper -->
    <script src="../global_assets/js/adminController.js"></script>
    <script src="../global_assets/css/splide.min.css"></script>
    <script src="https://unpkg.com/@glidejs/glide@3.4.1/dist/glide.js"></script>

<script src="https://adminlte.io/themes/dev/AdminLTE/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script>
    function goBack() {
        window.history.back();
    }
</script>
