<?php
    //2 days difference will be considered 1 month,but the  31 are included
    //dapat isa isa munang nag vavalidate
    //status 1 is active
    //unit status 1 is not available
    //unit tenant is tenant id
    //unit username is owner
    //do something with additional payment and discount -- include to invoice?
    //check for duplicate entry before save
    //if already registered, and want to rent more than 1 room, do not add to renting profile
    //dd-mm-yyy
    //kulang ng deposit
    include('../controllers/config.php');
    include('../controllers/session.php');
    $conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $firstName = "";
    $lastName = "";
    $userName = "";
    $password = "";
    $address= "";
    $email= "";
    $contactNumber= "";
    $guardianName= "";
    $guardianAddress= "";
    $guardianContact= "";
    $owner= $_SESSION['current_user'];
    $floorName = "";
    $unitName = "";
    $startDate = "";
    $endDate = "";

    if(isset($_GET['tid'])){
        $sql = "SELECT
            _tenantprofile.firstName as fName,
            _tenantprofile.lastName as lName,
            _tenantprofile.address as address,
            _tenantprofile.email as email,
            _tenantprofile.contactNumber as contact,
            _tenantprofile.guardianName as gName,
            _tenantprofile.guardianAddress as gAddress,
            _tenantprofile.guardianContact as gContact,
            _tenantprofile.username as username,
            _tenantprofile.password as password
            FROM
            _tenantprofile WHERE _tenantprofile.oid = :id AND _tenantprofile.id = :tid";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $_SESSION['id']);
            $stmt->bindParam(':tid', $_GET['tid']);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $firstName = $result['fName'];
            $lastName = $result['lName'];
            $address = $result['address'];
            $contactNumber = $result['contact'];
            $guardianName = $result['gName'];
            $guardianAddress = $result['gAddress'];
            $guardianContact = $result['gContact'];
            $email = $result['email'];
            $username = $result['username'];
            $password = $result['password'];
    }

    if(isset($_POST['firstName'])){
        $totalMonths = $_POST['totalMonth'];
        $balance = $_POST['totalMRent'];
        $additionalPayment = $_POST['addPayment'];
        $discount = $_POST['disc'];
        $adjustedRentPerMonth = $_POST['aRPMt'];
        $downpayment = $_POST['downpayment'];

        $firstName= $_POST['firstName'];
        $lastName= $_POST['lastName'];

        if(!isset($_GET['tid'])){
            $userName = $firstName.$_SESSION['id'];
            $password = $lastName.$_SESSION['id'];
        }
        
        $address= $_POST['address'];
        $email= $_POST['email'];
        $contactNumber= $_POST['contactNumber'];
        $guardianName= $_POST['guardianName'];
        $guardianAddress= $_POST['guardianAddress'];
        $guardianContact= $_POST['guardianContact'];
        $owner= $_SESSION['current_user'];
        $floorName = $_POST['floorName'];
        $unitName = $_POST['unitName'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];
        $collectionDay = $_POST['collectionDay'];

        if(isset($_GET['tid'])){
            $sql = "SELECT balance from _tenantprofile WHERE id = :tid";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam('tid', $_GET['tid']);
            $stmt->execute();
            $brow = $stmt->fetch(PDO::FETCH_ASSOC);
            $b = $brow['balance'];
            $b += $balance;

            $sql = "UPDATE _tenantprofile SET firstName = :firstName, lastName = :lastName, address = :address, email = :email, contactNumber = :contactNumber, guardianName = :guardianName, guardianAddress = :guardianAddress, guardianContact = :guardianContact, balance = :balance WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam('id', $_GET['tid']);
            $stmt->bindParam('balance', $b); 
        }
        else{
            $sql = "INSERT INTO `_tenantprofile` (firstName, lastName, username, password, address, email, contactNumber, guardianName, guardianAddress, guardianContact, oid, balance) VALUES (:firstName, :lastName, :username, :password, :address, :email, :contactNumber, :guardianName, :guardianAddress, :guardianContact, :oid, :balance)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam('username',$userName);
            $stmt->bindParam('password',$password);
            $stmt->bindParam('oid',$_SESSION['id']); 
            $stmt->bindParam('balance',$balance);

        }
        $stmt->bindParam('firstName',$firstName);
        $stmt->bindParam('lastName',$lastName);
        $stmt->bindParam('address',$address);
        $stmt->bindParam('email',$email);
        $stmt->bindParam('contactNumber',$contactNumber);
        $stmt->bindParam('guardianName',$guardianName);
        $stmt->bindParam('guardianAddress',$guardianAddress);
        $stmt->bindParam('guardianContact',$guardianContact);  
        $stmt->execute();

        $sql3 = "SELECT id FROM `_tenantprofile` WHERE userName = :username AND password = :password";
        $stmt3 = $conn->prepare($sql3);
        $stmt3->bindParam(':username', $userName);
        $stmt3->bindParam(':password', $password);
        $stmt3->execute();
        $tenantid=$stmt3->fetch(PDO::FETCH_ASSOC);

        $sql = "SELECT _unit.id as id FROM _unit INNER JOIN _floor ON _unit.floor_id = _floor.id WHERE _floor.oid = :id AND _unit.id = :unit";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $_SESSION['id']);
        $stmt->bindParam(':unit', $unitName);
        $stmt->execute();
        $unitid=$stmt->fetch(PDO::FETCH_ASSOC);



        $sql = "INSERT INTO `_tenantrentinginformation` (tid, uid, downpayment, startDate, endDate, totalMonths, collectionDay, balance, adjustedRentPerMonth) VALUES (:tid, :uid, :downpayment, :startDate, :endDate, :totalMonths, :collectionDay, :balance, :adjustedRentPerMonth)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':downpayment',$downpayment);
        $stmt->bindParam(':startDate',$startDate);
        $stmt->bindParam(':endDate',$endDate);
        $stmt->bindParam(':totalMonths',$totalMonths);
        $stmt->bindParam(':collectionDay',$collectionDay);
        $stmt->bindParam(':balance',$balance);
        $stmt->bindParam(':adjustedRentPerMonth',$adjustedRentPerMonth);
        if(isset($_GET['tid'])){
            $stmt->bindParam(':tid', $_GET['tid']);
        }
        else{
            $stmt->bindParam(':tid', $tenantid['id']);
        }
        $stmt->bindParam(':uid', $unitid['id']);
        $stmt->execute();

        $sql = "UPDATE `_unit` SET currentTenant = currentTenant + :add WHERE id = :uid";
        $stmt = $conn->prepare($sql);
        $add = 1;
        $stmt->bindParam('uid', $unitid['id']);
        $stmt->bindParam('add', $add);
        if($stmt->execute()){
                $_SESSION['tsuccess'] = 'success';
            }
            else{
                $_SESSION['tsuccess'] = 'fail';

            }

        //dd-mm-yyy
        $startDate = explode('-', $startDate);
        $day = $startDate[0];
        $month   = $startDate[1];
        $year  = $startDate[2];

        $sql = "SELECT id FROM _tenantrentinginformation WHERE tid = :tid";
        $stmt = $conn->prepare($sql);
        if(isset($_GET['tid'])){
            $stmt->bindParam(':tid', $_GET['tid']);
        }
        else{
            $stmt->bindParam(':tid', $tenantid['id']);
        }
        $stmt->execute();   
        $description = 'Monthly Bill';    
        $trids = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($trids as $trid){
                while($totalMonths > 0){
                        if($collectionDay > $day){
                            if($month == 12){
                                $year += 1;
                                $month = 1;
                            }
                            else{
                                $month += 1;
                            }
                            $fday = $collectionDay."-".$month."-".$year;
                        }
                        if($collectionDay <= $day){
                            if($month == 12){
                                $month = 1;
                                $year += 1;    
                            }
                            else{
                                $month += 1;
                            }
                            $fday = $collectionDay."-".$month."-".$year;
                        }
                                sleep(0.5);
                            
                                $totalMonths -= 1;
                                $sql = "INSERT INTO _bill (tid, trid, description, amount, date, status) VALUES (:tid, :trid, :description,:amount, :day, 'pending')";
                                $stmt = $conn->prepare($sql);
                                if(isset($_GET['tid'])){
                                    $stmt->bindParam(':tid', $_GET['tid']);
                                }
                                else{
                                    $stmt->bindParam(':tid', $tenantid['id']);
                                }
                                $stmt->bindParam(':trid', $trid['id']);
                                $stmt->bindParam(':day', $fday);
                                $stmt->bindParam(':amount', $adjustedRentPerMonth);
                                $stmt->bindParam(':description', $description);
                                $stmt->execute();

                }
                
        }
   
    }

    
    /*
        
    */
 ?>
 <?php       
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
            <h3>Add Tenant</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="margin-bottom-50">
                        <br />
                        <!-- Horizontal Form -->
                        <form  id="mainf" name="mainf" method="POST">
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="form-control-label" for="l0">First Name</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="First Name" id="l0" name="firstName"
                                    data-validation=[NOTEMPTY] value="<?php echo $firstName;?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="form-control-label" for="l0">Last Name</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Last Name" id="l0" name="lastName"
                                    data-validation=[NOTEMPTY] value="<?php echo $lastName;?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="form-control-label" for="l0">Permanent Address</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Permanent Address" id="l0" name="address"
                                    data-validation=[NOTEMPTY] value="<?php echo $address;?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="form-control-label" for="l2">Email Address</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="icmn-mail2"></i>
                                        </span>
                                        <input type="email" class="form-control" placeholder="Email Address" id="l2" name="email"
                                        data-validation=[EMAIL] value="<?php echo $email;?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="form-control-label" for="l0">Cellphone Number</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Cellphone Number" id="l0" name="contactNumber"
                                    data-validation=[NOTEMPTY] value="<?php echo $contactNumber;?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="form-control-label" for="l0">Parent/Guardian Name</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Parent/Guardian Name" id="l0" name="guardianName"
                                    data-validation=[NOTEMPTY] value="<?php echo $guardianName;?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="form-control-label" for="l0">Parent/Guardian Address</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Parent/Guardian Address" id="l0" name="guardianAddress" 
                                    data-validation=[NOTEMPTY] value="<?php echo $guardianAddress;?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="form-control-label" for="l0">Parent/Guardian Contact No.</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Parent/Guardian Contact No." id="l0" name="guardianContact"
                                    data-validation=[NOTEMPTY] value="<?php echo $guardianContact;?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="floorName">Floor</label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-control" id="floorName" name="floorName" <?php if(!isset($_GET['uid']) && !isset($_GET['fid'])) {echo 'onclick="setOptions(this.value);"';}?>>
                                    <!--<option>Select Floor</option>-->
                                    <?php
                                            if(isset($_GET['uid']) && isset($_GET['fid'])){
                                                $sql = "SELECT id,floorName FROM _floor WHERE oid= :id AND id = :fid";
                                                $stmt = $conn->prepare($sql);
                                                $stmt->bindParam(':fid', $_GET['fid']);
                                            }
                                            else{
                                                $sql = "SELECT id,floorName FROM `_floor` WHERE oid = :id";
                                                $stmt = $conn->prepare($sql);
                                            }
                                            $stmt->bindParam(':id', $_SESSION['id']);
                                            $stmt->execute();
                                            while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                                                echo '<option value="'.$row['id'].'">'.$row['floorName'].'</option>';
                                            }
                                    ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="form-control-label" for="unitName">Unit</label>
                                </div>
                                <div class="col-md-6">
                                    <?php
                                        if(isset($_GET['uid']) && isset($_GET['fid'])){
                                                $sql = "SELECT unitName, rentPerTenant FROM _unit WHERE id = :id";
                                                $stmt = $conn->prepare($sql);
                                                $stmt->bindParam(':id', $_GET['uid']);
                                                $stmt->execute();
                                                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                                            ?>
                                            <select class="form-control" placeholder="Select Unit" id="unitName" name="unitName"> 
                                            <option value="<?php echo $_GET['uid']?>"><?php echo $result['unitName']?></option>
                                            </select>
                                            <?php
                                        }
                                        else{?>
                                            <select class="form-control" placeholder="Select Unit" id="unitName" name="unitName" onclick="changeRent(this.value)"" data-validation=[NOTEMPTY]>   
                                            </select>
                                            <?php
                                        }
                                    ?>
                                    
                                </div>
                                <div class="col-md-3" name="rent" id="rent">
                                    <input type="text" class="form-control" placeholder="0" name="rentamt" readonly="" id="rentamt" <?php if(isset($_GET['uid']) && isset($_GET['fid'])){echo 'value="'.$result['rentPerTenant'].'"';}?>>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="form-control-label" for="rangeDate">Rent Duration</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="col-md-6">
                                        <input placeholder="From" type='text' class="form-control" id='startDate' name="startDate" data-validation=[NOTEMPTY] />
                                    </div>
                                    <div class="col-md-6">
                                        <input placeholder="To" type='text' class="form-control" id='endDate' name="endDate" data-validation=[NOTEMPTY] />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="form-control-label" for="collectionDay"><br />Collection Day</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="margin-bottom-5">
                                        <input type="text" id="collectionDay" name="collectionDay" value="" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="form-control-label" for="collectionDay">Total number of months</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="margin-bottom-5">
                                        <input type="text" class="form-control" placeholder="0" name="totalMonth" readonly="" id="totalMonth">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="form-control-label" for="collectionDay">Excess number of days</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="margin-bottom-5">
                                        <input type="text" class="form-control" placeholder="0" name="totalDays" readonly="" id="totalDays">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="form-control-label" for="collectionDay">Total Rent Due</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="margin-bottom-5">
                                        <input type="text" class="form-control" placeholder="0" name="totalMRent" readonly="" id="totalMRent">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="form-control-label" for="collectionDay">Downpayment</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="margin-bottom-5">
                                        <input type="text" class="form-control" placeholder="Downpayment" id="downpayment" name="downpayment" value=0 onchange="changeTotal();" onkeyup="this.onchange();" onpaste="this.onchange();" oninput="this.onchange();">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="form-control-label" for="collectionDay">Required Additional Payment</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="margin-bottom-5">
                                        <input type="text" class="form-control" placeholder="Additional Payment" id="addPayment" name="addPayment" value=0 onchange="changeTotal();" onkeyup="this.onchange();" onpaste="this.onchange();" oninput="this.onchange();">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="form-control-label" for="collectionDay">Discount</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="margin-bottom-5">
                                       <input type="text" class="form-control" placeholder="Discount" id="disc" name="disc" value=0 onchange="changeTotal();" onkeyup="this.onchange();" onpaste="this.onchange();" oninput="this.onchange();">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label name="aRPM" id="aRPM">Adjusted Rent Per Month</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="margin-bottom-5" name="aRPMdiv" id="aRPMdiv">
                                       <input type="text" class="form-control" placeholder="" name="aRPMt" readonly="" id="aRPMt" value="0">
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions">
                                <div class="form-group row">
                                    <div class="col-md-9 col-md-offset-3">
                                        <button type="submit" class="btn width-150 btn-primary">Submit</button>
                                        <button type="button" class="btn btn-default">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End -->

