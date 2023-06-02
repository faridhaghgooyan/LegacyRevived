<script>
    $("script[src='../global_assets/js/todo.js']").remove();
    modal.modal({
        show : 'false',

    })
</script>

<style>
    input:not(input[type=submit]):not(input[type=checkbox]):not(input[type=radio]) , textarea {
        width: 100%;
        border: 1px solid lightgrey;
        border-radius: 10px;
        padding: 5px;
        transition: 0.5s;
        margin-bottom: 10px;
    }
    #reminderContentModal{
        display: none!important;
    }
    .carousel-control, .modal-backdrop.in{
        display: none!important;
    }
    .select{
        width: 100%;
        border: 1px solid lightgrey;
        border-radius: 10px;
        padding: 5px;
        transition: 0.5s;
    }
    .select:hover{
        cursor: pointer;
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
    }
    .supporter_comment{
        width: 100%;
        border: 1px solid lightgrey;
        border-radius: 10px;
        padding: 5px;
        transition: 0.5s;
    }
    .supporter_comment:hover{
        cursor: pointer;
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
    }
    label {
        margin-right: 10px;
    }
</style>
<link rel="stylesheet" href="../assets/css/kamadatepicker.min.css">
<div class="content-wrapper">
    <hr>

    <div class="page-content">
        <form action="?c=todo&a=update" method="post" enctype="multipart/form-data">
            <input type="hidden" name="creator_id" value="<?php echo $admin_info->id?>">
            <input type="hidden" name="todo_id" value="<?php echo $_GET['id']?>">
            <div class="form-group">
                <label for="inputName">زیباجو</label>
                <select name="chat_code" id="customerid" class="select iransans">
                    <option value="default">یک مراجعه کننده انتخاب کنید...</option>
                    <?php
                    foreach ($users as $user){
                        $name = !empty($user["lastName"]) ? $user["firstName"].' '.$user["lastName"] : "ناشناس با کد " . $user["code"];
                        if ($todo[4]  === $user['chat_code']){
                            echo '<option value="'.$user["chat_code"].'" selected>'.$name.'</option>';

                        } else {
                            echo '<option value="'.$user["chat_code"].'">'.$name.'</option>';

                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="inputDescription">یادآوری کن در تاریخ : </label>

                <input type="text" id="due_date_jalali" name="due_date_jalali" class="select2 d-inline" value="<?php echo $dateConvertor_obj->dateConvert($todo['due_date'])[0]['date']?>" placeholder="تاریخ مراجعه را انتخاب کنید...">

            </div>

            <?php
            $timestamp = strtotime($todo['due_date']);
            $hour = date('H:i:s',$timestamp);
            $hour_obj = explode(':',$hour);

            ;?>
            <div class="form-group">
                <label for="inputDescription">در ساعت </label>
                <input type="number" name="hour" max="23" min="00"
                       value="<?php echo $hour_obj[0]?>"
                       onchange="if(parseInt(this.value,10)<10)this.value='0'+this.value;"
                       placeholder="یک ساعت را انتخاب کنید...">
                <label for="inputDescription"> و دقیقه </label>
                <input type="number" name="minute" max="59" min="00"
                       value="<?php echo $hour_obj[1]?>"
                       onchange="if(parseInt(this.value,10)<10)this.value='0'+this.value;"
            </div>
            <br>
                <label for="message">که :</label>
            <textarea name="message" id="" class="w-100 curve-border" rows="5" placeholder="توضیحات تکمیلی برای دکتر..."><?php echo $todo['message'];?></textarea>
            <div class="form-group">
                <label for="inputDescription">وضعیت </label>
                <input type="radio" name="has_done" value="0" checked> فعال
                <input type="radio" name="has_done" value="1" > غیر فعال
            </div>
            <input type="submit" value="ویرایش" class="btn btn-success" name="ویرایش">

        </form>
        <!-- /.content -->


    </div>
</div>
<!-- /.content-wrapper -->

<script src="../assets/js/jquery-1.12.4.min.js"></script>
<script src="../assets/js/persianDatepicker.min.js"></script>

<script src="https://adminlte.io/themes/dev/AdminLTE/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<script src="../assets/js/users.js"></script>
<script src="../assets/js/kamadatepicker.min.js"></script>
<script>
    $("#elementId").persianDatepicker();
</script>
<script src="../assets/js/users.js"></script>
<script>
    kamaDatepicker('due_date_jalali', {
        forceFarsiDigits : false,
        sync : true,
        markToday : true,
        markHolidays : true,
        highlightSelectedDay : true,
        twodigit : true,
        buttonsColor: "red",
        forceFarsiDigits: true,
        gotoToday : true,
    });
</script>


