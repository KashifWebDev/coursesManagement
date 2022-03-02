<?php
    require_once "includes/app.php";
validateSession();
    require_once "includes/functions.php";
    $path = ROOT_DIR;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Add Lesson"." | TeachMe How";
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
          <h1>Add a new Lesson</h1>
          <nav>
              <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?=ROOT_DIR?>instructorDashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item">Course Name</li>
                  <li class="breadcrumb-item active">Create Lesson</li>
              </ol>
          </nav>
      </div><!-- End Page Title -->

      <section class="section">
          <div class="row justify-content-center">
              <div class="col-lg-12">

                  <div class="card">
                      <div class="card-body">
                          <h5 class="card-title">Add a Lesson</h5>

                          <!-- Floating Labels Form -->
                          <div class="row g-3">

                              <div class="col-md-12 d-flex align-items-center">
                                  <p class="form-label me-2">Select Lesson Type  </p>
                                  <input type="radio" class="btn-check" name="options" id="option1" autocomplete="off" checked="" value="test">
                                  <label class="btn btn-outline-info me-2" for="option1" style="margin-right: 10px!important;">
                                      <i class="bi bi-list-check"></i>
                                      Test
                                  </label>

                                  <input type="radio" class="btn-check" name="options" id="option2" autocomplete="off" value="link">
                                  <label class="btn btn-outline-info me-2" for="option2">
                                      <i class="ri-links-line"></i>
                                      Link
                                  </label>

                                  <input type="radio" class="btn-check" name="options" id="option3" autocomplete="off" value="file">
                                  <label class="btn btn-outline-info me-2" for="option3">
                                      <i class="ri-file-line"></i>
                                      File
                                  </label>

                                  <input type="radio" class="btn-check" name="options" id="option4" autocomplete="off" value="video">
                                  <label class="btn btn-outline-info" for="option4">
                                      <i class="ri-video-fill"></i>
                                      Video
                                  </label>

                              </div>

                                <div id="1">
                                    <div class="row">
                                        <form action="instructor-all-courses.php" method="post" class="row g-3">
                                            <div class="col-md-6 mb-3">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="floatingName" placeholder="Test Name">
                                                    <label for="floatingName">Test Name</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="floatingNumOfTries" placeholder="Number Of Attempts">
                                                    <label for="floatingNumOfTries">Number Of Attempts</label>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="floatignQuestion" placeholder="Enter the question">
                                                    <label for="floatignQuestion">Type the question</label>
                                                </div>
                                            </div>

                                            <hr>
                                            <div class="col-10">
                                                <h1 style='font-size: 18px; font-weight: 500;font-family: "Poppins", sans-serif;'>Enter options for above question:</h1>
                                            </div>
                                            <div class="col-2">
                                                <h1 style='font-size: 18px; font-weight: 500;font-family: "Poppins", sans-serif;'>Select the Right Answer</h1>
                                            </div>
                                            <hr>

                                            <div class="col-md-12 mb-2 d-flex">
                                                <div class="col-10">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="floatingAnsw1" placeholder="Enter Answer" name="q1ans1">
                                                        <label for="floatingEmail">Enter First Answer</label>
                                                    </div>
                                                </div>
                                                <div class="ms-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="q1correct1">
                                                        <label class="form-check-label" for="gridRadios1">
                                                            Select
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-2 d-flex">
                                                <div class="col-10">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="floatingAnsw1" placeholder="Enter Answer" name="q1ans2">
                                                        <label for="floatingEmail">Enter Second Answer (Optional)</label>
                                                    </div>
                                                </div>
                                                <div class="ms-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="q1correct2">
                                                        <label class="form-check-label" for="gridRadios2">
                                                            Select
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-2 d-flex">
                                                <div class="col-10">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="floatingAnsw1" placeholder="Enter Answer" name="q1ans3">
                                                        <label for="floatingEmail">Enter Third Answer (Optional)</label>
                                                    </div>
                                                </div>
                                                <div class="ms-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="q1correct3">
                                                        <label class="form-check-label" for="gridRadios3">
                                                            Select
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-2 d-flex">
                                                <div class="col-10">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="floatingAnsw1" placeholder="Enter Answer" name="q1ans4">
                                                        <label for="floatingEmail">Enter Forth Answer (Optional)</label>
                                                    </div>
                                                </div>
                                                <div class="ms-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios4" value="q1correct4">
                                                        <label class="form-check-label" for="gridRadios4">
                                                            Select
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 d-flex justify-content-center">
                                                <div class="col-md-6">
                                                    <button type="submit" class="btn btn-primary w-100 mt-3 rounded-pill">
                                                        <i class="bi bi-plus-circle-fill mr-2"></i>
                                                        Save Lesson
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div id="2">
                                    <div class="row">
                                        <form action="instructor-all-courses.php" method="post" class="row1 g-3">
                                            <div class="col-md-12 mb-3">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="floatingTutLink" placeholder="Enter Link">
                                                    <label for="floatingTutLink">Enter Link</label>
                                                </div>
                                            </div>

                                            <div class="col-md-12 d-flex justify-content-center">
                                                <div class="col-md-6">
                                                    <button type="submit" class="btn btn-primary w-100 mt-3 rounded-pill">
                                                        <i class="bi bi-plus-circle-fill mr-2"></i>
                                                        Save Lesson
                                                    </button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                                <div id="3">
                                    <div class="row">
                                        <form action="instructor-all-courses.php" method="post" class="row1 g-3">
                                            <div class="row mb-3">
                                                <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="file" id="formFile">
                                                </div>
                                            </div>

                                            <div class="col-md-12 d-flex justify-content-center">
                                                <div class="col-md-6">
                                                    <button type="submit" class="btn btn-primary w-100 mt-3 rounded-pill">
                                                        <i class="bi bi-plus-circle-fill mr-2"></i>
                                                        Save Lesson
                                                    </button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                                <div id="4">
                                    <div class="row">
                                        <form action="instructor-all-courses.php" method="post" class="row1 g-3">
                                            <div class="col-md-12 mb-3">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="floatingVideoLink" placeholder="Enter Embed Link of a video">
                                                    <label for="floatingVideoLink">Enter Embed Link of a video</label>
                                                </div>
                                            </div>

                                            <div class="col-md-12 d-flex justify-content-center">
                                                <div class="col-md-6">
                                                    <button type="submit" class="btn btn-primary w-100 mt-3 rounded-pill">
                                                        <i class="bi bi-plus-circle-fill mr-2"></i>
                                                        Save Lesson
                                                    </button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>

                          </div><!-- End floating Labels Form -->

                      </div>
                  </div>

              </div>
          </div>
      </section>
  </main><!-- End #main -->


  <?=require_once "includes/footer.inc.php";?>

  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script>
      hideAll();
      $( "#1" ).show();

      $('input[name="options"]').change(function() {
          hideAll();
          console.log(this.value);
          if (this.value == 'test') {
              $( "#1" ).show( "slow", function() {});
          }
          else if (this.value == 'link') {
              $( "#2" ).show( "slow", function() {});
          }
          else if (this.value == 'file') {
              $( "#3" ).show( "slow", function() {});
          }
          else if (this.value == 'video') {
              $( "#4" ).show( "slow", function() {});
          }
      });

        function hideAll() {
            $( "#1" ).hide();
            $( "#2" ).hide();
            $( "#3" ).hide();
            $( "#4" ).hide();
        }
  </script>

</body>

</html>