<?php
	include ('config.php');
	session_start();

	if($_POST['floor']){
		$conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT unitName FROM `_units` WHERE userName = :user AND floorName = :floorname";
		
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user', $_SESSION['current_user']);
        $stmt->bindParam(':floorname', $_POST['floor']);
        $_SESSION['floor'] = $_POST['floor'];

        $stmt->execute();
        //$number_of_rows = $stmt->fetchColumn();
        //if($number_of_rows != '0'){
        	while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            echo '<option value="'.$row['unitName'].'">'.$row['unitName'].'</option>';
        	}
        //}

        /*
        else{
        	echo '<option value="No unit registered">-</option>';
        }   */
	}
	
?>