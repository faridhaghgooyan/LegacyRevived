<div class="col-md-12 grid-margin stretch-card rtl">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">ویرایش رمز عبور </h4>
            <hr>
            <form class="forms-sample" action="?c=users&a=changePass" method="post" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="exampleInputUsername1">رمز عبور</label>
                            <input type="password" name="password" class="form-control"  />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername1">تکرار رمز عبور</label>
                            <input type="password" name="doublePassword" class="form-control" onkeypress="checkPass()"  />
                        </div>

                        <button id="submitbtn" disabled  type="submit" class="btn btn-primary mr-2"> تغییر </button>
                        <a href="?c=index&a=index" class="btn btn-light">منصرف شدم</a>
                    </div>
                    <div class="col-sm-6 text-right">
                        <ol>
                            <h5>نکاتی در خصوص  تغییر رمز عبور</h5>
                            <li class="text-danger">حداقل کاراکتر مجاز 8 میباشد</li>
                            <li>توصیه میشود از حروف کوچک و بزرگ استفاده کنید</li>
                            <li>از کاراکتر های ویژه استفاده کنید</li>
                            <li>هر 3 ماه نسبت به تغییر رمز عبور خود اقدام کنید</li>
                        </ol>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<script>
    function checkPass(){

        setInterval(function (){
            let password = $('input[name=password]').val();
            let doublePass = $('input[name=doublePassword]').val();
            if (password === doublePass ){
                $('#submitbtn').prop("disabled",false);
            } else {
                $('#submitbtn').prop("disabled",true);
            }
        },100);
        alert(doublePass);

    }
</script>