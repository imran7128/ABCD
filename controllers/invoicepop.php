<?php
	include('../controllers/config.php');
    include('../controllers/session.php');
    $conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $trid = $_POST['trid'];
    $uid = $_POST['uid'];

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
    	$billid = "";
        $d  = "";
    	$sql = "SELECT id, date, amount FROM _bill WHERE trid ='".$trid."' AND status = 'pending' ORDER BY id ASC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        while($br =$stmt->fetch(PDO::FETCH_ASSOC)){
            $d = explode("-", $br['date']);
            $monthNum  = $d[1];
            $dateObj   = DateTime::createFromFormat('!m', $monthNum);
            $monthName = $dateObj->format('F'); 
            $selectedDate  = explode("-", $br['date']);
            $selectedDate = strtotime($selectedDate[1].'/'.$selectedDate[0].'/'.$selectedDate[2]);
        	$billid = $br['id'];
            $_SESSION['current_bill_id'] = $billid;
            $d = explode('-',$br['date']);
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
                        <address>
                            Address
                            <br />
                            Address
                            <br />
                            <abbr title="Mail">E-mail:</abbr>&nbsp;&nbsp;
                            <br />
                            <abbr title="Phone">Phone:</abbr>&nbsp;&nbsp;
                            <br />
                            <br />
                        </address>
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
                                <th width = "20"> <a class="icmn icmn-plus" onclick="showmodal();"></th>
                                <th>Description</th>
                                <th class="text-right">Amount</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr>
                                <td></td>
                                <td class="text-left">Monthly Rent</td>
                                <td>Php '.$br['amount'].'</td>
                            </tr>';
                            $sql = "SELECT amount, description, id FROM _bill_items WHERE bid = '".$br['id']."'";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                                echo '<tr>';
                                echo '<td><a class="icmn icmn-minus" onclick="deleteval('.$result['id'].')"></td>';
                                echo '<td class="text-left">'.$result['description'].'</td>';
                                echo '<td>'.$result['amount'].'</td>';
                                echo '</tr>';
                            }

                            echo '</tbody>
                        </table>
                    </div>
                    <div class="text-right clearfix">
                        <div class="pull-right">
                            <p class="page-invoice-amount">';
                                $sql = "SELECT SUM(amount) as subtotal FROM _bill_items WHERE bid = '".$br['id']."'";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                                $r =  doubleval($result['subtotal']);
                                $brtotal = doubleval($br['amount']);
                                $total = $r + $brtotal;
                            echo '<strong>Total: <span>Php '.$total.'</span></strong>
                            </p>
                            <br />
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="button" class="btn btn-primary" onclick="showmodal2();">
                            <i class="icmn-checkmark margin-right-5"></i>
                            Mark as paid
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
    break;
    	}
    }//end of current

    if(isset($_POST['pending'])){
    	$sql ="SELECT id, date FROM _bill WHERE trid = :trid AND status = 'pending' ORDER BY id ASC";
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
                        <address>
                            Address
                            <br />
                            Address
                            <br />
                            <abbr title="Mail">E-mail:</abbr>&nbsp;&nbsp;
                            <br />
                            <abbr title="Phone">Phone:</abbr>&nbsp;&nbsp;
                            <br />
                            <br />
                        </address>
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
    }//end of pending
    if(isset($_POST['paid'])){
    	$sql ="SELECT id, date FROM _bill WHERE trid = :trid AND status = 'paid' ORDER BY id ASC";
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
                        <address>
                            Address
                            <br />
                            Address
                            <br />
                            <abbr title="Mail">E-mail:</abbr>&nbsp;&nbsp;
                            <br />
                            <abbr title="Phone">Phone:</abbr>&nbsp;&nbsp;
                            <br />
                            <br />
                        </address>
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
    }//end of paid
    if(isset($_POST['unpaid'])){
    	$sql ="SELECT id,date FROM _bill WHERE trid = :trid AND status = 'unpaid' ORDER BY id ASC";
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
                        <address>
                            Address
                            <br />
                            Address
                            <br />
                            <abbr title="Mail">E-mail:</abbr>&nbsp;&nbsp;
                            <br />
                            <abbr title="Phone">Phone:</abbr>&nbsp;&nbsp;
                            <br />
                            <br />
                        </address>
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
    }//end of unpaid
    if(isset($_POST['all'])){
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
                        <address>
                            Address
                            <br />
                            Address
                            <br />
                            <abbr title="Mail">E-mail:</abbr>&nbsp;&nbsp;
                            <br />
                            <abbr title="Phone">Phone:</abbr>&nbsp;&nbsp;
                            <br />
                            <br />
                        </address>
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