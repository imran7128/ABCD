<?php
//edit yung bill
    include('../controllers/config.php');
    include('../controllers/session.php');
    $conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $tenant_selected_id = 0;
    if(isset($_POST['did'])){
        header("location: bill.php");
    }
    
    include('head.php'); 
 ?>
<body class="mode-default colorful-enabled theme-red">
<nav class="left-menu" left-menu>
    <div class="logo-container">
        <a href="index.html" class="logo">
            <img src="../assets/common/img/logo.png" alt="Clean UI Admin Template" />
            <img class="logo-inverse" src="../assets/common/img/logo-inverse.png" alt="Clean UI Admin Template" />
        </a>
    </div>
    <div class="left-menu-inner scroll-pane">
        <ul class="left-menu-list left-menu-list-root list-unstyled">
            <li class="left-menu-list-separator "><!-- --></li>
            <li>
                <a class="left-menu-link" href="index.php">
                    <i class="left-menu-link-icon icmn-home2"><!-- --></i>
                    <span class="menu-top-hidden">Dashboard</span>
                </a>
            </li>
                <li class="left-menu-list-separator"><!-- -->
            </li>
            <li>
                <a class="left-menu-link" href="floors.php">
                    <i class="left-menu-link-icon icmn-calendar"><!-- --></i>
                    Floors
                </a>
            </li>
            <li class="left-menu-list-submenu">
                <a class="left-menu-link" href="javascript: void(0);">
                    <i class="left-menu-link-icon icmn-files-empty2"><!-- --></i>
                    Unit Information
                </a>
                <ul class="left-menu-list list-unstyled">
                    <li>
                        <a class="left-menu-link" href="unitsummary.php">
                           Unit List
                        </a>
                    </li>
                    <li>
                        <a class="left-menu-link" href="unitadd.php">
                            Add Unit
                        </a>
                    </li>
                    <li>
                        <a class="left-menu-link" href="unitedit.php">
                            Edit Unit
                        </a>
                    </li>
                </ul>
            </li>
            <li class="left-menu-list-separator"><!-- --></li>
            <li class="left-menu-list-submenu left-menu-list-active">
                <a class="left-menu-link" href="javascript: void(0);">
                    Tenant Information
                </a>
                <ul class="left-menu-list list-unstyled">
                    <li>
                        <a class="left-menu-link" href="tenantsummary.php">
                            Tenant List
                        </a>
                    </li>
                    <li>
                        <a class="left-menu-link" href="tenantadd.php">
                            Add Tenant
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="left-menu-link" href="bill.php">
                    <i class="left-menu-link-icon icmn-calendar"><!-- --></i>
                    Billing
                </a>
            </li>
            <li>
                <a class="left-menu-link" href="report.php">
                    <i class="left-menu-link-icon icmn-calendar"><!-- --></i>
                    Report
                </a>
            </li>
            <li class="left-menu-list-separator"><!-- --></li>
            <li class="left-menu-list-submenu">
                <a class="left-menu-link" href="javascript: void(0);">
                    Current Profile
                </a>
                <ul class="left-menu-list list-unstyled">
                    <li>
                        <a class="left-menu-link" href="profile.php">
                            Update Information
                        </a>
                    </li>
                    <li>
                        <a class="left-menu-link" href="profilepass.php">
                            Change Password
                        </a>
                    </li>
                </ul>
            </li>
            <li class="left-menu-list-separator"><!-- --></li>

            
        </ul>
    </div>
</nav>
<nav class="top-menu">
    <div class="menu-icon-container hidden-md-up">
        <div class="animate-menu-button left-menu-toggle">
            <div><!-- --></div>
        </div>
    </div>
    <div class="menu">
        <div class="menu-user-block">
            <div class="dropdown dropdown-avatar">
                <a href="javascript: void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    Welcome, <?php echo $_SESSION['current_user_first_name'];?>
                </a>
                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="" role="menu">
                    <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon icmn-user"></i> Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php"><i class="dropdown-icon icmn-exit"></i> Logout</a>
                </ul>
            </div>
        </div>
    </div>
</nav>
    
