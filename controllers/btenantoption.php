<?php
	include('config.php');
	include('session.php');
	$conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(isset($_POST['uid'])){
    	$sql = "SELECT _tenantprofile.firstName as fName, _tenantprofile.lastName as lName, _tenantrentinginformation.id as tid FROM _tenantrentinginformation INNER JOIN _tenantprofile ON _tenantprofile.id = _tenantrentinginformation.tid WHERE _tenantrentinginformation.uid = :uid AND _tenantprofile.oid = :id";
     	$stmt = $conn->prepare($sql);
     	$stmt->bindParam('id', $_SESSION['id']);
     	$stmt->bindParam('uid', $_POST['uid']);
     	$stmt->execute();
     	
     	while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        	echo '<option value="'.$result['tid'].'">'.$result['fName'].' '.$result['lName'].'</option>';

     	}
    }
    
 ?>