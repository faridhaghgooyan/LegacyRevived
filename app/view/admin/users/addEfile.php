<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <hr>
    <div class="page-content">


        <!-- Main content -->
        <section class="content">
            <div class="row">
                <i class="fa fa-file font-1-rem d-inline"></i>
                <span class="iransans font-1-rem d-inline">ایجاد پرونده زیباجو</span>
                <a href="?c=users&a=userEfile" class="btn btn-info">لیست پرونده ها</a>
                <hr>

                <form action="?c=users&a=createEfile" method="post" enctype="multipart/form-data">
                    <div class="col-sm-6">
                        <label for="user_id">انتخاب زیباجو :</label>
                        <select name="user_id" id="user_id" class="w-100 iransans select2" required>
                            <option value="" disabled selected>یک کاربر انتخاب کنید...</option>
                            <?php foreach ($customers as $customer) : ?>
                                <?php if ($customer['details'] == NULL) : ?>
                                    <option value="<?php echo $customer['id'];?>"><?php echo $customer['lastName'];?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-sm-6">

                        <div class="row">
                            <div class="form-group">
                                <label for="date_input">اطلاعات عمومی : </label>
                                <input type="text" id="date_input" name="user_birthday" class="select w-100" placeholder="تاریخ مراجعه را انتخاب کنید..." tabindex="1" required>
                            </div>
                            <hr>
                            <label for="user_gendre">جنسیت : </label>
                            <select name="user_gendre" id="" class="w-100 iransans" required>
                                <option value="خانم" onclick="changeToWomen()">خانم</option>
                                <option value="آقا" onclick="changeToMan()">آقا</option>
                            </select>
                            <div id="forWomen">
                                <input type="number" name="user_pregnant_number" placeholder="تعداد بارداری" >
                                <input type="number" name="user_childbirth_number" placeholder="تعداد زایمان" >
                                <input id="user_last_childbirth" type="text" name="user_last_childbirth" placeholder="آخرین زایمان" >
                            </div>
                            <hr>
                            <input type="number" name="user_weight" class="d-inline" placeholder="وزن" tabindex="2" required>
                            <input type="number" name="user_height" class="d-inline" placeholder="قد" tabindex="3" required>
                            <input type="number" name="user_national_code" class="d-inline" placeholder="کد ملی" tabindex="4" min="0000000000" max="9999999999" required>
                            <hr>
                            <input type="text" name="user_father_name" class="d-inline" placeholder="نام پدر" tabindex="5" required>
                            <input type="text" name="user_job" class="d-inline" placeholder="شغل" tabindex="6" required>
                            <input type="text" name="user_home_phone" placeholder="تلفن ثابت" >
                            <hr>
                            <label class="w-100"> وضعیت تاهل :
                                <select name="user_has_married"  class="w-100 iransans" tabindex="7" required>
                                    <option value="متاهل" >متاهل</option>
                                    <option value="مجرد" >مجرد</option>
                                </select>
                            </label>
                            <hr>
                            <div class="form-group">
                                <label for="inputName">استان</label>
                                <select id="provinces" class="provinces w-100 iransans select2" name="province_id" onchange="getCities('provinces','cities')" tabindex="8">
                                    <option value="default">یک استان را انتخاب کنید...</option>
                                    <?php foreach ($provinces as $province) :?>
                                        <option class=""
                                                value="<?php echo $province['id'];?>"
                                                data-province_id="<?php echo $province['id'];?>"
                                                onselect="getCities()"
                                        >
                                            <?php echo $province['name'];?>
                                        </option>
                                    <?php endforeach;?>
                                </select required>
                            </div>
                            <div class="form-group">
                                <label for="inputName">شهر</label>
                                <select name="cities" id="cities" class="w-100 iransans select2" tabindex="9">
                                    <option value="default">یک استان را انتخاب کنید...</option>
                                </select required>
                            </div>
                            <input type="text" name="user_full_address" class="d-inline w-100" placeholder="آدرس کامل" tabindex="10" required>
                            <hr>
                            <input type="text" name="user_instagram_id" class="d-inline w-100" placeholder="آیدی اینستاگرام" tabindex="11" >
                            <hr>
                            <label for="inputName">سوابق بیماری :</label>
                            <br>
                            <?php foreach ($diseases as $dis) :?>
                                <input type="checkbox" name="user_diseases[]" value="<?php echo $dis['id']?>">
                                <?php echo $dis['title']?>
                            <?php endforeach; ?>
                            <br>
                            <label class="w-100"> سایر موارد :
                                <textarea name="user_other_diseases" class="w-100 mt-2" rows="2" placeholder="سایر موارد ، توضیح دهید ..."></textarea>
                            </label>
                            <hr>
                            <label class="w-100"> سابقه مصرف دارو ؟
                                <textarea name="user_has_drug" class="w-100 mt-2" rows="2" placeholder="سابقه مصرف دارو ؟ چه دارویی و به چه دوزی ؟ ، توضیح دهید ..."></textarea>
                            </label>
                            <label class="w-100"> سابقه بستری یا جراحی ؟
                                <textarea name="user_has_surgery" class="w-100 mt-2" rows="2" placeholder="سابقه بستری یا جراحی ؟ به چه دلیل و چه زمانی ؟ ، توضیح دهید ..."></textarea>
                            </label>
                            <label class="w-100"> سابقه بیماری خاص در خانواده ؟
                                <textarea name="user_has_family_surgery" class="w-100 mt-2" rows="2" placeholder="سابقه بیماری خاص در پدر و مادر یا خواهر و برادر ؟ چه بیماری ای ؟ ، توضیح دهید ..."></textarea>
                            </label>
                            <input type="submit" class="btn bg-tootfarangee" value="ثبت پرونده">

                        </div>

                    </div>
                </form>
            </div>

        </section>
        <!-- /.content -->
    </div>
</div>
<!-- /.content-wrapper -->
<script src="https://adminlte.io/themes/dev/AdminLTE/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="../assets/js/persianDatepicker.min.js"></script>

<script src="https://adminlte.io/themes/dev/AdminLTE/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<script src="../assets/js/users.js"></script>
<script src="../assets/js/kamadatepicker.min.js"></script>
<script>

    $('.select2').select2();
</script>
<script>
    kamaDatepicker('date_input', {
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
    kamaDatepicker('user_last_childbirth', {
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
<script src="../global_assets/js/userController.js"></script>