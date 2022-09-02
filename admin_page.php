<?php 

include 'inc/session.php';
ob_start();
$msg = "";
if (isset($_POST['submit'])) {
	
$file = $_FILES['file']['name'];
$tmp = $_FILES['file']['tmp_name'];
$type = pathinfo("upload/$file", PATHINFO_EXTENSION);



if ($type != "PNG" && $type != "jpg" && $type != "JPG" && $type != "png") {
$msg = "<div class='text-danger p-1 font-weight-bold mb-1 text-center'>File type must be jpg or png</div>";
				 	
}
elseif ($_FILES["file"]["size"] > 500000) {
$msg = "<div class='text-danger font-weight-bold rounded mb-3 text-center'>File size is larger than 500kb</div>";
}

else{
$sql = "UPDATE profile SET text = '{$file}' WHERE id = 1";
$query = mysqli_query($connect, $sql);
move_uploaded_file($tmp, "images/$file");

if ($query) {
			
$msg = "<div class='text-success font-weight-bold rounded mb-2 text-center'>Upload Successful </div>";
// header('location: index.php');
                        
}
else{
$msg = "<div class='alert-primary p-2 font-weight-bold rounded mb-3 text-center'>Error</div>";
}
}

}
// include 'inc/config.php';
?>

<!DOCTYPE html>
<html>
<head>
<title><?php 
		$link = mysqli_query($connect, "SELECT * FROM links WHERE id = 7");
		$links = mysqli_fetch_array($link);
		echo $links['link'];
	 ?>	 | Admin Dashboard</title>
<?php include 'inc/link.php'; ?>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<script type="text/javascript" src="bootstrap/js/jquery.min.js"></script>
	<script type="text/javascript" src="bootstrap/js/popper.min.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/chart.min.js"></script>
</head>
<body>
<div class="card">
<!--------------------------------------- Header  ---------------------------------->


<!--------------------------------------- Body  ---------------------------------->

<div class="card-body pl-3 pt-0 m-0">
<div class="row">
<?php include 'inc/admin_sidebar.php'; ?>

<div class="p-3">
<h5 class="mt-5 font-weight-bold">DASHBOARD</h5>

<div class="row">
<!------------------------ Number of Posts -------------------------->
<a href="newpost.php" class="col-md-3 mb-3 text-dark">

<div class=" rounded border ">
<span class="fas p-3 bg-leo text-light fa-book fa-2x"></span>
<span class="font-weight-bold text-center">

<?php 
	$sql = "SELECT * FROM post";
	$query = mysqli_query($connect, $sql);
	$count = mysqli_num_rows($query);
	echo $count;
 ?>
 <span class="font-weight-bold">Posts</span>
</span>
</div>
</a>
<!---------------------- Number of Categories ------------------>


<a href="category.php" class="col-md-3 text-dark mb-3">
<div class=" rounded border">
<span class="fas p-3 bg-leo text-light fa-check fa-2x"></span>
<span class="font-weight-bold">

<?php 
	$sql = "SELECT * FROM category";
	$query = mysqli_query($connect, $sql);
	$count = mysqli_num_rows($query);
	echo $count;
 ?>
 <span class="font-weight-bold">Categories</span>
</span>
</div>
</a>


<!---------------------- Number of Unapproved Posts ------------------>

<a href="newpost.php" class="col-md-3 text-dark mb-3">
<div class="  border ">
<span class="fas p-3 bg-leo fa-times fa-2x text-light"></span>
<span class="font-weight-bold">

<?php 
	$sql = "SELECT * FROM post WHERE status = 0";
	$query = mysqli_query($connect, $sql);
	$count = mysqli_num_rows($query);
	echo $count;
 ?>
 <span class="font-weight-bold">Unapproved Posts</span>
</span>
</div>

</a>

<!---------------------- Number of Registered Users ------------------>


