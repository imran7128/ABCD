<?php
	include ('config.php');
	include ('session.php');
	$_SESSION['allow_change_pass'] = 'imran';
						echo'<div class="form-group row">
                                <div class="col-md-3">
                                    <label class="form-control-label" for="l0">Old Password</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" placeholder="Old Password" id="l0" name="oldpass" data-validation=[NOTEMPTY]>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="form-control-label" for="l0">New Password</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" placeholder="New Password" id="l0" name="password" data-validation=[NOTEMPTY]>
                                </div>
                            </div>';
?>