<?php
    include('../controllers/config.php');
    include('../controllers/session.php');
    $conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(isset($_POST['submit'])){

        $sql = "INSERT INTO `_floors` (floorName, userName) VALUES (:floor, :user)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':floor', $_POST['floorNumber']);
        $stmt->bindParam(':user', $user);
        $user = $_SESSION['current_user'];
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
                    <i class="left-menu-link-icon icmn-calendar"><!-- --></i>
                    Dashboard
                </a>
            </li>
                <li class="left-menu-list-separator"><!-- -->
            </li>
            
            <li class="left-menu-list-active">
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

    <!--  -->
    <section class="panel">
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="margin-bottom-10">
                        <h4>Floors</h4>
                        <br />
                        <!-- Vertical Form -->
                        <form method="POST" action="floors.php">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="l30">Add Floor</label>
                                        <input type="text" class="form-control" placeholder="Floor Name" id="floorNo" name="floorNumber">
                                    </div>
                                    <div class="form-actions">
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn btn-primary width-100" name="submit">Add</button>
                                            <button type="button" class="btn btn-default width-100">Cancel</button>
                                        </div>                    
                                    </div>
                                </div>
                        </form>
                        <form>
                                <div class="col-lg-9">
                                    <br />
                                        <div class="margin-bottom-50">
                                            <table class="table table-hover nowrap" id="example1" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>Floor Number</th>
                                                        <th>Number of Units</th>
                                                        <th>Number of Tenants</th>
                                                        <th>Edit</th>
                                                        <th>Delete</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>Floor Number</th>
                                                        <th>Number of Units</th>
                                                        <th>Number of Tenants</th>
                                                        <th>Edit</th>
                                                        <th>Delete</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                    <?php
                                                        $sql = "SELECT floorName FROM _floors WHERE userName = :user";
                                                        $stmt = $conn->prepare($sql);
                                                        $stmt->bindParam(':user', $_SESSION['current_user']);
                                                        $stmt->execute();
                                                        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                                                                $sql1 = "SELECT COUNT(*) FROM _units WHERE floorName = :floor";
                                                                $stmt1 = $conn->prepare($sql1);
                                                                $stmt1->bindParam(':floor', $row['floorName']);
                                                                $stmt1->execute();
                                                                $number_of_rows = $stmt1->fetchColumn();

                                                                $sql2 = "SELECT COUNT(*) FROM _tenantRentingInformation WHERE floorName = :floor AND status = '1'";
                                                                $stmt1 = $conn->prepare($sql2);
                                                                $stmt1->bindParam(':floor', $row['floorName']);
                                                                $stmt1->execute();
                                                                $number_of_rows1 = $stmt1->fetchColumn();
                                                            echo '<tr>';
                                                            echo '<td>'.$row['floorName'].'</td>';
                                                            echo '<td>'.$number_of_rows.'</td>';
                                                            echo '<td>'.$number_of_rows1.'</td>';
                                                            echo '<td><a class="icmn icmn-plus-circle2" aria-hidden="true" href="index.php"></a></td>';
                                                            echo '<td><a class="icmn icmn-minus-circle2" aria-hidden="true" href="index.php"></a></td>';
                                                            echo '</tr>';
                                                        }
                                                    ?>
                                                    <!--
                                                    <tr>
                                                        <td>20</td>
                                                        <td>20</td>
                                                        <td><a class="icmn icmn-plus-circle2" aria-hidden="true" href="index.php"></a></td>
                                                        <td><a class="icmn icmn-minus-circle2" aria-hidden="true" href="index.php"></a></td>
                                                    </tr>  -->
                                                </tbody>
                                        </table>
                                    </div>
                            </div>
                            </div>
                        </form>
                        <!-- End Vertical Form -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</section>
</body>