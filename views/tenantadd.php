<?php
    //2 days difference will be considered 1 month,but the  31 are included
    include('../controllers/config.php');
    include('../controllers/session.php');
    $conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if(isset($_POST['submit']))
    {
        $sql = "INSERT INTO `_tenantprofile` (firstName, lastName, address, email, contactNumber, guardianName, guardianAddress, guardianContact, owner, userName, password) VALUES (:name1, :name2, :adrs, :mail, :cn, :gn, :ga, :gc, :onr, :username, :password)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name1', $firstName);
        $stmt->bindParam(':name2', $lastName);
        $stmt->bindParam(':adrs', $address);
        $stmt->bindParam(':mail', $email);
        $stmt->bindParam(':cn', $contactNumber);
        $stmt->bindParam(':gn', $guardianName);
        $stmt->bindParam(':ga', $guardianAddress);
        $stmt->bindParam(':gc', $guardianContact);
        $stmt->bindParam(':onr', $owner);
        $stmt->bindParam(':username', $userName);
        $stmt->bindParam(':password', $password);

        $userName = $firstName . $_SESSION['current_user_id'];
        $password = $lastName . $_SESSION['current_user_id'];
        $firstName= $_POST['firstName'];
        $lastName= $_POST['lastName'];
        $address= $_POST['address'];
        $email= $_POST['email'];
        $contactNumber= $_POST['contactNumber'];
        $guardianName= $_POST['guardianName'];
        $guardianAddress= $_POST['guardianAddress'];
        $guardianContact= $_POST['guardianContact'];
        $owner= $_SESSION['current_user'];
        $stmt->execute();

        $sql = "SELECT id FROM `_tenantprofile` WHERE username = :username AND password = :password";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $userName);
        $stmt->bindParam(':password', $password);
        $result = $stmt->execute();

        $sql = "INSERT INTO `_tenantrentinginformation` (id, status, startDate, endDate ) VALUES (:id, '0')";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $result['id']);
        $stmt->execute();
    }
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
                                    data-validation=[NOTEMPTY]>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="form-control-label" for="l0">Last Name</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Last Name" id="l0" name="lastName"
                                    data-validation=[NOTEMPTY]>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="form-control-label" for="l0">Permanent Address</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Permanent Address" id="l0" name="address"
                                    data-validation=[NOTEMPTY]>
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
                                        data-validation=[EMAIL]>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="form-control-label" for="l0">Cellphone Number</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Cellphone Number" id="l0" name="contactNumber"
                                    data-validation=[NOTEMPTY]>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="form-control-label" for="l0">Parent/Guardian Name</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Parent/Guardian Name" id="l0" name="guardianName"
                                    data-validation=[NOTEMPTY]>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="form-control-label" for="l0">Parent/Guardian Address</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Parent/Guardian Address" id="l0" name="guardianAddress" 
                                    data-validation=[NOTEMPTY]>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="form-control-label" for="l0">Parent/Guardian Contact No.</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Parent/Guardian Contact No." id="l0" name="guardianContact"
                                    data-validation=[NOTEMPTY]>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="floorName">Floor</label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-control" id="floorName" name="floorName" onclick="setOptions(this.value);">
                                    <option>Select Floor</option>
                                    <?php
                                            $sql = "SELECT floorName FROM `_floors` WHERE userName = :user";
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
                                    <label class="form-control-label" for="unitName">Unit</label>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control" id="unitName" name="unitName" onclick="changeRent(this.value)">   
                                    </select>
                                </div>
                                <div class="col-md-3" name="rent" id="rent">
                                    <input type="text" class="form-control" placeholder="0" name="rentamt" readonly="" id="rentamt">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="form-control-label" for="rangeDate">Rent Duration</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="col-md-6">
                                        <input placeholder="From" type='text' class="form-control" id='startDate' name="startDate" />
                                    </div>
                                    <div class="col-md-6">
                                        <input placeholder="To" type='text' class="form-control" id='endDate' name="endDate" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="form-control-label" for="collectionDay">Collection Day</label>
                                </div>
                                <div class="col-md-6">
                                    <div class="margin-bottom-5">
                                        <input type="text" id="collectionDay" name="collectionDay" value="" />
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="additionalPayment" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h4 class="modal-title" id="myModalLabel">Total Rent Cost</h4>
                                        </div>
                                    <div class="modal-body">
                                        <form>
                                            <label>Total number of months</label>
                                            <input type="text" class="form-control" placeholder="0" name="totalMonth" readonly="" id="totalMonth">
                                            <label>Excess number of days</label>
                                            <input type="text" class="form-control" placeholder="0" name="totalDays" readonly="" id="totalDays">
                                            <label>Total Rent (Months)</label>
                                            <input type="text" class="form-control" placeholder="0" name="totalMRent" readonly="" id="totalMRent">
                                            <label>Additional Payment</label>
                                            <input type="text" class="form-control" placeholder="Additional Payment" id="addPayment" name="addPayment" value="0">
                                            <label>Discount</label>
                                            <input type="text" class="form-control" placeholder="Discount" id="disc" name="disc" value="0">
                                        </form>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                                        <button type="submit" action="submit" name="submit" class="btn btn-primary">Save</button>
                                    </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions">
                                <div class="form-group row">
                                    <div class="col-md-9 col-md-offset-3">
                                        <button type="submit" name="submit" class="btn width-150 btn-primary">Submit</button>
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
            from: 15,
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

                //alert("The tenant will have "+quotient+" paying months with "+remainder+" days to spare");
                $('#additionalPayment').modal('show');
                $('.modal-body #totalMonth').val(quotient);
                $('.modal-body #totalMRent').val(totalPayment);
                $('.modal-body #totalDays').val(remainder);

            }
        });

        $('.select2').select2();
        $('.select2-tags').select2({
            tags: true,
            tokenSeparators: [',', ' ']
        });

    })
</script>

<div class="main-backdrop"><!-- --></div>

</body>