<section class="page-content">
<div class="page-content-inner">

    <!--  -->
    <section class="panel">
        <div class="panel-heading">
            <h3>
                Active Rents
            </h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <p>Summary of Active Rents</p>
                    <br />
                    <div class="margin-bottom-50">
                        <table class="table table-hover nowrap" id="tblActive" width="100%">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Floor</th>
                                <th>Unit</th>
                                <th>Rent</th>
                                <th>Profile</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Floor</th>
                                <th>Unit</th>
                                <th>Rent</th>
                                <th>Profile</th>
                                <th>Actions</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php
                                date_default_timezone_set('Asia/Singapore');
                                $currentMonth = date('m');
                                $currentYear = date('Y');
                                $tenantDay = "";
                                $sql = "SELECT  _tenantprofile.firstName as fName, _tenantprofile.lastName as lName, _tenantrentinginformation.uid as uid, _tenantrentinginformation.adjustedRentPerMonth as rpm, _tenantprofile.balance as balance, _tenantprofile.id as tenantid, _tenantrentinginformation.id as trid FROM _tenantrentinginformation INNER JOIN _tenantprofile ON _tenantrentinginformation.tid = _tenantprofile.id WHERE _tenantprofile.oid = :id AND _tenantrentinginformation.status = '1'";
                                $stmt = $conn->prepare($sql);
                                $stmt->bindParam('id', $_SESSION['id']);
                                $stmt->execute();
                                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                    $sql1 = "SELECT _floor.floorName as floorName, _unit.unitName as unitName FROM _unit INNER JOIN _floor ON _unit.floor_id = _floor.id WHERE _floor.oid = :id AND _unit.id = :unitid";
                                    $stmt1 = $conn->prepare($sql1);
                                    $stmt1->bindParam('id', $_SESSION['id']);
                                    $stmt1->bindParam('unitid', $row['uid']);
                                    $stmt1->execute();
                                    $result = $stmt1->fetch(PDO::FETCH_ASSOC);

                                    $sql2 = "SELECT date FROM _bill WHERE tid = :tid AND trid = :trid ORDER BY id ASC";
                                    $stmt2 = $conn->prepare($sql2);
                                    $stmt2->bindParam('tid', $row['tenantid']);
                                    $stmt2->bindParam('trid', $row['trid']);
                                    $stmt2->execute();
                                    while($r = $stmt2->fetch(PDO::FETCH_ASSOC)){
                                        $r = explode("-", $r['date']);
                                        //dd-mm-yyy
                                        $tenantDay = $r[0];
                                        $tenantMonth = $r[1];
                                        $tenantYear = $r[2];
                                        break;
                                    }
                                    
                                    $dayRequired = $tenantDay.'-'.$currentMonth.'-'.$currentYear;
                                    $sql3 = "SELECT SUM(AMOUNT) as amt, COUNT(*) as r FROM _bill WHERE tid = :tid AND trid = :trid AND date = :d";
                                    $stmt3 = $conn->prepare($sql3);
                                    $stmt3->bindParam('tid', $row['tenantid']);
                                    $stmt3->bindParam('trid', $row['trid']);
                                    $stmt3->bindParam('d', $dayRequired);
                                    $stmt3->execute();
                                    $sumrent = $stmt3->fetch(PDO::FETCH_ASSOC);
                                    if($sumrent['r'] == '0'){
                                        $sumrent['amt'] = 0;
                                    }

                                    echo '<tr>';
                                    echo '<td>'.$row['fName'].' '.$row['lName'].'</td>';
                                    echo '<td>'.$result['floorName'].'</td>';
                                    echo '<td>'.$result['unitName'].'</td>';
                                    echo '<td>'.$row['rpm'].'</td>';
                                    echo '<td><button class="btn btn-warning" onclick="launchModal('.$row['tenantid'].');">View/Edit</td>';
                                    echo '<td><button class="btn btn-danger" onclick="deleteTenant('.$row['tenantid'].');">End Term</td>';
                                   
                                    echo '</tr>';

                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="panel">
        <div class="panel-heading">
            <h3>
                Inactive Tenants
            </h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <p>Summary of Inactive Tenants. Those not currently renting.</p>
                    <br />
                    <div class="margin-bottom-50">
                        <table class="table table-hover nowrap" id="tblInactive" width="100%">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Balance</th>
                                <th>Set Active</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Balance</th>
                                <th>Set Active</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php
                                $sql = "SELECT firstName, lastName, balance, id FROM _tenantprofile WHERE id NOT IN (SELECT tid FROM _tenantrentinginformation) AND oid = :id";
                                $sql = "SELECT  _tenantprofile.firstName as firstName, _tenantprofile.lastName as lastName, _tenantprofile.balance as balance, _tenantprofile.id as id, _tenantrentinginformation.id as trid FROM _tenantrentinginformation INNER JOIN _tenantprofile ON _tenantrentinginformation.tid = _tenantprofile.id WHERE _tenantprofile.oid = :id AND _tenantrentinginformation.status = '0'";
                                $stmt =  $conn->prepare($sql);
                                $stmt->bindParam('id', $_SESSION['id']);
                                $stmt->execute();
                                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                    echo '<tr>';
                                    echo '<td>'.$row['firstName'].' '.$row['lastName'].'</td>';
                                    echo '<td>'.$row['balance'].'</td>';
                                    echo '<td><a class="icmn icmn-home6" href="tenantadd.php?tid='.htmlspecialchars($row['id']).'"</td>';
                                    echo '</tr>';
                                }

                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section name="formodal" id="formodal">
        <div class="modal fade" id="tview" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
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
                                            <input type="text" class="form-control" placeholder="id" id="l0" name="id" data-validation=[NOTEMPTY] readonly="" value="'.$result['id'].'">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label class="form-control-label" for="l0">First Name</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="First Name" id="l0" name="fName" data-validation=[NOTEMPTY] value="'.$result['firstName'].'">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label class="form-control-label" for="l0">Last Name</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="Last Name" id="l0" name="lName" data-validation=[NOTEMPTY] value="'.$result['lastName'].'">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label class="form-control-label" for="l0">Address</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="Address" id="l0" name="address" data-validation=[NOTEMPTY] value="'.$result['address'].'">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label class="form-control-label" for="l0">Email</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="Email" id="l0" name="email" data-validation=[EMAIL] value="'.$result['email'].'">
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
                                            <input type="text" class="form-control" placeholder="First Name" id="l0" name="guardianName" data-validation=[NOTEMPTY] value="'.$result['guardianName'].'">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label class="form-control-label" for="l0">Guardian Address</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="First Name" id="l0" name="guardianAddress" data-validation=[NOTEMPTY] value="'.$result['guardianAddress'].'">
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
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>'
    </section>
    <!-- End  -->

