<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <hr>
    <div class="page-content">


        <!-- Main content -->
        <section class="content">
            <div class="row">
                <i class="fas fa-users font-1-rem d-inline"></i>
                <span class="iransans font-1-rem d-inline">ایجاد عضو جدید برای تیم مدیریت</span>
                <hr>
                <form action="index.php?c=users&a=store" method="POST" enctype="multipart/form-data">
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputName">نام</label>
                                    <input type="text" name="firstName" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="inputName">نام خانوادگی</label>
                                    <input type="text" name="lastName" class="form-control">
                                </div>


                                <div class="form-group">
                                    <label for="inputName">شماره همراه</label>
                                    <input type="text" name="mobile" class="form-control">
                                </div>
                                <select name="roll_id" id="" class="iransans">
                                    <option value="">یک سطح مدیریتی انتخاب کنید...</option>
                                    <?php foreach ($rolls as $roll): ?>
                                        <?php if ($roll["id"] != '8' && $roll["id"] != '9') :?>?
                                            <option value="<?php echo $roll["id"]?>"><?php echo $roll["fa_title"]?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <div class="form-group">
                                    <label for="inputName">ایمیل</label>
                                    <input type="text" name="email" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">رمز عبور</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
<!--                                <div class="form-group">-->
<!--                                    <label for="inputDescription">بیوگرافی</label>-->
<!--                                    <textarea name="bio" class="form-control" rows="4"></textarea>-->
<!--                                </div>-->

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-6">
<!--                        <div class="card card-secondary">-->
<!--                            <div class="card-header">-->
<!--                                <h3 class="card-title">تصویر پروفایل</h3>-->
<!---->
<!--                            </div>-->
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
<!--                        </div>-->
                        <!-- /.card -->
                    </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="#" class="btn btn-secondary">لغو</a>
                    <input type="submit" value="ایجاد" class="btn btn-success float-right">
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

    $('.provinces').select2();
    $('#cities').select2();
</script>