<?php 
include 'inc/session.php';
$msg = $pErr = $firstname = $lastname = $username = $password = $confirm_password = $email = $address = $nationality =$phone = $question = $answer = $gender= "";
if (isset($_POST['submit'])) {
				$firstname = mysqli_real_escape_string($connect, $_POST['firstname']);
				$username = mysqli_real_escape_string($connect, $_POST['username']);
				$password = mysqli_real_escape_string($connect, $_POST['password']);
				$confirm_password = mysqli_real_escape_string($connect, $_POST['confirm_password']);
				$email = mysqli_real_escape_string($connect, $_POST['email']);
				$gender = mysqli_real_escape_string($connect, $_POST['gender']);
				
				$role = mysqli_real_escape_string($connect, $_POST['role']);
				$date = date('Y-m-d h:ma');
				date_default_timezone_set("Africa/Lagos");
					// date_default_timezone_get();
					if (strlen($username) < 6) {
							$msg = "Username must contain atleast 6 characters";
					}
					else{
						if (strlen($password) < 6) {
							$msg = "Password must contain atleast 6 characters";
						}
						else{
				if ($password != $confirm_password) {
					$pErr = "Re-confirm your password";
				}
				else{
					$sel = "SELECT * FROM users WHERE username = '$username'";
					$res = mysqli_query($connect, $sel);
					$count = mysqli_num_rows($res);
					if ($count > 0) {
						$msg = "<b class='text-danger'>Username already exist</b>";
					}
					else{ 
						$sel = "SELECT * FROM users WHERE email = '$email'";
					$res = mysqli_query($connect, $sel);
					$count = mysqli_num_rows($res);
					if ($count > 0) {
						$msg = "<b class='text-danger'>Email already exist</b>";
						}
						else{
							if ($role == "--Select Role--") {
								$msg = "Select a Role";
							}
							else{
						$sql = "INSERT INTO users (name, username, gender, password, email, roles, date) VALUES ('$firstname', '$username', '$gender', '$password', '$email', '$role', '$date')";
						$query = mysqli_query($connect, $sql);
						if ($query) {
							// header('location:login.php');
							$msg = "Registration Successful";
						}
						else{
							$msg = "Try again";
						}
						}
						}
						}
				}
			}
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>Leoportal | Members</title>
<?php include 'inc/link.php'; ?>
</head>
<body>
<div class="card" id="card">
<!--------------------------------------- Header  ---------------------------------->

<!--------------------------------------- Body  ---------------------------------->

<div class="card-body pl-3 pt-0 m-0">
<div class="row">
<?php include 'inc/admin_sidebar.php'; ?>





<p class="text-center text-primary col-md-12"><?php echo $msg; ?></p>

<div class="p-3">
<h4  class="mt-5 font-weight-bold float-left">Members</h4>
<span class="fas fa-plus float-right mt-5 p-3 bg-success text-light mb-3" id="show" title="Add New User" style="display: <?php if ($r['roles'] !== "Super Admin") {
			echo "none"; } ?> "></span>
<table class="table-responsive-xl m-auto table-striped table text-center table-bordered font-weight-bold ">

<thead class="" style">
	<tr>
		<th class="">S/N</th>
		<th class="">Name</th>
		<th class="">Username</th>
		<th class="">Roles</th>
		

		<th class="">Actions</th>


	</tr>
</thead>
<tbody>
	<?php 
	if (isset($_GET['page_no']) && $_GET['page_no']!="") {
	$page_no = $_GET['page_no'];
	} else {
	$page_no = 1;
    }

	$total_records_per_page = 20;
			$offset = ($page_no-1) * $total_records_per_page;
	$previous_page = $page_no - 1;
	$next_page = $page_no + 1;
	$adjacents = "2"; 

	$result_count = mysqli_query($connect,"SELECT COUNT(*) As total_records FROM `users`");
	$total_records = mysqli_fetch_array($result_count);
	$total_records = $total_records['total_records'];
	$total_no_of_pages = ceil($total_records / $total_records_per_page);
	$second_last = $total_no_of_pages - 1; // total page minus 1

		 $result = mysqli_query($connect, "SELECT * FROM `users` ORDER BY id DESC LIMIT $offset, $total_records_per_page");
		 


	$n = 1;
	while ($rw = mysqli_fetch_array($result)) {
	 	$date = $rw['date'];
	 	$username = $rw['username'];
	 	$name = $rw['name'];
	 	$id = $rw['id']; 
	 ?>
	<tr>
		<td class=""><?php echo $n++; ?></td>
<!------------------------------- Username ----------------------------->
		<td class=""><a title="<?php echo $name; ?>" class="text-dark" href="profile.php?user=<?php echo $rw['id']; ?>&&name=<?php echo $rw['username']?>"><?php echo $name; ?></a></td>


			<!------------------------------- Date ----------------------------->

		<td><?php echo $username; ?></td>
		<td>
			<?php 
			$selt = mysqli_query($connect, "SELECT * FROM roles WHERE id = '{$rw['roles']}'");
			while ($rol = mysqli_fetch_array($selt)) {
				# code...
			echo $rol['roles'] ;
			}
				 ?>
			</td>

		<td class="">
<!------------------------------- View Button ----------------------------->

			<a class="fas fa-eye" title="View Button" href="profile.php?user=<?php echo $rw['id']; ?>&&name=<?php echo $rw['username']; ?>"></a>

<!------------------------------- Status Button  ----------------------------->
<?php $rowid = $rw['id']; ?>

<!------------------------------- Delete Button ----------------------------->
	<!-- $row['level'] -->
	
		<span style="display: <?php if ($r['roles'] != 1 || $p['remove'] != 1) {
			echo "none"; } ?>; "><a class="fas fa-times text-danger" title="Delete" href="deletemember.php?delete=<?php echo $rw['id']; ?>"></a></span>
		</td>


	</tr>
<?php } ?>
</tbody>
</table>


