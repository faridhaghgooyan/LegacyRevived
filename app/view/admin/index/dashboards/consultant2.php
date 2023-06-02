<!--Custom Styles-->
<link rel="stylesheet" href="../admin/assets/css/chat_box.css">
<!--./Custom Styles-->
<style>
    .notes-wrapper{
        max-height: 300px;
        overflow: auto;
        padding: 10px;
    }
    .note_box{
        margin-bottom: 5px;
        background-color: #e9e9e9;
        padding: 10px;
        border-right: 5px solid #d41c21;
        border-radius: 15px 0 0 15px;
        word-wrap: break-word;
    }
    .datatime{
        opacity: 0.8;
        font-size: 1.1rem;
    }
    .gallery{
        border-radius: 15px;
        display: inline!important;
        position: relative;
        top: 35px;
        right: 10px;
        padding: 3px 15px;
        text-decoration: none;
        color: white;
        font-size: 1.2rem;
        cursor: pointer;
        transition: 0.5s;
        /*z-index: 1111;*/
    }
    .add_gallery{
        background-color: #23d023;
    }
    .remove_gallery{
        background-color: #d02323;
    }

</style>

<section class="content-wrapper" style="padding: 20px">
    <!--Chat Data-->
    <input id="user_id" type="hidden" name="user_id" value="1">
    <input id="admin_id" type="hidden" name="admin_id" value="12">
    <input id="code" type="hidden" name="code" value="784596">
    <!--./Chat Data-->

    <div class="container">
        <div class="row">
            <div class="col-8">
                <!--Main Chat Area-->
                <div id="chatWrapper"></div>
                <!--Send Text Message-->
                <div class="row justify-content-between">
                    <form id="chatForm" enctype="multipart/form-data">
                        <input id="message" type="text" name="message" placeholder="پیام شما" class="form-control">
                        <input id="user_type" type="hidden" name="user_type" value="user">
                        <input id="message_type" type="hidden" name="message_type" value="text">
                    </form>
                    <button onclick="send_message()" class="btn btn-primary">ارسال</button>

                </div>
                <!--Send Image Message-->
                <div class="row justify-content-between bg-light p-2 m-2">
                    <h6>آپلود تصویر</h6>
                    <input type="file" name="file" onchange="send_image()">
                </div>
                <!--Send Voice Message-->
                <div class="row justify-content-between">
                    <h6>ارسال Voice</h6>
                    <div id="controls">
                        <button id="recordButton">Record</button>
                        <button id="pauseButton" disabled>Pause</button>
                        <button id="stopButton" disabled>Stop</button>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <h6>Customers</h6>
                <div id="customersWrapper" class="our-customers">

                </div>
            </div>
        </div>
    </div>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <input id="admin_id" type="hidden" name="admin_id" value="<?php echo $admin_info->roll_id;?>">
    <div class="container-fluid">
        <div class="row">
            <div class="page-content col-md-12 row shadow" >
                <i class="fas fa-users font-1-rem d-inline"></i>
                <input type="hidden" name="clickMe" value="<?php if (isset($_GET['click'])){echo $_GET['click'];} ?>">
                <span class="iransans font-1-rem d-inline">چت های آنلاین</span>
                <hr>
                <div class="row">
                    <div id="usersChatList" class="col-sm-4 " >

                        <?php foreach ($contacts as $contact): ?>
                            <?php if ($contact['chat_code'] != null): ?>
                                <div id="usersChatList<?php echo $contact['code'];?>" class="usersChatList"
                                     data-code="<?php echo $contact['code'];?>" onclick=loadMessages("<?php echo $contact['code'];?>","usersChatList<?php echo $contact['code'];?>")>
                                        <img src="<?php echo $contact['pic'];?>" alt="" width="50">
                                        <span><?php echo $contact['firstName'] . ' ' . $contact['lastName'];?></span>
                                        <span class="badge badge-red p-2"> </span>
                                        <abbr title="صدور فاکتور">
                                            <a class="" >
                                                <i onclick=factorModal("<?php echo $contact['code'];?>") class="fa fa-dollar"></i>
                                            </a>
                                        </abbr>
                                        <abbr title="ایجاد یادآور برای این چت">
                                            <a class="" >
                                                <i onclick=addTODO("<?php echo $contact['id'];?>","<?php echo $contact['code'];?>") class="fa ion-ios-alarm"></i>
                                            </a>
                                        </abbr>
                                    <?php if ($contact['checked'] == 0) : ?>
                                        <a class="" onclick="goto('?c=users&a=accept&id=<?php echo $contact['id']?>')">
                                            <i style="color: red!important;" class="fa fa-check"></i>
                                        </a>
                                    <?php endif; ?>
                                    </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                    <div class="col-sm-8 ">
                        <!-- Main Chat Box -->
                        <div id="chatMainBox" class="bg-whatsapp">
                            <div  class="p-4 text-left text-left" style="text-align: left!important;">
                                <div class="text-left">
                                    <p class=" admin-chat-box d-inline-block">
                                        زیباجوی عزیز سلام،
                                        <br>
                                        به چه خدمتی نیاز دارید ؟
                                    </p>
                                </div>
                                <div class="text-left">
                                    <img src="/storage/strawberry-celebration.gif" alt="" class="user-chat-img shadow d-inline-block" width="200" >
                                </div>
                            </div>
                        </div>
                        <div class="row chat-controller ">
                            <form id="chatForm" method="post" enctype="multipart/form-data"
                                  class="">
                                <!-- Required Variables -->
                                <input id="chat_code" type="hidden" name="chat_code" class="w-100" value="">
                                <input id="user_type" type="hidden" name="user_type" class="w-100" value="consultant">
                                <input id="message_type" type="hidden" name="message_type" class="w-100" value="text">
                                <input id="owner_id" type="hidden" name="owner_id" class="w-100" value="<?php if (isset($admin_info->id)){echo $admin_info->id;} ?>">
                                <!-- ./ Required Variables -->
                                <div id="messageBar" class="w-100 d-flex justify-content-between align-items-center">
                                    <div id="controls d-none" style="display: none!important;">
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
                                    <div class="w-25">
                                        <div class="d-inline ">
                                            <!-- Default dropup button -->
                                            <div class="btn-group dropup">
                                                <button type="button" class=" dropdown-toggle" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-plus"></i>
                                                </button>

                                                <div class="dropdown-menu">
                                                    <ul>
                                                        <li class="pull-right">
                                                            <a href="?c=users&a=addUser" data-toggle="modal"
                                                               data-code="">ایجاد زیباجو</a>
                                                        </li>



                                                    </ul>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
