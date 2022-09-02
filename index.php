<?php 
include 'inc/config.php';

 ?>
<!DOCTYPE html>
<html>
<head>
	<title><?php 
		$link = mysqli_query($connect, "SELECT * FROM links WHERE id = 7");
		$links = mysqli_fetch_array($link);
		echo $links['link'];
	 ?>	| Homepage</title>
	
	<?php include 'inc/link.php'; ?>
</head>
<body>
	<?php include 'inc/header.php'; ?>
	<!-- Content -->
<div class="row col-md-11 m-auto">

				<!-- Left side -->
	<div class="col-md-9">
		<!-- Banner -->
		<div class="mt-5 mb-5 position-relative">
			<?php  
			$sql = mysqli_query($connect, "SELECT * FROM post WHERE banner = 1 ORDER BY id DESC LIMIT 1");
			while ($row = mysqli_fetch_array($sql)) {
				
			
			?>
			<img src="upload/<?php echo $row['image'] ?>" class="card-img pb-5" style="z-index: 0">
			<div class="position-absolute w-100 " style="top: 85%; ">
			
			<a href="javascript:void(0)" onclick="location.href='viewpost.php?post_id=<?php echo $row["id"]; ?>&&title=<?php echo $row["title"]; ?>'">
				<p class="p-2 col-md-9 m-auto shadow bg-white font-weight-bold text-center ">
				<?php echo $row['title']; ?>
				</p>
			</a>
		</div>
	<?php } ?>
		</div>

		<!-- Latest -->
		<h3>Latest</h3>
		<hr>
		<div class="row mx-0 mb-4">
     
			 <?php  
			
				
			
      		$q = mysqli_query($connect, "SELECT * FROM post WHERE status = 1 ORDER BY id DESC LIMIT 6");
			while ($row = mysqli_fetch_array($q)) {
				
			
			?>
			<!-- <img src="" class="card-img pb-5" style="z-index: 0"> -->
				<a href="javascript:void(0)" class="col-md-4 mx-0 mt-2 p-2 row shadow bg-white" onclick="location.href='viewpost.php?post_id=<?php echo $row["id"]; ?>&&title=<?php echo $row["title"]; ?>'">
			
		
	
			
				<img src="upload/<?php echo $row['image']; ?>" class="r-image p-2">
			
			
				<p class="p-2 pp font-weight-bold text-center ">
				<?php echo $row['title']; ?>
				</p>
			
			
		
	</a>
	<?php } ?>
</div>
		<!-- News -->
		<h3 class="pt-5 float-left">News</h3>
		<?php  
			$sql = mysqli_query($connect, "SELECT * FROM category WHERE category = 'news' LIMIT 1");
			while ($r = mysqli_fetch_array($sql)) {
		?>
		<a href="categories.php?id=<?php echo md5($r['id']);  ?>&&category=<?php echo $r['category']; ?>" class="text-decoration-none float-right pt-5 text-dark">
			
			Read More ...
		</a>
		<div class="clearfix"></div>
		<hr class="mt-0">
		<div class="row mx-0 mb-4">
     
			 <?php  
			
	   		$q = mysqli_query($connect, "SELECT * FROM post WHERE category = '{$r["id"]}' && status = 1 ORDER BY id DESC LIMIT 6");
			while ($row = mysqli_fetch_array($q)) {
				
			
			?>
			<!-- <img src="" class="card-img pb-5" style="z-index: 0"> -->
				<a href="javascript:void(0)" class="col-md-4 mx-0 mt-2 p-2 row shadow bg-white" onclick="location.href='viewpost.php?post_id=<?php echo $row["id"]; ?>&&title=<?php echo $row["title"]; ?>'">
			
		
	
			
				<img src="upload/<?php echo $row['image']; ?>" class="r-image p-2">
			
			
				<p class="p-2 pp font-weight-bold text-center ">
				<?php echo $row['title']; ?>
				</p>
			
			
		
	</a>
	<?php } ?>
		
		<a href="categories.php?id=<?php echo md5($r['id']);  ?>&&category=<?php echo $r['category']; ?>" class="text-decoration-none float-right p-2 mt-3 text-center w-100 text-dark border dis-none">
			
			Read More ...
		</a>
<?php } ?>
		
		</div>
	
		<!-- News Letter Subscription -->
		<?php include 'inc/newsletter.php'; ?>

		<!-- Carousel For Entertainment -->
		<h3 class="pt-5 float-left	">Entertainment</h3>
		<?php  
			$sql = mysqli_query($connect, "SELECT * FROM category WHERE category = 'entertainment' LIMIT 1");
			while ($r = mysqli_fetch_array($sql)) {
		?>
		<a href="categories.php?id=<?php echo md5($r['id']);  ?>&&category=<?php echo $r['category']; ?>" class="text-decoration-none float-right pt-5 text-dark">
			
			Read More ...
		</a>
		<div class="clearfix"></div>
		<hr class="mt-0">
		<div class="row mx-0 mb-4">
     
			 <?php  
			
				
			
      		$q = mysqli_query($connect, "SELECT * FROM post WHERE category = '{$r["id"]}' && status = 1 ORDER BY id DESC LIMIT 6");
			while ($row = mysqli_fetch_array($q)) {
				
			
			?>
			<!-- <img src="" class="card-img pb-5" style="z-index: 0"> -->
				<a href="javascript:void(0)" class="col-md-4 mx-0 mt-2 p-2 row shadow bg-white" onclick="location.href='viewpost.php?post_id=<?php echo $row["id"]; ?>&&title=<?php echo $row["title"]; ?>'">
			
		
	
			
				<img src="upload/<?php echo $row['image']; ?>" class="r-image p-2">
			
			
				<p class="p-2 pp font-weight-bold text-center ">
				<?php echo $row['title']; ?>
				</p>
			
			
		
	</a>
	<?php } ?>
	<a href="categories.php?id=<?php echo md5($r['id']);  ?>&&category=<?php echo $r['category']; ?>" class="text-decoration-none float-right p-2 mt-3 text-center w-100 text-dark border dis-none">
			
			Read More ...
		</a>
		<?php } ?>	
		</div>
		
	   	<!-- Carousel For Sports -->
	
		<h3 class="pt-5 float-left	">Sports</h3>
		<?php  
			$sql = mysqli_query($connect, "SELECT * FROM category WHERE category = 'sports' LIMIT 1");
			while ($r = mysqli_fetch_array($sql)) {
		?>
		<a href="categories.php?id=<?php echo md5($r['id']);  ?>&&category=<?php echo $r['category']; ?>" class="text-decoration-none float-right pt-5 text-dark">
			
			Read More ...
		</a>
		<div class="clearfix"></div>
		<hr class="mt-0">
		<div class="row mx-0 mb-4">
     
			 <?php  
			
				
			
      		$q = mysqli_query($connect, "SELECT * FROM post WHERE category = '{$r["id"]}' && status = 1 ORDER BY id DESC LIMIT 6");
			while ($row = mysqli_fetch_array($q)) {
				
			
			?>
			<!-- <img src="" class="card-img pb-5" style="z-index: 0"> -->
				<a href="javascript:void(0)" class="col-md-4 mx-0 mt-2 p-2 row shadow bg-white" onclick="location.href='viewpost.php?post_id=<?php echo $row["id"]; ?>&&title=<?php echo $row["title"]; ?>'">
			
		
	
			
				<img src="upload/<?php echo $row['image']; ?>" class="r-image p-2">
			
			
				<p class="p-2 pp font-weight-bold text-center ">
				<?php echo $row['title']; ?>
				</p>
			
			
		
	</a>
	<?php } ?>
		<a href="categories.php?id=<?php echo md5($r['id']);  ?>&&category=<?php echo $r['category']; ?>" class="text-decoration-none float-right p-2 mt-3 text-center w-100 text-dark border dis-none">
			
			Read More ...
		</a>
	<?php } ?>
		</div>
		
  </div>

  <!-- Left and right controls -->
