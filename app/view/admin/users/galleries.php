<!-- Content Wrapper. Contains page content -->
<link rel="stylesheet" href="dist/css/users.css">
<div class="content-wrapper">
    <hr>
    <div class="page-content">


        <!-- Main content -->
        <section class="content">
           <h4>گالری تصاویر</h4>
            <hr>
            <div>
                <?php
                    if(isset($galleries)){
                        foreach ($galleries as $gallery){
                            $path = $gallery['path'];
                            echo  "<a href='/storage/chat/$path' target='_blank'>
                                        <img src='/storage/chat/$path' width='150'/>
                                    </a>";
                        }
                    }
                ?>
            </div>
        </section>
        <!-- /.content -->
    </div>
</div>
<!-- /.content-wrapper -->
<script src="https://adminlte.io/themes/dev/AdminLTE/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
