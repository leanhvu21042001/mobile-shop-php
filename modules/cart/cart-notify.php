<div id="cart" class="col-lg-4 col-md-4 col-sm-12">

    <?php

    if (isset($_POST['logout'])) {
        $_SESSION['client_logged_in'] = '';
        header("location: index.php");
    }

    if (isset($_SESSION['client_logged_in']) and !empty($_SESSION['client_logged_in'])) {
        echo '<a class="mt-4 mr-2" href="index.php?page_layout=invoice">Hóa đơn</a>';
        echo '<form style="display: inline;" role="form" method="post">
            <button name="logout" type="submit" class="btn" style="display: inline;">Đăng xuất</button>
        </form>';
        echo '<a class="mt-4 mr-2" style="font-weight: bold" href="#">' . $_SESSION['client_logged_in']['1'] . '</a>';
    } else {
        echo '<a class="mt-4 mr-2" href="index.php?page_layout=register">Đăng ký</a>';
        echo '<a class="mt-4 mr-2" href="index.php?page_layout=login">Đăng nhập</a>';
    }
    ?>

    <a class="mt-4 mr-2" href="index.php?page_layout=cart">giỏ hàng</a>
    <span class="mt-3">
        <?php


        if (isset($_SESSION['cart'])) {
            if (isset($_POST['qtt'])) {
                $cart = $_POST['qtt'];
            } else {
                $cart = $_SESSION['cart'];
            }
            $total = 0;
            foreach ($cart as $prd_id => $qtt) {
                $total += $qtt;
            }
            echo $total;
        } else {
            echo 0;
        }
        ?>
    </span>


</div>