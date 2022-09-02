<?php 
include 'inc/config.php';
if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
$ip = $_SERVER['HTTP_CLIENT_IP'];
}elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
}else{
$ip = $_SERVER['REMOTE_ADDR'];
}

 ?>
<!DOCTYPE html>
<html>
<head>
	<title><?php 
		$link = mysqli_query($connect, "SELECT * FROM links WHERE id = 7");
		$links = mysqli_fetch_array($link);
		echo $links['link'];
	 ?> | View Post</title>
	<?php include 'inc/link.php'; ?>
	<style type="text/css">

	</style>

</head>
<body>
	<?php include 'inc/header.php'; ?>
	<div class="col-md-11 m-auto row">
		<div class="col-md-9 mt-5">
		<?php  
		if (isset($_GET['post_id']) && isset($_GET['title'])) {
			$post_title = $_GET['title'];
			$post_id = (int)$_GET['post_id'];
			
            

			$sql = mysqli_query($connect, "SELECT * FROM post WHERE id = '{$post_id}' && title = '{$post_title}'");
			while ($row = mysqli_fetch_array($sql)) {
			$plus = $row['views'] + 1;
			if (isset($ip)) {
			
			$ins = mysqli_query($connect, "UPDATE post SET views = '{$plus}' WHERE id = '{$post_id}'");
			
			
			}
              
			
		
		?>

		<!-- Title -->
		<h3 class="display-4" style="font-size: 2.5em"><?php echo $row['title']; ?></h3>
		<!-- Author -->
		<span class="text-muted text-capitalize border-right pr-2"><?php echo $row['username']; ?></span>
		<!-- Date -->
		<a href="javascript:void(0)" onclick="location.href='Viewpost.php?cat_id=<?php echo $row["category"] ?>'" class="text-muted border-right pr-2 text-capitalize pl-2">
			<?php
			$s_sql = mysqli_query($connect, "SELECT * FROM category WHERE id ='{$row["category"]}' ");
			while ($sub = mysqli_fetch_array($s_sql)) {
				
			 echo $sub['category']; 
			}
			?>
		</a>
		<!-- Subcategory -->
		<a href="javascript:void(0)" class="text-muted border-right pr-2 pl-2 text-capitalize pl-2" onclick="location.href='Viewpost.php?cat_id=<?php echo $row["category"] ?>&&sub_category=<?php echo $row["sub_category"] ?>'">
			<?php
			$s_sql = mysqli_query($connect, "SELECT * FROM subcategory WHERE id ='{$row["sub_category"]}' ");
			while ($sub = mysqli_fetch_array($s_sql)) {
				
			 echo $sub['subcategory']; 
			}
			?>
		</a>
		<!-- Date -->
		<span class="text-muted pl-2 pr-2 text-capitalize border-right"><?php echo $row['date']; ?></span>
		<!-- Views -->
		<span class="text-muted pl-2 "><?php echo $row['views']; ?> view(s)</span>
				

		<p class="">
		<?php  
		if (!empty($row['image'])) {
			// echo "<img src='upload/$row["image"]'>";
		?> 
		<img src="upload/<?php echo $row['image']; ?>" class="card-img">
			<?php } echo $row['content']; ?>
		</p>
	<?php 	 ?>
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

		<div class="">
			<h4>Related Stories</h4>
			<div class="row mx-0">
			<?php  
				$query = mysqli_query($connect, "SELECT * FROM post WHERE category = '{$row["category"]}' ORDER BY id DESC LIMIT 8");
				while ($pro = mysqli_fetch_array($query)) {
					
				
			?>
			<a href="javascript:void(0)" class="my-1 mx-0 col-md-3 row p-3 shadow" onclick="location.href='viewpost.php?post_id=<?php echo $pro["id"]; ?>&&title=<?php echo $pro["title"]; ?>'">

				<img height="200px" class="r-image" src="upload/<?php echo $pro['image']; ?>">
				<p class="pp text-justify-force p-2" style="/*max-width: 300px*/;">
					<?php $title=$pro['title'];
				echo substr($title, 0, 50);
				 // $title;
				if(strlen($title) > 50) {
					echo "...";
				}
				?></p>
				
			</a>
		<?php } ?>
			
		</div>
		</div>
	<?php }} ?>


		</div>

		<!-- Right side -->
	<?php include 'inc/rightside.php'; ?>
		
	</div>
        <?php include 'inc/footer.php'; ?>

</body>
</html>
        <?php #include 'inc/footlink.php'; ?>
