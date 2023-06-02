<!--==================== Page Styles =======================-->
<style>
    #exampleModal input , #exampleModal textarea {
        border-radius: 15px;
        border: 1px solid lightgrey;
        width: 100%;
        font-size: 0.9rem;
        padding: 10px;
    }
</style>
<!--==================== Page Content =======================-->
<div class="col-lg-12 grid-margin stretch-card rtl">
    <div class="card">
        <!--==================== Invoice Details =======================-->
        <div class="card-body">
            <h4 class="card-title">
                صورتحساب شماره
                <?php echo $invoice['unique_id']?>#
            </h4>
            <p class="card-description">  تاریخ ایجاد : <code><?php echo $invoice_date;?></code>
            </p>
            <hr>
            <?php if ($total_payments != $invoice['final_price']) :?>
                <form id="paymentForm" action="?c=payments&a=idPay" method="post" enctype="multipart/form-data" class="text-center">

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>شماره فاکتور</th>
                                <th>شرح</th>
                                <th class="font-weight-bold">مبلغ کل ( ریال )</th>
                                <th>مانده حساب ( ریال )</th>
                                <th>حداقل مبلغ قابل پرداخت</th>
                                <th class="text-success">مبلغ قابل پرداخت ( ریال )</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#<?php echo $invoice['unique_id'];?></td>
                                    <td><?php echo $invoice['subject'];?></td>
                                    <td><?php echo number_format($invoice['final_price']);?></td>
                                    <td><?php echo number_format($invoice['final_price'] - $total_payments);?></td>
                                    <td>
                                        <?php if ($total_payments == 0) : ?>
                                            <input type="hidden" name="amount_pay" min="<?php echo $invoice['min_price']?>"
                                                   value="<?php echo $invoice['min_price'] ?>">
                                            <?php echo number_format($invoice['min_price']) ?>
                                            ریال
                                        <?php else:  ?>
                                            <input type="hidden" name="amount_pay" min="<?php echo $invoice['min_price']?>"
                                                   value="<?php echo $invoice['final_price'] - $total_payments ?>">
                                            <?php echo number_format($invoice['final_price'] - $total_payments) ?>
                                            ریال
                                        <?php endif; ?>

                                    </td>
                                    <td id="userPaymentPlace text-bold">
                                        <?php if ($total_payments == 0) : ?>
                                            <p class="badge badge-danger">
                                                <?php echo number_format($invoice['min_price']) ?>
                                                ریال
                                            </p>

                                        <?php else:  ?>
                                            <p class="badge badge-danger">
                                                <?php echo number_format($invoice['final_price'] - $total_payments) ?>
                                                ریال
                                            </p>
                                        <?php endif; ?>
                                    </td>

                                </tr>
                            </tbody>

                        </table>
                        <hr>
                        <input type="hidden" name="unique_id" value="<?php echo $invoice['unique_id']?>">
                        <input type="hidden" name="invoicePrice" value="<?php echo $total_payments*35/100;?>">
                        <input type="hidden" name="userName" value="<?php echo $user->find($loggedUser_id)['lastName'];?>">
                        <input type="hidden" name="userEmail" value="<?php echo $user->find($loggedUser_id)['email'];?>">
                        <input type="hidden" name="userMobile" value="<?php echo $user->find($loggedUser_id)['mobile'];?>">
                        <input type="hidden" name="invoiceDesc" value="بدون توضیح">
                        <p>*** زیباجوی گرامی ، توجه داشته باشید با پرداخت این صورتحساب " <a href="?c=users&a=rules">قوانین و مقررات</a> " کلینیک توت فرنگی را پذیرفته اید.</p>
                        <input type="submit" class="btn btn-success" value="پرداخت آنلاین">
                        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal">
                            آپلود فیش واریزی
                        </button>
                </form>
            <?php else: ?>
                <div class="text-center">
                    <i class="fa fa-check text-success" style="font-size: 1.5rem;margin-bottom: 10px">
                    </i>
                    <h4 class="text-success">                    شما این فاکتور را تسویه کرده اید.ممنونیم :)
                    </h4>
                </div>
            <?php endif; ?>

            <br>
        </div>
        <br>
        <div class="bg-light text-light">X</div>
        <!--==================== Payments Details =======================-->
        <div class="text-center m-2">
            <?php if ($all_payments) : ?>
                <hr>
                <h5>سوابق پرداختی این فاکتور</h5>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>شماره تراکنش</th>
                            <th class="font-weight-bold">مبلغ ( ریال )</th>
                            <th>نوع پرداخت</th>
                            <th>تاریخ و ساعت</th>
                            <th>وضعیت</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($all_payments as $payment) : ?>
                        <tr>
                            <td><?php echo $payment['transaction_id'];?></td>
                            <td><?php echo number_format($payment['price']);?></td>
                            <td>
                                <?php
                                switch ($payment['type']){
                                    case 'ipg':
                                        echo 'آنلاین';
                                        break;
                                    case 'fish':
                                        echo 'با فیش';

                                        break;
                                }
                                ?>
                            </td>
                            <td> <?php
                                echo $dateConvertor_obj->dateConvert($payment['created_at'])[0]["date"].' / '.
                                    $dateConvertor_obj->dateConvert($payment['created_at'])[0]["time"]
                                ;?>
                            </td>
                            <td>
                                <?php
                                switch ($payment['status']){
                                    case 0:
                                        echo "<span class='badge badge-warning'>در حال بررسی</span>";
                                        break;
                                    case 1:
                                        echo "<span class='badge badge-success'>تایید شده</span>";
                                        break;
                                    case 2:
                                        echo "<span class='badge badge-danger'>تایید نشد</span>";
                                        break;
                                }
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <br>
    <div id="invoiceInputs">
        <input type="hidden" name="totalPrice" value="<?php echo $invoice['price']; ?>">
        <input type="hidden" name="totalPayments" value="<?php echo $total_payments; ?>">
        <input type="hidden" name="unPaid" value="<?php echo $unPaid = $invoice['price'] - $total_payments; ?>">
    </div>
</div>
<!--==================== Fish Modal =======================-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">آپلود فیش واریزی</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="" action="?c=payments&a=withFish" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="customer_id" value="<?php echo $loggedUser_id;?>">
                    <input type="hidden" name="invoice_unqiueID" value="<?php echo $invoice['unique_id'];?>">
                    <input type="hidden" name="type" value="fish">
                    <input id="invoicePrice" name="price" placeholder="مبلغ فیش شما به ریال..."
                           class="select w-100 curve-border" min="1" max="<?php echo $invoice['final_price'];?>"
                           type="text"="this.value=separate(this.value);"
                    required>
                    <br>
                    <br>
                    <div class="form-group">
                        <label for="inputDescription">
                            <h6>آپلود فیش شما</h6>
                            <br>
                            <input type="file" name="cardtocard" required>
                        </label>
                    </div>

                    <input type="submit" class="btn btn-success text-center" value="آپلود فیش">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
            </div>
        </div>
    </div>
</div>
<!--==================== Page Scripts =======================-->
