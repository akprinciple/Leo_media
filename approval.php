<?php 

		include 'inc/config.php';
		if (isset($_GET['approve'])) {
			$id = (int)$_GET['approve'];

			$sql = "SELECT * FROM post WHERE id = '{$id}'";
			$query = mysqli_query($connect, $sql);
			while ($row = mysqli_fetch_array($query)) {
				$status = $row['status'];
				if ($status == 0) {
		$sel = "UPDATE post SET status = 1 WHERE id = '{$id}'";
		$res = mysqli_query($connect, $sel);
							
				}
				else{
					$sel = "UPDATE post SET status = 0 WHERE id = '{$id}'";
		$res = mysqli_query($connect, $sel);
				}		
			}
			header('location:newpost.php');
		}

		if (isset($_GET['banner'])) {
			$id = (int)$_GET['banner'];
			$update = mysqli_query($connect, "UPDATE post SET banner = 0");
			$up = mysqli_query($connect, "UPDATE post SET banner = 1 WHERE id = '{$id}'");
			header('location:newpost.php');
		}

?>