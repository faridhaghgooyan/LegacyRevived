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
    .select{
        color: black;
        width: 100%;
        border: 1px solid lightgrey;
        border-radius: 10px;
        padding: 5px;
        transition: 0.5s;
        margin: 5px 0px;
    }
    .select:hover{
        cursor: pointer;
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
    }
</style>
<section class="content-wrapper">
    <hr>
    <div class="page-content">
        <i class="fas fa-user-md font-1-rem d-inline"></i>
        <span class="iransans font-1-rem d-inline">لیست وظایف</span>
        <hr>
        <div class="page-content row shadow" >
            <table class="table table-striped w-100 myTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>پروفایل</th>
                    <th>نام زیباجو</th>
                    <th>ایجاد شده توسط</th>
                    <th>شماره تراکنش</th>
                    <th>کد پیگیری ( مخصوص آنلاین)</th>
                    <th>مبلغ (ریال)</th>
                    <th>نوع پرداخت</th>
                    <th>پرداخت در</th>
                    <th>کنترل</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <?php $i = 1; foreach ($payments as $payment):?>
                    <?php if ($payment['accepted_by']): ?>
                <tr class="">
                    <td><?php echo $i?></td>
                    <td>
                        <img src="<?php echo $payment['pic']?>" width="50" height="50" class="profileImage">
                    </td>
                    <td> <?php echo $payment['firstName'].''.$payment['lastName'] ?> </td>
                    <td> <?php echo $payment['first_name'].''.$payment['last_name'] ?> </td>
                    <td>#<?php echo $payment['transaction_id']?></td>
                    <td><?php echo $payment['tracking_code']?></td>
                    <td><?php echo number_format($payment['price'])?></td>
                    <td><?php
                        switch ($payment['type']) {
                            case 'ipg' :
                                echo 'درگاه آنلاین';
                                break;
                            default:
                                echo 'شناسه واریز';
                                break;
                        }
                        ?></td>

                    <td><?php echo $dConverter->dateConvert($payment['created_at'])[0]["date"].' - '.
                            $dConverter->dateConvert($payment['created_at'])[0]["time"]
                        ; ?></td>
                    <td>
                        <?php if ($payment['accepted_by']) : ?>
                            <abbr title="حدف فاکتور">
                                <a href="?c=users&a=rejectPayment&id=<?php echo $payment['payment_id']?>" class="btn btn-danger btn-sm" >
                                    <i class="fas fa-close"></i>
                                </a>
                            </abbr>
                        <?php else: ?>

                            <abbr title="تایید فاکتور">
                                <a href="?c=users&a=acceptPayment&id=<?php echo $payment['payment_id']?>" class="btn btn-success btn-sm" >
                                    <i class="fas fa-check"></i>
                                </a>
                            </abbr>
                            <?php if ($payment['payment_fish']): ?>

                                <abbr title=" مشاهده فیش">
                                    <a href="<?php echo $payment['payment_fish']?>" target="_blank" class="btn btn-primary btn-sm" >
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </abbr>
                            <?php endif; ?>
                        <?php endif; ?>


                    </td>
                </tr>
                <?php endif; ?>
                <?php $i++;endforeach; ?>

                </tr>
                </tbody>
            </table>


        </div>

    </div>


    <!-- Require Modals -->
    <?php require 'section/modals.php';?>


</section>

<script src="../assets/js/users.js"></script>
<script src="../global_assets/js/chat.js"></script>
