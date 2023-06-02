
<section class="content-wrapper">
<!--    --><?php
//    var_dump();
//    die();
//    ?>
    <hr>
    <div class="page-content">
        <i class="fas fa-users font-1-rem d-inline"></i>
        <span class="iransans font-1-rem d-inline">لیست کاربران</span>
        <hr>
        <table class="table table-striped myTable">
            <thead>
            <tr>
                <th>#</th>
                <th>پروفایل</th>
                <th>نام</th>
                <th>سمت</th>
<!--                <th>شماره همراه</th>-->
<!--                <th>ایمیل</th>-->
                <th>وضعیت</th>
                <th>کنترل</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 1; foreach ($adminusers as $user):?>
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
                    <td><?php
                        $roll_id = $user['roll'];
                        echo $user_obj->findRoll($roll_id)["fa_title"];
                        ?>
                    </td>
                    <td><?php
                        if ($user['status'] == 'block'){
                            echo "<span class='badge badge-danger'>مسدود است</span>";
                        } else {
                            echo "<span class='badge badge-success'>مجاز است</span>";
                        }
                        ?></td>

                    <td>
                        <abbr title="ویرایش حساب کاربری"><a href="?c=users&a=read&id=<?php echo $user['id'];?>" class="btn btn-warning"><i class="fa fa-edit"></i></a></abbr>
                        <abbr title="حذف حساب کاربری"><a href="?c=users&a=userDelete&id=<?php echo $user['id'];?>" class="btn btn-danger"><i class="fa fa-trash"></i></a></abbr>

                        <?php if ($user['status'] === "active") :?>
                            <form action="?c=users&a=status" method="post" style="display: inline!important;">
                                <input type="hidden" name="status" value="block">
                                <input type="hidden" name="user_id" value="<?php echo $user['id']?>">
                                <button class="btn btn-danger" style="display: inline!important;">مسدود سازی</button>
                            </form>
                        <?php else: ?>
                            <form action="?c=users&a=status" method="post" style="display: inline!important;">
                                <input type="hidden" name="status" value="active">
                                <input type="hidden" name="user_id" value="<?php echo $user['id']?>">
                                <button class="btn btn-success">فعال سازی</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php $i++;endforeach; ?>

            </tbody>
        </table>

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