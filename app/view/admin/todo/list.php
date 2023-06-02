<section class="content-wrapper">
    <hr>
    <div class="page-content">
        <i class="fas fa-user-md font-1-rem d-inline"></i>
        <span class="iransans font-1-rem d-inline">لیست یادآور ها</span>
        <hr>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>زیباجو</th>
                <th>توضیحات</th>
                <th>تاریخ انجام</th>
                <th>ساعت انجام</th>
                <th>کنترل</th>
            </tr>
            </thead>
            <tbody>
            <?php $code ='' ?>
            <?php $i = 1; foreach ($todos as $todo):?>
                <tr class="d-flex align-items-self">
                    <td><?php echo $i++;?></td>
                    <td>

                        <?php
                        $username = !empty($todo['user_firstName']) ? $todo['user_firstName'] : $todo['lastName'];
                        echo !empty($username)  ? $username :  "ناشناس با کد " . $todo[4]?>
                    </td>
                    <td><?php echo $todo['message']?></td>

                    <td><?php echo $dateConvertor_obj->dateConvert($todo['due_date'])[0]['date']?></td>
                    <td><?php echo $dateConvertor_obj->dateConvert($todo['due_date'])[0]['time']?></td>
                    <td></td>

                    <td>
                        <a class="btn btn-success btn-sm" href="?c=index&a=index#usersChatList<?php echo $todo['chat_code']?>">
                            <i class="fas fa-folder">
                            </i>
                            بازگشت به چت
                        </a>
                        <a class="btn btn-primary btn-sm" href="?c=todo&a=edit&id=<?php echo $todo['id']?>">
                            <i class="fas fa-folder">
                            </i>
                            ویرایش
                        </a>

                        <a class="btn btn-danger btn-sm" href="?c=todo&a=delete&id=<?php echo $todo['id']?>">
                            <i class="fas fa-folder">
                            </i>
                            حذف
                        </a>

                    </td>
                </tr>
                <?php $i++;endforeach; ?>

            </tbody>
        </table>

    </div>

</section>