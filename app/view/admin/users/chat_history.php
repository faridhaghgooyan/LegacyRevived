<link rel="stylesheet" href="../user/assets/css/chat.css">
<script src="../global_assets/js/chat.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

<section class="content-wrapper">

    <hr>
    <div class="page-content">
        <i class="fas fa-users font-1-rem d-inline"></i>
        <span class="iransans font-1-rem d-inline">سوابق چت</span>
        <hr>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>تصویر پروفایل</th>
                <th>نام کاربر</th>
                <th>نام دکتر</th>
                <th>نام فایل</th>
                <th>کنترل</th>
            </tr>
            </thead>
            <tbody>

            <?php $i = 1; foreach ($chat_history as $chat):?>

                <tr class="d-flex align-items-self">
                    <td><?php echo $i?></td>
                    <?php
                    if ($chat['user_id']) {
                        $username = $user->find($chat['user_id']);
                        $pic = '../'.$username['pic'];
                    } else {
                    }
                    ?>
                    <td ><div style="
                            background-image: url(<?php echo $pic?>);
                            background-size: cover;
                            background-position: center;
                            height: 50px;
                            width: 50px;
                            border-radius: 50%;
                            border: 1px solid #c8c8c8;
                            background-color: white;
                            "> </div></td>
                    <td>
                        <?php
                        if ($chat['user_id']){
                            $username = $user->find($chat['user_id']);
                            echo $username['firstName'].' '.$username['lastName'];
                        } else {
                            echo 'ناشناس';
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if ($chat['doctor_id']){
                            $doctor = $doctors->find($chat['doctor_id']);
                            echo $doctor['firstName'].' '.$doctor['lastName'];
                        } else {
                            echo 'بدون دکتر';
                        }
                        ?>
                    </td>
                    <td><?php echo $chat['title']?></td>
                    <td>
                        <div class="dropdown">
                            <a class="btn bg-dc3545 btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                مدیریت
                                <i class="fas fa-chevron-down"></i>

                            </a>
                            <div class="dropdown-menu bg-light" aria-labelledby="dropdownMenuButton">
                                <button class="dropdown-item btn btn-link" onclick="findChat('<?php echo $chat['file_name'];?>')" >مشاهده این سابقه</button>
                                <button  class="dropdown-item btn btn-link doctorbtn"
                                   data-id="<?php echo $chat['id']; ?>"
                                   data-drid="<?php if ($chat['doctor_id']){echo $chat['doctor_id'];} ?>"
                                    onclick="drModal(
                                    <?php echo $chat['id'];?>,
                                    <?php
                                    if($chat['doctor_id']){
                                        echo $chat['doctor_id'];
                                    }?>
                                            )"
                                   >اختصاص به دکتر
                                </button>
                            </div>
                        </div>

                    </td>
                </tr>
                <?php $i++;endforeach; ?>

            </tbody>
        </table>

    </div>

    <!-- Chat History Modal -->
    <div id="chatModal"  class="modal fade "  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">سوابق چت</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="chatarea" class="modal-body bg-whatsapp">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Doctors Modal -->
    <div id="doctorsModal"  class="modal fade "  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">اختصاص به دکتر</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="chatarea" class="modal-body">
                    <div class="text-center bg-info">
                        <i class="fas fa-user-md text-center modalicon"></i>
                    </div>
                    <div>*** شما در حال انتقال سوابق این چت به دکتر انتخابی هستید ، در انتخاب دکتر دقت فرمایید.</div>
                    <span>*** .سوابق چت حریم شخصی مراجعه کننده میباشد.</span>
                    <hr>
                    <h6>لیست دکتر ها</h6>
                    <form id="addtoChat" action="?c=chat&a=drtoChat" method="post" enctype="multipart/form-data">
                        <select name="doctors_list" id="" class="w-100">
                            <option value="default">یک دکتر را از لیست انتخاب کنید...</option>

                            <?php foreach($doctors->dr_list() as $doctor) : ?>
                                <option value="<?php echo $doctor["id"]?>"><?php echo $doctor["firstName"].' '.$doctor["lastName"]?></option>
                            <?php endforeach; ?>

                        </select>
                        <div id="formData">

                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">منصرف شدم</button>
                    <input id="addtoDr" type="submit" value="انتقال این چت به دکتر" name="انتقال این چت به دکتر" class="btn bg-dc3545">
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>


