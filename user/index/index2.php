<link rel="stylesheet" href="../user/assets/css/dashboard.css">
<link rel="stylesheet" href="../user/assets/css/first.css">
<style>
    #servicesTypes a {
        color: white!important;

    }
    #invoices_row{

    }
</style>

<!-- first row starts here -->
<!--<script src="../global_assets/js/recordapp.js"></script>-->
<?php if (!empty($user_info->token)) : ?>
<div class="alert alert-primary text-right" role="alert" style="font-size:0.8rem">
    پیشنهاد میشود جهت امنیت بیشتر یک رمز عبور ثابت برای خود مشخص کنید.
    <a href="?c=users&a=editPassword" class="alert-link">اینجا کلیک کنید...</a>.
</div>
<?php endif; ?>

<div class="row">
    <div class="col-xl-8 stretch-card grid-margin">
        <div class="row w-100">
            <div id="chatMainBox"  class="scrollbar w-100 shadow-lg m-2 bg-whatsapp" style="max-height: 350px;overflow: auto;background-color: lightgrey">
                <div  class="p-4">
                    <div class="admin-chat-box text-right ">زیباجوی عزیز،<br>
                        سلام ، به چه خدمتی نیاز دارید ؟

                    </div>
                    <div class="">
                        <img src="/storage/welcome.gif" alt="" class="user-chat-img shadow" width="200">
                    </div>
                </div>
            </div>
            <!-- Quick Service Req -->
            <h6 class="پف-۱">خدمات فوری :</h6>
            <?php foreach ($services_list as $service) : ?>
                <a id="service<?php echo $service['id']?>"
                        class="btn-tootfarangee-gray"
                        data-service_name="<?php echo $service['title'] ?>"
                        data-id="<?php echo $service['id'] ?>"
                        onclick=servicesReq("<?php echo $service['id']?>")><?php echo $service['title'];?></a>
            <?php endforeach; ?>
            <!-- ./. Quick Service Req -->
            <form id="chatForm" class="w-100" method="post" enctype="multipart/form-data">

                <!-- Required Variables -->
                <input id="user_type" type="hidden" name="user_type" class="w-100" value="user">
                <input id="code" type="hidden" name="code" class="w-100" value="<?php echo $_COOKIE['Customer-Code'];?>">
                <input id="message_type" type="hidden" name="message_type" class="w-100" value="text">
                <input id="user_id" type="hidden" name="user_id" class="w-100" value="<?php if (isset($loggedUser_id)){echo $loggedUser_id;} ?>">
                <input id="owner_id" type="hidden" name="owner_id" class="w-100" value="<?php if (isset($consultant_id)){echo $consultant_id;} ?>">
                <!-- ./ Required Variables -->
                <div id="messageBar" class="d-flex justify-content-between align-items-center bg-white p-2 shadow">
                    <input id="userMessage" type="text" name="message" class="w-75 d-inline messageInput"
                           placeholder="پیام شما..." >
                    <!--                        <input id="chatfile" type="file" name="chatfile" class="bg-danger">-->
                    <div class="w-25">
<!--                        <div id="controls" class="d-inline">-->
<!--                            <button id="stopButton" disabled onclick="run()">-->
<!--                                <i class="fas fa-stop blink_me"></i>-->
<!--                            </button>-->
<!--                            <button id="pauseButton" disabled>-->
<!--                                <i class="fas fa-pause"></i>-->
<!--                            </button>-->
<!--                            <button id="recordButton">-->
<!--                                <i class="fas fa-microphone-alt"></i>-->
<!--                            </button>-->
<!---->
<!--                        </div>-->
                        <div class="upload-btn-wrapper d-inline ">
                            <abbr title="آپلود فایل تصویر" >
                                <input type="file" id="chatfile" name="chatfile" onchange="send_file()"/>
                            </abbr>
                            <i class="fas fa-images"></i>
                        </div>
                        <!--                            <abbr title="آپلود تصویر"><input type="file" name="fileToUpload" id="fileToUpload"></abbr>-->
                        <!--                                <input id="userSubmit" class="btn btn-info d-inline sendMessage" type="submit" name="رسال" value="ارسال" >-->
                        <a href="#" id="userSubmit" class="btn btn-danger d-inline messageBtn">ارسال</a>
