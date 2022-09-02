<?php
include 'inc/session.php';

 $msg ="";
if (isset($_GET['user']) && isset($_GET['name'])) {
$user = (int)$_GET['user'];
$username = $_GET['name'];

$sql = "SELECT * FROM users WHERE id = '{$user}' && username = '{$username}'";
$query = mysqli_query($connect, $sql);
while ($row = mysqli_fetch_array($query)) {
	$firstname = $row['name'];
	$username = $row['username'];
	$email = $row['email'];
	$date = $row['date'];
	$password = $row['password'];
	$id = $row['id'];
	$role = $row['roles'];
	$gender = $row['gender'];

 
if (isset($_POST['submit']) && $r['roles'] == 1 || isset($_POST['submit']) && $r['id'] == $id){ 
 $username = mysqli_real_escape_string($connect, $_POST['username']);
 $firstname = mysqli_real_escape_string($connect, $_POST['firstname']);
 $password = mysqli_real_escape_string($connect, $_POST['password']);
 // $email = mysqli_real_escape_string($connect, $_POST['email']);
 $roles = mysqli_real_escape_string($connect, $_POST['roles']);
 if ($r['roles'] == 1) {
 	$msg = "<b class='text-danger'>You cannot Edit a Super Administrator</b>";
 }else{
 $update = mysqli_query($connect, "UPDATE users SET username = '{$username}', name = '{$firstname}', password = '{$password}', roles = '{$roles}' WHERE id = '{$id}'");
 if ($update) {
 		$msg = "Profile successfully Updated. You will be redirected in 3s <script type='text/javascript'>
	setTimeout(function() {
		window.location.href = 'members.php'}, 3000);
</script>";
 	}
 	else{
 		$msg = "Try Again Please!";
 	}	
}

}
?>

<!DOCTYPE html>
<html>
<head>
<title><?php 
		$link = mysqli_query($connect, "SELECT * FROM links WHERE id = 7");
		$links = mysqli_fetch_array($link);
		echo $links['link'];
	 ?>	 | Profile page</title>
<?php include 'inc/link.php'; ?>
</head>
<body>

<div class="card">
<!--------------------------------------- Header  ---------------------------------->

<!--------------------------------------- Body  ---------------------------------->

<div class="card-body pl-3 pt-0 m-0">
<div class="row">
<?php include 'inc/admin_sidebar.php'; ?>


<div class="">
<!-- <h2 class="text-center font-weight-bold mt-5 mb-3">User's profile</h2> -->
<div class=" p-3 rounded  font-weight-bold text-center text-capitalize">

<?php if ($gender == "Male") {
	echo "<img src='images/avatar5.png' class='text-center mt-3 w-25' style='border-radius: 50%;'>";
}
else{
	echo "<img src='images/avatar2.png' class='text-center mt-3 w-25' style='border-radius: 50%;'>";
}
?>
</div>

<h3 class="text-center"><?php echo $username; ?>'s Profile</h3>
<p class="text-center"><?php echo $msg;; ?></p>
<form method="post" enctype="multipart/form-data">
<div class="row mt-3 form-group border p-3 mx-0">
	<div class="col-md-12">
	<div class="font-weight-bold text-center">Profile Code : Leo00<?php echo $id; ?></div>
	
</div>

<div class="col-md-6 mb-3">
	<div class="font-weight-bold">Username</div>
	<input type="text" name="username" class="form-control text-center" value="<?php echo $username; ?>">
</div>
<div class="col-md-6">
	<div class="font-weight-bold">Name </div>
	<input type="text" name="firstname" class="form-control text-center" value="<?php echo $firstname; ?>">
</div>
	
<div class="col-md-6 mb-3">
	<div class="font-weight-bold">Gender </div>
	<input type="text" name="" class="form-control text-center" value="<?php echo $gender; ?>">
</div>
<div class="col-md-6">
	<div class="font-weight-bold">Password </div>
	<input type="text" name="password" class="form-control text-center" value="<?php if($r['roles'] == 1 || $r['id'] == $id){ echo $password;} else{ echo "*******";} ?>">
</div>


<div class="col-md-6 mb-3">
	<div class="font-weight-bold">Email </div>
	<input type="text" name="email" class="form-control text-center" value="<?php echo $email; ?>">

	
</div>
	
<div class="col-md-6 mb-3">
	<div class="font-weight-bold">Role </div>
	<select class="form-control text-center" name="roles">
		<option value="<?php echo $role; ?>">
				<?php 
			$selt = mysqli_query($connect, "SELECT * FROM roles WHERE id = '$role'");
			while ($rol = mysqli_fetch_array($selt)) {
				# code...
			echo $rol['roles'] ;
			}
				 ?>
			</option>

	 <?php if ($r['roles'] == 1) {
			$selt = mysqli_query($connect, "SELECT * FROM roles WHERE id != '$role'");
			while ($rol = mysqli_fetch_array($selt)) {
				# code...
			
			
		 ?>
<option value="<?php echo $rol['id']; ?>"><?php echo $rol['roles'] ; ?></option>
<?php }} ?>
	</select>
	<!-- <input type="text" name="role" "> -->
	
</div>
<div class="col-md-6">
	<div class="font-weight-bold">Registration Date </div>
	<div class=" mb-3 border text-center p-2 bg-white rounded"><?php echo $date; ?></div>
</div>

<div class="col-md-6 <?php if($r['roles'] != 1 && $r['id'] !== $id){ echo "d-none";} ?>">
	<b>Click to Update</b>
	<button type="<?php if($r['roles'] == 1 || $r['id'] == $id){ echo "submit";} else{ echo "button";} ?>" name="<?php if($r['roles'] == 1 || $r['id'] == $id){ echo "submit";} ?>" class="btn btn-success w-100">Submit</button>
</div>
</div>
</form>
<?php }} ?>
</div>

</div>
</div>
</div>

</body>
</html>
<?php include 'inc/footlink.php'; ?>