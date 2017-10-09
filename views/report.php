<?php
    include('../controllers/config.php');
    include('../controllers/session.php');

    //1 is occupied, 0 is available
        $conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //left-menu-list-active    
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
             <li class="left-menu-list-active ">
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
<section class="panel">
        <div class="panel-heading">
            <h3>Report Range</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="margin-bottom-50">
                        <br />
                        <!-- Horizontal Form -->
                        <form>
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

                           
                            <div class="form-actions">
                                <div class="form-group row">
                                    <div class="col-md-12 col-md-offset-3">
                                        <button type="button" name="submitUnit" onclick ="reportpop();"class="btn width-150 btn-primary">Submit</button>  
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- End Horizontal Form -->
                    </div>
                </div>
            </div>
             <section name="report_output" id="report_output"></section>
        </div>
    </section>
    <!-- End -->
   

</div>
</section>

</div>
</section>

<div class="main-backdrop"><!-- --></div>

</body>

<script>
    $(function(){
        
        $('#startDate').datetimepicker({
                format: 'DD-MM-YYYY',
        });
        $('#endDate').datetimepicker({
                format: 'DD-MM-YYYY'
        });
    })
</script>
<script type="text/javascript">
    function reportpop(){
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

                var quotient = Math.floor(timeDifferenceInDays/30);

                if(quotient <= 0){
                     alert("Renting month must be greater than 0.");
                }
                else{
                    pop();
        
                }
    }
    function pop(){
        var selbox = document.report_output;
        var date2 = $("#endDate").val();
        var date1 = $("#startDate").val();
        $.ajax
        ({
            type: "POST",
            url: "../controllers/reportmain.php",
            data: {date1 :date1, date2 :date2},
            cache: false,
            success: function(result)
            {   
                //alert(result);
                $("#report_output").html(result);

            } 
        })
    }
</script>
