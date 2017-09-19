<?php
	include('config.php');
    include('session.php');
  	$conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if($_POST){
        $sql = "UPDATE _unit SET unitName = :unitName, tenantAllowed = :tenantAllowed, rentPerTenant = :tenantRent WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':unitName', $_POST['unitName']);
        $stmt->bindParam(':tenantAllowed', $_POST['tenantAllowed']);
        $stmt->bindParam(':tenantRent', $_POST['rentPerTenant']);
        $stmt->bindParam(':id', $_POST['uid']);
        $stmt->execute();
    }
?>