<!--                        <button>send</button>-->
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div id="servicesModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title" id="exampleModalLabel">ثبت درخواست خدمت : <span id="serviceName"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    </button>
                </div>
                <div class="modal-body text-center">
                    <div class="service-info text-center">
                    </div>
                    <form id="serviceForm"  action="?c=users&a=service_req" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="customer_id" value="<?php echo $loggedUser_id;?>">
                        <input id="service_id_input" type="hidden" name="service_id" >
                        <textarea name="message" id="userReqText" cols="30" rows="4" placeholder="لطفا توضیحات تکمیلی خود را ارائه کنید..." class="w-100 user-inputs shadow" required></textarea>
                        <br>
                        <input type="submit" class="btn btn-success mt-2" value="ثبت درخواست">
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-tootfarangee" data-dismiss="modal">منصرف شدم</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        $('.service1').on('click',function (){
            $('#servicesTypes').css('display', 'none');
        })
        $('.Otherservices').on('click',function (){
            let service = $(this).text();
            $('#serviceName').append(service);
            $('#servicesModal').modal('show');
        })
    </script>
    <div class="col-xl-4 grid-margin">
        <div class="card card-stat stretch-card mb-3">
            <div class="card-body shadow">
                <div class="d-flex justify-content-between">
                    <div class="text-white text-right">
                        <h3 class="font-weight-bold mb-0"><span><?php echo count($invoices)?></h3>
                        <h6>صورتحساب برای شما</h6>
                        <div class="badge badge-danger">
                            <?php echo count($invoices)?>
                            صورتحساب تسویه نشده
                        </div>
                    </div>
                    <div class="flot-bar-wrapper">
                        <div id="column-chart" class="flot-chart"></div>
                    </div>
                </div>
            </div>
        </div>
        <div id="invoices_row" class="card stretch-card mb-3">
            <?php if ($invoices): ?>
            <?php foreach ($invoices as $invoice): ?>
                    <div class="card-body d-flex flex-wrap justify-content-between align-items-center mt-2 border">
                        <div class="rtl iranSans">
                            <h4 class="font-weight-semibold mb-1 text-black">
                                <?php echo $invoice['subject']?>
                            </h4>
                            <h6 class="text-muted">
                                <?php echo $date_converter->date_convert($invoice['created_at'],'jalali')[0]['date'] ?>
                            </h6>
                            <p class="badge badge-secondary">
                                مهلت پرداخت :
                                <?php echo $date_converter->date_convert($invoice['deadline'],'jalali')[0]['date'] ?>
                            </p>
                        </div>
                        <div>
                            <h4 class="text-danger font-weight-bold">
                                ت
                                <?php echo number_format($invoice['final_price'])?>
                            </h4>
                            <a href="?c=users&a=pay&id=<?php echo $invoice['unique_id']?>" class="btn btn-success">پرداخت</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
<!--        --><?php //$paymentLimit = 0; ?>
<!--        --><?php //foreach ($payments as $payment) :?>
<!---->
<!--            <div class="card stretch-card mb-3">-->
<!--                <div class="card-body d-flex flex-wrap justify-content-between ">-->
<!--                    <div class="rtl">-->
<!--                        <h4 class="font-weight-semibold mb-1 text-black"> --><?php //echo $payment['task_id']?><!-- </h4>-->
<!--                        <h6 class="text-muted">--><?php //echo $payment['customer_id']?><!-- / --><?php //echo $payment['created_at']?><!--  </h6>-->
<!--                    </div>-->
<!--                    <h3 class="text-success font-weight-bold">+--><?php //echo number_format($payment['price'])?><!--</h3>-->
<!--                </div>-->
<!--            </div>-->
<!--            --><?php
//            $paymentLimit++;
//        endforeach;
//        ?>
        <!-- Invoices will be Here
                <div class="card mt-3">
                    <div class="card-body d-flex flex-wrap justify-content-between">
                        <div class="rtl">
                            <h4 class="font-weight-semibold mb-1 text-black"> صورتحساب برای جراحی لب </h4>
                            <h6 class="text-muted">دکتر جعفرپور / 23 خرداد 1399</h6>
                        </div>
                        <h3 class="text-danger font-weight-bold">-8380.00</h3>
                    </div>
                </div>
        -->
    </div>
