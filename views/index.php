<?php
    include('../controllers/config.php');
    include('../controllers/session.php');
    include('head.php'); 
    //session_start();
    //call billstatuschecker

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
            <li class="left-menu-list-active">
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
            <li class="left-menu-list-separator"><!-- --></li>
            <li>
                <a class="left-menu-link" href="profile.php">
                    <i class="left-menu-link-icon icmn-profile"><!-- --></i>
                    Current Profile
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

    <!-- Dashboard -->
    <div class="dashboard-container">
    <!--
        <div class="row">
        <form method="POST" name="statuschecker" id="statuschecker">
            <div class="text-center">
                    <button type="submit" class="btn btn-success-outline" name="submit"">
                        Check Bill - admin
                    </button>
            </div>
        </form>
        </div>
    --> <?php include('../controllers/billstatuschecker.php');?>
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-sm-6 col-xs-12">
                <div class="widget widget-seven background-success">
                    <div class="widget-body">
                        <div href="javascript: void(0);" class="widget-body-inner">
                            <h5 class="text-uppercase">Floors</h5>
                            <i class="counter-icon icmn-office"></i>
                            <span class="counter-count">
                            
                                <i class="icmn-arrow-up5"></i>
                                <?php
                                    $conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
                                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    $sql = "SELECT COUNT(*) FROM _floor WHERE _floor.oid = :user";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bindParam(':user', $_SESSION['id']);
                                    $stmt->execute();
                                    $number_of_rows = $stmt->fetchColumn();
                                    echo '<span class="counter-init" data-from="3" data-to="'.$number_of_rows.'"></span>';
                                ?>               
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-sm-6 col-xs-12">
                <div class="widget widget-seven background-default">
                    <div class="widget-body">
                        <div href="javascript: void(0);" class="widget-body-inner">
                            <h5 class="text-uppercase">Units</h5>
                            <i class="counter-icon icmn-home"></i>
                            <span class="counter-count">
                                <i class="icmn-arrow-down5"></i>
                                <?php
                                    $conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
                                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    $sql = "SELECT COUNT(*) FROM _unit WHERE userName = :user";
                                    $sql = "SELECT COUNT(*) FROM _floor INNER JOIN _owner ON _owner.id = _floor.oid INNER JOIN _unit ON _floor.id = _unit.floor_id WHERE _floor.oid = :owner";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bindParam(':owner', $_SESSION['id']);
                                    $stmt->execute();
                                    $number_of_rows = $stmt->fetchColumn();
                                    echo '<span class="counter-init" data-from="0" data-to="'.$number_of_rows.'"></span>';
                                ?>   
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-sm-6 col-xs-12">
                <div class="widget widget-seven">
                    <div class="widget-body">
                        <div href="javascript: void(0);" class="widget-body-inner">
                            <h5 class="text-uppercase">Renting Tenants</h5>
                            <i class="counter-icon icmn-users"></i>
                            <span class="counter-count">
                                <i class="icmn-arrow-up5"></i>
                                <?php
                                    $conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
                                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    $sql = "SELECT COUNT(*) FROM _tenantprofile INNER JOIN _tenantrentinginformation ON _tenantprofile.id = _tenantrentinginformation.tid WHERE _tenantprofile.oid = :id";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bindParam(':id', $_SESSION['id']);
                                    $stmt->execute();
                                    $number_of_rows = $stmt->fetchColumn();
                                    $active = $number_of_rows;
                                    echo '<span class="counter-init" data-from="0" data-to="'.$number_of_rows.'"></span>';
                                ?> 
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-sm-6 col-xs-12">
                <div class="widget widget-seven">
                    <div class="widget-body">
                        <div href="javascript: void(0);" class="widget-body-inner">
                            <h5 class="text-uppercase">Space Available</h5>
                            <i class="counter-icon icmn-stack-text"></i>
                            <span class="counter-count">
                                <i class="icmn-arrow-up5"></i>
                                <?php
                                    $conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
                                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    $sql = "SELECT _unit.tenantAllowed as allowed, _unit.currentTenant as current FROM _floor INNER JOIN _unit ON _unit.floor_id = _floor.id  WHERE _floor.oid = :id";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bindParam(':id', $_SESSION['id']);
                                    $stmt->execute();
                                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                                    $avail = $result['allowed'] - $result['current'];
                                    echo '<span class="counter-init" data-from="0" data-to="'.$avail.'"></span>';
                                ?> 
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4 col-lg-12 col-sm-12 col-xs-12">
                <div class="widget widget-seven">
                    <div class="carousel-widget-2 carousel slide" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active">
                                <a href="javascript: void(0);" class="widget-body">
                                    <h2>
                                        <i class="icmn-database"></i> Available Units
                                    </h2>
                                    <p>
                                        Current: <?php echo $avail; ?>
                                        <br />
                                    </p>
                                </a>
                            </div>
                            <div class="carousel-item">
                                <a href="javascript: void(0);" class="widget-body">
                                    <h2>
                                        <i class="icmn-users"></i> Tenants
                                    </h2>
                                    <p>
                                    <?php
                                        $sql = "SELECT COUNT(*) as total FROM _tenantprofile WHERE oid = '".$_SESSION['id']."'";
                                        $stmt = $conn->prepare($sql);
                                        $stmt->execute();
                                        $result = $stmt->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                        Total: <?php echo $result['total'];?>
                                        <br />
                                        Active: <?php echo $active;?>
                                    </p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-12 col-sm-12 col-xs-12">
                <div class="widget widget-seven background-danger">
                    <div class="carousel-widget carousel slide" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active">
                                <a href="tenantsummary.php" class="widget-body">
                                    <h2>
                                        <i class="icmn-books"></i> Profiles
                                    </h2>
                                    <p>
                                        View All Profiles
                                        <br />
                                    </p>
                                </a>
                            </div>
                            <div class="carousel-item">
                                <a href="unitsummary.php" class="widget-body">
                                    <h2>
                                        <i class="icmn-download"></i> Units
                                    </h2>
                                    <p>
                                        View All Units
                                    </p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-12 col-sm-12 col-xs-12">
                <div class="widget widget-seven background-info" style="background-image: url(../assets/common/img/temp/photos/9.jpeg)">
                    <div class="carousel-widget-2 carousel slide" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active">
                                <a href="javascript: void(0);" class="widget-body">
                                    <h2>Profile</h2>
                                    <p>
                                        Edit Current Profile
                                        <br />
                                    </p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- End Dashboard -->

