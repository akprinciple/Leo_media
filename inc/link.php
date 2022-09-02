<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="bootstrap-4.6/css/bootstrap.min.css">
 
 <?php  
	$sql = "SELECT * FROM profile WHERE id = 1";
	$query = mysqli_query($connect, $sql);
	while ($row = mysqli_fetch_array($query)) {
	
	
	?>	
<link rel="shortcut icon" type="image/jpg" href="images/<?php echo $row['text']; ?>">
<?php } ?>
     <link rel="stylesheet" type="text/css" href="font/css/all.min.css">
  
        
          