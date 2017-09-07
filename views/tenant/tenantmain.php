<?php
    include('../../controllers/config.php');
    include('../../controllers/session.php');
    $conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT firstName, lastName FROM _tenantprofile WHERE id = '".$_SESSION['']."'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $tenantname = $stmt->fetch(PDO::FETCH_ASSOC);

    include('head.php'); 
 ?>
<body class="mode-default colorful-enabled theme-red">
<nav class="left-menu" left-menu>
    <div class="logo-container">
        <a href="index.html" class="logo">
            <img src="../../assets/common/img/logo.png" alt="Clean UI Admin Template" />
            <img class="logo-inverse" src="../../assets/common/img/logo-inverse.png" alt="ABCD" />
        </a>
    </div>
    <div class="left-menu-inner scroll-pane">
        <ul class="left-menu-list left-menu-list-root list-unstyled">
            <li class="left-menu-list-separator "><!-- --></li>
            <li class="left-menu-lists-active">
                <a class="left-menu-link" href="index.php">
                    <i class="left-menu-link-icon icmn-home2"><!-- --></i>
                    <span class="menu-top-hidden">Invoices</span>
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
                    Welcome, <?php echo $tenantname['firstName'].' '.$tenantname['lastName'];?>
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
    <section class="panel panel-with-borders">
        <div class="panel-heading">
            <div class="row">
                    <div class="text-center">
                    <input type="hidden" value="all" name="all" id="all">
                        <button type="button" class="btn btn-success-outline" name="current" id="current" onclick="setCurrent();">
                        Latest
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
                    </div>
                </div>
        </div>                   
    </section>
    <section name="invoiceResult" id="invoiceResult">
        
    </section>
</div>
</section>
<script>
    $(function(){

        $('.select2').select2();
        
        $('.select2').select2().on("select2:close", function(e) {
          changetenant(this.value);
        })
        $('.select3').select2();

    });
</script>

<script type="text/javascript">
    var tiddata = <?php echo $_SESSION['id'];?>
    var uiddata = <?php echo $_SESSION['uid'];?>
    var pdata = '';

    function setUnpaid() {
    var selbox = document.invoiceResult;
    $.ajax
        ({
            type: "POST",
            url: "invoicepop.php",
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
    $.ajax
        ({
            type: "POST",
            url: "invoicepop.php",
            data: {uid :uiddata, trid :tiddata, paid: pdata},
            cache: false,
            success: function(result)
            {   
                $("#invoiceResult").html(result);
            } 
        });
    }
    function setCurrent() {
    var selbox = document.invoiceResult;
    $.ajax
        ({
            type: "POST",
            url: "invoicepop.php",
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