</div>


<!-- Page Scripts -->
<script>
    $(function() {

        ///////////////////////////////////////////////////////////
        // COUNTERS
        $('.counter-init').countTo({
            speed: 1500
        });

        // CUSTOM SCROLL
        if (!cleanUI.hasTouch) {
            $('.custom-scroll').each(function() {
                $(this).jScrollPane({
                    autoReinitialise: true,
                    autoReinitialiseDelay: 100
                });
                var api = $(this).data('jsp'),
                        throttleTimeout;
                $(window).bind('resize', function() {
                    if (!throttleTimeout) {
                        throttleTimeout = setTimeout(function() {
                            api.reinitialise();
                            throttleTimeout = null;
                        }, 50);
                    }
                });
            });
        }

    
        ///////////////////////////////////////////////////////////
        // CAROUSEL WIDGET
        $('.carousel-widget').carousel({
            interval: 4000
        });

        $('.carousel-widget-2').carousel({
            interval: 6000
        });

        ///////////////////////////////////////////////////////////
        // DATATABLES
        $('#example1').DataTable({
            responsive: true,
            "lengthMenu": [[5, 25, 50, -1], [5, 25, 50, "All"]]
        });


    });
</script>
<!-- End Page Scripts -->
</section>

<div class="main-backdrop"><!-- --></div>

</body>
</html>