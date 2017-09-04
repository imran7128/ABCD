<?php
//fix tenant na magiging paid muna yung nasa taas kung kasya yung payment compared sa balance
	include('config.php');
	include('session.php');
	$conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if($_POST['tid']){
        //tid id tenant id
    	$date = date('d-m-Y');
    	$sql = "INSERT INTO _payments (tid, bid, description, amount, date) VALUES (:tid, :bid, :description, :amount, :date)";
    	$stmt = $conn->prepare($sql);
    	$stmt->bindParam(':tid', $_POST['tid']);
    	$stmt->bindParam(':bid', $_SESSION['current_bill_id']);
    	$stmt->bindParam(':amount', $_POST['amount']);
    	$stmt->bindParam(':description', $_POST['description']);
    	$stmt->bindParam(':date', $date);
    	$stmt->execute();

        $sql = "SELECT COUNT(*) as count, SUM(_bill.amount) as billamount, SUM(_bill_items.amount) as itemamount FROM _bill INNER JOIN _bill_items ON _bill_items.bid = _bill.id WHERE _bill.tid = '".$_POST['tid']."' AND _bill.status = 'unpaid'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $bsum = $stmt->fetch(PDO::FETCH_ASSOC);

        $sql = "SELECT SUM(amount) as psum FROM _payments WHERE tid = '".$_POST['tid']."'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $psum = $stmt->fetch(PDO::FETCH_ASSOC);

        $d = $bsum['count'];
        $totalBill = $bsum['billamount'] + $bsum['itemamount'];

        if($d == 0){
            $sql = "UPDATE _bill SET status = 'paid' WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $_SESSION['current_bill_id']);
            $stmt->execute();
        }
        if($d > 0){
            if($psum['psum'] >= $totalBill){
                $sql = "UPDATE _bill SET status = 'paid' WHERE status = 'unpaid' AND tid = :tid";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':tid', $_POST['tid']);
                $stmt->execute();
            }
            else{
                $sql = "SELECT _bill.id as id, COUNT(*) as count, SUM(_bill.amount) as billamount, SUM(_bill_items.amount) as itemamount FROM _bill INNER JOIN _bill_items ON _bill_items.bid = _bill.id WHERE _bill.tid = '".$_POST['tid']."' AND _bill.status = 'unpaid'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                while($bb = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $current = $bb['billamount'] + $bb['itemamount'];
                    if($psum['psum'] - $current >= 0){
                        $sql = "UPDATE _bill SET status = 'paid' WHERE status = 'unpaid' AND id = :id";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id', $bb['id']);
                        $stmt->execute();
                        $psum['psum'] -= $current;
                    }
                }
            }
        }

    }
?>