<?php  
include 'inc/session.php';
if ($r['roles'] != 1) {
		header('location: admin_page.php');
		}
$msg = "";
if (isset($_POST['submit'])) {
    $roles = mysqli_real_escape_string($connect, $_POST['roles']);
    $select = mysqli_query($connect, "SELECT * FROM roles WHERE roles = '{$roles}'");
    $count = mysqli_num_rows($select);
    if ($count > 0) {
    	$msg = "Role already added";
    }else{
    $sql = mysqli_query($connect, "INSERT INTO roles (roles) VALUES ('$roles')");

    if ($sql) {
    	$msg = "Role Successfully Added";
    }else{
    	$msg = "Try again";
    }
  }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Roles | </title>
	<?php include 'inc/link.php'; ?>
</head>
<body>
<div class="card-body pl-3 pt-0 m-0">
<div class="row">
<?php include 'inc/admin_sidebar.php'; ?>
<h3 class="pl-4 pt-2">Manage Categories</h3>
<hr>
<div class="row mx-3">
<div class="col-md-6 p-4 bg-white">
	<h4 class="text-center mb-3">Add Roles</h4>
	<div class="text-center"><?php echo $msg; ?></div>
	<form method="post" enctype="multipart/form-data">
		<div class="form-group">
			<input type="text" name="roles" class="form-control text-center" placeholder="Add Role" required="required">
			<button class="btn btn-primary d-block mx-auto mt-3 w-100 " type="submit" name="submit">Add</button>
		</div>
	</form>
</div>
<div class="col-md-6 p-4  bg-white">
	<h4 class="text-center ">Available Roles</h4>
	<table class="table table-striped text-center">
		<thead>
			<tr>
				<th>S/N</th>
				<th>Roles</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$query = mysqli_query($connect, "SELECT * FROM roles");
			$n = 1;
			while ($row = mysqli_fetch_array($query)) {
				
			
			?>
			<tr>
				<td><?php echo $n++; ?></td>
				<td><?php echo $row['roles']; ?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
</div>
</div>
</div>
</body>
</html>

<script type="text/javascript" src="bootstrap-4.6/js/jquery.min.js"></script>
<script type="text/javascript" src="bootstrap-4.6/js/popper.min.js"></script>
<script type="text/javascript" src="bootstrap-4.6/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/java.js"></script>