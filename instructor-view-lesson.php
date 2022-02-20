<?php
    require_once "includes/app.php";
    require_once "includes/functions.php";
    $path = ROOT_DIR;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Lesson Name"." | TeachMe How";
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

      <div class="pagetitle d-flex justify-content-between">
          <div>
              <h1>Lesson Name</h1>
              <nav>
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="<?=ROOT_DIR?>instructorDashboard.php">Dashboard</a></li>
                      <li class="breadcrumb-item">Course Name</li>
                      <li class="breadcrumb-item active">Lesson Name</li>
                  </ol>
              </nav>
          </div>
      </div><!-- End Page Title -->

      <section class="section">
          <div class="row">
              <div class="col-lg-12">

                  <div class="card">
                      <div class="card-body p-2">
                          <div class="row">
                              <div class="col-md-12 justify-content-center">
                                  <iframe width="600" height="400" src="https://www.youtube.com/embed/C72WkcUZvco" title="YouTube video player"
                                          frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                          allowfullscreen>
                                  </iframe>
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
                                  <h5 class="card-title">About</h5>
                                  <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor.
                                      Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p>
                              </div>
                          </div>
                      </div>
                  </div>

              </div>
          </div>
      </section>

  </main><!-- End #main -->

  

  <?=require_once "includes/footer.inc.php";?>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
      $(document).ready(function(){
          $('[data-bs-toggle="tooltip"]').tooltip();
      });
  </script>

</body>

</html>