<?php  
include 'inc/session.php';
$msg = $subcategory = "";
if (isset($_POST['submit'])) {
	$category = mysqli_real_escape_string($connect, $_POST['category']);
	$subcategory = mysqli_real_escape_string($connect, $_POST['subcategory']);
	$date = date('d M Y @ h:m:s');


	$sql = "SELECT * FROM subcategory WHERE subcategory = '$subcategory' && category = $category";
	$query = mysqli_query($connect, $sql);
	$count = mysqli_num_rows($query);
	if ($count > 0) {
	$category = mysqli_real_escape_string($connect, $_POST['category']);
		$msg = "<div id='msg' class='text-center font-weight-bold mb-2'>SubCategory already exists in the category</div>";
	}else{
		$sel = "INSERT INTO subcategory (subcategory, category, date) VALUES('$subcategory', '$category', '$date')";
		$ins = mysqli_query($connect, $sel);
		if ($ins) {
			$msg = "<div id='msg' class='text-center font-weight-bold mb-2'>SubCategory added successfully</div>";
		}
	}
}

if (isset($_GET['trash'])) {
	$trash = (int)$_GET['trash'];
 	$selt = "UPDATE subcategory SET status = 1 WHERE id = '{$trash}'";
 	$select = mysqli_query($connect, $selt);
 	if ($select) {
 		$msg = "<div class=' font-weight-bold text-center'>Category Moved to Bin</div>";
 	}
}

 if (isset($_GET['rev'])) {
		 	$rev = (int)$_GET['rev'];
		 	$sel = "UPDATE subcategory SET status = 0 WHERE id = '{$rev}'";
		 	$select = mysqli_query($connect, $sel);
		 	if ($select) {
		 		$msg = "<div class=' font-weight-bold text-center'>Category Restored Successfully</div>";
		 	}
		 }
		
		 if (isset($_GET['del'])) {
		 	$del = (int)$_GET['del'];
		 	$sel = "DELETE FROM subcategory WHERE id = '{$del}'";
		 	$select = mysqli_query($connect, $sel);
		 	if ($select) {
		 		$msg = "<div class='font-weight-bold text-center'>Category Deleted forever</div>";
		 	}
		 }

?>
<!DOCTYPE html>
<html>
<head>
	<title>Manage Sub-Categories</title>
 	<?php include 'inc/link.php'; ?>
 	
<?php include 'sign_search.php'; ?>
</head>
<body>
<div class="card-body p-0">
	<div class="row mx-0">
		<?php include 'inc/admin_sidebar.php'; ?>

		<h4 class="border-bottom p-2 font-weight-bold text-dark">Manage Sub-categories</h4>
		<div class="p-3">
			
			
	<ul class="nav nav-pills bg-leo text-center rounded">
		<li class="nav-item col-md-4 p-0">
		<a class="nav-link active text-light" data-toggle="pill" href="#home">Active Categories</a>
		</li>
		<li class="nav-item col-md-4 p-0">
		<a class="nav-link text-light" data-toggle="pill" href="#menu1">Categories' Bin</a>
		</li>
		<li class="nav-item col-md-4 p-0">
		<a class="nav-link text-light" data-toggle="pill" href="#menu2">Add Subcategories</a>
		</li>
	</ul>
				<div class="p-2"><?php echo $msg; ?></div>
