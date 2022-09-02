<?php
		session_start();
		include 'inc/config.php';
			$msg = $username = "";

			if (isset($_POST['submit'])) {
				$username = mysqli_real_escape_string($connect, $_POST['username']);
				$password = mysqli_real_escape_string($connect, $_POST['password']);

				$sql = "SELECT * FROM  users WHERE username = '{$username}' AND password = '{$password}'";
				$query = mysqli_query($connect, $sql);
				$row = mysqli_fetch_array($query);
				$count = mysqli_num_rows($query);
				if ($count > 0) {
					$_SESSION['id'] = $row['id'];
					header('location:admin_page.php');
				}
				else{
					$msg = "Wrong Username/Password or you don't have the right to access the page";
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
	 ?>	| Admin Login Page</title>
	<?php include 'inc/link.php'; ?>
</head>
<body style="background: radial-gradient(circle, rgba(0,0,0,0.7) 50%, rgba(0,0,0,0.4)50%), url('images/keira.jpg'); background-size: cover; background-repeat: no-repeat;  background-attachment: fixed;">
			<div class="container" style="margin-top: 10%">
				
				<div class="col-md-6 text-light m-auto border-left border-right" style=";">
					<div class=" p-3 rounded">
				<h3 class="text-center font-italic font-weight-bold mb-3">Admin Login Page</h3>

				<p class="text-center text-danger"><?php echo $msg; ?></p>
					<form method="post" enctype="multipart/form-data">
					<div class="form-group">
						 <div class=" font-weight-bold">Username </div>
						 <div class=""><input type="text" name="username" required="required" placeholder="Input Username" class="form-control" value="<?php print $username; ?>"></div>
					</div>


					<div class="form-group">
						 <div class="font-weight-bold">Password </div>
						 
						 	<input type="password" name="password" required="required" placeholder="Input Password" class="form-control">
					
						</div>

						
						 
						 
						 	<button type="submit" name="submit" class="btn btn-success btn-lg w-100 mt-2">Login</button>
					
						</form>
					</div>
				</div>
			</div>
			</div>
</body>
</html>