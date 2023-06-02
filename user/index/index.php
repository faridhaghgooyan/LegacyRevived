<!--=================== Page Styles ==========================-->
<link rel="stylesheet" href="../user/assets/css/dashboard.css">
<link rel="stylesheet" href="../user/assets/css/first.css">
<link rel="stylesheet" href="../user/assets/css/chat_box.css">
<style>
    #servicesTypes a {
        color: white!important;

    }
    #invoices_row{

    }
</style>
<!--=================== Chat Data ==========================-->
<input id="user_id" type="hidden" name="user_id" value="<?php echo $user_info['id']?>">
<input id="target_user" type="hidden" name="target_user" value="admin">
<input id="code" type="hidden" name="code" value="<?php echo $user_info['chat_code']?>">
<!--=================== Ask For Change Password ==========================-->
<?php if (!empty($user_info->token)) : ?>
    <div class="alert alert-primary text-right" role="alert" style="font-size:0.8rem">
        پیشنهاد میشود جهت امنیت بیشتر یک رمز عبور ثابت برای خود مشخص کنید.
        <a href="?c=users&a=editPassword" class="alert-link">اینجا کلیک کنید...</a>.
    </div>
<?php endif; ?>
<!--=================== Chat Box Elements ==========================-->
<div class="container">
    <div class="row">
        <div class="col-12 col-md-8">
            <!--Main Chat Area-->
            <div id="chatWrapper">
                <div id="welcome_message"></div>

            </div>
            <!-- Quick Service Req -->
            <div class="row w-100 align-items-center">

                <h6 class="پف-۱">خدمات فوری :</h6>
                <?php foreach ($services_list as $service) : ?>
                    <a id="service<?php echo $service['id']?>"
                       class="btn-tootfarangee-gray"
                       data-service_name="<?php echo $service['title'] ?>"
                       data-id="<?php echo $service['id'] ?>"
                       onclick=servicesReq("<?php echo $service['id']?>")><?php echo $service['title'];?></a>
                <?php endforeach; ?>
                <!-- ./. Quick Service Req -->
            </div>
            <hr>
            <div class="row w-100 align-items-center">

                <small>فیش واریزی</small>
                <input type="file">
                <!-- ./. Quick Service Req -->
            </div>
            <!--Send Text Message-->
            <div class="row justify-content-between justify-content-md-center position-relative bg-white border rounded">
                <form id="chatForm" enctype="multipart/form-data" class="w-75 ">
                    <input id="message" type="text" name="message" placeholder="پیام شما" class="form-control border-0">
                    <input id="user_type" type="hidden" name="user_type" value="user">
                    <input id="message_type" type="hidden" name="message_type" value="text">
                    <input id="roll_title" type="hidden" name="roll_title" value="customer">

                </form>

                <div class="row justify-content-between align-items-center">

                <!--Send Image Message-->
                    <button class="chat-send-photo">
                        <i class="fas fa-camera"></i>
                        <input type="file" name="file" onchange="send_image()">
                    </button>
                    <!--Send Voice Message-->
                    <div id="controls">
                        <button id="recordButton">
                            <i class="fas fa-microphone"></i>
                        </button>
                        <button id="pauseButton" disabled>
                            <i class="fas fa-pause"></i>
                        </button>
                        <button id="stopButton" disabled>
                            <i class="fas fa-stop"></i>
                        </button>
                    </div>
                    <!--Send Voice Message-->
                    <button onclick="send_message()" class="btn " >
                        <i class="fas fa-paper-plane bg-danger text-white  p-2 rounded-circle"></i>
                    </button>
                </div>

            </div>


        </div>
        <div class="col-12 col-md-4 grid-margin">
            <div class="card card-stat stretch-card mb-3">
                <div class="card-body shadow">
                    <div class="d-flex justify-content-between">
                        <div class="text-white text-right">
                            <h3 class="font-weight-bold mb-0"><span><?php echo count($invoices)?></h3>
                            <h6>صورتحساب برای شما</h6>

                        </div>
                        <div class="flot-bar-wrapper">
                            <div id="column-chart" class="flot-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="invoices_row" class="card stretch-card mb-3 border-0" style="background-color: transparent">
                <?php if ($invoices): ?>
                    <?php foreach ($invoices as $invoice): ?>
                        <div class="card-body d-flex flex-wrap justify-content-between align-items-center mt-2 border bg-white">
                            <div class="rtl iranSans">
                                <h4 class="font-weight-semibold mb-1 text-black">
                                    <?php echo $invoice['subject']?>
                                </h4>
                                <h6 class="text-muted">
                                    <?php echo $date_converter->date_convert($invoice['created_at'],'jalali')[0]['date'] ?>
                                </h6>
                                <small>مهلت پرداخت :</small>
                                <p class="badge badge-secondary text-right" style="direction: ltr">
                                    <?php echo str_replace('-',' / ',$date_converter->date_convert($invoice['deadline'],'jalali')[0]['date']) ?>
                                </p>
                            </div>
                            <div>
                                <h4 class="text-danger font-weight-bold">
                                    <?php echo number_format($invoice['final_price'])?>
                                    ت
                                </h4>
                                <?php if ($payments_obj->total_payments($invoice['unique_id']) >= $invoice['final_price'] ): ?>
                                    <span class="text-success">تسویه شده</span>
                                <?php else: ?>
                                    <a href="?c=users&a=pay&id=<?php echo $invoice['unique_id']?>" class="btn btn-success">پرداخت</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div st>
