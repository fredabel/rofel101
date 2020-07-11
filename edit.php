<?php
	
	ini_set('display_errors', 1);
	error_reporting(E_ALL);
	
    require_once "config.php";
    $id = 3;
    // print_r($id);

    $sql = "SELECT id, username, lastname FROM users WHERE id = ? ";

	$stmt = $mysqli->prepare($sql);
	$stmt->bind_param('s',$id);
	$stmt->execute();
	$result = $stmt->get_result();
	// print_r($result);

// if($result->num_rows === 0) exit('No rows');
	while($row = $result->fetch_assoc()) {
		// print_r($row);
		echo '<form action="/rofel_v1/welcome.php" method="post" >
			<input type="hidden" value="'.$row['id'].'" name="userid">
			<input type="hidden" value="edit" name="action">
			<input type="text" name="username" value="'.$row['username'].'">
			<input type="text" name="lastname" value="'.$row['lastname'].'">
			<input type="submit" value="Update User">
		</form>';  

	}

// $stmt->execute();
	// $res = $stmt->get_result();
	// $row = $res->fetch_assoc();
?>
	

	