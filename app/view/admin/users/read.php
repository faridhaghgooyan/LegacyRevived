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
                <span class="iransans font-1-rem d-inline">ویرایش زیباجو</span>
                <hr>
                <form action="index.php?c=users&a=userUpdate" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">

                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputName">نام</label>
                                    <input type="text" name="firstName" class="form-control"
                                        <?php if ($userInfo['firstName']){echo 'disabled';}?>
                                           value="<?php echo $userInfo['firstName'];?>">
                                </div>
                                <div class="form-group">
                                    <label for="inputName">نام خانوادگی</label>
                                    <input type="text" name="lastName" class="form-control"
                                        <?php if ($userInfo['lastName']){echo 'disabled';}?>
                                           placeholder="اجباری میباشد" value="<?php echo $userInfo['lastName'];?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">جنسیت</label>
                                    <br>
                                    <label for="age1">مرد
                                        <input type="radio" id="age1" name="gender" <?php if ($userInfo['gender']){echo 'disabled';}?>
                                               value="male" <?php if($userInfo['gender'] == 'male'){echo 'checked';}?>>
                                    </label>
                                    <br>
                                    <label for="age1">زن
                                        <input type="radio" id="age2" name="gender" <?php if ($userInfo['gender']){echo 'disabled';}?>
                                               value="female" <?php if($userInfo['gender'] == 'female'){echo 'checked';}?>>
                                    </label><br>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">شماره همراه</label>
                                    <input type="text" name="mobile" class="form-control"
                                        <?php if ($userInfo['gender']){echo 'mobile';}?>
                                           value="<?php echo $userInfo['mobile'];?>"
                                           placeholder="فرمت صحیح : 0912482XXXX" minlength="11" maxlength="11">
                                </div>
                                <div class="form-group">
                                    <label for="inputName">شماره همراه دوم</label>
                                    <input type="text" name="mobile_2" class="form-control" value="<?php echo $userInfo['mobile_2'];?>"
                                           oninput="checkMobile2()" <?php if ($userInfo['mobile_2']){echo 'disabled';}?>
                                           placeholder="فرمت صحیح : 0912482XXXX" minlength="11" maxlength="11" >
                                </div>
                                <div class="form-group">
                                    <label for="inputName">استان</label>
                                    <select id="provinces" class="provinces w-100 select2" name="province_id"
                                            onchange="getCities('provinces','cities')" required>
                                        <option value="default">یک استان را انتخاب کنید...</option>
                                        <?php foreach ($provinces as $province) :?>
                                            <option class=""
                                                <?php if($userInfo['province_id'] == $province['id']){echo 'selected';}?>
                                                    value="<?php echo $province['id'];?>"
                                                    data-province_id="<?php echo $province['id'];?>"
                                                    onselect="getCities()"
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
                                        <option value="default">یک شهر را انتخاب کنید...</option>
                                        <?php foreach ($cities as $city) :?>
                                            <option class=""
                                                <?php if($userInfo['city_id'] == $city['id']){echo 'selected';}?>
                                                    value="<?php echo $city['id'];?>"
                                            >
                                                <?php echo $city['name'];?>
                                            </option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <?php
                                $access = '';
                                if ($admin_info->roll_title == 'consultant'){
                                    $access = 'disabled';
                                }
                                ?>
                                <div class="form-group">
                                    <label for="inputName">مشاور ؟</label>
                                    <br>
                                    <select <?php echo $access?>  class="provinces w-100 select2" name="consultant_id" required>
                                        <option value="default">یک مشاور را انتخاب کنید...</option>
                                        <?php foreach ($consultants as $consultant) :?>
                                            <option class=""
                                                <?php if($userInfo['consultant_id'] == $consultant['id']){echo 'selected';}?>
                                                    value="<?php echo $consultant['id'];?>"
                                                    data-province_id="<?php echo $consultant['id'];?>"
                                                    onselect="getCities()"
                                            >
                                                <?php echo $consultant['first_name'].' '.$consultant['last_name'].' - '.$consultant['nick_name'];?>
                                            </option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <label for="inputName">لینک اختصاصی </label>
                                <br>
                                <input id="userKey" type="text" disabled" class="w-50"
                                       value="<?php echo $userInfo['link'];?>">
                                <a onclick="copyToClipboard()" class="btn btn-primary mt-2">
                                    <i class="fa fa-copy"></i>
                                </a>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="inputName" style="color: red">یادداشت برای مشاور </label>
                                <br>
                                <textarea name="comment" class="w-100 border" rows="3" placeholder="توضیحات تکمیلی مثل ساعت تماس مورد نظر زیباجو "><?php echo $userInfo['comment'];?></textarea>
                            </div>
                        </div>
                        <!-- /.card -->
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