<!--                                    <input id="adminMessage" type="text" name="message" class="w-50 messageInput "-->
<!--                                           placeholder="پیام شما..." style="width: 75%!important;">-->
                                    <textarea name="message" id="adminMessage"  rows="1" placeholder="پیام شما..." class="w-50 messageInput" style="width: 75%!important;"></textarea>
<!--                                    <script>-->
<!--                                        var textarea = document.getElementById("adminMessage");-->
<!---->
<!--                                        textarea.oninput = function() {-->
<!--                                            textarea.style.height = "";-->
<!--                                            /* textarea.style.height = Math.min(textarea.scrollHeight, 300) + "px"; */-->
<!--                                            textarea.style.height = textarea.scrollHeight + "px"-->
<!--                                        };-->
<!--                                    </script>-->
                                    <div class="w-25">
                                        <div class="upload-btn-wrapper d-inline ">

                                            <abbr title="آپلود فایل تصویر" >
                                                <input type="file" id="chatfile" name="chatfile" onchange="send_file()"/>
                                            </abbr>
                                            <i class="fas fa-images"></i>
                                        </div>
                                        <a href="#" id="userSubmit" class="btn btn-danger d-inline messageBtn">ارسال</a>
                                    </div>
                                </div>
                            </form>

                            <div class="d-none col-md-12 ">
                                <div id="quickMessage">
                                    <h6>پیام های فوری</h6>
                                </div>
                                <form id="adminChatForm" action="?api=adminChat&a=store"  method="post" enctype="multipart/form-data">
                                    <?php
                                    $string=exec('getmac');
                                    $mac=substr($string, 0, 17);
                                    ?>
                                    <input id="user_email" type="hidden" name="user_email" class="w-100" value="<?php
                                    if (isset($_COOKIE['TF-Email'])){
                                        echo $_COOKIE['TF-Email'];
                                    }
                                    ?>">
                                    <input id="mac_address" type="hidden" name="mac_address" class="w-100" value="<?php echo $mac?>">
                                    <input id="chat_code" type="hidden" name="chat_code" class="w-100" value="<?php echo $mac.date('Y-m-d') ?>">
                                    <input id="type" type="hidden" name="type" class="w-100" value="admin">
                                    <div id="messageBar" class="w-100 ">

                                        <hr>
                                        <input id="adminMessage" type="text" name="text" class="w-100 d-inline sendMessage " placeholder="پیام شما..." style="width: 100%!important;">
                                        <div class="w-25">
                                            <div id="controls" class="d-inline">
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
                                                <abbr title="آپلود فایل تصویر" ><input type="file" id="chatfile" name="chatfile" /></abbr>
                                                <i class="fas fa-images"></i>
                                            </div>
                                            <a href="#" id="userSubmit" class="btn btn-danger d-inline sendMessage">ارسال</a>
                                        </div>
                                    </div>
                                </form>

                            </div>




                        </div>
                    </div>
                </div>
            </div>

        </div>
