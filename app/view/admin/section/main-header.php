<!-- Logo -->
<a href="" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini">پنل</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-sm"><b>Control Panel</b></span>
</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->

            <!-- Notifications: style can be found in dropdown.less -->
            <?php
            $access = array('site_admin','consultant');
            if (in_array($admin_info->roll_title,$access))
                :?>
                <?php if (isset($jobs)) :?>
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                            <span class="label label-danger"><?php echo count($jobs)?></span>

                    </a>
                    <ul class="dropdown-menu">

                        <?php foreach ($jobs as $job) : ?>
                            <?php
                            $code = $job['chat_code'];
                            $link = "usersChatList$code"; ?>
                            <li class='header'><a onclick="selectBox('<?php echo $link?>')">
                                    ساعت
                                    <?php echo $date_converter->date_convert($job['due_date'],'jalali')[0]['time'];?>
                                     |
                                    زیباجو :
                                    <?php echo !empty($job['firstName']).' '.$job['lastName'];?>
                                </a>
                            </li>
                        <?php endforeach; ?>

                    </ul>
                </li>
                <?php endif; ?>
            <?php endif; ?>

            <!-- Tasks: style can be found in dropdown.less -->
            <li>
                <a href="/admin/logout.php"><i class="fas fa-power-off font-1-rem text-danger"></i></a>
            </li>

            <!-- Control Sidebar Toggle Button -->

        </ul>
    </div>
</nav>