</div>
</section>

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
    function changeRent(selectedValue) {
    var selbox = document.mainf.rent;
    var dataString = selectedValue;
    $.ajax
        ({
            type: "POST",
            url: "../controllers/changeRent.php",
            data: {unit :dataString},
            cache: false,
            success: function(result)
            {   
                $("#rent").html(result);
            } 
        });
    }
</script>
<script type="text/javascript">
    function changeTotal(){
        var addP = document.getElementById('addPayment');
        var disc = document.getElementById('disc');
        var runningTotal = document.getElementById('totalMRent');
        var totalMonth = document.getElementById('totalMonth');
        var dp = document.getElementById('downpayment');

        a = parseInt(runningTotal.value) + parseInt(addP.value);
        b = a - parseInt(disc.value) - parseInt(dp.value);
        var total = parseFloat(b/parseInt(totalMonth.value));
        alert(total);
        var selbox = document.mainf.aRPM;
        console.log(a + "a");
        console.log(b + "b");
        $.ajax
        ({
            type: "POST",
            url: "../controllers/adjustedRentPerMonth.php",
            data: {totalR :total},
            cache: false,
            success: function(result)
            {   
                $("#aRPMdiv").html(result);
            } 
        })

    }
</script>
<script type="text/javascript">
    function showSuccess(e){

    }
