<!--	List Product	-->
<?php
$prd_id = $_GET['prd_id'];
$sql = "SELECT * FROM product WHERE prd_id = $prd_id ";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query);
?>
<div id="product">

    <div id="product-head" class="row">
        <div id="product-img" class="col-lg-6 col-md-6 col-sm-12">
            <img src="admin/img/products/<?= $row['prd_image'] ?>">
        </div>
        <div id="product-details" class="col-lg-6 col-md-6 col-sm-12">
            <h1> <?= $row['prd_name'] ?></h1>
            <ul>
                <li><span>Bảo hành:</span> <?= $row['prd_warranty'] ?></li>
                <li><span>Đi kèm:</span> <?= $row['prd_accessories'] ?></li>
                <li><span>Tình trạng:</span> <?= $row['prd_new'] ?></li>
                <li><span>Khuyến Mại:</span> <?= $row['prd_promotion'] ?></li>
                <li id="price">Giá Bán (chưa bao gồm VAT)</li>
                <li id="price-number"><?= number_format($row['prd_price']) ?> đ</li>
                <?php
                if ($row['prd_status'] == 1) {

                    echo  '<li id="status" class = "text-success">Còn hàng</li>';
                } else {
                    echo '<li id="status" class = "text-danger">Hết hàng</li>';
                }
                ?>
            </ul>
            <div id="add-cart">
                <a href="modules/cart/cart_add.php?prd_id=<?= $row['prd_id'] ?>">Mua ngay</a>
            </div>
        </div>
    </div>
    <div id="product-body" class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h3>Đánh giá về iPhone X 64GB</h3>
            <p>
                Màn hình OLED có hỗ trợ HDR là một sự nâng cấp mới của Apple thay vì màn hình LCD với IPS được tìm thấy trên iPhone 8 và iPhone 8 Plus đem đến tỉ lệ tương phản cao hơn đáng kể là 1.000.000: 1, so với 1.300: 1 ( iPhone 8 Plus ) và 1.400: 1 ( iPhone 8 ).
            </p>
            <p>
                Màn hình OLED mà Apple đang gọi màn hình Super Retina HD có thể hiển thị tông màu đen sâu hơn. Điều này được thực hiện bằng cách tắt các điểm ảnh được hiển thị màu đen còn màn hình LCD thông thường, những điểm ảnh đó được giữ lại. Không những thế, màn hình OLED có thể tiết kiệm pin đáng kể.
            </p>
            <p>
                Cả ba mẫu iPhone mới đều có camera sau 12MP và 7MP cho camera trước, nhưng chỉ iPhone X và iPhone 8 Plus có thêm một cảm biến cho camera sau. Camera kép trên máy như thường lệ: một góc rộng và một tele. Vậy Apple đã tích hợp những gì vào camera của iPhone X?
            </p>
            <p>
                Chống rung quang học (OIS) là một trong những tính năng được nhiều hãng điện thoại trên thế giới áp dụng. Đối với iPhone X, hãng tích hợp chống rung này cho cả hai camera, không như IPhone 8 Plus chỉ có OIS trên camera góc rộng nên camera tele vẫn rung và chất lượng bức hình không đảm bảo.
            </p>
            <p>
                Thứ hai, ống kính tele của iPhone 8 Plus có khẩu độ f / 2.8, trong khi iPhone X có ống kính tele f / 2.2, tạo ra một đường cong nhẹ và có thể chụp thiếu sáng tốt hơn với ống kính tele trên iPhone X.
            </p>
            <p>
                Portrait Mode là tính năng chụp ảnh xóa phông trước đây chỉ có với camera sau của iPhone 7 Plus, hiện được tích hợp trên cả iPhone 8 Plus và iPhone X. Tuy nhiên, nhờ sức mạnh của cảm biến trên mặt trước của iPhone X, Camera TrueDepth cũng có thể chụp với Potrait mode.
            </p>
        </div>
    </div>

    <!--	Comment	-->
    <?php
    if (isset($_POST['sbm'])) {
        $comm_name = $_POST['comm_name'];
        $comm_mail = $_POST['comm_mail'];
        date_default_timezone_set("Asia/Bangkok");
        $comm_date = date("Y-m-d H:i:s");
        $comm_details = $_POST['comm_details'];

        $sql = "INSERT INTO comment(prd_id,comm_name,comm_mail,comm_date,comm_details) VALUES ($prd_id,'$comm_name','$comm_mail','$comm_date','$comm_details')";
        mysqli_query($conn, $sql);
    }
    ?>
    <div id="comment" class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h3>Bình luận sản phẩm</h3>
            <form method="post">
                <div class="form-group">
                    <label>Tên:</label>
                    <input name="comm_name" required type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input name="comm_mail" required type="email" class="form-control" id="pwd">
                </div>
                <div class="form-group">
                    <label>Nội dung:</label>
                    <textarea name="comm_details" required rows="8" class="form-control"></textarea>
                </div>
                <button type="submit" name="sbm" class="btn btn-primary">Gửi</button>
            </form>
        </div>
    </div>
    <!--	End Comment	-->

    <!--	Comments List	-->
    <div id="comments-list" class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <?php
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }
            $row_per_page = 5;
            $per_row = $page * $row_per_page - $row_per_page;

            $total_row = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM comment WHERE prd_id = '$prd_id'"));
            $total_page = ceil($total_row / $row_per_page);
            $list_page = '';
            $page_prev = $page - 1;
            if ($page_prev <= 0) {
                $page_prev = 1;
            }
            $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=product&prd_id=' . $prd_id . '&page=' . $page_prev . '">&laquo;</a></li>';
            for ($i = 1; $i <= $total_page; $i++) {
                if ($i == $page) {
                    $active = "active";
                } else {
                    $active = '';
                }
                $list_page .= '<li class="page-item ' . $active . '"><a class="page-link" href="index.php?page_layout=product&prd_id=' . $prd_id . '&page=' . $i . '">' . $i . '</a></li>';
            }
            $page_next = '';
            $page_next = $page + 1;
            if ($page_next > $total_page) {
                $page_next = $total_page;
            }
            $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=product&prd_id=' . $prd_id . '&page=' . $page_next . '">&raquo;</a></li>';


            $sql_comm = "SELECT * FROM comment WHERE prd_id = '$prd_id' ORDER BY comm_id DESC LIMIT $per_row,$row_per_page ";
            $query_comm = mysqli_query($conn, $sql_comm);
            while ($row_comm = mysqli_fetch_array($query_comm)) {
            ?>
                <div class="comment-item">
                    <ul>
                        <li><b><?= $row_comm['comm_name'] ?></b></li>
                        <li><?= $row_comm['comm_date'] ?></li>
                        <li>
                            <p><?= $row_comm['comm_details'] ?></p>
                        </li>
                    </ul>
                </div>
            <?php } ?>
        </div>
    </div>
    <!--	End Comments List	-->
</div>
<!--	End Product	-->
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