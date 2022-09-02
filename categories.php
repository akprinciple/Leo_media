<?php  
		include 'inc/config.php';
		if (isset($_GET['id']) && isset($_GET['category'])) {
			$cat = $_GET['category'];
			$id = $_GET['id'];
		}
		if (isset($_GET['subcategory']) && isset($_GET['category'])) {
			$cat = $_GET['category'];
			$subcategory = $_GET['subcategory'];

		}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php 
		$link = mysqli_query($connect, "SELECT * FROM links WHERE id = 7");
		$links = mysqli_fetch_array($link);
		echo $links['link'];
	 ?> | <?php echo $cat; ?></title>
	<?php include 'inc/link.php'; ?>
</head>
<body>
	<?php include 'inc/header.php'; ?>

	<div class="col-md-11 m-auto row">
		<div class="col-md-9 mt-5">
	<?php if (isset($_GET['id']) && isset($_GET['category'])) { ?>
	<h5><?php echo $cat; ?></h5>
	<hr>
	<div class="row mx-0">
	<?php 
	if (isset($_GET['page_no']) && $_GET['page_no']!="") {
	$page_no = $_GET['page_no'];
	} else {
	$page_no = 1;
    }

	$total_records_per_page = 24;
			$offset = ($page_no-1) * $total_records_per_page;
	$previous_page = $page_no - 1;
	$next_page = $page_no + 1;
	$adjacents = "2"; 

	$result_count = mysqli_query($connect,"SELECT COUNT(*) As total_records FROM `post` WHERE md5(category) = '$id'");
	$total_records = mysqli_fetch_array($result_count);
	$total_records = $total_records['total_records'];
	$total_no_of_pages = ceil($total_records / $total_records_per_page);
	$second_last = $total_no_of_pages - 1; // total page minus 1

		 // $result = mysqli_query($connect, "SELECT * FROM `post` WHERE category = 'gossip' AND status = 1 ORDER BY id DESC LIMIT $offset, $total_records_per_page");
		 


	
	// while ($row = mysqli_fetch_array($result)) {

	//  	$image = $row['image'];
	//  	$title = $row['title'];
	//  	$content = $row['content'];

										  
		$sql = mysqli_query($connect, "SELECT * FROM post WHERE md5(category) = '$id' AND status = 1 ORDER BY id DESC LIMIT $offset, $total_records_per_page");
		while ($row = mysqli_fetch_array($sql)) {
			// echo $row['title'].'<br>';
		
	?>
	<a href="javascript:void(0)" class="my-1 mx-0 col-md-6 row p-3  text-decoration-none" onclick="location.href='viewpost.php?post_id=<?php echo $row["id"]; ?>&&title=<?php echo $row["title"]; ?>'">

				<img height="200px" class="w-100" src="upload/<?php echo $row['image']; ?>">
				<p class=" text-justify-force p-2 text-dark font-weight-bold" style="/*max-width: 300px*/;">
				<?php 
				$title=$row['title'];
				echo $title;
				// substr($title, 0, 70)
				 // $title;
				// if(strlen($title) > 70) {
				// 	echo "...";
				// }
				?></p>
				
			</a>
		<?php } ?>
	</div>
	<ul class="pagination row">
	<?php // if($page_no > 1){ echo "<li><a href='?page_no=1'>First Page</a></li>"; } ?>
    
	<li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
	<a class="page-link" <?php if($page_no > 1){ echo "href='?id=$id&&category=$cat&&page_no=$previous_page'"; } ?>>Previous</a>
	</li>
       
    <?php 
	if ($total_no_of_pages <= 10){  	 
		for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
			if ($counter == $page_no) {
		   echo "<li class='active page-link bg-leo text-light'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?id=$id&&category=$cat&&page_no=$counter' class='page-link'>$counter</a></li>";
				}
        }
	}
	elseif($total_no_of_pages > 10){
		
	if($page_no <= 4) {			
	 for ($counter = 1; $counter < 8; $counter++){		 
			if ($counter == $page_no) {
		   echo "<li class='active page-link'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?id=$id&&category=$cat&&page_no=$counter' class='page-link'>$counter</a></li>";
				}
        }
		echo "<li><a>...</a></li>";
		echo "<li><a href='?id=$id&&category=$cat&&page_no=$second_last'>$second_last</a></li>";
		echo "<li><a href='?id=$id&&category=$cat&&page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
		}

	 elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {		 
		echo "<li><a href='?page_no=1'>1</a></li>";
		echo "<li><a href='?page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";
        for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {			
           if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
				}                  
       }
       echo "<li><a>...</a></li>";
	   echo "<li><a href='?id=$id&&category=$cat&&page_no=$second_last'>$second_last</a></li>";
	   echo "<li><a href='?id=$id&&category=$cat&&page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";      
            }
		
		else {
        echo "<li><a href='?page_no=1'>1</a></li>";
		echo "<li><a href='?page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";

        for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
          if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
				}                   
                }
            }
	}
?>
    
	<li  <?php if($page_no >= $total_no_of_pages){ echo "class='disabled'"; } ?>>
	<a class="page-link" <?php if($page_no < $total_no_of_pages) { echo "href='?id=$id&&category=$cat&&page_no=$next_page'"; } ?>>Next</a>
	</li>
    <?php if($page_no < $total_no_of_pages){
		echo "<li><a href='?id=$id&&category=$cat&&page_no=$total_no_of_pages' class='page-link'>Last &rsaquo;&rsaquo;</a></li>";
		} ?>
