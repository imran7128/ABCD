<?php
	include('../controllers/config.php');
    include('../controllers/session.php');
    $conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if($_POST['tid']){

    	//check muna kung may unpaid ----- tapos check kung may advanced payment at how much
    	$sql = "SELECT firstName, lastName FROM _tenantprofile WHERE id = '".$_POST['id']."'";
    	$stmt = $conn->prepare($sql);
    	$stmt->exeute();
    	$tenant = $stmt->fetch(PDO::FETCH_ASSOC);

    	$sql = "SELECT id FROM _bill WHERE tid = '".$_POST['tid']."' AND status = 'unpaid'";
    	$stmt = $conn->prepare($sql);
    	$stmt->exeute();
    	$result = $stmt->fetch(PDO::FETCH_ASSOC);
    	if($result['id'] != null || $result['id'] != 0){
    		//may unpaid
    		$sql = "SELECT SUM(amount) as pamt FROM _payments WHERE tid = '".$_POST['tid']."'";
    		$stmt = $conn->prepare($sql);
    		$stmt->exeute();
    		$result = $stmt->fetch(PDO::FETCH_ASSOC);
    		$payment_total = $result['pamt'];

    		$sql = "SELECT collectionDay, startDate FROM _tenantrentinginformation WHERE tid = '".$_POST['tid']."'";
    		$stmt = $conn->prepare($sql);
    		$stmt->exeute();
    		$result = $stmt-.fetch(PDO::FETCH_ASSOC);
    		$collectionDay = $result['collectionDay'];
    		$startDate = $result['startDate'];
    		$startDate = explode("-", $startDate);
    		//d-m-Y
    		$currentDate = day('d-m-Y');
    		$currentDate = explode("-". $currentDate);
    		$compareDate = $collectionDay.'-'.$currentDate[1].'-'.$currentDate[2];

    		$bill_total = 0;
    		$id_of_current = 0;
    		$excess = 0;
    		$currentamt = 0;
    		$sql = "SELECT id, amount, date, status FROM _bill WHERE tid = '".$_POST['id']."'";
    		$stmt = $conn->prepare($sql);
    		$stmt->exeute();
    		while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
    			$compdate = $result['date'];
    			if(strtotime($compareDate) == strtotime($compdate)){
    				$id_of_current = $result['id'];
    					$sql1 = "SELECT SUM(amount) as biamt FROM _bill_items WHERE bid = '".$result['id']."'";
    					$stmt1 = $conn->prepare($sql1);
    					$stmt1->exeute();
    					$bi = $stmt1->fetch(PDO::FETCH_ASSOC);
    					$biamt = $bi['biamt'];
    					if($biamt != 0 || $biamt != null){
    						$currentamt += $result['amount'] + $biamt;
    					}
    					else{
    						$currentamt += $result['amount'];
    					}
    					goto end;
    			}
    			if(strtotime($compareDate) > strtotime($compdate)){
    					$sql1 = "SELECT SUM(amount) as biamt FROM _bill_items WHERE bid = '".$result['id']."'";
    					$stmt1 = $conn->prepare($sql1);
    					$stmt1->exeute();
    					$bi = $stmt1->fetch(PDO::FETCH_ASSOC);
    					$biamt = $bi['biamt'];
    					if($biamt != 0 || $biamt != null){
    						$bill_total += $result['amount'] + $biamt;
    					}
    					else{
    						$bill_total += $result['amount'];
    					}
    			}
    			end:
    				$balance = $bill_total + $currentamt - $payment_total;
    			echo '<div class="modal fade" id="tview" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title" id="myModalLabel">Change Unit</h4>
                            </div>
                            <div class="modal-body">
                                <form>
                                	<div class="form-group row">
                                		<div class="col-md-3">
                                    		<label class="form-control-label" for="l11">Name</label>
                                		</div>
                                	<div class="col-md-9">
                                    	<input type="text" class="form-control" placeholder="Readonly" readonly="" id="l11" value="'.$firstName.' '.$lastName.'">
                                	</div>
                                	<div class="form-group row">
                                		<div class="col-md-3">
                                    		<label class="form-control-label" for="l11">Total Due as of '.$compareDate.'</label>
                                		</div>
                                	<div class="col-md-9">
                                    	<input type="text" class="form-control" placeholder="Readonly" readonly="" id="l11" value="'.$bill_total.'">
                                	</div>
                                	<div class="form-group row">
                                		<div class="col-md-3">
                                    		<label class="form-control-label" for="l11">Amount Paid</label>
                                		</div>
                                	<div class="col-md-9">
                                    	<input type="text" class="form-control" placeholder="Readonly" readonly="" id="l11" value="'.$payment_total.'">
                                	</div>
                                	<div class="form-group row">
                                		<div class="col-md-3">
                                    		<label class="form-control-label" for="l11">Balance as of '.$compareDate.'</label>
                                		</div>
                                	<div class="col-md-9">
                                    	<input type="text" class="form-control" placeholder="Readonly" readonly="" id="l11" value="'.$balance.'">
                                	</div>

                                	<div class="alert alert-primary" role="alert">
                            			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                		<span aria-hidden="true">&times;</span>
                            			</button>
                            		<strong>Note!</strong> The balance will be carried over to the new unit. Including the current due.</a>
                        </div>
                            </div>
                                </form
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary">Proceed</button>
                            </div>
                        </div>
                    </div>
                	</div>';

    		}
    	}
    	else{
    		//walang unpaid, walang balance
    		//check na dito kung may advanced payment
    		//check kung anong id yung totoong recent
    		$sql = "SELECT SUM(amount) as pamt FROM _payments WHERE tid = '".$_POST['tid']."'";
    		$stmt = $conn->prepare($sql);
    		$stmt->exeute();
    		$result = $stmt->fetch(PDO::FETCH_ASSOC);
    		$payment_total = $result['pamt'];

    		$sql = "SELECT collectionDay, startDate FROM _tenantrentinginformation WHERE tid = '".$_POST['tid']."'";
    		$stmt = $conn->prepare($sql);
    		$stmt->exeute();
    		$result = $stmt-.fetch(PDO::FETCH_ASSOC);
    		$collectionDay = $result['collectionDay'];
    		$startDate = $result['startDate'];
    		$startDate = explode("-", $startDate);
    		//d-m-Y
    		$currentDate = day('d-m-Y');
    		$currentDate = explode("-". $currentDate);
    		$compareDate = $collectionDay.'-'.$currentDate[1].'-'.$currentDate[2];
    		//walang unpaid
    		$bill_total = 0;
    		$id_of_current = 0;
    		$excess = 0;
    		$currentamt = 0;
    		$sql = "SELECT id, amount, date, status FROM _bill WHERE tid = '".$_POST['id']."'";
    		$stmt = $conn->prepare($sql);
    		$stmt->exeute();
    		while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
    			$compdate = $result['date'];
    			if(strtotime($compareDate) == strtotime($compdate)){
    				$id_of_current = $result['id'];
    					$sql1 = "SELECT SUM(amount) as biamt FROM _bill_items WHERE bid = '".$result['id']."'";
    					$stmt1 = $conn->prepare($sql1);
    					$stmt1->exeute();
    					$bi = $stmt1->fetch(PDO::FETCH_ASSOC);
    					$biamt = $bi['biamt'];
    					if($biamt != 0 || $biamt != null){
    						$currentamt += $result['amount'] + $biamt;
    					}
    					else{
    						$currentamt += $result['amount'];
    					}
    			}
    			if(strtotime($compareDate) < strtotime($compdate)){
    				//kapag lumagpas
    				if($result['status'] == 'paid'){
    					$sql1 = "SELECT SUM(amount) as biamt FROM _bill_items WHERE bid = '".$result['id']."'";
    					$stmt1 = $conn->prepare($sql1);
    					$stmt1->exeute();
    					$bi = $stmt1->fetch(PDO::FETCH_ASSOC);
    					$biamt = $bi['biamt'];
    					if($biamt != 0 || $biamt != null){
    						$excess += $result['amount'] + $biamt;
    					}
    					else{
    						$excess += $result['amount'];
    					}
    				}

    			}
    			if(strtotime($compareDate) > strtotime($compdate)){
    				$sql1 = "SELECT SUM(amount) as biamt FROM _bill_items WHERE bid = '".$result['id']."'";
    				$stmt1 = $conn->prepare($sql1);
    				$stmt1->exeute();
    				$bi = $stmt1->fetch(PDO::FETCH_ASSOC);
    				$biamt = $bi['biamt'];
    				if($biamt != 0 || $biamt != null){
    					$bill_total += $result['amount'] + $biamt;
    				}
    				else{
    					$bill_total += $result['amount'];
    				}
    			}
    			
    		}//while

    		echo '<div class="modal fade" id="tview" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title" id="myModalLabel">Change Unit</h4>
                            </div>
                            <div class="modal-body">
                                <form>
                                	<div class="form-group row">
                                		<div class="col-md-3">
                                    		<label class="form-control-label" for="l11">Name</label>
                                		</div>
                                	<div class="col-md-9">
                                    	<input type="text" class="form-control" placeholder="Readonly" readonly="" id="l11" value="'.$firstName.' '.$lastName.'">
                                	</div>
                                	<div class="form-group row">
                                		<div class="col-md-3">
                                    		<label class="form-control-label" for="l11">Total Due as of '.$compareDate.'</label>
                                		</div>
                                	<div class="col-md-9">
                                    	<input type="text" class="form-control" placeholder="Readonly" readonly="" id="l11" value="'.$bill_total.'">
                                	</div>
                                	<div class="form-group row">
                                		<div class="col-md-3">
                                    		<label class="form-control-label" for="l11">Amount Paid</label>
                                		</div>
                                	<div class="col-md-9">
                                    	<input type="text" class="form-control" placeholder="Readonly" readonly="" id="l11" value="'.$payment_total.'">
                                	</div>
                                	<div class="form-group row">
                                		<div class="col-md-3">
                                    		<label class="form-control-label" for="l11">Balance as of '.$compareDate.'</label>
                                		</div>
                                	<div class="col-md-9">
                                    	<input type="text" class="form-control" placeholder="Readonly" readonly="" id="l11" value="'.$balance.'">
                                	</div>

                                	<div class="alert alert-primary" role="alert">
                            			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                		<span aria-hidden="true">&times;</span>
                            			</button>
                            		<strong>Note!</strong> The balance will be carried over to the new unit. Including the current due.</a>
                        </div>
                            </div>
                                </form
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary">Proceed</button>
                            </div>
                        </div>
                    </div>
                	</div>';
    		
    	}//else

    }//post
?>