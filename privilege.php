<?php  

include 'inc/session.php';
$msg = "";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Privileges</title>
<?php include 'inc/link.php'; ?>
</head>
	<script type="text/javascript">
     function find(val) {
    $.ajax({
    type: "GET",
    url: "search.php",
    data: 'see='+val,
    success: function (data) {
    $('#search').html(data);
    }
    })
    }
</script>
<!-- <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script> -->
<?php include 'search.php'; ?>

<body>
	<div class="card-body pl-3 pt-0 m-0">
<div class="row">
<?php include 'inc/admin_sidebar.php'; ?>

<div class="">
	<form method="post" enctype="multipart/form-data">
	<div class="col-md-6 form-group mt-3 mx-auto">
		<h5>Add/Edit Privileges</h5>
		<select class="form-control" name="search" onchange="find(this.value);">
			<option>--Select User--</option>
			<?php 
			$sql = mysqli_query($connect, "SELECT * FROM users"); 
			while ($row = mysqli_fetch_array($sql)) {
			
			
			?>
		<option value="<?php echo $row['id']; ?>"><?php echo $row['username']; ?></option>
			<?php } ?>
		</select>
	</div>
	<div id="search" class="p-3"></div>
	<?php 
		if (!empty($_POST['admin'])) {
		$admin = mysqli_real_escape_string($connect, $_POST['admin']);
			
		}
		else{
			$admin = 0;
		}
		if (!empty($_POST['post'])) {
		$post = mysqli_real_escape_string($connect, $_POST['post']);
		}
		else{
			$post = 0;
		}
		if (!empty($_POST['edit'])) {
		$edit = mysqli_real_escape_string($connect, $_POST['edit']);
		}else{
			$edit = 0;
		}
		if (!empty($_POST['delet'])) {
		$delet = mysqli_real_escape_string($connect, $_POST['delet']);
	}
	else{
		$delet = 0;
	}
	if (!empty($_POST['approve'])) {
		$approve = mysqli_real_escape_string($connect, $_POST['approve']);
	}else{
		$approve = 0;
	} 
		if (isset($_POST['submit'])) {
	$user_id = mysqli_real_escape_string($connect, $_POST['search']);
		
		$check = mysqli_query($connect, "SELECT * FROM privileges WHERE user_id = '{$user_id}'");
		$count = mysqli_num_rows($check);
		if ($count > 0) {
			$msg = "Added Already";
		}else{
		$sert = "INSERT INTO privileges (user_id, edit, post, remove, admin, approve) VALUES('$user_id', '$edit', '$post', '$delet', '$admin', '$approve')";
		$insert = mysqli_query($connect, $sert);
		if ($insert) {
			
		$msg = "Successfully Added";
		}}
}
else{
	if (isset($_POST['update'])) {
	$user_id = mysqli_real_escape_string($connect, $_POST['search']);

		$up = mysqli_query($connect, "UPDATE privileges SET edit = '$edit', post = '$post', remove = '$delet', admin = '$admin', approve = '$approve' WHERE user_id = '{$user_id}'");
		if ($up) {
			$msg = "Updated Successfully";
		}else{
			$msg = "Try Again";
		}
	}
}
		echo "<div class='text-center'>$msg</div>";
	?>
	</form>
	
</div>
</div>
</div>

</body>
</html>
<!-- <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script> -->
<script type="text/javascript" src="bootstrap-4.6/js/jquery.min.js"></script>
<script type="text/javascript" src="bootstrap-4.6/js/popper.min.js"></script>
<script type="text/javascript" src="bootstrap-4.6/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/java.js"></script>
<?php  
	// if (isset($_POST['submit'])) {
	// 	echo $see;
	// }
?>
