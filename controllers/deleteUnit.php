<?php
	include('config.php');
	session_start();
	if($_SESSION['unit_delete_by_user'] != 'undefined'){
		$_SESSION['unit_delete_by_user'] == 'undefined';
		$conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	$sql = "DELETE FROM _unit WHERE id = :id";
    	$stmt = $conn->prepare($sql);
    	$stmt->bindParam(':id', $_GET['uid']);
    	$stmt->execute();
    	$_SESSION['usuccess'] = 'deleted';
    	header('location: ../views/unitedit.php');
	}
	else{
		header('location: ../views/login.php');
	}
	
?>