<div id="slide" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ul class="carousel-indicators">
    <?php
    $num_slide = 5;
    for($i =0;$i<$num_slide;$i++ ){
    ?>
    <li data-target="#slide" data-slide-to="<?= $i?>" class="<?php if($i==0) { echo 'active';}?>"></li>
    <?php
    }
    ?>
    </ul>

    <!-- The slideshow -->
    <div class="carousel-inner">
    <?php

    $sql = "SELECT * FROM ads WHERE ads_type = 0 ORDER BY ads_id DESC LIMIT $num_slide";
    $query = mysqli_query($conn,$sql);
    $i = 1;
    // while($row=mysqli_fetch_array($query)){
    // ?>
    <!-- <div class="carousel-item <?php  if($i == 1){ $i=2; echo 'active';} ?>"> -->
        <!-- <img style="height: 310px;" src="admin/img/ads/<?= $row['ads_image'] ?>" alt="Vietpro Academy"> -->
    <!-- </div> -->
    <!-- <?php  ?> -->
    </div>

    <!-- Left and right controls -->
    <a class="carousel-control-prev" href="#slide" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#slide" data-slide="next">
    <span class="carousel-control-next-icon"></span>
    </a>

</div>