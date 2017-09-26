<?php
    include ('../controllers/config.php');
    $id = $_GET['recover'];
    if($_POST)
    {
        header("location: index.php");
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
                    Account Recovery
                </h3>
                <br />
                <form id="recovery" name="recovery" method="POST">
                    <div class="form-group">
                        <input id="pass"
                               class="form-control password"
                               name="pass"
                               type="password" data-validation="[L>=6]"
                               data-validation-message="$ must be at least 6 characters"
                               placeholder="Password">
                    </div>
                    <div class="form-group">
                        <input id="confirm"
                               class="form-control password"
                               name="confirm"
                               type="password" data-validation="[L>=6]"
                               data-validation-message="$ must be at least 6 characters"
                               placeholder="Confirm password">
                    </div>
                    <div class="form-group">
                    <a href="login.php" class="pull-right">Login?</a>
                    </div>
                    <div class="form-actions" name="submit">
                        <button type="button" onclick="recover();" class="btn btn-primary width-150">Update Password</button>
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
function recover(){
    var id = <?php echo $id;?>;
    var pass = document.getElementById('pass').value;
    var confirmpass = document.getElementById('confirm').value;
    if(pass!= confirmpass){
        alert("Passwords do not match");
    }
    else
    {
        $.ajax
    ({
        url: "../controllers/recover.php",
        type:'POST',
        data:
        {
            id:id, pass:pass, confirmpass: confirmpass
        },
        success: function(result)
        { 
            alert("Success!");

        }               
    });
}
    }

    $(function() {

        // Form Validation
        $('#recovery').validate({
            button: {
                settings: {
                    inputContainer: '.form-group',
                    errorListClass: 'form-control-error',
                    errorClass: 'has-danger'
                }
            }
        });

        // Show/Hide Password
        $('.pass').password({
            eyeClass: '',
            eyeOpenClass: 'icmn-eye',
            eyeCloseClass: 'icmn-eye-blocked'
        });
        $('.confirmpass').password({
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