<a href="members.php" class="col-md-3 text-dark trans rounded mb-3">
<div class=" rounded border ">
<span class="fas p-3 bg-leo text-light fa-users fa-2x"></span>
<span class="font-weight-bold">

	<?php 
	$sql = "SELECT * FROM users";
	$query = mysqli_query($connect, $sql);
	$count = mysqli_num_rows($query);
	echo $count;
 ?>
 <span class="font-weight-bold">Registered Users</span>
</span>
</div>

</a>

</div>
<div class="row mx-0 mt-2">
<div class="col-md-3">
	<h4 class="">Website Logo</h4>
	<hr>
	<?php echo $msg; ?>
	<?php  
	$sql = "SELECT * FROM profile WHERE id = 1";
	$query = mysqli_query($connect, $sql);
	while ($row = mysqli_fetch_array($query)) {
	
	
	?>	
	<img src="images/<?php echo $row['text']; ?>" class="w-100" style="height: 200px;">
<?php } ?>
	<form method="post" enctype="multipart/form-data">
		<div class="form-group">
			<input type="file" name="file" accept=".jpg, .png, .gif" class="form-control" required="required">
	<button type="submit" name="submit" class="col-md-6 float-right bg-leo p-2 border-0 mb-3 outline text-light btn mt-1">Change</button>
	<div class="clearfix"></div>
		</div>
	</form>
</div>
<div class="col-md-9">
	<h4>Links</h4>
	<hr>
<table class="table table-striped table-responsive-xl table-bordered text-center bg">
	<thead class="bg-danger text-light">
	<tr>
		<th>S/N</th>
		<th>Media</th>
		<th>Link</th>
		<th>Edit</th>
	</tr>
	</thead>
	<tbody>
	<?php  
	$l_sql = "SELECT * FROM links ORDER BY id DESC";
	$l_query = mysqli_query($connect, $l_sql);
	$n = 1;
	while ($link = mysqli_fetch_array($l_query)) {
		
	
	?>
	<tr>
	<td><?php echo $n++; ?></td>
	<td><?php echo $link['media']; ?></td>
	<td><?php echo $link['link']; ?></td>
	<td>
	<span class="dropdown">

	<span class="dropdown-toggle w-100" data-toggle="dropdown"></span>
		<div class="dropdown-menu p-2">
			<form method="post" enctype="multipart/form-data">
			<b>Edit</b>
			<div class="form-group">
			<input type="text
			" name="link" class="form-control" value="<?php echo $link['link']; ?>">
			</div>
			<button type="submit" name="submit<?php echo $link['id']; ?>" class="w-100 btn-danger text-light btn">Update</button>
	<div class="clearfix"></div>
			</form>
		</div>
	</span>
	</td>
	</tr>
	<?php  
	if (isset($_POST['submit'.$link['id']])) {
		$id = $link['id'];
		
		$linker = $_POST['link'];

		$u_sql = "UPDATE links SET link = '{$linker}' WHERE id = '{$id}'";
		$u_query = mysqli_query($connect, $u_sql);
		if ($u_query) {
			header('location: admin_page.php');
// echo "<script>alert('Success')</script>"."<script type='text/javascript'>
// 	setTimeout(function() {
// 		window.location.href = 'members.php'}, 3000);
// </script>";


	
	}
	}
	?>
	<?php } ?>	
	</tbody>
	</table>

</div>
</div>
<?php
	include 'inc/graph.php';
?>
</div>
</div>
</div>
</div>
</div>
</div>

</body>
</html>
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script type="text/javascript" src="bootstrap-4.6/js/jquery.min.js"></script>
<script type="text/javascript" src="bootstrap-4.6/js/popper.min.js"></script>
<!-- <script type="text/javascript" src="bootstrap-4.6/js/bootstrap.min.js"></script> -->
<script type="text/javascript" src="js/java.js"></script>
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<?php #include 'inc/footlink.php'; ?>
<!-- <script type="text/javascript" src="js/chart.min.js"></script> -->

