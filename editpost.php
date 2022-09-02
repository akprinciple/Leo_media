<?php 
ob_start();
			include 'inc/session.php';
			$msg = "";
			 
	if($p['edit'] != 1){
  header("location: newpost.php");
 }		
		if (isset($_GET['edit'])) {
			$edit = (int)$_GET['edit'];

		}

		if (isset($_POST['submit'])) {
				 $image = $_FILES['image']['name'];
          $tmp = $_FILES['image']['tmp_name'];
         $type = pathinfo("upload/$image", PATHINFO_EXTENSION);

         
         if ($type != "JPG" && $type != "jpg" && $type != "gif" && $type != "PNG" && $type != "png" && $type != "") {
               		echo "<script>alert('Only jpg, png and gif files are allowed')</script>";
               	}

         elseif ($_FILES['image']['size'] > 600000) {
         	echo "<script>alert('file size is too large')</script>";
         }
         else{
         	$insert= "UPDATE post SET image = '$image' WHERE id = '{$edit}'";
         	$ins = mysqli_query($connect, $insert);
         	if ($ins AND move_uploaded_file($tmp, "upload/$image")) {
         		$msg = "<div class='alert alert-success col-md-6 p-2 font-weight-bold border-success'>Image successfully Updated</div>";
         	}
         	
         }
			}



 ?>


 <!DOCTYPE html>
 <html>
 <head>
 	<title>Edit Post</title>
 	<?php include 'inc/link.php'; ?>
 	
 </head>
 <body>

 		<div class="card">
		<!--------------------------------------- Header  ---------------------------------->

			<!--------------------------------------- Body  ---------------------------------->

				<div class="card-body p-0 m-0">
					<div class="row mx-0">
						<?php include 'inc/admin_sidebar.php'; ?>


						<div class="">
							<h4 class="border-bottom p-2 font-weight-bold mb-5">Edit post</h4>

							<div class="col-md-9 m-auto ">

								<form method="post" enctype="multipart/form-data">
									<div class="">
									<?php 
								$sql = "SELECT * FROM post WHERE id = '{$edit}'";
								$query = mysqli_query($connect, $sql);
								while ($row = mysqli_fetch_array($query)) {
									$title = $row['title'];
									$content = $row['content'];
									$category = $row['category'];
									$image = $row['image'];
								
			 ?>
			 					<!---------------  Post Title  ---------------------->
									<div class="form-group">
										<label for="Post Title" class="font-weight-bold">Title :</label>
										<input type="text" name="title"  class="form-control" required="required" value="<?php echo $title; ?>">
									</div>

									<!---------------  Post Category  ---------------------->

			 						<div class="form-group">
										<label class="font-weight-bold">Category :</label>
											<select name="category" class="form-control text-capitalize" required="required" placeholder="Username">
													<?php 
													$sel = "SELECT * FROM category WHERE id = '{$category}' ORDER BY category ASC";
													$qry = mysqli_query($connect, $sel);
													while ($rw = mysqli_fetch_array($qry)) {
														
														
													
												 ?>
												<option  value="<?php echo $rw['id']; ?>" class="text-capitalize">
														<?php  echo $rw['category']; } ?>
												<?php 
													$sel = "SELECT * FROM category WHERE id != '{$category}' ORDER BY category ASC";
													$qry = mysqli_query($connect, $sel);
													while ($rw = mysqli_fetch_array($qry)) {
														$cat = $rw['category'];
														$cat_id = $rw['id'];
													
												 ?>
														<option class="text-capitalize" value="<?php echo $cat_id; ?>"><?php echo $cat; ?></option>
													<?php } ?>
												</option>
											</select>
										</div>
									
			 					<!---------------  Post Content  ---------------------->
									<div class="form-group">
										<label class="font-weight-bold">Content :</label>
										
											<textarea name="content" id="area" class="form-control"><?php echo $content; ?></textarea>
										
									</div>
			 					
									
									
										
										<div class=" mb-3">
											<input type="submit" name="update" class="text-light btn btn-success" value="Update Post">
                        				<a href=""><button type="button" class="btn btn-danger">Discard Changes</button></a>
										</div>


										<!------------------ Post Image ----------------------->
												<div class="p-2 border rounded mt-5">
											<form method="post" enctype="multipart/form-data">
												
			 								<?php echo $msg; ?>
													<b>Post Image</b>
													<div>
														<img src="upload/<?php echo $image; ?>" class="col-md-6">
													</div>
													<div class="border rounded mt-3 mb-3">
														<input type="file" accept=".jpg" name="image" class="col-md-12">
														
													</div>
										<button type="submit" name="submit" class="btn btn-primary">Update Image</button>
													
											</form>
												</div>


									<?php } ?>
									</div>
								</form>
								</div>

						</div>
					</div>
				</div>
				
 </body>
 </html>

 <?php 	
			if (isset($_POST['update'])) {
				$title = mysqli_real_escape_string($connect, $_POST['title']);
				$content = mysqli_real_escape_string($connect, $_POST['content']);
				$category = mysqli_real_escape_string($connect, $_POST['category']);

				$sql = "UPDATE post SET title = '{$title}',content = '{$content}', category = '{$category}' WHERE id = '{$edit}' ";
				$query = mysqli_query($connect, $sql);
				if ($query) {
					header('location:newpost.php');
				}
			}
			
			 ?>

 	<?php include 'inc/footlink.php'; ?>
 
