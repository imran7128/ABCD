<?php
//para hindi umuulit, dapat assign ng empty values sa start
    include('../controllers/config.php');
    include('../controllers/session.php');
    $conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $floortodelete = "";
    $url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
    $escaped_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' ); 
    $_SESSION['floor_delete_by_user'] = 'undefined';
    if(isset($_GET['fid'])){
        $f = 'location: ../controllers/deleteFloor.php?fid='.$_GET['fid'];
        header($f);
    }
    if($_POST){
        $sql = "SELECT id FROM _floor WHERE floorName = :floor AND oid = :owner";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':floor', $_POST['floorNumber']);
        $stmt->bindParam(':owner', $_SESSION['id']);
        $stmt->execute();
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        if($row == 0){
            $sql = "INSERT INTO `_floor` (floorName, oid) VALUES (:floor, :id)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':floor', $_POST['floorNumber']);
            $stmt->bindParam(':id', $_SESSION['id']);
            if($stmt->execute()){
                $_SESSION['usuccess'] = 'success';
            }
            else{
                $_SESSION['usuccess'] = 'fail';

            }
        }
        else{
            $_SESSION['usuccess'] == 'taken';
        }

        
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
                        <form method="POST" name="mainf" id="mainf">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="l30">Add Floor</label>
                                        <input type="text" class="form-control" placeholder="Floor Name" id="floorNo" name="floorNumber" data-validation="[NOTEMPTY]">
                                    </div>
                                    <div class="alert alert-danger" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                        <strong>Warning!</strong> <a href="#" class="alert-link">Floor names cannot be edited once submitted.
                                    </div>
                                    <div class="form-actions">
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn btn-primary width-100" >Add</button>
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
                                                        <th>Delete</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>Floor Number</th>
                                                        <th>Number of Units</th>
                                                        <th>Number of Tenants</th>
                                                        <th>Delete</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                    <?php
                                                        $sql = "SELECT floorName, id FROM _floor WHERE oid = :id";
                                                        $stmt = $conn->prepare($sql);
                                                        $stmt->bindParam(':id', $_SESSION['id']);
                                                        $stmt->execute();
                                                        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){

                                                            $sql1 = "SELECT COUNT(*) FROM _unit WHERE floor_id = :floor";
                                                            $stmt1 = $conn->prepare($sql1);
                                                            $stmt1->bindParam(':floor', $row['id']);
                                                            $stmt1->execute();
                                                            $number_of_rows1 = $stmt1->fetchColumn();

                                                            $sql2="SELECT COUNT(*) FROM _unit INNER JOIN _tenantrentinginformation ON _tenantrentinginformation.uid = _unit.id INNER JOIN _floor ON _unit.floor_id = _floor.id WHERE floor_id = :floor";
                                                            $stmt2 = $conn->prepare($sql2);
                                                            $stmt2->bindParam(':floor', $row['id']);
                                                            $stmt2->execute();
                                                            $number_of_rows2 = $stmt2->fetchColumn();
                                                            echo '<tr>';
                                                            echo '<td>'.$row['floorName'].'</td>';
                                                            echo '<td>'.$number_of_rows1.'</td>';
                                                            echo '<td>'.$number_of_rows2.'</td>';
                                                            if($number_of_rows1 >'0'){
                                                                echo '<td>-</td>';
                                                            }
                                                            else{
                                                                echo '<td><button class="btn btn-default margin-inline swal-btn-warning" value="'.$row['id'].'" onclick="launchModal(this.value);">Delete</button></td>';
                                                            }

                                                            
                                                            echo '</tr>';
                                                            ?>
                                                            <?php



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
<script type="text/javascript">
    var valuetodel;
    function launchModal(selectedValue){
        //$('.swal-btn-warning').trigger("click");
        valuetodel = selectedValue;
    }

    $('.swal-btn-warning').click(function(e){
        e.preventDefault();
            swal({
                title: "Are you sure?",
                text: "Your will not be able to recover this file!",
                type: "warning",
                showCancelButton: true,
                cancelButtonClass: "btn-default",
                confirmButtonClass: "btn-warning",
                confirmButtonText: "Remove",
                closeOnConfirm: false
            },
            function(){
                <?php $_SESSION['floor_delete_by_user'] = 'true';?>
                var uri = "<?php echo $escaped_url;?>";
                var dest = uri.concat("?fid=",valuetodel);
                window.location.replace(dest);
            });
        });

</script>
<?php
    if($_SESSION['usuccess'] == 'success'){
        ?>
        <script type="text/javascript">
        swal({
                title: "All done!",
                text: "Floor added successfully",
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
    if($_SESSION['usuccess'] == 'taken'){
        ?>
        <script type="text/javascript">
        swal({ 
                title: "Error",
                text: "Floor name exists",
                type: "error" 
                //},
                  //  function(){
                  //  window.location.href = 'login.html';
            });
    </script>
        <?php
    }
    if($_SESSION['usuccess'] == 'deleted'){
        ?>
        <script type="text/javascript">
            swal({
                    title: "Deleted!",
                    text: "File has been deleted",
                    type: "success",
                    confirmButtonClass: "btn-success"
                });           
        </script><?php
    }

    $_SESSION['usuccess'] = 'undefined';
?>
</body>