</script>
<script>
    $(function(){
        
        $('#startDate').datetimepicker({
                format: 'DD-MM-YYYY',
        });
        $('#endDate').datetimepicker({
                format: 'DD-MM-YYYY'
        });

        $('.datepicker-only-init').datetimepicker({
            widgetPositioning: {
                horizontal: 'left'
            },
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            },
            format: 'LL'
        });

        $('#mainf').validate({
            submit: {
                settings: {
                    inputContainer: '.form-group',
                    errorListClass: 'form-control-error',
                    errorClass: 'has-danger'
                }
            }
        });

        $('#mainf').validate({
            submit: {
                settings: {
                    inputContainer: '.form-group',
                    errorListClass: 'form-control-error-list',
                    errorClass: 'has-danger'
                }
            }
        });

        $("#collectionDay").ionRangeSlider({
            type: "single",
            min: 1,
            max: 30,
            from: 1,
            step: 1,
            grid: true,
            grid_num: 1,
            onFinish:  function (data) {
                var collection = $("#collectionDay").val();
                var date2 = $("#endDate").val();
                var date1 = $("#startDate").val();
                date1 = date1.split('-');
                date2 = date2.split('-');
                endDay = date2[0];
                startDay = date1[0];
                date1 = new Date(date1[2], date1[1], date1[0]);
                date2 = new Date(date2[2], date2[1], date2[0]);
                date1_unixtime = parseInt(date1.getTime() / 1000);
                date2_unixtime = parseInt(date2.getTime() / 1000);
                var timeDifference = date2_unixtime - date1_unixtime;
                var timeDifferenceInHours = timeDifference / 60 / 60;
                var timeDifferenceInDays = timeDifferenceInHours  / 24;
                console.log(timeDifferenceInDays);


                var quotient = Math.floor(timeDifferenceInDays/30);
                var remainder = timeDifferenceInDays % 30;
                var t = document.getElementById('rentamt');
                var totalPayment = quotient * t.value;
                var rentPerMonth = Math.floor(totalPayment/quotient);
                console.log(totalPayment + "total amount");
                console.log(t.value + "total rentamt");
                //alert("The tenant will have "+quotient+" paying months with "+remainder+" days to spare");
                $('#aRPMt').val(rentPerMonth);                
                $('#totalMonth').val(quotient);
                $('#totalMRent').val(totalPayment);
                $('#totalDays').val(remainder);
            }
        });

        $('.select2').select2();
        $('.select2-tags').select2({
            tags: true,
            tokenSeparators: [',', ' ']
        });

    })
</script>
<?php
    if($_SESSION['tsuccess'] == 'success'){
        ?>
        <script type="text/javascript">
        swal({
                title: "All done!",
                text: "Tenant added successfully",
                type: "success",
                confirmButtonClass: "btn-success",
                confirmButtonText: "Success"
            },function(){
                window.location.replace("tenantadd.php");
            });
    </script>
    <?php
    }
    if($_SESSION['tsuccess'] == 'fail'){
        ?>
        <script type="text/javascript">
        swal({ 
                title: "Error",
                text: "Server Problem, try again later.",
                type: "error" 
                //},
                  //  function(){
                  //  window.location.href = 'login.html';
            });
    </script>
        <?php
    }
    $_SESSION['tsuccess'] = 'undefined';
    
?>
<div class="main-backdrop"><!-- --></div>

</body>