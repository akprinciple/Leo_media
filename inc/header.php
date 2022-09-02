<header class=" bg-leo head p-0 position-relative">
		
	<ul class="nav w-100" style="">
		<li class="bars offset-1 p-3 " id="small" onclick="cancel_side();">
			<b class=" fa-2x fas fa-bars text-light"></b>
		</li>
		<li class="bar offset-1 p-3 " id="screen" onclick="display_side();">
			<b class=" fa-2x fas fa-bars text-light"></b>
		</li>
		<a href="index.php" class="nav-link offset-1">
			<li class=" text-light fas fa-home fa-1x p-3 pointer">
			<span class="">&nbsp; <?php 
		$link = mysqli_query($connect, "SELECT * FROM links WHERE id = 7");
		$links = mysqli_fetch_array($link);
		echo $links['link'];
	 ?>	</span>
		</li>
		</a>
		<div class="nav" id="left_side">
		<?php 
			$select = mysqli_query($connect, "SELECT * FROM category WHERE status = 0");
			while ($nav = mysqli_fetch_array($select)) {
				
			
		 ?>
		 <!-- Categories -->
		 <li class=""  id="btn<?php echo ($nav['id']); ?>" style="">
		<a href="categories.php?id=<?php echo md5($nav['id']);  ?>&&category=<?php echo $nav['category']; ?>" class="nav-link text-light p-3 under " style="z-index: 0">
			
			<?php echo $nav['category']; ?>
		</a>
		<ul class="btn-leo p-2 text-center w-100 position-absolute und" style="display: none; z-index: 2; left: 0;" id="nav<?php echo $nav['id']; ?>">
			<?php  
		 		$sl = mysqli_query($connect, "SELECT * FROM subcategory WHERE category = '{$nav["id"]}' AND status = 0");
		 		while ($row_nav = mysqli_fetch_array($sl)) {
		 			
		 		
		 	?>
		 	<!-- Subcategories -->
		 	<a href="categories.php?subcategory=<?php echo md5($row_nav['id']); ?>&&category=<?php echo $nav['category']; ?>" class="text-light ml-2"><?php echo $row_nav['subcategory']; ?></a>
		 	<?php } ?>
		 
		</ul>
			</li>
	<?php } ?>
</div>
		<!-- Social Media Links -->
		<li class="offset-1 p-3 cat">
			<a href="<?php 
		$link = mysqli_query($connect, "SELECT * FROM links WHERE id = 2");
		$links = mysqli_fetch_array($link);
		echo $links['link'];
	 ?>	" class="fab fa-facebook nav-link"></a>
		</li>
		<li class="p-3 cat">
			<a href="<?php 
		$link = mysqli_query($connect, "SELECT * FROM links WHERE id = 3");
		$links = mysqli_fetch_array($link);
		echo $links['link'];
	 ?>	" class="fab fa-twitter nav-link" ></a>
		</li>
		<li class="p-3 cat">
			<a href="<?php 
		$link = mysqli_query($connect, "SELECT * FROM links WHERE id = 5");
		$links = mysqli_fetch_array($link);
		echo $links['link'];
	 ?>	" class="fab fa-instagram nav-link"></a>
		</li>
		<li class="p-3 cat">
			<a href="<?php 
		$link = mysqli_query($connect, "SELECT * FROM links WHERE id = 6");
		$links = mysqli_fetch_array($link);
		echo $links['link'];
	 ?>	" class="fab fa-youtube nav-link"></a>
		</li>
		<!-- Search Icon -->
		<li class="nav-link p-3" id="search">
			<span href="" class="fas fa-search"></span>
		</li>
		</ul>
		<!-- Search Bar -->
		<form action="search_result.php" class="form">
		<div class="form-group row mx-0 p-2 w-100" id="bar" style="display: none; position: absolute; z-index: 3">
			<input type="search" required="required" name="search" class="form-control text-center w-75 p-3" placeholder="search By Keyword">
			<button type="submit" class="btn btn-danger w-25">Search</button>
		</div>
		</form>
		</header>
