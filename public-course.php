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

<!-- ======= Header ======= -->
<?=require_once "includes/header.inc.php";?>
<!-- End Header -->

<!-- ======= Sidebar ======= -->
<?//=require_once "includes/instructorSideBar.inc.php";?>
<!-- End Sidebar-->

  <main id="main1" class="main" style="margin-top: 60px; padding: 20px 30px; transition: all 0.3s;">
        <div class="card">
              <div class="card-body p-2">
                  <div class="row">
                      <div class="col-md-3 d-flex flex-column align-items-center">
                          <form>
                              <div class="course-img-container w-100 h-100">
                                  <img id="courseImgThumbnail" src="assets/img/courses-thumnail/<?=$courseRow["thumbnail"];?>" alt="Profile" class="img-thumbnail h-100 w-100">
                              </div>
                              <input id='fileid' type='file' name="fileToUpload" hidden/>
                              <input id="proceedUploadImage" name="uploadImg" type="submit"  hidden/>
                          </form>
                      </div>
                      <div class="col-md-9">
                          <div class="d-flex justify-content-between">
                              <div>
                                  <div class="d-flex align-items-center">
                                      <h2 class="mb-2 customHeading">
                                          <?=$courseRow["title"];?>
                                      </h2>
                                      <span class="badge bg-info ms-3" style="height: fit-content"><?=$courseRow["access"];?></span>
                                      <span class="badge bg-primary ms-1" style="height: fit-content"><?php echo $courseRow["draft"]==1 ? "Draft":"Active"; ?></span>
                                  </div>
                                  <p class="small fst-italic">
                                      <?=$courseRow["description"];?>
                                  </p>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <div class="row">
                  <div class="col-md-3 justify-content-center shadow-lg pb-3 customColors">
                      <h3 class="customHeading text-center" id="lsnHeading">Lessons</h3>
                      <div id="lessonsList">
                          <div id="loader" class="my-3 d-flex justify-content-center align-items-center">
                              <div class="spinner-border text-primary" role="status">
                                  <span class="visually-hidden">Loading...</span>
                              </div>
                              <span class="ms-2">Fetching Lessons..</span>
                          </div>
                      </div>
                      <hr>
                      <button class="btn btn-outline-primary w-100"  data-bs-toggle="modal" data-bs-target="#addNewLesson">
                          <i class="bi bi-plus-square-dotted"></i>
                          Add a Lesson
                      </button>
                  </div>
                  <div class="col-md-9">
                      <div class="col-md-12 justify-content-center">
                          <div id="loader1" class="my-3 d-flex justify-content-center align-items-center">
                              <div class="spinner-border text-primary" role="status">
                                  <span class="visually-hidden">Loading...</span>
                              </div>
                              <span class="ms-2">Fetching Lessons..</span>
                          </div>
                          <div id="courseContent">
                              <div class="row justify-content-center">
                                  <?php
                                    if($courseRow["access"]=="Registration") echo signUp();
                                    if($courseRow["access"]=="Paid") echo paypal();
                                  ?>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
          </div>

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
            url: "api/getLessonsByCourseId.php",
            type: "post",
            data: {
                courseID: <?=$courseID?>,
            },
            success: function(response) {
                loader('none');
                var lessons = $.parseJSON(response);
                var length = Object.keys(lessons).length;
                if(length){
                    $('#lessonsList').append('<ul class="list-group sortable" id="lessonsListItems"></ul>');
                    for (lesson of lessons) {
                        $("#lessonsList ul").append('<li class="list-group-item" id="'+lesson.id+'" onclick="getLessonContent('+lesson.id+')"><i class="bi bi-grip-vertical me-3"></i>'+lesson.name+'</li>');
                    }
                }else{
                    $('#lessonsList').append('<hr><h5 class="text-center">No Lessons Found</h5>');
                }
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
?>