<div class="tab-content mt-3">
  <div class="tab-pane container active m-0 p-2 bg-white" id="home">
  	
	<h4>Active Subcategories</h4>
    <table class="col-md-12 table-striped table table-bordered text-center">
		<thead class="bg-leo text-light">
			<tr>
			<th>S/N</th>
			<th>SubCategory</th>
			<th>Category</th>
			<th>Date</th>
			<th>Actions</th>
			</tr>
	</thead>
	<tbody>
	<?php 
		$number = 1;
		$sql = "SELECT * FROM subcategory WHERE status = 0 ORDER BY category ASC";
		$query = mysqli_query($connect, $sql);
		while ($row = mysqli_fetch_array($query)) {
		$category = $row['category'];
		$subcategory = $row['subcategory'];
		$date = $row['date'];
		$id = $row['id'];
		?>
		<tr>
			<td><?php echo $number++; ?></td>
			<td><?php echo $subcategory; ?></td>
			<td>
				<?php
				$s_query = mysqli_query($connect, "SELECT * FROM category WHERE id = '{$category}'");
				while ($r = mysqli_fetch_array($s_query)) {
				 	echo $r['category'];
				 } 
				

				?>
					
				</td>
			<td><?php echo $date; ?></td>
			<td>
				<a class="fas fa-trash-alt " title="Recycle Bin" onclick="location.href='subcategory.php?trash=<?php echo $id; ?>&name=<?php echo $subcategory; ?>'" href="javascript:void(0)"></a>
			</td>
		</tr>
		<?php } ?>
	</tbody>
   </table>
</div>
  <div class="tab-pane m-0 p-2 container fade bg-white" id="menu1">



    <h4> Subcategories Bin</h4>
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
		$sql = "SELECT * FROM subcategory WHERE status = 1 ORDER BY category ASC";
		$query = mysqli_query($connect, $sql);
		while ($row = mysqli_fetch_array($query)) {
		$category = $row['category'];
		$subcategory = $row['subcategory'];
		$date = $row['date'];
		$id = $row['id'];
		?>
		<tr>
			<td><?php echo $number++; ?></td>
			<td><?php echo $subcategory; ?></td>
			<td>
				<?php
				$s_query = mysqli_query($connect, "SELECT * FROM category WHERE id = '{$category}'");
				while ($r = mysqli_fetch_array($s_query)) {
				 	echo $r['category'];
				 } 
				

				?>
			</td>
			<td><?php echo $date; ?></td>
			<td>
				<a class="fas fa-caret-left text-primary" title="Restore Category"onclick="location.href='subcategory.php?rev=<?php echo $id ?>'" href="javascript:void(0)"></a>
				<a class="fas fa-trash-alt text-danger <?php if ($p['remove'] != 1) {
			echo "d-none"; } ?>" title="Delete Forever"onclick="location.href='subcategory.php?del=<?php echo $id ?>'" href="javascript:void(0)"></a>
			</td>
		</tr>
		<?php } ?>
	</tbody>
   </table>
</div>
<div class="tab-pane m-0 p-2 container fade bg-white" id="menu2">
	<h4 class="mb-0 font-weight-bold">Add Subcategory</h4>
	<hr class="bg-leo">
<div class="col-md-9 rounded m-auto  p-3"  ">

				<form method="post" enctype="multipart/form-data">
<!---------------- Category  --------------------->
				<div class="form-group">
					<label for="subcategory" class="font-weight-bold">Sub Category</label>
												
					<input type="text" id="subcategory" placeholder="input Sub-Category" required="required" name="subcategory" class="form-control">
				</div>

				<!---------------- Category --------------------->
				<div class="form-group">
                    <div class="font-weight-bold">Category</div>
                      <div class="">
                      <select name="category" class="form-control">
                        <option selected="selected">-Select one-
                          <?php 
                              $sel = "SELECT * FROM category WHERE status = 0";
                              $ins = mysqli_query($connect, $sel);
                              while ($rw = mysqli_fetch_array($ins)) {
                                
                              
                           ?>
                            <option value="<?php echo $rw['id']; ?>"><?php echo $rw['category']; ?></option>
                            <?php } ?>
                        </option>
                      </select>
                    </div>
                   </div>
				<button type="submit" name="submit" class="btn btn-primary col-md-6 btn-lg float-right">Submit</button>
				<div class="clearfix"></div>
				</form>
			</div>
  </div>

</div>
  
	</div>
 </div>
</div>
</body>
</html>
 	<?php include 'inc/footlink.php'; ?>
