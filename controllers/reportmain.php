<?php
    include('config.php');
    include('session.php');
    $conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $startDate = strtotime($_POST['date1']);
    $endDate = strtotime($_POST['date2']);
?>
    <!-- Dashboard -->
    
    <!--
        <div class="row">
        <form method="POST" name="statuschecker" id="statuschecker">
            <div class="text-center">
                    <button type="submit" class="btn btn-success-outline" name="submit"">
                        Check Bill - admin
                    </button>
            </div>
        </form>
        </div>
    --> <?php echo

        '<div class="row">
            <div class="col-xl-4 col-lg-4 col-sm-4 col-xs-12">
                <div class="widget widget-seven background-success">
                    <div class="widget-body">
                        <div href="javascript: void(0);" class="widget-body-inner">
                            <h5 class="text-uppercase">Amount Receivable</h5>
                            <i class="counter-icon icmn-office"></i>
                            <span class="counter-count">
                            
                                <i class="icmn-arrow-up5"></i>';?>
                                <?php
                                    $sum = 0;
                                    $sql = "SELECT amount, date FROM _bill";
                                    $stmt = $conn->prepare($sql);
                                    //$stmt->bindParam(':user', $_SESSION['id']);
                                    $stmt->execute();
                                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                        $current_date = strtotime($row['date']);
                                        if($current_date >= $startDate && $current_date <= $endDate){
                                            $sum += $row['amount'];
                                        }
                                    }
                                    echo '<span class="counter-init" data-from="3" data-to="'.$sum.'"></span>
                                               
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-sm-4 col-xs-12">
                <div class="widget widget-seven background-default">
                    <div class="widget-body">
                        <div href="javascript: void(0);" class="widget-body-inner">
                            <h5 class="text-uppercase">Amount Received</h5>
                            <i class="counter-icon icmn-home"></i>
                            <span class="counter-count">
                                <i class="icmn-arrow-down5"></i>';?>
                                <?php 
                                    $sum1 = 0;
                                    $sql = "SELECT amount, date FROM _payments";
                                    $stmt = $conn->prepare($sql);
                                    //$stmt->bindParam(':user', $_SESSION['id']);
                                    $stmt->execute();
                                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                        $current_date = strtotime($row['date']);
                                        if($current_date >= $startDate && $current_date <= $endDate){
                                            $sum1 += $row['amount'];
                                        }
                                    }
                                    echo '<span class="counter-init" data-from="0" data-to="'.$sum.'"></span>   
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-sm-4 col-xs-12">
                <div class="widget widget-seven">
                    <div class="widget-body">
                        <div href="javascript: void(0);" class="widget-body-inner">
                            <h5 class="text-uppercase">Balance</h5>
                            <i class="counter-icon icmn-users"></i>
                            <span class="counter-count">
                                <i class="icmn-arrow-up5"></i>';?>
                                <?php
                                    $bal = $sum - $sum1;
                                    echo '<span class="counter-init" data-from="0" data-to="'.$bal.'"></span>
                            </span>
                        </div>
                    </div>
                </div>
            </div> 
            
            <div class="row">
                <div class="col-lg-12">
                    <br />
                    <div class="margin-bottom-50">
                        <table class="table table-hover nowrap" id="tblActive" width="100%">
                            <thead>
                            <tr>
                                <th>Floor</th>
                                <th>Units</th>
                                <th>Tenants</th>
                                <th>Amount Due</th>
                                <th>Amount Paid</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Floor</th>
                                <th>Units</th>
                                <th>Tenants</th>
                                <th>Amount Due</th>
                                <th>Amount Paid</th>
                            </tr>
                            </tfoot>
                            <tbody>';?>
                                <?php
                                    $sql = "SELECT floorName, id FROM _floor WHERE oid = '".$_SESSION['id']."'";
                                    $s = $conn->prepare($sql);
                                    $s->execute();
                                    while($floor = $s->fetch(PDO::FETCH_ASSOC)){
                                        echo '<tr>';
                                        echo '<td>'.$floor['floorName'].'</td>';
                                        $sql = "SELECT COUNT(*) as unitCount, id FROM _unit WHERE floor_id='".$floor['id']."'";
                                        $u = $conn->prepare($sql);
                                        $u->execute();
                                        $tenantCount = 0;
                                        $amount = 0;
                                        $unitCount = 0;
                                        $payments = 0;
                                        while($unit = $u->fetch(PDO::FETCH_ASSOC)){
                                            $unitCount+=1;
                                            $sql = "SELECT id, uid, tid, startDate FROM _tenantrentinginformation WHERE status = '1'";
                                            $tr = $conn->prepare($sql);
                                            $tr->execute();
                                            while($tenant = $tr->fetch(PDO::FETCH_ASSOC)){
                                                if(strtotime($tenant['startDate'])>= $date1){

                                                if($tenant['uid'] == $unit['id']){
                                                    $tenantCount += 1;
                                                    $sql = "SELECT amount,date FROM _bill WHERE trid = '".$tenant['id']."'";
                                                    $a = $conn->prepare($sql);
                                                    $a->execute();
                                                    $res = $a->fetch(PDO::FETCH_ASSOC);
                                                    if(strtotime($res['date'])>= $date1){
                                                        $amount += $res['amount'];
                                                    }
                                                    

                                                    $sql = "SELECT amount, date FROM _payments WHERE tid = '".$tenant['tid']."'";
                                                    $p = $conn->prepare($sql);
                                                    $p->execute();
                                                    $pay = $p->fetch(PDO::FETCH_ASSOC);                                                    
                                                    if(strtotime($pay['date'])>= $date1){
                                                        $payments += $pay['amount'];
                                                    }
                                                }
                                            }
                                            }
                                        }
                                        echo '<td>'.$unitCount.'</td>';
                                        echo '<td>'.$tenantCount.'</td>';
                                        echo '<td>'.$amount.'</td>';
                                        echo '<td>'.$payments.'</td>';
                                        echo '</tr>';
                                    }

                                ?><?php echo '
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    <!-- End Dashboard -->
</div>
</div>'; echo "


<!-- Page Scripts -->
<script>
    $(function() {

        ///////////////////////////////////////////////////////////
        // COUNTERS
        $('.counter-init').countTo({
            speed: 1500
        });

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
        // CAROUSEL WIDGET
        $('.carousel-widget').carousel({
            interval: 4000
        });

        $('.carousel-widget-2').carousel({
            interval: 6000
        });

        ///////////////////////////////////////////////////////////
        // DATATABLES
        $('#tblActive').DataTable({
            responsive: true
        });


    });
</script>
<!-- End Page Scripts -->
</section>
";?>