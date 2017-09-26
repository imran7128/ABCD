<?php
    include ('../controllers/config.php');
    $conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if($_POST){
        $sql="SELECT password, id FROM _owner WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":email", $_POST['email']);
        $stmt->execute();
        $row = $stmt->rowCount();
        if($row > 0){
            
            $txt = "You forgot your account credentials for ABCD. A request was made to recover your account.
                    . Report has been received. Await for further instructions. Thank you!";
            //send_mail("",$txt, "owner");
        }
        else{
             $sql="SELECT password, id FROM _tenantprofile WHERE email = :email";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":email", $_POST['email']);
            $stmt->execute();
            $row = $stmt->rowCount();
            if($row > 0){
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                updateTenantAccount($result['id']);
                $link = "recover.php?recover=".$result['id']."";
                $txt = "You forgot your account credentials for ABCD. A request was made to recover your account.
                    To continue, proceed to this link. ".$link." . Thank you!";
                header("location:" .$link);
                //send_mail();
            }
        }
    }
    function updateTenantAccount($id){
        include ('../controllers/config.php');
        $conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE _tenantprofile SET password = 'imranimranimranhussain' WHERE id ='".$id."'";
        $stmt = $conn->prepare($sql);
        $stmt -> execute();
    }
    function send_mail($txt = "", $type = ""){
        include ('../controllers/config.php');
        $conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $to = $_POST['email'];
        $subject = "ABCD Account Recovery";
        $txt = "";
        $header = "From: account_reset@abcdormitory.com";
        mail($to, $subject,$txt,$header);

        if($type == "owner"){
            $txt = "Owner with email ".$to." has requested account recovery";
        }
        else{
            $txt = "Tenant with email ".$to." has requested account recovery";
              
        }
        $to = "account_reset@abcdormitory.com";
        $subject = "ABCD Account Recovery - Someone requested account recovery"; 
        mail($to, $subject,$txt,$header);



    }
?>
<?php
    include ('head.php');
?>
<body class="theme-default">

<section class="page-content">
<div class="page-content-inner" style="background-image: url(../assets/common/img/temp/login/4.jpg)">

    <!-- Login Page -->
    <div class="single-page-block-header">
        <div class="row">
            <div class="col-lg-4">
                <div class="logo">
                    <a href="javascript: history.back();">
                        <img src="../assets/common/img/logo.png" alt="Clean UI Admin Template" />
                    </a>
                </div>
            </div>
            <div class="col-lg-8">

            </div>
        </div>
    </div>
    <div class="single-page-block">
        <div class="single-page-block-inner effect-3d-element">
            <div class="blur-placeholder"><!-- --></div>
            <div class="single-page-block-form">
                <h3 class="text-center">
                    <i class="icmn-enter margin-right-10"></i>
                    Forgot Password
                </h3>
                <br />
                <form id="form-validation" name="form-validation" method="POST">
                    <div class="form-group">
                        <input id="email"
                               class="form-control"
                               placeholder="Enter email address"
                               value = ""
                               name="email"
                               type="text"
                               data-validation="[EMAIL]">
                    </div>
                    <div class="form-group">
                        <!--<a href="javascript: void(0);" class="pull-right">Forgot Password?</a>-->

                    </div>
                    <div class="form-actions" name="submit">
                        <button type="submit" class="btn btn-primary width-150">Retrieve Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="single-page-block-footer text-center">

    </div>
    <!-- End Login Page -->

</div>

<!-- Page Scripts -->
<script>
    $(function() {

        // Form Validation
        $('#form-validation').validate({
            submit: {
                settings: {
                    inputContainer: '.form-group',
                    errorListClass: 'form-control-error',
                    errorClass: 'has-danger'
                }
            }
        });

        // Show/Hide Password
        $('.password').password({
            eyeClass: '',
            eyeOpenClass: 'icmn-eye',
            eyeCloseClass: 'icmn-eye-blocked'
        });

        // Add class to body for change layout settings
        $('body').addClass('single-page single-page-inverse');

        // Set Background Image for Form Block
        function setImage() {
            var imgUrl = $('.page-content-inner').css('background-image');

            $('.blur-placeholder').css('background-image', imgUrl);
        };

        function changeImgPositon() {
            var width = $(window).width(),
                    height = $(window).height(),
                    left = - (width - $('.single-page-block-inner').outerWidth()) / 2,
                    top = - (height - $('.single-page-block-inner').outerHeight()) / 2;


            $('.blur-placeholder').css({
                width: width,
                height: height,
                left: left,
                top: top
            });
        };

        setImage();
        changeImgPositon();

        $(window).on('resize', function(){
            changeImgPositon();
        });

        // Mouse Move 3d Effect
        var rotation = function(e){
            var perX = (e.clientX/$(window).width())-0.5;
            var perY = (e.clientY/$(window).height())-0.5;
            TweenMax.to(".effect-3d-element", 0.4, { rotationY:15*perX, rotationX:15*perY,  ease:Linear.easeNone, transformPerspective:1000, transformOrigin:"center" })
        };

        if (!cleanUI.hasTouch) {
            $('body').mousemove(rotation);
        }

    });
</script>
<!-- End Page Scripts -->
</section>

<div class="main-backdrop"><!-- --></div>

</body>
