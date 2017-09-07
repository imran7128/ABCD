<?php
    include('../controllers/config.php');
    include('../controllers/session.php');
    $conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
            <li class="left-menu-list-active">
                <a class="left-menu-link" href="bill.php">
                    <i class="left-menu-link-icon icmn-calendar"><!-- --></i>
                    Messages
                </a>
            </li>
            
            <li class="left-menu-list-separator"><!-- --></li>
            <li>
                <a class="left-menu-link" href="apps-profile.html">
                    <i class="left-menu-link-icon icmn-profile"><!-- --></i>
                    Current Profile
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
<!-- Messaging -->
    <section class="panel panel-with-sidebar sidebar-large panel-with-borders messaging">
        <div class="panel-sidebar">
            <div class="messaging-search">
                <div class="search-block">
                    <div class="form-input-icon form-input-icon-right">
                        <i class="icmn-search"></i>
                        <input type="text" class="form-control form-control-sm" placeholder="Search...">
                        <button type="submit" class="search-block-submit "></button>
                    </div>
                </div>
            </div>
            <div class="messaging-list">
            <?php
                $sql="SELECT firstName, lastName, id FROM _tenantprofile WHERE oid = '".$_SESSION['id']."'";
                $stmt = $conn->prepare($sql);
                $stmt ->execute();
                while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                    echo '<div class="messaging-list-item">
                                <div class="s1">
                                </div>
                            <div class="s2">
                                <small class="messaging-time"></small>
                                <div class="messaging-list-title-name">'.$result['firstName'].' '.$result['lastName'].'</div>
                                    <div class="messaging-list-title-last color-default"></div>
                                </div>
                            </div>';
                }
            ?>


            </div>
        </div>
        <div class="panel-heading">
            <div class="pull-right">
                <div class="dropdown">
                    <a href="javascript: void(0);" class="dropdown-toggle dropdown-inline-button" data-toggle="dropdown" aria-expanded="false">
                        <i class="dropdown-inline-button-icon icmn-database"></i>
                        <span class="hidden-lg-down">Actions</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="" role="menu">
                        <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon icmn-pencil7"></i> Edit Conversation</a>
                        <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon icmn-bin3"></i> Delete Conversation</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon fa fa-recycle"></i> Mark as Spam</a>
                    </ul>
                </div>
            </div>
            <h6 class="messaging-title">-</h6>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="conversation-block height-700 custom-scroll">
                        <div class="conversation-item">
                            <div class="s1">
                                <a class="avatar" href="javascript:void(0);">
                                    <img src="../assets/common/img/temp/avatars/5.jpg" alt="Alternative text to the image">
                                </a>
                            </div>
                            <div class="s2">
                                <strong>Chris Scott Junior</strong>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </div>
                        </div>
                        
                        <div class="conversation-item you">
                            <div class="s1">
                                <a class="avatar" href="javascript:void(0);">
                                    <img src="../assets/common/img/temp/avatars/4.jpg" alt="Alternative text to the image">
                                </a>
                            </div>
                            <div class="s2">
                                <strong>Donald Trump</strong>
                                <p>Ok. Thanks!</p>
                            </div>
                        </div>
                        
                    </div>
                    <div class="form-group padding-top-20 margin-bottom-0">
                        <textarea class="form-control adjustable-textarea" placeholder="Type and press enter" style="overflow-x: hidden; word-wrap: break-word; resize: none; overflow-y: visible;"></textarea>
                        <button class="btn btn-primary width-200 margin-top-10">
                            <i class="fa fa-send margin-right-5"></i>
                            Send
                        </button>
                        <button class="btn btn-link margin-top-10">
                            Attach File
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Messaging -->

</div>

<!-- Page Scripts -->
<script>
    $(function() {

        ///////////////////////////////////////////////////
        // SIDEBAR CURRENT STATE

        $('.messaging-list-item').on('click', function(){
            $('.messaging-list-item').removeClass('current');
            $(this).addClass('current');
        });

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
        // ADJUSTABLE TEXTAREA
        autosize($('.adjustable-textarea'));

    });
</script>
<!-- End Page Scripts -->

</section>

<div class="main-backdrop"><!-- --></div>

</body>
</html>