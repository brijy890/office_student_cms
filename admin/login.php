
<?php include '../inc/header.php'; ?>
<?php adminLogin(); ?>
	
	<div class="container">
        <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-12">
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<h3 class="panel-title text-center">Admin Login</h3>
			 			</div>
			 			<div class="panel-body">
			    		<form role="form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			    			

			    			<div class="form-group">
			    				<input type="text" name="username" id="username" class="form-control input-sm" placeholder="Username" onblur="validate(this.value)"><span id="Uerror"></span>
			    			</div>


			    			<div class="form-group">
			    						<input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password" onblur="validate()"><span id="Perror"></span>
	    					</div>
			    			
			    			<input type="submit" value="Login" class="btn btn-info btn-block" name='login'>
			    		
			    		</form>
			    	</div>
	    		</div>
    		</div>
    	</div>
    </div>

    <script>
    	
    	// function validate(){

    	// 	var username = document.getElementById("username").value;
    	// 	var password = document.getElementById("password").value;

    	// 	if (username == '') {
    	// 		document.getElementById("Uerror").innerHTML = 'Invalid';
    	// 	} else if(username.length < 5){
    	// 		document.getElementById("Uerror").innerHTML = 'Invalid';
    	// 	} else{
    	// 		document.getElementById("Uerror").innerHTML = '';
    	// 	}

    	// 	if (password == '') {
    	// 		document.getElementById("Perror").innerHTML = 'Invalid';
    	// 	} else{
    	// 		document.getElementById("Perror").innerHTML = '';
    	// 	}
    	// }

		// function validateUser() {
		// 	var username = document.getElementById("username").value;
		// 	console.log(username);
		// 	if (username == '') {
		// 	document.getElementById("Uerror").innerHTML="here";
		// 	return;
		// 	}
		// 	if (window.XMLHttpRequest) {
		// 	// code for IE7+, Firefox, Chrome, Opera, Safari
		// 	xmlhttp=new XMLHttpRequest();
		// 	} else { // code for IE6, IE5
		// 	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		// 	}
		// 	xmlhttp.onreadystatechange=function() {
		// 	if (this.readyState==4 && this.status==200) {
		// 	document.getElementById("Uerror").innerHTML=this.responseText;
		// 	}
		// 	}
		// 	xmlhttp.open("GET","../admin/user.php?username="+username,true);
		// 	xmlhttp.send();
		// }

			
		

				
			// 			$.get("../admin/user.php?username="+username, function(data,status){

		 //            	alert("Data: " + data + "\nStatus: " + status);
		 //        });
			// }



	function validate(username){
		console.log(username);

		$.ajax({
		type: "get",
		url: "user.php?username="+username,
		dataType: "json",
		data: {username: username },                 
		success: function(data) { 
		//data will hold an object with your response data, no need to parse
		// console.log('Do whatever you want with ' + data.username + '.');

		if (!data.username) {
		console.log("InValid");
		} else{
		console.log("valid");
		}
		}

		});
	}

			
		

    </script>

</body>
</html>