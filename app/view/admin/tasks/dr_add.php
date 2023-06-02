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

        <form action="index.php?c=tasks&a=dr_create" method="POST" enctype="multipart/form-data">
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <i class="fas fa-user-md font-1-rem d-inline"></i>
                    <span class="iransans font-1-rem d-inline">ایجاد وظیفه برای دکتر</span>
                    <hr>
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-body">
                                <!-- Creator -->
                                <input type="hidden" name="creator_id" value="<?php echo $admin_info->id?>">
                                <!-- Task Subject -->
                                <div class="form-group">
                                    <label for="inputName">برای شماره فاکتور</label>
                                    <input type="number" name="invoice_id" readonly value="<?php echo $_GET['id'];?>" class="w-100 select">
                                </div>
                                <div class="form-group">
                                    <label for="inputName">عنوان</label>
                                    <select name="title" id="customerid" class="select iransans">
                                        <option value="default">یک مورد را انتخاب کنید...</option>
                                        <option value="عمل">عمل</option>
                                        <option value="معاینه">معاینه</option>
                                    </select>
                                </div>
                                <!-- Users List -->
                                <div class="form-group">
                                    <label for="inputName">زیباجو</label>
                                    <?php if (isset($invoice['user_id'])) :?>
                                        <select name="customer_id" id="customerid" class="select iransans">
                                            <option value="default">یک مراجعه کننده انتخاب کنید...</option>
                                            <?php
                                            $name = $invoice["firstName"].' '.$invoice["lastName"];
                                            echo '<option selected value="'.$invoice['user_id'].'">'.$name.'</option>';
                                            ?>
                                        </select>

                                    <?php else: ?>
                                        <select name="customer_id" id="customerid" class="select iransans">
                                            <option value="default">یک مراجعه کننده انتخاب کنید...</option>
                                            <?php
                                            foreach ($users as $user){
                                                $name = $user["firstName"].' '.$user["lastName"];
                                                echo '<option value="'.$user["id"].'">'.$name.'</option>';
                                            }
                                            ?>
                                        </select>

                                    <?php endif; ?>

                                </div>
                                <!-- Nurses List -->
                                <div class="form-group">
                                    <label for="inputName">اختصاص به دکتر</label>
                                    <select name="adminuser_id" id="adminuserid" class="select iransans">
                                        <option value="default">به کدام دکتر اختصاص میدهید ؟</option>
                                        <?php foreach ($doctors as $doctor): ?>
                                            <?php if ($doctor['roll_id'] == 3): ?>
                                                <option value="<?php echo $doctor["id"]?>"><?php echo $doctor["first_name"].' '.$doctor["last_name"]?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>



                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>

                    </div>
                    <div class="col-sm-6">

                        <div class="form-group">
                            <label for="inputDescription">تاریخ مراجعه </label>

                            <input type="text" id="due-date" name="due_date_jalali" class="select" placeholder="تاریخ مراجعه را انتخاب کنید...">
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
                        <div class="form-group">
                            <label for="inputDescription">توضیحات تکمیلی</label>
                            <textarea name="comment" class="form-control supporter_comment" rows="4" placeholder="توضیحات تکمیلی همانند نکات ویژه ، شرایط رفت و آمد و ..."></textarea>
                        </div>

                    </div>


            </section>
            <hr>
            <div class="text-center">
                <a href="?c=supporter&a=list" class="btn btn-secondary">لغو</a>
                <input type="submit" value="ایجاد" class="btn btn-success float-right">
            </div>
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


