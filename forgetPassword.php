<?php
//header('location:guest.php');

?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <title>کلینیک زیبایی توت فرنگی | فراموشی رمز عبور</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="global_assets/css/login.css" />
    <style>
        .swal2-styled.swal2-confirm {

            background-color: #e12b26!important;
            border-radius : 50px!important;
        }
    </style>
</head>
<body class="img js-fullheight" style="background-image: url(/global_assets/images/bg.jpg)">
<section class="ftco-section">
    <div class="container mt-5">
        <div class="row justify-content-center align-items-center  ">
            <div class="col-md-6 col-lg-4">
                <div class="login-wrap p-0" >
                    <!-- <h3 class="mb-4 text-center">حساب کاربری دارید ؟</h3> -->
                    <form  method="post" enctype="multipart/form-data" class="signin-form p-2" >
                        <div class="form-group">
                            <input
                                id="mobile"
                                type="text"
                                class="form-control"
                                placeholder="شماره همراه"
                                min="11" max="11"
                                required
                            />
                        </div>


                    </form>
                    <div class="form-group">
                        <button onclick="forgetPassword()"
                                type="submit"
                                class="form-control btn btn-primary submit px-3"
                        >
                            ارسال رمز عبور
                        </button>
                        <button
                            type="submit"
                            class="form-control btn mt-2 btn-outline-primary submit px-3"
                        >
                            <a href="/" >
                              بازگشت به صفحه قبل

                            </a>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<script src="global_assets/js/jquery.min.js"></script>
<script src="global_assets/js/popper.js"></script>
<script src="global_assets/js/bootstrap.min.js"></script>
<script src="global_assets/js/main.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    async function makeRequest(url, method, body) {
        try {
            let response = await fetch(url, {
                method,
                body
            })
            console.log(response)
            let result = await response.json();
            return result
        } catch(err) {
            console.error(err)
        }
    }



    async function forgetPassword() {
        var mobile = document.getElementById('mobile');
        if (mobile.value.length != 11){
            Swal.fire({
                title: 'خطا!',
                text: `شماره همراه نامعبر است`,
                icon: 'error',
                confirmButtonText: 'متوجه شدم'
            })
            throw new Error("my error message");
        }

        var body = new FormData()
        body.append("action", "forgetpassword")
        body.append("mobile", document.getElementById('mobile').value)
        let status = await makeRequest(`/app/controllers/api/request_handler.php`, "POST", body)
        console.log(status)
        if (status.error){
            Swal.fire({
                title: 'خطا!',
                text: `${status.error}`,
                icon: 'error',
                confirmButtonText: 'متوجه شدم'
            })
        }
        if (status.success) {
            Swal.fire({
                title: 'رمز عبور!',
                text: `${status.success}`,
                icon: 'success',
                confirmButtonText: 'متوجه شدم'
            });
            window.location.href = "/";
        }

    }

</script>
</body>
</html>
