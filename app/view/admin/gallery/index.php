<link rel="stylesheet" href="../assets/css/chats.css">
<style>
    .bg-whatsapp{
        min-height: 250px;
        max-height: 60vh;
        overflow: auto;
        background-image: url("../storage/chatbackground.jpg");
        background-repeat: repeat;
        background-size: 210px;
        border-radius: 10px;
        padding: 10px;
    }
    .drComment{
        width: 100%;
        border-radius: 10px;
        margin: 10px 0px;
        min-height: 100px;
        padding: 10px;
        border: 1px solid lightgrey;
    }
    #galleries{
        column-count: 4;
        padding : 50px 0;
    }
    @media all and (max-width  : 450px) {
        #galleries{
            column-count: 1;
        }
    }
    @media all and (min-width  : 800px) {
        #galleries{
            column-count: 2;
        }
    }
    @media all and (min-width  : 1200px) {
        #galleries{
            column-count: 4;
        }
    }



    .gallery-box{
        position: relative;
        margin-bottom: 10px;
    }
    .gallery-box img{
        border-radius: 10px;
        display : block;
        width : 100%;
    }
    .gallery-info{
        position: absolute;
        bottom : 10px;
        margin-right : 10px;
        background-color : rgba(0, 0, 0, 0.59);
        padding : 10px;
        border-radius: 10px;
        color : white;
    }
</style>
<section class="content-wrapper">
    <hr>
    <div class="page-content">
        <i class="fas fa-user-md font-1-rem d-inline"></i>
        <span class="iransans font-1-rem d-inline">گالری تصاویر</span>
        <hr>
        <div class="filters">
            <span class="iransans font-1-rem d-inline">فیلتر</span>
            <form action="" method="POST">
                <select name="chat_code" id="customerid" class="select iransans w-100 rtl select2">
                    <option  selected value="">همه</option>
                    <?php

                    foreach ($customers as $user){
                        $selected = $chat_code == $user["code"] ? 'selected' : '';
                        $name = !empty($user["lastName"]) ? $user["firstName"].' '.$user["lastName"] : "ناشناس با کد " . $user["code"];
                        echo '<option  '.$selected.' value="'.$user["code"].'">'.$name.'</option>';

                    }
                    ?>
                </select>
                <button class="btn btn-success">فیلتر کن</button>
            </form>
        </div>
        <hr>

        <div id="galleries">
            <?php foreach ($galleries as $gallery) : ?>
                <div class="gallery-box">
                    <a >
                        <img src="<?php echo $gallery['path']?>" alt="<?php echo $gallery['lastName']?>" onclick="this.requestFullscreen()">
                        <div class="gallery-info">
                            <span>
                               <?php echo $gallery['lastName']?>
                            </span>
                            <br>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

    </div>

    <div>

    </div>

    <!-- Require Modals -->


</section>

<script src="../assets/js/users.js"></script>
<script src="../global_assets/js/chat.js"></script>
