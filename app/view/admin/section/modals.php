
<!-- Comment Modal -->
<div id="commentModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">توضیحات </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-tootfarangee" data-dismiss="modal">خواندم</button>
            </div>
        </div>
    </div>
</div>
<!-- Comments -->

<!-- History Modal -->
<div id="historyModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="chatarea" class="bg-whatsapp">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-tootfarangee" data-dismiss="modal">خواندم</button>
            </div>
        </div>
    </div>
</div>
<!-- Dr Comment Modal -->
<div id="drCommentModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="drCommentModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ثبت نظر برای این وظیفه</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <span>*** ثبت این نظر به تسریع امور آتی کمک شایانی خواهد کرد ، به همین دلیل لطفا توضیحات کاملی ارائه کنید.</span>
                <!-- Store Dr Comments -->
                <form id="drCommentForm" action="?c=tasks&a=dr_done" method="post">
                    <textarea name="drComment" class="drComment w-100 select" placeholder=" نظر شما درباره این مورد چه بود ؟" required></textarea>
                    <input type="submit" class="btn btn-success" value="ثبت نظر و تایید انجام این وظیفه">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">بستن</button>
            </div>
        </div>
    </div>
</div>
<!-- Factor Modal -->
<div id="addInvoice" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">صدور فاکتور</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body text-center">

                <!-- Store Dr Comments -->
                <form id="createInvoice" action="?c=invoices&a=create" method="post">
                    <!-- Important Data -->

                    <input id="invoice_chat_code" type="hidden" name="chat_code">

                    <input type="hidden" name="creator_id" value="<?php echo $admin_info->id;?>">
                    <input name="subject" placeholder="بابت ؟"
                           class="select w-100 curve-border"
                    required>
                    <br>
                    <input id="invoicePrice" name="final_price" placeholder="یک مبلغ به ریال وارد کنید..."
                           class="select w-100 curve-border"
                           type="text"="this.value=separate(this.value);"
                           required>
                    <br>
                    <div class="form-group">
                        <label for="inputDescription">بازه زمانی پیشنهادی زیباجو

                        <input type="text" id="dateInput" name="from_date" class="select w-100 curve-border "
                               placeholder="از تاریخ..." required>
                        <input type="text" id="dateInput2" name="to_date" class="select w-100 curve-border "
                               placeholder="تا تاریخ..." required>
                        </label>
                    </div>
                    <textarea name="description" id="" class="w-100 curve-border" rows="5" placeholder="شرح حال و شرح درمان ..." style="resize: none;"></textarea>
                    <label for="">حداقل مبلغ پیش پرداخت به تومان</label>
                    <input type="number" name="min_price" class="select w-100 curve-border"
                           placeholder="حداقل مبلغ قابل پرداخت ( به تومان )" required min="1"  oninput="get_percent()">
                    <span id="getPriceBox" class="text-center">


                    </span>
                    <span>
                        <strong class="invoice_percent">نا مشخص</strong>
                        درصد از مبلغ کل
                    </span>

                    <br>
<!--                    <input type="number" name="disPrice" placeholder="چند درصد تخفیف میدهید ؟ اجباری نیست..." class="select">-->
<!--                    <br>-->
<!--                    <textarea name="description" class="drComment text-dark" placeholder=" نظر شما درباره این مورد چه بود ؟" required style="color: black!important;"></textarea>-->
                    <input type="submit" class="btn btn-success text-center" value="ایجاد فاکتور">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">بستن</button>
            </div>
        </div>
    </div>
</div>
<!-- Consultant Modal -->
<div id="addToConsultant" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addToConsultant" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">اخصتصاص این چت به مشاور</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <span>*** توجه داشته باشید در صورتی که این فایل را به شخص دیگری اختصاص بدهید ، دسترسی شما به این فایل مسدود خواهد شد.</span>
                <hr>
                <!-- Change Chat File Owner -->
                <form id="addToConsultantForm" action="?c=chat&a=addToConsultant" method="post">
                    <select name="consultant_id" id="consultant_id" class="select" required >
                        <option value="" disabled selected>یک مشاور را انتخاب کنید...</option>
                        <?php if (isset($consultants)) : ?>
                            <?php foreach ($consultants as $consultant): ?>
                                <option value="<?php echo $consultant['id']?>" ><?php echo $consultant['firstName'].' '.$consultant['lastName']?></option>
                            <?php endforeach;?>
                        <?php endif; ?>

                    </select>

                    <br>
                    <!--                    <input type="number" name="disPrice" placeholder="چند درصد تخفیف میدهید ؟ اجباری نیست..." class="select">-->
                    <!--                    <br>-->
                    <!--                    <textarea name="description" class="drComment text-dark" placeholder=" نظر شما درباره این مورد چه بود ؟" required style="color: black!important;"></textarea>-->
                    <input type="submit" class="btn btn-success text-center" value="تغییر دسترسی" >
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">بستن</button>
            </div>
        </div>
    </div>
