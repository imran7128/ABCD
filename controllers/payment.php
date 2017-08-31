<?php
	include('config.php');
	include('session.php');
	$conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if($_POST['tid']){
    	$date = date('d-m-Y');
    	$sql = "INSERT INTO _payments (tid, bid, description, amount, date) VALUES (:tid, :bid, :description, :amount, :date)";
    	$stmt = $conn->prepare($sql);
    	$stmt->bindParam(':tid', $_POST['tid']);
    	$stmt->bindParam(':bid', $_SESSION['current_bill_id']);
    	$stmt->bindParam(':amount', $_POST['amount']);
    	$stmt->bindParam(':description', $_POST['description']);
    	$stmt->bindParam(':date', $date);
    	$stmt->execute();
    }
?>