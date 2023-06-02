<link rel="stylesheet" href="../assets/css/chats.css">
<style>
    .bg-whatsapp{
        min-height: 250px;
        max-height: 60vh;
        overflow: auto;
        background-image: url("../storage/chatbackground.jpg");
        background-repeat: repeat;
        background-size: 210px;
        border-radius: 10px;
        padding: 10px;
    }
    .drComment{
        width: 100%;
        border-radius: 10px;
        margin: 10px 0px;
        min-height: 100px;
        padding: 10px;
        border: 1px solid lightgrey;
    }
</style>
<section class="content-wrapper">
    <hr>
    <div class="page-content">
        <i class="fas fa-user-md font-1-rem d-inline"></i>
        <span class="iransans font-1-rem d-inline">لیست پیام</span>
        <a href="?c=drafts&a=add">+پیام جدید</a>
        <hr>
        <table class="table table-striped myTable">
            <thead>
            <tr>
                <th>#</th>
                <th>کد یکتا</th>
                <th>زیباجو</th>
                <th>موضوع</th>
                <th>مبلغ کل</th>
                <th>مبلغ پیش</th>
                <th>وضعیت</th>
                <th>تاریخ ایجاد</th>
                <th>کنترل</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 1; foreach ($invoices as $invoice):?>
                <tr class="d-flex align-items-self">
                    <td><?php echo $i?></td>
                    <td>#<?php echo $invoice['unique_id']?></td>
                    <td><?php echo $invoice['firstName'].' '.$invoice['lastName']?></td>

                    <td><?php echo $invoice['subject']?></td>
                    <td><?php echo number_format($invoice['final_price'])?> ت</td>
                    <td><?php echo number_format($invoice['min_price'])?> ت</td>
                    <td>
                        <?php
                        switch ($invoice['status']){
                            case '0':
                                echo '<p class="badge badge-danger">عدم پرداختی</p>';
                                break;
                            case '1':
                                echo '<p class="badge badge-warning">پیش پرداخت</p>';
                                break;
                            case '2':
                                echo '<p class="badge badge-primary">آماده عمل</p>';
                                break;
                            case '3':
                                echo '<p class="badge badge-success">تسویه شده</p>';
                                break;
                        }
                        ?>

                    </td>
                    <td><?php echo $dateCovert->dateConvert($invoice['created_at'])[0]['date'].' - '.
                            $dateCovert->dateConvert($invoice['created_at'])[0]['time']
                        ;?></td>
                    <td>
                        <?php
                        $access = array('admin','site_admin','consultant','finance');
                        if (in_array($admin_info->roll_title,$access)) :
                        ?>
                        <abbr title="ویرایش اطلاعات">
                            <a href="?c=invoices&a=read&id=<?php echo $invoice['unique_id']?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                        </abbr>
                        <?php endif; ?>
                        <abbr title="حدف اطلاعات">
                            <a href="?c=invoices&a=delete&id=<?php echo $invoice['unique_id']?>" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i>
                            </a>
                        </abbr>


                    </td>
                </tr>
                <?php $i++;endforeach; ?>

            </tbody>
        </table>

    </div>


    <!-- Require Modals -->
    <?php require 'section/modals.php';?>


</section>

<script src="../assets/js/users.js"></script>
<script src="../global_assets/js/chat.js"></script>