</div>
<!-- Supporter Modal -->
<div id="addToSupporter" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addToSupporter" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">اخصتصاص این چت به مشاور</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <span>*** توجه داشته باشید در صورتی که این فایل را به شخص دیگری اختصاص بدهید ، دسترسی شما به این فایل مسدود خواهد شد.</span>
                <hr>
                <!-- Change Chat File Owner -->
                <form id="addToSupporterForm" action="?c=chat&a=addToSupporter" method="post">
                    <textarea name="message" id="" cols="30" rows="5" class="w-100" placeholder="توضیحات تکمیلی را به پشتیبان ارائه کنید..." style="width: 100%!important;" required></textarea>
                    <select name="supporter_id" id="supporter_id" class="select" required >
                        <option value="" disabled selected>یک پشتیبان را انتخاب کنید...</option>
                        <?php if (isset($supporters)) : ?>
                            <?php foreach ($supporters as $supporter): ?>
                                <option value="<?php echo $supporter['id']?>" ><?php echo $supporter['firstName'].' '.$supporter['lastName']?></option>
                            <?php endforeach;?>
                        <?php endif; ?>

                    </select>

                    <br>
                    <!--                    <input type="number" name="disPrice" placeholder="چند درصد تخفیف میدهید ؟ اجباری نیست..." class="select">-->
                    <!--                    <br>-->
                    <!--                    <textarea name="description" class="drComment text-dark" placeholder=" نظر شما درباره این مورد چه بود ؟" required style="color: black!important;"></textarea>-->
                    <input type="submit" class="btn btn-success text-center" value="تغییر دسترسی" >
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">بستن</button>
            </div>
        </div>
    </div>
</div>
<!-- Sms Modal -->
<div id="smsModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ارسال پیامک به زیباجو</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="?c=sms&a=sendSMS" method="post">

                        <select name="message" id="smsList" class="w-100 select2">
                            <?php if ($sms_list) : ?>
                                <?php foreach ($sms_list as $sms) :?>
                                    <option value="<?php echo $sms['text'];?>"><?php echo $sms['text'];?></option>
                                <?php endforeach; ?>
                            <?php endif;?>

                        </select>

                    <select name="receptor" id="userList" class="w-100 select2">
                        <?php if ($users_list) : ?>
                            <?php foreach ($users_list as $user) :?>
                                <option value="<?php echo $user['mobile'];?>"><?php echo $user['firstName'].' '.$user['lastName'];?></option>
                            <?php endforeach; ?>
                        <?php endif;?>
                    </select>
                    <button class="btn btn-success" value="ارسال پیامک">ارسال پیامک</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-tootfarangee" data-dismiss="modal">خواندم</button>
            </div>
        </div>
    </div>
</div>
<!-- TODOs Modal -->
<div id="todoModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تنظیم یک یادآور</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="todoForm" action="?c=todo&a=store" method="post" style="z-index: 239000!important;">
                    <input type="hidden" name="creator_id" value="<?php if (isset($admin_info->id)){echo $admin_info->id;} ?>">

                    <input type="hidden" name="chat_code" readonly >


                    <div class="form-group">
                        <label for="inputDescription">یادآوری کن در تاریخ : </label>

                        <input type="text" id="due-date-modal" name="due_date_jalali"  placeholder="تاریخ مراجعه را انتخاب کنید...">
                    </div>
                    <div class="form-group">
                        <label for="inputDescription">در ساعت </label>
                        <input type="number" name="hour" max="23" min="00"
                               onchange="if(parseInt(this.value,10)<10)this.value='0'+this.value;"
                               placeholder="یک ساعت را انتخاب کنید...">
                        <label for="inputDescription"> و دقیقه </label>
                        <input type="number" name="minute" max="59" min="00"
                               onchange="if(parseInt(this.value,10)<10)this.value='0'+this.value;"
                               placeholder="یک دقیقه را انتخاب کنید...">
                    </div>
                    <label for="message">که :</label>
                    <textarea name="message" id="" class="w-100 curve-border" rows="5" placeholder="توضیحات تکمیلی..."></textarea>

                    <button class="btn btn-success" value="ارسال پیامک">ذخیره کن</button>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- Notes Modal -->
