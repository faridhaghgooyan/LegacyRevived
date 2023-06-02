
<style>
    input:not(input[type=submit]) , textarea {
        width: 100%;
        border: 1px solid lightgrey;
        border-radius: 10px;
        padding: 5px;
        transition: 0.5s;
        margin-bottom: 10px;
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
        border: 1px solid lightgrey;$
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
    .select2-results{
        text-align: right!important;
    }
    #select2-customerid-container{
        direction: rtl;
    }
    .select2{
        background-color: lightgrey;

    }
</style>

<div class="content-wrapper">
    <hr>
    <div class="page-content">
        <form action="?c=todo&a=store" method="post" enctype="multipart/form-data">
            <input type="hidden" name="creator_id" value="<?php echo $admin_info->id?>">
            <div class="form-group">
                <label for="inputName">زیباجو</label>
           
                <select name="chat_code" id="customerid" class="select iransans w-100 rtl select2">
                    <option value="default">یک زیباجو را انتخاب کنید...</option>
                    <?php

                    foreach ($customers as $user){
                        $name = !empty($user["lastName"]) ? $user["firstName"].' '.$user["lastName"] : "ناشناس با کد " . $user["code"];
                        echo '<option value="'.$user["chat_code"].'">'.$name.'</option>';

                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="inputDescription">یادآوری کن در تاریخ : </label>
                <input type="text" id="dateinputtt" name="due_date_jalali" class="select" placeholder="تاریخ را انتخاب کنید...">
            </div>
            <div class="form-group">
                <label for="inputDescription">در ساعت </label>
                <input type="number" name="hour" max="23" min="00"
                       onchange="if(parseInt(this.value,10)<10)this.value='0'+this.value;"
                       placeholder="یک ساعت را انتخاب کنید...">
                <label for="inputDescription"> و دقیقه </label>
                <input type="number" name="minute" max="59" min="00"
                       onchange="if(parseInt(this.value,10)<10)this.value='0'+this.value;"
                       placeholder="یک دقیقه را انتخاب کنید...">
            </div>
            <label for="message">که :</label>
            <textarea name="message" id="" class="w-100 curve-border" rows="5" placeholder="توضیحات تکمیلی ..."></textarea>
            <input type="submit" value="ایجاد" class="btn btn-success" name="ایجاد">

        </form>
        <!-- /.content -->
    </div>
</div>
<!-- /.content-wrapper -->
<script src="../assets/js/kamadatepicker.min.js"></script>
<script>
    kamaDatepicker('dateinputtt', {
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





