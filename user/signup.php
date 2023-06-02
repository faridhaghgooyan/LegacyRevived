
<?php
require_once 'section/header.php';
if (isset($_COOKIE['TF-Email'])){
    echo '<script>  window.location.replace("/user/index.php?c=index&a=index"); </script>';
}
?>
<link rel="stylesheet" href="../admin/assets/css/login.css">
<style>
    body,html,main{
        background-color: white!important;
    }
</style>
<main>
    <div class="container-fluid text-center shadow">
        <div class="row shadow">
            <div class="col-sm-6 login-section-wrapper bg-white shadow">
                <div class="brand-wrapper">
                    <img src="/storage/tootfarangeeplus.png" alt="Tootfrangee Clinic logo" class="logo" >
                </div>
                <div class="login-wrapper my-auto">
                    <!--                        <h1 class="login-title">ورود</h1>-->
                    <form action="index.php?c=users&a=signup" method="post" enctype="multipart/form-data" class="w-100">
                        <div class="form-group">
                            <label for="email">نام :</label>
                            <input type="text" name="firstName"  class="form-control" placeholder="نام شما">
                        </div>
                        <div class="form-group">
                            <label for="email">نام خانوادگی :</label>
                            <input type="text" name="lastName"  class="form-control" placeholder="نام خانوادگی شما">
                        </div>
                        <div class="form-group">
                            <label for="email">شماره همراه :</label>
                            <input type="tel" name="mobile" id="mobile" class="form-control" placeholder="09XXXXXXXXX">
                        </div>
                        <div class="form-group mb-4">
                            <label for="password">رمز عبور :</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="******">
                        </div>
                        <input name="login" id="login" class="btn btn-block login-btn" type="submit" value="عضویت">
                    </form>
                    <a href="#!" class="forgot-password-link">فراموشی رمز عبور</a>
                    <br>
                    <a href="login.php" class="forgot-password-link">ورود</a>

                </div>
            </div>
            <div class="col-sm-6 px-0 d-none d-sm-block bg-light shadow"
                 style="
                     background-image: url('/storage/usermes2.jpg');
                     background-position: center;
                     background-size: cover;

                        ">

            </div>
        </div>
    </div>
</main>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            )
        }
    }
</script>