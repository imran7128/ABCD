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
	//loser pwede pala yung datetime_diff lol ayusin mo soon
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

	//if expired na, gawa ka din kung 7 days before mag expire
	$currentDate = date('d-m-Y');
	$sql = "SELECT _tenantrentinginformation.uid as uid, _tenantprofile.firstName as fName, _tenantprofile.lastName as lName, endDate, _tenantrentinginformation.id as id FROM _tenantrentinginformation INNER JOIN _tenantprofile on _tenantrentinginformation.tid = _tenantprofile.id WHERE _tenantprofile.oid = '".$_SESSION['id']."'";
	$stmt = $conn->prepare($sql);;
	$stmt->execute();
	while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
		if(strtotime($currentDate) > strtotime($result['endDate'])){
			//expired
			$totalamount = 0;
			$totalpaid = 0;
			$totalbal = 0;
			$sql1 = "SELECT amount, id FROM _bill WHERE tid = '".$result['id']."'";
			$stmt1 = $conn->prepare($sql1);
			$stmt1->execute();
			while($b = $stmt1->fetch(PDO::FETCH_ASSOC)){
				$sql2 = "SELECT SUM(amount) as bamt FROM _bill_items WHERE bid = '".$b['id']."'";
				$stmt2 = $conn->prepare($sql2);
				$stmt2->execute();
				$bamt = $stmt2->fetch(PDO::FETCH_ASSOC);
				if($bamt['bamt'] != 0 || $bamt['bamt'] != null){
					$totalamount += $b['amount'] + $bamt['bamt'];
				}
				else{
					$totalamount += $b['amount'];
				}
			}

			$sql3 = "SELECT SUM(amount) as pamt FROM _payments WHERE tid = '".$result['id']."'";
			$stmt3 = $conn->prepare($sql3);
			$stmt3 ->execute();
			$pamt = $stmt3->fetch(PDO::FETCH_ASSOC);

			$totalbal = $totalamount - $pamt['pamt'];
			if($totalbal <0 ){
				$totalbal = 0;
			}
			$sql4 = "UPDATE _tenantprofile SET balance = '".$totalbal."' WHERE id = '".$result['id']."'";
			$stmt4 = $conn->prepare($sql4);
			$stmt4->execute();

			$q = "SELECT unitName, floor_id FROM _unit WHERE id = '".$result['uid']."'";
			$qs = $conn->prepare($q);
			$qs->execute();
			$qsresult = $qs->fetch(PDO::FETCH_ASSOC);

			$f = "SELECT floorName FROM _floor WHERE id = '".$qsresult['floor_id']."'";
			$fs = $conn->prepare($f);
			$fs->execute();
			$fsresult = $fs->fetch(PDO::FETCH_ASSOC);

			echo '<div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong>Rent ended!</strong> for '.$result['fName'].' '.$result['lName'].' | <strong>Unit</strong> '.$qsresult['unitName'].' | <strong>Floor</strong> '.$fsresult['floorName'].' | <strong> Balance = '.$totalbal.'</strong>
                  </div>';

		}
		//if today is within
		//7, 3,2,1 days, may alert
		$orig = $result['endDate'];
		$d = explode('-',$result['endDate']);
        $date = date_create($d[2].'-'.$d[1].'-'.$d[0]);
		date_sub($date, date_interval_create_from_date_string('7 days'));
		$days_before_orig = date_format($date, 'd-m-Y');
		if(strtotime($currentDate) >= strtotime($days_before_orig) && strtotime($currentDate)<=strtotime($orig)){
			//within 7 days
			$q = "SELECT unitName, floor_id FROM _unit WHERE id = '".$result['uid']."'";
			$qs = $conn->prepare($q);
			$qs->execute();
			$qsresult = $qs->fetch(PDO::FETCH_ASSOC);

			$f = "SELECT floorName FROM _floor WHERE id = '".$qsresult['floor_id']."'";
			$fs = $conn->prepare($f);
			$fs->execute();
			$fsresult = $fs->fetch(PDO::FETCH_ASSOC);
			echo '<div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong>Rent Ending!</strong> for '.$result['fName'].' '.$result['lName'].' | <strong>Unit</strong> '.$qsresult['unitName'].' | <strong>Floor</strong> '.$fsresult['floorName'].' 
                  </div>';
		}
	}

?>