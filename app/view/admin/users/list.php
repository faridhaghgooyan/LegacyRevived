<section class="content-wrapper">
    <hr>
    <div class="page-content">
        <i class="fas fa-users font-1-rem d-inline"></i>
        <span class="iransans font-1-rem d-inline">لیست زیباجویان</span>
        <hr>
        <table class="table table-striped tablejs myTable">
            <thead>
            <tr>
                <th>#</th>
                <th>پروفایل</th>
                <th>نام</th>
                <th>نام خانوادگی</th>
                <th>مشاور</th>
                <th>شماره همراه</th>
                <th>کنترل</th>
            </tr>
            </thead>
            <tbody>
            <?php
            ?>
            <?php $i = 1; foreach ($customers as $user):?>
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
                    <td><?php echo $user['firstName']?></td>
                    <td><?php echo $user['lastName']?></td>
                    <td>
                        <?php
                            echo $user['nick_name'];
                        ?>
                    </td>
                    <td><?php echo $user['mobile']?>
                        <br>
                    <p class="text-muted"><?php echo $user['mobile_2']?></p>
                    </td>

                    <td>
                        <abbr title="بازگشت به چت زیباجو"  >
                            <a onclick="selectedChat(<?php echo $user['chat_code']?>)" class="btn btn-success btn-sm" href="?c=index&a=index#usersChatList<?php echo $user['chat_code']?>">
                                <i class="fas fa-folder">
                                </i>
                                بازگشت به چت
                            </a>
                        </abbr>
               
                        <?php if (isset($user['link'])) : ?>
                            <input id="link<?php echo $user['id'] ?>" type="text" value="https://clog.tootfarangee.com/guest.php?link=<?php echo $user['link'] ?>"
                                   style="width: 1px!important;background-color: #f4f4f4;border:none">
                        <abbr title="پیامک کردن لینک"  >
                            <a class="btn btn-success btn-sm"
                               href="?
                               c=sms&
                               a=sendSMS&
                               code=loginLink&
                               receptor=<?php echo $user['mobile'] ?>&
                               link=https://clog.tootfarangee.com/guest.php?link=<?php echo $user['link'] ?>
                            ">
                                <i class="fas fa-send">
                                </i>
                            </a>
                        </abbr>
                        <abbr title="کپی کردن لینک">
                            <a onclick="copyToClipboard('link<?php echo $user['id'] ?>')" class="btn btn-primary btn-sm">
                                <i class="fas fa-link">
                                </i>
                            </a>
                        </abbr>
                        <?php endif; ?>
                        <?php if (in_array($admin_info->roll_title,array(
                            'admin',
                            'consultant',
                            'site_admin',
                        ))) :?>
                        <abbr title="ویرایش">
                            <a class="btn btn-warning btn-sm" href="?c=users&a=read&id=<?php echo $user['id']?>">
                                <i class="fas fa-pencil-alt">
                                </i>
                            </a>
                        </abbr>


                        <?php endif; ?>
                        <?php if (in_array($admin_info->roll_title,array(
                            'admin',
                        ))) :?>


                            <abbr title="حذف">
                                <a class="btn btn-danger btn-sm" href="?c=users&a=userDelete&id=<?php echo $user['id']?>">
                                    <i class="fas fa-trash">
                                    </i>
                                </a>
                            </abbr>

                        <?php endif; ?>

                    </td>
                </tr>
                <?php $i++;endforeach; ?>

            </tbody>
        </table>

    </div>
</section>
<script>
    function selectedChat(chatCode){
        localStorage.setItem('selectedChat',chatCode);
    }
</script>