<!--        <div class="page-content col-sm-5 shadow">-->
<!--            <i class="fas fa-users font-1-rem d-inline"></i>-->
<!--            <span class="iransans font-1-rem d-inline">جدیدترین کاربران</span>-->
<!--            <hr>-->
<!--                <table class="table table-striped">-->
<!--                    <thead>-->
<!--                    <tr>-->
<!--                        <th>#</th>-->
<!--                        <th>نام خانوادگی</th>-->
<!--                        <th>شماره همراه</th>-->
<!--                        <th>مدیریت</th>-->
<!--                    </tr>-->
<!--                    </thead>-->
<!--                    <tbody>-->
<!--                    --><?php //foreach ($customers as $customer):?>
<!--                        --><?php //$i=1;if ($customer['has_checked'] == 0): ?>
<!--                            <tr class="">-->
<!--                                <td>--><?php //echo $i?><!--</td>-->
<!--                                <td>--><?php //echo $customer['lastName']?><!--</td>-->
<!--                                <td>--><?php //echo $customer['mobile']?><!--</td>-->
<!--                                <td>-->
<!--                                    <abbr title="با تایید این اطلاعات با تکمیل تمام مراحل مورد نیاز این زیباجو موافقت کرده اید">-->
<!--                                        <a href="?c=users&a=reviewed&id=--><?php //echo $customer['id']?><!--" class="btn btn-sm btn-success">-->
<!--                                            <i class="fa fa-check "></i>-->
<!--                                            تایید شد-->
<!--                                        </a>-->
<!--                                    </abbr>-->
<!--                                </td>-->
<!--                            </tr>-->
<!---->
<!--                        --><?php //else: ?>
<!--                            <div class="text-center w-100">-->
<!--                                <img src="/storage/nodata.PNG" width="300" class="text-center">-->
<!--                            </div>-->
<!--                        --><?php //endif; ?>
<!--                        --><?php //$i++;endforeach; ?>
<!---->
<!--                    </tbody>-->
<!--                </table>-->
<!---->
<!---->
<!--        </div>-->
        <div class="page-content col-sm-6 shadow">
            <i class="fas fa-comments font-1-rem d-inline"></i>
            <span class="iransans font-1-rem d-inline">یادداشت ها</span>
            <hr>
            <div id="notes-wrapper" class="notes-wrapper">


            </div>
            <br>
            <div class="mt-2">
                <form id="notesForm" action="notesForm" method="POST" >
                    <input id="chat_code_2" type="hidden" name="chat_code_2" class="w-100" value="">
                    <textarea id="note_text"  name="note_text" class="w-100" cols="30" rows="4" placeholder="یادداشت شما ..."></textarea>

                    <a type="submit" class="btn bg-tootfaragi" onclick="send_note()">ارسال</a>
                </form>
            </div>
        </div>
    </div>
    <!-- Doctor Section -->
<!--    <div class="container bg-white">-->
<!--        <div class="row bg-white">-->
<!--            <div class="page-content col-sm-12 shadow">-->
<!--                <i class="fas fa-users font-1-rem d-inline"></i>-->
<!--                <span class="iransans font-1-rem d-inline">لیست عمل های امروز</span>-->
<!--                <hr>-->
<!--                <table class="table table-striped">-->
<!--                    <thead>-->
<!--                    <tr>-->
<!--                        <th>#</th>-->
<!--                        <th>نام و نام خانوادگی</th>-->
<!--                        <th>تاریخ عمل</th>-->
<!--                        <th>ساعت عمل</th>-->
<!--                        <th>کنترل</th>-->
<!--                                       <th>کنترل</th>-->
<!--                    </tr>-->
<!--                    </thead>-->
<!--                    <tbody>-->
<!--                    <tr class="d-flex align-items-self">-->
<!--                        <td>1</td>-->
<!--                        <td>فرید حقگویان</td>-->
<!--                        <td>1400/03/02</td>-->
<!--                        <td>14:50</td>-->
<!--                        <td>-->
<!--                            <a href="" class="btn btn-link bg-light">adssda</a>-->
<!--                            <a href="" class="btn btn-link bg-light">adssda</a>-->
<!--                            <a href="" class="btn btn-link bg-light">adssda</a>-->
<!--                            <a href="" class="btn btn-link bg-light">adssda</a>-->
<!--                        </td>-->
<!---->
<!--                    </tr>-->
<!---->
<!--                    </tbody>-->
<!--                </table>-->
<!---->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
    <a id="clickme" href="" onclick="alert('hi')"></a>
