<?php
  	include('../controllers/config.php');
    include('../controllers/session.php');
    $conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    include('head.php');

    if(isset($_POST['password'])){
        if($_POST['password'] != $_POST['confirmpassword']){
            $_SESSION['usuccess'] == 'notmatch';
        }
        else{
            $password = md5($salt.$_POST['password']);
            $sql = "UPDATE _owner SET password = :pass";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':pass', $password);
            if($stmt->execute()){
                $_SESSION['usuccess'] == 'success';
            }
            else{
                $_SESSION['usuccess'] == 'fail';
            }
        }
        header('location: logout.php');
    }
    

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

            <li class="left-menu-list-separator"><!-- --></li>
            <li class="left-menu-list-submenu left-menu-list-active">
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

    <!-- Basic Form Elements -->
    <section class="panel">
        <div class="panel-heading">
            <h3>Change Password</h3>
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
                                    <label class="form-control-label" for="password">Password</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" placeholder="Password" id="password" name="password" data-validation=[NOTEMPTY] value="">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="form-control-label" for="confirmpassword">Confirm Password</label>
                                </div>
                                <div class="col-md-9">
                                        <input type="password" class="form-control" placeholder="Confirm Password" id="confirmpassword" name="confirmpassword" data-validation=[NOTEMPTY] value="">
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="form-group row">
                                    <div class="col-md-9 col-md-offset-3">    
                                        <button type="submit" class="btn btn-success">Update</button>
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
    $('#mainf').validate({
            submit: {
                settings: {
                    inputContainer: '.form-group',
                    errorListClass: 'form-control-error',
                    errorClass: 'has-danger'
                }
            }
        });
</script>
<?php
    if($_SESSION['usuccess'] == 'success'){
        ?>
        <script type="text/javascript">
        swal({
                title: "All done!",
                text: "Profile updated successfully",
                type: "success",
                confirmButtonClass: "btn-success",
                confirmButtonText: "Success"
            });
    </script>
    <?php
    }
    if($_SESSION['usuccess'] == 'fail'){
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
    if($_SESSION['usuccess'] == 'notmatch'){
        ?>
        <script type="text/javascript">
        swal({ 
                title: "Error",
                text: "Passwords do not match, password unchanged!",
                type: "error" 
                //},
                  //  function(){
                  //  window.location.href = 'login.html';
            });
    </script>
        <?php
    }
    $_SESSION['usuccess'] = 'undefined';
?>
