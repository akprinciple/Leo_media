<div class="col-md-2 left_side bg-leo m-0 p-0 " style="overflow-y: auto;">
	<div class="nav-link">
		<span class="fas fa-bars p-3 float-right small_screen_bar text-light"></span>
		<!-- <img src="../images/LEOPORTAL2.jpg" class="w-100 "><br> -->
		<b class="text-light">Administrator</b>

		<h5>
			<!-- <a class="text-light font-weight-bold text-center text-capitalize" href="profile.php?user=<?php #echo $_SESSION['id']; ?>"><?php #echo $row['username']; ?></a> -->
		</h5>
	</div>
	<div class="nav-link text-light border-bottom">
		<h3>DASHBOARD</h3>
	</div>
		<a  href="admin_page.php"  class="nav-link border-bottom text-light" title="Dashboard">
			<b class="fas fa-box text-light mr-3"></b>DASHBOARD
		</a>
	<div class="nav-link border-bottom text-light font-weight-bold">
	Navigation
		<b class="fas fa-caret-down text-light float-right"></b>

	</div>
	<!------------------------------Posts  ------------------------------->
	<a href="javascript:void(0)" class="nav-link border-bottom text-light posts" title="View Posts">
		<b class="fas fa-city mr-3"></b>
			Posts
		<b class="fas fa-caret-down text-light float-right"></b>
	</a>
	<div  class="post"  style="display: none;">
	<!------------------------------Add Post  ------------------------------->

		<a href="addpost.php" class="nav-link border-bottom text-light <?php if($r['roles'] == "Editor"){echo "d-none";} ?>" title="Add Posts">
			<b class="mr-3"></b>
				Add Posts
			<b class="fas fa-caret-right text-light float-right"></b>
		</a>
		<!-- if ($r['roles'] == "Editor" || $r['roles'] == "Content Creator") { -->

	<!------------------------------Add Post  ------------------------------->

		<a href="newpost.php" class="nav-link border-bottom text-light" title="Manage Posts">
			<b class="mr-3"></b>
				Manage Posts
			<b class="fas fa-caret-right text-light float-right"></b>
		</a>
	</div>
		<!------------------------------Categories  ------------------------------->
	<li class="nav-link border-bottom text-light pointer" id="category">
			<b class="fas fa-pen-nib mr-3"></b>
		Category
		<b class="fas fa-caret-down float-right"></b>
	</li>
	<div style="display: none;" class="cat">
		<a href="category.php" class="nav-link border-bottom text-light" title="Add Categories">
			
			Add Category
			<b class="fas fa-caret-right float-right"></b>
			
		</a>
		<a href="managecategory.php" class="nav-link border-bottom text-light" title="Manage Categories">
			
			Manage Categories
			<b class="fas fa-caret-right float-right"></b>
			
		</a>
		<a href="subcategory.php" class="nav-link border-bottom text-light" title="Manage SubCategories">
			
			Manage SubCategories
			<b class="fas fa-caret-right float-right"></b>
			
		</a>
	</div>

		
		<!------------------------------Members  ------------------------------->

	<a href="members.php" class="nav-link border-bottom text-light" title="View Members">
		<b class="fas fa-users mr-3"></b>
			View Members
		<b class="fas fa-caret-right text-light float-right"></b>
	</a>
		<!------------------------------Roles  ------------------------------->
		<?php if ($r['roles'] == 1) {
			# code...
		 ?>
		 <li class="nav-link border-bottom text-light pointer " id="role">
			<b class="fas fa-expand mr-3"></b>
		Roles and Privileges
		<b class="fas fa-caret-down float-right"></b>
	</li>
	<div style="display: none;" class="" id="roles">
		<a href="roles.php" class="nav-link border-bottom text-light" title="Manage Roles">
		<b class=" mr-3"></b>
			Manage Roles
		<b class="fas fa-caret-right text-light float-right"></b>
	</a>
	<a href="Privileges.php" class="nav-link border-bottom text-light" title="Manage Roles">
		<b class=" mr-3"></b>
			Manage Privileges
		<b class="fas fa-caret-right text-light float-right"></b>
	</a>
</div>
	<?php } ?>
		<!------------------------------ Comments  ------------------------------->
		
	<a href="javascript:void(0);" class="nav-link comment  border-bottom text-light" title="Add New Posts">
		<b class="fas fa-plus mr-3"></b>
			Manage Comments
		<b class="fas fa-caret-down text-light float-right"></b>
	</a>
	<ul class="comments m-0 p-0" style="display: none;">
		<a href="comments.php" class=" border-bottom text-light nav-link">
		
			Waiting for Approval
		<b class="fas fa-caret-right text-light float-right"></b>
			 </a>
			
		<a href="unapprovedcomments.php" class=" border-bottom text-light nav-link">
		
			Approved Comments
		<b class="fas fa-caret-right text-light float-right"></b>
			 </a>
		
	</ul>
		<!------------------------------ page section  ------------------------------->

	<a href="javascript:void(0)" class="nav-link border-bottom text-light page">
		<b class="fas fa-pager mr-3"></b>
		Pages
		<b class="fas fa-caret-down float-right"></b>
	</a>
	<div class="pages" style="display: none;">
		<a href="admin_contactus.php" class="nav-link border-bottom text-light">
			<b class="mr-3"></b>
			Contact Us
			<b class="fas fa-caret-right float-right"></b>
		</a>
		<a href="admin_aboutus.php" class="nav-link border-bottom text-light page">
			<b class="mr-3"></b>
			About Us
			<b class="fas fa-caret-right float-right"></b>
		</a>
		<a href="admin_privacy.php" class="nav-link border-bottom text-light page">
			<b class="mr-3"></b>
			Privacy and Policies
			<b class="fas fa-caret-right float-right"></b>
		</a>
		<a href="admin_terms.php" class="nav-link border-bottom text-light page">
			<b class="mr-3"></b>
			Terms & Conditions
			<b class="fas fa-caret-right float-right"></b>
		</a>
	</div>
		<!------------------------------ Maths section  ------------------------------->
		
	<!-- <a href="maths.php" class="nav-link border-bottom text-light" title="View Mathematics Questions">
		<b class="fas fa-ellipsis-h mr-3"></b>
			Mathematics
		<b class="fas fa-caret-right text-light float-right"></b>
	</a> -->
	<!-- <a href="visitors.php" class="nav-link border-bottom text-light" title="visitors">
		<b class="fas fa-cogs mr-3"></b>
			Visitors
		<b class="fas fa-caret-right text-light float-right"></b>
	</a> -->
	<a href="logout.php" class="nav-link border-bottom text-light" title="Logout">
		<b class="fas fa-question mr-3"></b>
			Logout
		<b class="fas fa-caret-right text-light float-right"></b>
	</a>
</div>

		<!------------------------------ Content Section ------------------------------->

<div class="col-md-10 px-0 " style="background-color: ghostwhite">
	<div class="card-header pt-2 pb-2 px-0 mx-0">
		<span class="fas fa-bars big_screen_bar p-3 float-left"></span>
		<span class="fas fa-bars p-3 float-left small_screen_bar"></span>

		<!-- <img src="images/avatar5.png" class=" rounded-circle" style="width: 5%"> -->
		<div class="float-right p-2">
			<b>Logged In As:</b> &nbsp;
			<a class="text-capitalize" title="<?php echo $_SESSION['username']; ?>" href="profile.php?user=<?php echo $r['id']; ?>&&name=<?php echo $r['username']; ?>"><?php echo $_SESSION['username']; ?>
				
			</a>
			
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="p-0">


<!-- <script type="text/javascript">
	$(document).ready(function() {
		$(".small_screen_bar").click(function(){
			$(".left_side").slideToggle("slow").css("position", "absolute").css("z-index", "2").css("marginTop", "50px");
		})
		$(".big_screen_bar").click(function(){
			// $(".left_side").css("max-width", "0px");
			// $(".col-md-10").css("width", "100%");
		})
		$(".comment").click(function(){
			$(".comments").toggle("slow");
		})
		$("#category").click(function(){
			$(".cat").toggle("slow");
		})
		$(".posts").click(function(){
			$(".post").toggle("slow");
		})
		$(".page").click(function(){
			$(".pages").toggle("slow");
		})
	})
</script> -->