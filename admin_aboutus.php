<?php
			include 'inc/session.php';
            $msg = "";
            if (isset($_POST['submit'])) {
                $content = mysqli_real_escape_string($connect, $_POST['content']);
                $date = date('D d M Y');
                $update = "UPDATE pages SET content = '{$content}', date = '{$date}' WHERE page_title = 'about us'";
                $u_query = mysqli_query($connect, $update);
                if ($u_query) {
                   $msg = "<div class='font-weight-bold p-2 alert alert-success'>Page successfully Updated</div>";
                }
                else{
                    $msg = "<div class='font-weight-bold p-2 alert alert-warning'>Input Error</div>";
                }
            }
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php 
        $link = mysqli_query($connect, "SELECT * FROM links WHERE id = 7");
        $links = mysqli_fetch_array($link);
        echo $links['link'];
     ?> | About Us</title>
	<?php include 'inc/link.php'; ?>
</head>
<body>
<div class="card">
<!---------------------------------- Header  ---------------------------------->


<!--------------------------------------- Body  ---------------------------------->

<!--------------------------------------- Body  ---------------------------------->

<div class="card-body pl-3 pt-0 m-0">
<div class="row">
<?php include 'inc/admin_sidebar.php'; ?>

<h4 class="font-weight-bold pl-3 pt-2 border-bottom mb-3">About Us</h4>
<div class="float-right mb-2">
  <b> Last update:</b> <?php
$sql = "SELECT * FROM pages WHERE page_title = 'about us'";
$query = mysqli_query($connect, $sql);
while ($row = mysqli_fetch_array($query)) {
echo $row['date'];
} 
?>
</div>
<div class="clearfix"></div>
<div class="col-md-9 m-auto">
<?php echo $msg; ?>
<form method="post" enctype="multipart/form-data">
<div class="form-group">
<label class="font-weight-bold">Page title</label>
<div>
<input type="text" name="title" disabled="disabled" class="form-control" value="About Us">
</div>
</div>

<div class="mt-3">
<label class="font-weight-bold">Page Details</label>
<textarea class="form-control" id="area" name="content">
    <?php
$sql = "SELECT * FROM pages WHERE page_title = 'about us'";
$query = mysqli_query($connect, $sql);
while ($row = mysqli_fetch_array($query)) {
echo $row['content'];
}
?>                        
</textarea>
</div>
<button type="submit" name="submit" class="btn btn-success w-100">Update</button>
</form>
</div>


		
</body>
</html>
<?php include 'inc/footlink.php'; ?>
