function time() {
	time = setTimeout('show()', 1000);
}
function display() {
				var x = document.getElementById('animation');
				x.style.display ="block";
				x.style.top = "50px";
			}
function cancel() {
				var x = document.getElementById('animation');
				x.style.display ="none";
			}
	$(document).ready(function() {
							$("#click").click(function(){
								$("#reg").slideToggle("slow");
							})
							$("#clicks").click(function(){
								$("#reg").slideToggle("slow");
							})
							$("#clicking").click(function(){
								$("#reg").slideToggle("slow");
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
							
						$("#role").click(function(){
								$("#roles").toggle("slow");
							})
    
				});

$(document).ready(function() {
	$(".fa-bars").click(function(){

$(".slider").slideToggle('slow');
})
// $("#small_screen_bar").click(function(){
// 	$(".cat").slideToggle("slow").css("display","block");
// })
})


// .css("position", "absolute").css("z-index", "2").css("marginTop", "50px")
function display_side() {
				var x = document.getElementById('left_side');
				x.style.display ="none";
				// x.style.top = "50px";
				document.getElementById('small').style.display="inline";
				document.getElementById('screen').style.display="none";

			}
function cancel_side() {
				var x = document.getElementById('left_side');
				x.style.display ="block";
				document.getElementById('screen').style.display="inline";
				document.getElementById('small').style.display="none";

			}