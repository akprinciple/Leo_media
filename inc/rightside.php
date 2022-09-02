<div class="col-md-3 pt-5">
		<h4 class="text-center">Latest Stories</h4>

		<?php 
		 $date = date('d/M/Y @ h:m:s');
		 	$sq = mysqli_query($connect, "SELECT * FROM category WHERE category = 'stories' LIMIT 1");
		 	
			while ($r = mysqli_fetch_array($sq)) {
			$trend = mysqli_query($connect, "SELECT * FROM post WHERE category = '{$r["id"]}' AND status = 1 ORDER BY id DESC LIMIT 5");
			while ($right = mysqli_fetch_array($trend)) {
				
			
		?>

		<a  href="javascript:void(0)" onclick="location.href='viewpost.php?post_id=<?php echo $right["id"]; ?>&&title=<?php echo $right["title"]; ?>'" class="text-dark text-decoration-none text-center mb-2">
		<div class="my-3">
		<?php if (!empty($right['image'])) {
			
		 ?>
		<img src="upload/<?php echo $right['image'] ?>" class="card-img">
		<?php } ?>
		<p class=" font-weight-bold"><?php echo $right['title']; ?></p>
		</div>
		<?php  
			// echo date_diff($date, $right['date']);
		?>
		</a>

		<?php }} ?>
	</div>