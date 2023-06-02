<?php require '../app/controllers/admin/supporter.php'?>
<section class="content-wrapper" style="padding: 20px">

    <div class="container-fluid">
        <div class="page-content row shadow" >
            <h4>پرداختی های جدید</h4>
            <hr>
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
                        <?php if (!$payment['accepted_by']): ?>
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

                        <td>
                            <?php

                            echo $dConverter->dateConvert($payment['payment_created_at'])[0]["date"].' - '.
                                $dConverter->dateConvert($payment['payment_created_at'])[0]["time"]
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
    <div class="container-fluid">
        <div class="page-content row shadow" >
            <h4>کنسلی های جدید</h4>
            <hr>
            <table class="table table-striped w-100 myTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>پروفایل</th>
                    <th>نام زیباجو</th>
                    <th>شماره فاکتور</th>
                    <th>کل واریزی ها</th>
                    <th>کنترل</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php $i = 1; foreach ($cancel_invoices as $cancel_invoice):?>
                            <tr class="">
                                <td><?php echo $i?></td>
                                <td>
                                    <img src="<?php echo $cancel_invoice['pic']?>" width="50" height="50" class="profileImage">
                                </td>
                                <td> <?php echo $cancel_invoice['firstName'].''.$cancel_invoice['lastName'] ?> </td>
                                <td>#<?php echo $cancel_invoice['unique_id']?></td>
                                <td><?php echo number_format($payments_obj->get_total_payment($cancel_invoice['unique_id'])['total_payment'])?></td>
                                <td>
                                    <abbr title="تسویه کردم">
                                        <a href="?c=invoices&a=clear&id=<?php echo $cancel_invoice['unique_id']?>" class="btn btn-success btn-sm" >
                                            تسویه کردم
                                            <i class="fas fa-tick"></i>
                                        </a>
                                    </abbr>
                                </td>
                            </tr>
                        <?php $i++;endforeach; ?>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
    <!-- Require Modals -->
</section>
