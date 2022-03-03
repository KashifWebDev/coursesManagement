<?php

require_once "includes/app.php";
require_once "includes/functions.php";
$path = ROOT_DIR;

$courseID = sanitizeParam($_GET["id"]);

$s = "SELECT * FROM courses WHERE courseID=$courseID";
$res = mysqli_query($con, $s);
$courseRow = mysqli_fetch_array($res);
$courseID = $courseRow["id"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = $courseRow["title"]." | TeachMe How";
    require "includes/head.inc.php";
    ?>
    <style>
        /* Let's get this party started */
        .sidebar::-webkit-scrollbar {
            width: 12px;
        }

        /* Track */
        .sidebar::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
            -webkit-border-radius: 10px;
            border-radius: 10px;
        }

        /* Handle */
        .sidebar::-webkit-scrollbar-thumb {
            -webkit-border-radius: 10px;
            border-radius: 10px;
            background: <?=$courseRow["back_clr"]?>;
            -webkit-box-shadow: inset 0 0 0 <?=$courseRow["courseTitleBg"]?>;
        }
        .sidebar::-webkit-scrollbar-thumb:window-inactive {
            background: <?=$courseRow["back_clr"]?>;
        }
        .sidebar::-webkit-scrollbar-track-piece:end {
            background: transparent;
            margin-bottom: 80px;
        }

        .sidebar::-webkit-scrollbar-track-piece:start {
            background: transparent;
            margin-top: 120px;
        }
    </style>
</head>
<?php
 if($courseRow["page_background_type"]=="image"){
     $bgImg = $courseRow["page_background_image"];
     $style = "background-image: url('assets/img/course-bg/$bgImg');";
 }else{
     $bgClr = $courseRow["page_background_color"];
     $style = "background-color: $bgClr";
 }
?>
<body style="<?=$style?>">

