<?php
    include ('head.php');
    include ('../controllers/config.php');
    if($_POST)
            {
                $conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "INSERT INTO `_owner` (username, email, password, first_name, last_name, security_question, security_answer) VALUES (:username,:email, :password, :first_name, :last_name, :security_question, :security_answer)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':email', $email);
                $password = md5($salt.$_POST['password']);
                $stmt->bindParam(':password', $password);
                $stmt->bindParam(':first_name', $first_name);
                $stmt->bindParam(':last_name', $last_name);
                $stmt->bindParam(':security_question', $security_question);
                $stmt->bindParam(':security_answer', $security_answer);

                $username = $_POST['username'];
                $email = $_POST['email'];
                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $security_question = $_POST['security_question'];
                $security_answer = $_POST['security_answer'];
                $stmt->execute();
                header("location: login.php");
            }
?>

    <!--$dbcon = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass); -->
<body class="mode-default colorful-enabled theme-red">

<section class="page-content">
<div class="page-content-inner" style="background-image: url(../assets/common/img/temp/login/2.jpg)">

    <!-- Register Page -->
    <div class="single-page-block-header">
        <div class="row">
            <div class="col-lg-12" align="center">
                <div class="logo">
                    <a href="javascript: void();">
                        <img src="../assets/common/img/logo-inverse.png" alt="Clean UI Admin Template" />
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="single-page-block">
        <div class="single-page-block-inner effect-3d-element">
            <div class="blur-placeholder"><!-- --></div>
            <div class="single-page-block-form">
                <h3 class="text-center">
                    <i class="icmn-users margin-right-10"></i>
                    Registration Form
                </h3>
                <br />
                <form id="register" name="register" method="POST">
                    <div class="form-group">
                        <input  id="_username" 
                                class="form-control"
                                name="username" 
                                type="text" data-validation="[L>=1]"
                                data-validation-message="$ must not be empty"
                                placeholder="Username">
                    </div>
                    <div class="form-group">
                        <div class="form-input-icon form-input-icon-right">
                            <i class="icmn-spinner11 util-spin"></i>
                            <input id="_email"
                                   class="form-control"
                                   placeholder="Email"
                                   name="email"
                                   type="text"
                                   data-validation="[EMAIL]">
                        </div>
                    </div>
                    <div class="form-group">
                        <input id="_password"
                               class="form-control password"
                               name="password"
                               type="password" data-validation="[L>=6]"
                               data-validation-message="$ must be at least 6 characters"
                               placeholder="Password">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Repeat Password">
                    </div>
                    <div class="form-group">
                        <input  id="_first_name" 
                                class="form-control"
                                name="first_name" 
                                type="text" data-validation="[L>=1]"
                                data-validation-message="$ must not be empty"
                                placeholder="First Name">
                    </div>
                    <div class="form-group">
                        <input  id="_last_name"
                                class="form-control"
                                name="last_name" 
                                type="text" data-validation="[L>=1]"
                                data-validation-message="$ must not be empty"
                                placeholder="Last Name">
                    </div>
                    <div class="form-group">
                        <input  id="_security_question"
                                class="form-control"
                                name="security_question" 
                                type="text" data-validation="[L>=1]"
                                data-validation-message="$ must not be empty"
                                placeholder="Security Question">
                    </div>
                    <div class="form-group">
                        <input  id="_security_answer"
                                class="form-control"
                                name="security_answer" 
                                type="text" data-validation="[L>=1]"
                                data-validation-message="$ must not be empty"
                                placeholder="Security Answer">
                    </div>
                   
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary width-150">Sign Up</button>
                        <div class="checkbox margin-left-10">
                            <label>
                                <input type="checkbox" name="example6" checked>
                                Agree to Terms and Conditions
                            </label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="single-page-block-footer text-center">
        <ul class="list-unstyled list-inline">
            <li><a href="javascript: void(0);">Terms of Use</a></li>
            <li class="active"><a href="javascript: void(0);">Compliance</a></li>
            <li><a href="javascript: void(0);">Confidential Information</a></li>
            <li><a href="javascript: void(0);">Support</a></li>
            <li><a href="javascript: void(0);">Contacts</a></li>
        </ul>
    </div>
    <!-- End Register Page -->

</div>

<!-- Page Scripts -->
<script>

    $(function () {

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

        // Add class to body for change layout settings
        $('body').addClass('single-page');

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
