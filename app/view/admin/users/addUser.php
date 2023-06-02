<style>
    input , select , textarea{
        border-radius: 10px!important;
    }
</style>
<div class="content-wrapper">
    <hr>
    <div class="page-content">
        <section class="content">
            <div class="row">
                <i class="fas fa-users font-1-rem d-inline"></i>
                <span class="iransans font-1-rem d-inline">ایجاد زیباجو</span>
                <hr>
                <form action="index.php?c=users&a=storeUser" method="POST" enctype="multipart/form-data">
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputName">نام</label>
                                    <input type="text" name="firstName" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="inputName">نام خانوادگی</label>
                                    <input type="text" name="lastName" class="form-control" placeholder="اجباری میباشد" required>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">جنسیت</label>
                                    <br>
                                    <label for="age1">مرد
                                        <input type="radio" id="age1" name="gender" value="male" required>
                                    </label>
                                    <br>
                                    <label for="age1">زن
                                        <input type="radio" id="age2" name="gender" value="female" required>
                                    </label><br>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">شماره همراه</label>
                                    <input type="text" name="mobile" class="form-control" oninput="checkMobile()"
                                           placeholder="فرمت صحیح : 0098912482XXXX" minlength="11" maxlength="14" required>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">شماره همراه دوم</label>
                                    <input type="text" name="mobile_2" class="form-control" oninput="checkMobile2()"
                                           placeholder="فرمت صحیح : 0098912482XXXX" minlength="11" maxlength="14" >
                                </div>
                                <div class="form-group">
                                    <label for="inputName">استان</label>
                                    <select id="provinces" class="provinces w-100 select2" name="province_id"
                                            onchange="getCities()" required>
                                        <option value="0">یک استان را انتخاب کنید...</option>
                                        <?php foreach ($provinces as $province) :?>
                                            <option class=""
                                                    value="<?php echo $province['id'];?>"
                                                    data-province_id="<?php echo $province['id'];?>"
                                            >
                                                <?php echo $province['name'];?>
                                            </option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">شهر</label>
                                    <br>
                                    <select name="city_id" id="cities" class="w-100 select2" required>
                                        <option value="0">یک شهر را انتخاب کنید...</option>
                                    </select>
                                </div>
                                <?php if ($admin_info->roll_id != 5) :?>
                                <div class="form-group">
                                    <label for="inputName">مشاور ؟</label>
                                    <br>
                                <?php
                                ?>
                                    <select name="consultant_id" id="" class="w-100" required>
                                        <option value="" disabled selected>یک مشاور انتخاب کنید...</option>
                                        <?php foreach ($consultants as $item): ?>
                                            <option value="<?php echo $item['id']?>"><?php echo $item['first_name'].' '.$item['last_name'].' - '.$item['nick_name']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <label for="inputName">لینک اختصاصی </label>
                                <br>
                                <?php $code =  rand()?>
                                <input id="userKey" type="text" class="w-50"
                                       value="https://clog.tootfarangee.com/guest.php?link=<?php echo $code?>">
                                <input type="hidden" name="link" class="w-50"
                                       value="<?php echo $code?>">
                                <input type="hidden" name="chat_code" class="w-50"
                                       value="<?php echo $code?>">
                                <a onclick="copyToClipboard('userKey')" class="btn btn-primary mt-2">
                                    <i class="fa fa-copy"></i>
                                </a>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="inputName" style="color: red">یادداشت برای مشاور </label>
                                <br>
                                <textarea name="comment" class="w-100 border" rows="3" placeholder="توضیحات تکمیلی مثل ساعت تماس مورد نظر زیباجو "><?php if ($admin_info->roll_title == 'site_admin'){ echo "یادداشتِ مهتا:  ";} ?></textarea>
                            </div>
<!--                            <div class="card-body">-->
<!--                                <div class="form-group">-->
<!--                                    <label for="exampleInputFile">File input</label>-->
<!--                                    <div class="input-group">-->
<!--                                        <div class="custom-file">-->
<!--                                            <input type="file" class="custom-file-input" name="profilepic" id="profilepic">-->
<!--                                            <label class="custom-file-label" for="profilepic">Choose file</label>-->
<!--                                        </div>-->
<!--                                        <div class="input-group-append">-->
<!--                                            <span class="input-group-text" id="">Upload</span>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!---->
<!--                            </div>-->
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="?c=users&a=list" class="btn btn-secondary">لغو</a>
                    <input type="submit"  value="ایجاد" class="btn btn-success float-right">
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
