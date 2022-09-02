<?php 
		include 'inc/config.php';


		if (!empty($_GET['see'])) {
			$see = $_GET['see'];
			
			$s_sql = "SELECT * FROM privileges WHERE role_id = '{$see}'";
			$s_query = mysqli_query($connect, $s_sql);
			$s_count = mysqli_num_rows($s_query);
			
		// echo $s_count;
		
 ?>
<div class="">
<?php 
$qry = mysqli_query($connect, "SELECT * FROM roles WHERE id = '{$see}'");
while ($row = mysqli_fetch_array($qry)) {
	$name = $row['roles'];
	echo "<b>$name</b>";

}

if ($s_count == 0) {
	

		

?>

<!-- <form method="post" enctype="multipart/form-data"> -->
	<table class="table table-striped table-responsive-lg table-bordered text-center">
		<thead>
			<tr>
				<th>Attributes</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Admin</td>
				<td><input type="checkbox" name="admin" value="1"></td>
			</tr>
			<tr>
				<td>Post</td>
				<td><input type="checkbox" name="post" value="1"></td>
			</tr>
			<tr>
				<td>Approve</td>
				<td><input type="checkbox" name="approve" value="1"></td>
			</tr>
			<tr>
				<td>Edit</td>
				<td><input type="checkbox" name="edit" value="1"></td>
			</tr>
			<tr>
				<td>Delete</td>
				<td><input type="checkbox" name="delet" value="1"></td>
			</tr>
		</tbody>
	</table>
	<button type="submit" name="submit" class="btn btn-success btn-lg col-md-5 float-right">Submit</button>
	<div class="clearfix"></div>
<!-- </form> -->
<?php


}
else{
while ($search = mysqli_fetch_array($s_query)) {

 ?>

<!-- Table to Update Already Added Priviledges for Admin Users -->

<table class="table table-striped table-responsive-lg table-bordered text-center">
		<thead>
			<tr>
				<th>Attributes</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Admin</td>
				<td><input type="checkbox" name="admin" value="1" <?php if ($search['admin'] == 1) {
					echo "checked='checked'";
				} ?>></td>
			</tr>
			<tr>
				<td>Post</td>
				<td><input type="checkbox" name="post" value="1" <?php if ($search['post'] == 1) {
					echo "checked='checked'";
				} ?>></td>
			</tr>
			<tr>
				<td>Approve</td>
				<td><input type="checkbox" name="approve" value="1"  <?php if ($search['approve'] == 1) {
					echo "checked='checked'";
				} ?>></td>
			</tr>
			<tr>
				<td>Edit</td>
				<td><input type="checkbox" name="edit" value="1" <?php if ($search['edit'] == 1) {
					echo "checked='checked'";
				} ?>></td>
			</tr>
			<tr>
				<td>Delete</td>
				<td><input type="checkbox" name="delet" value="1" <?php if ($search['remove'] == 1) {
					echo "checked='checked'";
				} ?>></td>
			</tr>
		</tbody>
	</table>
	<button type="submit" name="update" class="btn btn-success btn-lg col-md-5 float-right">Update</button>
	<div class="clearfix"></div>
	


<?php 	}} ?>
</div>

<?php

	}

	?>