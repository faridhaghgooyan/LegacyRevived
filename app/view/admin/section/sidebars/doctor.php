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
                <span>پیشخوان</span>
            </a>
        </li>
        <!--            <li class="treeview">-->
        <!--                <a href="#">-->
        <!--                    <i class="fa fa-user"></i> <span>مراجعه کنندگان</span>-->
        <!--                    <!--                    <small class="label pull-left bg-green">جدید</small>-->-->
        <!--                    <!--                    <span class="pull-left-container">-->-->
        <!--                    <i class="fa fa-angle-right pull-left"></i>-->
        <!--                    </span>-->
        <!--                </a>-->
        <!--                <ul class="treeview-menu">-->
        <!--                    <li><a href="?c=doctors&a=add"><i class="fa fa-circle-o"></i>امروز</a></li>-->
        <!---->
        <!--                    <li><a href="?c=doctors&a=list"><i class="fa fa-circle-o"></i>لیست</a></li>-->
        <!---->
        <!--                </ul>-->
        <!--            </li>-->
        <li class="treeview">
            <a href="#">
                <i class="fa fa-tasks"></i> <span>مدیریت کارها</span>
                <!--                    <small class="label pull-left bg-green">جدید</small>-->
                <!--                    <span class="pull-left-container">-->
                <i class="fa fa-angle-right pull-left"></i>
                </span>
            </a>
            <ul class="treeview-menu">

                <li><a href="?c=doctors&a=tasks_list"><i class="fa fa-circle-o"></i>لیست کارهای بروز</a></li>
                <li><a href="?c=doctors&a=old_tasks"><i class="fa fa-circle-o"></i>آرشیو</a></li>

            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-users"></i> <span>زیباجویان</span>
                <!--                    <small class="label pull-left bg-green">جدید</small>-->
                <!--                    <span class="pull-left-container">-->
                <i class="fa fa-angle-right pull-left"></i>
            </a>
            <ul class="treeview-menu">

                <li><a href="?c=users&a=userEfile"><i class="fa fa-circle-o"></i>پرونده زیباجو</a></li>
            </ul>
        </li>




        <li class="">
            <a href="?c=users&a=logout&id=<?php echo $loggedUser_id;?>">
                <i class="fa fa-files-o"></i>
                <span>خروج</span>
            </a>
        </li>

    </ul>
</section>