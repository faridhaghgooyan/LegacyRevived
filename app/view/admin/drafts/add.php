<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <hr>
    <div class="page-content">


        <!-- Main content -->
        <section class="content">
            <div class="row">
                <i class="fas fa-users font-1-rem d-inline"></i>
                <span class="iransans font-1-rem d-inline">ایجاد پیام پیش نویس</span>
                <hr>
                    <div class="col-md-6">
                        <form action="index.php?c=drafts&a=create" method="POST" enctype="multipart/form-data">
                            <div class="card card-primary">
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="text">متن </label>
                                        <textarea name="text" class="form-control" rows="4" maxlength="1000"></textarea>
                                    </div>

                                </div>
                                <!-- /.card-body -->
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <a href="?c=sms&a=list" class="btn btn-secondary">لغو</a>
                                    <input type="submit" value="ایجاد" class="btn btn-success float-right">
                                </div>
                            </div>
                        </form>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-6">
                        <h5>راهنما</h5>
                        <ol class="bg-light">
                            <li>سعی کنید پیام بیش از 1000 کاراکتر نباشد.</li>
                            <li>از درج لینک در متن پیامک خود داری کنید.</li>
                        </ol>
                        <!-- /.card -->
                    </div>
            </div>


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