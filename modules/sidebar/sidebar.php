<div id="banner">
    <?php
    $num_banner = 6;
    $sql = "SELECT * FROM ads WHERE ads_type = 1 ORDER BY ads_id DESC LIMIT $num_banner";
    $query = mysqli_query($conn,$sql);

    if (!$query) { exit(); }

    while($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
    ?>
    <div class="banner-item">
        <a href="#"><img class="img-fluid" src="admin/img/ads/<?= $row['ads_image'] ?>"></a>
    </div>
    <?php
    }
    ?>
</div>