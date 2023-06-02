
<!--Custom Styles-->
<link rel="stylesheet" href="../admin/assets/css/chat_box.css">
<style>
    .fa-file-invoice-dollar , .fa-bell , #notes_area{
        display : none!important;
    }
</style>
<!--./Custom Styles-->
<!--=========================================================================-->
<!--Page Content-->
<section class="content-wrapper" style="padding: 20px">

    <!--Chat Data-->
    <input id="user_id" type="hidden" name="user_id" value="<?php echo $admin_info->id?>">
    <input id="admin_id" type="hidden" name="admin_id" value="<?php echo $admin_info->id?>">
    <input id="code" type="hidden" name="code" value="">
    <input id="target_user" type="hidden" name="target_user" value="user">
    <!--./Chat Data-->
    <div class="container">
        <div id="testArea">Test Area</div>
        <div class="row bg-white">
            <div class="col-sm-8">
                <!--Main Chat Area-->
                <div id="chatWrapper" class="chatWrapper">
                    <div id="welcome_message" class="admin-chat">
                        زیباجوی عزیز ، با درود
                        چطور میتونم کمکتون کنم ؟
                    </div>
                </div>
                <!--Send Text Message-->
                <div class="row justify-content-between chat_form_controllers">
                    <form id="chatForm" enctype="multipart/form-data">
                        <input id="message" type="text" name="message" placeholder="پیام شما" class="form-control">
                        <input id="user_type" type="hidden" name="user_type" value="admin">
                        <input id="message_type" type="hidden" name="message_type" value="text">
                        <input id="roll_title" type="hidden" name="roll_title" value="<?php echo $admin_info->roll_title ?>">
                    </form>

                    <button onclick="send_message()" class="btn btn-primary message_send_btn">ارسال</button>
                    <div onchange="changeMessageType()">
                        <label for="">لینک ارسال میکنید ؟</label>
                        <input id="change_checkbox" type="checkbox" name="change_checkbox">
                    </div>

                </div>
                <!--Send Image Message-->
<!--                <div class="row justify-content-between bg-light p-2 m-2 chat_form_controllers">-->
<!--                    <h6>آپلود تصویر</h6>-->
<!--                    <input type="file" name="file" onchange="send_image()">-->
<!--                </div>-->
                <!--Send Voice Message
                <div class="row justify-content-between">
                    <h6>ارسال Voice</h6>
                    <div id="controls">
                        <button id="recordButton">Record</button>
                        <button id="pauseButton" disabled>Pause</button>
                        <button id="stopButton" disabled>Stop</button>
                    </div>
                </div>
                -->
            </div>
            <div class="col-sm-4">
                <h6 class="text-danger">زیباجویان</h6>
                <input id="customer_search" type="text" placeholder="جستجو در زیباجویان" oninput="find_customer(event)">
                <div id="customersWrapper" class="our-customers">

                </div>
            </div>
        </div>
    </div>
</section>
<section class="content-wrapper" style="padding: 20px">
    <div class="container">
        <div id="notes_area" class="row bg-white">
            <h6>یادداشت ها</h6>
            <hr>
            <div   class="col-sm-8">
                <div id="note_wrapper">

                </div>
                <input id="note_input" type="text" name="note_input" placeholder="یادداشت خود را ثبت کنید">
                <button class="btn btn-primary note_input_btn" onclick="function (){plugins.notes.create()}">
                    ثبت یادداشت
                    ً</button>
            </div>
            <div class="col-sm-4">
                <h6>اطلاعات عمومی</h6>
                <div class="text-center">
                    <img id="customer_img"  class="mb-3"  width="60" style="border-radius: 50%">
                </div>
                <table class="table table-striped">
                    <tr>
                        <th>نام و نام خانوادگی</th>
                        <td id="customer_fullname"></td>
                    </tr>
                    <tr>
                        <th>عضویت در</th>
                        <td id="customer_register_date"></td>
                    </tr>

                </table>
            </div>
        </div>
    </div>

</section>

<!--./Page Content-->
<!--=========================================================================-->
<!--Page Scripts-->
<script src="../global_assets/js/chat_main.js"></script>
<script src="/global_assets/js/chat/chat.js"></script>
<script src="assets/js/admin_chat.js"></script>
<script src="assets/js/custom_plugins.js"></script>
<script>
    function changeMessageType(){
        let message_type_input = document.getElementById('message_type');
        let change_checkbox = document.getElementById('change_checkbox');
        if (change_checkbox.checked){
            message_type_input.value = 'link';
        } else {
            message_type_input.value = 'text';
        }
    }
</script>
<!--./Page Scripts-->
