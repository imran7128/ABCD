<?php
//if date today is within issue date dun lang ipapakita sa tenant
	include('../../controllers/config.php');
    include('../../controllers/session.php');
    $conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $trid = $_POST['trid'];
    $uid = $_POST['uid'];
    $_POST['balancetotal'] = "";
    

    if($_POST['trid'] && $_POST['uid']){
        $sql = "SELECT
                _tenantprofile.firstName as fName,
                _tenantprofile.lastName as lName,
                _tenantprofile.contactNumber as contact,
                _tenantprofile.address as address,
                _unit.unitName as unitName
                FROM
                _tenantrentinginformation
                INNER JOIN _tenantprofile ON _tenantrentinginformation.tid = _tenantprofile.id
                INNER JOIN _unit ON _tenantrentinginformation.uid = _unit.id WHERE _tenantrentinginformation.id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam('id', $trid);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $name = $result['fName'].' '.$result['lName'];
        $contact = $result['contact'];
        $address = $result['address'];
        $unit = $result['unitName'];

    

    if(isset($_POST['current'])){
        $_SESSION['current_excess_payment'] = 0;
        $total = 0;
        $billid = "";
        $d  = "";
        $sql = "SELECT tid, id, date, amount, status FROM _bill WHERE trid ='".$trid."' AND status = 'pending' ORDER BY id ASC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        while($bro = $stmt->fetch(PDO::FETCH_ASSOC)){
            $d = explode("-", $bro['date']);
            $monthNum  = $d[1];
            $dateObj   = DateTime::createFromFormat('!m', $monthNum);
            $monthName = $dateObj->format('F'); 
            $selectedDate  = explode("-", $bro['date']);
            $selectedDate = strtotime($selectedDate[1].'/'.$selectedDate[0].'/'.$selectedDate[2]);
            $billid = $bro['id'];
            $_SESSION['current_bill_id'] = $billid;
            $d = explode('-',$bro['date']);
            $date = date_create($d[2].'-'.$d[1].'-'.$d[0]);
            date_sub($date, date_interval_create_from_date_string('7 days'));
            
        echo '<!-- Pricing Tables -->
    <div class="panel">
        <div class="panel-heading">
            <h3>Invoice for '.$monthName.'</h3>
        </div>
        <div class="panel-body">
            <div class="margin-bottom-50">
                <div class="invoice-block">
                    <div class="row">
                    <div class="col-md-6">
                        <h4>
                            Dormitory
                            <br />
                        </h4>
                    </div>
                    <div class="col-md-6 text-right">
                        <h4>'.$unit.'</h4>
                        <p>
                            <a class="font-size-20" href="javascript:void(0)">Invoice ID</a>
                            <br />
                            <span class="font-size-20">'.$name.'</span>
                        </p>
                        <address>
                            '.$address.'
                            <br />
                            <abbr title="Phone">Phone:</abbr>&nbsp;&nbsp;'.$contact.'
                            <br />
                        </address>
                        <span>Invoice Date: '.date_format($date, 'd-m-Y').'</span>
                        <br />
                        <span>Due Date: '.$bro['date'].'</span>
                        <br />
                        <br />
                    </div>
                </div>
                    <div class="table-responsive">
                        <table class="table table-hover text-right">
                            <thead>
                            <tr>
                                <th width = "20"></th>
                                <th>Description</th>
                                <th class="text-right">Amount</th>
                            </tr>
                            </thead>
                            <tbody>';
                            $allowUnpaid = "true";
                            $advpayment = 0;
                            $bal = 0;
                            $btotal = 0;
                            $sql = "SELECT id, amount, status, date, tid FROM _bill WHERE status != 'paid' AND trid = '".$trid."' ORDER BY id ASC";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            while($br = $stmt->fetch(PDO::FETCH_ASSOC)){
//fiiiiix
                            if($br['status'] == 'unpaid'){
                                $sql = "SELECT SUM(amount) as biamount FROM _bill_items WHERE bid = '".$br['id']."'";
                                $ss = $conn->prepare($sql);
                                $ss->execute();
                                $ssb = $ss->fetch(PDO::FETCH_ASSOC);
                                if($ssb['biamount'] != 0 || $ssb['biamount'] != null){
                                    $bal += $ssb['bamount'] + $br['amount'];
                                }
                                else{
                                    $bal += $br['amount'];
                                }

                                /*
                                echo '<script>alert("'.$trid.'");</script>';
                                $sumOfbill = $s['bamt'] + $bro['amount'];
                                if($sumOfbill - $s['pamt'] < 0){
                                    $advpayment = $s['pamt'] - $sumOfbill;
                                    echo '<tr>';
                                    echo '<td></td>';
                                    echo ' <td class="text-left">Advanced Payment</td>';
                                    echo '<td>Php ('.$advpayment.')</td>';
                                    echo '</tr>';
                                    $total -= $advpayment;
                                }
                                if($sumOfbill - $s['pamt'] > 0){
                                    $bal = $sumOfbill - $s['pamt'];
                                    echo '<tr>';
                                    echo '<td></td>';
                                    echo ' <td class="text-left">Balance</td>';
                                    echo '<td>Php '.$bal.' - payment ='.$s['pamt'].' - brid ='.$br['id'].' - trid = '.$trid.'</td>';
                                    echo '</tr>';
                                    $total += $bal;
                                }*/
                                
                                
                            }

                            if($br['status'] == 'pending'){

                                $sql = "SELECT SUM(_payments.amount) as pamt FROM _payments WHERE _payments.tid = '".$trid."'";
                                $sr = $conn->prepare($sql);
                                $sr->execute();
                                $s = $sr->fetch(PDO::FETCH_ASSOC);

                                if($bal > $s['pamt']){
                                    $btotal = $bal - $s['pamt'];
                                    echo '<tr>';
                                    echo '<td></td>';
                                    echo ' <td class="text-left">Previous Balance</td>';
                                    echo '<td>Php '.$btotal.'</td>';
                                    echo '</tr>';
                                    $total += $btotal;
                                }

                                if($bal < $s['pamt']){
                                    $stbamt = 0;
                                    $subt = 0;
                                    $sql  = "SELECT id, status, _bill.amount as bamt FROM  _bill WHERE trid = '".$trid."' ORDER BY id ASC";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->execute();
                                    while($st = $stmt->fetch(PDO::FETCH_ASSOC)){
                                        $stbamt = $st['bamt'];
                                        $sql = "SELECT SUM(amount) as biamount FROM _bill_items WHERE bid = '".$st['id']."'";
                                        $ss = $conn->prepare($sql);
                                        $ss->execute();
                                        $ssb = $ss->fetch(PDO::FETCH_ASSOC);
                                        if($ssb['biamount'] != 0 || $ssb['biamount'] != null){
                                            $subt += $ssb['biamount'] + $stbamt;
                                        }
                                        else{
                                            $subt += $stbamt;
                                        }
                                        if($st['status'] == 'pending'){
                                            if($s['pamt'] < $subt){
                                                //diff nalang yung balance overall
                                                $diff = $subt - $s['pamt'];
                                                $sql = "SELECT SUM(amount) as biamt FROM _bill_items WHERE bid = '".$st['id']."'";
                                                $stmt = $conn->prepare($sql);
                                                $stmt->execute();
                                                $bb = $stmt->fetch(PDO::FETCH_ASSOC);
                                                $currentTotal = $bb['biamt'] + $st['bamt'];
                                                $holder = $currentTotal - $diff;
                                                $total -= $holder;
                                                echo '<tr>';
                                                echo '<td></td>';
                                                echo ' <td class="text-left">Advanced Payment</td>';
                                                echo '<td>Php ('.$holder.')</td>';
                                                echo '</tr>';
                                                $_SESSION['current_excess_payment'] = $holder;
                                                //break;
                                            }

                                        }
                                    }
                                    /*
                                    $sql = "SELECT SUM(_bill_items.amount) as bamt FROM _bill_items  WHERE bid = '".$br['id']."'";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->execute();
                                    $r = $stmt->fetch(PDO::FETCH_ASSOC);
                                   // c
                                    if($r['bamt'] == 0 || $r['bamt']  == null){
                                        $btotal = $s['pamt'] - $br['amount'];
                                    }
                                    else{
                                        $btotal = $s['pamt'] - $r['bamt'] + $br['amount'];
                                    }
                                    echo '<tr>';
                                    echo '<td></td>';
                                    echo ' <td class="text-left">Advanced Payment</td>';
                                    echo '<td>Php '.$btotal.'</td>';
                                    echo '</tr>';
                                    $total -= $btotal;
                                    */
                                }

                                echo '<tr>';
                                echo '<td></td>';
                                echo '<td class="text-left">Monthly Rent</td>';
                                echo '<td>Php '.$br['amount'].'</td>';
                                echo '</tr>';
                                $total += $br['amount'];


                                $sql = "SELECT amount, description, id FROM _bill_items WHERE bid = '".$br['id']."'";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                                while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                                    echo '<tr>';
                                    echo '<td></td>';
                                    echo '<td class="text-left">'.$result['description'].'</td>';
                                    echo '<td>Php '.$result['amount'].'</td>';
                                    echo '</tr>';
                                    $total += $result['amount'];
                                    

                                }
                                break;
                           
                            }

                            }
  

                            echo '</tbody>
                        </table>
                    </div>
                    <div class="text-right clearfix">
                        <div class="pull-right">
                            <p class="page-invoice-amount">';
                            echo '<strong>Total: <span>Php '.$total.'</span></strong>
                            </p>
                            <br />
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="button" class="btn btn-default" onclick="javascript:window.print();">
                            <i class="icmn-printer margin-right-5"></i>
                            Print
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>';
    break;
    }
    }//end of current

    if(isset($_POST['pending'])){
        $total = 0;
        $sql ="SELECT id, amount, date FROM _bill WHERE trid = :trid AND status = 'pending' ORDER BY id ASC";
        $stmt =$conn->prepare($sql);
        $stmt->bindParam(':trid', $trid);
        $stmt->execute();
        while($br = $stmt->fetch(PDO::FETCH_ASSOC)){
            $d = explode('-',$br['date']);
            $date = date_create($d[2].'-'.$d[1].'-'.$d[0]);
            date_sub($date, date_interval_create_from_date_string('7 days'));
            echo '<!-- Pricing Tables -->
    <div class="panel">
        <div class="panel-heading">
            <h3>Invoice</h3>
        </div>
        <div class="panel-body">
            <div class="margin-bottom-50">
                <div class="invoice-block">
                    <div class="row">
                    <div class="col-md-6">
                        <h4>
                            Dormitory
                            <br />
                        </h4>
                    </div>
                    <div class="col-md-6 text-right">
                        <h4>'.$unit.'</h4>
                        <p>
                            <a class="font-size-20" href="javascript:void(0)">Invoice ID</a>
                            <br />
                            <span class="font-size-20">'.$name.'</span>
                        </p>
                        <address>
                            '.$address.'
                            <br />
                            <abbr title="Phone">Phone:</abbr>&nbsp;&nbsp;'.$contact.'
                            <br />
                        </address>
                        <span>Invoice Date: '.date_format($date, 'd-m-Y').'</span>
                        <br />
                        <span>Due Date: '.$br['date'].'</span>
                        <br />
                        <br />
                    </div>
                </div>
                    <div class="table-responsive">
                        <table class="table table-hover text-right">
                            <thead>
                            <tr>
                                <th width = "20"></th>
                                <th>Description</th>
                                <th class="text-right">Amount</th>
                            </tr>
                            </thead>
                            <tbody>';

                                echo '<tr>';
                                echo '<td></td>';
                                echo '<td class="text-left">Monthly Rent</td>';
                                echo '<td>Php '.$br['amount'].'</td>';
                                echo '</tr>';
                                $total += $br['amount'];


                                $sql = "SELECT amount, description, id FROM _bill_items WHERE bid = '".$br['id']."'";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                                while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                                    echo '<tr>';
                                    echo '<td></td>';
                                    echo '<td class="text-left">'.$result['description'].'</td>';
                                    echo '<td>Php '.$result['amount'].'</td>';
                                    echo '</tr>';
                                    $total += $result['amount'];     
                                }


                            
                           echo' </tbody>
                        </table>
                    </div>
                    <div class="text-right clearfix">
                        <div class="pull-right">
                            <p class="page-invoice-amount">
                                <strong>Total: <span>Php '.$total.'</span></strong>
                            </p>
                            <br />
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="button" class="btn btn-default" onclick="javascript:window.print();">
                            <i class="icmn-printer margin-right-5"></i>
                            Print
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>';
        }//end of while
    }//end of pending
    if(isset($_POST['paid'])){
        $total = 0;
        $sql ="SELECT id, amount, date FROM _bill WHERE trid = :trid AND status = 'paid' ORDER BY id ASC";
        $stmt =$conn->prepare($sql);
        $stmt->bindParam(':trid', $trid);
        $stmt->execute();
        while($br = $stmt->fetch(PDO::FETCH_ASSOC)){
            $d = explode('-',$br['date']);
            $date = date_create($d[2].'-'.$d[1].'-'.$d[0]);
            date_sub($date, date_interval_create_from_date_string('7 days'));
            echo '<!-- Pricing Tables -->
    <div class="panel">
        <div class="panel-heading">
            <h3>Invoice</h3>
        </div>
        <div class="panel-body">
            <div class="margin-bottom-50">
                <div class="invoice-block">
                    <div class="row">
                    <div class="col-md-6">
                        <h4>
                            Dormitory
                            <br />
                        </h4>
                    </div>
                    <div class="col-md-6 text-right">
                        <h4>'.$unit.'</h4>
                        <p>
                            <a class="font-size-20" href="javascript:void(0)">Invoice ID</a>
                            <br />
                            <span class="font-size-20">'.$name.'</span>
                        </p>
                        <address>
                            '.$address.'
                            <br />
                            <abbr title="Phone">Phone:</abbr>&nbsp;&nbsp;'.$contact.'
                            <br />
                        </address>
                        <span>Invoice Date: '.date_format($date, 'd-m-Y').'</span>
                        <br />
                        <span>Due Date: '.$br['date'].'</span>
                        <br />
                        <br />
                    </div>
                </div>
                    <div class="table-responsive">
                        <table class="table table-hover text-right">
                            <thead>
                            <tr>
                                <th width = "20"></th>
                                <th>Description</th>
                                <th class="text-right">Amount</th>
                            </tr>
                            </thead>
                            <tbody>';

                                echo '<tr>';
                                echo '<td></td>';
                                echo '<td class="text-left">Monthly Rent</td>';
                                echo '<td>Php '.$br['amount'].'</td>';
                                echo '</tr>';
                                $total += $br['amount'];


                                $sql = "SELECT amount, description, id FROM _bill_items WHERE bid = '".$br['id']."'";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                                while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                                    echo '<tr>';
                                    echo '<td></td>';
                                    echo '<td class="text-left">'.$result['description'].'</td>';
                                    echo '<td>Php '.$result['amount'].'</td>';
                                    echo '</tr>';
                                    $total += $result['amount'];     
                                }


                            
                           echo' </tbody>
                        </table>
                    </div>
                    <div class="text-right clearfix">
                        <div class="pull-right">
                            <p class="page-invoice-amount">
                                <strong>Total: <span>Php '.$total.'</span></strong>
                            </p>
                            <br />
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="button" class="btn btn-default" onclick="javascript:window.print();">
                            <i class="icmn-printer margin-right-5"></i>
                            Print
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>';
        }//end of while
    }//end of paid
    if(isset($_POST['unpaid'])){
        $total = 0;
        $sql ="SELECT id,amount, date FROM _bill WHERE trid = :trid AND status = 'unpaid' ORDER BY id ASC";
        $stmt =$conn->prepare($sql);
        $stmt->bindParam(':trid', $trid);
        $stmt->execute();
        while($br = $stmt->fetch(PDO::FETCH_ASSOC)){
            $d = explode('-',$br['date']);
            $date = date_create($d[2].'-'.$d[1].'-'.$d[0]);
            date_sub($date, date_interval_create_from_date_string('7 days'));
            echo '<!-- Pricing Tables -->
    <div class="panel">
        <div class="panel-heading">
            <h3>Invoice</h3>
        </div>
        <div class="panel-body">
            <div class="margin-bottom-50">
                <div class="invoice-block">
                    <div class="row">
                    <div class="col-md-6">
                        <h4>
                            Dormitory
                            <br />
                        </h4>
                    </div>
                    <div class="col-md-6 text-right">
                        <h4>'.$unit.'</h4>
                        <p>
                            <a class="font-size-20" href="javascript:void(0)">Invoice ID</a>
                            <br />
                            <span class="font-size-20">'.$name.'</span>
                        </p>
                        <address>
                            '.$address.'
                            <br />
                            <abbr title="Phone">Phone:</abbr>&nbsp;&nbsp;'.$contact.'
                            <br />
                        </address>
                        <span>Invoice Date: '.date_format($date, 'd-m-Y').'</span>
                        <br />
                        <span>Due Date: '.$br['date'].'</span>
                        <br />
                        <br />
                    </div>
                </div>
                    <div class="table-responsive">
                        <table class="table table-hover text-right">
                            <thead>
                            <tr>
                                <th width = "20"></th>
                                <th>Description</th>
                                <th class="text-right">Amount</th>
                            </tr>
                            </thead>
                            <tbody>';

                                echo '<tr>';
                                echo '<td></td>';
                                echo '<td class="text-left">Monthly Rent</td>';
                                echo '<td>Php '.$br['amount'].'</td>';
                                echo '</tr>';
                                $total += $br['amount'];


                                $sql = "SELECT amount, description, id FROM _bill_items WHERE bid = '".$br['id']."'";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                                while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                                    echo '<tr>';
                                    echo '<td></td>';
                                    echo '<td class="text-left">'.$result['description'].'</td>';
                                    echo '<td>Php '.$result['amount'].'</td>';
                                    echo '</tr>';
                                    $total += $result['amount'];     
                                }


                            
                           echo' </tbody>
                        </table>
                    </div>
                    <div class="text-right clearfix">
                        <div class="pull-right">
                            <p class="page-invoice-amount">
                                <strong>Total: <span>Php '.$total.'</span></strong>
                            </p>
                            <br />
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="button" class="btn btn-default" onclick="javascript:window.print();">
                            <i class="icmn-printer margin-right-5"></i>
                            Print
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>';
        }//end of while
    }//end of unpaid
    if(isset($_POST['all'])){
        $total = 0;
        $sql ="SELECT id,date FROM _bill WHERE trid = :trid ORDER BY id ASC";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':trid', $trid);
        $stmt->execute();
        while($br = $stmt->fetch(PDO::FETCH_ASSOC)){
            $d = explode('-',$br['date']);
            $date = date_create($d[2].'-'.$d[1].'-'.$d[0]);
            date_sub($date, date_interval_create_from_date_string('7 days'));
            echo '<!-- Pricing Tables -->
    <div class="panel">
        <div class="panel-heading">
            <h3>Invoice</h3>
        </div>
        <div class="panel-body">
            <div class="margin-bottom-50">
                <div class="invoice-block">
                    <div class="row">
                    <div class="col-md-6">
                        <h4>
                            Dormitory
                            <br />
                        </h4>
                    </div>
                    <div class="col-md-6 text-right">
                        <h4>'.$unit.'</h4>
                        <p>
                            <a class="font-size-20" href="javascript:void(0)">Invoice ID</a>
                            <br />
                            <span class="font-size-20">'.$name.'</span>
                        </p>
                        <address>
                            '.$address.'
                            <br />
                            <abbr title="Phone">Phone:</abbr>&nbsp;&nbsp;'.$contact.'
                            <br />
                        </address>
                        <span>Invoice Date: '.date_format($date, 'd-m-Y').'</span>
                        <br />
                        <span>Due Date: '.$br['date'].'</span>
                        <br />
                        <br />
                    </div>
                </div>
                    <div class="table-responsive">
                        <table class="table table-hover text-right">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Description</th>
                                <th class="text-right">Amount</th>
                                <th class="text-right">Total</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr>
                                <td class="text-center">1</td>
                                <td class="text-left">Monthly Rent</td>
                                <td>Php 75.00</td>
                                <td>Php 2,152.00</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-right clearfix">
                        <div class="pull-right">
                            <p class="page-invoice-amount">
                                <strong>Total: <span>Php</span></strong>
                            </p>
                            <br />
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">
                            <i class="icmn-checkmark margin-right-5"></i>
                            Proceed to payment
                        </button>
                        <button type="button" class="btn btn-default" onclick="javascript:window.print();">
                            <i class="icmn-printer margin-right-5"></i>
                            Print
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>';
        }//end of while
    }
 }
?>