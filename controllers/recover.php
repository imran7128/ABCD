<?php	
	include('config.php');
    include('session.php');
    $conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if($_POST){ 
    	$id = $_POST['id'];       
            $sql = "SELECT email, password FROM _tenantprofile WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if($result['password'] == 'imranimranimranhussain'){
                if($_POST['pass'] == $_POST['confirmpass']){
                    $salt = "imranimranhussain";
                    $password = md5($salt.$_POST['pass']);
                    $sql = "UPDATE _tenantprofile SET password = :password WHERE id = :id";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(":id", $id);
                    $stmt->bindParam(":password", $password);
                    $stmt->execute();
                    header("location:../views/index.php");
                }
                else{
                    //passwords do not match
                   // $_SESSION['usuccess'] = 'fail';
                	
                    header("location: ../views/recover.php?recover=".$id);
                }
            }  
            else{
                //error, user initiated
                //unauthorized
                header("location: ../views/404.php");
            } 
    }
 ?>