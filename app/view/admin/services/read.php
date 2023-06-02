<!-- Content Wrapper. Contains page content -->
<style>

    .select{
        width: 100%;
        border: 1px solid lightgrey;
        border-radius: 10px;
        padding: 5px;
        transition: 0.5s;
    }
    .select:hover{
        cursor: pointer;
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
    }
    .supporter_comment{
        width: 100%;
        border: 1px solid lightgrey;
        border-radius: 10px;
        padding: 5px;
        transition: 0.5s;
    }
    .supporter_comment:hover{
        cursor: pointer;
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
    }
    label {
        margin-right: 10px;
    }
    /*DropZone*/
    .drop-zone {
        max-width: 100%;
        min-height: 200px;
        padding: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        font-weight: 500;
        font-size: 20px;
        cursor: pointer;
        color: #cccccc;
        border: 2px dashed #2980b9;
        border-radius: 10px;
    }
    .drop-zone-btn{
        background-color: #2980b9;
        color: white;
    }
    #fileUpload{
        font-size: 1.5rem;
    }




</style>
<div class="content-wrapper">
    <hr>
    <div class="page-content">

        <form action="index.php?c=services&a=update&id=<?php echo $service['id']?>" method="POST" enctype="multipart/form-data">
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <i class="fas fa-user-md font-1-rem d-inline"></i>
                    <span class="iransans font-1-rem d-inline">ویرایش خدمت</span>
                    <hr>
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-body">
                                <!-- Creator -->
                                <input type="hidden" name="creator_id" value="<?php echo $loggedUser_id?>">
                                <!-- Service Name -->
                                <div class="form-group">
                                    <label for="inputName">عنوان</label>
                                    <input id="inputName" type="text" name="title" required
                                           value="<?php echo $service['title']?>" placeholder="عنوان خدمت ..." class="select">
                                </div>
                                <!-- Service Price -->
                                <div class="form-group">
                                    <label for="inputName">قیمت</label>
                                    <input id="inputName" type="number" name="price" value="<?php echo $service['price']?>" placeholder="مبلغ خدمت به ریال ..." class="select" min="1">
                                </div>
                                <!-- Service Discounted Price -->
                                <div class="form-group">
                                    <label for="inputName">درصد تخفیف</label>
                                    <input id="inputName" type="number" name="disPrice" value="<?php echo $service['dis_price']?>" placeholder="درصد تخفیف خدمت ..." class="select" min="0" max="100">
                                    <br>
                                    <span>*** در صورتی که این خدمت تخفیف ندارد نیاز به وارد کردن نیست!</span>

                                </div>
                                <div class="form-group">
                                    <label for="inputDescription">توضیحات این خدمت</label>
                                    <textarea id="inputDescription" name="description" class="form-control supporter_comment" rows="4" placeholder="توضیحات کامل در خصوص این سرویس..."><?php echo $service['description']?></textarea>
                                </div>



                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>

                    </div>
                    <div class="col-sm-6">
                        <label for="dropZone">تصویر شاخص</label>
                        <br>
                        <img src="<?php echo $service['pic']?>" width="200">
                        <div id="dropZone" class="drop-zone" onclick="dropZone()">
                            <div class="drop-zone-description">
                                <input id="fileUpload" type="file" name="fileToUpload">

                                <a class="btn drop-zone-btn">اینجا کلیک کنید</a>
                            </div>
                        </div>


                    </div>


            </section>
            <hr>
            <div class="text-center">
                <a href="?c=services&a=list" class="btn btn-secondary">لغو</a>
                <input type="submit" value="ایجاد" class="btn btn-success float-right">
            </div>
        </form>
        <!-- /.content -->
    </div>
</div>
<!-- /.content-wrapper -->
<script src="../assets/js/jquery-1.12.4.min.js"></script>


<script src="../assets/js/users.js"></script>


