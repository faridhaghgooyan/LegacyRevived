<?php require 'section/modals.php'?>
<section class="content-wrapper">
    <!--    --><?php
    //    var_dump();
    //    die();
    //    ?>
    <hr>        

    <div class="page-content">
        <i class="fa fa-file font-1-rem d-inline"></i>
        <span class="iransans font-1-rem d-inline">سوابق زیباجو</span>

        <?php if ($admin_obj->find($admin_info->id)["roll_id"] !== '3'): ?>
            <a href="?c=users&a=addEfile" class="btn btn-info">+ایجاد پرونده</a>
        <?php endif; ?>

        <hr>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>پروفایل</th>
                <th>نام</th>
<!--                --><?php //if ($user_obj->find($loggedUser_id)["roll"] !== '3'): ?>
<!--                    <th>شماره همراه</th>-->
<!--                --><?php //endif; ?>
<!--                <th>ایمیل</th>-->
                <th>کنترل</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 1; foreach ($customers as $user):?>
            <?php if ($user['details']): ?>
                <tr class="d-flex align-items-self">
                    <td><?php echo $i?></td>

                    <?php $pic = '../'.$user['pic']; ?>
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
                    <td><?php echo $user['firstName'].' '.$user['lastName']?></td>
<!--                    --><?php //if ($user_obj->find($loggedUser_id)["roll"] !== '3'): ?>
<!--                        <td>--><?php //echo $user['mobile']?><!--</td>-->
<!--                    --><?php //endif; ?>
<!---->
<!--                    <td>--><?php //echo $user['email']?><!--</td>-->
                    <td>
                        <abbr title="پرونده زیباجو"><a href="?c=users&a=getUserDetails&id=<?php echo $user['id'];?>" class="btn btn-info"><i class="fa fa-file"></i></a></abbr>
<!--                        <abbr title="سوابق چت"><a href="?c=users&a=userDelete&id=--><?php //echo $user['id'];?><!--" class="btn btn-success"><i class="fa fa-comment"></i></a></abbr>-->

                    </td>
                </tr>
            <?php endif; ?>
                <?php $i++;endforeach; ?>

            </tbody>
        </table>

    </div>
    <div>

    </div>
    <!-- Rolls Modal -->
    <div id="rollModal"  class="modal fade "  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">تغییر سمت</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="chatarea" class="modal-body">
                    <div class="text-center bg-info">
                        <i class="fas fa-user-md text-center modalicon"></i>
                    </div>
                    <div>*** شما در حال تغییر سمت کاربر هستید ، در انتخاب سمت دقت فرمایید.</div>
                    <hr>
                    <h6>سمت ها</h6>
                    <form id="userRolls" action="?c=users&a=rollUpdate" method="post" enctype="multipart/form-data">
                        <select name="roll_id" id="" class="w-100">
                            <option value="default">یک سمت را از لیست انتخاب کنید...</option>

                            <?php foreach($rolls as $roll) : ?>
                                <option
                                    value="<?php echo $roll["id"]?>"><?php echo $roll["fa_title"]?>
                                </option>
                            <?php endforeach; ?>

                        </select>
                        <div id="formData">

                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">منصرف شدم</button>
                    <input id="addtoDr" type="submit" value="انتقال این چت به دکتر" name="انتقال این چت به دکتر" class="btn btn-success">
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>
<script src="../assets/js/users.js"></script>
<script src="../global_assets/js/userController.js"></script>
<script src="../global_assets/js/adminController.js"></script>
