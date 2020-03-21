<?php 

require_once('connection.php');

$sql = "INSERT INTO tasks (task, description, start, finish) VALUES ('{$_POST['task']}', '{$_POST['description']}', '{$_POST['start']}', '{$_POST['finish']}')";

if($conn->query($sql)){
	echo json_encode(['status' => 'success']);
	return true;
} else {
	echo json_encode(['status' => 'error', 'err_message' => $conn->error]);
	return true;
}
