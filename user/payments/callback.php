<style>
    @media print {

        *:not('#printable') {
            display: none;
        }
        #sidebar , footer {
            display: none;

        }

    }
</style>
<?php if ($_GET['Status'] == 'OK') : ?>
    <div class="col-sm-12 stretch-card grid-margin ">
        <div class="card">
            <div class="card-body p-0 rtl">
                <div class="text-center">
                    <h2>
                        <i class="fa fa-check text-success rounded-circle p-3"></i>
                    </h2>
                    <h3 class="text-success">پرداخت موفقیت آمیز بود</h3>
                    <p class="text-muted">
                        از اعتماد شما متشکریم.
                    </p>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="col-sm-12 stretch-card grid-margin ">
        <div class="card">
            <div class="card-body p-0 rtl">
                <div class="text-center">
                    <h2>
                        <i class="fa fa-exclamation text-danger rounded-circle p-3"></i>
                    </h2>
                    <h3 class="text-danger">مشکلی در هنگام پرداخت رخ داده است.</h3>
                    <p class="text-muted">
                        اگر مبلغی از حساب شما کسر شده ، طی 72 ساعت توسط بانک عودت داده خواهد شد.
                    </p>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<div class="col-sm-12 stretch-card grid-margin h-50">
    <div class="card">
        <div class="card-body p-0 rtl">
            <div class="text-center">
                <table id="printable" class="table table-striped">
                    <thead>
                        <th>#</th>
                        <th>کد رهگیری</th>
                        <th>مبلغ</th>
                        <th>وضعیت</th>
                        <th>تاریخ و ساعت</th>
                        <th>مدیریت</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $payment['invoice_unqiueID']?></td>
                            <td><?php echo $payment['tracking_code']?></td>
                            <td><?php echo number_format($payment['price'])?></td>
                            <td>
                                <?php
                                    if ($_GET['Status'] == 'OK'){
                                        echo '<span class="badge badge-success">موفق</span>';
                                    } else {
                                        echo '<span class="badge badge-danger">نا موفق</span>';
                                    }
                                ?>
                            </td>
                            <td><?php echo $payment['created_at']?></td>
                            <td>
                                <?php if ($_GET['Status'] == 'NOK') : ?>
                                    <a href="?c=users&a=pay&id=<?php echo $payment['tracking_code']?>" class="btn btn-success">پرداخت مجدد</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr>
<!--                <button class="btn btn-success">دانلود فایل PDF</button>-->
                <button class="btn btn-dark" onclick="window.print()">پرینت</button>

            </div>
        </div>
    </div>
</div>