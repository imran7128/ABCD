<?php
	include('config.php');
    include('session.php');
  	$conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(isset($_POST['uid'])){
    	$sql = "DELETE FROM _unit WHERE id = '".$_POST['uid']."'";
    	$stmt = $conn->prepare($sql);
    	$stmt->execute();
        $_SESSION['usuccess'] == 'deleted';

    }

    if(isset($_POST['id'])){
    	$sql = "SELECT unitName, tenantAllowed, rentPerTenant FROM _unit WHERE id = '".$_POST['id']."'";
    	$stmt = $conn->prepare($sql);
    	$stmt->execute();
    	$result = $stmt->fetch(PDO::FETCH_ASSOC);
    	$unitName = $result['unitName'];
    	$tenantAllowed = $result['tenantAllowed'];
    	$tenantRent = $result['rentPerTenant'];
        $uid = $_POST['id'];
    	echo '<div class="modal fade" id="uedit" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title" id="myModalLabel">Edit Unit</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="form-control-label" for="l0">Id</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" readonly="" class="form-control" placeholder="" id="uid" name="uid" 
                                    data-validation=[NOTEMPTY] value="'.$uid.'">
                                </div>
                                </div>
                            	<div class="form-group row">
                                <div class="col-md-3">
                                    <label class="form-control-label" for="l0">Unit Name</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Unit Name" id="unitName" name="unitName" 
                                    data-validation=[NOTEMPTY] value="'.$unitName.'">
                                </div>
                                </div>
                                <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="form-control-label" for="l0">Tenant Allowed</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Number of tenants allowed" id="tenantAllowed" name="tenantAllowed" 
                                    data-validation=[NOTEMPTY] value="'.$tenantAllowed.'"">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="form-control-label" for="l0">Rent per Tenant</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Rent per tenant" id="tenantRent" name="tenantRent" 
                                    data-validation=[NOTEMPTY] value="'.$tenantRent.'"">
                                </div>
                            </div>
                            </div>
                            <form>
                            <div class="modal-footer">
                                <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-danger" name="submit" onclick="saveedit();">Save Changes</button>

                            </div>
                            </form>
                        </div>
                    </div>
                	</div>';
    }
?>