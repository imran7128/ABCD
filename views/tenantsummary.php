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
    if(isset($_POST['firstName'])){
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $contactNumber = $_POST['contactNumber'];
        $guardianName = $_POST['guardianName'];
        $guardianAddress = $_POST['guardianAddress'];
        $guardianContact = $_POST['guardianContact'];
        $id = $_POST['id'];

        $sql = "UPDATE _tenantprofile SET 
        firstName = :firstName, 
        lastName = :lastName,
        address = :address,
        email = :email,
        contactNumber = :contactNumber,
        guardianName = :guardianName,
        guardianAddress = :guardianAddress,
        guardianContact = :guardianContact
        WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam("firstName",$firstName);
        $stmt->bindParam("lastName",$lastName);
        $stmt->bindParam("address",$address);
        $stmt->bindParam("email",$email);
        $stmt->bindParam("contactNumber",$contactNumber);
        $stmt->bindParam("guardianName",$guardianName);
        $stmt->bindParam("guardianAddress",$guardianAddress);
        $stmt->bindParam("guardianContact",$guardianContact);
        $stmt->bindParam("id",$id);
        $stmt->execute();
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
            <li class="left-menu-list-submenu">
                <a class="left-menu-link" href="javascript: void(0);">
                    Billing
                </a>
                <ul class="left-menu-list list-unstyled">
                    <li>
                        <a class="left-menu-link" href="components-calendar.html">
                            Edit
                        </a>
                    </li>
                    <li>
                        <a class="left-menu-link" href="components-calendar.html">
                            Payments Summary
                        </a>
                    </li>
                    <li>
                        <a class="left-menu-link" href="components-calendar.html">
                            Current Collection
                        </a>
                    </li>                    
                </ul>
            </li>
            <li class="left-menu-list-submenu">
                <a class="left-menu-link" href="javascript: void(0);">
                    Notices
                </a>
                <ul class="left-menu-list list-unstyled">
                    <li>
                        <a class="left-menu-link" href="tables-basic-tables.html">
                            Summary
                        </a>
                    </li>
                    <li>
                        <a class="left-menu-link" href="tables-datatables.html">
                            Edit
                        </a>
                    </li>
                </ul>
            </li>
            
            <li class="left-menu-list-separator"><!-- --></li>
            <li>
                <a class="left-menu-link" href="apps-profile.html">
                    <i class="left-menu-link-icon icmn-profile"><!-- --></i>
                    Current Profile
                </a>
            </li>
            <li>
                <a class="left-menu-link" href="apps-messaging.html">
                    <i class="left-menu-link-icon icmn-bubbles5"><!-- --></i>
                    Messaging
                </a>
            </li>
            <li>
                <a class="left-menu-link" href="apps-calendar.html">
                    <i class="left-menu-link-icon icmn-calendar"><!-- --></i>
                    Calendar
                </a>
            </li>
            <li>
                <a class="left-menu-link" href="apps-calendar.html">
                    <i class="left-menu-link-icon icmn-calendar"><!-- --></i>
                    Settings
                </a>
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
                                $sql = "SELECT  _tenantprofile.firstName as fName, _tenantprofile.lastName as lName, _tenantrentinginformation.uid as uid, _tenantrentinginformation.adjustedRentPerMonth as rpm, _tenantprofile.balance as balance, _tenantprofile.id as tenantid, _tenantrentinginformation.id as trid FROM _tenantrentinginformation INNER JOIN _tenantprofile ON _tenantrentinginformation.tid = _tenantprofile.id WHERE _tenantprofile.oid = :id";
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
                                    echo '<td><button class="btn btn-danger" onclick="deleteTenant('.$row['tenantid'].');">Delete Tenant</td>';
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
    <section name="formodal" id="formodal"></section>
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
           alert(result);
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
<!-- End Page Scripts -->
</section>

<div class="main-backdrop"><!-- --></div>

</body>