</div>
<!-- chart row starts here
<div class="row">
    <div class="col-sm-6 stretch-card grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="card-title"> Customers <small class="d-block text-muted">August 01 - August 31</small>
                    </div>
                    <div class="d-flex text-muted font-20">
                        <i class="mdi mdi-printer mouse-pointer"></i>
                        <i class="mdi mdi-help-circle-outline ml-2 mouse-pointer"></i>
                    </div>
                </div>
                <h3 class="font-weight-bold mb-0"> 2,409 <span class="text-success h5">4,5%<i class="mdi mdi-arrow-up"></i></span>
                </h3>
                <span class="text-muted font-13">Avg customers/Day</span>
                <div class="line-chart-wrapper">
                    <canvas id="linechart" height="80"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 stretch-card grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="card-title"> Conversions <small class="d-block text-muted">August 01 - August 31</small>
                    </div>
                    <div class="d-flex text-muted font-20">
                        <i class="mdi mdi-printer mouse-pointer"></i>
                        <i class="mdi mdi-help-circle-outline ml-2 mouse-pointer"></i>
                    </div>
                </div>
                <h3 class="font-weight-bold mb-0"> 0.40% <span class="text-success h5">0.20%<i class="mdi mdi-arrow-up"></i></span>
                </h3>
                <span class="text-muted font-13">Avg customers/Day</span>
                <div class="bar-chart-wrapper">
                    <canvas id="barchart" height="80"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
-->
<!-- Last Weblog Posts
<div class="row">
    <div class="col-sm-4 stretch-card grid-margin">
        <div class="card">
            <div class="card-body p-0">
                <img class="img-fluid w-100" src="../user/assets/images/dashboard/img_1.jpg" alt="" />
            </div>
            <div class="card-body px-3 text-dark">
                <div class="d-flex justify-content-between">
                    <p class="text-muted font-13 mb-0">ENTIRE APARTMENT</p>
                    <i class="mdi mdi-heart-outline"></i>
                </div>
                <h5 class="font-weight-semibold"> Cosy Studio flat in London </h5>
                <div class="d-flex justify-content-between font-weight-semibold">
                    <p class="mb-0">
                        <i class="mdi mdi-star star-color pr-1"></i>4.60 (35) </p>
                    <p class="mb-0">$5,267/night</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4 stretch-card grid-margin">
        <div class="card">
            <div class="card-body p-0">
                <img class="img-fluid w-100" src="../user/assets/images/dashboard/img_2.jpg" alt="" />
            </div>
            <div class="card-body px-3 text-dark">
                <div class="d-flex justify-content-between">
                    <p class="text-muted font-13 mb-0">ENTIRE APARTMENT</p>
                    <i class="mdi mdi-heart-outline"></i>
                </div>
                <h5 class="font-weight-semibold"> Victoria Bedsit Studio Ensuite </h5>
                <div class="d-flex justify-content-between font-weight-semibold">
                    <p class="mb-0">
                        <i class="mdi mdi-star star-color pr-1"></i>4.83 (12) </p>
                    <p class="mb-0">$6,144/night</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4 stretch-card grid-margin">
        <div class="card">
            <div class="card-body p-0">
                <img class="img-fluid w-100" src="../user/assets/images/dashboard/img_3.jpg" alt="" />
            </div>
            <div class="card-body px-3 text-dark">
                <div class="d-flex justify-content-between">
                    <p class="text-muted font-13 mb-0">ENTIRE APARTMENT</p>
                    <i class="mdi mdi-heart-outline"></i>
                </div>
                <h5 class="font-weight-semibold">Fabulous Huge Room</h5>
                <div class="d-flex justify-content-between font-weight-semibold">
                    <p class="mb-0">
                        <i class="mdi mdi-star star-color pr-1"></i>3.83 (15) </p>
                    <p class="mb-0">$5,267/night</p>
                </div>
            </div>
        </div>
    </div>