<div style="width: 95%; height: 95vh" class="mx-auto pt-4">
    <div class="mainDiv text-white h-100 position-relative">
        <header id="header" class="header m-0 row titleColors" style="border-top-right-radius: 40px;border-top-left-radius: 40px;">

            <div class="col-md-8 d-flex justify-content-end align-items-center">
                <!--        <i class="bi bi-list toggle-sidebar-btn mb-2 me-3" id="lsnHeading"></i>-->
                <h2><?=$courseRow["title"];?><small class="ms-3">By Kevin Anderson</small></h2>
            </div>
            <div class="col-md-4 header-nav d-flex justify-content-end">
                <ul class="d-flex align-items-center">

                    <li class="nav-item dropdown pe-3">

                        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                            <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                            <span class="d-none d-md-block dropdown-toggle ps-2 titleColors">K. Anderson</span>
                        </a><!-- End Profile Iamge Icon -->

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                            <li class="dropdown-header">
                                <h6>Kevin Anderson</h6>
                                <span>Web Designer</span>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                    <i class="bi bi-person"></i>
                                    <span>My Profile</span>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                    <i class="bi bi-gear"></i>
                                    <span>Account Settings</span>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                                    <i class="bi bi-question-circle"></i>
                                    <span>Need Help?</span>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span>Sign Out</span>
                                </a>
                            </li>

                        </ul><!-- End Profile Dropdown Items -->
                    </li><!-- End Profile Nav -->

                </ul>
            </div>


        </header>

        <aside id="sidebar" class="sidebar customColors p-0 m-0" style=";z-index: 999; top: 0; position: absolute; overflow-x: hidden;border-top-left-radius: 40px;border-bottom-left-radius: 40px;">
            <div class="d-flex flex-column h-100 pe-0 pb-0">
                <div class="w-100 sticky-top">
                    <img style="max-height: 120px"
                         id="courseImgThumbnail" src="assets/img/courses-thumnail/<?=$courseRow["thumbnail"];?>"
                         alt="Profile" class="w-100">
                </div>
                <div class="w-100">
                    <div class="col-md-12 justify-content-center pb-3 customColors">
                        <div class="d-flex justify-content-around align-items-center mb-3">
                            <h3 class="customHeading text-center customColors" id="lsnHeading"></h3>
                        </div>
                        <div id="lessonsList">
                            <div id="loader" class="my-3 d-flex justify-content-center align-items-center">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <span class="ms-2">Fetching Lessons..</span>
                            </div>
                            <id id="ChaptersList"></id>
                        </div>
                    </div>
                </div>
                <div class="w-100 mt-auto sticky-bottom" style="; height: fit-content;">
                    <div class="siteSignature text-center bg-light">
                        <div class="d-flex align-items-center justify-content-center">
                            <img src="assets/img/logo_top.png" alt="Site Logo" height="70px">
                            <div class="d-flex flex-column ps-2 fw-bold">
                                <p class="m-0 bottomSignature" style="font-size: larger">Created With</p>
                                <p class="m-0 bottomSignature">TeachMeHow.me</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <main id="main" class="main pb-0 mb-0 mt-0" style="padding-right: 0px !important; padding-left: 0px; padding-top: 0px; position: absolute; left: 0; right: 0; top: 60px; bottom: 0;">

            <div class="d-flex flex-column h-100">
                <div class="customColors" style="height: 80%;">
                    <div id="loader1" class="my-3 d-flex justify-content-center align-items-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <span class="ms-2">Fetching Lessons..</span>
                    </div>
                    <div id="courseContent" class="w-100 customColors" style="height: 100%">
                        <div class="row justify-content-center h-100 customColors w-100">
                            <?php
                            if($courseRow["access"]=="Registration"){
                                echo signUp();
                            }
                            elseif($courseRow["access"]=="Paid"){
                                echo paypal();
                            }else{
                                echo defaultTxt();
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <section class="section col-md-12 bg-white" style="height: 20%;border-bottom-right-radius: 40px;">
                    <div class="align-items-center d-flex flex-row h-100 justify-content-evenly">
                        <div class="d-flex flex-row flex-lg-colmumn align-items-md-start align-items-lg-center h-100" style="text-align: -webkit-center;">
                            <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle" style="max-width: 80px;">
                            <div class="d-flex flex-column ms-2">
                                <h2 style="font-size: 24px; font-weight: 700; color: #2c384e; margin: 10px 0 0 0;">Kevin Anderson</h2>
                                <h3 style="font-size: 18px; color: #2c384e;">Instructor</h3>
                            </div>
                        </div>
                        <div class="d-flex flex-column h-100 justify-content-center w-50">
                            <h5 class="card-title d-lg-block d-md-none m-0 p-0">About Instructor</h5>
                            <p class="small fst-italic text-dark">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor.
                                Ut sunt iure rerum quae quisquam autem eveniet perspiciatis
                                odit. Fuga sequi sed ea saepe at unde.</p>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>
</div>

<!-- Vendor JS Files -->
<script src="<?=$path?>assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
<script src="<?=$path?>assets/vendor/php-email-form/validate.js"></script>
<script src="<?=$path?>assets/vendor/quill/quill.min.js"></script>
<script src="<?=$path?>assets/vendor/tinymce/tinymce.min.js"></script>
<script src="<?=$path?>assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="<?=$path?>assets/vendor/chart.js/chart.min.js"></script>
<script src="<?=$path?>assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="<?=$path?>assets/vendor/echarts/echarts.min.js"></script>

<!-- Template Main JS File -->
<script src="<?=$path?>assets/js/main.js?v=<?=rand()?>"></script>

<script src="assets/vendor/jquery/jquery.min.js"></script>

<script src="assets/vendor/jquery/jquery-ui.js"></script>
<link rel="stylesheet" href="assets/vendor/jquery/jquery-ui.css">

<script>
    loader('none');
    loader1('none');
    $( "#lesssonType_1" ).show();
    getLessons();


    $("#courseImageChange").click(function() {
        // document.getElementById('fileid').click();
        $("#fileid").click();
        // document.getElementById('fileid').click();
    });

    $("#fileid").change(function() {
        $("#proceedUploadImage").click();
    });


    function getLessons() {
        loader('block');
        $.ajax({
            url: "api/getChaptersAndLessons.php",
            type: "post",
            data: {
                courseID: <?=$courseID?>,
                publicView: true
            },
            success: function(response) {
                loader('none');
                $("#ChaptersList").html(response);
                implementColors();
            },
            error: function(xhr) {
                alert("Error while fetching courses!\n "+xhr);
            }
        });
    }

    <?php
    if($courseRow["access"]=="Free"){
        ?>
        function getLessonContent(lessonID) {
        placeHolderIcon("block");
        $('#courseContent').empty();
        loader1('block');
        $.ajax({
            url: "api/getLessonContentByCourseId.php",
            type: "post",
            data: {
                courseID: <?=$courseID?>,
                lessonID: lessonID,
                publicView: true
            },
            success: function(response) {
                loader1('none');
                if(response==""){
                    $('#courseContent').empty();
                }else{
                    $('#courseContent').append(response);
                }
                implementColors();
            },
            error: function(xhr) {
                alert("Error while fetching courses!\n "+xhr);
            }
        });
    }
        <?php
    }
    ?>

    function loader(visible) {
        $('#loader').attr('style','display:'+visible+' !important');
    }
    function loader1(visible) {
        $('#loader1').attr('style','display:'+visible+' !important');
    }
    function placeHolderIcon(visible) {
        $('#placeholderIcon').attr('style','display:'+visible+' !important');
    }
    function implementColors() {
        $('.customColors').css('background-color', '<?=$courseRow["back_clr"]?>');
        $('.list-group-item').css('background-color', '<?=$courseRow["back_clr"]?>');
        $('.titleColors').css('background-color', '<?=$courseRow["courseTitleBg"]?>');

        $('.titleColors').css('color', '<?=$courseRow["courseTitleFg"]?>');
        $('.list-group-item').css('color', '<?=$courseRow["front_clr"]?>');
        $('.customColors').css('color', '<?=$courseRow["front_clr"]?>');
        $('.bottomSignature').css('color', '<?=$courseRow["back_clr"]?>');
        $('#lsnHeading').css('color', '<?=$courseRow["front_clr"]?>');
    }
    implementColors();
</script>


</body>

</html>

<?php
function signUp(){
    return '
    <div class="col-lg-6 col-md-10 d-flex flex-column align-items-center justify-content-center">


        <div class="card mb-3">

            <div class="card-body text-dark">

                <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                    <p class="text-center small">Please sign up to get the course subscription...</p>
                </div>

                <form class="row g-3 needs-validation" novalidate="" method="post" action="">

                    <div class="col-md-6">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" name="firstName" class="form-control" id="firstName" required="">
                        <div class="invalid-feedback">Please, enter your first name!</div>
                    </div>

                    <div class="col-md-6">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" name="lastName" class="form-control" id="lastName" required="">
                        <div class="invalid-feedback">Please, enter your last name!</div>
                    </div>

                    <div class="col-md-6">
                        <label for="yourEmail" class="form-label">Your Email</label>
                        <input type="email" name="email" class="form-control" id="yourEmail" required="">
                        <div class="invalid-feedback">Please enter a valid Email address!</div>
                    </div>

                    <div class="col-md-6">
                        <label for="yourContactNum" class="form-label">Contact #</label>
                        <input type="text" name="contactNum" class="form-control" id="yourContactNum" required="">
                        <div class="invalid-feedback">Please enter a valid contact number!</div>
                    </div>

                    <div class="col-md-6">
                        <label for="yourAddress" class="form-label">Your Address</label>
                        <input type="text" name="address" class="form-control" id="yourAddress" required="">
                        <div class="invalid-feedback">Please enter a valid Address!</div>
                    </div>

                    <div class="col-md-6">
                        <label for="yourUsername" class="form-label">Username</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                            <input type="text" name="username" class="form-control" id="yourUsername" required="">
                            <div class="invalid-feedback">Please choose a username.</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="yourPassword" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="yourPassword" required="">
                        <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-md-6">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <input type="password" name="confirmPassword" class="form-control" id="confirmPassword" required="">
                        <div class="invalid-feedback">Renter the same password!</div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-check">
                            <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required="">
                            <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="#">terms and conditions</a></label>
                            <div class="invalid-feedback">You must agree before submitting.</div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-primary w-100" type="submit">Create Account</button>
                    </div>
                    <div class="col-md-12">
                        <p class="small mb-0">Already have an account? <a href="./">Log in</a></p>
                    </div>
                </form>

            </div>
        </div>

    </div>
';
}

function paypal(){
    return '
    <div class="col-lg-6 col-md-10 d-flex flex-column align-items-center justify-content-center">


        <div class="card mb-3">

            <div class="card-body">

                <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Buy Course</h5>
                    <p class="text-center small">Please buy this course to proceed...</p>
                </div>

                <form >
                    <div class="col-md-12">
                        <button class="btn btn-warning w-100 ">
                        <i class="ri-paypal-fill"></i>
                        Buy Now
                        </button>
                    </div>
                </form>

            </div>
        </div>

    </div>
';
}

function defaultTxt(){
    return '
    <div class="container-fluid p-5 text-white text-center h-100 d-flex flex-column justify-content-center customColors">
      <h1 class="customColors">Welcome to the course!</h1>
      <p style="font-size: larger" class="customColors">Please select the lessons from left menu to start learning!</p> 
    </div>
';
}
?>