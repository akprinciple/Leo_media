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
	 ?> | Terms & Conditions</title>
	<?php include 'inc/link.php'; ?>
</head>
<body>

	<!--------------------------------------- Header  ---------------------------------->

								<?php include 'inc/header.php'; ?>

		<!--------------------------------------- Body  ---------------------------------->
	</div>

</div>
</div>
				<div class="col-md-9 m-auto">
					<div class="mb-5">
					<h3 class="font-weight-bold">Terms & Conditions</h3>
					<div class="table-head font-weight-bold p-2 mb-4">
						<a href="index.php">Home</a> /<span class="text-muted"> Terms & Conditions</span>
					</div>
					<?php
						$sql = "SELECT * FROM pages WHERE page_title = 'terms'";
						$query = mysqli_query($connect, $sql);
						while ($row = mysqli_fetch_array($query)) {
							echo $row['content'];
						}
					?>
				</div>
		</div>
		<!------------------------------------- Footer  ----------------------------->
							<?php include 'inc/footer.php'; ?>
</body>
</html>