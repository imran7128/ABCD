<?php
	include('config.php');
	session_start();

	if(isset($_SESSION['current_user'])){
		$conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
   		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   		$sql = "SELECT floorName FROM _floors WHERE userName = :user";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user', $_SESSION['current_user']);
        $stmt->execute();
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
        	echo '<tr>';
        	echo '<td>'.$row[0].'</td'>;
        	echo '</tr>';
        }
	}   
    
?>