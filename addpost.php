<?php
			include 'inc/session.php';
		 $title = $content = $msg = $keywords= "";

 // if($r['roles'] == "Editor"){
 //  header("location: newpost.php");
 // }
// redirection for Users without posting privilege;
 if($p['post'] != 1){
  header("location: newpost.php");
 } 

		 if(isset($_POST['post'])) {
          $title = mysqli_real_escape_string($connect, $_POST['title']);
          $image = $_FILES['image']['name'];
          $tmp = $_FILES['image']['tmp_name'];
          
           $content = mysqli_real_escape_string($connect, $_POST['content']);
           $category = mysqli_real_escape_string($connect, $_POST['category']);
           $subcategory = mysqli_real_escape_string($connect, $_POST['subcategory']);
          $keywords = mysqli_real_escape_string($connect, $_POST['keywords']);
         $date = date('d/M/Y @ h:m:s');
              
                   
         $type = pathinfo("upload/$image", PATHINFO_EXTENSION);
              $select = "SELECT * FROM post WHERE title = '{$title}'";
              $c_query = mysqli_query($connect, $select);
              $count = mysqli_num_rows($c_query);
              if ($count > 0) {
                $msg = "<div class='alert alert-danger p-2  font-weight-bold'>Title already exist</div>";
              }else{
               if ($category == "-Select one-") {
               $msg = "<div class='alert alert-danger p-2  font-weight-bold'>Select a category</div>";
             }
               elseif ($_FILES["image"]["size"] > 300000) {
   					$msg = "<div class='alert alert-danger p-2  font-weight-bold'>Sorry, your file is too large.</div>";
    				}
            elseif ($type != "JPG" && $type != "jpg" && $type != "gif" && $type != "PNG" && $type != "png" && $type != "") {
               		$msg = "<div class='alert alert-danger p-2 font-weight-bold'>Only jpg, png and gif files are allowed</div>";
               	}else{


               					$username = $_SESSION['username'];

         $sql = "INSERT INTO post (title, image, category, sub_category, content, keywords, username, date) VALUES ('$title', '$image', '$category', $subcategory, '$content', '$keywords', '$username', '$date')";
         $query = mysqli_query($connect, $sql);
          move_uploaded_file($tmp, "upload/$image");
          
         if ($query) {
            $msg = "<div class='alert alert-success p-2  font-weight-bold'>Post has been Successfully submitted, <a href='newpost.php'>Proceed</a> to approve</div>";
         }
         else{
            $msg = "<div class='alert alert-danger p-2  font-weight-bold'>Try again</div>";
         }
         
       }
     }
     }
      
// function getUserIpAddr(){
//     if(!empty($_SERVER['HTTP_CLIENT_IP'])){
//         //ip from share internet
//         $ip = $_SERVER['HTTP_CLIENT_IP'];
//     }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
//         //ip pass from proxy
//         $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
//     }else{
//         $ip = $_SERVER['REMOTE_ADDR'];
//     }
//     return $ip;
// }

// echo 'User Real IP - '.getUserIpAddr();
		  ?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Post</title>
	<?php include 'inc/link.php'; ?>
  <script type="text/javascript">
     function find(val) {
    $.ajax({
    type: "GET",
    url: "sign_search.php",
    data: 'see='+val,
    success: function (data) {
    $('#search').html(data);
    }
    })
    }
</script>
   
</head>
<body>

		  <div class="">
    <!--------------------------------------- Header  ---------------------------------->

      <!--------------------------------------- Body  ---------------------------------->

        <div class=" p-0 m-0">
          <div class="row mx-0">
            <?php include 'inc/admin_sidebar.php'; ?>

                <h4 class="font-weight-bold border-bottom pl-3 pt-3 mb-5">Add Posts</h4>

  
								<div class="col-md-9 m-auto p-2 rounded">
									<div class="">

                    <form action="" method="post" enctype="multipart/form-data">
											<b class="echo mb-3"><?php echo $msg; ?></b>
									<div class="mt-3">
      <!--------------------------------------- Title  ---------------------------------->

                    <div class="form-group">
											<div class="font-weight-bold">Title</div>
											<div class=""><input type="text" placeholder="Title" name="title" required="required" class="form-control" value="<?php echo $title; ?>"></div>
                  </div>
<!--------------------------------------- Feature Image--------------------------------->

                    <div class="form-group">

											<div class="">Feature Image</div>
											<div><input class="form-control" type="file" accept=".jpg" name="image" placeholder="Image"></div>
                    </div>
											

      <!--------------------------------------- Category  ---------------------------------->

                     
                      <div class="form-group">
                        <div class="font-weight-bold">Category</div>
                      <div class=""><select name="category" class="form-control" onchange="find(this.value);">
                        <option selected="selected">-Select one-
                          <?php 
                              $sel = "SELECT * FROM category";
                              $ins = mysqli_query($connect, $sel);
                              while ($rw = mysqli_fetch_array($ins)) {
                                
                              
                           ?>
                            <option value="<?php echo $rw['id']; ?>"><?php echo $rw['category']; ?></option>
                            <?php } ?>
                        </option>
                      </select>
                    </div>
                    </div>

                    <!-- SubCategories -->
  <div class="form-group">
    <label for="subcategory" class="font-weight-bold">Subcategory</label>
    <select id="search" class="form-control" name="subcategory" id="subcategory">
    <option>--Select Subcategory--</option>
    </select>
  </div>
      <!--------------- Content  ----------------->

                    <div class="form-group">
											<div class="font-weight-bold">Content</div>
											<textarea name="content" class="form-control" placeholder="Content" id="area"><?php echo $content; ?></textarea>
                    </div>
                    <div class="form-group">
                      <div class="font-weight-bold">Keywords</div>
                      <input type="text" placeholder="Keywords" name="keywords" required="required" class="form-control" value="<?php echo $keywords; ?>">
                    </div>
                      
											<div class="mb-3">
                        <input type="submit" name="post" value="Add Post" class="btn btn-success">
                        <a href=""><button type="button" class="btn btn-danger">Discard Post</button></a>
											</div>
										</div>
										</form>
										</div>
									</div>
						</div>
					</div>
				</div>
			
</body>
</html>
 <!--Summernote js-->
<?php include 'inc/footlink.php'; ?>