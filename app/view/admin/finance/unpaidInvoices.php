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
        <span class="iransans font-1-rem d-inline">بدون پیش پرداختی</span>
        <hr>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>شماره فاکتور</th>
                <th>ایجاد کننده</th>
                <th>شماره وظیفه</th>
                <th>مبلغ (ریال)</th>
                <th>برای</th>
                <th>وضعیت</th>
                <th>تاریخ وظیفه</th>
                <th>کنترل</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 1; foreach ($invoices as $invoice):?>
                <?php if ($invoice['invoice_status'] == 0): ?>
                    <tr class="d-flex align-items-self">
                        <td><?php echo $i?></td>
                        <td><?php echo $invoice['unique_id']?></td>
                        <td><?php echo $invoice['first_name'].' '.$invoice['last_name']?></td>
                        <td><?php echo $invoice['unique_id']?></td>
                        <td><?php echo number_format($invoice['final_price'])?></td>
                        <td><?php echo $invoice['firstName'].' '.$invoice['lastName']?></td>

                        <td><?php
                            switch ($invoice['invoice_status']){
                                case  0:
                                    echo 'بدون پیش پرداخت';
                                    break;
                            }
                            ?></td>
                        <td><?php echo $invoice['created_at']?></td>
                        <td>
                            <!--
                            <abbr title="ویرایش اطلاعات">
                                <a href="?c=supporter&a=readTask&id=<?php echo $task['id']?>" class="btn btn-warning btn-sm"
                                   onclick="getChatHistory('<?php echo $chatFile;?>','<?php echo $username;?>','<?php echo $userID;?>')">
                                    <i class="fas fa-edit"></i>
                                </a>
    -->
                            </abbr>
                            <abbr title="حدف اطلاعات">
                                <a href="?c=supporter&a=deleteInvoice&id=<?php echo $invoice['id']?>" class="btn btn-danger btn-sm" >
                                    <i class="fas fa-trash"></i>
                                </a>
                            </abbr>


                        </td>
                    </tr>
                <?php endif; ?>
            <?php $i++;endforeach; ?>

            </tbody>
        </table>

    </div>


    <!-- Require Modals -->
    <?php require 'section/modals.php';?>


</section>

<script src="../assets/js/users.js"></script>
<script src="../global_assets/js/chat.js"></script>
