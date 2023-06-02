<!--========== PHP ==========-->
<?php
//    dd($ready_invoices);
?>
<!--========== Page Styles ==========-->
<style>
    .swal2-container.swal2-center > .swal2-popup{
        width: 50%;
        font-size: 1.5rem;
    }
</style>
<!--========== Page Content ==========-->
<section class="content-wrapper" style="padding: 20px">


    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mt-2" >
                <div class="page-content row shadow">
                    <i class="fa fa-check btn btn-sm btn-success"></i>
                    <span>آماده قرار ملاقات / عمل</span>
                    <hr>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>کد یکتا</th>
                            <th>زیبا جو</th>
                            <th>عنوان</th>
                            <th>کنترل</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($ready_invoices as $invoice): ?>
                            <?php if ($invoice['invoice_unqiueID'] != $invoice['task_invoice_id']) : ?>
                                <tr>
                                    <td>#</td>
                                    <td><?php echo $invoice['invoice_unqiueID']?></td>
                                    <td><?php echo $invoice['firstName'].' '.$invoice['lastName']?></td>
                                    <td><?php echo $invoice['subject']?></td>

                                    <td>
                                        <button
                                                class="btn btn-info btn-sm"
                                                onclick="modals.show('<?php echo $invoice['text']?>')"
                                        >
                                            <i class="fa fa-comment"></i>
                                        </button>

                                        <abbr title="پرونده زیباجو">
                                            <a href="?c=users&a=getUserDetails&id=<?php echo $invoice['customer_id']?>" class="btn btn-sm bg-tootfarangee">
                                                <i class="fa fa-user"></i>
                                            </a>
                                        </abbr>
                                        <abbr title="ایجاد وظیفه">
                                            <a href="?c=tasks&a=dr_add&id=<?php echo $invoice['unique_id']?>" class="btn btn-sm btn-success">
                                                ایجاد قرار
                                            </a>
                                        </abbr>
                                        <button onclick="cancelTask(<?php echo $invoice['unique_id']?>)" class="btn btn-sm btn-danger">
                                            لغو قرار
                                        </button>
                                    </td>

                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="page-content row shadow">
                    <i class="fa fa-clock btn btn-sm btn-warning"></i>
                    <span>در انتظار دکتر</span>
                    <hr>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>کد یکتا</th>
                            <th>زیبا جو</th>
                            <th>عنوان</th>
                            <th>کنترل</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($ready_invoices as $invoice): ?>
                            <tr>
                                <td>#</td>
                                <td><?php echo $invoice['invoice_unqiueID']?></td>
                                <td><?php echo $invoice['firstName'].' '.$invoice['lastName']?></td>
                                <td><?php echo $invoice['subject']?></td>
                                <td class="actions d-flex">
                                    <!--
                                    <abbr title="توضیحات مشاور">
                                        <button
                                                class="btn btn-info btn-sm"
                                                onclick="modals.show('<?php echo $invoice['text']?>')"
                                        >
                                            <i class="fa fa-comment"></i>
                                        </button>
                                    </abbr>
                                    <abbr title="پرونده زیباجو">
                                        <a href="?c=users&a=getUserDetails&id=<?php echo $invoice['customer_id']?>" class="btn btn-sm bg-tootfarangee">
                                            <i class="fa fa-user"></i>
                                        </a>
                                    </abbr>
                                    <abbr title="ایجاد وظیفه">
                                        <a href="?c=tasks&a=dr_add&id=<?php echo $invoice['unique_id']?>" class="btn btn-sm btn-success">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    </abbr>
                                    -->
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button"
                                                id="dropdownMenu1"
                                                data-toggle="dropdown"
                                                aria-haspopup="true"
                                                aria-expanded="true">
                                            مدیریت
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                            <li>
                                                <a href="?c=tasks&a=dr_add&id=<?php echo $invoice['unique_id']?>">
                                                    ایجاد وظیفه برای دکتر
                                                </a>
                                            </li>
                                            <li>
                                                <a href="?c=users&a=getUserDetails&id=<?php echo $invoice['customer_id']?>">
                                                    پرونده زیباجو
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" onclick="modals.show('<?php echo $invoice['text']?>')">
                                                   مشاهده توضیحات مشاور
                                                </a>
                                            </li>
                                            <li>
                                                <a href="?c=invoices&a=cancel&id=<?php echo $invoice['unique_id']?>" class="text-danger">
                                                    لغو این صورتحساب
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
                <div class="page-content row shadow">
                    <i class="fa fa-clock btn btn-sm btn-danger"></i>
                    <span>درخواست های خدمات فوری</span>
                    <hr>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>زیبا جو</th>
                            <th>نوع درخواست</th>
                            <th>اطلاعات تماس</th>
                            <th>کنترل</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $id = 1;foreach ($user_requests as $req): ?>
                            <?php if ($req['status'] == 0): ?>
                                <tr>
                                    <td><?php echo $id;?></td>
                                    <td><?php echo $req['firstName'] .' '. $req['lastName'];?></td>
                                    <td><?php echo $req['title'];?></td>
                                    <td><?php echo $req['mobile'];?></td>
                                    <td>
                                        <abbr title="تایید انجام کار">
                                            <a href="?c=reception&a=service_accept&id=<?php echo $req['req_id']?>" class="btn btn-sm btn-success btn-sm">
                                                <i class="fas fa-check"></i>
                                            </a>
                                        </abbr>
                                        <abbr title="لغو انجام کار">
                                            <a href="?c=reception&a=service_cancel&id=<?php echo $req['req_id']?>" class="btn btn-sm btn-danger btn-sm">
                                                <i class="fas fa-close"></i>
                                            </a>
                                        </abbr>
                                        <abbr title="مشاهده اطلاعات">
                                            <button onclick="modals.show(`<?php echo $req['message']?>`)"
                                                    class="btn btn-sm btn-primary btn-sm modal-details">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </abbr>
                                    </td>

                                </tr>
                            <?php endif; ?>
                            <?php $id++;endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>

    </div>
    <!-- Require Modals -->
    <!--    --><?php //require 'section/modals.php';?>

</section>

<!--========== Page Scripts ==========-->
<script src="../global_assets/js/chat_main.js"></script>
<script src="assets/js/functions.js"></script>
<script>
    function cancelTask(taskID){
        if (confirm('آیا مطمئن هستید ؟')){
            let desc = prompt('توضیحات...');
            if(desc){
                location.href = `/admin/?c=tasks&a=cancelTask&id=${taskID}&desc=${desc}`;
            }
        }
    }
</script>
