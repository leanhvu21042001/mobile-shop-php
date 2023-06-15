<?php

// hủy đơn hàng
if (isset($_POST['delete_invoice'])) {
    $invoice_id_delete = $_POST['invoice_id_delete'];
    mysqli_query($conn, "UPDATE invoice SET status = 2 WHERE invoice_id = $invoice_id_delete AND user_id = " . $_SESSION['client_logged_in'][0]);
    header("location: index.php?page_layout=invoice");
}

// $sql = "SELECT * FROM invoice INNER JOIN user ON invoice.user_id = user.user_id WHERE invoice.user_id = " . $_SESSION['client_logged_in'][0];
$sql = "SELECT * FROM invoice WHERE invoice.user_id = " . $_SESSION['client_logged_in'][0];
$query = mysqli_query($conn, $sql);

?>

<h2>Hóa đơn</h2>
<ul class="list-group">

    <?php while ($invoice = mysqli_fetch_array($query)) : ?>

        <!-- <?php
                $productStrings = explode('-', $invoice['invoice_products']);
                $productIdsArray = array();
                foreach ($productStrings as $key => $value) {
                    $productIdsArray[] = explode('#', $value)[0];
                }
                $productIds = implode(", ", $productIdsArray);

                $sql = "SELECT * FROM product WHERE prd_id IN($productIds)";
                $row = mysqli_fetch_array(mysqli_query($conn, $sql));
                // var_dump($row);
                foreach ($row as $key => $value) {
                    var_dump($row);
                }

                $totalCost = 0;
                ?> -->
        <li class="list-group-item">
            <a href="index.php?page_layout=invoice-detail&invoice_id=<?= $invoice['invoice_id'] ?>">
                <button class="btn btn-primary">
                    Xem chi tiết đơn hàng: <?= $invoice['invoice_id'] ?>
                </button>
            </a>

            <!-- <button class="btn btn-info">
                Tổng số lượng món hàng: <?= $invoice['createdAt'] ?>
            </button> -->


            <button class="btn btn-info">
                Thời gian tạo: <?= $invoice['createdAt'] ?>
            </button>

            <?php if ($invoice['status'] == 0) : ?>
                <form method="post" style="display: inline;">
                    <input type="hidden" value="<?= $invoice['0'] ?>" name="invoice_id_delete" />
                    <button class="btn btn-danger" type="submit" name="delete_invoice">
                        Hủy đơn hàng
                    </button>
                </form>
            <?php elseif ($invoice['status'] == 2) : ?>
                <button type="button" class="btn btn-warning">
                    đơn hàng đã bị hủy
                </button>
            <?php else : ?>
                <button type="button" class="btn btn-info">
                    Đơn hàng đã được thanh toán
                </button>
            <?php endif; ?>

        </li>
    <?php endwhile; ?>
</ul>