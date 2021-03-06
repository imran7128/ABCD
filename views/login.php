<?php
    include ('../controllers/config.php');
    if($_POST){
        $conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $salt = "imranimranhussain";
        $password = md5($salt.$_POST['password']);

        $sql = "SELECT id,username, password, first_name FROM `_owner` WHERE username = :username AND password = :password";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $_POST['username']);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $row=$stmt->fetch(PDO::FETCH_ASSOC);

        if($row['username'] == $_POST['username'] && $row['password'] == $password){
            session_start();
            session_id();
            $_SESSION['current_user'] = $_POST['username'];
            $_SESSION['current_user_first_name'] = $row['first_name'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['usuccess'] = 'undefined';
            $_SESSION['tsuccess'] = 'undefined';
            $_SESSION['foor_id'] = 'undefined';
            $_SESSION['floor_delete_by_user'] = 'undefined';
            header("location: index.php");
        }

        else{
            $sql = "SELECT _tenantrentinginformation.id as id, _tenantprofile.username as username, 
            _tenantprofile.password as password, _tenantprofile.id as tid, _tenantrentinginformation.uid as uid FROM _tenantprofile INNER JOIN _tenantrentinginformation ON _tenantrentinginformation.tid = _tenantprofile.id WHERE username = :username AND password = :password";

            $salt = "imranimranhussain";
            $password = md5($salt.$_POST['password']);
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':username', $_POST['username']);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            $row=$stmt->fetch(PDO::FETCH_ASSOC);

            if($row['username'] == $_POST['username'] && $row['password'] == $password){
                session_start();
                session_id();
                $_SESSION['id'] = $row['id'];
                $_SESSION['uid'] = $row['uid'];
                $_SESSION['tid'] = $row['tid'];
                $_SESSION['current_user'] = $row['id'];
                $_SESSION['current_user_tenant'] = 'true';
                $_SESSION['usuccess'] = 'undefined';
                $_SESSION['tsuccess'] = 'undefined';
                header("location: tenant/tenantmain.php");
            }
        }
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
                    Login
                </h3>
                <br />
                <form id="form-validation" name="form-validation" method="POST">
                    <div class="form-group">
                        <input id="validation-username[username]"
                               class="form-control"
                               placeholder="Username"
                               name="username"
                               type="text"
                               data-validation="[NOTEMPTY]">
                    </div>
                    <div class="form-group">
                        <input id="validation-password"
                               class="form-control password"
                               name="password"
                               type="password" data-validation="[L>=6]"
                               data-validation-message="$ must be at least 6 characters"
                               placeholder="Password">
                    </div>
                    <div class="form-group">
                        <a href="forgot.php" class="pull-right">Forgot Password?</a>

                    </div>
                    <div class="form-actions" name="submit">
                        <button type="submit" class="btn btn-primary width-150">Sign In</button>
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
