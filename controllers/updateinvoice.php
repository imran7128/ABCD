<?php
	include('config.php');
	include('session.php');
	$conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(isset($_POST['d']) && isset($_POST['a'])){
    	$sql = "INSERT INTO _bill_items (bid, description, amount) VALUES (:bid, :description, :amount)";
    	$stmt = $conn->prepare($sql);
    	$stmt->bindParam(':bid', $_SESSION['current_bill_id']);
    	$stmt->bindParam(':description', $_POST['d']);
    	$stmt->bindParam(':amount',$_POST['a']);
    	$stmt->execute();
    }
?>