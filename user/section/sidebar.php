
<nav class="sidebar sidebar-offcanvas " id="sidebar">
    <ul class="nav rtl m-0 p-0" >
        <li class="nav-item nav-profile border-bottom">
            <a href="#" class="nav-link flex-column">
                <div class="nav-profile-image">
                    <img src="<?php echo !empty($loggedUser_pic) ? $loggedUser_pic : "../global_assets/images/noimage.jpg";?>" alt="profile" class="shadow"/>
                    <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex ml-0 mb-3 flex-column">
                    <span class="font-weight-semibold mb-1 mt-2 text-center"><?php echo $userName?></span>


                    <span class="text-secondary icon-sm text-center">
                        <i class="mdi mdi-bookmark-plus menu-icon color-danger"></i>
                        <?php echo number_format($totalPayment);?>
                        ریال
                    </span>
                </div>
            </a>
        </li>
        <li class="nav-item pt-3">
            <a class="nav-link d-block" href="/user">
                <img class="sidebar-brand-logo" src="../global_assets/images/tootfarangeePlus-logo.jpg" alt="" />
                <img class="sidebar-brand-logomini" src="../global_assets/images/mini-logo.png" alt="" />
            </a>

        </li>

        <li class="nav-item">
            <a class="nav-link" href="/user?c=index&a=index">
                <i class="mdi mdi-compass-outline menu-icon"></i>
                <span class="menu-title">پیشخوان</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#services" aria-expanded="false" aria-controls="services">
                <i class="mdi mdi-heart-outline menu-icon"></i>
                <span class="menu-title">خدمات من</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse rtl" id="services">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="?c=users&a=tasksList">لیست</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?c=users&a=doneTasks">انجام شده</a>
                    </li>

                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#invoices" aria-expanded="false" aria-controls="invoices">
                <i class="mdi mdi-playlist-check menu-icon"></i>
                <span class="menu-title">صورتحساب ها</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse rtl" id="invoices">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="?c=users&a=unpaidInvoices">تسویه نشده</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?c=users&a=doneInvoices">تسویه شده</a>
                    </li>

                </ul>
            </div>
        </li>
<!--        <li class="nav-item">-->
<!--            <a class="nav-link" data-toggle="collapse" href="#messages" aria-expanded="false" aria-controls="messages">-->
<!--                <i class="mdi mdi-message-outline menu-icon"></i>-->
<!--                <span class="menu-title">صندوق پیام</span>-->
<!--                <i class="menu-arrow"></i>-->
<!--            </a>-->
<!--            <div class="collapse rtl" id="messages">-->
<!--                <ul class="nav flex-column sub-menu">-->
<!--                    <li class="nav-item">-->
<!--                        <a class="nav-link" href="?c=users&a=sendMessage">ایجاد</a>-->
<!--                    </li>-->
<!--                    <li class="nav-item">-->
<!--                        <a class="nav-link" href="?c=ticket&a=ticketsList">لیست</a>-->
<!--                    </li>-->
<!---->
<!--                </ul>-->
<!--            </div>-->
<!--        </li>-->
<!--        <li class="nav-item">-->
<!--            <a class="nav-link" data-toggle="collapse" href="#profile" aria-expanded="false" aria-controls="profile">-->
<!--                <i class="mdi mdi-face-profile menu-icon"></i>-->
<!--                <span class="menu-title">پروفایل</span>-->
<!--                <i class="menu-arrow"></i>-->
<!--            </a>-->
<!--            <div class="collapse rtl" id="profile">-->
<!--                <ul class="nav flex-column sub-menu">-->
<!--                    <li class="nav-item">-->
<!--                        <a class="nav-link" href="?c=users&a=readProfile">ویرایش پروفایل</a>-->
<!--                    </li>-->
<!--                    <li class="nav-item">-->
<!--                        <a class="nav-link" href="?c=users&a=readPass">تغییر رمز عبور</a>-->
<!--                    </li>-->
<!---->
<!--                </ul>-->
<!--            </div>-->
<!--        </li>-->
        <li class="nav-item">
            <a class="nav-link" href="/user?c=users&a=rules">
                <i class="mdi mdi-compass-outline menu-icon"></i>
                <span class="menu-title">قوانین و مقررات</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#account" aria-expanded="false"
               aria-controls="account">
                <i class="mdi mdi-playlist-check menu-icon"></i>
                <span class="menu-title">
                    حساب کاربری
                </span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse rtl" id="account">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="?c=users&a=editPassword">
                            ویرایش رمز عبور
                        </a>
                    </li>


                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link text-danger"  href="?c=users&a=logout" >
                <i class="mdi mdi-power menu-icon text-danger"></i>
                <span class="menu-title text-danger">خروج</span>
            </a>
        </li>

    </ul>
</nav>