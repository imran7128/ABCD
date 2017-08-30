<?php
//check for errors
    $conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT
    		_bill.date as date,
    		_bill.id as bid
			FROM
			_bill
			INNER JOIN _tenantprofile ON _bill.tid = _tenantprofile.id
			WHERE _tenantprofile.oid = :id";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':id', $_SESSION['id']);
	$stmt->execute();
	date_default_timezone_set('Asia/Singapore');
	$currentD = date('d');
	$currentM = date('m');
	$currentY = date('Y');
	$compare = "";
	$stat = "";
	//anything from here onward is pending
	//anything from before today is unpaid
	while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
		$compare = explode("-", $result['date']);
		if($currentY > $compare[2]){
			 $stat = "unpaid";
			 goto query; 
		}
		if($currentY < $compare[2]){
			$stat = "pending";
			goto query;
		}
		if($currentY == $compare[2]){
			if($currentM == $compare[1]){
				if($currentD <= $compare[0]){
					$stat = "pending";
					goto query;
				}
				if($currentD > $compare[0]){
					$stat = "unpaid";
					goto query;
				}
			}
			if($currentM > $compare[1]){
				$stat = "unpaid";
				goto query;
			}
			if($currentM < $compare[1]){
				$stat = "pending";
				goto query;
			}
		}
		

		query:
		$sql = "UPDATE _bill SET status = :status WHERE id = :id AND status != 'paid'";
			$s = $conn->prepare($sql);
			$s->bindParam(':id', $result['bid']);
			$s->bindParam(':status', $stat);
			$s->execute();
	}

?>