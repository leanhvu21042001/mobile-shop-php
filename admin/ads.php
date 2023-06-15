<?php
if(!defined("SECURITY")){
	die("Bạn không có quyền truy cập vào file này!");
}
if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page =1;
}
$row_per_page = 5;
$per_row = $page*$row_per_page - $row_per_page;

$total_row = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM ads"));
$total_page = ceil($total_row/$row_per_page);
$list_page ='' ;
$page_prev = $page - 1;
if($page_prev <= 0){
    $page_prev =1;
}
$list_page.= '<li class="page-item"><a class="page-link" href="index.php?page_layout=ads&page='.$page_prev.'">&laquo;</a></li>';
for($i=1; $i<= $total_page; $i++){
    if($i==$page){ 
        $active = "active";
    }
    else{
        $active='';
    }
    $list_page.='<li class="page-item '.$active.'"><a class="page-link" href="index.php?page_layout=ads&page='.$i.'">'.$i.'</a></li>';

}
$page_next ='';
$page_next = $page + 1;
if($page_next > $total_page){
    $page_next = $total_page;
}
$list_page.='<li class="page-item"><a class="page-link" href="index.php?page_layout=ads&page='.$page_next.'">&raquo;</a></li>';

$sql = "SELECT * FROM ads ORDER BY ads_id DESC LIMIT $per_row, $row_per_page";
$query = mysqli_query($conn, $sql);
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li class="active">Danh sách quảng cáo</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách quảng cáo</h1>
        </div>
    </div>
    <!--/.row-->
    <div id="toolbar" class="btn-group">
        <a href="index.php?page_layout=add_ads" class="btn btn-success">
            <i class="glyphicon glyphicon-plus"></i> Thêm quảng cáo
        </a>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table data-toolbar="#toolbar" data-toggle="table">

                        <thead>
                            <tr>
                                <th data-field="id" data-sortable="true">ID</th>
                                <th data-field="name" data-sortable="true">Tên quảng cáo</th>
                                <th>Ảnh quảng cáo</th>
                                <th>Loại</th>
                                <th>Ghi chú</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while($row = mysqli_fetch_array($query)){
                            ?>
                            <tr>
                                <td style=""><?php echo $row['ads_id']; ?></td>
                                <td style=""><?php echo $row['ads_name']; ?></td>
                                <td style="text-align: center"><img height="100" src="img/ads/<?php echo $row['ads_image']; ?>" /></td>
                                <td><?php
                                    if($row['ads_type'] == 1){
                                        echo '<span class="label label-success">Banner</span>';
                                    }else{
                                        echo '<span class="label label-primary">Slide</span>';
                                    }
                                    ?></td>
                                <td><?php echo $row['ads_note']; ?></td>
                                <td class="form-group">
                                    <a href="index.php?page_layout=edit_ads&ads_id=<?= $row['ads_id']?>" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>
                                    <a href="del_ads.php?ads_id=<?= $row['ads_id']?>" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                        <?= $list_page;
                        ?>
                            <!-- <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">&raquo;</a></li> -->
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!--/.row-->
</div>
<!--/.main-->