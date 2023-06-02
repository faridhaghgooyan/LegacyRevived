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
        <span class="iransans font-1-rem d-inline">فاکتور های صادر شده</span>
        <hr>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>شماره فاکتور</th>
                <th>مبلغ (ریال)</th>
                <th>برای</th>
                <th>وضعیت</th>
                <th>تاریخ ایجاد</th>
                <th>ساعت ایجاد</th>
                <th>کنترل</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 1; foreach ($invoices as $invoice):?>
                <?php
                $payment = 0;
                foreach ($user_obj->invoice_payments($invoice['unique_id']) as $item){
                    $payment = $payment + (int)$item['price'];
                }
                ?>
                <tr class="d-flex align-items-self">
                    <td><?php echo $i?></td>
                    <?php if ($payment == 0): ?>
                        <td style="color: red"><?php echo $invoice['unique_id']?></td>
                    <?php else: ?>
                        <td style="color: orange"><?php echo $invoice['unique_id']?></td>

                    <?php endif; ?>
                    <td><?php echo number_format($invoice['price'])?></td>
                    <td><?php
                        echo $user_obj->find($invoice['customer_id'])['firstName'] . ' ' . $user_obj->find($invoice['customer_id'])['lastName'];


                        ?></td>
                    <td>

                        <input type="range" min="0" max="<?php echo $invoice['price'];?>" value="<?php echo $payment;?>" disabled>
                        <?php
                            if ($invoice['status'] == 0){
                                echo 'تسویه نشده';
                            } else {
                                echo 'تسویه شده';
                            }
                        ?></td>
                    <td><?php echo $dateConvertor_obj->dateConvert($invoice['created_at'])[0]["date"]; ?></td>
                    <td><?php echo $dateConvertor_obj->dateConvert($invoice['created_at'])[0]["time"]; ?></td>
                    <td>

                        </abbr>
                        <abbr title="حدف فاکتور">
                            <a href="?c=users&a=deleteInvoice&id=<?php echo $invoice['id']?>" class="btn btn-danger btn-sm" >
                                <i class="fas fa-trash"></i>
                            </a>
                        </abbr>


                    </td>
                </tr>
                <?php $i++;endforeach; ?>

            </tbody>
        </table>

    </div>
    <div>
        <span style="color: red">رنگ قرمز به معنای نداشتن هیچ پیش پرداختی میباشد.</span>
        <br>
        <span style="color: orangered">رنگ نارنجی به معنای داشتن حداقل یک پیش پرداخت و عدم ارائه خدمت میباشد.</span>
    </div>


    <!-- Require Modals -->
    <?php require 'section/modals.php';?>


</section>

<script src="../assets/js/users.js"></script>
<script src="../global_assets/js/chat.js"></script>
