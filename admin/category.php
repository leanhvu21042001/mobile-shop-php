<?php
//  Kiểm tra vị trí trang 
if(isset($_GET['page'])){
	$page = $_GET['page'];
}else{
	$page =1;
}


$row_per_page = 3;  //Mỗi trang có 3 dòng
$per_row = $page*$row_per_page - $row_per_page;  // Ví trí bắt đầu của cat_id trong trang

$total_row = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM category")); // Tổng số dòng
$total_page = ceil($total_row/$row_per_page);	// Tính tổng số trang hiển thị

$list_page = ''; //Khởi tạo thanh phân trang

$page_prev = $page -1; // Đặt giá trị cho page_prev
if($page_prev <= 0){
	$page_prev = 1;
}
// Nối nút Page_prev vào =$list_page
$list_page.='<li class="page-item"><a class="page-link" href="index.php?page_layout=category&page='.$page_prev.'">&laquo;</a></li>'; 
// Tính số trang 
for($i=1;$i<=$total_page; $i++){
	if($i == $page){
		$active = 'active';
	}else{
		$active = '';
	}
	$list_page.=' <li class="page-item '.$active.'"><a class="page-link '.$active.'" href="index.php?page_layout=category&page='.$i.'">'.$i.'</a></li>';
}
// Nút next page
$page_next = $page +1;
if($page_next > $total_page){
	$page_next = $total_page;
}
$list_page.='<li class="page-item"><a class="page-link" href="index.php?page_layout=category&page='.$page_next.'">&raquo;</a></li>';

$sql = "SELECT * FROM category ORDER BY cat_id DESC LIMIT $per_row,$row_per_page"; // truy vấn CSDL
$query=mysqli_query($conn,$sql);	// Kết nối với CSDL
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#"><svg class="glyph stroked home">
						<use xlink:href="#stroked-home"></use>
					</svg></a></li>
			<li class="active">Quản lý danh mục</li>
		</ol>
	</div>
	<!--/.row-->

	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Quản lý danh mục</h1>
		</div>
	</div>
	<!--/.row-->
	<div id="toolbar" class="btn-group">
		<a href="index.php?page_layout=add_category" class="btn btn-success">
			<i class="glyphicon glyphicon-plus"></i> Thêm danh mục
		</a>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<table data-toolbar="#toolbar" data-toggle="table">

						<thead>
							<tr>
								<th data-field="id" data-sortable="true">ID</th>
								<th>Tên danh mục</th>
								<th>Hành động</th>
							</tr>
						</thead>
						<tbody>
						<?php
						while($row=mysqli_fetch_array($query)){ //vòng lặp 
						?>
							<tr>
								<td style=""><?= $row['cat_id'] ?></td>
								<td style=""><?= $row['cat_name']?></td>
								<td class="form-group">
									<a href="index.php?page_layout=edit_category&cat_id=<?=$row['cat_id'] ?>" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>
									<a href="del_category.php?cat_id=<?= $row['cat_id'] ?>" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
								</td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
				<div class="panel-footer">
					<nav aria-label="Page navigation example">
						<ul class="pagination">
						<?= $list_page; ?>
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