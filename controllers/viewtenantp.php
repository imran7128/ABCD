<?php
if($_POST['tid']){
	include('config.php');
    include('session.php');
    $conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT id, firstName, lastName, address, email, contactNumber, guardianName, guardianAddress, guardianContact FROM _tenantprofile WHERE id = '".$_POST['tid']."'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    echo '<div class="modal fade" id="tview" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title" id="myModalLabel">Profile Information</h4>
                            </div>
                            <div class="modal-body">
                                <form name="tenant" id="tenant" method="POST">
                                	<div class="form-group row">
                                		<div class="col-md-3">
                                    		<label class="form-control-label" for="l0">ID</label>
                                		</div>
                                		<div class="col-md-9">
                                    		<input type="text" class="form-control" placeholder="id" id="id" name="id" data-validation=[NOTEMPTY] readonly="" value="'.$result['id'].'">
                                		</div>
                            		</div>

                                	<div class="form-group row">
                                		<div class="col-md-3">
                                    		<label class="form-control-label" for="l0">First Name</label>
                                		</div>
                                		<div class="col-md-9">
                                    		<input type="text" class="form-control" placeholder="First Name" id="fName" name="fName" data-validation=[NOTEMPTY] value="'.$result['firstName'].'">
                                		</div>
                            		</div>

                            		<div class="form-group row">
                                		<div class="col-md-3">
                                    		<label class="form-control-label" for="l0">Last Name</label>
                                		</div>
                                		<div class="col-md-9">
                                    		<input type="text" class="form-control" placeholder="Last Name" id="lName" name="lName" data-validation=[NOTEMPTY] value="'.$result['lastName'].'">
                                		</div>
                            		</div>

                            		<div class="form-group row">
                                		<div class="col-md-3">
                                    		<label class="form-control-label" for="l0">Address</label>
                                		</div>
                                		<div class="col-md-9">
                                    		<input type="text" class="form-control" placeholder="Address" id="address" name="address" data-validation=[NOTEMPTY] value="'.$result['address'].'">
                                		</div>
                            		</div>

                            		<div class="form-group row">
                                		<div class="col-md-3">
                                    		<label class="form-control-label" for="l0">Email</label>
                                		</div>
                                		<div class="col-md-9">
                                    		<input type="text" class="form-control" placeholder="Email" id="email" name="email" data-validation=[EMAIL] value="'.$result['email'].'">
                                		</div>
                            		</div>

                            		<div class="form-group row">
                                		<div class="col-md-3">
                                    		<label class="form-control-label" for="l0">Contact Number</label>
                                		</div>
                                		<div class="col-md-9">
                                    		<input type="text" class="form-control" placeholder="Contact Number" id="contactNumber" name="contactNumber" data-validation=[NOTEMPTY] value="'.$result['contactNumber'].'">
                                		    <small class="text-muted">Phone number input: (0999) 123-4567</small>
                                        </div>
                            		</div>

                            		<div class="form-group row">
                                		<div class="col-md-3">
                                    		<label class="form-control-label" for="l0">Guardian Name</label>
                                		</div>
                                		<div class="col-md-9">
                                    		<input type="text" class="form-control" placeholder="First Name" id="guardianName" name="guardianName" data-validation=[NOTEMPTY] value="'.$result['guardianName'].'">
                                		</div>
                            		</div>

                            		<div class="form-group row">
                                		<div class="col-md-3">
                                    		<label class="form-control-label" for="l0">Guardian Address</label>
                                		</div>
                                		<div class="col-md-9">
                                    		<input type="text" class="form-control" placeholder="First Name" id="guardianAddress" name="guardianAddress" data-validation=[NOTEMPTY] value="'.$result['guardianAddress'].'">
                                		</div>
                            		</div>

                            		<div class="form-group row">
                                		<div class="col-md-3">
                                    		<label class="form-control-label" for="l0">Guardian Contact Number</label>
                                		</div>
                                		<div class="col-md-9">
                                    		<input type="text" class="form-control" placeholder="First Name" id="guardianContact" name="guardianContact" data-validation=[NOTEMPTY] value="'.$result['guardianContact'].'">
                                		    <small class="text-muted">Phone number input: (0999) 123-4567</small>
                                        </div>
                            		</div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" onclick="updatetenant();">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>';
            }

?>
