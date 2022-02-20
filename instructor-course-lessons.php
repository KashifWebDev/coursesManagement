<?php
    require_once "includes/app.php";
    require_once "includes/functions.php";
    $path = ROOT_DIR;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "All Lessons"." | TeachMe How";
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
              <h1>Lessons</h1>
              <nav>
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="<?=ROOT_DIR?>instructorDashboard.php">Dashboard</a></li>
                      <li class="breadcrumb-item">Course Name</li>
                      <li class="breadcrumb-item active">All Lessons</li>
                  </ol>
              </nav>
          </div>
          <div>
              <a class="btn btn-primary" href="instructor-create-lesson.php">Add a New Lesson</a>
          </div>
      </div><!-- End Page Title -->

      <section class="section">
          <div class="row">
              <div class="col-lg-12">

                  <div class="card">
                      <div class="card-body">
                          <!-- Table with stripped rows -->
                          <table class="table datatable">
                              <thead>
                              <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Lesson Name</th>
                                  <th scope="col">Type</th>
                                  <th scope="col">Actions</th>
                              </tr>
                              </thead>
                              <tbody>
                              <tr>
                                  <th scope="row">1</th>
                                  <td>Some Lesson Name</td>
                                  <td>Youtube</td>
                                  <td>
                                      <a href="instructor-create-lesson.php" class="btn btn-outline-primary"><i class="bi bi-pencil-fill"></i></a>
                                      <button type="button" class="btn btn-outline-danger"  data-bs-toggle="modal" data-bs-target="#delModal"><i class="bi bi-trash2-fill"></i></button>
                                      <a target="_blank"  href="instructor-course-lessons.php" class="btn btn-outline-secondary"  data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Open Link"><i class="bi bi-box-arrow-up-right"></i></a>
                                  </td>
                              </tr>
                              <tr>
                                  <th scope="row">1</th>
                                  <td>Some Lesson Name</td>
                                  <td>Test</td>
                                  <td>
                                      <a href="instructor-create-lesson.php" class="btn btn-outline-primary"><i class="bi bi-pencil-fill"></i></a>
                                      <button type="button" class="btn btn-outline-danger"  data-bs-toggle="modal" data-bs-target="#delModal"><i class="bi bi-trash2-fill"></i></button>
                                      <a target="_blank"  href="instructor-course-lessons.php" class="btn btn-outline-secondary"  data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Open Link"><i class="bi bi-box-arrow-up-right"></i></a>
                                  </td>
                              </tr>
                              <tr>
                                  <th scope="row">1</th>
                                  <td>Some Lesson Name</td>
                                  <td>Link</td>
                                  <td>
                                      <a href="instructor-create-lesson.php" class="btn btn-outline-primary"><i class="bi bi-pencil-fill"></i></a>
                                      <button type="button" class="btn btn-outline-danger"  data-bs-toggle="modal" data-bs-target="#delModal"><i class="bi bi-trash2-fill"></i></button>
                                      <a target="_blank"  href="instructor-course-lessons.php" class="btn btn-outline-secondary"  data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Open Link"><i class="bi bi-box-arrow-up-right"></i></a>
                                  </td>
                              </tr>
                              <tr>
                                  <th scope="row">1</th>
                                  <td>Some Lesson Name</td>
                                  <td>Youtube</td>
                                  <td>
                                      <a href="instructor-create-lesson.php" class="btn btn-outline-primary"><i class="bi bi-pencil-fill"></i></a>
                                      <button type="button" class="btn btn-outline-danger"  data-bs-toggle="modal" data-bs-target="#delModal"><i class="bi bi-trash2-fill"></i></button>
                                      <a target="_blank"  href="instructor-course-lessons.php" class="btn btn-outline-secondary"  data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Open Link"><i class="bi bi-box-arrow-up-right"></i></a>
                                  </td>
                              </tr>
                              <tr>
                                  <th scope="row">1</th>
                                  <td>Some Lesson Name</td>
                                  <td>File</td>
                                  <td>
                                      <a href="instructor-create-lesson.php" class="btn btn-outline-primary"><i class="bi bi-pencil-fill"></i></a>
                                      <button type="button" class="btn btn-outline-danger"  data-bs-toggle="modal" data-bs-target="#delModal"><i class="bi bi-trash2-fill"></i></button>
                                      <a target="_blank"  href="instructor-course-lessons.php" class="btn btn-outline-secondary"  data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Open Link"><i class="bi bi-box-arrow-up-right"></i></a>
                                  </td>
                              </tr>
                              <tr>
                                  <th scope="row">1</th>
                                  <td>Some Lesson Name</td>
                                  <td>Link</td>
                                  <td>
                                      <a href="instructor-create-lesson.php" class="btn btn-outline-primary"><i class="bi bi-pencil-fill"></i></a>
                                      <button type="button" class="btn btn-outline-danger"  data-bs-toggle="modal" data-bs-target="#delModal"><i class="bi bi-trash2-fill"></i></button>
                                      <a target="_blank"  href="instructor-course-lessons.php" class="btn btn-outline-secondary"  data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Open Link"><i class="bi bi-box-arrow-up-right"></i></a>
                                  </td>
                              </tr>
                              <tr>
                                  <th scope="row">1</th>
                                  <td>Some Lesson Name</td>
                                  <td>Youtube</td>
                                  <td>
                                      <a href="instructor-create-lesson.php" class="btn btn-outline-primary"><i class="bi bi-pencil-fill"></i></a>
                                      <button type="button" class="btn btn-outline-danger"  data-bs-toggle="modal" data-bs-target="#delModal"><i class="bi bi-trash2-fill"></i></button>
                                      <a target="_blank"  href="instructor-course-lessons.php" class="btn btn-outline-secondary"  data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Open Link"><i class="bi bi-box-arrow-up-right"></i></a>
                                  </td>
                              </tr>
                              <tr>
                                  <th scope="row">1</th>
                                  <td>Some Lesson Name</td>
                                  <td>Youtube</td>
                                  <td>
                                      <a href="instructor-create-lesson.php" class="btn btn-outline-primary"><i class="bi bi-pencil-fill"></i></a>
                                      <button type="button" class="btn btn-outline-danger"  data-bs-toggle="modal" data-bs-target="#delModal"><i class="bi bi-trash2-fill"></i></button>
                                      <a target="_blank"  href="instructor-course-lessons.php" class="btn btn-outline-secondary"  data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Open Link"><i class="bi bi-box-arrow-up-right"></i></a>
                                  </td>
                              </tr>

                              <div class="modal fade" id="delModal" tabindex="-1">
                                  <div class="modal-dialog modal-lg">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h5 class="modal-title">Delete Course</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                              <a target="_blank"  href="instructor-course-lessons.php" class="btn btn-outline-secondary"  data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Open Link"><i class="bi bi-box-arrow-up-right"></i></a>
                                          </div>
                                          <div class="modal-body">
                                              Are you sure you want to delete this course?
                                          </div>
                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                              <a target="_blank"  href="instructor-course-lessons.php" class="btn btn-outline-secondary"  data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Open Link"><i class="bi bi-box-arrow-up-right"></i></a>
                                              <button type="button" class="btn btn-danger">Delete</button>
                                          </div>
                                      </div>
                                  </div>
                              </div><!-- End Large Modal-->
                              
                              </tbody>
                          </table>
                          <!-- End Table with stripped rows -->

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