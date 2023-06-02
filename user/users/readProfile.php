<div class="col-md-12 grid-margin stretch-card rtl">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">ویرایش پروفایل </h4>
            <hr>
            <form class="forms-sample" action="?c=users&a=changeProfile" method="post" enctype="multipart/form-data">

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="exampleInputUsername1">نام کوچک</label>
                        <input type="text" name="firstName" class="form-control" value="<?php echo $myself['firstName'];?>" />
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">نام خانوادگی</label>
                        <input type="text" name="lastName" class="form-control" value="<?php echo $myself['lastName'];?>" placeholder="Username" />
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">ایمیل</label>
                        <input type="text" name="email" class="form-control" value="<?php echo $myself['email'];?>" placeholder="Username" />
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">شماره همراه</label>
                        <input type="text" name="mobile" class="form-control" value="<?php echo $myself['mobile'];?>" placeholder="Username" />
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">بیوگرافی</label>
                        <input type="text" name="bio" class="form-control" value="<?php echo $myself['bio'];?>" placeholder="Username" />
                    </div>
                    <button type="submit" class="btn btn-primary mr-2"> تغییر </button>
                    <a href="?c=index&a=index" class="btn btn-light">منصرف شدم</a>
                </div>
                <div class="col-sm-6 text-center">
                    <img src="<?php echo $myself['pic'];?>" width="250" class="shadow">
                    <br><br>
                    <label for="inputFile">تغییر تصویر پروفایل</label>
                    <br>
                    <input id="inputFile" type="file" name="pic" value="change">
                    <input type="hidden" name="id" value="<?php echo $loggedUser_id;?>">
                </div>
            </div>
            </form>

        </div>
    </div>
</div>
