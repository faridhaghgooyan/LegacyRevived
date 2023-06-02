<div class="col-md-12 grid-margin stretch-card rtl">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">ارسال پیام</h4>
            <p class="card-description"> در اسرع وقت <code>رسیدگی میکنیم</code>  </p>
            <form action="?c=ticket&a=storeTicket" method="post">
                <div class="row">
                    <input type="hidden" name="user_id" value="<?php echo $loggedUser_id?>">
                    <input type="hidden" name="code" value="0">
                    <div class="form-group col-sm-6 d-inline">
                        <label>عنوان</label>
                        <input type="text" name="title" class="form-control form-control-lg" placeholder="عنوان" aria-label="Username" required/>
                    </div>
                    <div class="form-group col-sm-6 d-inline">
                        <label>دپارتمان</label>
                        <select name="department" id="" class="form-control form-control-lg">
                            <option selected="true" disabled="disabled">یک دپارتمان را انتخاب کنید</option>

                            <option value="doctors">دکتران</option>
                            <option value="supporter">پشتیبانی</option>
                            <option value="finance">امور مالی</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>پیام شما</label>
                    <textarea name="text" class="form-control form-control-sm" placeholder="پیام شما ..." aria-label="Username" required/></textarea>
                </div>
                <button class="btn btn-success">ارسال پیام</button>
            </form>
        </div>
    </div>
</div>
