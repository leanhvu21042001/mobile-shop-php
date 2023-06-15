<script>
    function buyNow() {
        document.getElementById("buy-now").submit()
    }
</script>
<?php


if (isset($_SESSION["cart"]) and !empty($_SESSION['cart'])) {
    
    // $sql = "SELECT * FROM invoice INNER JOIN user ON invoice.user_id = user.user_id WHERE invoice.user_id = " . $_SESSION['client_logged_in'][0];
    $sql = "SELECT * FROM invoice WHERE invoice.user_id = " . $_SESSION['client_logged_in'][0];
    $query = mysqli_query($conn, $sql);

    var_dump(mysqli_fetch_array($query));
?>
    <!--	Cart	-->
    <div id="my-cart">
        <div class="row">
            <div class="cart-nav-item col-lg-7 col-md-7 col-sm-12">Thông tin sản phẩm</div>
            <div class="cart-nav-item col-lg-2 col-md-2 col-sm-12">Tùy chọn</div>
            <div class="cart-nav-item col-lg-3 col-md-3 col-sm-12">Giá</div>
        </div>
        <form method="post">
            <?php
            $total_price_all = 0;
            while ($row = mysqli_fetch_array($query)) {

                $total_price = $_SESSION["cart"][$row["prd_id"]] * $row["prd_price"];
                $total_price_all += $total_price;
            ?>
                <div class="cart-item row">
                    <div class="cart-thumb col-lg-7 col-md-7 col-sm-12">
                        <img src="admin/img/products/<?php echo $row["prd_image"]; ?>">
                        <h4><?php echo $row["prd_name"]; ?></h4>
                    </div>

                    <div class="cart-quantity col-lg-2 col-md-2 col-sm-12">
                        <input name="qtt[<?php echo $row["prd_id"]; ?>]" type="number" id="quantity" class="form-control form-blue quantity" value=<?php echo $_SESSION["cart"][$row["prd_id"]]; ?> min="1">
                    </div>
                    <div class="cart-price col-lg-3 col-md-3 col-sm-12"><b><?php echo $total_price; ?>đ</b><a href="modules/cart/cart_del.php?prd_id=<?php echo $row["prd_id"]; ?>">Xóa</a></div>
                </div>
            <?php
            }
            ?>

            <div class="row">
                <div class="cart-total col-lg-2 col-md-2 col-sm-12"><b>Tổng cộng:</b></div>
                <div class="cart-price col-lg-3 col-md-3 col-sm-12"><b><?php echo $total_price_all; ?>đ</b></div>
            </div>
        </form>

    </div>
    <!--	End Cart	-->
<?php
} else {
?>
    <div class="alert alert-danger mt-3">Giỏ hàng của bạn hiện không có sản phẩm nào !</div>
<?php
}
?>