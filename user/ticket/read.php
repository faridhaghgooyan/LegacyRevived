
<div class="col-md-12 grid-margin stretch-card rtl">

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                در حال مطالعه پیام
                <?php echo $code;?>
            </h4>
            <p class="card-description"> در اسرع وقت <code>رسیدگی میکنیم</code>  </p>
            <div class="table-responsive">
                <table class="table custom-table text-dark">
                    <?php foreach ($messages as $message) :?>
                        <?php if ($message['roll'] == 'admin') : ?>
                            <tr > <td class="bg-light text-dark rounded m-2"><?php echo $message['text'];?></td> </tr>
                        <?php else: ?>
                            <tr class="m-2"> <td class="bg-danger text-white rounded m-2 mr-2"><?php echo $message['text'];?></td> </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
            </table>


            </div>
        </div>
    </div>


</div>
<div class="col-md-12 grid-margin stretch-card rtl">


    <div class="card">
        <div class="card-body">
            <form action="?c=ticket&a=storeTicket" method="post">
                <input type="hidden" name="code" value="<?php echo $code;?>">
                <input type="hidden" name="user_id" value="<?php echo $loggedUser_id;?>">

                <div class="form-group">
                    <label>پیام جدیدی دارید ؟</label>
                    <textarea name="text" class="form-control form-control-sm" placeholder="پیام شما ..." aria-label="Username" rows="5"/></textarea>
                </div>
                <button class="btn btn-success">ارسال پیام</button>
            </form>
        </div>
    </div>
</div>