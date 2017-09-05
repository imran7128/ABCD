<?php
if($_POST['uid']){
	include('config.php');
    include('session.php');
    $conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

echo 
'<div class="modal fade" id="tview" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                            </div>
 <div class="modal-body">
 	<h4>Tenants</h4>
                    <div class="margin-bottom-50">
                        <table class="table">
                            <thead class="thead-default">
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                            </tr>
                            </thead>
                            <tbody>';

	
	
	
		$sql = "SELECT
				_tenantprofile.firstName as fName,
				_tenantprofile.lastName as lName
				FROM
				_tenantprofile
				INNER JOIN _tenantrentinginformation ON _tenantrentinginformation.tid = _tenantprofile.id
				WHERE _tenantrentinginformation.uid = '".$_POST['uid']."'";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
			echo '<tr>
                  <td>'.$result['fName'].'</td>
                  <td>'.$result['lName'].'</td>
                  </tr>';
		}



                               echo '</tbody>
                        </table>
                    </div> 
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>';
            }
?>