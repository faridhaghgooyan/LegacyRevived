<!-- Content Wrapper. Contains page content -->
<style>
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

        <form action="index.php?c=tasks&a=task_update" method="POST" enctype="multipart/form-data">
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <i class="fas fa-user-md font-1-rem d-inline"></i>
                    <span class="iransans font-1-rem d-inline">ایجاد وظیفه برای پرستار</span>
                    <hr>
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-body">
                                <!-- Creator -->
                                <input type="hidden" name="creator_id" value="<?php echo $admin_info->id?>">
                                <input type="hidden" name="task_id" value="<?php echo $_GET['id']?>">

                                <!-- Task Subject -->
                                <div class="form-group">
                                    <label for="inputName">عنوان</label>
                                    <select name="title" id="customerid" class="select" required>
                                        <option value="default">یک مورد را انتخاب کنید...</option>
                                        <option value="معاینه" selected>معاینه</option>
                                    </select>
                                </div>
                                <!-- Users List -->
                                <div class="form-group">
                                    <label for="inputName">زیباجو</label>
                                    <select name="customer_id" id="customerid" class="select select2" required>
                                        <option value="default">یک مراجعه کننده انتخاب کنید...</option>
                                        <?php
                                        $select = '';

                                        foreach ($users as $user){
                                            if ($task['customer_id'] == $user['id']){
                                                $select = 'selected';
                                            }
                                            $name = $user["firstName"].' '.$user["lastName"];
                                            echo '<option '.$select.' value="'.$user["id"].'">'.$name.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <!-- Nurses List -->
                                <div class="form-group">
                                    <label for="inputName">اختصاص به پرستار</label>
                                    <select name="operator_id" id="operator_id" class="select" required>
                                        <option value="default">به کدام پرستار اختصاص میدهید ؟</option>
                                        <?php foreach ($nurses as $nurse): ?>
                                        <?php
                                            $select = '';
                                            if ($task['operator_id'] == $nurse['id']){
                                                $select = 'selected';
                                            }
                                            ?>
                                            <option <?php echo $select;?> value="<?php echo $nurse["id"]?>">
                                                <?php echo $nurse["first_name"].' '.$nurse["last_name"]?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>



                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>

                    </div>
                    <?php
                    $timestamp = strtotime($task['due_date_time']);
                    $hour = date('H:i:s',$timestamp);
                    $hour_obj = explode(':',$hour);

                    ;?>
                    <div class="col-sm-6">

                        <div class="form-group">
                            <label for="inputDescription">تاریخ مراجعه </label>

                            <input type="text" id="due-date" name="due_date_jalali" class="select"
                                   value="<?php echo $dConverter->dateConvert($task['due_date_time'])[0]['date']?>"
                                   placeholder="تاریخ مراجعه را انتخاب کنید..." required>
                        </div>
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
                        <div class="form-group">
                            <label for="inputDescription">توضیحات تکمیلی</label>
                            <textarea name="creator_comment" class="form-control supporter_comment"
                                      rows="4" placeholder="توضیحات تکمیلی همانند نکات ویژه ، شرایط رفت و آمد و ..."><?php echo $task['creator_comment']?></textarea>
                        </div>

                    </div>


            </section>
            <hr>
            <div class="text-center">
                <a href="?c=supporter&a=list" class="btn btn-secondary">لغو</a>
                <input type="submit" value="ویرایش" class="btn btn-success float-right">
            </div>
        </form>
        <!-- /.content -->
    </div>
</div>
<!-- /.content-wrapper -->
<script src="../assets/js/select2.min.js"></script>
<script>
    $('.select2').select2();

</script>
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