<div id="noteModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">یادداشت ها</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
<!--                <label for="message">یادداشت قدیمی</label>-->
<!--                <table class="table table-striped myTable">-->
<!--                    <thead>-->
<!--                    <tr>-->
<!--                        <th scope="col">#</th>-->
<!--                        <th scope="col">توضیحات</th>-->
<!--                        <th scope="col">تاریخ ایجاد</th>-->
<!--                        <th scope="col">مدیریت</th>-->
<!--                    </tr>-->
<!--                    </thead>-->
<!--                    <tbody>-->
<!--                    <tr>-->
<!--                        <th scope="row">1</th>-->
<!--                        <td>Mark</td>-->
<!--                        <td>Otto</td>-->
<!--                        <td>@mdo</td>-->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                        <th scope="row">2</th>-->
<!--                        <td>Jacob</td>-->
<!--                        <td>Thornton</td>-->
<!--                        <td>@fat</td>-->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                        <th scope="row">3</th>-->
<!--                        <td>Larry</td>-->
<!--                        <td>the Bird</td>-->
<!--                        <td>@twitter</td>-->
<!--                    </tr>-->
<!--                    </tbody>-->
<!--                </table>-->
                <br>

                <form id="noteForm" action="?c=notes&a=store" method="post">

                    <label for="message">یادداشت جدید</label>
                    <input type="hidden" name="chat_code" value="">
                    <textarea name="text" id="" class="w-100 curve-border" rows="3" placeholder="توضیحات تکمیلی..."></textarea>

                    <button class="btn btn-success" value="ارسال پیامک">ذخیره کن</button>
                </form>
            </div>

        </div>
    </div>
</div>
<div id="messageModal" class="modal fade" tabindex="-1" role="dialog" >
    <div class="modal-dialog" role="document">
        <div class="modal-content " >
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">توضیحات</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-2 bg-white shadow-lg border" style="background-color:#e3e3e3;border: 1px dashed #e3e3e3;border-radius: 15px;margin: 20px">

            </div>
            <br>

        </div>
    </div>
</div>
<!-- Reminder todos Modal -->
<div id="reminderModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> یک یادآور : برای زیباجو <span id="userName"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">

            <div class="modal-body">

                <div class="form-group">
                    <label for="inputDescription">یادآوری کن در تاریخ : </label>

                    <input type="text" id="todo_due_date" name="due_date_jalali" class="select2 d-inline" value="<?php echo $todo['due_date']?>" placeholder="تاریخ مراجعه را انتخاب کنید...">
                </div>
                <div class="form-group">
                    <label for="inputDescription">در ساعت </label>

                    <input type="time" class="d-inline" name="due_time" placeholder="12:00 AM...">
                </div>
                <label for="message">که :</label>
                <textarea name="message" id="" class="w-100 curve-border" rows="5" placeholder="توضیحات تکمیلی برای دکتر..."></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">انجام شد</button>
                <button type="button" class="btn bg-tootfarangee" data-dismiss="modal">تغییر زمان</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Customer Details Modal -->
<div id="customerDetailsModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> پرونده زیباجو : <span id="detailsUserName"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <ul>
                            <li>نام و نام خانوادگی</li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                    <div class="col-sm-6">test</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-tootfarangee" data-dismiss="modal">خواندم</button>
            </div>
        </div>
    </div>
</div>
<!-- Customer Details Modal -->
<div id="publicModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">  <span id="publicModalSubject"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-tootfarangee" data-dismiss="modal">خواندم</button>
            </div>
        </div>
    </div>
</div>
<!-- Nurse Comment Modal -->
<div id="nurseModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> تایید انجام کار و ثبت توضیحات <span id="publicModalSubject"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <q>با ارائه توضیحات تکمیلی به افزایش کیفیت کاری مجموعه کمک کنید.</q>
                <form id="nurseDueForm" action="?c=tasks&a=operatorComment" method="post" enctype="multipart/form-data">
                    <textarea name="operator_comment" class="iransans w-100" cols="30" rows="3" placeholder="توضیحات تکمیلی درباره این مراجعه" required></textarea>
                    <input type="submit" class="btn btn-success" value="تایید این کار و ثبت نظر">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-tootfarangee" data-dismiss="modal">خواندم</button>
            </div>
        </div>
    </div>
</div>
<!-- Reminder Content Modal -->
<div id="reminderContentModal" class="modal fade" tabindex="-1" data-backdrop="static" role="dialog" style="z-index: 5000!important;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">  <span id="publicModalSubject"></span></h5>

            </div>
            <div class="modal-body" style="z-index: 5001!important;">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>زیباجو</th>
                            <th>تاریخ ثبت آلارم</th>
                            <th>ساعت</th>
<!--                            <th>کنترل</th>-->
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td id="customer_name"></td>
                            <td id="due_date"></td>
                            <td id="due_time"></td>
                            <td>
<!--                                <abbr title="مشاهده پرونده زیباجو">-->
<!--                                    <a id="showUserDetails" href="?c=users&a=getUserDetails&id=210">-->
<!--                                        <i class="fa fa-file"></i>-->
<!--                                    </a>-->
<!--                                </abbr>-->
                            </td>
                        </tr>

                        </tbody>
                    </table>
                    <div id="reminder-content">

                    </div>
            </div>
            <div class="modal-footer">
                <a id="todo_done_btn" type="button" class="btn btn-success" >انجام شد</a>
                <a id="todo_change_btn" type="button" class="btn bg-tootfarangee" >تغییر زمان</a>
            </div>
        </div>
    </div>
</div>
