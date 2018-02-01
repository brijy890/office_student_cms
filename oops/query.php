
<?php include '../inc/db.php';?>

<?php

    class Query {

	 function insertQuery($table_name, $col){

		global $connection;

		$last_key 	= end(array_keys($col));
		$last_value = end(array_values($col));

		$query = "INSERT INTO {$table_name} (";
		foreach ($col as $key => $value) {
			if($last_key == $key)
			{
				$query .= "{$key}";
			} else{
				$query .= "{$key}, ";
			}	
		}
		$query .= ") ";
		$query .= "VALUES (";
		foreach ($col as $key => $value) {
			if($last_value == $value){
				$query .= " '$value'";
			} else{
				$query .= " '$value',";
			}
		}
		$query .= ");";

		$query_execute = mysqli_query($connection, $query);

		if(!$query_execute){
			die(mysqli_error($connection));
		}
	}



	function updateQuery($table_name, $pid, $col){

		global $connection;

		$last_key 	= end(array_keys($col));

		$query = "UPDATE {$table_name} SET ";
		foreach ($col as $key => $value) {
			if($last_key == $key){
				$query .= "$key = '$value' ";
			} else{
				$query .= "$key = '$value', ";
			}
		}

		$query .= "WHERE id = $pid";

		$query_execute = mysqli_query($connection, $query);

		if(!$query_execute){
			die(mysqli_error($connection));
		}
	}
}

?>