<?php if (isset($_GET['invoice_id'])) : ?>
    <h2>Chi tiết hóa đơn <?= $_GET['invoice_id'] ?></h2>
    <?php

    // hủy đơn hàng
    if (isset($_POST['delete_invoice'])) {
        $invoice_id_delete = $_POST['invoice_id_delete'];
        mysqli_query($conn, "UPDATE invoice SET status = 2 WHERE invoice_id = $invoice_id_delete AND user_id = " . $_SESSION['client_logged_in'][0]);
        header("location: index.php?page_layout=invoice-detail");
    }


    // lấy dữ liệu hiển thị
    $sql = "SELECT * FROM invoice WHERE invoice_id = " . $_GET['invoice_id'] . " AND invoice.user_id = " . $_SESSION['client_logged_in'][0];
    $query = mysqli_query($conn, $sql);

    $invoice = mysqli_fetch_row($query);

    $productStrings = explode('-', $invoice['2']);
    $productIdsArray = array();
    $idsAndCount = array();

    foreach ($productStrings as $key => $value) {
        $productIdsArray[] = explode('#', $value)[0];
        $idsAndCount[explode('#', $value)[0]] =  explode('#', $value)[1];
    }

    $productIds = implode(", ", $productIdsArray);

    $sql1 = "SELECT * FROM product WHERE prd_id IN($productIds)";
    $query1 = mysqli_query($conn, $sql1);


    ?>

    <div id="my-cart">
        <div class="row">
            <div class="cart-nav-item col-lg-7 col-md-7 col-sm-12">Thông tin sản phẩm</div>
            <div class="cart-nav-item col-lg-2 col-md-2 col-sm-12">Tùy chọn</div>
            <div class="cart-nav-item col-lg-3 col-md-3 col-sm-12">Giá</div>
        </div>
        <form method="post">
            <?php
            $total_price_all = 0;
            while ($row = mysqli_fetch_array($query1)) {

                $total_price = $idsAndCount[$row["prd_id"]] * $row["prd_price"];
                $total_price_all += $total_price;
            ?>
                <div class="cart-item row">
                    <div class="cart-thumb col-lg-7 col-md-7 col-sm-12">
                        <img src="admin/img/products/<?php echo $row["prd_image"]; ?>">
                        <h4><?php echo $row["prd_name"]; ?></h4>
                    </div>

                    <div class="cart-quantity col-lg-2 col-md-2 col-sm-12">
                        <input name="qtt[<?php echo $row["prd_id"]; ?>]" type="number" id="quantity" class="form-control form-blue quantity" value="<?= $idsAndCount[$row["prd_id"]]  ?>" min="1" disabled>
                    </div>
                    <div class="cart-price col-lg-3 col-md-3 col-sm-12">
                        <b><?php echo $total_price; ?>đ</b>
                    </div>
                </div>
            <?php
            }
            ?>

            <div class="row">

                <div class="cart-total col-lg-2 col-md-2 col-sm-12"><b>Ngày tạo:</b></div>
                <div class="cart-total col-lg-2 col-md-2 col-sm-12"><b><?= date("d-m-Y", strtotime($invoice['6'])); ?></b></div>
                <div></div>
                <div class="cart-total col-lg-2 col-md-2 col-sm-12"><b>Tổng cộng:</b></div>
                <div class="cart-price col-lg-2 col-md-2 col-sm-12"><b><?php echo $total_price_all; ?>đ</b></div>

                <?php if ($invoice['5'] == 0) : ?>
                    <form method="post" style="display: inline;">
                        <input type="hidden" value="<?= $invoice['0'] ?>" name="invoice_id_delete" />
                        <button class="btn btn-danger" type="submit" name="delete_invoice">
                            Hủy đơn hàng
                        </button>
                    </form>
                <?php elseif ($invoice['5'] == 2) : ?>
                    <button type="button" class="btn btn-warning">
                        đơn hàng đã bị hủy
                    </button>
                <?php else : ?>
                    <button type="button" class="btn btn-info">
                        Đơn hàng đã được thanh toán
                    </button>
                <?php endif; ?>
            </div>
        </form>

    </div>

<?php else : ?>

<?php endif; ?>