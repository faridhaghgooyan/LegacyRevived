<script src="../global_assets/js/adminController.js"></script>
<section class="content-wrapper" style="padding: 20px">
    <div class="container-fluid">
        <div class="page-content col-sm-5 shadow">
            <i class="fas fa-users font-1-rem d-inline"></i>
            <span class="iransans font-1-rem d-inline">جدیدترین های تیم مدیریت</span>
            <hr>
            <table class="table table-striped ">
                <thead>
                <tr>
                    <th>#</th>
                    <th>نام مستعار</th>
                    <th>شماره همراه</th>
                    <th>کنترل</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1; foreach ($admins as $admin):?>
                    <tr class="">
                        <td><?php echo $i?></td>
                        <td><?php echo $admin['nick_name']?></td>
                        <td><?php echo $admin['mobile']?></td>
                        <td>
                            <abbr title="ویرایش حساب کاربری"><a href="?c=admin&a=edit&id=<?php echo $admin['id'];?>" class="btn btn-warning"><i class="fa fa-edit"></i></a></abbr>

                        </td>

                    </tr>
                    <?php $i++;endforeach; ?>

                </tbody>
            </table>

        </div>
        <div class="page-content col-sm-6 shadow">
            <i class="fas fa-users font-1-rem d-inline"></i>
            <span class="iransans font-1-rem d-inline">جدیدترین زیباجویان</span>
            <hr>
            <table class="table table-striped ">
                <thead>
                <tr>
                    <th>#</th>
                    <th>نام </th>
                    <th>شماره همراه</th>
                    <th>کنترل</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1; foreach ($users as $user):?>
                    <tr class="">
                        <td><?php echo $i?></td>
                        <td><?php echo $user['firstName'].' '.$user['lastName']?></td>
                        <td><?php echo $user['mobile']?></td>
                        <td>
                            <abbr title="ویرایش حساب کاربری"><a href="?c=users&a=edit&id=<?php echo $user['id'];?>" class="btn btn-warning"><i class="fa fa-edit"></i></a></abbr>

                        </td>

                    </tr>
                    <?php $i++;endforeach; ?>

                </tbody>
            </table>


        </div>
    </div>
    <!-- Doctor Section -->
<!--    <div class="container bg-white">-->
<!--        <div class="row bg-white">-->
<!--            <div class="page-content col-sm-12 shadow">-->
<!--                <i class="fas fa-users font-1-rem d-inline"></i>-->
<!--                <span class="iransans font-1-rem d-inline">لیست عمل های امروز</span>-->
<!--                <hr>-->
<!--                <table class="table table-striped">-->
<!--                    <thead>-->
<!--                    <tr>-->
<!--                        <th>#</th>-->
<!--                        <th>نام و نام خانوادگی</th>-->
<!--                        <th>تاریخ عمل</th>-->
<!--                        <th>ساعت عمل</th>-->
<!--                        <th>کنترل</th>-->
<!--                        <th>کنترل</th>-->
<!--                    </tr>-->
<!--                    </thead>-->
<!--                    <tbody>-->
<!--                    <tr class="d-flex align-items-self">-->
<!--                        <td>1</td>-->
<!--                        <td>فرید حقگویان</td>-->
<!--                        <td>1400/03/02</td>-->
<!--                        <td>14:50</td>-->
<!--                        <td>-->
<!--                            <a href="" class="btn btn-link bg-light">adssda</a>-->
<!--                            <a href="" class="btn btn-link bg-light">adssda</a>-->
<!--                            <a href="" class="btn btn-link bg-light">adssda</a>-->
<!--                            <a href="" class="btn btn-link bg-light">adssda</a>-->
<!--                        </td>-->
<!---->
<!--                    </tr>-->
<!---->
<!--                    </tbody>-->
<!--                </table>-->
<!---->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->

</section>