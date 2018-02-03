
<?php include '../inc/header.php';?>

	<div class="container">
		<form action="" method="POST">

		<div class="form-group">
			<input type="text"  placeholder="Convert To" name="base_to" id="base_to" class="form-control">
		</div>

		<div class="form-group">
			<input type="text"  placeholder="Enter value in INR" name="currency" id="currency" class="form-control">
		</div>

		<input type="hidden" value="" id="lat">

		<input type="hidden" value="" id="lag">

		<input type="submit" value="submit" name="submit" id="submit" class="btn btn-primary btn-block">

		</form>
		<br>

		<div class="row">
			<div class="col-md-12">
				<div id="data"></div>
			</div>
		</div>
	</div>

<?php include '../inc/footer.php';?>
 <script>


 	$("#submit").click(function(e){
 		e.preventDefault();

 		var base_from = $("input#base_from").val();
 		var base_to   = $("input#base_to").val();
 		var currency  = $("input#currency").val();

 		 $.ajax({
			type: "GET",
			url: "https://api.fixer.io/latest?base="+base_to,
			dataType: "json",
			success: function(data) {
				var result = (currency/data.rates.INR);
				$("#data").html(

				'<table class="table table-bordered" id="table"><th>Currency</th><th>Value</th><tbody><tr><td id="base_from">INR</td><td id="currency">'+currency+'</td></tr><tr><td id="base_to">'+base_to+'</td><td id="result">'+result+'</td></tr></tbody></table>'
				);
			}

		});

 	});

</script>


    