<ul class="pagination mt-3">
<?php // if($page_no > 1){ echo "<li><a href='?page_no=1'>First Page</a></li>"; } ?>

<li <?php if($page_no <= 1){ echo "class='disable'"; } ?>>
<a class="page-link" <?php if($page_no > 1){ echo "href='?page_no=$previous_page'"; } ?>>Previous</a>
</li>

<?php 
if ($total_no_of_pages <= 10){  	 
for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
if ($counter == $page_no) {
echo "<li class='active page-link bg-dark'><a>$counter</a></li>";	
}else{
echo "<li><a href='?page_no=$counter' class='page-link'>$counter</a></li>";
}
}
}
elseif($total_no_of_pages > 10){

if($page_no <= 4) {			
for ($counter = 1; $counter < 8; $counter++){		 
if ($counter == $page_no) {
echo "<li class='active page-link bg-dark'><a>$counter</a></li>";	
}else{
echo "<li><a href='?page_no=$counter' class='page-link'>$counter</a></li>";
}
}
echo "<li><a>...</a></li>";
echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
}

elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {		 
echo "<li><a href='?page_no=1'>1</a></li>";
echo "<li><a href='?page_no=2'>2</a></li>";
echo "<li><a>...</a></li>";
for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {			
if ($counter == $page_no) {
echo "<li class='active bg-dark'><a>$counter</a></li>";	
}else{
echo "<li><a href='?page_no=$counter'>$counter</a></li>";
}                  
}
echo "<li><a>...</a></li>";
echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";      
}

else {
echo "<li><a href='?page_no=1'>1</a></li>";
echo "<li><a href='?page_no=2'>2</a></li>";
echo "<li><a>...</a></li>";

for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
if ($counter == $page_no) {
echo "<li class='active bg-dark'><a>$counter</a></li>";	
}else{
echo "<li><a href='?page_no=$counter'>$counter</a></li>";
}                   
}
}
}
?>