</div>
-->
<!-- Customer Finance & order Details -->
<div class="row">

    <div class="col-xl-12 stretch-card grid-margin">
        <div class="card">
            <div class="card-body pb-0">
                <h4 class="card-title mb-0 rtl">صورتحساب ها</h4>
            </div>
            <br>
            <div class="card-body p-0 rtl">
                <div class="table-responsive">
                    <table class="table custom-table text-dark">
                        <thead>
                            <tr>
                                <th>شماره صورتحساب</th>
                                <th>مبلغ کل</th>
                                <th>مانده</th>
                                <th>مدیریت</th>
                            </tr>
                        </thead>
                        <?php foreach ($invoices as $invoice) :?>
                            <tr>
                                <td><?php echo $invoice["unique_id"];?></td>
                                <td><?php echo number_format($invoice["final_price"]);?></td>
                                <td>
                                    <?php
                                    $payment = 0;
                                    if ($user->invoice_payments($invoice["unique_id"])) {
                                        $payment = $user->invoice_payments($invoice["unique_id"])[0]["price"];
                                    }

                                    $amount = $invoice["final_price"] - $payment;
                                        echo number_format($amount);
                                    ?>
                                </td>
                                <td>
                                    <?php if ($amount <= $invoice["final_price"]) : ?>
                                        <a href="?c=users&a=pay&id=<?php echo $invoice["unique_id"];?>" class="btn btn-success">پرداخت</a>
                                    <?php else: ?>
                                        <span class="text-success">تسویه شده</span>

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
<!-- doughnut chart row starts
<div class="row">
    <div class="col-sm-12 stretch-card grid-margin">
        <div class="card">
            <div class="row">
                <div class="col-md-4">
                    <div class="card border-0">
                        <div class="card-body">
                            <div class="card-title">Channel Sessions</div>
                            <div class="d-flex flex-wrap">
                                <div class="doughnut-wrapper w-50">
                                    <canvas id="doughnutChart1" width="100" height="100"></canvas>
                                </div>
                                <div id="doughnut-chart-legend" class="pl-lg-3 rounded-legend align-self-center flex-grow legend-vertical legend-bottom-left"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0">
                        <div class="card-body">
                            <div class="card-title">News Sessions</div>
                            <div class="d-flex flex-wrap">
                                <div class="doughnut-wrapper w-50">
                                    <canvas id="doughnutChart2" width="100" height="100"></canvas>
                                </div>
                                <div id="doughnut-chart-legend2" class="pl-lg-3 rounded-legend align-self-center flex-grow legend-vertical legend-bottom-left"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0">
                        <div class="card-body">
                            <div class="card-title">Device Sessions</div>
                            <div class="d-flex flex-wrap">
                                <div class="doughnut-wrapper w-50">
                                    <canvas id="doughnutChart3" width="100" height="100"></canvas>
                                </div>
                                <div id="doughnut-chart-legend3" class="pl-lg-3 rounded-legend align-self-center flex-grow legend-vertical legend-bottom-left"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
