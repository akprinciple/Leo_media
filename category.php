<?php 
include 'inc/session.php';
$msg = $category = "";
if (isset($_POST['submit'])) {
	$category = mysqli_real_escape_string($connect, $_POST['category']);
	$description = mysqli_real_escape_string($connect, $_POST['description']);
	$date = date('d M Y @ h:m:s');


	$sql = "SELECT * FROM category WHERE category = '$category'";
	$query = mysqli_query($connect, $sql);
	$count = mysqli_num_rows($query);
	if ($count > 0) {
	$category = mysqli_real_escape_string($connect, $_POST['category']);
		$msg = "<div id='msg' class='table-head p-2 rounded text-center text-danger border border-danger font-weight-bold mb-2'>Category already exists</div>";
	}else{
		$sel = "INSERT INTO category (category, description, date) VALUES('$category', '$description', '$date')";
		$ins = mysqli_query($connect, $sel);
		if ($ins) {
			$msg = "<div id='msg' class='table-head p-2  rounded text-center text-success border border-success font-weight-bold mb-2'>Category added successfully</div>";
		}
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

	<div class="card">
<!--------------------------------------- Header  ---------------------------------->

<!--------------------------------------- Body  ---------------------------------->

<div class="card-body pl-3 pt-0 m-0">
<div class="row">
<?php include 'inc/admin_sidebar.php'; ?>

<h4 class="border-bottom p-2 font-weight-bold text-dark">Add category</h4>
<div class="p-3">
	<a href="managecategory.php" class="float-right p-2 text-light text-decoration-none  rounded bg-success">View Categories</a>
	<div class="clearfix"></div>
<div class="p-3 border rounded mt-2">
<h5 class="border-bottom font-weight-bold">Add category</h5>

<div class="mt-4 p-3">
	<?php echo $msg; ?>
<form method="post" enctype="multipart/form-data">

<!---------------- Category  --------------------->
<div class="form-group">
	<label for="category" class="font-weight-bold">Category</label>
								
	<input type="text" id="category" placeholder="input Category" required="required" name="category" class="form-control">
</div>

<!---------------- Category Description --------------------->
<div class="form-group">
	<label class="font-weight-bold">Category Description</label>
	<textarea name="description" rows="5" class="form-control col-md-6" id="area"></textarea>
</div>
<button type="submit" name="submit" class="btn btn-success">Submit</button>
</form>
</div>
</div>
</div>
</body>
</html>

        <?php include 'inc/footlink.php'; ?>
      