
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
<script src="../assets/js/kamadatepicker.min.js"></script>

<div class="content-wrapper">
    <hr>
    <div class="page-content">
        <form action="?c=todo&a=store" method="post" enctype="multipart/form-data">
            <input type="hidden" name="creator_id" value="<?php echo $loggedUser_id?>">
            <div class="form-group">
                <label for="inputName">زیباجو</label>
                <select name="customer_id" id="customerid" class="select iransans">
                    <option value="default">یک مراجعه کننده انتخاب کنید...</option>
                    <?php
                    foreach ($users as $user){
                        $name = $user["firstName"].' '.$user["lastName"];
                        echo '<option value="'.$user["id"].'">'.$name.'</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="inputDescription">یادآوری کن در تاریخ : </label>


                <input type="text" id="due-date" name="due_date_jalali" class="select" placeholder="تاریخ مراجعه را انتخاب کنید...">

            </div>
            <div class="form-group">
                <label for="inputDescription">در ساعت </label>

                <input type="time" class="d-inline" name="due_time" placeholder="12:00 AM...">
            </div>
            <label for="message">که :</label>
            <textarea name="message" id="" class="w-100 curve-border" rows="5" placeholder="توضیحات تکمیلی ..."></textarea>
            <input type="submit" value="ایجاد" class="btn btn-success" name="ایجاد">

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
    $("#element").persianDatepicker();
</script>
<script src="../assets/js/users.js"></script>
<script>
    kamaDatepicker('due-date', {
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


