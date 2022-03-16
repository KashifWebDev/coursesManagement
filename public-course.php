<?php

require_once "includes/app.php";
require_once "includes/functions.php";
$path = ROOT_DIR;

$courseID = sanitizeParam($_GET["id"]);

$s = "SELECT * FROM courses WHERE courseID=$courseID";
$res = mysqli_query($con, $s);
$courseRow = mysqli_fetch_array($res);
$courseID = $courseRow["id"];
$instructorID = $courseRow["instructor_id"];

if(isset($_POST["unlockCourse_Pass"])){
    $pass = sanitizeParam($_POST["coursePassValue"]);
     if($courseRow["coursePassword"]==$pass){
         $_SESSION["coursePass"] = true;
         echo '<script>alert("Enjoy Learning..!");</script>';
     }else{
         echo '<script>alert("Incorrect password!");</script>';
     }
}

$s = "SELECT concat(firstname,' ',lastname) as fullName, about, pic FROM users WHERE id=$instructorID";
$res = mysqli_query($con, $s);
$instructorRow = mysqli_fetch_array($res);
$instructor_name = $instructorRow["fullName"];
$userPic = $instructorRow["pic"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = $courseRow["title"]." | TeachMe How";
    require "includes/head.inc.php";
    ?>
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <style>
        /* Let's get this party started */
        .sidebar1::-webkit-scrollbar {
            width: 12px;
        }

        /* Track */
        .sidebar1::-webkit-scrollbar-track {
            -webkit-border-radius: 10px;
            border-radius: 10px;
        }

        /* Handle */
        .sidebar1::-webkit-scrollbar-thumb {
            -webkit-border-radius: 10px;
            border-radius: 10px;
            background: <?=$courseRow["front_clr"]?>;
            -webkit-box-shadow: inset 0 0 0 <?=$courseRow["back_clr"]?>;
        }
    </style>
    <?php echo loadPaypalScripts($courseRow["paypal_client_api_key"], $courseRow["price"], $courseRow["id"]); ?>
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
                <h2><?=$courseRow["title"];?><small class="ms-3">By <?=$instructor_name?></small></h2>
            </div>
            <?php if(isset($_SESSION["userID"])) { ?>

                <div class="col-md-4 header-nav d-flex justify-content-end">
                    <ul class="d-flex align-items-center">

                        <li class="nav-item dropdown pe-3">

                            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                                <img src="assets/img/profilePics/<?=$userPic?>" alt="Profile" class="rounded-circle">
                                <span class="d-none d-md-block dropdown-toggle ps-2"><?=$_SESSION["firstName"]?></span>
                            </a><!-- End Profile Iamge Icon -->

                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                                <li class="dropdown-header">
                                    <h6><?=$_SESSION["fullName"]?></h6>
                                    <span><?=$_SESSION["role"]?></span>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="profile.php">
                                        <i class="bi bi-person"></i>
                                        <span>My Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="profile.php">
                                        <i class="bi bi-gear"></i>
                                        <span>Account Settings</span>
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="includes/logout.php">
                                        <i class="bi bi-box-arrow-right"></i>
                                        <span>Sign Out</span>
                                    </a>
                                </li>

                            </ul><!-- End Profile Dropdown Items -->
                        </li><!-- End Profile Nav -->
                    </ul>
                </div>
            <?php } ?>


        </header>

        <aside id="sidebar" class="sidebar customColors p-0 m-0" style=";z-index: 999; top: 0; position: absolute; overflow-x: hidden;border-top-left-radius: 40px;border-bottom-left-radius: 40px;">
            <div class="d-flex flex-column h-100 pe-0 pb-0" style="overflow: hidden">
                <div class="w-100 sticky-top">
                    <img style="max-height: 120px"
                         id="courseImgThumbnail" src="assets/img/courses-thumnail/<?=$courseRow["thumbnail"];?>"
                         alt="Profile" class="w-100">
                </div>
                <div class="w-100 sidebar1" style="overflow: auto">
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
                        <div class="d-flex align-items-center justify-content-center customColors">
                            <img src="assets/img/bottomLogo/<?=$courseRow["bottomLogo"]?>" alt="Site Logo" class="" height="120px">
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
                    <div id="courseContent" class="w-100 customColors customColors w-100" style="height: 100%">
                    </div>
                </div>
                <section class="section col-md-12 bg-white" style="height: 20%;border-bottom-right-radius: 40px;">
                    <div class="align-items-center d-flex flex-row h-100 justify-content-evenly">
                        <div class="d-flex flex-row flex-lg-colmumn align-items-md-start align-items-lg-center h-100" style="text-align: -webkit-center;">
                            <img src="assets/img/instructorPic/<?=$courseRow["instructorPicture"]?>" alt="Profile" class="rounded-circle" style="max-width: 80px;">
                            <div class="d-flex flex-column ms-2">
                                <h2 style="font-size: 24px; font-weight: 700; color: #2c384e; margin: 10px 0 0 0;"><?=$courseRow["instructor_name"]?></h2>
                                <h3 style="font-size: 18px; color: #2c384e;">Instructor</h3>
                            </div>
                        </div>
                        <div class="d-flex flex-column h-100 justify-content-center w-50">
                            <h5 class="card-title d-lg-block d-md-none m-0 p-0">About Instructor</h5>
                            <p class="small fst-italic text-dark">
                                <?php echo limit_text($courseRow["aboutInstructor"], 37); ?>
                            </p>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>
</div>


<div class="modal fade" id="aboutInstructorTextModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white ">
                <h5 class="modal-title">About Instructor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?=$courseRow["aboutInstructor"]?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
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


<script src="assets/vendor/jquery/jquery-ui.js"></script>
<link rel="stylesheet" href="assets/vendor/jquery/jquery-ui.css">

<script>
    loader('none');
    loader1('none');
    $( "#lesssonType_1" ).show();
    getLessons();
    loadFirstLesson();


    $("#courseImageChange").click(function() {
        // document.getElementById('fileid').click();
        $("#fileid").click();
        // document.getElementById('fileid').click();
    });

    $("#fileid").change(function() {
        $("#proceedUploadImage").click();
    });

    function loadFirstLesson() {
        $.ajax({
            url: "api/getFirstLessonPublicView.php",
            type: "post",
            data: {
                courseID: <?=$courseID?>,
                publicView: true
            },
            success: function(response) {
                loader1('none');
                if(response==""){
                    $('#courseContent').empty();
                }else{
                    $('#courseContent').html(response);
                }
                implementColors();
                loadPaypemtScript();
            },
            error: function(xhr) {
                alert("Error while fetching courses!\n "+xhr);
            }
        });
    }

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
                loadPaypemtScript();
            },
            error: function(xhr) {
                alert("Error while fetching courses!\n "+xhr);
            }
        });
    }

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
        $('.bottomSignature').css('color', '<?=$courseRow["signFgColor"]?>');
        $('.bottomSignatureBg').css('background', '<?=$courseRow["signBgColor"]?>');
        $('#lsnHeading').css('color', '<?=$courseRow["front_clr"]?>');
    }
    implementColors();

    function loadPaypemtScript(){
        var price = parseFloat(<?=$courseRow["price"]?>);
        var courseID = parseInt(<?=$courseRow["id"]?>)
        var userEmail;
        paypal.Buttons({

            onInit: function(data, actions) {
                actions.disable();

                document.querySelector('#PaypalEmail')
                    .addEventListener('change', function(event) {

                        var val = $.trim(event.target.value);

                        if (val) {
                            actions.enable();
                        } else {
                            actions.disable();
                        }
                    });

            },
            onClick: function() {

                var val = $.trim($('#PaypalEmail').val());

                if (!val) {
                    alert('Please enter the email');
                }
                userEmail = val;
            },

            // Sets up the transaction when a payment button is clicked
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: price // Can reference variables or functions. Example: `value: document.getElementById('...').value`
                        }
                    }]
                });
            },

            // Finalize the transaction after payer approval
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(orderData) {
                    // Successful capture! For dev/demo purposes:
//                console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    console.log(JSON.stringify(orderData));
                    var transaction = orderData.purchase_units[0].payments.captures[0];

                    $.ajax({
                        url: 'api/payment.php',
                        type: 'POST',
                        data: jQuery.param(
                            { courseID: courseID,
                                email : userEmail,
                                response : JSON.stringify(orderData)
                            }
                        ) ,
                        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                        success: function (response) {
                            if(response=='yes'){
                                alert('Payment was successfull');
                                window.location.reload();
//                        window.location.href ='course-123?done';
                            }

                        },
                        error: function () {
                            alert('error');
                        }
                    });

                    // When ready to go live, remove the alert and show a success message within this page. For example:
                    // var element = document.getElementById('paypal-button-container');
                    // element.innerHTML = '';
                    // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                    // Or go to another URL:  actions.redirect('thank_you.html');
                });
            }
        }).render('#paypal-button-container');
    }
</script>


</body>

</html>
