<div class="col-sm-12 stretch-card grid-margin h-50">
    <div class="card">
        <div class="card-body pb-0">
            <h4 class="card-title mb-0 rtl">فاکتور های تسویه نشده </h4>
        </div>
        <div class="card-body p-0 rtl">
            <div class="table-responsive">
                <table class="table custom-table text-dark">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>شماره فاکتور</th>
                        <th>عنوان</th>
                        <th class="font-weight-bold">مبلغ کل (تومان)</th>
                        <th>مانده حساب</th>
                        <th>تاریخ صدور</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=1;foreach ($invoices as $invoice) :?>
                        <?php
                            $payments = $invoices_obj->total_payments($invoice['unique_id']);
                            $total_payment = 0;
                            foreach ($payments as $payment){
                                $total_payment += $payment['price'];
                            }
                        ?>
                        <tr>
                            <td> <?php echo $i;?> </td>
                            <td># <?php echo $invoice["unique_id"];?> </td>
                            <td><?php echo $invoice["subject"];?> </td>
                            <td> <?php echo number_format($invoice['final_price']);?> </td>
                            <td>
                                <?php
                                    if ($total_payment != $invoice['final_price']){
                                        echo '<p class="badge badge-danger">'.
                                            number_format($invoice['final_price'] - $total_payment)
                                            .' -</p> ';
                                    } else {
                                        echo '<p class="badge badge-success">تسویه شده</p> ';
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    echo $dateConvertor_obj->date_convert($invoice['created_at'],'jalali')[0]['date'];
                                ?>
                            </td>
                            <td>
                                <?php if ($total_payment != $invoice['final_price']) : ?>
                                    <a href="?c=users&a=pay&id=<?php echo $invoice['unique_id']?>" class="btn btn-success">پرداخت</a>
                                <?php endif; ?>
                            </td>


                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>