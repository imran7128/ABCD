<?php
    include('../controllers/config.php');
    include('../controllers/session.php');
    include('head.php'); 
    //session_start();
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

    <!-- Dashboard -->
    <div class="dashboard-container">
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-sm-6 col-xs-12">
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
                                    $sql = "SELECT COUNT(*) FROM _floors WHERE userName = :user";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bindParam(':user', $_SESSION['current_user']);
                                    $stmt->execute();
                                    $number_of_rows = $stmt->fetchColumn();
                                    echo '<span class="counter-init" data-from="3" data-to="'.$number_of_rows.'"></span>';
                                ?>               
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-sm-6 col-xs-12">
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
                                    $sql = "SELECT COUNT(*) FROM _units WHERE userName = :user";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bindParam(':user', $_SESSION['current_user']);
                                    $stmt->execute();
                                    $number_of_rows = $stmt->fetchColumn();
                                    echo '<span class="counter-init" data-from="0" data-to="'.$number_of_rows.'"></span>';
                                ?>   
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-sm-6 col-xs-12">
                <div class="widget widget-seven">
                    <div class="widget-body">
                        <div href="javascript: void(0);" class="widget-body-inner">
                            <h5 class="text-uppercase">Active Tenants</h5>
                            <i class="counter-icon icmn-users"></i>
                            <span class="counter-count">
                                <i class="icmn-arrow-up5"></i>
                                <?php
                                    $conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
                                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    $sql = "SELECT _tenantrentinginformation.`status`, _tenantprofile.userName FROM _tenantrentinginformation
                                            INNER JOIN _tenantprofile ON _tenantrentinginformation.id = _tenantprofile.id WHERE userName = :user AND status='1'";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bindParam(':user', $_SESSION['current_user']);
                                    $stmt->execute();
                                    $number_of_rows = $stmt->fetchColumn();
                                    echo '<span class="counter-init" data-from="0" data-to="'.$number_of_rows.'"></span>';
                                ?> 
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-sm-6 col-xs-12">
                <div class="widget widget-seven">
                    <div class="widget-body">
                        <div href="javascript: void(0);" class="widget-body-inner">
                            <h5 class="text-uppercase">Pending Collection</h5>
                            <i class="counter-icon icmn-stack-text"></i>
                            <span class="counter-count">
                                <i class="icmn-arrow-up5"></i>
                                <?php
                                    $conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
                                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    $sql = "SELECT SUM(balance) FROM _tenantrentinginformation
                                    INNER JOIN _tenantprofile ON _tenantrentinginformation.id = _tenantprofile.id WHERE owner = :user";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bindParam(':user', $_SESSION['current_user']);
                                    $stmt->execute();
                                    $number_of_rows = $stmt->fetchColumn();
                                    echo '<span class="counter-init" data-from="0" data-to="'.$number_of_rows.'"></span>';
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
                                        Current: 15
                                        <br />
                                        Total: 15
                                    </p>
                                </a>
                            </div>
                            <div class="carousel-item">
                                <a href="javascript: void(0);" class="widget-body">
                                    <h2>
                                        <i class="icmn-users"></i> Tenants
                                    </h2>
                                    <p>
                                        Total: 500
                                        <br />
                                        Active: 67
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
                                <a href="javascript: void(0);" class="widget-body">
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
                                <a href="javascript: void(0);" class="widget-body">
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
                                    <h2>Settings</h2>
                                    <p>
                                        Edit Current Profile
                                        <br />
                                    </p>
                                </a>
                            </div>
                            <div class="carousel-item">
                                <a href="javascript: void(0);" class="widget-body">
                                    <h2>Settings</h2>
                                    <p>
                                        Payment Options
                                        <br />
                                    </p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="widget widget-three">
                    <div class="example-calendar-block"></div>
                </div>
            </div>
            
        
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-with-borders">
                <div class="panel-body">
                    <div class="nav-tabs-horizontal margin-bottom-20">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="javascript: void(0);" data-toggle="tab" data-target="#h1" role="tab">Registered Tenants</a>
                            </li>
                        </ul>
                    </div>
                    <table class="table table-hover nowrap margin-bottom-0" id="example1" width="100%">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Unit</th>
                            <th>Floor</th>
                            <th>Amount Due</th>
                            <th>Date</th>
                            <th>Balance</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Unit</th>
                            <th>Floor</th>
                            <th>Amount Due</th>
                            <th>Date</th>
                            <th>Balance</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <!-- TABLE CONTENTS -->
                        </tbody>
                    </table>
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

        ///////////////////////////////////////////////////////////
        // ADJUSTABLE TEXTAREA
        autosize($('#textarea'));

        ///////////////////////////////////////////////////////////
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
        // CALENDAR
        $('.example-calendar-block').fullCalendar({
            //aspectRatio: 2,
            height: 450,
            header: {
                left: 'prev, next',
                center: 'title',
                right: 'month, agendaWeek, agendaDay'
            },
            buttonIcons: {
                prev: 'none fa fa-arrow-left',
                next: 'none fa fa-arrow-right',
                prevYear: 'none fa fa-arrow-left',
                nextYear: 'none fa fa-arrow-right'
            },
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            viewRender: function(view, element) {
                if (!cleanUI.hasTouch) {
                    $('.fc-scroller').jScrollPane({
                        autoReinitialise: true,
                        autoReinitialiseDelay: 100
                    });
                }
            },
            defaultDate: '2017-07-20',
            eventClick: function(calEvent, jsEvent, view) {
                if (!$(this).hasClass('event-clicked')) {
                    $('.fc-event').removeClass('event-clicked');
                    $(this).addClass('event-clicked');
                }
            }
        });

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

        ///////////////////////////////////////////////////////////
        // CHART 1
        new Chartist.Line(".chart-line", {
            labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
            series: [
                [12, 9, 7, 8, 5],
                [2, 1, 3.5, 7, 3],
                [1, 3, 4, 5, 6]
            ]
        }, {
            fullWidth: !0,
            chartPadding: {
                right: 40
            },
            plugins: [
                Chartist.plugins.tooltip()
            ]
        });

        ///////////////////////////////////////////////////////////
        // CHART 2
        var overlappingData = {
                    labels: ["Jan", "Feb", "Mar", "Apr", "Mai", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    series: [
                        [5, 4, 3, 7, 5, 10, 3, 4, 8, 10, 6, 8],
                        [3, 2, 9, 5, 4, 6, 4, 6, 7, 8, 7, 4]
                    ]
                },
                overlappingOptions = {
                    seriesBarDistance: 10,
                    plugins: [
                        Chartist.plugins.tooltip()
                    ]
                },
                overlappingResponsiveOptions = [
                    ["", {
                        seriesBarDistance: 5,
                        axisX: {
                            labelInterpolationFnc: function(value) {
                                return value[0]
                            }
                        }
                    }]
                ];

        new Chartist.Bar(".chart-overlapping-bar", overlappingData, overlappingOptions, overlappingResponsiveOptions);


    });
</script>
<!-- End Page Scripts -->
</section>

<div class="main-backdrop"><!-- --></div>

</body>
</html>