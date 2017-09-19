<?php
//fix tenant na magiging paid muna yung nasa taas kung kasya yung payment compared sa balance
	include('config.php');
	include('session.php');
	$conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if($_POST['tid']){
        $date = date('d-m-Y');
        $unpaid = 0;
        $totalpayment = 0;
        $currentpayment = $_POST['amount'];
        $sql = "SELECT trid, tid FROM _bill WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id", $_SESSION['current_bill_id']);
        $stmt->execute();
        $trid = $stmt->fetch(PDO::FETCH_ASSOC);
        //overall payments including yung sa ngayon
        $sql = "SELECT SUM(amount) as pamt FROM _payments WHERE tid = '".$trid['tid']."'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $pamt = $stmt->fetch(PDO::FETCH_ASSOC);
        $totalpayment = $pamt['pamt'] + $currentpayment;
        //kung may unpaid
        //overall bill sum ng unpaid kung meron
        $sql = "SELECT id, amount, status FROM _bill WHERE trid = '".$trid['trid']."' AND status = 'unpaid' ORDER BY id ASC";
        $stmt00 = $conn->prepare($sql);
        $stmt00->execute();
        while($result = $stmt00->fetch(PDO::FETCH_ASSOC)){
                $sql = "SELECT SUM(amount) as biamt FROM _bill_items WHERE bid = '".$result['id']."'";
                $bi = $conn->prepare($sql);
                $bi->execute();
                $bi_result = $bi->fetch(PDO::FETCH_ASSOC);
                if($bi_result['biamt'] != 0 || $bi_result['biamt'] != null){
                     $unpaid += $bi_result['biamt'] + $result['amount'];
                }
                else{
                    $unpaid += $result['amount'];
                 }               
        }


        //walang unpaid, nasa current tayo, yung first na pending
        //select natin yung total bill amount at icompare sa currentpayment
        //hindi tayo magseset ng unpaid, yung time ang mag seset nun, automatic
        if($unpaid == 0){
            unpaidcleared:
            $currentbilltotal = 0;
            $sql = "SELECT id, amount FROM _bill WHERE trid = '".$trid['trid']."' AND status = 'pending' ORDER BY id ASC";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $pending = $stmt->fetch(PDO::FETCH_ASSOC);
            $sql = "SELECT SUM(AMOUNT) as pendingbi FROM _bill_items WHERE bid = '".$pending['id']."'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $pendingbi = $stmt->fetch(PDO::FETCH_ASSOC);
            if($pendingbi['pendingbi'] != 0 || $pendingbi['pendingbi'] != null){
                     $currentbilltotal = $pendingbi['pendingbi'] + $pending['amount'];
            }
            else{
                    $currentbilltotal = $pending['amount'];
            }

            if($currentpayment == $currentbilltotal){
                $sql = "UPDATE _bill SET status = 'paid' WHERE id = '".$pending['id']."'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();

                $sql2 = "INSERT INTO _payments (tid, bid, description, amount, date) VALUES (:tid, :bid, :description, :amount, :date)";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->bindParam(':tid', $_POST['tid']);
                $stmt2->bindParam(':bid', $pending['id']);
                $stmt2->bindParam(':amount', $currentpayment);
                $stmt2->bindParam(':description', $_POST['description']);
                $stmt2->bindParam(':date', $date);
                $stmt2->execute();
                $currentpayment = 0;
                //break;
            }
            if($currentpayment > $currentbilltotal){
                while($currentpayment >= $currentbilltotal){
                    $sql = "UPDATE _bill SET status = 'paid' WHERE id = '".$pending['id']."'";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();

                    $sql2 = "INSERT INTO _payments (tid, bid, description, amount, date) VALUES (:tid, :bid, :description, :amount, :date)";
                    $stmt2 = $conn->prepare($sql2);
                    $stmt2->bindParam(':tid', $_POST['tid']);
                    $stmt2->bindParam(':bid', $pending['id']);
                    $stmt2->bindParam(':amount', $currentbilltotal);
                    $stmt2->bindParam(':description', $_POST['description']);
                    $stmt2->bindParam(':date', $date);
                    $stmt2->execute();

                    $currentpayment = $currentpayment - $currentbilltotal;

                    //select ulit yung current bill total ng next
                    //$bid = $pending['id'] +1;
                    $sql = "SELECT id, amount FROM _bill WHERE trid = '".$trid['trid']."' AND status = 'pending' ORDER BY id ASC";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $pending = $stmt->fetch(PDO::FETCH_ASSOC);

                    $sql = "SELECT SUM(AMOUNT) as pendingbi FROM _bill_items WHERE bid = '".$pending['id']."'";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $pendingbi = $stmt->fetch(PDO::FETCH_ASSOC);
                    if($pendingbi['pendingbi'] != 0 || $pendingbi['pendingbi'] != null){
                        $currentbilltotal = $pendingbi['pendingbi'] + $pending['amount'];
                    }
                    else{
                        $currentbilltotal = $pending['amount'];
                    }
                }               
            }
            if($currentpayment < $currentbilltotal && $currentpayment != 0){
                $sql2 = "INSERT INTO _payments (tid, bid, description, amount, date) VALUES (:tid, :bid, :description, :amount, :date)";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->bindParam(':tid', $_POST['tid']);
                $stmt2->bindParam(':bid', $pending['id']);
                $stmt2->bindParam(':amount', $currentpayment);
                $stmt2->bindParam(':description', $_POST['description']);
                $stmt2->bindParam(':date', $date);
                $stmt2->execute();
                $currentpayment = 0;
                
            } 


        }
        //ibig sabihin may unpaid
        //isettle muna yung unpaid bago gawing paid yung pending kung full nga
        //pag may tira pa sa binnayad, doon pupunta sa pending
        if($unpaid > 0){
            $unpaidbal = 0;
            $sql = "SELECT id, amount, status FROM _bill WHERE trid = '".$trid['trid']."' AND status = 'unpaid' ORDER BY id ASC";
            $stmt0 = $conn->prepare($sql);
            $stmt0->execute();
            while($result = $stmt0->fetch(PDO::FETCH_ASSOC)){
                $sql = "SELECT SUM(amount) as pamt FROM _payments WHERE bid = '".$result['id']."'";
                $st = $conn->prepare($sql);
                $st->execute();
                $pamt = $st->fetch(PDO::FETCH_ASSOC);
                //two outcomes, pag may binayad at kapag walang binayad

                $sql = "SELECT SUM(amount) as bamt FROM _bill_items WHERE bid = '".$result['id']."'";
                $bt = $conn->prepare($sql);
                $bt->execute();
                $bamt = $bt->fetch(PDO::FETCH_ASSOC);
                if($bamt['bamt'] != 0 || $bamt['bamt'] != null){
                    $currentbilltotal = $bamt['bamt'] + $result['amount'];
                }
                else{
                    $currentbilltotal = $result['amount'];
                }

                //ibig sabihin may binayad sya
                if($pamt['pamt'] != null || $pamt['pamt'] != 0){
                    $unpaidbal = $currentbilltotal - $pamt['pamt'];
                    if($currentpayment == $unpaidbal){
                        $sql2 = "INSERT INTO _payments (tid, bid, description, amount, date) VALUES (:tid, :bid, :description, :amount, :date)";
                        $stmt2 = $conn->prepare($sql2);
                        $stmt2->bindParam(':tid', $_POST['tid']);
                        $stmt2->bindParam(':bid', $result['id']);
                        $stmt2->bindParam(':amount', $currentpayment);
                        $stmt2->bindParam(':description', $_POST['description']);
                        $stmt2->bindParam(':date', $date);
                        $stmt2->execute();

                        $sql = "UPDATE _bill SET status = 'paid' WHERE id = '".$result['id']."'";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $currentpayment = 0;
                    }
                    //uulit ulit ito, kas igreater than yung binayad sa balance
                    //remember unpaid ito lahat
                    if($currentpayment < $unpaidbal && $currentpayment != 0){
                        $sql2 = "INSERT INTO _payments (tid, bid, description, amount, date) VALUES (:tid, :bid, :description, :amount, :date)";
                        $stmt2 = $conn->prepare($sql2);
                        $stmt2->bindParam(':tid', $_POST['tid']);
                        $stmt2->bindParam(':bid', $result['id']);
                        $stmt2->bindParam(':amount', $currentpayment);
                        $stmt2->bindParam(':description', $_POST['description']);
                        $stmt2->bindParam(':date', $date);
                        $stmt2->execute();
                        $currentpayment = 0;
                    }

                    if($currentpayment > $unpaidbal){
                        $sql2 = "INSERT INTO _payments (tid, bid, description, amount, date) VALUES (:tid, :bid, :description, :amount, :date)";
                        $stmt2 = $conn->prepare($sql2);
                        $stmt2->bindParam(':tid', $_POST['tid']);
                        $stmt2->bindParam(':bid', $result['id']);
                        $stmt2->bindParam(':amount', $unpaidbal);
                        $stmt2->bindParam(':description', $_POST['description']);
                        $stmt2->bindParam(':date', $date);
                        $stmt2->execute();

                        $sql = "UPDATE _bill SET status = 'paid' WHERE id = '".$result['id']."'";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $currentpayment = $currentpayment - $unpaidbal;
                        //check ulit sa start nito kung may unpaid pa
                    }
                    
                }//end ng pag may binayad
                else{//walang binayad
                    echo $currentpayment;
                    if($currentpayment == $currentbilltotal){
                        $sql2 = "INSERT INTO _payments (tid, bid, description, amount, date) VALUES (:tid, :bid, :description, :amount, :date)";
                        $stmt2 = $conn->prepare($sql2);
                        $stmt2->bindParam(':tid', $_POST['tid']);
                        $stmt2->bindParam(':bid', $result['id']);
                        $stmt2->bindParam(':amount', $currentpayment);
                        $stmt2->bindParam(':description', $_POST['description']);
                        $stmt2->bindParam(':date', $date);
                        $stmt2->execute();

                        $sql = "UPDATE _bill SET status = 'paid' WHERE id = '".$result['id']."'";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $currentpayment = 0;
                        
                    }

                    if($currentpayment < $currentbilltotal && $currentpayment != 0){
                        $sql2 = "INSERT INTO _payments (tid, bid, description, amount, date) VALUES (:tid, :bid, :description, :amount, :date)";
                        $stmt2 = $conn->prepare($sql2);
                        $stmt2->bindParam(':tid', $_POST['tid']);
                        $stmt2->bindParam(':bid', $result['id']);
                        $stmt2->bindParam(':amount', $currentpayment);
                        $stmt2->bindParam(':description', $_POST['description']);
                        $stmt2->bindParam(':date', $date);
                        $stmt2->execute();
                        $currentpayment =0;
                       
                    }

                    if($currentpayment > $currentbilltotal){
                        $sql2 = "INSERT INTO _payments (tid, bid, description, amount, date) VALUES (:tid, :bid, :description, :amount, :date)";
                        $stmt2 = $conn->prepare($sql2);
                        $stmt2->bindParam(':tid', $_POST['tid']);
                        $stmt2->bindParam(':bid', $result['id']);
                        $stmt2->bindParam(':amount', $currentbilltotal);
                        $stmt2->bindParam(':description', $_POST['description']);
                        $stmt2->bindParam(':date', $date);
                        $stmt2->execute();

                        $sql = "UPDATE _bill SET status = 'paid' WHERE id = '".$result['id']."'";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();

                        $currentpayment =  $currentpayment - $currentbilltotal;
                        //issue dapat ata mauna muna yung less bago yung greater para walang conflict
                    }

                    sleep(0.5);
                }

            }//end ng while sa unpaid nakatago padin yung current payment

            //kapag ubos na yung unpaid, pending nalang lahat
            if($currentpayment > 0){
                /*
                $btotal = 0;
                $sql = "SELECT id, status, amount FROM _bill WHERE trid = '".$trid['trid']."' ORDER BY id ASC";
                $stmt = $conn->prepare($sql);
                $stmt->fetch(PDO::FETCH_ASSOC);
                while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $sql = "SELECT SUM(amount) as bamt FROM _bill_items WHERE bid = '".$result['id']."'";
                    $s = $conn->prepare($sql);
                    $s->execute();
                    $sresult = $s->fetch(PDO::FETCH_ASSOC);
                    if($sresult['bamt'] != 0 || $sresult['bamt'] != null){
                        $btotal = $result['amount'] + $sresult['bamt'];
                    }
                    else{
                        $btotal = $result['amount'];
                    }

                    if($currentpayment == $btotal){
                        $sql2 = "INSERT INTO _payments (tid, bid, description, amount, date) VALUES (:tid, :bid, :description, :amount, :date)";
                        $stmt2 = $conn->prepare($sql2);
                        $stmt2->bindParam(':tid', $_POST['tid']);
                        $stmt2->bindParam(':bid', $result['id']);
                        $stmt2->bindParam(':amount', $currentbilltotal);
                        $stmt2->bindParam(':description', $_POST['description']);
                        $stmt2->bindParam(':date', $date);
                        $stmt2->execute();

                        $sql = "UPDATE _bill SET status = 'paid' WHERE id = '".$result['id']."'";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $currentpayment = 0;
                        break;
                    }
                    if($currentpayment > $btotal){

                    }
                    */
                    goto unpaidcleared;

                }
            }
            //final check para sa final payments
            $amt = 0;
            $sql = "SELECT id, amount FROM _bill WHERE trid = '".$trid['trid']."' AND status = 'pending' ORDER BY id ASC";
            $stm = $conn->prepare($sql);
            $stm->execute();
            while($res = $stm->fetch(PDO::FETCH_ASSOC)){
                echo $res['id'];
                $sql = "SELECT SUM(amount) as bamt FROM _bill_items WHERE bid = '".$res['id']."'";
                $sb = $conn->prepare($sql);
                $sb->execute();
                $sbres = $sb->fetch(PDO::FETCH_ASSOC);
                if($sbres['bamt'] != 0 || $sbres['bamt'] != null){
                    $amt = $res['amount'] + $sbres['bamt'];
                }
                else{
                    $amt = $res['amount'];
                }
                $sql = "SELECT SUM(amount) as pamt FROM _payments WHERE bid = '".$res['id']."'";
                $sp = $conn->prepare($sql);
                $sp->execute();
                $spres = $sp->fetch(PDO::FETCH_ASSOC);

                if($spres['pamt'] == $amt){
                    $sql = "UPDATE _bill SET status = 'paid' WHERE id = '".$res['id']."'";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $spres['pamt'] = 0;
                        goto end;
                }
            }
            end:

        }
    /*
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


*/
    
?>