<!--   <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>
</div> -->


				<!-- Right side -->
	<?php include 'inc/rightside.php'; ?>

</div>
			<!-- footer -->
				

        <?php include 'inc/footer.php'; ?>
</body>
</html>


























<!-- Carousel For Stories -->
		<!-- <h3 class="pt-5">Stories</h3> -->
		<!-- <div id="demo" class="carousel slide mb-4" data-ride="carousel">

  Indicators
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active bg-primary"></li>
    <li data-target="#demo" data-slide-to="1" class="bg-primary"></li>
    <li data-target="#demo" data-slide-to="2" class="bg-danger"></li>
  </ul> -->

  <!-- The slideshow -->
<!--   <div class="carousel-inner pb-5">
    <div class="carousel-item active">
    	<div class="row mx-0">
      <?php  
			$sql = mysqli_query($connect, "SELECT * FROM category WHERE category = 'stories' LIMIT 1");
			while ($r = mysqli_fetch_array($sql)) {
				
			
      		$q = mysqli_query($connect, "SELECT * FROM post WHERE category = '{$r["id"]}' ORDER BY id DESC LIMIT 2");
			while ($row = mysqli_fetch_array($q)) {
				
			
			?>
			<img src="" class="card-img pb-5" style="z-index: 0">
			 <div class="w-50 p-2">
		
	
			<div class="">
				<img src="upload/<?php echo $row['image']; ?>" class="card-img">
			</div>
			<div class="">
				<a href="javascript:void(0)" onclick="location.href='viewpost.php?post_id=<?php echo $row["id"]; ?>&&title=<?php echo $row["title"]; ?>'">
				<p class="p-2 col-md-9 m-auto shadow bg-white font-weight-bold text-center ">
				<?php echo $row['title']; ?>
				</p>
			</a>
			</div>
		</div>
	<?php }} ?>
		</div>
    </div>
 -->    <!-- <div class="carousel-item">

      <div class="row mx-0">
      <?php  
			$sql = mysqli_query($connect, "SELECT * FROM category WHERE category = 'stories' LIMIT 1");
			while ($r = mysqli_fetch_array($sql)) {
				
			
      		$q = mysqli_query($connect, "SELECT * FROM post WHERE category = '{$r["id"]}' ORDER BY id DESC LIMIT 2");
			while ($row = mysqli_fetch_array($q)) {
				
			
			?>
			<img src="" class="card-img pb-5" style="z-index: 0">
			 <div class="w-50 p-2">
		
	
			<div class="">
				<img src="upload/<?php echo $row['image']; ?>" class="card-img">
			</div>
			<div class="">
				<a href="javascript:void(0)" onclick="location.href='viewpost.php?post_id=<?php echo $row["id"]; ?>&&title=<?php echo $row["title"]; ?>'">
				<p class="p-2 col-md-9 m-auto shadow bg-white font-weight-bold text-center ">
				<?php echo $row['title']; ?>
				</p>
			</a>
			</div>
		</div>
	<?php }} ?>
		</div>
    </div>
  
  </div> -->

  <!-- Left and right controls -->
<!--   <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>

</div>

 --> 