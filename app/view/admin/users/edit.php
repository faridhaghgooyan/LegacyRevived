<!-- Content Wrapper. Contains page content -->
<link rel="stylesheet" href="dist/css/users.css">
<div class="content-wrapper">
    <hr>
    <div class="page-content">


        <!-- Main content -->
        <section class="content">
            <div class="row">
                <i class="fas fa-user-md font-1-rem d-inline"></i>
                <span class="iransans font-1-rem d-inline">ویرایش حساب کاربری</span>
                <hr>
                <form action="index.php?c=users&a=update" method="POST" enctype="multipart/form-data">
                    <div class="col-md-8">
                        <div class="card card-primary">
                            <input type="hidden" name="data[id]" class="form-control" value="<?php echo  $user['id'] ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputName">نام</label>
                                    <input type="text" name="data[firstName]" class="form-control" value="<?php echo  $user['firstName'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="inputName">نام خانوادگی</label>
                                    <input type="text" name="data[lastName]" class="form-control" value="<?php echo  $user['lastName'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="inputName">شماره همراه</label>
                                    <input type="text" name="data[mobile]" class="form-control" value="<?php echo  $user['mobile'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="inputName">ایمیل</label>
                                    <input type="text" name="data[email]" class="form-control" value="<?php echo  $user['email'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="inputDescription">بیوگرافی</label>
                                    <input type="text" class="form-control" name="data[bio]" value="<?php echo  $user['bio'] ?>">
                                </div>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-4 ">
                        <label for="">تصویر حساب کاربری</label>
                        <div class="uploadbox">

                            <?php $pic = '../'.$user['pic']; ?>
                            <div style="
                                background-image: url(<?php echo $pic?>);
                                background-size: cover;
                                background-position: center;
                                height: 10rem;
                                width: 10rem;
                                border-radius: 50%;
                                border: 1px solid #c8c8c8;
                                background-color: white;
                                margin-bottom: 20px;
                                " class="profilepic"> </div>
                            <div class="card card-secondary">

                                <div class="card-body uploadbtn">
                                    <div class="form-group">
                                        <label for="exampleInputFile">انتخاب تصویر جدید</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="profilepic" id="profilepic">
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="#" class="btn btn-secondary">لغو</a>
                    <input type="submit" value="ویرایش" class="btn btn-danger float-right">
                </div>
            </div>
            </form>

        </section>
        <!-- /.content -->
    </div>
</div>
<!-- /.content-wrapper -->
<script src="https://adminlte.io/themes/dev/AdminLTE/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>