<?php
if (isset($_POST['keyword'])) {
    $keyword = $_POST['keyword'];
} else if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
} else {
    header("location: index.php");
}

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$str_key = '%' . str_replace(" ", "%", $keyword) . '%';

$row_per_page = 9;
$per_row = $page * $row_per_page - $row_per_page;

$prd_price = 0;


if (is_numeric($keyword)) {
    $prd_price = intval($keyword);
}

$total_row = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM product WHERE prd_name LIKE '$str_key' OR prd_price = $prd_price"));
$total_page = ceil($total_row / $row_per_page);

$list_page = '';
$page_prev = $page - 1;
if ($page_prev <= 0) {
    $page_prev = 1;
}
$list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=search&keyword=' . $keyword . '&page=' . $page_prev . '">&laquo;</a></li>';
for ($i = 1; $i <= $total_page; $i++) {
    if ($i == $page) {
        $active = "active";
    } else {
        $active = '';
    }
    $list_page .= '<li class="page-item ' . $active . '"><a class="page-link" href="index.php?page_layout=search&keyword=' . $keyword . '&page=' . $i . '">' . $i . '</a></li>';
}
$page_next = '';
$page_next = $page + 1;
if ($page_next > $total_page) {
    $page_next = $total_page;
}
$list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=search&keyword=' . $keyword . '&page=' . $page_next . '">&raquo;</a></li>';

// $arr_key = explode(" ", $keyword);
// $str_key = '%'.implode("%", $arr_key).'%';

$sql = "SELECT * FROM product WHERE prd_name LIKE '$str_key' OR prd_price = $prd_price ORDER BY prd_id DESC LIMIT $per_row,$row_per_page";
$query = mysqli_query($conn, $sql);

?>

<!--	List Product	-->
<div class="products">
    <div id="search-result">Kết quả tìm kiếm với sản phẩm <span><?= $keyword; ?></span></div>
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
        <?php
        }
        ?>
    </div>
</div>
<!--	End List Product	-->

<div id="pagination">
    <ul class="pagination">
        <?= $list_page ?>
        <!-- <li class="page-item"><a class="page-link" href="#">Trang trước</a></li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">Trang sau</a></li> -->
    </ul>
</div>