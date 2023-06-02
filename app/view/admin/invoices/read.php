<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <hr>
    <div class="page-content">


        <!-- Main content -->
        <section class="content">
            <div class="row">
                <i class="fas fa-users font-1-rem d-inline"></i>
                <span class="iransans font-1-rem d-inline">ویرایش پیام </span>
                <hr>
                <!-- Invoice -->
                <div class="container">
                    <div class="card">
                        <div class="card-body">
                            <div id="invoice">
                                <div class="toolbar hidden-print">

                                    <hr>
                                </div>
                                <div class="invoice overflow-auto">
                                    <div style="min-width: 600px">
                                        <header>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <a href="javascript:;">
                                                        <img src="/storage/noimage.jpg" width="80" alt="">
                                                    </a>
                                                </div>
                                                <div class="col-md-4 company-details">
                                                    <h2 class="name">
                                                        <a target="_blank" href="javascript:;">
                                                            کلینیک زیبایی توت فرنگی
                                                        </a>
                                                    </h2>
                                                    <div>تهران، بیمارستان عرفان نیایش</div>
                                                    <div>(+98) 9224927763</div>
                                                    <div>info[at]Tootfarangee.com</div>
                                                </div>
                                                <div class="col-md-4 company-details">
                                                    <?php if ($user_roll_title === 'customer'): ?>
                                                    <div class="text-left">
                                                        <button type="button" class="btn btn-success">
                                                            <i class="fa fa-print"></i>پرداخت آنلاین
                                                        </button>
                                                        <button type="button" class="btn btn-primary">
                                                            <i class="fa fa-print"></i>پرداخت با فیش
                                                        </button>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </header>
                                        <main>
                                            <div class="row contacts">
                                                <div class="col invoice-to">
                                                    <div class="text-gray-light">صورتحساب برای :</div>
                                                    <h2 class="to">
                                                        <?php echo $invoice['firstName'].' '.$invoice['lastName']?>
                                                    </h2>
                                                    <div class="address">
                                                        <?php echo $invoice['fullAddress']?>
                                                    </div>
                                                    <div class="email"><a href="callto:<?php echo $invoice['mobile']?>">
                                                            <?php echo $invoice['mobile']?>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col invoice-details">
                                                    <h1 class="invoice-id">#
                                                        <?php echo $invoice['unique_id']?>
                                                    </h1>
                                                    <div class="date">تاریخ صدور :
                                                        <?php echo $dateCovert->date_convert($invoice['created_at'],'jalali')[0]['date'] ?>
                                                    </div>
                                                    <div class="date">
                                                        مهلت پرداخت :
                                                        <strong class="text-left ltr" style="direction: rtl!important;text-align: left!important;">
                                                            <?php echo
                                                            $dateCovert->date_convert($invoice['deadline'],'jalali')[0]['date']
                                                            ?>
                                                        </strong>
                                                    </div>
                                                </div>
                                            </div>
                                            <table>
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th class="text-right">شرح</th>
                                                    <th class="text-right">تعداد</th>
                                                    <th class="text-right">حداقل پیش پرداخت</th>
                                                    <th class="text-right">مبلغ کل</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr class="invoice-row">
                                                    <td class="no">1</td>
                                                    <td class="text-right">
                                                        <h3>
                                                            پروتز سینه
                                                        </h3>
                                                   <td class="unit">1</td>
                                                    <td class="qty">100،000 ت</td>
                                                    <td class="total">
                                                        5،000،000
                                                    ت
                                                    </td>
                                                </tr>

                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <td colspan="2"></td>
                                                    <td colspan="2">مبلغ کل</td>
                                                    <td> ت 5,200.00</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"></td>
                                                    <td colspan="2">مالیات</td>
                                                    <td>0</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"></td>
                                                    <td colspan="2">جمع کل</td>
                                                    <td> ت 6,500.00</td>
                                                </tr>
                                                </tfoot>
                                            </table>
                                            <div class="thanks">
                                                <h3>مشخصات حساب :</h3>
                                                <img src="https://omranweb.com/shop/wp-content/uploads/2019/12/bank400-2.jpg" alt="">
                                            </div>
                                            <div class="notices">
                                                <div>توجه:</div>
                                                <div class="notice">در صورت عدم پرداخت ، این صورتحساب پس از 30 روز منقضی خواهد شد.</div>
                                            </div>
                                            <hr>
                                            <div class="text-right">
                                                <h6>سوابق پرداختی</h6>
                                                <table class="table table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">تاریخ</th>
                                                        <th scope="col">مبلغ</th>
                                                        <th scope="col">Handle</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <th scope="row">1</th>
                                                        <td>Mark</td>
                                                        <td>Otto</td>
                                                        <td>@mdo</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">2</th>
                                                        <td>Jacob</td>
                                                        <td>Thornton</td>
                                                        <td>@fat</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">3</th>
                                                        <td>Larry</td>
                                                        <td>the Bird</td>
                                                        <td>@twitter</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </main>
                                        <footer>این صورتحساب به صورت دیجیتالی صادر شده است.</footer>
                                    </div>
                                    <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                                    <div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </section>
        <!-- /.content -->
    </div>
