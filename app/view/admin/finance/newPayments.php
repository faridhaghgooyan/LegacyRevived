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
        <span class="iransans font-1-rem d-inline">لیست پرداختی های جدید</span>
        <hr>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>به فاکتور</th>
                <th>کد پیگیری</th>
                <th>برای خدمت</th>
                <th>نوع پرداخت</th>
                <th>مبلغ (ریال)</th>
                <th>تاریخ واریز</th>
                <th>کنترل</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 1; foreach ($payments as $payment):?>

                <tr class="d-flex align-items-self">
                    <td><?php echo $i?></td>
                    <td><?php echo $payment['invoice_unqiueID']?></td>
                    <td><?php echo $payment['transaction_id']?></td>
                    <td><?php echo $payment['task_id']?></td>
                    <td><?php
                        switch ($payment['type']){
                            case 'ipg' :
                                echo 'پرداخت آنلاین';
                                break;
                            case 'pose' :
                                echo 'پرداخت دستگاه پوز';
                                break;
                            case 'cart' :
                                echo 'کارت به کارت';
                                break;                        }

                        ?></td>
                    <td><?php echo number_format($payment['price'])?></td>

                    <td><?php echo $payment['created_at']?></td>
                    <td>
                        <?php if (!$payment['accepted_by']): ?>
                        <abbr id="" title="تایید واریزی">
                            <form action="?c=finance&a=changeStatus&id=<?php echo $payment['id']?>" method="post">
                            <button href=""  class="btn btn-success btn-sm">
                                <input type="hidden" name="paymentStatus" value="accepted">
                                <i class="fas fa-check"></i>
                            </button>
                            </form>
                        </abbr>
                        <?php else: ?>
                            <abbr id="" title="لغو تایید واریزی">
                                <form action="?c=finance&a=changeStatus&id=<?php echo $payment['id']?>" method="post">
                                    <button href=""  class="btn btn-danger btn-sm">
                                        <input type="hidden" name="paymentStatus" value="rejected">
                                        <i class="fas fa-close"></i>
                                    </button>
                                </form>
                            </abbr>
                        <?php endif;?>


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
