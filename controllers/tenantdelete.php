<?php
	include('config.php');
    include('session.php');
    $conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if($_POST['tid']){
    	$tenant_selected_id = $_POST['tid'];
    	$_SESSION['$tenant_selected_id'] = $_POST['tid'];
    	$sql = "SELECT amount FROM _bill WHERE tid = '".$_POST['tid']."' AND status = 'unpaid'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $unpaid = $stmt->fetch(PDO::FETCH_ASSOC);
        if($unpaid['amount'] != 0 || $unpaid['amount'] != null){
        	//may unpaid
           echo '<div class="modal fade" id="tview" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title" id="myModalLabel"><!--Tenant has Unpaid Bills--></h4>
                            </div>
                            <div class="modal-body">
                            	<div class="alert alert-primary" role="alert">
                            		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                		<span aria-hidden="true">&times;</span>
                            		</button>
                                    <strong> Are you sure?
                           			<!--<strong>Note!</strong> Tenant has unpaid bills. Deleting tenant will also delete bill records. -->
                        		</div>
                            </div>
                            <form>
                            <div class="modal-footer">
                                <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-danger" name="deletetenant" onclick="deleteT('.$_POST['tid'].');">End Renting Term</button>

                            </div>
                            </form>
                        </div>
                    </div>
                	</div>';
        }
        else{
        	//walang unpaid, check for advanced payment
        	//check latest paid status compare to current date
        	//determine amount of excess paid -> subtract yung current until yung latest paid
        	$sql = "SELECT collectionDay FROM _tenantrentinginformation WHERE tid = '".$_POST['tid']."'";
        	$stmt = $conn->prepare($sql);
        	$stmt->execute();
        	$collectionDay = $stmt->fetch(PDO::FETCH_ASSOC);
        	$date = date('d-m-Y');
        	$datecomp = explode("-", $date);
        	$currentCollectionDay = $collectionDay['collectionDay'].'-'.$datecomp[1].'-'.$datecomp[2];

        	$amount_due_until_current = 0;
        	$bill_total = 0;
        	$sql = "SELECT amount, id, date FROM _bill WHERE tid = '".$_POST['tid']."' and status = 'paid' ORDER BY id ASC";
        	$stmt = $conn->prepare($sql);
        	$stmt->execute();
        	while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        		$b = "SELECT SUM(amount) as bamt FROM _bill_items WHERE bid = '".$result['id']."'";
        		$bstmt = $conn->prepare($sql);
        		$bstmt->execute();
        		$bamt = $bstmt->fetch(PDO::FETCH_ASSOC);
        		if($bamt['bamt'] != 0 || $bamt['bamt'] != null){
        			$bill_total += $result['amount'] + $bamt['bamt'];
        		}
        		else{
        			$bill_total += $result['amount'];
        		}
        		if($result['date'] == $currentCollectionDay){
        			$amount_due_until_current = $bill_total;
        		}
        	}

        	$sql = "SELECT SUM(amount) as pamt FROM _payments WHERE tid = '".$_POST['tid']."'";
        	$stmt = $conn->prepare($sql);
        	$stmt->execute();
        	$pamt = $stmt->fetch(PDO::FETCH_ASSOC);
        	$excess = $pamt['pamt'] - $amount_due_until_current;
        	if($excess > 0){
        		echo '<div class="modal fade" id="tview" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title" id="myModalLabel"><!--Tenant has excess payment--></h4>
                            </div>
                            <div class="modal-body">
                            	<div class="alert alert-primary" role="alert">
                            		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                		<span aria-hidden="true">&times;</span>
                            		</button>
                                    <strong> Are you sure?
                           			<!--<strong>Note!</strong> Unpaid Payment is Php '.doubleval($excess).' deleting will erase this data.-->
                        		</div>
                            </div>
                            <form>
                            <div class="modal-footer">
                                <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-danger" name="deletetenant" onclick="deleteT('.$_POST['tid'].');">End Renting Term</button>
                                
                            </div>
                            </form>
                        </div>
                    </div>
                	</div>';
        	}
        	else{
        		echo '<div class="modal fade" id="tview" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title" id="myModalLabel">Confirm action</h4>
                            </div>
                            <div class="modal-body">
                            	<div class="alert alert-primary" role="alert">
                            		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                		<span aria-hidden="true">&times;</span>
                            		</button>
                           			<strong>Are you sure?
                        		</div>
                            </div>
                            <form>
                            <div class="modal-footer">
                                <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-danger" name="deletetenant" onclick="deleteT('.$_POST['tid'].');">End Renting Term</button>

                            </div>
                            </form>
                        </div>
                    </div>
                	</div>';
        	}
        	
        }
    }
?>