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
</head>

<body>

<header id="header" class="header fixed-top d-flex align-items-center justify-content-between customColors">

    <div class="d-flex align-items-center justify-content-between">
        <img style="max-height: 60px;max-width: 80px;" id="courseImgThumbnail" src="assets/img/courses-thumnail/<?=$courseRow["thumbnail"];?>" alt="Profile" class="img-thumbnail">
        <i class="bi bi-list toggle-sidebar-btn" id="lsnHeading"></i>
    </div><!-- End Logo -->

    <h2><?=$courseRow["title"];?><small class="ms-3">By Kevin Anderson</small></h2>

    <nav class="header-nav">
        <ul class="d-flex align-items-center">

            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2 customColors" id="lsnHeading">K. Anderson</span>
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
    </nav><!-- End Icons Navigation -->

</header>

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar customColors">

    <div class="row">
        <div class="col-md-12 justify-content-center pb-3 customColors">
            <div class="d-flex justify-content-around align-items-center mb-3">
                <h3 class="customHeading text-center customColors" id="lsnHeading">Chapters</h3>
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

    <div class="siteSignature text-center bg-light" style="position: absolute; bottom: 0; left: 20px; right: 20px;">
        <div class="d-flex align-items-center justify-content-center">
            <img src="assets/img/logo_top.png" alt="Site Logo" height="70px">
            <div class="d-flex flex-column ps-2 fw-bold">
                <p class="m-0 bottomSignature" style="font-size: larger">Created With</p>
                <p class="m-0 bottomSignature">TeachMeHow.me</p>
            </div>
        </div>
    </div>
</aside>
<!-- End Sidebar-->

  <main id="main" class="main" style="height: 95vh;">
        <div class="card" style="height: 85%;">
              <div class="card-body p-2">
                  <div class="row h-100">
                      <div class="col-md-12 d-flex flex-column align-items-center h-100">
                          <div id="loader1" class="my-3 d-flex justify-content-center align-items-center">
                              <div class="spinner-border text-primary" role="status">
                                  <span class="visually-hidden">Loading...</span>
                              </div>
                              <span class="ms-2">Fetching Lessons..</span>
                          </div>
                          <div id="courseContent" class="w-100 h-100">
                              <div class="row justify-content-center h-100">
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
                  </div>
              </div>
          </div>
        <section class="section" style="dheight: 20%;">
          <div class="row">
            <div class="col-lg-12">


                <div class="card">
                    <div class="card-body p-2">
                        <div class="row">
                            <div class="col-md-2 d-flex flex-column align-items-center">
                                <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle" style="max-width: 80px;">
                                <h2 style="font-size: 24px; font-weight: 700; color: #2c384e; margin: 10px 0 0 0;">Kevin Anderson</h2>
                                <h3 style="font-size: 18px;">Instructor</h3>
                            </div>
                            <div class="col-md-10">
                                <h5 class="card-title">About Instructor</h5>
                                <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor.
                                    Ut sunt iure rerum quae quisquam autem eveniet perspiciatis
                                    odit. Fuga sequi sed ea saepe at unde.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
          </div>
        </section>
  </main>

<?=require_once "includes/footer.inc.php";?>

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

            <div class="card-body">

                <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                    <p class="text-center small">Please sign up to get the course subscription...</p>
                </div>

                <form class="row g-3 needs-validation" novalidate="" method="post" action="index.php?accountCreated=1">

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