<!--=================== Invoices List ==========================-->
<div class="row my-2">
    <div class="col-xl-12 stretch-card grid-margin">
        <div class="card p-3">
            <h6 class="card-title mb-0 rtl">صورتحساب ها</h6>
            <hr>
            <div class="card-body p-0 rtl">
                <div class="table-responsive">
                    <table class="table custom-table text-dark">
                        <thead>
                            <tr>
                                <th>شماره صورتحساب</th>
                                <th>بابت</th>
                                <th>مبلغ کل</th>
                                <th>مانده</th>
                                <th>مدیریت</th>
                            </tr>
                        </thead>
                        <?php foreach ($invoices as $invoice) :?>
                            <tr>
                                <td><?php echo $invoice["unique_id"];?></td>
                                <td><?php echo $invoice["subject"];?></td>
                                <td><?php echo number_format($invoice["final_price"]);?></td>
                                <td>
                                    <?php
                                    $total_payments = 0;
                                    if ($payments_obj->invoice_payments($invoice["unique_id"])) {
                                        $total_payments = $payments_obj->total_payments($invoice["unique_id"]);
                                    }

                                    $amount = $invoice["final_price"] - $total_payments;
                                    echo number_format($amount);
                                    ?>
                                </td>
                                <td>
                                    <?php if ($total_payments >= $invoice["final_price"]) : ?>

                                        <span class="text-success">تسویه شده</span>

                                    <?php else: ?>
                                        <a href="?c=users&a=pay&id=<?php echo $invoice["unique_id"];?>" class="btn btn-success">پرداخت</a>
                                    <?php endif; ?>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <a class="text-black font-13 d-block pt-2 pb-2 pb-lg-0 font-weight-bold pl-4 m-3" href="?c=users&a=unpaidInvoices">مشاهده تمام صورتحساب های بروز</a>
            </div>
        </div>
    </div>


</div>
<!--=================== Quick Services List ==========================-->
<div id="quick_services_list" class="row">
    <div id="quick_services" class="col-xl-12 stretch-card grid-margin">
        <div class="card">
            <div class="card-body pb-0">
                <h4 class="card-title mb-0 rtl">خدمت های فوری</h4>
            </div>
            <br>
            <div class="card-body p-0 rtl">
                <div class="table-responsive">
                    <table class="table custom-table text-dark">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>عنوان خدمت فوری</th>
                            <th>وضعیت</th>
                            <th>تاریخ ثبت درخواست</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($service_req as $req) :?>
                            <tr>
                                <td><?php echo $req["id"];?></td>
                                <td><?php echo $req["title"];?></td>
                                <td><?php
                                    switch ($req["status"]){
                                        case 1:
                                            echo "<span class='badge badge-warning'>در حال بررسی </span>";
                                            break;
                                        case 2:
                                            echo "<span class='badge badge-success'>انجام شده </span>";
                                            break;
                                    }
                                    ?></td>
                                <td>
                                    <?php echo $date_converter->date_convert($req['created_at'],'jalali')[0]['date'] ?>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <a class="text-black font-13 d-block pt-2 pb-2 pb-lg-0 font-weight-bold pl-4 m-3" href="?c=users&a=unpaidInvoices">مشاهده تمام صورتحساب های بروز</a>
            </div>
        </div>
    </div>
</div>
<!--=================== Page Scripts ==========================-->
<script src="../global_assets/js/users/modals.js"></script>
<script src="../global_assets/js/chat/recorder.js"></script>
<script src="../global_assets/js/chat/app.js"></script>
<script src="../global_assets/js/chat/main.js"></script>
<script src="../global_assets/js/chat/chat.js"></script>
<!--./Page Custom Scripts-->
