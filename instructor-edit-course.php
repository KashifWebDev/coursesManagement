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
    $title = "Edit Course"." | TeachMe How";
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
          <h1>Edit Course</h1>
          <nav>
              <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?=ROOT_DIR?>instructorDashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item">Edit Course</li>
              </ol>
          </nav>
      </div><!-- End Page Title -->

      <section class="section">
          <div class="row justify-content-center">
              <div class="col-lg-12">

                  <div class="card">
                      <div class="card-body">
                          <h5 class="card-title">Edit course details</h5>

                          <!-- Floating Labels Form -->
                          <form class="row g-3">
                              <div class="col-md-6">
                                  <label for="inputNanme4" class="form-label">Course Title</label>
                                  <input type="text" class="form-control" id="inputNanme4" value="Learn Web Designing">
                              </div>

                              <div class="col-md-5">
                                  <label for="inputNumber" class="col-sm-8 col-form-label">Select Thumbnail</label>
                                  <div class="col-sm-12">
                                      <input class="form-control" type="file" id="formFile">
                                  </div>
                              </div>

                              <div class="col-md-1 d-flex align-items-end">
                                  <img src="assets/img/news-1.jpg" alt="Course Thumbnail" style="height: 50px;">
                              </div>

                              <div class="col-md-12">
                                  <textarea class="tinymce-editor">
                                    <h3><strong><em>Course Description here....</em></strong></h3>
                                  </textarea><!-- End TinyMCE Editor -->
                              </div>

                              <div class="row justify-content-center">
                                  <div class="col-md-6">
                                      <button type="submit" class="btn btn-primary w-100 mt-3 rounded-pill">
                                          <i class="bi bi-pencil-square mr-4"></i>
                                          Update Course Details
                                      </button>
                                  </div>
                              </div>
                          </form><!-- End floating Labels Form -->

                      </div>
                  </div>

              </div>
          </div>
      </section>
  </main><!-- End #main -->


  <?=require_once "includes/footer.inc.php";?>

</body>

</html>