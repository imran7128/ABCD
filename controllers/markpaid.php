<?php

	include('config.php');
	include('session.php');
	$conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if($_POST['id']){
    	$sql = "UPDATE _bill SET status = 'paid' WHERE id = :id";
    	$stmt = $conn->prepare($sql);
    	$stmt->bindParam(':id', $_SESSION['current_bill_id']);
    	$stmt->execute();
    }
?>