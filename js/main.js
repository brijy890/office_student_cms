


// dashboard-2.php Ajax call
	// $(document).ready(function(){

	// 	$("li#1 a").addClass('active_link');

	// 	$.ajax({
	// 			type: "post",
	// 			url: "../admin/pagination-2.php?page=1",
	// 			dataType: "html",                 
	// 			success: function(data) {
	// 			$("#target").html(data);
	// 			}

	// 		});

	// });

	$("#pagination li").click(function(e){
			e.preventDefault();
			var pageNum = this.id;
			console.log(pageNum);

			$("li a").removeClass('active_link');

			$("li#"+pageNum+" a").addClass('active_link');


			$.ajax({
				type: "post",
				url: "../admin/pagination-2.php?page="+pageNum,
				dataType: "html",                 
				success: function(data) {

				$("#target").html(data);
				}

			});
		});

// ---------------------------------------





	function validateUsername(username){
		console.log(username);

		$.ajax({
			type: "get",
			cache: "false",
			url: "../admin/user.php?username="+username,
			dataType: "json",                 
			success: function(data) {
				console.log(data);
			if (data == 0) {
				$("#Uerror").html("Valid username");
					$("#username").blur(function(){
						$(this).val(username);
					});
			} else{
				$("#Uerror").html("This username already exists");
					$("#username").blur(function(){
						$(this).val("");
					});
			}
			}

		});

		$("#username").blur(function(){
			$("#Uerror").html(" ");
		});
		
	}

	$("#email").keyup(function(){

		var email = $(this).val();
		console.log(email);

		$.ajax({
			type: "get",
			url: "../admin/user.php?email="+email,
			dataType: "json",                 
			success: function(data) {
				console.log(data);
			if (data == 0) {
				$("#Eerror").html("Valid email");
					$("#email").blur(function(){
						$("#email").val(email);
					});
			} else{
				$("#Eerror").html("This email already exists");
					$("#email").blur(function(){
						$("#email").val("");
					});
			}
			}

		});

		$("#email").blur(function(){
			$("#Eerror").html(" ");
		});

	});


	

	function validateMobile(){
		var mobile = $("#mobile").val();
		var phoneno = /^[1-9]{1}[0-9]{9}$/;
		console.log(mobile);

		if((mobile.match(phoneno))){
			$("#Merror").html("Valid Mobile Number");
		} else{
			$("#Merror").html("Invalid Mobile Number");
		}

		$("#mobile").blur(function(){
			$("#Merror").html(" ");
		});

	}
