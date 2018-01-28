<?php include_once '../inc/header.php';?>

<div class="container">

<div id="target"></div>

</div>

<?php include '../inc/footer.php';?>

<script type="text/javascript">
	

	$(document).ready(function(){

		$.ajax({
				type: "post",
				url: "../admin/pagination-3.php?page=1&q=3",
				dataType: "html",                 
				success: function(data) {
				$("#target").html(data);
				$("li#1 a").addClass('active_link');
				}

			});

	});
	


</script>
