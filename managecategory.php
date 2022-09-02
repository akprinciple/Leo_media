<?php 
		include 'inc/session.php';
		$msg = "";
		 if (isset($_GET['trash'])) {
		 	$trash = (int)$_GET['trash'];
		 	$sel = "UPDATE category SET status = 1 WHERE id = '{$trash}'";
		 	$select = mysqli_query($connect, $sel);
		 	if ($select) {
		 		$msg = "<div class='alert alert-success font-weight-bold text-center'>Category Moved to Bin</div>";
		 	}
		 }
		  if (isset($_GET['rev'])) {
		 	$rev = (int)$_GET['rev'];
		 	$sel = "UPDATE category SET status = 0 WHERE id = '{$rev}'";
		 	$select = mysqli_query($connect, $sel);
		 	if ($select) {
		 		$msg = "<div class='font-weight-bold text-center'>Category Restored Successfully</div>";
		 	}
		 }
		
		 if (isset($_GET['del'])) {
		 	$del = (int)$_GET['del'];
		 	$sel = "DELETE FROM category WHERE id = '{$del}'";
		 	$select = mysqli_query($connect, $sel);
		 	if ($select) {
		 		$msg = "<div class='font-weight-bold text-center'>Category Deleted forever</div>";
		 	}
		 }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Leoportal | Category</title>
	<?php include 'inc/link.php'; ?>
</head>
<body>


<!--------------------------------------- Header  ---------------------------------->
<!--------------------------------------- Body  ---------------------------------->

<div class="card-body p-0">
	<div class="row mx-0">
		<?php include 'inc/admin_sidebar.php'; ?>

		<h4 class="border-bottom p-2 font-weight-bold text-dark">Manage category</h4>
		<div class="p-3">

			<?php echo $msg; ?>
		<div class="p-3 rounded mt-4">
							
<div class=" p-3">
	
<ul class="nav nav-pills mb-3 bg-leo">
  <li class="nav-item w-50 text-center">
    <a class="nav-link active p-1 text-light" data-toggle="pill" href="#home">Active Categories</a>
  </li>
  <li class="nav-item w-50	text-center text-light">
    <a class="nav-link p-1" data-toggle="pill" href="#menu1">Categories' Bin</a>
  </li>
  
</ul>
<div class="tab-content">
  <div class="tab-pane container active m-0 p-0" id="home">
  	
     <h3>Active Categories</h3>
    <table class="col-md-12 table-striped table table-bordered text-center">
		<thead class="bg-leo text-light">
			<tr>
			<th>S/N</th>
			<th>Category</th>
			<th>Description</th>
			<th>Date</th>
			<th>Actions</th>
			</tr>
	</thead>
	<tbody>
	<?php 
		$number = 1;
		$sql = "SELECT * FROM category WHERE status = 0 ORDER BY category ASC";
		$query = mysqli_query($connect, $sql);
		while ($row = mysqli_fetch_array($query)) {
		$category = $row['category'];
		$description = $row['description'];
		$date = $row['date'];
		$id = $row['id'];
		?>
		<tr>
			<td><?php echo $number++; ?></td>
			<td><?php echo $category; ?></td>
			<td><?php echo $description; ?></td>
			<td><?php echo $date; ?></td>
			<td>
				<a class="fas fa-trash-alt" title="Recycle Bin" onclick="location.href='managecategory.php?trash=<?php echo $id ?>'" href="javascript:void(0)"></a>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>
  </div>
  <div class="tab-pane m-0 p-0 container fade" id="menu1">
    <h4 class="">Category Bin</h4>
	<table class="col-md-12 table-striped table table-bordered text-center">
		<thead class="bg-leo text-light">
			<tr>
				<th>S/N</th>
				<th>Category</th>
				<th>Description</th>
				<th>Date</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			$number = 1;
			$sql = "SELECT * FROM category WHERE status = 1";
			$query = mysqli_query($connect, $sql);
			while ($row = mysqli_fetch_array($query)) {
			$category = $row['category'];
			$description = $row['description'];
			$date = $row['date'];
			$id = $row['id'];
		?>
		<tr>
			<td><?php echo $number++; ?></td>
			<td><?php echo $category; ?></td>
			<td><?php echo $description; ?></td>
			<td><?php echo $date; ?></td>
			<td>
				<a class="fas fa-caret-left text-primary" title="Restore Category"onclick="location.href='managecategory.php?rev=<?php echo $id ?>'" href="javascript:void(0)"></a>
				<a class="fas fa-trash-alt text-danger" title="Delete Forever"onclick="location.href='managecategory.php?del=<?php echo $id ?>'" href="javascript:void(0)"></a>
			</td>
		</tr>
		<?php } ?>
		</tbody>
	</table>	
  </div>
  
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</body>
</html>
<?php include 'inc/footlink.php'; ?>