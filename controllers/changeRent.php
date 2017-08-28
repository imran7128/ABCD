<?php    
    include ('config.php');
	session_start();

	if($_POST['unit']){
		$conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = "SELECT rentPerTenant FROM `_unit` WHERE floor_id = :id AND unitName = :unit";		
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $_SESSION['floor_id_selected_add_tenant']);
        $stmt->bindParam(':unit', $_POST['unit']);
        $stmt->execute();
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            echo '<input type="text" class="form-control" value="'.$row['rentPerTenant'].'" name="rentamt" readonly="" id="rentamt">';
        }
        //echo '<input type="text" class="form-control" placeholder="'.$result['rent'].'" name="rentamt" readonly="" id="rentamt">';
	}
?>