<?php
//fix tenant na magiging paid muna yung nasa taas kung kasya yung payment compared sa balance
	include('config.php');
	include('session.php');
	$conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if($_POST['tid']){
        $t = 0;
        $payment = $_POST['amount'];
        $sql = "SELECT trid FROM _bill WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id", $_SESSION['current_bill_id']);
        $stmt->execute();
        $trid = $stmt->fetch(PDO::FETCH_ASSOC);

        $sql = "SELECT id, amount FROM _bill WHERE trid = '".$trid['trid']."' AND status != 'paid' ORDER BY id ASC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
            $sql = "SELECT SUM(amount) as bamt FROM _bill_items WHERE bid = '".$result['id']."'";
            $s = $conn->prepare($sql);
            $s->execute();
            $st = $s->fetch(PDO::FETCH_ASSOC);
            $t = $st['bamt'] + $result['amount'] - $_SESSION['current_excess_payment'];
            $_SESSION['current_excess_payment'] =0;
            echo '<script>alert("'.$payment.' - '.$t.'");</script>';
            if($payment >= $t){
                $sql1 = "UPDATE _bill SET status = 'paid' WHERE id = :id";
                $stmt1 = $conn->prepare($sql1);
                $stmt1->bindParam(':id', $result['id']);
                $stmt1->execute();
                $payment = $payment - $t;

                $date = date('d-m-Y');
                $sql2 = "INSERT INTO _payments (tid, bid, description, amount, date) VALUES (:tid, :bid, :description, :amount, :date)";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->bindParam(':tid', $_POST['tid']);
                $stmt2->bindParam(':bid', $result['id']);
                $stmt2->bindParam(':amount', $t);
                $stmt2->bindParam(':description', $_POST['description']);
                $stmt2->bindParam(':date', $date);
                $stmt2->execute();

                $sql3 = "UPDATE _bill SET status = 'paid' WHERE id = :id";
                $stmt3 = $conn->prepare($sql3);
                $stmt3->bindParam(':id', $_SESSION['current_bill_id']);
                $stmt3->execute();

            }
            else{
                $date = date('d-m-Y');
                $sql4 = "INSERT INTO _payments (tid, bid, description, amount, date) VALUES (:tid, :bid, :description, :amount, :date)";
                $stmt4 = $conn->prepare($sql4);
                $stmt4->bindParam(':tid', $_POST['tid']);
                $stmt4->bindParam(':bid', $result['id']);
                $stmt4->bindParam(':amount', $payment);
                $stmt4->bindParam(':description', $_POST['description']);
                $stmt4->bindParam(':date', $date);
                $stmt4->execute();
                break;
            }
                
        }
        $sum =0;
        $sql = "SELECT id,tid,amount FROM _bill WHERE trid = '".$trid['trid']."' AND status = 'unpaid' ORDER BY id ASC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
            $sql1 = "SELECT SUM(amount) as pamt FROM _payments WHERE tid = '".$result['tid']."'";
            $s = $conn->prepare($sql1);
            $s->execute();
            $sump = $s->fetch(PDO::FETCH_ASSOC);

            $sql = "SELECT SUM(amount) as bamt FROM _bill_items WHERE bid = '".$result['id']."'";
            $s = $conn->prepare($sql);
            $s->execute();
            $bamt = $s->fetch(PDO::FETCH_ASSOC);
            $sum = $bamt['bamt']  + $result['amount'];
            if($sump > $sum){
                $sql2 = "UPDATE _bill SET status = 'paid' WHERE id = :id";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->bindParam(':id', $result['id']);
                $stmt2->execute();
            }
            if($sump == $sum){
                $sql2 = "UPDATE _bill SET status = 'paid' WHERE id = :id";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->bindParam(':id', $result['id']);
                $stmt2->execute();
            }


        }



    }
?>