</div>

<!-- Page Scripts -->
<script type="text/javascript">
    function launchModal(selectedTenant){
        var tid = selectedTenant;
        $.ajax
    ({
        url: "../controllers/viewtenantp.php",
        type:'POST',
        data:
        {
            tid: tid
        },
        success: function(result)
        {   
           $("#formodal").html(result);
           $('#tview').modal('show');
        }               
    });
    }
    /*
    function changeRoom(selectedTenant){
        var tid = selectedTenant;
        $.ajax
    ({
        url: "../controllers/changeroom.php",
        type:'POST',
        data:
        {
            tid: tid
        },
        success: function(result)
        {   
           $("#formodal").html(result);
           $('#tview').modal('show');
        }               
    });

    }
    */
    function updatetenant(){
        var id = $('#id').val();
        var fName = $('#fName').val();
        var lName = $('#lName').val();
        var email = $('#email').val();
        var address = $('#address').val();
        var contactNumber = $('#contactNumber').val();
        var guardianName = $('#guardianName').val();
        var guardianAddress = $('#guardianAddress').val();
        var guardianContact = $('#guardianContact').val();
        var gender = $('#gender').val();
        var civil = $('#civil').val();


        $.ajax({
            url: "../controllers/tenantupdate.php",
            type: 'POST',
            data:
            {
                id: id, fName: fName, lName: lName, email: email, address: address, contactNumber: contactNumber,
                guardianName: guardianName, guardianContact: guardianContact, guardianAddress: guardianAddress,
                gender: gender, civil: civil
            },
            success: function(){
                $('#tview').modal('hide');
                swal({
                title: "All done!",
                text: "Tenant information updated successfully",
                type: "success",
                confirmButtonClass: "btn-success",
                confirmButtonText: "Success"
                });  

            }
        });
    }

    function deleteTenant(selectedTenant){
        var tid = selectedTenant;
        $.ajax
    ({
        url: "../controllers/tenantdelete.php",
        type:'POST',
        data:
        {
            tid: tid
        },
        success: function(result)
        {   
           $("#formodal").html(result);
           $('#tview').modal('show');
        }               
    });
        
    }

    function deleteT(selectedTenant){
        var tid = selectedTenant;
        $.ajax
    ({
        url: "../controllers/deleteT.php",
        type:'POST',
        data:
        {
            tid: tid
        },
        success: function(result)
        {   
           //alert(result);
           location.reload();
        }               
    });
        
    }
</script>
<script>
    $(function(){

        $('#tblActive').DataTable({
            responsive: true
        });
        
        $('#tblInactive').DataTable({
            responsive: true
        });

        $('#tenant').validate({
            submit: {
                settings: {
                    inputContainer: '.form-group',
                    errorListClass: 'form-control-error',
                    errorClass: 'has-danger'
                }
            }
        });

    });
</script>
<script>
    $(function() {
        $('#contactNumber').mask('(0000) 000-0000', {placeholder: "(____) ___-____"});
        $('#guardianContact').mask('(0000) 000-0000', {placeholder: "(____) ___-____"});
    });
</script>
<!-- End Page Scripts -->
</section>

<div class="main-backdrop"><!-- --></div>

</body>