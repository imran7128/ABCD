<?php
ob_start();
session_start();

$uid = $_SESSION['current_user'];

	if(!isset($uid))
	{
		session_unset('current_user');
		session_destroy();
		header('location: ../views/login.php');
	}
ob_flush();
?>