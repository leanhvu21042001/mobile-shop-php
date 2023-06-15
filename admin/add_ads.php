<?php
if(isset($_POST['sbm'])){
    $ads_name = $_POST['ads_name'];
    $ads_image = $_FILES['ads_image']['name'];
    $ads_tmp_name = $_FILES['ads_image']['tmp_name'];
    $ads_type = $_POST['ads_type'];
    $ads_note = $_POST['ads_note'];
    
    $sql = "INSERT INTO ads(ads_name, ads_image, ads_type, ads_note) VALUES ('$ads_name', '$ads_image',  $ads_type, '$ads_note') ";

    mysqli_query($conn,$sql);

    move_uploaded_file($ads_tmp_name, 'img/ads/'.$ads_image);

    header("location: index.php?page_layout=ads");
}
?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li><a href="">Quản lý quảng cáo</a></li>
            <li class="active">Thêm quảng cáo</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Thêm quảng cáo</h1>
        </div>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-6">
                        <form role="form" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Tên quảng cáo</label>
                                <input required name="ads_name" class="form-control" placeholder="">
                            </div>

                            <div class="form-group">
                                <label>Ảnh quảng cáo</label>
        
                                <input required name="ads_image" type="file">
                                <br>
                                <div>
                                    <img src="img/download.jpeg">
                                </div>
                            </div>
                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                            <label>Trạng thái</label>
                            <select name="ads_type" class="form-control">
                                <option value=1 selected>Banner</option>
                                <option value=0>Slide</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Mô tả quảng cáo</label>

                            <textarea required name="ads_note" class="form-control" rows="3"></textarea>
                            <script>CKEDITOR.replace('ads_note')</script>
                        </div>
                        <button name="sbm" type="submit" class="btn btn-success">Thêm mới</button>
                        <button type="reset" class="btn btn-default">Làm mới</button>
                    
                    </div>
                    </form>
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->
</div>
<!--/.main-->