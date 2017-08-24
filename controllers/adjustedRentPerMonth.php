<?php
	session_start();
	if(isset($_POST['totalR'])){
		echo '<input type="text" class="form-control" placeholder="" name="aRPMt" readonly="" id="aRPMt" value="'.$_POST['totalR'].'">';
		$_SESSION['totalR'] = $_POST['totalR'];
	}
?>