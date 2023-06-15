<!--	List Product	-->
<!-- Phân trang 9 sp 1 trang  -->
<?php
$cat_id = $_GET['cat_id'];
$cat_name = $_GET['cat_name'];

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$row_per_page = 9;
$per_row = $page * $row_per_page - $row_per_page;

$total_row = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM product WHERE cat_id = $cat_id"));
$total_page = ceil($total_row / $row_per_page);
$list_page = '';
$page_prev = $page - 1;
if ($page_prev <= 0) {
    $page_prev = 1;
}
$list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=category&cat_id='.$cat_id.'&cat_name='. $cat_name.'&page='. $page_prev .'">&laquo;</a></li>';
for ($i = 1; $i <= $total_page; $i++) {
    if ($i == $page) {
        $active = "active";
    } else {
        $active = '';
    }
    $list_page .= '<li class="page-item ' . $active . '"><a class="page-link" href="index.php?page_layout=category&cat_id='.$cat_id.'&cat_name='. $cat_name.'&page=' . $i . '">' . $i . '</a></li>';
}
$page_next = '';
$page_next = $page + 1;
if ($page_next > $total_page) {
    $page_next = $total_page;
}
$list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=category&cat_id='.$cat_id.'&cat_name='. $cat_name.'&page=' . $page_next . '">&raquo;</a></li>';

$sql = "SELECT * FROM product WHERE cat_id = '$cat_id' ORDER BY prd_id DESC LIMIT $per_row, $row_per_page ";
$query = mysqli_query($conn, $sql);
?>
<div class="products">
    <h3><?= $cat_name ?> (hiện có <?= mysqli_num_rows(mysqli_query($conn,"SELECT * FROM product WHERE cat_id = $cat_id")); ?> sản phẩm)</h3>
    <div class="product-list row">
        <?php
        while ($row = mysqli_fetch_array($query)) {
        ?>
            <div class="col-lg-4 col-md-6 col-sm-12 mx-product">
                <div class="product-item card text-center">
                    <a href="index.php?page_layout=product&prd_id=<?= $row['prd_id'] ?>"><img src="admin/img/products/<?= $row['prd_image'] ?>"></a>
                    <h4><a href="index.php?page_layout=product&prd_id=<?= $row['prd_id'] ?>"><?= $row['prd_name'] ?></a></h4>
                    <p>Giá Bán: <span><?= number_format($row['prd_price']) ?>đ</span></p>
                </div>
            </div>
        <?php } ?>
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
<!--	End List Product	-->