</div>
<!-- /.content-wrapper -->
<script src="https://adminlte.io/themes/dev/AdminLTE/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="../assets/js/select2.min.js"></script>

<script>

    $('.provinces').select2();
    $('#cities').select2();
</script>
<style type="text/css">
    body{margin-top:20px;
        background-color: #f7f7ff;
    }
    #invoice {
        padding: 0px;
    }

    .invoice {
        position: relative;
        background-color: #FFF;
        min-height: 680px;
        padding: 15px
    }

    .invoice header {
        padding: 10px 0;
        margin-bottom: 20px;
        border-bottom: 1px solid #e12b26
    }

    .invoice .company-details {
        text-align: right;
    }

    .invoice .company-details .name {
        margin-top: 0;
        margin-bottom: 0;
        font-size: 2rem;
    }

    .invoice .contacts {
        margin-bottom: 20px
    }

    .invoice .invoice-to {
        text-align: right;
    }

    .invoice .invoice-to .to {
        margin-top: 0;
        margin-bottom: 0
    }

    .invoice .invoice-details {
        text-align: right
    }

    .invoice .invoice-details .invoice-id {
        font-size: 2.3rem;
        margin-top: 0;
        color: #e12b26
    }

    .invoice main {
        padding-bottom: 50px
    }

    .invoice main .thanks {
        margin-top: -100px;
        font-size: 2em;
        margin-bottom: 50px
    }

    .invoice main .notices {
        padding-left: 6px;
        border-right: 6px solid #e12b26;
        background: #e7f2ff;
        padding: 10px;
    }

    .invoice main .notices .notice {
        font-size: 1.2em
    }

    .invoice table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 20px
    }

    .invoice table td,
    .invoice table th {
        padding: 15px;
        background: #eee;
        border-bottom: 1px solid #fff
    }

    .invoice table th {
        white-space: nowrap;
        font-weight: 400;
        font-size: 16px
    }

    .invoice table td h3 {
        margin: 0;
        font-weight: 400;
        color: #e12b26;
        font-size: 1.2em
    }

    .invoice table .qty,
    .invoice table .total,
    .invoice table .unit {
        text-align: right;
        font-size: 1.2em
    }

    .invoice table .no {
        color: #fff;
        font-size: 1.6em;
        background: #e12b26
    }

    .invoice table .unit {
        background: #ddd
    }

    .invoice table .total {
        background: #e12b26;
        color: #fff
    }

    .invoice table tbody tr:last-child td {
        border: none
    }

    .invoice table tfoot td {
        background: 0 0;
        border-bottom: none;
        white-space: nowrap;
        text-align: right;
        padding: 10px 20px;
        font-size: 1.2em;
        border-top: 1px solid #aaa
    }

    .invoice table tfoot tr:first-child td {
        border-top: none
    }
    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0px solid rgba(0, 0, 0, 0);
        border-radius: .25rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
    }

    .invoice table tfoot tr:last-child td {
        color: #e12b26;
        font-size: 1.4em;
        border-top: 1px solid #e12b26
    }

    .invoice table tfoot tr td:first-child {
        border: none
    }

    .invoice footer {
        width: 100%;
        text-align: center;
        color: #777;
        border-top: 1px solid #aaa;
        padding: 8px 0
    }

    @media print {
        .invoice {
            font-size: 11px !important;
            overflow: hidden !important
        }
        .invoice footer {
            position: absolute;
            bottom: 10px;
            page-break-after: always
        }
        .invoice>div:last-child {
            page-break-before: always
        }
    }

    .invoice main .notices {
        padding-left: 6px;
        border-left: 6px solid #e12b26;
        background: #e7f2ff;
        padding: 10px;
    }
</style>

<script type="text/javascript">

</script>