</ul>
<?php } ?>





		<!-- Post By Subcategories -->

		<?php if (isset($_GET['subcategory']) && isset($_GET['category'])) { 

			$subcategory = $_GET['subcategory'];

			$sub = mysqli_query($connect, "SELECT * FROM subcategory WHERE md5(id) = '$subcategory'");
			$subrow = mysqli_fetch_array($sub);

			$cate = mysqli_query($connect, "SELECT * FROM category WHERE category = '$cat'");
			$catrow = mysqli_fetch_array($cate);
			$catrow_id = md5($catrow["id"]);
			?>

	<h5><?php echo "<a href='?id=$catrow_id&&category=$cat'>$cat</a>"." | ". $subrow['subcategory']; ?></h5>
	<hr>
	<div class="row mx-0">
	<?php 
	if (isset($_GET['page_no']) && $_GET['page_no']!="") {
	$page_no = $_GET['page_no'];
	} else {
	$page_no = 1;
    }

	$total_records_per_page = 24;
			$offset = ($page_no-1) * $total_records_per_page;
	$previous_page = $page_no - 1;
	$next_page = $page_no + 1;
	$adjacents = "2"; 

	$result_count = mysqli_query($connect,"SELECT COUNT(*) As total_records FROM `post` WHERE md5(sub_category) = '$subcategory'");
	$total_records = mysqli_fetch_array($result_count);
	$total_records = $total_records['total_records'];
	$total_no_of_pages = ceil($total_records / $total_records_per_page);
	$second_last = $total_no_of_pages - 1; // total page minus 1

		 // $result = mysqli_query($connect, "SELECT * FROM `post` WHERE category = 'gossip' AND status = 1 ORDER BY id DESC LIMIT $offset, $total_records_per_page");
		 


	
	// while ($row = mysqli_fetch_array($result)) {

	//  	$image = $row['image'];
	//  	$title = $row['title'];
	//  	$content = $row['content'];

										  
		$sql = mysqli_query($connect, "SELECT * FROM post WHERE md5(sub_category) = '$subcategory' AND status = 1 ORDER BY id DESC LIMIT $offset, $total_records_per_page");
		while ($row = mysqli_fetch_array($sql)) {
			// echo $row['title'].'<br>';
		
	?>
	<a href="javascript:void(0)" class="my-1 mx-0 col-md-6 row p-3  text-decoration-none" onclick="location.href='viewpost.php?post_id=<?php echo $row["id"]; ?>&&title=<?php echo $row["title"]; ?>'">

				<img height="200px" class="w-100" src="upload/<?php echo $row['image']; ?>">
				<p class=" text-justify-force p-2 text-dark font-weight-bold" style="/*max-width: 300px*/;">
				<?php 
				$title=$row['title'];
				echo $title;
				// substr($title, 0, 70)
				 // $title;
				// if(strlen($title) > 70) {
				// 	echo "...";
				// }
				?></p>
				
			</a>
		<?php } ?>
	</div>
	<ul class="pagination row">
	<?php // if($page_no > 1){ echo "<li><a href='?page_no=1'>First Page</a></li>"; } ?>
    
	<li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
	<a class="page-link" <?php if($page_no > 1){ echo "href='?id=$id&&category=$cat&&page_no=$previous_page'"; } ?>>Previous</a>
	</li>
       
    <?php 
	if ($total_no_of_pages <= 10){  	 
		for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
			if ($counter == $page_no) {
		   echo "<li class='active page-link bg-leo text-light'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?id=$id&&category=$cat&&page_no=$counter' class='page-link'>$counter</a></li>";
				}
        }
	}
	elseif($total_no_of_pages > 10){
		
	if($page_no <= 4) {			
	 for ($counter = 1; $counter < 8; $counter++){		 
			if ($counter == $page_no) {
		   echo "<li class='active page-link'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?id=$id&&category=$cat&&page_no=$counter' class='page-link'>$counter</a></li>";
				}
        }
		echo "<li><a>...</a></li>";
		echo "<li><a href='?id=$id&&category=$cat&&page_no=$second_last'>$second_last</a></li>";
		echo "<li><a href='?id=$id&&category=$cat&&page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
		}

	 elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {		 
		echo "<li><a href='?page_no=1'>1</a></li>";
		echo "<li><a href='?page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";
        for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {			
           if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
				}                  
       }
       echo "<li><a>...</a></li>";
	   echo "<li><a href='?id=$id&&category=$cat&&page_no=$second_last'>$second_last</a></li>";
	   echo "<li><a href='?id=$id&&category=$cat&&page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";      
            }
		
		else {
        echo "<li><a href='?page_no=1'>1</a></li>";
		echo "<li><a href='?page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";

        for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
          if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
				}                   
                }
            }
	}
?>
    
	<li  <?php if($page_no >= $total_no_of_pages){ echo "class='disabled'"; } ?>>
	<a class="page-link" <?php if($page_no < $total_no_of_pages) { echo "href='?id=$id&&category=$cat&&page_no=$next_page'"; } ?>>Next</a>
	</li>
    <?php if($page_no < $total_no_of_pages){
		echo "<li><a href='?id=$id&&category=$cat&&page_no=$total_no_of_pages' class='page-link'>Last &rsaquo;&rsaquo;</a></li>";
		} ?>
</ul>
<?php } ?>


<!-- NewsLetter -->
		<?php include 'inc/newsletter.php'; ?>
		<p class="p-2" style="background-color: ghostwhite">Do you have a story for us? Message us @ 
			<a href="mailto::<?php 
		$link = mysqli_query($connect, "SELECT * FROM links WHERE id = 4");
		$links = mysqli_fetch_array($link);
		echo $links['link'];
	 ?>"><?php 
		$link = mysqli_query($connect, "SELECT * FROM links WHERE id = 4");
		$links = mysqli_fetch_array($link);
		echo $links['link'];
	 ?></a>
		</p>		
</div>

<?php include 'inc/rightside.php'; ?>
		
	</div>
        <?php include 'inc/footer.php'; ?>
</body>
</html>