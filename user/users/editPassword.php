<div class="bg-white border rounded p-3 pb-5 rtl">
    <h4>
        تغییر رمز عبور
    </h4>
    <hr>

    <p class="text-muted">
        <?php
            if ($user_info['password'] == null){
                echo "***جهت اطمینان بیشتر بهتر از یک رمز عبور ثابت مشخص کنید!";
            }
        ?>
    </p>
    <p class="text-muted">
        *** توجه داشته باشید با تغییر رمز عبور ، از دفعات بعد رمز یکبار مصرف ارسال شده کار نخواهد کرد.
    </p>
    <form action="?c=users&a=changePassword" method="POST" >
        <div class="form-row">
            <div class="col">
                <input type="password" name="password" class="form-control" placeholder="رمز عبور جدید" required>
            </div>
            <div class="col">
                <input type="password" name="confirm_password" class="form-control" placeholder="تکرار رمز عبور جدید" required>
            </div>
            <div class="col-2">
                <input type="submit" class="form-control btn-success" value="بروز رسانی">
            </div>
        </div>
    </form>
</div>

<script>
    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
        return false;
    };
    if (getUrlParameter('errCode')){
        let error_code = getUrlParameter('errCode');
        let response = fetch(`../app/controllers/api/errors_list.php?action=errorsList&errCode=${error_code}`)
            .then(response => response.json())
            .then(
                data => Swal.fire({
                    title: 'خطا!',
                    text: `${data}`,
                    icon: 'error',
                    confirmButtonText: 'متوجه شدم'
                })
            );
    }




</script>