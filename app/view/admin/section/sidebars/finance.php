<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-right image">
            <img src="<?php echo $admin_info->profile;?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-right info">
            <p><?php echo $admin_info->nick_name?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> آنلاین</a>
        </div>
    </div>
    <ul class="sidebar-menu" data-widget="tree">
        <li class="header">منو های
            <?php echo $admin_info->roll_fa_title;?>
        </li>
        <li class="">
            <a href="?c=index&a=index">
                <i class="fa fa-files-o"></i>
                <span class="pull-left-container">
                        <small class="label pull-left bg-red" style="margin-left: 30px!important;">
                            <?php echo $new_payments;?>
                        </small>
                    </span>
                <span>پیشخوان</span>
            </a>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-tasks"></i> <span>صورتحساب ها</span>
                <!--                    <small class="label pull-left bg-green">جدید</small>-->
                <!--                    <span class="pull-left-container">-->
                <i class="fa fa-angle-right pull-left"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="?c=finance&a=unpaidInvoices"><i class="fa fa-circle-o"></i>بدون پیش پرداخت</a></li>

                <li><a href="?c=finance&a=invoicesList"><i class="fa fa-circle-o"></i>پیش پرداخت</a></li>
                <li><a href="?c=finance&a=oldInvoices"><i class="fa fa-circle-o"></i>تسویه شده</a></li>



            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-tasks"></i> <span>پرداخت ها</span>
                <i class="fa fa-angle-right pull-left"></i>
                </span>
            </a>
            <ul class="treeview-menu">

                <li><a href="?c=finance&a=acceptedPayments"><i class="fa fa-circle-o"></i>تایید شده</a></li>
            </ul>
        </li>
<!--        <li class="treeview">-->
<!--            <a href="#">-->
<!--                <i class="fa fa-clock"></i> <span>یادآور</span>-->
<!--                <i class="fa fa-angle-right pull-left"></i>-->
<!--            </a>-->
<!--            <ul class="treeview-menu">-->
<!--                <li><a href="?c=todo&a=add"><i class="fa fa-circle-o"></i>ایجاد</a></li>-->
<!--                <li><a href="?c=todo&a=list"><i class="fa fa-circle-o"></i>انجام نشده</a></li>-->
<!--                <li><a href="?c=todo&a=archive"><i class="fa fa-circle-o"></i>آرشیو</a></li>-->
<!--            </ul>-->
<!--        </li>-->
        <li class="">
            <a href="?c=users&a=logout&id=<?php echo $admin_info->id;?>">
                <i class="fa fa-files-o"></i>
                <span>خروج</span>
            </a>
        </li>

    </ul>
</section>