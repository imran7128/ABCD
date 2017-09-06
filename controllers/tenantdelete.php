<?php
	include('config.php');
    include('session.php');
    $conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if($_POST['tid']){
    	$tenant_selected_id = $_POST['tid'];
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
                                <h4 class="modal-title" id="myModalLabel">Tenant has Unpaid Bills</h4>
                            </div>
                            <div class="modal-body">
                            	<div class="alert alert-primary" role="alert">
                            		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                		<span aria-hidden="true">&times;</span>
                            		</button>
                           			<strong>Note!</strong> Tenant has unpaid bills. Deleting tenant will also delete bill records. 
                        		</div>
                            </div>
                            <form>
                            <div class="modal-footer">
                                <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal" name="deletetenant">Delete</button>
                                <button type="button" class="btn btn-primary" name="viewbill">View Bills</button>
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
        	
        }
    }
?>