
<section class="content-wrapper">
    <!--    --><?php
    //    var_dump();
    //    die();
    //    ?>
    <hr>
    <div class="page-content">
        <i class="fas fa-users font-1-rem d-inline"></i>
        <span class="iransans font-1-rem d-inline">زیر مجموعه تیم مدیریت</span>
        <hr>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>پروفایل</th>
                <th>نام</th>
                <th>سمت</th>
                <th>زیر مجموعه ها</th>
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
                    <td><?php echo $user['mobile']?></td>
                    <td><?php echo $user['email']?></td>
                    <td><?php echo $user['email']?></td>
                    <td><?php
                        $roll_id = $user['roll'];
                        echo $user_obj->findRoll($roll_id)["fa_title"];
                        ?>
                    </td>
                    <!--                    <td >-->
                    <!--                        <span class="badge badge-success">Online</span>-->
                    <!--                    </td>-->
                    <td>
                        <div class="dropdown">
                            <a class="btn bg-info btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                مدیریت
                                <i class="fas fa-chevron-down"></i>

                            </a>
                            <div class="dropdown-menu bg-light" aria-labelledby="dropdownMenuButton">

                                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#rollModal" onclick="addUserId('#userRolls',<?php echo $user['id']?>)">
                                    تغییر سمت
                                </button>
                            </div>
                        </div>
                        <?php if ($user['status'] =='active') :?>
                            <form action="?c=users&a=status" method="post">
                                <input type="hidden" name="status" value="block">
                                <input type="hidden" name="user_id" value="<?php echo $user['id']?>">
                                <button class="btn btn-danger">مسدود سازی</button>
                            </form>
                        <?php else: ?>
                            <form action="?c=users&a=status" method="post">
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