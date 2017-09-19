<html>
<body>
<form method="POST">
	<input type="password" name="pass" id="pass">
	<button type="submit" name="submit">MD5</button>
</form>
</body>
<?php
	if($_POST){
		$salt = "imranimranhussain";
		$password = md5($salt.$_POST['pass']);
		echo $password;
	}
?>