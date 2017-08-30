<?php
    include('../controllers/config.php');
    include('../controllers/session.php');
    $conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $name = "";
    $contact = "";
    $address = "";
    $unit = "";
    $number = "1";
    $trid = "";
    $uid = "";

    if($_GET['tid'] && $_GET['uid']){
        $trid = $_GET['tid'];
        $uid = $_GET['uid'];

        $sql = "SELECT
                _tenantprofile.firstName as fName,
                _tenantprofile.lastName as lName,
                _tenantprofile.contactNumber as contact,
                _tenantprofile.address as address,
                _unit.unitName as unitName
                FROM
                _tenantrentinginformation
                INNER JOIN _tenantprofile ON _tenantrentinginformation.tid = _tenantprofile.id
                INNER JOIN _unit ON _tenantrentinginformation.uid = _unit.id WHERE _tenantrentinginformation.id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam('id', $trid);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $name = $result['fName'].' '.$result['lName'];
        $contact = $result['contact'];
        $address = $result['address'];
        $unit = $result['unitName'];

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
            <li class="menu-top-hidden">
                <div class="left-menu-item">
                    <span class="donut donut-success"></span> All Good 
                </div>
            </li>
            <li class="menu-top-hidden">
                <div class="left-menu-item">
                    <span class="donut donut-danger"></span> Sumting Wong
                </div>
            </li>
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
            <li>
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
                    <li class="left-menu-list-active">
                        <a class="left-menu-link" href="components-calendar.html">
                            Add
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
                    <span class="avatar" href="javascript:void(0);">
                        <img src="../assets/common/img/temp/avatars/1.jpg" alt="Alternative text to the image">
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="" role="menu">
                    <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon icmn-user"></i> Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon icmn-exit"></i> Logout</a>
                </ul>
            </div>
        </div>
    </div>
</nav>
    
<section class="page-content">
<div class="page-content-inner">
    <div class="panel">
    <div class="panel-heading">
        <h3>Invoices</h3>
    </div>
    <div class="panel-body">
    <div class="row">
    <form name="main" id="main" method="POST">
        <div class="text-center">
            <button type="button" class="btn btn-success-outline" name="current" onclick="setCurrent(this.)">
             Current
            </button>
            <button type="button" class="btn btn-success-outline" name="unpaid">
             Unpaid
            </button>
            <button type="button" class="btn btn-success-outline" name="paid">
             Paid
            </button>
            <button type="button" class="btn btn-success-outline" name="pending">
             Pending
            </button>
        </div>
    </form>
    </div>
    </div>
    </div>
    <section name="resultInvoice" id="resultInvoice">
        
    </section>
        

</div>
</section>
<script type="text/javascript">
    function setCurrent(selectedValue) {
    var selbox = document.resultInvoice;
    var dataString = selectedValue;
    $.ajax
        ({
            type: "POST",
            url: "../controllers/unitName.php",
            data: {floor :dataString},
            cache: false,
            success: function(result)
            {   
                $("#unitName").html(result);
            } 
        });
}
</script>
<script type="text/javascript">
    function set(selectedValue) {
    var selbox = document.mainf.unitName;
    var dataString = selectedValue;
    $.ajax
        ({
            type: "POST",
            url: "../controllers/unitName.php",
            data: {floor :dataString},
            cache: false,
            success: function(result)
            {   
                $("#unitName").html(result);
            } 
        });
}
</script>
<script type="text/javascript">
    function setOptions(selectedValue) {
    var selbox = document.mainf.unitName;
    var dataString = selectedValue;
    $.ajax
        ({
            type: "POST",
            url: "../controllers/unitName.php",
            data: {floor :dataString},
            cache: false,
            success: function(result)
            {   
                $("#unitName").html(result);
            } 
        });
}
</script>
<script type="text/javascript">
    function setOptions(selectedValue) {
    var selbox = document.mainf.unitName;
    var dataString = selectedValue;
    $.ajax
        ({
            type: "POST",
            url: "../controllers/unitName.php",
            data: {floor :dataString},
            cache: false,
            success: function(result)
            {   
                $("#unitName").html(result);
            } 
        });
}
</script>
<div class="main-backdrop"><!-- --></div>

</body>