-->
<!-- last row starts here
<div class="row">
    <div class="col-sm-6 col-xl-4 stretch-card grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="card-title mb-2">Upcoming events (3)</div>
                <h3 class="mb-3">23 september 2019</h3>
                <div class="d-flex border-bottom border-top py-3">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" checked /></label>
                    </div>
                    <div class="pl-2">
                        <span class="font-12 text-muted">Tue, Mar 5, 9.30am</span>
                        <p class="m-0 text-black"> Hey I attached some new PSD files… </p>
                    </div>
                </div>
                <div class="d-flex border-bottom py-3">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" /></label>
                    </div>
                    <div class="pl-2">
                        <span class="font-12 text-muted">Mon, Mar 11, 4.30 PM</span>
                        <p class="m-0 text-black"> Discuss performance with manager </p>
                    </div>
                </div>
                <div class="d-flex border-bottom py-3">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" /></label>
                    </div>
                    <div class="pl-2">
                        <span class="font-12 text-muted">Tue, Mar 5, 9.30am</span>
                        <p class="m-0 text-black">Meeting with Alisa</p>
                    </div>
                </div>
                <div class="d-flex pt-3">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" /></label>
                    </div>
                    <div class="pl-2">
                        <span class="font-12 text-muted">Mon, Mar 11, 4.30 PM</span>
                        <p class="m-0 text-black"> Hey I attached some new PSD files… </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4 stretch-card grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="d-flex border-bottom mb-4 pb-2">
                    <div class="hexagon">
                        <div class="hex-mid hexagon-warning">
                            <i class="mdi mdi-clock-outline"></i>
                        </div>
                    </div>
                    <div class="pl-4">
                        <h4 class="font-weight-bold text-warning mb-0"> 12.45 </h4>
                        <h6 class="text-muted">Schedule Meeting</h6>
                    </div>
                </div>
                <div class="d-flex border-bottom mb-4 pb-2">
                    <div class="hexagon">
                        <div class="hex-mid hexagon-danger">
                            <i class="mdi mdi-account-outline"></i>
                        </div>
                    </div>
                    <div class="pl-4">
                        <h4 class="font-weight-bold text-danger mb-0">34568</h4>
                        <h6 class="text-muted">Profile visits</h6>
                    </div>
                </div>
                <div class="d-flex border-bottom mb-4 pb-2">
                    <div class="hexagon">
                        <div class="hex-mid hexagon-success">
                            <i class="mdi mdi-laptop-chromebook"></i>
                        </div>
                    </div>
                    <div class="pl-4">
                        <h4 class="font-weight-bold text-success mb-0"> 33.50% </h4>
                        <h6 class="text-muted">Bounce Rate</h6>
                    </div>
                </div>
                <div class="d-flex border-bottom mb-4 pb-2">
                    <div class="hexagon">
                        <div class="hex-mid hexagon-info">
                            <i class="mdi mdi-clock-outline"></i>
                        </div>
                    </div>
                    <div class="pl-4">
                        <h4 class="font-weight-bold text-info mb-0">12.45</h4>
                        <h6 class="text-muted">Schedule Meeting</h6>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="hexagon">
                        <div class="hex-mid hexagon-primary">
                            <i class="mdi mdi-timer-sand"></i>
                        </div>
                    </div>
                    <div class="pl-4">
                        <h4 class="font-weight-bold text-primary mb-0"> 12.45 </h4>
                        <h6 class="text-muted mb-0">Browser Usage</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4 stretch-card grid-margin">
        <div class="card color-card-wrapper">
            <div class="card-body">
                <img class="img-fluid card-top-img w-100" src="../user/assets/images/dashboard/img_5.jpg" alt="" />
                <div class="d-flex flex-wrap justify-content-around color-card-outer">
                    <div class="col-6 p-0 mb-4">
                        <div class="color-card primary m-auto">
                            <i class="mdi mdi-clock-outline"></i>
                            <p class="font-weight-semibold mb-0">Delivered</p>
                            <span class="small">15 Packages</span>
                        </div>
                    </div>
                    <div class="col-6 p-0 mb-4">
                        <div class="color-card bg-success m-auto">
                            <i class="mdi mdi-tshirt-crew"></i>
                            <p class="font-weight-semibold mb-0">Ordered</p>
                            <span class="small">72 Items</span>
                        </div>
                    </div>
                    <div class="col-6 p-0">
                        <div class="color-card bg-info m-auto">
                            <i class="mdi mdi-trophy-outline"></i>
                            <p class="font-weight-semibold mb-0">Arrived</p>
                            <span class="small">34 Upgraded</span>
                        </div>
                    </div>
                    <div class="col-6 p-0">
                        <div class="color-card bg-danger m-auto">
                            <i class="mdi mdi-presentation"></i>
                            <p class="font-weight-semibold mb-0">Reported</p>
                            <span class="small">72 Support</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
