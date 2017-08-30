<?php
    include('../controllers/config.php');
    include('../controllers/session.php');
    $conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
    <section class="panel panel-with-borders">
        <div class="panel-heading">
            <h3>Select Tenant</h3>
        </div>
        <form name="main" id="main" method="POST">
            <div class="panel-body">
                <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label>Unit Name</label>
                    <select class="select2" name="unitOption" id="unitOption" onchange="changetenant(this.value);">
                    <?php
                        $sql = "SELECT _unit.unitName as unitName, _unit.id as uid FROM _unit INNER JOIN _floor ON _unit.floor_id = _floor.id WHERE _floor.oid = :id";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id', $_SESSION['id']);
                        $stmt->execute();
                        while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                            echo '<option value="'.$result['uid'].'">'.$result['unitName'].'</option>';
                        }
                    ?>
                    </select>
                    </div>
                </div>
                </div>
                <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label>Tenant Name</label>
                        <select class="select3" name="tenantOption" id="tenantOption">                       
                        </select>
                    </div>
                </div>
                </div>
                <div class="row">
                    <div class="text-center">
                    <input type="hidden" value="all" name="all" id="all">
                        <button type="button" class="btn btn-success-outline" name="current" onclick="setCurrent();">
                        Current
                        </button>
                        <button type="button" class="btn btn-success-outline" name="unpaid" onclick="setUnpaid();">
                        Unpaid
                        </button>
                        <button type="button" class="btn btn-success-outline" name="paid" onclick="setPaid();">
                        Paid
                        </button>
                        <button type="button" class="btn btn-success-outline" name="pending" onclick="setPending();">
                        Pending
                        </button>
                        <button type="button" class="btn btn-success-outline" name="pending" onclick="setAll();">
                        All
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <section name="invoiceResult" id="invoiceResult">
        
    </section>

</div>
</section>
<script>
    $(function(){

        $('.select2').select2();
        $('.select3').select2();

    })
</script>

<script type="text/javascript">
    function changetenant(selectedValue) {
    var selbox = document.main.tenantOption;
    var dataString = selectedValue;
    $.ajax
        ({
            type: "POST",
            url: "../controllers/btenantoption.php",
            data: {uid :dataString},
            cache: false,
            success: function(result)
            {   
                $("#tenantOption").html(result);
            } 
        });
    }
</script>
<script type="text/javascript">
    function setUnpaid() {
    var selbox = document.invoiceResult;
    var tiddata = $('#tenantOption').val();
    var uiddata = $('#unitOption').val();
    var pdata = $('#all').val();

    $.ajax
        ({
            type: "POST",
            url: "../controllers/invoicepop.php",
            data: {uid :uiddata, trid :tiddata, unpaid: pdata},
            cache: false,
            success: function(result)
            {   
                $("#invoiceResult").html(result);
            } 
        });
    }
    function setPaid() {
    var selbox = document.invoiceResult;
    var tiddata = $('#tenantOption').val();
    var uiddata = $('#unitOption').val();
    var pdata = $('#all').val();

    $.ajax
        ({
            type: "POST",
            url: "../controllers/invoicepop.php",
            data: {uid :uiddata, trid :tiddata, paid: pdata},
            cache: false,
            success: function(result)
            {   
                $("#invoiceResult").html(result);
            } 
        });
    }
    function setPending() {
    var selbox = document.invoiceResult;
    var tiddata = $('#tenantOption').val();
    var uiddata = $('#unitOption').val();
    var pdata = $('#all').val();

    $.ajax
        ({
            type: "POST",
            url: "../controllers/invoicepop.php",
            data: {uid :uiddata, trid :tiddata, pending: pdata},
            cache: false,
            success: function(result)
            {   
                $("#invoiceResult").html(result);
            } 
        });
    }
    function setAll() {
    var selbox = document.invoiceResult;
    var tiddata = $('#tenantOption').val();
    var uiddata = $('#unitOption').val();
    var pdata = $('#all').val();

    $.ajax
        ({
            type: "POST",
            url: "../controllers/invoicepop.php",
            data: {uid :uiddata, trid :tiddata, all: pdata},
            cache: false,
            success: function(result)
            {   
                $("#invoiceResult").html(result);
            } 
        });
    }
    function setCurrent() {
    var selbox = document.invoiceResult;
    var tiddata = $('#tenantOption').val();
    var uiddata = $('#unitOption').val();
    var pdata = $('#all').val();

    $.ajax
        ({
            type: "POST",
            url: "../controllers/invoicepop.php",
            data: {uid :uiddata, trid :tiddata, current: pdata},
            cache: false,
            success: function(result)
            {   
                $("#invoiceResult").html(result);
            } 
        });
    }
</script>
<div class="main-backdrop"><!-- --></div>

</body>