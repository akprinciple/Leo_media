<?php 
			include 'inc/config.php';
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>
		<?php 
		$link = mysqli_query($connect, "SELECT * FROM links WHERE id = 7");
		$links = mysqli_fetch_array($link);
		echo $links['link'];
	 ?> | Search Results</title>
	<?php include 'inc/link.php'; ?>
</head>
<body>
	<!--------------------------------------- Header  ---------------------------------->

								<?php include 'inc/header.php'; ?>

<!--------------------------------------- Body  ---------------------------------->
<div class="row col-md-11 m-auto">

		<!-- Left side -->
<div class="col-md-9">					
<h4 class=" mt-5">Search Results</h4>
<hr>
<form action="search_result.php">
<div class="form-group row mx-0 p-2 w-100" id="bar" style="">
	<input type="search" name="search" class="form-control text-center w-75 p-3" placeholder="search By Keyword" required="required" value="<?php if (isset($_GET['search'])) { echo $_GET['search']; } ?>">
	<button type="submit" class="btn btn-danger w-25">Search</button>
</div>
</form>
<?php
if (isset($_GET['search'])) {
$search = $_GET['search'];



				# $sql = "SELECT * FROM post WHERE title LIKE '%".$search."%' OR content LIKE '%".$search."%' ORDER BY date DESC";				 

 
			if (isset($_GET['page_no']) && $_GET['page_no']!="") {
			$page_no = $_GET['page_no'];
			} else {
			$page_no = 1;
		    }

			$total_records_per_page = 4;
			$offset = ($page_no-1) * $total_records_per_page;
			$previous_page = $page_no - 1;
			$next_page = $page_no + 1;
			$adjacents = "2"; 

			$result_count = mysqli_query($connect,"SELECT COUNT(*) As total_records FROM `post` WHERE title LIKE '%".$search."%' OR content LIKE '%".$search."%' ORDER BY id DESC LIMIT $offset, $total_records_per_page");
			$total_records = mysqli_fetch_array($result_count);
			@$total_records = $total_records['total_records'];
			$total_no_of_pages = ceil($total_records / $total_records_per_page);
			$second_last = $total_no_of_pages - 1; // total page minus 1

				 $result = mysqli_query($connect,"SELECT * FROM `post` WHERE title LIKE '%".$search."%' OR content LIKE '%".$search."%' ORDER BY id DESC LIMIT $offset, $total_records_per_page");
				 

				 ?>
				 <div class="col-md-12 text-center font-weight-bold mb-2">
				 	<?php echo $total_records; ?> Result(s) found
				 </div>
				 <?php
			
			while ($row = mysqli_fetch_array($result)) {
			 	$image = $row['image'];
			 	$title = $row['title'];
			 	$content = $row['content'];
			 	$id = $row['id'];
			 	$type = pathinfo("upload/$image", PATHINFO_EXTENSION);
			  ?>
			
	

<a href="javascript:void(0)" onclick="location.href='viewpost.php?post_id=<?php echo $row["id"]; ?>&&title=<?php echo $row["title"]; ?>'" class="row mx-0 text-dark text-decoration-none ">
	<div class="w-25">
		<?php if (!empty($image)) {
		echo "<div style='background: url(upload/$image) center center; background-size: 100vh; height: 100px' class='p-2 position-relative'></div>";
				  } ?>
	</div>
	
	<div class="w-75 p-3"><h5 class="font-weight-bold"><?php echo $title; ?></h5></div>
</a>
<!----------------------------Date  -------------------------->
		<div class=" text-center">
			<b>Posted On:</b> <span><?php echo $row['date']; ?></span>
		</div>
<hr>
			
		<?php } ?>
		
			
<!----------------------------Pagination  -------------------------->

	<ul class="pagination row">
	<?php // if($page_no > 1){ echo "<li><a href='?page_no=1'>First Page</a></li>"; } ?>
    
	<li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
	<a class="page-link" <?php if($page_no > 1){ echo "href='?search=$search&&page_no=$previous_page'"; } ?>>Previous</a>
	</li>
       
    <?php 
	if ($total_no_of_pages <= 10){  	 
		for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
			if ($counter == $page_no) {
		   echo "<li class='active page-link bg-leo text-light'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?search=$search&&page_no=$counter' class='page-link'>$counter</a></li>";
				}
        }
	}
	elseif($total_no_of_pages > 10){
		
	if($page_no <= 4) {			
	 for ($counter = 1; $counter < 8; $counter++){		 
			if ($counter == $page_no) {
		   echo "<li class='active page-link'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?search=$search&&page_no=$counter' class='page-link'>$counter</a></li>";
				}
        }
		echo "<li><a>...</a></li>";
		echo "<li><a href='?search=$search&&page_no=$second_last'>$second_last</a></li>";
		echo "<li><a href='?search=$search&&page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
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
	   echo "<li><a href='?id=search=$search&&page_no=$second_last'>$second_last</a></li>";
	   echo "<li><a href='?id=$search=$search&&page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";      
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
	<a class="page-link" <?php if($page_no < $total_no_of_pages) { echo "href='?search=$search&&page_no=$next_page'"; } ?>>Next</a>
	</li>
    <?php if($page_no < $total_no_of_pages){
		echo "<li><a href='?search=$search&&page_no=$total_no_of_pages' class='page-link'>Last &rsaquo;&rsaquo;</a></li>";
		} ?>
</ul>
<?php } ?>
<!-- News Letter Subscription -->
		<?php include 'inc/newsletter.php'; ?>
</div>					 


<?php include 'inc/rightside.php'; ?>

</div>
			<!-- footer -->
				

        <?php include 'inc/footer.php'; ?>
	</div>
		</body>
		</html>