-->


<!--<script src="/global_assets/js/userChats.js"></script>-->


<script>
    $(document).ready(function (){

        $('#usermessage').bind('keypress',function (e){
            if (e.which === 13){
                e.preventDefault();
                userCreate();
                $(this).val("");
                $('#style-2').scrollTop(9000).slow;
            }
        })
    })
    // $('#usersubmit').on('click',function (e){
    //     e.preventDefault();
    //     let message = $('#usermessage').val();
    //
    //     $('#chatarea').append('<div class="user-chat-box text-right mr-4 mt-2">'+message+'</div>');
    //     $('#style-2').scrollTop(9000).slow;
    //
    // })
    $('#adminsubmit').on('click',function (e){
        let message = $('#adminmessage').val();
        e.preventDefault();
        $('#chatarea').append('<div class="admin-chat-box text-right">'+message+'</div>');
        message.val("");
        // alert(message);
    });
</script>
<script>
    $('input[name="fileToUpload"]').on('change',function (){
        alert($(this).val());
    });
    // Check if User Reload Page without loosing data
    let reload = $('.admin-chat-box').length;
    /*
    if (reload <= 1){
        // Swal.fire({
        //     title: '<strong>کاربر گرامی </strong>',
        //     icon: 'success',
        //     html:
        //         'ظاهرا دسترسی شما موقتا قطع شده بود ، اما سوابق چت شما را فقط برای امروز نگه داشتیم.',
        //     showCloseButton: true,
        //     showCancelButton: true,
        //     focusConfirm: false,
        //     confirmButtonText:
        //         '<i class="fa fa-thumbs-up bg-light"></i> باشه!',
        //     confirmButtonAriaLabel: 'Thumbs up, great!',
        //     cancelButtonText:
        //         '<i class=""></i>',
        //     cancelButtonAriaLabel: ''
        // })
        let mac = "<?php echo $mac ?>";
            let date = "<?php echo date('Y-m-d') ?>";
            let data = "<?php echo 'chat_history/'.$mac.date('Y-m-d').'.json' ?>";
            window.setInterval(function (){

            },200000);

            $.get(data).done(function(result) {
                for (let i in result){
                    if (result[i].mac_address == mac && result[i].timestamp == date ){
                        if (result[i].type == 'user'){
                            $('#chatarea').append('<div class="user-chat-box text-right mr-4 mt-2">'+result[i].text+'</div>');
                            if (result[i].fileType == 'image/jpg'){
                                $('#chatarea').append('<img src="'+result[i].filePath+'" data-path="'+result[i].filePath+'" class="user-chat-img shadow" width="150">');

                            }
                            if (result[i].fileType == 'audio/wav'){
                                $('#chatarea').append('<audio controls><source src="'+result[i].filePath+'" data-path="'+result[i].filePath+'" type="audio/ogg"></audio>');

                            }
                        } else if (result[i].type == 'admin'){
                            $('#chatarea').append('<div class="admin-chat-box text-right">'+result[i].text+'</div>');
                        }
                        var n = $('#chatarea').height();
                        $('html, #chatarea').animate({ scrollTop: n }, 50);
                    }
                }
            }).fail(function() {
                // alert('Not Found');
            })
        }
        */
    //showChat('<?php //echo $mac.date('Y-m-d').'.json' ?>//');

</script>
<!--<script src="/global_assets/js/chats/prepare.js"></script>-->
<!--<script src="/global_assets/js/chats/send.js"></script>-->
<!--<script src="/global_assets/js/chats/receive.js"></script>-->
<!--<script src="/global_assets/js/chats/user_update.js"></script>-->