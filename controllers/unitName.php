<?php
	include ('config.php');
	session_start();
	if($_POST['floor']){
		$conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $_SESSION['floor_id_selected_add_tenant'] = $_POST['floor'];
        $sql = "SELECT unitName FROM _unit WHERE floor_id = :fid AND tenantAllowed != currentTenant ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':fid', $_POST['floor']);
        $stmt->execute();

        	while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                echo '<option value="'.$row['unitName'].'">'.$row['unitName'].'</option>';
        	}
	}
	
?>