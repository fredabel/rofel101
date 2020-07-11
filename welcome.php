<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
	
    require_once "config.php";
if(isset($_POST['action'])){

	//Insert Method
	if ( $_POST['action'] == 'insert'){


	// print_r($_POST);
	$username = $_POST['name'];
	$lastname = $_POST['lastname'];

	$stmt = $mysqli->prepare("INSERT INTO users (username, lastname) VALUES (?, ? )");
	$stmt->bind_param("ss", $username, $lastname); 
	$stmt->execute();

	header('Location: /rofel_v1');
	}   

	//Update Method
	if($_POST['action'] == 'edit'){

	// print_r($_POST);
	$id = $_POST['userid'];
	$username = $_POST['username'];
	$lastname = $_POST['lastname'];

	$stmt = $mysqli->prepare(" UPDATE users SET username = ?, lastname = ? WHERE id = ?");
	$stmt->bind_param("sss", $username, $lastname, $id); 
	$stmt->execute();


	// header('Location: edit.php/?id='.$id);


	}

	if($_POST['action'] == 'getAllusers'){

		// print_r($_POST['action']);


    	$sql = "SELECT id, username, lastname FROM users";
		$result = $mysqli->query($sql);

		if($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
	    		// echo '<tr><td><a href="edit.php/?id='.$row['id'].'">'.$row["username"] .'</a></td><td>'.$row["lastname"].'</td><td><a href="welcome.php/?action=delete&id='.$row['id'].'">Delete</a></td>';

	    		echo '<tr><td>'.$row['id'].'</td><td>'.$row["username"] .'</td><td>'.$row["lastname"].'</td><td>
	    		<button type="button" class="btn btn-primary editbtn" data-userid="'.$row['id'].'" data-type="edit">Edit</button> 

	    		<button type="button" class="btn btn-danger deletebtn" data-userid="'.$row['id'].'" data-type="delete">Delete</button></td>';
	  		}
		}else{
	  		echo "0 results";
		}
		$mysqli->close();
			
	}
	if($_POST['action'] == 'delete'){

		$id = $_POST['userid'];

		$sql = "SELECT id, username, lastname FROM users WHERE id = ? ";

		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param('s',$id);
		$stmt->execute();
		$result = $stmt->get_result();
		echo '<form id="modalform" >';
		
		while($row = $result->fetch_assoc()) {
			echo '<input type="hidden" name="user_id" value="'.$row['id'].'">';
			echo 'Are you sure you want to delete '.$row['username'].'?';
		}
		echo '<hr>';
		echo '<div class="text-right"><button type="button" class="btn btn-default">Cancel</button> ';
		echo '<button type="submit" class="btn btn-danger pull-right">Yes</button></div>';
		echo '</form>';

	}
	if($_POST['action'] == 'confirmdelete'){

		$id = $_POST['userid'];
		// print_r($id);exit;
		$stmt = $mysqli->prepare(" DELETE FROM users WHERE id = ?");
		$stmt->bind_param("s", $id); 
		$stmt->execute();

		echo 'You have successfully deleted the user!';

	}


}else{

	if(isset($_REQUEST['action']) ){
		// print_r($_REQUEST);
		$id = $_REQUEST['id'];
		$stmt = $mysqli->prepare(" DELETE FROM users WHERE id = ?");
		$stmt->bind_param("s", $id); 
		$stmt->execute();

		// [$id = $_POST['username'];
			// $username = $_POST
	}

}




?>