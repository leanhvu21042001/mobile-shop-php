<?php 
$ads_id = $_GET['ads_id'];
$sql = "SELECT * FROM ads WHERE ads_id = $ads_id";
$query = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($query);

if(isset($_POST['sbm'])){
    $ads_name = $_POST['ads_name'];
    if($_FILES['ads_image']['name'] == ""){
        $ads_image = $row['ads_image'];
    }else{
        $ads_image = $_FILES['ads_image']['name'];
        $ads_image_tmp = $_FILES['ads_image']['tmp_name'];
        move_uploaded_file($ads_image_tmp, "img/products/".$ads_image);
    }
    $ads_type = $_POST['ads_type'];
    
    $ads_note = $_POST['ads_note'];
    $sql_update = "UPDATE ads SET ads_name = '$ads_name', ads_image = '$ads_image',  ads_type = '$ads_type', ads_note = '$ads_note' WHERE ads_id = $ads_id"; 

    mysqli_query($conn,$sql_update);

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
            <li class="active"><?= $row['ads_name'] ?></li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Quảng cáo: <?= $row['ads_name'] ?> </h1>
        </div>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12">
                        <form role="form" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Tên quảng cáo</label>
                                <input type="text" name="ads_name" required class="form-control" value="<?= $row['ads_name'] ?>" placeholder="">
                            </div>

                            <div class="form-group">
                                <label>Ảnh quảng cáo</label>
                                <input type="file" name="ads_image">
                                <br>
                                <div>
                                <img style="height: 360px;" src="img/ads/<?php echo $row['ads_image']; ?>">
                                </div>
                            </div>
        
                            <div class="form-group">
                                <label>Loại</label>
                                <select name="ads_type" class="form-control">
                                    <option <?php if($row['ads_type'] ==1 ){echo "selected";} ?> value=1>Banner</option>
                                    <option <?php if($row['ads_type'] ==0 ){echo "selected";} ?> value=0>Slide</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Mô tả quảng cáo</label>
                                <textarea name="ads_note" required class="form-control" rows="3">
                                <?= $row['ads_note'] ?>
                                </textarea>
                                <script>CKEDITOR.replace('ads_note')</script>
                            </div>
                            <button type="submit" name="sbm" class="btn btn-primary">Cập nhật</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                    </form>
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->
</div>
<!--/.main-->