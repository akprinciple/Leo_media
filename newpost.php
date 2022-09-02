     <?php   

     	include 'inc/session.php';
     	ob_start();
           

?>

<!DOCTYPE html>
<html>
<head>
	<title><?php 
		$link = mysqli_query($connect, "SELECT * FROM links WHERE id = 7");
		$links = mysqli_fetch_array($link);
		echo $links['link'];
	 ?>	 | Manage Posts</title>
	<?php include 'inc/link.php'; ?>
</head>
<body>
	<div class="card">
		<!------------------ Header  ------------------>

			<!--------------------- Body  ------------->

		<div class="card-body p-0 m-0">
			<div class="row mx-0">
			<?php include 'inc/admin_sidebar.php'; ?>

			<h4 class="font-weight-bold border-bottom pl-3 pt-3 mb-5"> Posts</h4>
			<div class="p-3">

<a href="addpost.php" class="float-right <?php if($p['post'] != 1){
  echo "d-none"; }  ?>">
  <button class="btn btn-success font-weight-bold mb-2">Add post <i class=" fas fa-plus-circle ml-2"></i> </button>
</a>
			<div class="clearfix"></div>
		<!------------ For Admins------- -->
	

		
		<table class="table-striped table col-md-12 text-center table-bordered">
		<thead class="">
			<tr>
				<th>Author</th>
				<th>Title</th>
				<th>Views</th>
				<th>Banner</th>
				<th>Actions</th>
				<th>Date</th>
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
		$result_count = mysqli_query($connect,"SELECT COUNT(*) As total_records FROM `post`");
		$total_records = mysqli_fetch_array($result_count);
		$total_records = $total_records['total_records'];
    	$total_no_of_pages = ceil($total_records / $total_records_per_page);
		$second_last = $total_no_of_pages - 1; // total page minus 1
		$result = mysqli_query($connect, "SELECT * FROM `post` ORDER BY id DESC LIMIT $offset, $total_records_per_page");
  		while ($row = mysqli_fetch_array($result)) {
		$image = $row['image'];
		$title = $row['title'];
		$content = $row['content'];
		$date = $row['date'];
		$username = $row['username'];
		$id_post = $row['id']; 
		?>
		<tr>
			<td>
				<?php
				$con = mysqli_query($connect, "SELECT * FROM users WHERE username = '{$username}'"); 
				
						$use = mysqli_fetch_array($con);
						
				 ?>
				<a href="profile.php?user=<?php echo $use['id']; ?>&&name=<?php echo $username; ?>" class="font-weight-bold"><?php echo $username; ?></a>
				
			</td>
			<!--------------------- Title  ----------->
			<td class="w-50" title="<?php echo $title; ?>">
				<?php echo $title; ?>
					
				</td>
				<!-- Number of Views -->
				<td><?php echo $row['views']; ?></td>

				<td>
					<a class="text-decoration-none" onclick="location.href='approval.php?banner=<?php echo $row["id"]; ?>'" href="javascript:void(0)" 
				title="<?php if($row['banner'] == 1){
				echo "Active";
				}
				else{
				echo "Not Active";
				} ?>">
				<?php 
				if ($row['banner']==1) {
				echo "<button class='btn btn-primary border-0 fas fa-check'></button>";
				}
				else{
				echo "<button class='btn btn-danger border-0 text-light fas fa-check'></button>";
				} ?>
				</a>
				</td>
					<?php  
						
						
					?>
			<!------------- View Button -------------------------->
						 			
			<td>
				<a class="fas fa-eye text-decoration-none text-primary" onclick="location.href='viewpost.php?post_id=<?php echo $row["id"]; ?>&&title=<?php echo $row["title"]; ?>'" href="javascript:void(0)" title="View Post">
				</a>
				<!----------- Edit Button  --------------->
				<a title="Edit post" class="fas fa-pen text-decoration-none text-secondary <?php if($p['edit'] != 1){
  echo "d-none"; }  ?>" onclick="location.href='editpost.php?edit=<?php echo $row["id"]; ?>'" href="javascript:void(0)">
				</a>
							 			
		<!--- Approval Button--------->
				<a class="text-decoration-none <?php if($p['approve'] != 1){
  echo "d-none"; }  ?>" onclick="location.href='approval.php?approve=<?php echo $row["id"]; ?>'" href="javascript:void(0)" 
				title="<?php if($row['status'] == 1){
				echo "Approved";
				}
				else{
				echo "Unapproved";
				} ?>">
				<?php 
				if ($row['status']==1) {
				echo "<button class='btn btn-success border-0 fas fa-check'></button>";
				}
				else{
				echo "<button class='btn btn-warning border-0 text-light fas fa-check'></button>";
				} ?>
				</a>
							 	
	<!--------------------------- Delete Button  ---------------------------------->
				<a title="Delete" href="deletepost.php?delete=<?php echo $row['id']; ?>" class="fas fa-times ml-3 text-danger text-underline_none <?php if($p['remove'] != 1){
  echo "d-none"; }  ?>"></a>
			</td>
				<!--------------------------- Date  ---------------------------------->

			<td class=""><?php echo $date; ?></td>
		</tr>
		
<?php } ?>
	</tbody>
</table>

								
<!------------------ For dividing the pages   --------->

<ul class="pagination">
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
		<!------------------------------  For the number of posts available -------------------------------->
		<li class="nav-link border border-secondary p-1 font-weight-bold ml-3 text-dark"><?php $try = "SELECT * FROM `post`";
										$rr = mysqli_query($connect, $try);
										$eee = mysqli_num_rows($rr);
										echo $eee; ?> posts avalaible</li>
</ul>

						</div>
					</div>
				</div>
			</div>


</body>
</html>
	<?php include 'inc/footlink.php'; ?>
