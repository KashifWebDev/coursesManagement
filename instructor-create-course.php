<?php
    require_once "includes/app.php";
    require_once "includes/functions.php";
    $path = ROOT_DIR;
    if(isset($_POST["createCourse"])){
        $course_title = sanitizeParam($_POST["course_title"]);
        $courseID = sanitizeParam($_POST["courseID"]);
        $access_type = sanitizeParam($_POST["access_type"]);
        $timeLimit = sanitizeParam($_POST["timeLimit"]);
        $timeLimitValue = sanitizeParam($_POST["timeLimitValue"]);
        $reg_req_email = isset($_POST["reg_req_email"]) ? 1 : 0;
        $reg_req_phone = isset($_POST["reg_req_phone"]) ? 1 : 0;
        $reg_req_address = isset($_POST["reg_req_address"]) ? 1 : 0;
        $reg_req_tos = isset($_POST["reg_req_tos"]) ? 1 : 0;
        $price = sanitizeParam($_POST["price"]);
        $paypal_email = sanitizeParam($_POST["paypal_email"]);
        $instructor_name = sanitizeParam($_POST["instructor_name"]);
        $course_description = sanitizeParam($_POST["course_description"]);

        if($access_type=="Free"){
            $timeLimitValue = $timeLimitValue = $reg_req_tos = $reg_req_address = $reg_req_phone = $reg_req_email = $paypal_email = 0;
            $price = 0;
        }
        if($access_type=="Registration"){
            $paypal_email = 0;
            $price = 0;
        }
        if($access_type=="Paid"){
            $timeLimitValue = $timeLimitValue = $reg_req_tos = $reg_req_address = $reg_req_phone = $reg_req_email = 0;
        }

        $s = "INSERT INTO courses (instructor_id, title, access, description, courseID,timeLimitType, timeLimitValue, registration_required_email,registration_required_phone,registration_required_address,registration_required_tos, price, paypal_email,instructor_name)
             VALUES
            (1, '$course_title', '$access_type', '$course_description',$courseID, '$timeLimit', $timeLimitValue, $reg_req_email, $reg_req_phone,$reg_req_address, $reg_req_tos, $price, '$paypal_email', '$instructor_name')";
//        echo $s;
        if(!mysqli_query($con, $s)){
            echo mysqli_error($con); exit(); die();
        }
        $newID = mysqli_insert_id($con);
        header('Location: instructor-view-course.php?courseID='.$newID);
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Create Course"." | TeachMe How";
        require "includes/head.inc.php";
    ?>
</head>

<body>

  <!-- ======= Header ======= -->
    <?=require_once "includes/header.inc.php";?>
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <?=require_once "includes/instructorSideBar.inc.php";?>
  <!-- End Sidebar-->

  <main id="main" class="main">

      <div class="pagetitle">
          <h1>Create New Course</h1>
          <nav>
              <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?=ROOT_DIR?>instructorDashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item">Create New Course</li>
              </ol>
          </nav>
      </div><!-- End Page Title -->

      <section class="section">
          <div class="row justify-content-center">
              <div class="col-lg-12">

                  <div class="card">
                      <div class="card-body">
                          <h5 class="card-title">Enrolling a new course</h5>

                          <!-- Floating Labels Form -->
                          <form class="row g-3" action="" method="post">
                              <div class="col-md-6">
                                  <label for="inputNanme4" class="form-label">Course Title</label>
                                  <input type="text" class="form-control" id="inputNanme4" name="course_title">
                              </div>
                              <div class="col-md-6">
                                  <label for="inputNanme4" class="form-label">Link to the course publication</label>
                                  <div class="input-group mb-3">
                                      <span class="input-group-text" id="basic-addon3">https://teachmehow.me/course-</span>
                                      <input type="text" name="courseID" class="form-control" value="<?=rand()?>">
                                  </div>
                              </div>
                              <h5 class="card-title">Payment Settings</h5>
                              <div class="col-md-12 d-flex align-items-center">
                                  <p class="mb-0 me-2">Payment Settings And Course Access</p>

                                  <input type="radio" class="btn-check" name="access_type" id="option1" autocomplete="off" checked value="Free">
                                  <label class="btn btn-outline-success me-2" for="option1">
                                      <i class="ri-book-open-line me-2"></i>Free
                                  </label>

                                  <input type="radio" class="btn-check" name="access_type" id="option2" autocomplete="off" value="Registration">
                                  <label class="btn btn-outline-success me-2" for="option2">
                                      <i class="ri-login-box-fill me-2"></i>Registration
                                  </label>

                                  <input type="radio" class="btn-check" name="access_type" id="option3" autocomplete="off" value="Paid">
                                  <label class="btn btn-outline-success me-2" for="option3">
                                      <i class="ri-paypal-fill me-2"></i>Paid
                                  </label>
                              </div>
                              <div id="registration" class="row">
                                  <div class="col-md-4 mt-2">
                                      <p>Time Limit for students</p>
                                      <div class="input-group mb-3">
                                          <select class="form-select" id="selectTimeLimitFactor" name="timeLimit">
                                              <option value="Without Time Limit" selected>Without Time Limit</option>
                                              <option value="Days">Days</option>
                                              <option value="Months">Months</option>
                                              <option value="Years">Years</option>
                                          </select>
                                          <input type="text" class="form-control" id="timeLimitValueId" value="0" name="timeLimitValue">
                                      </div>
                                  </div>
                                  <div class="col-md-9">
                                      <div class="row mb-3">
                                          <legend class="col-form-label col-sm-2 pt-0">Registration form fields</legend>
                                          <div class="col-sm-8">

                                              <div class="form-check">
                                                  <input name="reg_req_email" class="form-check-input" type="checkbox" id="gridCheck1" checked="">
                                                  <label class="form-check-label" for="gridCheck1">
                                                      Email
                                                  </label>
                                              </div>

                                              <div class="form-check">
                                                  <input name="reg_req_phone" class="form-check-input" type="checkbox" id="gridCheck2" checked="">
                                                  <label class="form-check-label" for="gridCheck2">
                                                      Phone Number
                                                  </label>
                                              </div>

                                              <div class="form-check">
                                                  <input name="reg_req_address" class="form-check-input" type="checkbox" id="gridCheck2" checked="">
                                                  <label class="form-check-label" for="gridCheck2">
                                                      Address
                                                  </label>
                                              </div>

                                              <div class="form-check">
                                                  <input name="reg_req_tos" class="form-check-input" type="checkbox" id="gridCheck2" checked="">
                                                  <label class="form-check-label" for="gridCheck2">
                                                      Terms of use and services
                                                  </label>
                                              </div>

                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div id="paid" class="row mt-2">
                                  <div class="col-md-6">
                                      <label for="inputNanme4" class="form-label">Price in NIS (including VAT)</label>
                                      <input type="number" class="form-control" id="inputNanme4" name="price">
                                  </div>
                                  <div class="col-md-6">
                                      <label for="inputNanme4" class="form-label">Business Email Registered in PayPal</label>
                                      <input type="email" class="form-control" id="inputNanme4" name="paypal_email">
                                  </div>
                              </div>
                              <h5 class="card-title">About Course</h5>
                              <div class="col-md-6">
                                  <label for="inputNanme4" class="form-label">Instructor Name</label>
                                  <input type="text" name="instructor_name" class="form-control" id="inputNanme4" value="Kelin Anderson">
                              </div>
                              <div class="col-md-12 mt-3">
                                  <textarea class="tinymce-editor" name="course_description">
                                    <h3><strong><em>Course Description here....</em></strong></h3>
                                  </textarea>
                              </div>
                              <div class="row justify-content-center">
                                  <div class="col-md-6">
                                      <button name="createCourse" type="submit" class="btn btn-primary w-100 mt-3 rounded-pill" id="submitBtn">
                                          <i class="bi bi-plus-circle-fill mr-2"></i>
                                          Create Course
                                      </button>
                                  </div>
                              </div>
                          </form>

                      </div>
                  </div>

              </div>
          </div>
      </section>
  </main><!-- End #main -->


  <?=require_once "includes/footer.inc.php";?>


  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script>
      $("#registration").hide();
      $("#paid").hide();
      $("input#timeLimitValueId").hide();
      $('input[type=radio][name=access_type]').change(function() {
          if (this.value == 'Free') {
              $("#registration").hide();
              $("#paid").hide();
          }
          else if (this.value == 'Registration') {
              $("#registration").show();
              $("#paid").hide();
          }
          else if (this.value == 'Paid') {
              $("#registration").hide();
              $("#paid").show();
          }
      });
      $('#selectTimeLimitFactor').change(function() {
          if($(this).val()==="Days" || $(this).val()==="Months" || $(this).val()==="Years"){
              $("input#timeLimitValueId").show();
          }else{
              $("input#timeLimitValueId").hide();
          }
      });

      $('#submitBtn').on('click', function() {
          var $this = $(this);
          var loadingText = '<div class="spinner-border text-light" role="status"></div>';
          if ($(this).html() !== loadingText) {
              $this.data('original-text', $(this).html());
              $this.html(loadingText);
          }
      });
  </script>

</body>

</html>