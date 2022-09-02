<div class="bg-dark text-light p-5 ">
	<div class="mb-4">
	<b>Advertise with us:</b>
	<span>Reach out to us at 
		<a href="mailto:<?php 
		$link = mysqli_query($connect, "SELECT * FROM links WHERE id = 4");
		$links = mysqli_fetch_array($link);
		echo $links['link'];
	 ?>" class="text-warning font-weight-bold"><?php 
		$link = mysqli_query($connect, "SELECT * FROM links WHERE id = 4");
		$links = mysqli_fetch_array($link);
		echo $links['link'];
	 ?></a>
		 or call 
		 <a href="<?php 
		$link = mysqli_query($connect, "SELECT * FROM links WHERE id = 1");
		$links = mysqli_fetch_array($link);
		echo $links['link'];
	 ?>" class="text-warning font-weight-bold"><?php 
		$link = mysqli_query($connect, "SELECT * FROM links WHERE id = 1");
		$links = mysqli_fetch_array($link);
		echo $links['link'];
	 ?></a>
	</span>
</div>
<div class="row m-0">
	<ul class="list-unstyled col-md-3 ml-auto">
		<li class="font-weight-bold">Categories</li>
		<?php 
			$select = mysqli_query($connect, "SELECT * FROM category");
			while ($nav = mysqli_fetch_array($select)) {
				
			
		 ?>
		<li><a href="categories.php?id=<?php echo md5($nav['id']); ?>&& category=<?php echo $nav['category']; ?>" class="text-light p-2"> <?php echo $nav['category']; ?></a></li>
		<?php } ?>
		<!-- <li><a href="" class="text-light p-2"> News</a></li>
		<li><a href="" class="text-light p-2"> Entertsinment</a></li>
		<li><a href="" class="text-light p-2"> Sports</a></li>
		<li><a href="" class="text-light p-2"> Stories</a></li>
		<li><a href="" class="text-light p-2"> Jokes</a></li> -->

	</ul>
<ul class="list-unstyled col-md-3 ml-auto">
		<li class="font-weight-bold">Social Media</li>
		<li><a href="<?php 
		$link = mysqli_query($connect, "SELECT * FROM links WHERE id = 2");
		$links = mysqli_fetch_array($link);
		echo $links['link'];
	 ?>	" class="text-light p-2"><i class="fab fa-facebook"></i>&nbsp;Facebook</a></li>
		<li><a href="<?php 
		$link = mysqli_query($connect, "SELECT * FROM links WHERE id = 3");
		$links = mysqli_fetch_array($link);
		echo $links['link'];
	 ?>	" class="text-light p-2"><i class="fab fa-twitter"></i>&nbsp; Twitter</a></li>
		<li><a href="<?php 
		$link = mysqli_query($connect, "SELECT * FROM links WHERE id = 6");
		$links = mysqli_fetch_array($link);
		echo $links['link'];
	 ?>	" class="text-light p-2"><i class="fab fa-youtube"></i>&nbsp;Youtube</a></li>
		<li><a href="<?php 
		$link = mysqli_query($connect, "SELECT * FROM links WHERE id = 5");
		$links = mysqli_fetch_array($link);
		echo $links['link'];
	 ?>	" class="text-light p-2"><i class="fab fa-instagram"></i>&nbsp; Instagram</a></li>
		<li><a href="mailto::<?php 
		$link = mysqli_query($connect, "SELECT * FROM links WHERE id = 4");
		$links = mysqli_fetch_array($link);
		echo $links['link'];
	 ?>	" class="text-light p-2"><i class="fab fa-google"></i>&nbsp; Google Mail</a></li>

	</ul>
	<ul class="list-unstyled col-md-3 ml-auto">
		<li class="font-weight-bold">Pages</li>
		<li><a href="index.php" class="text-light p-2"> Home</a></li>
		<li><a href="aboutus.php" class="text-light p-2"> About Us</a></li>
		<li><a href="mailto:<?php 
		$link = mysqli_query($connect, "SELECT * FROM links WHERE id = 4");
		$links = mysqli_fetch_array($link);
		echo $links['link'];
	 ?>" class="text-light p-2"> Advertise with Us</a></li>
		<li><a href="privacy.php" class="text-light p-2"> Privacy and Policy</a></li>
		<li><a href="terms.php" class="text-light p-2"> Terms & Conditions</a></li>

	</ul>
</div>
</div>
<div class="p-3 text-light text-center" style="background-color: black;">
	&copy; <?php echo date('Y'); ?>
	<?php 
		$link = mysqli_query($connect, "SELECT * FROM links WHERE id = 7");
		$links = mysqli_fetch_array($link);
		echo $links['link'];
	 ?>		
</div>
        <?php include 'inc/footlink.php'; ?>
<script type="text/javascript">
	$(document).ready(function() {
							$("#search").click(function(){
								$("#bar").slideToggle("slow");
							})
						})
</script>
<?php 
			$select = mysqli_query($connect, "SELECT * FROM category");
			while ($nav = mysqli_fetch_array($select)) {
				
			$sl = mysqli_query($connect, "SELECT * FROM subcategory WHERE category = '{$nav["id"]}'");
		 		while ($row_nav = mysqli_fetch_array($sl)) {
		 			
		 ?>
		 <script type="text/javascript">
				$("#btn<?php echo ($nav['id']); ?>").mouseenter(function(){
					$("#nav<?php echo ($nav['id']); ?>").show();
			})
			$("#btn<?php echo ($nav['id']); ?>").mouseleave(function(){
					$("#nav<?php echo ($nav['id']); ?>").hide();
			})
			</script>
			<?php }} ?>