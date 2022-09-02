<?php 
		include 'inc/config.php';


if (!empty($_GET['see'])) {
$see = $_GET['see'];
$s_sql = "SELECT * FROM subcategory WHERE category = '{$see}' && status = 0 ORDER BY subcategory ASC";
$s_query = mysqli_query($connect, $s_sql);
$s_count = mysqli_num_rows($s_query);
?>
 						
<?php 
 							
while ($search = mysqli_fetch_array($s_query)) {
?>
 <option id="search" value="<?php echo $search['id']; ?>" class="text-capitalize">
<?php echo $search['subcategory']; ?>
</option>
<?php 	}} ?>
					
 			