<li  <?php if($page_no >= $total_no_of_pages){ echo "class='disabled'"; } ?>>
<a class="page-link" <?php if($page_no < $total_no_of_pages) { echo "href='?page_no=$next_page'"; } ?>>Next</a>
</li>
<?php if($page_no < $total_no_of_pages){
echo "<li><a href='?page_no=$total_no_of_pages' class='page-link'>Last &rsaquo;&rsaquo;</a></li>";
} ?>
<!-------------------  For the number of posts available ---------------------->
<li class=" border border-secondary p-1 font-weight-bold ml-3"><?php $try = "SELECT * FROM `users`";
	$rr = mysqli_query($connect, $try);
	$eee = mysqli_num_rows($rr);
	echo $eee; ?> Users</li>
</ul>

</div>
</div>
</div>
</div>
</div>

<!----------------- REGISTRAION MODAL ---------------->

<div style="background-color: rgba(0,0,0,0.8); display: none; position: absolute; top: 0; width: 100%; min-height: 100%; z-index: 3" id="modal">
	<span class="fas fa-times bg-danger text-light float-right p-3" id="hide" title="Cancel"></span>
<form method="post" enctype="mulipart/form-data" class="">
<div class=" mx-0">
<!-- <div class="col-md-3 mb-3"></div> -->

<!--------------------- Content ------------------------->
<div class="col-md-10 mx-auto shadow border-left border-right mt-4 p-3" style="">
<div class="rounded">
<h4 class="col-md-12 text-center text-light">Add User</h4>
<p class="text-center text-primary col-md-12"><?php echo $msg; ?></p>

<div class="form-group mb-3 row mx-0">
<div class="col-md-6">
<label for="firstname" class=" text-light font-weight-bold">Fullname </label>
<input type="text" name="firstname" value="<?php echo $firstname; ?>" class="form-control mb-3 " required="required" placeholder="Input your Fullname" id="firstname">
</div>


<div class="col-md-6">
<label for="username" class="text-light font-weight-bold">Username </label>
<div class="mb-3">
	<input type="text" name="username" class="form-control" required="required" value="<?php echo $username; ?>" placeholder="Choose Username" id="username">
</div>
</div>

<div class="col-md-6">
<label class="text-light font-weight-bold">Gender </label>
<div class=" mb-3 text-light font-weight-bold">
<select name="gender" class="form-control">
	<option>Male</option>
	<option>Female</option>
</select>
 
</div>
</div>

<div class="col-md-6">
<label for="password" class="text-light font-weight-bold">Password</label>
<div class="mb-3">
	<input type="password" minlength="6" id="password" name="password" class="form-control" required="required" value="<?php echo $password; ?>" placeholder="Password(6 or more characters)">
</div>
</div>

<div class="col-md-6">
<label for="confirm_password" class="text-light font-weight-bold">Confirm Password</label>
<div class="mb-3"><input type="password" id="confirm_password" name="confirm_password" class="form-control" required="required" value="<?php echo $confirm_password; ?>"  placeholder="Confirm Password">
<p class="text-primary font-weight-bold"><?php echo $pErr; ?></p>
</div>
</div>

<div class="col-md-6">
<label class="text-light font-weight-bold">Email</label>
<div class="mb-3">
	<input type="email" name="email" class="form-control" required="required" value="<?php echo $email; ?>" placeholder="...@gmail.com">
</div>
</div>


 <div class="col-md-6">
<label class=" text-light font-weight-bold">Role</label>
<div class="mb-3">
	<select class="form-control" name="role" value="<?php echo $question; ?>">
<option selected="selected">--Select Role--</option>
			<?php 
			$qury = mysqli_query($connect, "SELECT * FROM roles ORDER BY roles ASC");
			while ($w = mysqli_fetch_array($qury)) {
				
			
			?>
<option><?php echo $w['roles']; ?></option>
<?php } ?>
</select>
</div>
</div>
<div class="col-md-6">
<button type="submit" name="submit" class="btn btn-primary w-100 mt-4 mb-3">Register</button>
</div>
</div></div>

</div>

</div>
</form>
</div>
</body>
</html>
        <?php include 'inc/footlink.php'; ?>
<script type="text/javascript">
	$("#show").click(function(){
		$("#modal").show("slow");
	})
	$("#hide").click(function(){
		$("#modal").hide("slow");
	})
</script>