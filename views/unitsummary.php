<?php
    include('../controllers/config.php');
    include('../controllers/session.php');
    include('head.php'); 
    $conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 ?>
<body class="mode-default colorful-enabled theme-red">
<nav class="left-menu" left-menu>
    <div class="logo-container">
        <a href="index.html" class="logo">
            <img src="../assets/common/img/logo.png" alt="ABCD Logo" />
            <img class="logo-inverse" src="../assets/common/img/logo-inverse.png" alt="ABCD" />
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
            <li class="left-menu-list-submenu left-menu-list-active">
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
            <li class="left-menu-list-submenu">
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
                Occupied Units
            </h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <p>Units fully Occupied</p>
                    <br />
                    <div class="margin-bottom-50">
                        <table class="table table-hover nowrap" id="tblActive" width="100%">
                            <thead>
                            <tr>
                                <th>Floor</th>
                                <th>Unit</th>
                                <th>Rent Per Tenant</th>
                                <th># of Tenants</th>
                                <th>View Tenants</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Floor</th>
                                <th>Unit</th>
                                <th>Rent Per Tenant</th>
                                <th># of Tenants</th>
                                <th>View Tenants</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <tr>
                                <?php
                                   $sql = "SELECT _unit.id as uid, _floor.floorName AS floorName, _unit.unitName AS unitName, _unit.rentPerTenant as rent, _unit.currentTenant AS current FROM _floor INNER JOIN _unit ON _unit.floor_id = _floor.id WHERE _floor.oid = :id AND _unit.tenantAllowed = _unit.currentTenant";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bindParam(':id', $_SESSION['id']);
                                    $stmt->execute();
                                    while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                                        echo '<tr>';
                                        echo '<td>'.$row['floorName'].'</td>';
                                        echo '<td>'.$row['unitName'].'</td>';
                                        echo '<td>'.$row['rent'].'</td>';
                                        echo '<td>'.$row['current'].'</td>';
                                        echo '<td><button class="btn btn-success" onclick="launchModal('.$row['uid'].');">View</td>';
                                        echo '</tr>';
                                    }
                                    
                                ?>
                            </tr>
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
                Available Units
            </h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <p>Units Available for Rent</p>
                    <br />
                    <div class="margin-bottom-50">
                        <table class="table table-hover nowrap" id="tblInactive" width="100%">
                            <thead>
                            <tr>
                                <th>Floor</th>
                                <th>Unit</th>
                                <th>Rent Per Tenant</th>
                                <th># of Tenants</th>
                                <th>Available Renter</th>
                                <th>Add Tenant</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Floor</th>
                                <th>Unit</th>
                                <th>Rent Per Tenant</th>
                                <th># of Tenants</th>
                                <th>Available Renter</th>
                                <th>Add Tenant</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php
                                    $sql = "SELECT _unit.id as uid, _floor.id as fid, _floor.floorName AS floorName, _unit.unitName AS unitName, _unit.rentPerTenant as rent, _unit.tenantAllowed - _unit.currentTenant AS rentNum, _unit.currentTenant AS current FROM _floor INNER JOIN _unit ON _unit.floor_id = _floor.id WHERE _floor.oid = :id AND _unit.currentTenant >= '0' AND _unit.tenantAllowed > _unit.currentTenant";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bindParam(':id', $_SESSION['id']);
                                    $stmt->execute();
                                    while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                                        echo '<tr>';
                                        echo '<td>'.$row['floorName'].'</td>';
                                        echo '<td>'.$row['unitName'].'</td>';
                                        echo '<td>'.$row['rent'].'</td>';
                                        echo '<td>'.$row['current'].'</td>';
                                        echo '<td>'.$row['rentNum'].'</td>';
                                        echo '<td><a class="icmn icmn-plus-circle2" href="tenantadd.php?uid='.htmlspecialchars($row['uid']).'&&fid='.htmlspecialchars($row['fid']).'"</td>';
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
        
    </section>
    <!-- End  -->

</div>

<!-- Page Scripts -->
<script type="text/javascript">
    function launchModal(selectedUnit){

        var uid = selectedUnit;
        $.ajax
    ({
        url: "../controllers/viewtenant.php",
        type:'POST',
        data:
        {
            uid: uid
        },
        success: function(result)
        {   
           $("#formodal").html(result);
           $('#tview').modal('show');
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

    });
</script>
<!-- End Page Scripts -->
</section>

<div class="main-backdrop"><!-- --></div>

</body>