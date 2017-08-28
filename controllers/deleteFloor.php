<?php
	include('config.php');
	session_start();
	if($_SESSION['floor_delete_by_user'] != 'undefined'){
		$conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	$sql = "DELETE FROM _floor WHERE id = :id";
    	$stmt = $conn->prepare($sql);
    	$stmt->bindParam(':id', $_GET['fid']);
    	$stmt->execute();
    	$_SESSION['usuccess'] = 'deleted';
    	header('location: ../views/floors.php');
	}
	else{
		header('location: ../views/login.php');
	}
	
?>