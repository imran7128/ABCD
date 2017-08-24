<?php    
    include ('config.php');
	session_start();

	if($_POST['unit']){
		$conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT rent FROM `_units` WHERE userName = :user AND floorName = :floorname AND unitName = :unitname";
		
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user', $_SESSION['current_user']);
        $stmt->bindParam(':floorname', $_SESSION['floor']);
        $stmt->bindParam(':unitname', $_POST['unit']);

        $stmt->execute();
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            echo '<input type="text" class="form-control" value="'.$row['rent'].'" name="rentamt" readonly="" id="rentamt">';
        }
        //echo '<input type="text" class="form-control" placeholder="'.$result['rent'].'" name="rentamt" readonly="" id="rentamt">';
	}
?>