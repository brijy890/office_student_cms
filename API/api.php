
<?php include '../inc/header.php';?>

<?php $data = getApi();

// print_r($data);
// exit;
?>

	<div class="container">
		<form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">

		<div class="form-group">
			<input type="text"  placeholder="Convert To" name="base_to" class="form-control">
		</div>

		<div class="form-group">
			<input type="text"  placeholder="Convert From" name="base_from" class="form-control">
		</div>

		<div class="form-group">
			<input type="text"  placeholder="Enter Contry Name" name="address" class="form-control">
		</div>

		<div class="form-group">
			<input type="text"  placeholder="Enter value in INR" name="currency" class="form-control">
		</div>

		<input type="hidden" value="<?php echo $data['geo_code']['lat']; ?>" id="lat">

		<input type="hidden" value="<?php echo $data['geo_code']['lag']; ?>" id="lag">

		<input type="submit" value="submit" name="submit" class="btn btn-primary btn-block">

		</form>
		<br>

		<div class="row">

			<div class="col-md-6">
				<div id="map"></div>
			</div>

			<div class="col-md-6">
				<table class="table table-bordered">
					<th>Currency</th>
					<th>Value</th>
					<tbody>
					<tr>
					<td><?php echo $data['base_from'];?></td>
					<td><?php echo $data['currency'];?></td>
					</tr>

					<tr>
					<td><?php echo $data['base_to'];?></td>
					<td><?php echo $data['result'];?></td>
					</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>


 <script>

 		console.log('<?php echo $lat?>');

 		console.log('<?php echo $lag?>');



      function initMap() {
        var uluru = {lat: <?php echo $data['geo_code']['lat']?>, lng: <?php echo $data['geo_code']['lag']?>};
        console.log(uluru);
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAZ0mUZIprv0S3dI4OLbPhS251H7lGPwQU&callback=initMap">
    </script>

    
