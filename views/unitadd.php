<?php
    include('../controllers/config.php');
    include('../controllers/session.php');

    //1 is occupied, 0 is available

        $conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if(isset($_POST['submit'])){
            $sql = "INSERT INTO `_units` (rent, unitName, floorName, userName, tenant, status) VALUES (:rent, :unit, :floor, :user, '0', '0')";
            $stmt=$conn->prepare($sql);
            $stmt->bindParam(':rent', $rent);
            $stmt->bindParam(':unit', $unit);
            $stmt->bindParam(':floor', $floor);
            $stmt->bindParam(':user', $_SESSION['current_user']);

            $rent = $_POST['rent'];
            $unit = $_POST['unit'];
            $floor = $_POST['floor'];
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

    <!-- Basic Form Elements -->
    <section class="panel">
        <div class="panel-heading">
            <h3>Add Unit</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="margin-bottom-50">
                        <br />
                        <!-- Horizontal Form -->
                        <form method="POST" name="addUnit" action="unitadd.php">
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="l13">Floor</label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-control" id="l13" name="floor">
                                        <?php
                                            $sql = "SELECT floorName FROM _floors WHERE userName = :user";
                                            $stmt = $conn->prepare($sql);
                                            $stmt->bindParam(':user', $_SESSION['current_user']);
                                            $stmt->execute();
                                            while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                                                echo '<option value="'.$row['floorName'].'">'.$row['floorName'].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="form-control-label" for="l0">Unit Name</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Unit Name" id="l0" name="unit">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="form-control-label" for="l0">Rent Per Month</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Monthly Rent" id="l0", name="rent">
                                </div>
                            </div>

                            <div class="form-actions">
                                <div class="form-group row">
                                    <div class="col-md-9 col-md-offset-3">
                                        <button type="submit" class="btn width-150 btn-primary" name="submit">Submit</button>
                                        <button type="button" class="btn btn-default">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- End Horizontal Form -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End -->

</div>
</section>

<div class="main-backdrop"><!-- --></div>

</body>