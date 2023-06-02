<?php
$valid = check_roll($admin_info->roll_title,array('admin'));
?>
<style>
    input , select , textarea{
        border-radius: 10px!important;
    }
</style>
<!--Extra Data-->
<div class="content-wrapper">

    <hr>
    <div class="page-content">
        <section class="content">
            <div class="row">
                <i class="fas fa-users font-1-rem d-inline"></i>
                <span class="iransans font-1-rem d-inline">ویرایش تیم مدیریت</span>
                <hr>
                <form action="index.php?c=admin&a=update" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">


                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputName">نام</label>
                                    <input type="text" name="first_name" class="form-control"
                                        <?php if ($admin['first_name']){echo $valid;}?>
                                        value="<?php echo $admin['first_name']?>">
                                </div>
                                <div class="form-group">
                                    <label for="inputName">نام خانوادگی</label>
                                    <input type="text" name="last_name" class="form-control" required
                                        <?php if ($admin['last_name']){echo $valid;}?>
                                           value="<?php echo $admin['last_name']?>">

                                </div>
                                <div class="form-group">
                                    <label for="inputName">نام مستعار</label>
                                    <input type="text" name="nick_name" class="form-control" required
                                        <?php if ($admin['nick_name']){echo $valid;}?>
                                           value="<?php echo $admin['nick_name']?>">
                                </div>
                                <div class="form-group">
                                    <label for="inputName">شماره همراه</label>
                                    <input type="text" name="mobile" class="form-control" oninput="check_number('mobile','admin')" required
                                        <?php if ($admin['mobile']){echo $valid;}?>
                                           value="<?php echo $admin['mobile']?>">
                                </div>
                                <div class="form-group">
                                    <label for="inputName">شماره ثابت</label>
                                    <input type="text" name="phone" class="form-control" oninput="check_number('phone','admin')"
                                        <?php if ($admin['phone']){echo $valid;}?>
                                           value="<?php echo $admin['phone']?>">
                                </div>
                                <div class="form-group">
                                    <label for="inputName">آدرس کامل</label>
                                    <input type="text" name="address" class="form-control"
                                        <?php if ($admin['address']){echo $valid;}?>
                                           value="<?php echo $admin['address']?>">
                                </div>
                                <select name="roll_id" id="" class="iransans w-100 select2"
                                    <?php if ($admin['address']){echo $valid;}?>
                                >
                                    <option value="">یک سطح مدیریتی انتخاب کنید...</option>
                                    <?php foreach ($rolls as $roll): ?>
                                        <?php if ($roll["id"] != '8' && $roll["id"] != '9') :?>?
                                            <option
                                                    <?php if ($roll["id"] == $admin['roll_id']){
                                                        echo 'selected';
                                                    } ?>
                                                    value="<?php echo $roll["id"]?>"><?php echo $roll["fa_title"]?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <div class="form-group">
                                    <label for="inputName">ایمیل</label>
                                    <input type="text" name="email" class="form-control" required
                                        <?php if ($admin['email']){echo $valid;}?>
                                           value="<?php echo $admin['email']?>">
                                </div>
                                <div class="form-group">
                                    <label for="inputName">رمز عبور</label>
                                    <input type="password" name="password" class="form-control" >
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-6">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h4 class="card-title">تصویر پروفایل</h4>
                                <img src="<?php echo $admin['profile']?>" alt="" width="200">
                            </div>
                            <div class="card-body">
                                <input type="file" class="custom-file-input" name="profilepic" id="profilepic">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="?c=users&a=list" class="btn btn-secondary">لغو</a>
                    <input type="submit" value="ویرایش" class="btn btn-success float-right">
                </div>
            </div>
            </form>

        </section>
        <!-- /.content -->
    </div>
</div>
<!-- /.content-wrapper -->
<script src="https://adminlte.io/themes/dev/AdminLTE/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="../assets/js/select2.min.js"></script>

<script>

    $('.select2').select2();
    $('#cities').select2();
</script>
<script>
    function checkMobile(){
        let mobile = $('input[name=mobile]').val();
        if (mobile.length === 11){
            $.ajax({
                url: '?api=adminChat&a=checkMobile&mobile='+mobile,
                method : 'post',
                dataType : 'json',
                success : function (result){
                    console.log(result);
                    if (result){
                        error_alert('این شماره همراه قبلا برای زیباجویی به نام '+result.lastName+' ثبت شده است!');
                        $('input[type=submit]').hide();

                    } else {
                        $('input[name=mobile]').css('border-color','##d2d6de');
                        $('input[type=submit]').show();
                    }
                },
                error : function (xhr){
                    console.log(xhr);
                }
            });
        }
    }
    function checkMobile2(){
        let mobile = $('input[name=mobile_2]').val();
        if (mobile.length === 11){
            $.ajax({
                url: '?api=adminChat&a=checkMobile&mobile='+mobile,
                method : 'post',
                dataType : 'json',
                success : function (result){
                    console.log(result);
                    if (result){
                        error_alert('این شماره همراه قبلا برای زیباجویی به نام '+result.lastName+' ثبت شده است!');
                        $('input[type=submit]').hide();

                    } else {
                        $('input[name=mobile]').css('border-color','##d2d6de');
                        $('input[type=submit]').show();
                    }
                },
                error : function (xhr){
                    console.log(xhr);
                }
            });
        }
    }

    function getCities(){
        let id = $('#provinces').val();
        $.ajax({
            url : '?api=adminChat&a=get_city&id='+id,
            method : 'get',
            dataType : 'json',
            success : function (result){
                console.log('result');
                console.log(result);
                $('#cities').html(result);


            },
            error : function (xhr){
                console.log(xhr);
            }
        })
    }

</script>