</section>
<script src="../global_assets/js/chat/recorder.js"></script>
<script src="../assets/js/app.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../assets/js/main.js"></script>
<script src="../assets/js/chat.js"></script>
<script src="../assets/js/admin_chat.js"></script>
<!--<script>-->
<!--    function noteModal(){-->
<!--        let code = $('input[name=code]').val();-->
<!--        let target = $('#noteForm');-->
<!--        $('#noteForm input[name=chat_code]').remove();-->
<!--        target.prepend('<input type="hidden" name="chat_code" value="'+code+'"><br>');-->
<!--    }-->
<!--</script>-->
<!--<script>-->
<!--    $('.sms-code').on('click',function (){-->
<!--        let sms_code = $(this).text();-->
<!--        let details_box = $('#sms-details-box');-->
<!--        $('.sms-code').removeClass('circle-active');-->
<!--        $(this).addClass('circle-active');-->
<!--        details_box.empty();-->
<!---->
<!--        details_box.append('<input type="hidden" name="sms_code" value="'+sms_code+'">');-->
<!--        switch (sms_code){-->
<!--            case '6':-->
<!--                details_box.append('<input type="text" name="sms_price" placeholder="مبلغ    ..." required>');-->
<!--                details_box.append('<input type="text" id="due-date" name="sms_date" class="select" placeholder="تاریخ   ..." required>');-->
<!--                kamaDatepicker('due-date', {-->
<!--                    forceFarsiDigits : false,-->
<!--                    sync : true,-->
<!--                    markToday : true,-->
<!--                    markHolidays : true,-->
<!--                    highlightSelectedDay : true,-->
<!--                    twodigit : true,-->
<!--                    buttonsColor: "red",-->
<!--                    forceFarsiDigits: true,-->
<!--                    gotoToday : true,-->
<!--                });-->
<!---->
<!--                break;-->
<!--            case '7':-->
<!--                details_box.append('<input type="text" id="due-date" name="sms_date" class="select" placeholder="تاریخ   ..." required>');-->
<!--                details_box.append('<input type="time" id="due-date" name="sms_time" class="select" placeholder="ساعت   ..." required>');-->
<!--                kamaDatepicker('due-date', {-->
<!--                    forceFarsiDigits : false,-->
<!--                    sync : true,-->
<!--                    markToday : true,-->
<!--                    markHolidays : true,-->
<!--                    highlightSelectedDay : true,-->
<!--                    twodigit : true,-->
<!--                    buttonsColor: "red",-->
<!--                    forceFarsiDigits: true,-->
<!--                    gotoToday : true,-->
<!--                });-->
<!--                break;-->
<!---->
<!--        }-->
<!--    })-->
<!--</script>-->
<!---->
<!--<!-- Custom js for this page -->-->
<!--<script src="../global_assets/js/admin/notes.js"></script>-->
<!---->
<!--<script src="../global_assets/js/chats/prepare.js"></script>-->
<!--<script src="../global_assets/js/chats/send.js"></script>-->
<!--<script src="../global_assets/js/admin/notes.js"></script>-->
<!--<script src="../global_assets/js/admin/gallery.js"></script>-->
<!--<!--<script src="../global_assets/js/chats/consultant/receive.js"></script>-->-->
<!--<script src="../global_assets/js/chats/update.js"></script>-->
<!--<script>-->
<!--    $(document).ready(function (){-->
<!--        target = $('input[name=clickMe]').val();-->
<!--        if (target){-->
<!--            $('#'+target).click();-->
<!--        }-->
<!--    })-->
<!--    $('.chat-controller').hide();-->
<!--    $('#usersChatList').on('click',function (){-->
<!--        $('.chat-controller').show();-->
<!--    })-->
<!--</script>-->
<!--<script>-->
<!--    function goto(link){-->
<!--        var r = confirm("شما در حال تایید زیباجو میباشید ، آیا مطمئن هستید ؟");-->
<!--        if (r == true) {-->
<!--            window.location.replace("https://clog.tootfarangee.com/admin/"+link);-->
<!--        }-->
<!---->
<!--    }-->
<!--</script>-->
<!-- Supporter Section -->\